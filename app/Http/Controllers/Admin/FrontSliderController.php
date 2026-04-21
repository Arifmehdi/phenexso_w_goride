<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FrontSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenu('slider', 'allFrontSlider');
        $sliders = FrontSlider::latest()->paginate(20);
        return view('admin.sliders.index', compact('sliders'));
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
            'title'=>'required',
            'link'=>'required',
            'featured_image'=>'required|image',
        ]);

        $fSlider = new FrontSlider;
        $fSlider->title = $request->title;
        $fSlider->description = $request->description;
        $fSlider->link = $request->link;
        $fSlider->active = $request->active ? 1 : 0;

        if ($request->hasFile('featured_image')) {

            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = rand(111,555).time() . $ext;
            Storage::disk('public')->put('frontSlider/' . $imageName, File::get($file));
            $fSlider->featured_image = $imageName;
        }

        $fSlider->addedBy_id = Auth::id();
        $fSlider->save();
        return redirect()->back()->with('success','Slider Added Successfully');
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrontSlider  $frontSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $request->validate([
            'title'=>'required',
            'link'=>'required',
            'featured_image'=>'nullable|sometimes',
        ]);
        $fSlider = FrontSlider::find($id);

        $fSlider->title = $request->title;
        $fSlider->description = $request->description;
        $fSlider->link = $request->link;
        $fSlider->active = $request->active ? 1 : 0;

        if ($request->hasFile('featured_image')) {
            $old_file = 'frontSlider/' . $fSlider->featured_image;

            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = 'go-bangladesh'.time() . $ext;
            Storage::disk('public')->put('frontSlider/' . $imageName, File::get($file));
            $fSlider->featured_image = $imageName;
        }
        $fSlider->editedBy_id = Auth::id();
        $fSlider->save();
        return redirect()->back()->with('success','Slider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrontSlider  $frontSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrontSlider $slider)
    {
        $old_file = 'frontSlider/' . $slider->featured_image;

        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $slider->delete();
        return back()->with("success","Front Slider Deleted Successfuly");
    }
}
