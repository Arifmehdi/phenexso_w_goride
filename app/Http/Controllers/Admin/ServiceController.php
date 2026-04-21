<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Hospital;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('services','allHospitals');
        $data['hospitals'] = Hospital::latest()->paginate(50);
        return view('admin.service.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('services','createHospitals');
        $data['divisions'] = Division::latest()->get();
        return view('admin.service.create',$data);
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
            'name_en'=> 'string|required',
            'image'=> 'required|image',
            // 'address_en'=> 'required',
            // 'upazila_id'=> 'required',
            // 'district_id'=> 'required',
        ]);


        $hospital= new Hospital();
        $hospital->name_en = $request->name_en;
        $hospital->name_bn = $request->name_bn ?? null;
        $hospital->description_en = $request->description_en;
        $hospital->description_bn = $request->description_bn ?? null;
        $hospital->excerpt_en = $request->excerpt_en;
        $hospital->excerpt_bn = $request->excerpt_bn ?? null;
        // $hospital->address_en = $request->address_en;
        // $hospital->address_bn = $request->address_bn ?? null;
        // $hospital->division_id = $request->division_id;
        // $hospital->district_id = $request->district_id;
        // $hospital->upazila_id = $request->upazila_id;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('hospital_images/' . $imageName, File::get($file));
            $hospital->image = $imageName;
        }

        $hospital->addedby_id = Auth::id();

        if($request->hospital_contacts)
        {
            $hospital->hospital_contacts = implode(', ',$request->hospital_contacts);
        }else
        {
            $hospital->hospital_contacts = null;
        }


        $hospital->save();
        return redirect()->route('services.index')->with("success","Service Created Successfuly");

    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        menuSubmenu('services','allhospitals');
        $data['hospital'] = Hospital::find($id);
        // $data['divisions'] = Division::latest()->get();
        // $data['districts'] = District::latest()->get();
        // $data['upazilas'] = Upazila::latest()->get();
        return view('admin.service.edit',$data);
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

        $request->validate([
            'name_en'=> 'string|required',
            'image'=>'nullable|sometimes',
            // 'address_en'=> 'required',
            // 'upazila_id'=> 'required',
            // 'district_id'=> 'required',
        ]);

        $hospital= Hospital::find($id);
        $hospital->name_en = $request->name_en;
        $hospital->name_bn = $request->name_bn ?? null;
        $hospital->description_en = $request->description_en;
        $hospital->description_bn = $request->description_bn ?? null;
        $hospital->excerpt_en = $request->excerpt_en;
        $hospital->excerpt_bn = $request->excerpt_bn ?? null;
        // $hospital->address_en = $request->address_en;
        // $hospital->address_bn = $request->address_bn ?? null;
        // $hospital->division_id = $request->division_id;
        // $hospital->district_id = $request->district_id;
        // $hospital->upazila_id = $request->upazila_id;
        $hospital->active = $request->active ? true:false;

        if ($request->hasFile('image')) {
            $old_file = 'hospital_images/' . $hospital->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('hospital_images/' . $imageName, File::get($file));
            $hospital->image = $imageName;
        }

        $hospital->editedby_id = Auth::id();

        if($request->hospital_contacts)
        {
            $hospital->hospital_contacts = implode(', ',$request->hospital_contacts);
        }else
        {
            $hospital->hospital_contacts = null;
        }


        $hospital->save();
        return redirect()->back()->with("success","Service Created Successfuly");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hospital = Hospital::find($id);
        if ($hospital->image) {
            $old_file = 'hospital_images/' . $hospital->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
        }

        $hospital->delete();
        return back()->with("success","Service Delated Successfuly");
    }


    public function getDivision(Request $request){
        $district = District::where('division_id',$request->division_id)->get();
        return response()->json($district);
    }

    public function getDistrict(Request $request){
        $upazila = Upazila::where('district_id',$request->district_id)->get();
        return response()->json($upazila);
    }



    public function hospitalActive(Request $request){
        if($request->mode=='true'){
            DB::table('hospitals')->where('id',$request->id)->update(['active'=>1]);
        }
        else{
            DB::table('hospitals')->where('id',$request->id)->update(['active'=>0]);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }



    public function hospitalAllVisits($id){
         menuSubmenu('visits', 'allVisits');
         $data['hospital'] = $hospital = Hospital::find($id);
         $data['visits']   = $hospital->visits()->paginate(50);
         return view('admin.hospital.allvisits',$data);
    }

    public function hospitalAllDoctors($id){
        menuSubmenu('doctors','allDoctors');
        $data['hospital'] = $hospital = Hospital::find($id);
        $data['doctors']  = $hospital->doctors()->paginate(50);
        return view('admin.hospital.alldoctors',$data);
   }

}
