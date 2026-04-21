<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BisesoggoCategory;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        menuSubmenu('categories', 'allDoctors');
        if ($request->id) {
            $data['doctors'] = Doctor::where('id', $request->id)->paginate(10);
        } else {
            $data['doctors'] = Doctor::latest()->paginate(50);
        }

        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('categories', 'createDoctors');
        $data['departments'] = BisesoggoCategory::get();
        $data['hospitals'] = Hospital::get();
        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name_en'               => 'required|min:3|max:100',
            // 'email'                 => 'required|email|unique:users,email|unique:doctors,email',
            // 'mobile'                => 'required',
            // 'gender'                => 'required',
            // 'department_id'         => 'required',
            // 'designation_en'        => 'required',
            // 'hospitals'             => 'nullable',
            // 'doctor_fee'            => 'required',
            // 'chambar_location'      => 'required',

        ]);


        // $user = User::where('email', $request->email)->first();
        // if (!$user) {
        //     $pass = rand(10000000, 99999999);
        //     $user           = new User();
        //     $user->name     = $request->name_en;
        //     $user->email    = $request->email;
        //     $user->password_temp =  $pass;
        //     $user->password = Hash::make($pass);
        //     $user->save();
        // }

        $doctor = new Doctor();
        $doctor->name_en               = $request->name_en;
        $doctor->name_bn               = $request->name_bn ?? null;
        $doctor->description_en        = $request->description_en;
        $doctor->description_bn        = $request->description_bn ?? null;
        $doctor->excerpt_en            = $request->excerpt_en;
        $doctor->excerpt_bn            = $request->excerpt_bn ?? null;
        // $doctor->email                 = $request->email;
        // $doctor->department_id         = $request->department_id;
        // $doctor->mobile                = $request->mobile;
        // $doctor->whatsapp_number       = $request->whatsapp_number;
        // $doctor->doctor_fee            = $request->doctor_fee;
        // $doctor->chambar_location      = $request->chambar_location;
        // $doctor->designation_en        = $request->designation_en ?? null;
        // $doctor->designation_bn        = $request->designation_bn ?? null;
        // $doctor->gender                = $request->gender;
        $doctor->addedby_id            = Auth::id();
        // $doctor->user_id               = $user->id;

        if ($request->hasFile('doctor_image')) {
            $file = $request->doctor_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('doctor_images/' . $imageName, File::get($file));
            $doctor->doctor_image = $imageName;
        }

        $doctor->save();

        // if ($request->has('hospitals') && is_array($request->hospitals)) {
        //     foreach ($request->hospitals as $key => $hospital) {
           
        //         if (! $doctor->hospitals()->where('hospital_id', $hospital)->exists()) {
        //             $doctor->hospitals()->attach($hospital, [
        //                 'addedby_id' => Auth::id(),
        //             ]);
        //         }
        //     }
        // }


        return redirect()->route('categories.index')->with('success', 'Category Create Successfully');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        menuSubmenu('categories', 'allDoctors');
        $data['doctor'] = Doctor::find($id);
        $data['departments'] = BisesoggoCategory::get();
        $data['hospitals'] = Hospital::get();
        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        
        // dd($request->all());
        $request->validate([
            'name_en'               => 'required|min:3|max:100',
            // 'mobile'                => 'required',
            // 'gender'                => 'required',
            // 'department_id'         => 'required',
            // 'designation_en'        => 'required',
            // 'hospitals'             => 'nullable',
            // 'doctor_fee'            => 'required',
            // 'chambar_location'      => 'required',
        ]);



        $doctor = Doctor::find($id);
        $doctor->name_en               = $request->name_en;
        $doctor->name_bn               = $request->name_bn ?? null;
        $doctor->description_en        = $request->description_en;
        $doctor->description_bn        = $request->description_bn ?? null;
        $doctor->excerpt_en            = $request->excerpt_en;
        $doctor->excerpt_bn            = $request->excerpt_bn;
        // $doctor->designation_en        = $request->designation_en;
        // $doctor->designation_bn        = $request->designation_bn ?? null;
        // $doctor->department_id         = $request->department_id;
        // $doctor->mobile                = $request->mobile;
        // $doctor->whatsapp_number       = $request->whatsapp_number;
        // $doctor->doctor_fee            = $request->doctor_fee;
        // $doctor->chambar_location      = $request->chambar_location;
        // $doctor->designation_en        = $request->designation_en ?? null;
        // $doctor->designation_bn        = $request->designation_bn ?? null;
        // $doctor->gender                = $request->gender;
        $doctor->editedby_id           = Auth::id();

        if ($request->hasFile('doctor_image')) {
            $old_file = 'doctor_images/' . $doctor->doctor_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->doctor_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('doctor_images/' . $imageName, File::get($file));
            $doctor->doctor_image = $imageName;
        }


        $doctor->save();

        // $doctor->hospitals()->detach($doctor->hospitals);

        // if ($request->has('hospitals') && is_array($request->hospitals)) {
        //     foreach ($request->hospitals as $key => $hospital) {
        //         if (! $doctor->hospitals()->where('hospital_id', $hospital)->exists()) {
        //             $doctor->hospitals()->attach($hospital, [
        //                 'addedby_id' => Auth::id(),
        //             ]);
        //         }
        //     }
        // }


        return redirect()->back()->with('success', 'Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = doctor::find($id);
        if ($doctor->image) {
            $old_file = 'doctor_images/' . $doctor->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
        }

        $doctor->delete();
        return back()->with("success", "Category Delated Successfuly");
    }


    public function DoctorActive(Request $request)
    {

        if ($request->mode == 'true') {
            DB::table('doctors')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('doctors')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Successfully updated status', 'status' => true]);
    }


    public function doctorAllVisits($id)
    {
        menuSubmenu('visits', 'allVisits');
        $data['doctor'] = $doctor = Doctor::find($id);
        $data['visits']  = $doctor->visits()->paginate(50);
        return view('admin.category.allvisits', $data);
    }
}
