<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteParameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebsiteParameterController extends Controller
{
    public function websiteparam(){
        menuSubmenu('websiteparam','websiteparamSM');
        $websiteParameter = WebsiteParameter::first();
        return view('admin.websiteparam',compact('websiteParameter'));
    }

    public function update(Request $request, $id){

        $wp = WebsiteParameter::find($request->id);

        $wp->website_title = $request->website_title;
        $wp->shipping_charge = $request->shipping_cahrge;
        $wp->google_search_console = $request->google_search_console;
        $wp->google_analytics_code = $request->google_analytics_code;
        $wp->facebook_pixel_code = $request->facebook_pixel_code;
        $wp->meta_author = $request->meta_author;
        $wp->meta_description = $request->meta_description;
        $wp->footer_copyright = $request->footer_copyright;
        $wp->fb_url = $request->fb_url;
        $wp->contact_mobile = $request->contact_mobile;
        $wp->contact_email = $request->contact_email;
        $wp->contact_address = $request->contact_address;
        $wp->twitter_url = $request->twitter_url;
        $wp->youtube_url = $request->youtube_url;

        //For SEO START
        $wp->twitter_title = $request->twitter_title;
        $wp->twitter_description = $request->twitter_description;
        $wp->twitter_creator = $request->twitter_creator;
        $wp->og_title = $request->og_title;
        $wp->og_description = $request->og_description;


        $wp->about_title  = $request->about_title;
        $wp->about_subtitle = $request->about_subtitle;
        $wp->about_img = $request->about_us_image;

        $wp->editedby_id = Auth::id();



        if ($request->hasFile('logo')) {
            if ($wp->logo) {
                Storage::delete('public/wp/'.$wp->logo);
            }
            $file = $request->logo;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "logo" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->logo = $imageName;
        }
        if ($request->hasFile('logo_alt')) {
            if ($wp->logo_alt) {
                Storage::delete('public/wp/'.$wp->logo_alt);
            }
            $file = $request->logo_alt;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "logo-alt" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->logo_alt = $imageName;
        }
        if ($request->hasFile('favicon')) {
            if ($wp->favicon) {
                Storage::delete('public/wp/'.$wp->favicon);
            }
            $file = $request->favicon;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "favicon" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->favicon = $imageName;
        }



         if ($request->hasFile('eccomerce_img')) {
            if ($wp->eccomerce_img) {
                Storage::delete('public/wp/'.$wp->eccomerce_img);
            }
            $file = $request->eccomerce_img;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "eccomerce_img" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->eccomerce_img = $imageName;
        }
        if ($request->hasFile('hospital_img')) {
            if ($wp->hospital_img) {
                Storage::delete('public/wp/'.$wp->hospital_img);
            }
            $file = $request->hospital_img;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "hospital_img" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->hospital_img = $imageName;
        }
        if ($request->hasFile('ambulance_img')) {
            if ($wp->ambulance_img) {
                Storage::delete('public/wp/'.$wp->ambulance_img);
            }
            $file = $request->ambulance_img;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "ambulance_img" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->ambulance_img = $imageName;
        }

        if ($request->hasFile('doctor_img')) {
            if ($wp->doctor_img) {
                Storage::delete('public/wp/'.$wp->doctor_img);
            }
            $file = $request->doctor_img;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "doctor_img" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->doctor_img = $imageName;
        }


        if ($request->hasFile('diagnostic_img')) {
            if ($wp->diagnostic_img) {
                Storage::delete('public/wp/'.$wp->diagnostic_img);
            }
            $file = $request->diagnostic_img;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "diagnostic_img" . time() . $ext;
            $file->storeAs('wp', $imageName,'public');
            $wp->diagnostic_img = $imageName;
        }

        if ($request->hasFile('about_us_image')) {
            // Delete the old image if it exists
            if ($wp->about_img && Storage::exists('public/wp/' . $wp->about_img)) {
                Storage::delete('public/wp/' . $wp->about_img);
            }

            $file = $request->about_us_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "about_img" . time() . $ext;

            $file->storeAs('wp', $imageName, 'public');
            $wp->about_img = $imageName; // Save new image
        } else {
            // Keep the old image if no new one is uploaded
            $wp->about_img = $wp->getOriginal('about_img');
        }

                $wp->save();
                return redirect()->back()->with('success','website parameter updated');
            }
        }
