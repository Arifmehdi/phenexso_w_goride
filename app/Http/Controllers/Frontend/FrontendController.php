<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AmbulanceService;
use App\Models\BookAppointment;
use App\Models\Cart;
use App\Models\DeliveryLocation;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Page;
use App\Models\Product;
use App\Models\District;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\shippingMethod;
use App\Models\WebsiteParameter;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Alert;
use App\Models\Department;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Doctor;
use App\Models\FrontSlider;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationEmail;
use App\Models\Testimonial;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware('locale');
    }

    public function index()
    {
        // $data['categories'] = ProductCategory::where('active', 1)
        //     ->whereHas('products') // only categories that have at least one product
        //     ->where('parent_id', null)
        //     ->select('id', 'name_en', 'name_bn', 'slug', 'image') // select needed fields
        //     ->get();
        // $data['products'] = Product::whereActive(true)->get();
        
                // Get all active categories with their products
    $data['categories'] = ProductCategory::where('active', true)
        ->with(['products' => function($query) {
            $query->where('active', true)
                  ->select('products.id', 'products.name_en',  'products.slug', 'products.featured_image', 'products.price', 'products.discount_price') // Select only needed fields
                  ->take(8); // Limit products per category
        }])
        ->whereHas('products', function($query) { // Only categories that have products
            $query->where('active', true);
        })
        ->select('id', 'name_en', 'name_bn', 'slug') // Select category fields
        ->get();

        // dd($data['categories']);

        $data['feature_products'] = Product::whereActive(true)->where('feature',true)->limit(20)->get();

        $data['departments'] = Department::whereActive(true)
            ->select('image','name_en','name_bn','excerpt_en')
            ->get();
        
        $data['testimonials'] = Testimonial::whereActive(true)
            ->latest()
            ->limit(5)
            ->select('id','name','designation','image','text_en','designation')
            ->get();

        $data['newses'] = BlogPost::whereActive(true)->limit(5)->get();
        $data['sliders'] = FrontSlider::whereActive(true)
            ->select('featured_image','title','description','link')
            ->get();

        return view('goride.index', $data);  
    }

    // For lazy loading products via AJAX
    public function getProductsByCategory($categoryId)
    {
        $products = Product::whereHas('categories', function($query) use ($categoryId) {
                $query->where('product_categories.id', $categoryId);
            })
            ->where('active', true)
            ->get();

        return response()->json([
            'products' => $products,
            'html' => view('frontend.partials.products-grid', compact('products'))->render()
        ]);
    }


    public function mdMessage()
    {
        $wp = WebsiteParameter::first();
        return view('website.mdMessage', compact('wp'));  
    }
    
    public function shop(Request $request)
    {
        $query = Product::whereActive(true);

        // Search
        if ($request->has('search')) {
            $query->where('name_en', 'like', '%' . $request->get('search') . '%');
        }

        // Price filter
        if ($request->has('price')) {
            $priceRange = explode('-', $request->get('price'));
            if (count($priceRange) == 2) {
                $query->whereBetween('final_price', [$priceRange[0], $priceRange[1]]);
            }
        }

        // Sorting
        if ($request->get('sort') == 1) {
            $query->latest();
        } elseif ($request->get('sort') == 2) {
            $query->oldest();
        } elseif ($request->get('sort') == 3) {
            $query->orderBy('final_price', 'desc');
        } elseif ($request->get('sort') == 4) {
            $query->orderBy('final_price', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->all());

        $categories = ProductCategory::whereActive(true)->latest()->get();
        $total_products = Product::whereActive(true)->count();
        $subcategories = ProductCategory::whereNull('parent_id')
            ->where('active', 1)
            ->orderBy('name_en')
            ->get();
        
            // Top clicked products
        $topClickedProducts = Product::where('active', true)
            ->where('feature', true)
            ->orderByDesc('click_count')
            ->limit(6)
            ->get();

        // Get all root categories for sidebar
        $allRootCategories = ProductCategory::whereNull('parent_id')
            ->where('active', 1)
            ->orderBy('name_en')
            ->get();

        return view("website.shop", compact(
            'products', 
            'categories', 
            'total_products', 
            'subcategories',
            'allRootCategories',
            'topClickedProducts' // Add this
        ));

    }

    public function quickView(Request $request)
    {
        $product = Product::with('categories')->findOrFail($request->id);

        return response()->json([
            'name'        => $product->name_en,
            'price'       => number_format($product->final_price, 2),
            'old_price'   => $product->discount > 0 ? number_format($product->price, 2) : null,
            'description' => Str::limit($product->description_en, 150),
            'image'       => route('imagecache', ['template' => 'pnism', 'filename' => $product->fi()])
        ]);
    }


    public function about()
    {
        return view('website.about' );  
    }

    public function testimonial()
    {
        $testimonials = Testimonial::latest()->get(); // Fetch all testimonials
        return view('website.testimonial', compact('testimonials'));  
    }


    // public function product()
    // {
    //     return view('frontend.product');
    // }

    public function contact()
    {
        return view('website.contact');
    }

    public function service()
    {
        $data['services'] = Hospital::latest()->whereActive(true)->get(); 
        return view('website.service', $data);
    }

    public function login()
    {
        return view('website.login');
    }



    public function page($slug)
    {
        $data['page'] = Page::whereActive('slug', $slug)->first();
        return view('frontend.home.page_content', $data);
    }

    public function websiteCompliance()
    {
      
        return view("frontend.home.websiteCompliance");
    }



    public function doctorDashboard(){
        $data['doctor'] = auth()->user()->doctor;
        return view('frontend.home.doctor-dashbord',$data);
    }


    public function profile(){
        return view('frontend.home.profile');
    }

    public function oldPassword(Request $request){
        $password = auth()->user()->password;
        if(Hash::check($request->old_pwd,$password)){
           return response()->json([
                'success' => true,
           ]);
        }else{
          return response()->json([
             'success' => false,
          ]);
        }
    }



    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
         $old_password = auth()->user()->password;
         if(Hash::check($request->old_password, $old_password)){
            if(!Hash::check($request->new_password, $old_password)){
              if($request->new_password == $request->confirm_password){
                 $user = User::find(Auth::id());
                 $user->password = Hash::make($request->new_password);
                 $user->password_temp = null;
                 $user->save();
                 return redirect()->back();
                 Alert::error('success', 'Password Change Successfully!');
                 return redirect()->back();
              }else{
                Alert::error('Error', 'New password and Confirm doed not match!');
                return redirect()->back();
              }

            }else{
                Alert::error('Error', 'New password and Current password are same');
                return redirect()->back();
            }

         }else{
            Alert::error('Error','Current password is not match');
            return redirect()->back();
         }
    }


    public function updateProfile(Request $request){
        $user = User::find(Auth::id());
        if($request->hasFile('image')){
            if ($user->image) {
                Storage::delete('public/user_images/'.$user->image);
            }
            $image = $request->file('image');
            $image_ex =  $image->getClientOriginalExtension();
            $file_path = date('ymdhis').'.'.$image_ex;
            $image->storeAs('user_images', $file_path,'public');
        }else{
            $file_path =  $user->image;
        }

        $user->image  =  $file_path;
        $user->save();
        Alert::Success('Success','Profile Update successfuly');
        return redirect()->back();
    }




   public function selectGetDoctor(Request $request){

      $hospital = Hospital::find($request->hospital_id);
      $doctors = $hospital->doctors()->get();
      return response()->json($doctors);
   }



    public function ambulanceProviderList(){
        $data['ambulances'] = AmbulanceService::whereActive(true)->get();
        return view('frontend.home.ambulanceProviderList',$data);
    }

    public function charity()
    {
        return view('frontend.home.charity');
    }
   

    public function qurbaniOccation()
    {
        $data = null;
        return view('website.qurbaniOccation');
        // $data['doctors'] =  Doctor::whereActive(true)->get();
        // $data['departments'] =  BisesoggoCategory::whereActive(true)->get();
        // return view('frontend.home.doctorList',$data);
    }

    public function qurbaniRegular()
    {
        $data = null;
        return view('website.qurbaniRegular');
        // $data['doctors'] =  Doctor::whereActive(true)->get();
        // $data['departments'] =  BisesoggoCategory::whereActive(true)->get();
        // return view('frontend.home.doctorList',$data);
    }

    public function doctorDetails($id){
        $data['doctor'] = $doctor =  Doctor::whereActive(true)->find($id);
        $data['department'] = $department = $doctor->department;
        $data['doctors'] =  Doctor::whereActive(true)->where('department_id',$department->id)->take(10)->get();
        return view('frontend.home.doctorDetails',$data);
    }


    public function doctorAppointment(){
        $data['doctors'] = Doctor::whereActive(true)->paginate(12);
        $data['departments'] = BisesoggoCategory::whereActive(true)->get();
        return view('frontend.home.doctorAppointment',$data);
    }



    public function hospitalList()
    {
        $data['hospitals'] = Hospital::whereActive(true)->paginate(12); 
        return view('frontend.home.hospitalList', $data);
    }

    public function diagnostic()
    {
        return view('frontend.home.diagnostic');
    }

    public function hospitalDetails($id)
    {
        $data['hospital'] = $hospital = Hospital::whereActive(true)->findOrFail($id);
        $data['doctors'] = $hospital->doctors()->whereActive(true)->paginate(12);

        return view('frontend.home.hospitalDetails', $data);
    }


    public function departmentList()
    {
        $data['departments'] = BisesoggoCategory::whereActive(true)->paginate(12); 
        return view('frontend.home.departmentList', $data);
    }


    // public function galleries()
    // {
    //     $path = public_path('frontend/assets/img/gallery');
    //     $files = \File::files($path);
    //     $images = [];
    //     foreach ($files as $file) {
    //         $images[] = $file->getFilename();
    //     }
    //     return view('frontend.home.gallery', compact('images'));
    // }

    public function imageGalleries()
    {
        $allGalleries = Gallery::where('active', 1)->orderBy('priority', 'asc')->get();
        $images = $allGalleries->where('file_type', 'image');
        return view('website.imagegallery', compact('images'));
    }

    public function videoGalleries()
    {
        $allGalleries = Gallery::where('active', 1)->orderBy('priority', 'asc')->get();
        $videos = $allGalleries->where('file_type', 'video');
        return view('website.videogallery', compact('videos'));
    }



    public function languageChange(Request $request)
    {
        $locale = $request->lang;

        if (in_array($locale, config('app.locales')))
        {
            // $cookie = cookie('locale', $locale, 43200)

            $request->session()->forget(['locale']);
            $request->session()->put(['locale'=>$locale]);
            // return redirect()->back()->withCookie($cookie);
        }

        return back();

    }



    public function news()
    {
        $data['news'] = BlogPost::whereActive(true)->whereStatus('published')->latest()->paginate(12);
        return view('website.blog', $data);
    }


    public function singleNews($id)
    {
        $news = BlogPost::where('id', $id)->firstOrFail();
        if (!$news) {
            abort(404);
        }
        $news->increment('view_count');

        $data['relatedPosts'] = BlogPost::where('category_id', $news->category_id)
                                ->where('id', '!=', $news->id) // exclude current post
                                ->where('active', true)        // only active posts
                                ->where('status', 'published') // only published posts
                                ->orderBy('created_at', 'desc') // latest first
                                ->take(5)                       // limit to 5 posts
                                ->get();

        $data['news'] = $news;
        return view('website.blog_details', $data);
    }



    public function supportpolicy()
    {
        $page =  Page::where('type', 'support_policy')->first();
        return view("frontend.home.policies.supportpolicy", compact('page'));
    }

    public function terms()
    {
        $page =  Page::where('type', 'terms_conditions')->first();
        return view("frontend.home.policies.terms", compact('page'));
    }

    public function privacypolicy()
    {
        $page =  Page::where('type', 'privacy_policy')->first();
        return view("frontend.home.privacypolicy", compact('page'));
    }

    public function helpcenter()
    {
        $page =  Page::where('type', 'help_center')->first();
        return view("frontend.home.helpcenter", compact('page'));
    }

    public function contactus()
    {
        $page =  Page::where('type', 'contact_us')->first();
        return view("frontend.home.policies.contactus", compact('page'));
    }

    public function aboutus()
    {
        $page =  Page::where('type', 'about_us')->first();
        return view("frontend.home.aboutus", compact('page'));
    }



    public function storeAppointment(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'mobile'           => 'required|string|max:20',
            'department_id'    => 'required|integer',
            'doctor_id'        => 'required|integer',
            'appointment_date' => 'required|date',
        ]);

        try {
            // ✅ Create new appointment
            $appointment = new BookAppointment();
            $appointment->name             = $request->name;
            $appointment->email            = $request->email;
            $appointment->mobile           = $request->mobile;
            $appointment->department_id    = $request->department_id;
            $appointment->doctor_id        = $request->doctor_id;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->message          = $request->message ?? null;
            $appointment->addedby_id       = Auth::id();
            $appointment->save();

            // ✅ Success message
            // toast('Appointment Confirmed, Your appointment has been successfully booked.','success');
            Alert::success('Appointment Confirmed', 'Your appointment has been successfully booked.');
            return redirect()->back();

        } catch (\Exception $e) {
            // ✅ Error message
            Alert::error('Something went wrong', 'We could not process your request. Please try again later.');
            return redirect()->back()->withInput();
        }
    }


    public function shasthoseba(Request $request)
    {
        $query = Product::whereActive(true);

        // Sorting
        if ($request->get('sort') == 1) {
            $query->latest();
        } elseif ($request->get('sort') == 2) {
            $query->oldest();
        } elseif ($request->get('sort') == 3) {
            $query->orderBy('final_price', 'desc');
        } elseif ($request->get('sort') == 4) {
            $query->orderBy('final_price', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->all());

        $categories = ProductCategory::whereActive(true)->latest()->get();
        $total_products = Product::whereActive(true)->count();
        $subcategories = ProductCategory::whereNull('parent_id')
            ->where('active', 1)
            ->orderBy('name_en')
            ->get();

        // Get all root categories for sidebar
        $allRootCategories = ProductCategory::whereNull('parent_id')
            ->where('active', 1)
            ->orderBy('name_en')
            ->get();

        // Top clicked products
        $topClickedProducts = Product::where('active', true)
            ->where('feature', true)
            ->orderByDesc('click_count')
            ->limit(6)
            ->get();

        return view("frontend.home.shasthoseba", compact(
            'products', 
            'categories', 
            'total_products', 
            'subcategories',
            'allRootCategories',
            'topClickedProducts' // Add this
        ));
    }


    public function productCategory(Request $request, $slug = null)
    {
        $category = null;
        $categories = collect();
        $subcategories = collect();

        $query = Product::where('active', 1);

        if ($slug && $slug !== 'all') {
            $category = ProductCategory::where('slug', $slug)
                ->where('active', 1)
                ->first();

            if ($category) {
                if (is_null($category->parent_id)) {
                    // 🟢 Case 1: Parent category — show subcategories
                    $subcategories = ProductCategory::where('parent_id', $category->id)
                        ->where('active', 1)
                        ->orderBy('name_en')
                        ->get();

                    $subcategoryIds = $subcategories->pluck('id')->toArray();

                    // Include products of parent + all its subcategories
                    $query->whereHas('categories', function ($q) use ($category, $subcategoryIds) {
                        $q->where('product_categories.id', $category->id)
                        ->orWhereIn('product_categories.id', $subcategoryIds);
                    });
                } else {
                    // 🟡 Case 2: Subcategory — only show products in that subcategory
                    $subcategories = ProductCategory::where('parent_id', $category->parent_id)
                        ->where('active', 1)
                        ->orderBy('name_en')
                        ->get();

                    $query->whereHas('categories', function ($q) use ($category) {
                        $q->where('product_categories.id', $category->id);
                    });
                }
            }
        } else {
            // 🟣 For "All" — show all root categories
            $categories = ProductCategory::whereNull('parent_id')
                ->where('active', 1)
                ->orderBy('name_en')
                ->get();
        }

        // Root categories for sidebar
        $allRootCategories = ProductCategory::whereNull('parent_id')
            ->where('active', 1)
            ->orderBy('name_en')
            ->get();

        // Sorting
        switch ($request->get('sort')) {
            case 2:
                $query->oldest();
                break;
            case 3:
                $query->orderBy('final_price', 'desc');
                break;
            case 4:
                $query->orderBy('final_price', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        // Price filter
        if ($request->has('price')) {
            $priceRange = explode('-', $request->get('price'));
            if (count($priceRange) == 2) {
                $query->whereBetween('final_price', [$priceRange[0], $priceRange[1]]);
            }
        }

        // Top clicked products
        $topClickedProducts = Product::where('active', true)
            ->where('feature', true)
            ->orderByDesc('click_count')
            ->limit(6)
            ->get();

        // Pagination and count
        $products = $query->paginate(12)->appends($request->all());
        $total_products = $query->count();

        return view('website.shop_category', compact(
            'products',
            'category',
            'categories',
            'subcategories',
            'total_products',
            'allRootCategories',
            'topClickedProducts',
            'slug'
        ));
    }



    public function productDetails(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)
            ->with('categories', 'reviews', 'media')
            ->firstOrFail();

        // Increment view count
        $product->increment('click_count');

        // Related products
        $relatedProducts = Product::whereHas('categories', function ($q) use ($product) {
                $q->whereIn('product_categories.id', $product->categories->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->where('feature', true)
            ->take(12)
            ->get();

        // Exclude current + related
        $excludeProductIds = collect([$product->id])
            ->merge($relatedProducts->pluck('id'));

        // Top clicked products
            $topClickedProducts = Product::where('active', true)
                ->whereNotIn('id', [$product->id])
                ->where('feature', true)
                ->orderByDesc('click_count')
                ->limit(3)
                ->get();


        return view('website.shop_details', compact(
            'product',
            'relatedProducts',
            'topClickedProducts'
        ));
    }


    // public function productDetails(Request $request, $slug)
    // {
    //     $product = Product::where('slug', $slug)->with('categories', 'reviews', 'media')->first();

    //     if(!$product){
    //         abort(404);
    //     }

    //     $relatedProducts = Product::whereHas('categories', function($q) use ($product) {
    //                             $q->whereIn('product_categories.id', $product->categories->pluck('id'));
    //                         })
    //                         ->where('id', '!=', $product->id)
    //                         ->where('feature', true)
    //                         ->take(12)
    //                         ->get();

    //     return view('website.shop_details', compact('product','relatedProducts'));
    // }

    public function cart()
    {
        $session_id = Session::get('session_id', function () {
            $id = Session::getId();
            Session::put('session_id', $id);
            return $id;
        });

        $user_id = Auth::id() ?? 0;

        // Fetch cart items for this user/session
        $cartItems = Cart::with('product') // make sure Cart model has 'product' relation
            ->where('session_id', $session_id)
            ->orWhere('user_id', $user_id)
            ->get();

        // Calculate totals
        $cartSubtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->final_price;
        });

        return view('website.cart', compact('cartItems', 'cartSubtotal'));
    }

        public function updateQuantity(Request $request, $cartId)
    {
        try {
            // Validate the request
            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);

            // Find the cart item
            $cartItem = Cart::where('id', $cartId);
            
            // If you have user authentication, you might want to check if the cart item belongs to the user
            if (Auth::check()) {
                $cartItem = $cartItem->where('user_id', Auth::id());
            } else {
                // For guest users, you might use session_id or other identifier
                $cartItem = $cartItem->where('session_id', session()->getId());
            }
            
            $cartItem = $cartItem->first();

            if (!$cartItem) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found!'
                ], 404);
            }

            // Check product stock if needed
            $product = $cartItem->product;
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'status' => false,
                    'message' => 'Only ' . $product->stock . ' items available in stock!'
                ]);
            }

            // Update quantity
            $cartItem->update([
                'quantity' => $request->quantity
            ]);

            // Calculate updated cart totals
            $cartItems = Cart::with('product')
                ->when(Auth::check(), function($query) {
                    $query->where('user_id', Auth::id());
                }, function($query) {
                    $query->where('session_id', session()->getId());
                })
                ->get();

            $cartSubtotal = $cartItems->sum(function($item) {
                return $item->quantity * $item->product->final_price;
            });

            return response()->json([
                'status' => true,
                'message' => 'Quantity updated successfully!',
                'cartSubtotal' => $cartSubtotal,
                'cartCount' => $cartItems->sum('quantity')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! Please try again.'
            ], 500);
        }
    }

    public function remove($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

public function update(Request $request)
{
    foreach($request->qty as $id => $qty){
        $cart = Cart::find($id);
        if($cart) $cart->update(['quantity' => $qty]);
    }
    return redirect()->back()->with('success', 'Cart updated successfully!');
}



    public function checkouts()
    {
        return view('website.checkout');
    }
 


    /**
     * Add product to cart (session/user-wise)
     */
    public function addToCart(Request $request)
    {
        // if (!Session::has('session_id')) {
        //     Session::put('session_id', session()->getId());
        // }
        // $session_id = Session::get('session_id');

        $request->validate([
            'product' => 'required|integer|exists:products,id',
            'qty'     => 'required|integer|min:1'
        ]);

        $session_id = Session::get('session_id', function () {
            $id = Session::getId();
            Session::put('session_id', $id);
            return $id;
        });

        $user_id   = Auth::id() ?? 0;
        $productId = $request->product;
        $qty = $request->qty ?? 1;

        $product = Cache::remember("product_{$productId}", now()->addMinutes(10), function () use ($productId) {
            return Product::find($productId);
        });

        if (!$product) {
            abort(404, 'Product not found');
        }

        $cart = Cart::firstOrNew([
            'product_id' => $product->id,
            'session_id' => $session_id,
            'user_id'    => $user_id,
        ]);

        $cart->quantity   = $cart->exists ? $cart->quantity + $qty : $qty;
        $cart->addedby_id = $user_id;
        $cart->save();

        if ($request->ajax()) {
            return response()->json([
                'status'          => true,
                'message'         => 'Item added to cart!',
                'productCartItem' => view('frontend.home.includes.productCartItem', compact('cart', 'product'))->render(),
                'cartCount'       => Cart::cartCount(),
                'cartItemsCount'  => Cart::CartItemsCount(),
                'cartTotal'       => Cart::totalCartPrice(),
            ]);
        }

        return response()->noContent();
    }

public function quickAdd(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:products,id'
    ]);

    $productId = $request->id;

    $session_id = Session::get('session_id', function () {
        $id = Session::getId();
        Session::put('session_id', $id);
        return $id;
    });

    $user_id = Auth::id() ?? 0;

    // Cache product
    $product = Cache::remember("product_{$productId}", now()->addMinutes(10), function () use ($productId) {
        return Product::find($productId);
    });

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Find or create cart item
    $cart = Cart::firstOrNew([
        'product_id' => $product->id,
        'session_id' => $session_id,
        'user_id'    => $user_id,
    ]);

    $cart->quantity   = $cart->exists ? $cart->quantity + 1 : 1;
    $cart->addedby_id = $user_id;
    $cart->save();

    return response()->json([
        'success' => true,
        'message' => $product->name_en . ' added to cart successfully!',
        'id'      => $product->id,
        'name'    => $product->name_en,
        'price'   => $product->final_price,
        'image'   => route('imagecache', ['template' => 'pnism', 'filename' => $product->fi()])
    ]);
}





    public function addToCart2(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'qty'        => 'required|integer|min:1'
        ]);

        $session_id = Session::get('session_id', function () {
            $id = Session::getId();
            Session::put('session_id', $id);
            return $id;
        });

        $user_id   = Auth::id() ?? 0;
        $productId = $request->product_id;

        // Cache product for 10 minutes
        $product = Cache::remember("product_{$productId}", now()->addMinutes(10), function () use ($productId) {
            return Product::find($productId);
        });

        if (!$product) {
            abort(404, 'Product not found');
        }

        // Find or create cart item
        $cart = Cart::firstOrNew([
            'product_id' => $product->id,
            'session_id' => $session_id,
            'user_id'    => $user_id,
        ]);

        // Update quantity
        $cart->quantity   = $cart->exists ? $cart->quantity + $request->qty : $request->qty;
        $cart->addedby_id = $user_id;
        $cart->save();


        return redirect()->back()->with([
            'success' => '(' . $product->name_en . ') added to cart successfully!',
        ]);
    }




    /**
     * Update cart item quantity
     */
    public function cartUpdateQty(Request $request)
    {
        
        $request->validate([
            'cart'    => 'required|integer|exists:carts,id',
            'new_qty' => 'required|integer|min:0'
        ]);

        $cart = Cart::findOrFail($request->cart);

        if ($request->new_qty == 0) {
            $cart->delete();
        } else {
            $cart->update(['quantity' => $request->new_qty]);
        }

        if ($request->ajax()) {
            return response()->json([
                'status'        => true,
                'message'       => 'Cart updated successfully!',
                'product_id'    => $cart->product_id ?? null,
                'add_to_cart_url' => route('addToCart'),
                'cartCount'       => Cart::cartCount(),
                'cartItemsCount'  => Cart::CartItemsCount(),
                'cartTotal'       => Cart::totalCartPrice(),
                'discount'        => Cart::totalDiscountAmount(),
                'payable'         => Cart::totalCartPrice() - Cart::totalDiscountAmount(),
            ]);
        }

        return response()->noContent();
    }

    /**
     * Remove a cart item
     */
     
     public function cartRemoveItem($cartId)
    {
        $cart = Cart::find($cartId);
 
        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found!'
            ], 404);
        }

        // // Security check
        // if (Auth::check() && $cart->user_id != Auth::id()) {
        //     abort(403, 'Unauthorized action. 02');
        // } elseif (!Auth::check() && $cart->session_id !== session('session_id')) {
        //     abort(403, 'Unauthorized action.');
        // }
    
        $cartId    = $cart->id;
        $productId = $cart->product_id;
    
        $cart->delete();
    
        return response()->json([
            'status'         => true,
            'message'        => 'Item removed from cart!',
            'cart_id'        => $cartId,
            'product_id'     => $productId,
            'add_to_cart_url'=> route('addToCart'),
            'cartCount'      => Cart::cartCount(),
            'cartItemsCount' => Cart::CartItemsCount(),
            'cartTotal'      => Cart::totalCartPrice(),
            'discount'       => Cart::totalDiscountAmount(),
            'payable'        => Cart::totalCartPrice() - Cart::totalDiscountAmount(),
        ]);
    }

    // public function cartRemoveItem(Cart $cart)
    // {
    //     // Security check
    //     if (Auth::check() && $cart->user_id !== Auth::id()) {
    //         abort(403, 'Unauthorized action.');
    //     } elseif (!Auth::check() && $cart->session_id !== session('session_id')) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     $cartId    = $cart->id;
    //     $productId = $cart->product_id;

    //     $cart->delete();

    //     return response()->json([
    //         'status'         => true,
    //         'message'        => 'Item removed from cart!',
    //         'cart_id'        => $cartId,
    //         'product_id'     => $productId,
    //         'add_to_cart_url'=> route('addToCart'),
    //         'cartCount'      => Cart::cartCount(),
    //         'cartItemsCount' => Cart::CartItemsCount(),
    //         'cartTotal'      => Cart::totalCartPrice(),
    //         'discount'       => Cart::totalDiscountAmount(),
    //         'payable'        => Cart::totalCartPrice() - Cart::totalDiscountAmount(),
    //     ]);
    // }


    public function checkout(Request $request)
    {

        $sessionId = session('session_id'); 
        $cartItems = Cart::with('product')
            ->when(auth()->check(), fn($q) => $q->where('user_id', auth()->id()))
            ->when(!auth()->check(), fn($q) => $q->where('session_id', $sessionId))
            ->get();

        $shippingMethods = shippingMethod::get();

        return view('frontend.home.checkout', compact( 'cartItems', 'shippingMethods'));
    }

    public function new_checkout(Request $request)
    {

        $sessionId = session('session_id'); 
        $cartItems = Cart::with('product')
            ->when(auth()->check(), fn($q) => $q->where('user_id', auth()->id()))
            ->when(!auth()->check(), fn($q) => $q->where('session_id', $sessionId))
            ->get();

        $location = null;
        if(Auth::check()){
            $location = Auth::user()->locations()->first();
        }
        $shippingMethods = shippingMethod::get();
        $districts = District::all();
        return view('frontend.home.new_checkout', compact( 'cartItems', 'shippingMethods','districts', 'location'));
    }


    
    public function storeDeliveryLocation(Request $request)
    {
       
        //  Validation
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required',
            'email'         => 'nullable|email',
            'address_title' => 'required',
        
        ]);

        // Check if delivery location exists for the user
        $location = DeliveryLocation::where('user_id', Auth::id())->first();

        // If exists, update; otherwise create new
        if (!$location) {
            $location = new DeliveryLocation();
            $location->user_id = Auth::id();
        }

        // Set common fields
        $location->name = $request->name;
        $location->email = $request->email;
        $location->mobile = $request->mobile;
        $location->address_title = $request->address_title;
        $location->save();

        return redirect()->back()->with([
            'success' => 'Delivery location saved successfully!',
        ]);
    }


    public function codOrderStore(Request $request)
    {
        $ws = WebsiteParameter::first();
        $cartItems = Cart::getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $subtotal = $this->calculateSubtotal($cartItems);
        $deliveryCost = $ws->shipping_cahrge ?? $request->shipping_price;
        $grandTotal = $subtotal + $deliveryCost;
        $paymentMethod = $request->input('payment_method');
        $orderNote = $request->order_note ?? null;

        if (Auth::check()) {
            $user = auth()->user();
            if ($request->has('billing_address')) {
                DeliveryLocation::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'address_title' => $request->input('billing_address'),
                        'name' => $request->input('name'),
                        'mobile' => $request->input('mobile'),
                        'email' => $request->input('email'),
                        // 'district_id' => $request->input('billing_district_id'),
                        // 'upazila_id' => $request->input('billing_thana_id'),
                    ]
                );
            }

            $location = $this->getUserLocation($user);

            if (!$location) {
                return redirect()->back()->with('error', 'No delivery location found.');
            }

            $order = $this->createOrder($user, $location, $deliveryCost, $paymentMethod, $subtotal, $deliveryCost, $grandTotal, $orderNote);

            $this->storeOrderItems($order, $cartItems, $user->id);
            Cart::where('user_id', $user->id)->delete();

            // Send email to admin
            Mail::to('noreply@hublibd.com')->send(new OrderConfirmationEmail($order));
            
            // Send email to customer if email is provided
            if ($order->email) {
                Mail::to($order->email)->send(new OrderConfirmationEmail($order));
            }

            return redirect()->route('user.dashboard')->with('success', 'Order placed successfully!');
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:20',
                'billing_address' => 'required|string|max:1000',
                'email' => 'nullable|email|max:255',
                // 'billing_district_id' => 'required',
                // 'billing_thana_id' => 'required',
            ]);

            $location = new \stdClass();
            $location->name = $request->input('name');
            $location->email = $request->input('email');
            $location->mobile = $request->input('mobile');
            $location->address_title = $request->input('billing_address');
            // $location->district_id = $request->input('billing_district_id');
            // $location->upazila_id = $request->input('billing_thana_id');

            $order = $this->createOrder(null, $location, $deliveryCost, $paymentMethod, $subtotal, $deliveryCost, $grandTotal, $orderNote);

            $this->storeOrderItems($order, $cartItems, null);
            Cart::where('session_id', session('session_id'))->delete();

            // Send email to admin
            Mail::to('noreply@hublibd.com')->send(new OrderConfirmationEmail($order));
            
            // Send email to customer if email is provided
            if ($location->email) {
                Mail::to($location->email)->send(new OrderConfirmationEmail($order));
            }

            return redirect()->route('shop')->with('success', 'Order placed successfully!');
        }
    }



    private function getUserLocation($user)
    {
        if ($user) {
            return $user->locations()->first();
        }
        return null;
    }


    private function calculateSubtotal($cartItems)
    {
        return $cartItems->sum(function ($cart) {
            return $cart->product->final_price * $cart->quantity;
        });
    }

    private function createOrder($user, $location, $area, $paymentMethod, $subtotal, $deliveryCost, $grandTotal, $orderNote)
    {
        return Order::create([
            'user_id'        => $user ? $user->id : null,
            'name'           => $location->name,
            'email'          => $location->email,
            'address_title'  => $location->address_title,
            'mobile'         => $location->mobile,
            // 'district_id'  => $location->district_id,
            // 'upazila_id'  => $location->upazila_id,
            'subtotal'       => $subtotal,
            'grand_total'    => $grandTotal,
            'payment_method' => $paymentMethod,
            'payment_status' => 'unpaid',
            'payment_gateway'=> $paymentMethod,
            'delivery_cost'  => $deliveryCost,
            'pending_at'     => now(),
            'addedby_id'     => $user ? $user->id : null,
            'order_note'     => $orderNote,
        ]);
    }

    private function storeOrderItems($order, $cartItems, $userId)
    {
        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id'      => $order->id,
                'user_id'       => $userId,
                'product_id'    => $cart->product_id,
                'product_name'  => $cart->product->name_en,
                'product_price' => $cart->product->final_price,
                'quantity'      => $cart->quantity,
                'total_cost'    => $cart->product->final_price * $cart->quantity,
                'addedby_id'    => $userId,
            ]);
        }
    }


    public function reviewsStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|max:1000',
        ]);

        ProductReview::create([
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }


    public function orderPrint(Order $order)
    {
        $items = $order->orderItems()->get();

        return view('user.order.orderPrint', compact('order', 'items'));
    }


     public function orderChalan(Order $order)
    {
        $items = $order->orderItems()->get();

        return view('user.order.orderChalan', compact('order', 'items'));
    }

    public function testidcard(){
          $user = User::findOrFail(136);
          return view('idcard',compact('user'));
    }

    public function getShippingMethods($upazila_id)
    {
        $upazila = Upazila::find($upazila_id);
        $area = $upazila->name;
        $shippingMethods = shippingMethod::where('name', $area)->get();
        return response()->json($shippingMethods);
    }
}