<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\IdCard;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF; 

use Session;
class AuthController extends Controller
{
    public function index(){
        if(Auth::check()){
            if(Auth::user()->hasRole('admin')){
                return redirect('admin/dashboard');
            }
            if(Auth::user()->hasRole('retailer')){
                return redirect('retailer/dashboard');
            }
            return redirect('/');
        }
        return view('auth.login');
    }



   
     /**
     * Handle User Login
     */
    public function login(Request $request)
    {
        // Redirect if already logged in
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }

        // Validate request
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email is required',
            'password.required' => 'Password is required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Merge session cart to user cart
            $this->cartSessionToUser();

            $user = Auth::user();

            // Redirect based on role
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Signed in successfully');
            }
            if ($user->hasRole('retailer')) {
                return redirect()->route('retailer.dashboard')->with('success', 'Signed in successfully');
            }

            return redirect()->route('user.dashboard')->with('success', 'Signed in successfully');
        }

        // Failed login
        return back()->withInput($request->only('email'))
                    ->with('error', 'Login details are not valid');
    }



    public function registerPage(){
        if(Auth::check()){
            return redirect()->route('user.dashboard');;
        }
        else{
            return view('auth.login');
        }

    }

    public function registration(){ 

        if(Auth::check()){
            return redirect()->route('user.dashboard');;
        }
        else{
            return view('auth.main-register');
        }
    }

    public function healthCard(){ 
        return view('auth.health-register');
    }



  
    // old register for create table 
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name'               => 'required|string|max:255',
    //         'father_name'        => 'required|string|max:255',
    //         'present_address'    => 'required|string|max:500',
    //         'permanent_address'  => 'required|string|max:500',
    //         'ssc_passing'        => 'required|string|max:50',
    //         'ssc_registration'   => 'required|string|max:50',
    //         'reg_date'           => 'required|date',
    //         'tin_number'         => 'nullable',
    //         'bkash_number'       => 'nullable',
    //         'health_history'     => 'nullable',
    //         'nid'                => 'required|string|max:100',
    //         'mobile'             => 'required|unique:users,mobile',
    //         'dob'                => 'required|date',
    //         'blood_group'        => 'required|string|max:10',
    //         'image'              => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
    //         'email'              => 'required|email|unique:users,email',
    //         'password'           => 'required|string|min:8',
    //     ]);

    //     // Handle Image Upload
    //      $photoPath = null;
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $imageName = time() . '.' . $file->getClientOriginalExtension();
    //         Storage::disk('public')->put('users/' . $imageName, File::get($file));
    //         $photoPath = $imageName;
    //     }

    //     // Create user
    //     $user = User::create([
    //         'name'               => $request->name,
    //         'father_name'        => $request->father_name,
    //         'address'            => $request->present_address,
    //         'present_address'    => $request->present_address,
    //         'permanent_address'  => $request->permanent_address,
    //         'reg_date'           => $request->reg_date,
    //         'tin_number'         => $request->tin_number,
    //         'health_history'     => $request->health_history,
    //         'nid'                => $request->nid,
    //         'mobile'             => $request->mobile,
    //         'bkash_number'       => $request->bkash_number,
    //         'ssc_passing'        => $request->ssc_passing,
    //         'ssc_registration'   => $request->ssc_registration,
    //         'dob'                => $request->dob,
    //         'blood_group'        => $request->blood_group,
    //         'image'              => $photoPath,
    //         'email'              => $request->email,
    //         'password'           => Hash::make($request->password),
    //     ]);

    //     // Auto login
    //     Auth::login($user);

    //     // Merge session cart
    //     $this->cartSessionToUser();

    //     // ID Card generation
    //     $idcardData = ['user' => $user];
    //     $filename = "idcard_{$user->id}_" . time() . ".pdf";



    //    $pdf = PDF::loadView('idcard', compact('idcardData'))
    //     // ->setPaper([0, 0, 350, 500], 'portrait') 
    //     ->setOptions([
    //         'isHtml5ParserEnabled' => true,
    //         'isRemoteEnabled' => true,
    //         'defaultFont' => 'sans-serif',
    //         'dpi' => 96,
    //         'background' => false, // transparent background
    //         'margin-top' => 0,
    //         'margin-right' => 0,
    //         'margin-bottom' => 0,
    //         'margin-left' => 0,
    //     ]);
      

    //     Storage::disk('public')->put("idcards/{$filename}", $pdf->output());

    //     IdCard::create([
    //         'user_id' => $user->id,
    //         'issued_at' => $user->reg_date,
    //         'file_name' => "idcards/{$filename}",
    //     ]);

    //     // Redirect
    //     return redirect()->route('user.dashboard')
    //                     ->with('success', 'Registration successful! Welcome, ' . $user->name);
    // }

    public function register(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'father_name'        => 'required|string|max:255',
            'present_address'    => 'required|string|max:500',
            'permanent_address'  => 'required|string|max:500',
            'ssc_passing'        => 'required|string|max:50',
            'ssc_registration'   => 'required|string|max:50',
            'reg_date'           => 'required|date',
            'tin_number'         => 'nullable',
            'bkash_number'       => 'nullable',
            'health_history'     => 'nullable',
            'nid'                => 'required|string|max:100',
            'mobile'             => 'required|unique:users,mobile',
            'dob'                => 'required|date',
            'blood_group'        => 'required|string|max:10',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            // 'email'              => 'required|email|unique:users,email',
            // 'password'           => 'required|string|min:8',
        ]);

        // Handle Image Upload
         $photoPath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('users/' . $imageName, File::get($file));
            $photoPath = $imageName;
        }

        $user = User::findOrFail(Auth::id());

        // Update user
        $user->update([
            'name'               => $request->name,
            'father_name'        => $request->father_name,
            'address'            => $request->present_address,
            'present_address'    => $request->present_address,
            'permanent_address'  => $request->permanent_address,
            'reg_date'           => $request->reg_date,
            'tin_number'         => $request->tin_number,
            'health_history'     => $request->health_history,
            'nid'                => $request->nid,
            'mobile'             => $request->mobile,
            'bkash_number'       => $request->bkash_number,
            'ssc_passing'        => $request->ssc_passing,
            'ssc_registration'   => $request->ssc_registration,
            'dob'                => $request->dob,
            'blood_group'        => $request->blood_group,
            'image'              => $photoPath,
            // 'email'              => $request->email, // optional
            // 'password'           => Hash::make($request->password), // optional
        ]);

        // Auto login
        // Auth::login($user);

        // Merge session cart
        $this->cartSessionToUser();

        // ID Card generation
        $idcardData = ['user' => $user];
        $filename = "idcard_{$user->id}_" . time() . ".pdf";



       $pdf = PDF::loadView('idcard', compact('idcardData'))
        // ->setPaper([0, 0, 350, 500], 'portrait') 
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
            'dpi' => 96,
            'background' => false, // transparent background
            'margin-top' => 0,
            'margin-right' => 0,
            'margin-bottom' => 0,
            'margin-left' => 0,
        ]);
      

        Storage::disk('public')->put("idcards/{$filename}", $pdf->output());

        IdCard::updateOrCreate(
            ['user_id' => $user->id], // search condition
            [
                'issued_at' => $user->reg_date,
                'file_name' => "idcards/{$filename}",
            ]
        );

        // Redirect
        return redirect()->route('user.dashboard')
                        ->with('success', 'Registration successful! Welcome, ' . $user->name);
    }

    public function mainRegister(Request $request)
    {

        $request->validate([
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|unique:users,email',
            'password'           =>  'required|string|min:8|confirmed',
            // 'password'           => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login
        Auth::login($user);

        // Merge session cart
        $this->cartSessionToUser();

        // Redirect
        return redirect()->route('user.dashboard')
                        ->with('success', 'Registration successful! Welcome, ' . $user->name);
    }




    /**
     * Move session cart items to logged-in user
     */
    private function cartSessionToUser()
    {
        $session_id = Session::get('session_id');
        if ($session_id && Auth::check()) {
            Cart::where('session_id', $session_id)
                ->update(['user_id' => Auth::id(), 'session_id' => null]);
        }
    }



    public function dashboard()
    {
        $user = Auth::user();
        $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
        $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
        $orders = $user->orders()->latest()->paginate(30);
        $featured_products = \App\Models\Product::where('feature', 1)->where('active',1)->latest()->paginate(12);
        $stockRequests = \App\Models\ProductStockRequest::where('user_id', Auth::id())->latest()->paginate(20); // Initialize
        $products = \App\Models\Product::all(); // Add this line

        $activeTab = 'dashboard'; 

        return view('user.dashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab','featured_products', 'stockRequests', 'products'));
    }

    public function orders(Request $request)
    {
        $user = Auth::user();
        $query = $user->orders();

        $type = $request->type;
        switch ($type) {
            case 'today':
                $query->whereDate('created_at', now()->toDateString());
                break;
            case 'cancelled':
                $query->where('order_status', 'cancelled');
                break;
        }

        $orders = $query->latest()->paginate(30);
        $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
        $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
        $featured_products = \App\Models\Product::where('feature', 1)->where('active',1)->latest()->paginate(12); // Ensure it's always passed
        $stockRequests = \App\Models\ProductStockRequest::where('user_id', Auth::id())->latest()->paginate(20); // Ensure it's always passed
        $products = \App\Models\Product::all(); // Add this line

        $activeTab = 'order'; 

        return view('user.dashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab', 'type','featured_products', 'stockRequests', 'products'));

    }
    
    public function editMyInformation()
    {
        $user = Auth::user();
        $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
        $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
        $orders = $user->orders()->latest()->paginate(30);
        $featured_products = \App\Models\Product::where('feature', 1)->where('active',1)->latest()->paginate(12);
        $stockRequests = \App\Models\ProductStockRequest::where('user_id', Auth::id())->latest()->paginate(20); // Initialize
        $products = \App\Models\Product::all(); // Add this line

        $activeTab = 'edit'; 

        return view('user.dashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab', 'featured_products', 'stockRequests', 'products'));
    }

    public function idcard()
    {
        $user = Auth::user();
        $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
        $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
        $orders = $user->orders()->latest()->paginate(30);

        $activeTab = 'edit'; 

        return view('user.idcard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab'));
    }

    public function featureProducts()
    {
        $user = Auth::user();
        $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
        $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
        $orders = $user->orders()->latest()->paginate(30);
        $featured_products = Product::where('feature', 1)->where('active',1)->latest()->paginate(12);
        $stockRequests = \App\Models\ProductStockRequest::where('user_id', Auth::id())->latest()->paginate(20); // Initialize
        $products = \App\Models\Product::all(); // Add this line

        $activeTab = 'feature_products'; 

        return view('user.dashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab', 'featured_products', 'stockRequests', 'products'));
    }

    public function stockRequests()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(30);
        $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
        $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
        $featured_products = collect(); // Initialize as empty collection
        $products = \App\Models\Product::all(); // Add this line

        $stockRequests = \App\Models\ProductStockRequest::with('product')->where('user_id', Auth::id())->latest()->paginate(20);

        $activeTab = 'stock_requests'; 

        return view('user.dashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab', 'stockRequests', 'featured_products', 'products'));
    }

    // public function createStockRequestForm()
    // {
    //     $user = Auth::user();
    //     $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
    //     $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
    //     $orders = $user->orders()->latest()->paginate(30);
    //     $featured_products = collect(); // Initialize as empty collection
    //     $stockRequests = collect(); // Initialize as empty collection

    //     $products = \App\Models\Product::all(); // Products needed for the form

    //     $activeTab = 'create_stock_request'; 

    //     return view('user.dashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab', 'featured_products', 'stockRequests', 'products'));
    // }

    public function createStockRequestForm()
    {
        $user = Auth::user();
        $todayOrdersCount = $user->orders()->whereDate('created_at', now()->toDateString())->count();
        $cancelOrdersCount = $user->orders()->where('order_status', 'cancelled')->count();
        $orders = $user->orders()->latest()->paginate(30);
        $featured_products = collect(); // Initialize as empty collection
        $stockRequests = \App\Models\ProductStockRequest::with('product')->where('user_id', Auth::id())->latest()->paginate(20); // Initialize as empty collection

        $products = \App\Models\Product::all(); // Products needed for the form

        $activeTab = 'create_stock_request'; 

        return view('user.dashboard', compact('user', 'todayOrdersCount', 'cancelOrdersCount', 'orders', 'activeTab', 'featured_products', 'stockRequests', 'products'));
    }


    public function changeMyInformation(Request $request)
    {
        $user = Auth::user();


        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|unique:users,mobile,' . $user->id,
            'image'  => 'nullable|image|max:2048',
            'address'      => 'required|string|max:500',
            'father_name'  => 'required|string',
            'reg_date'     => 'required|date',
            'bkash_number' => 'required|string|max:20',
            'dob'          => 'required|date',
            'blood_group'  => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            toast('Something went wrong!', 'error');
            return back()->withErrors($validator)->withInput();
        }

        // Update basic info
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->mobile = $request->mobile;
        $user->father_name   = $request->father_name;

        $user->bkash_number   = $request->bkash_number;
        $user->address  = $request->address;
        $user->reg_date = $request->reg_date;

        $user->dob  = $request->dob;
        $user->blood_group = $request->blood_group;

       

        // Password update only if filled
        if ($request->filled('old_password') || $request->filled('new_password') || $request->filled('confirm_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                alert()->error('Current password is incorrect!');
                return back()->withInput();
            }

            if ($request->new_password !== $request->confirm_password) {
                alert()->error('New password and confirmation do not match!');
                return back()->withInput();
            }

            if (Hash::check($request->new_password, $user->password)) {
                alert()->error('New password cannot be the same as the old password!');
                return back()->withInput();
            }

            // Set new password
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        alert()->success('Profile updated successfully!');
        return redirect()->back();
    }


    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = Auth::user();

        $file = $request->file('image');
        $imageName  = time() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put('users/' . $imageName, File::get($file));
        $user->image = $imageName;

        $user->save();

        return response()->json(['success' => true, 'image' => $imageName]);
    }


    public function idcardPdf()
    {
        $user = Auth::user();
        $pdf = PDF::loadView('user.idcard_pdf', compact('user'));
        return $pdf->stream('idcard.pdf');
    }


    
    public function logOut(){
        Session::flush();
        Auth::user()->carts()->delete();
        Auth::logout();
        return redirect('/');
    }

    
}
