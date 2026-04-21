<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\AmbulanceService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AmbulanceServiceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        menuSubmenu('ambulances', 'allAmbulances');
        if ($request->id) {
            $data['ambulances'] = AmbulanceService::where('id', $request->id)->paginate(10);
        } else {
            $data['ambulances'] = AmbulanceService::latest()->paginate(50);
        }

        return view('admin.ambulances.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('ambulances', 'createAmbulance');
        return view('admin.ambulances.create');
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
            'name'    => 'required|min:3|max:100',
            'email'   => 'required|email|unique:ambulance_services,email',
            'mobile'  => 'required',
            'tagline' => 'required',
            'address' => 'required',
            'image'   => 'required',

        ]);


        $ambulance = new AmbulanceService();
        $ambulance->name          = $request->name;
        $ambulance->mobile        = $request->mobile;
        $ambulance->description   = $request->description;
        $ambulance->excerpt       = $request->excerpt;
        $ambulance->tagline       = $request->tagline ?? null;
        $ambulance->address       = $request->address;
        $ambulance->email         = $request->email;
        $ambulance->addedby_id    = Auth::id();
    

        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('ambulance_images/' . $imageName, File::get($file));
            $ambulance->image = $imageName;
        }

        $ambulance->save();

        return redirect()->route('ambulances.index')->with('success', 'Ambulance Create Successfully');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        menuSubmenu('ambulances', 'allAmbulances');

        $data['ambulance'] = AmbulanceService::find($id);
        return view('admin.ambulances.edit', $data);
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
            'name'    => 'required|min:3|max:100',
            'email'   => 'required|email|unique:ambulance_services,email,' . $id,
            'mobile'  => 'required',
            'tagline' => 'required',
            'address' => 'required',
            'image'   => 'nullable',
        ]);


        $ambulance = AmbulanceService::find($id);
        $ambulance->name          = $request->name;
        $ambulance->mobile                = $request->mobile;
        $ambulance->description   = $request->description;
        $ambulance->excerpt       = $request->excerpt;
        $ambulance->tagline       = $request->tagline ?? null;
        $ambulance->address       = $request->address;
        $ambulance->email         = $request->email;
        $ambulance->editedby_id           = Auth::id();

        if ($request->hasFile('image')) {
            $old_file = 'ambulance_images/' . $ambulance->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('ambulance_images/' . $imageName, File::get($file));
            $ambulance->image = $imageName;
        }


        $ambulance->save();



        return redirect()->back()->with('success', 'Ambulance Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambulance = AmbulanceService::find($id);
        if ($ambulance->image) {
            $old_file = 'ambulance_images/' . $ambulance->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
        }

        $ambulance->delete();
        return back()->with("success", "Ambulance Delated Successfuly");
    }


    public function ambulanceActive(Request $request)
    {

        if ($request->mode == 'true') {
            DB::table('ambulance_services')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('ambulance_services')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Successfully updated status', 'status' => true]);
    }

}
