<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmbulanceService;
use App\Models\BisesoggoCategory;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogSubCategory;
use App\Models\BookAppointment;
use App\Models\ContactUs;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Member;
use App\Models\membership;
use App\Models\MembershipPackage;
use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function globalSearchAjax(Request $request)
    {
        $q = $request->q;
        $type = $request->type;


        if(!$request->ajax())
        {
            return back();
        }

        if($type == 'user')
        {
            $users = User::where('name', 'like', "%". $q."%")
            ->orWhere('email', 'like', "%". $q ."%")
            ->orWhere('id', 'like', "%". $q ."%")
            ->orderBy('name')
            ->paginate(100);
            // $users->appends(['q'=> $q, 'type'=>$type]);
            $html = view('admin.users.search_data', ['users' => $users]);
        }
        elseif($type == 'post')
        {
             $blog_posts = BlogPost::where('title', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('title')
             ->paginate(100);
             $html = view('admin.blog-post.search_data', ['blog_posts' => $blog_posts]);
        }

        elseif($type == 'category')
        {
             $blog_categories = BlogCategory::where('name', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name')
             ->paginate(100);
             $html = view('admin.blog-category.search_data', ['blog_categories' => $blog_categories]);
        }


        elseif($type == 'department')
        {
             $departments = BisesoggoCategory::where('name_en', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name_en')
             ->paginate(100);
             $html = view('admin.departments.search_data', ['departments' => $departments]);
        }

        elseif($type == 'hospital')
        {
             $hospitals = Hospital::where('name_en', 'like', "%". $q."%")
             ->orWhere('name_bn', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name_en')
             ->paginate(100);
             $html = view('admin.hospital.search_data', ['hospitals' => $hospitals]);
        }


        elseif($type == 'doctor')
        {
             $doctors = Doctor::where('name_en', 'like', "%". $q."%")
             ->orWhere('email', 'like', "%". $q."%")
             ->orWhere('mobile', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name_en')
             ->paginate(100);
             $html = view('admin.doctor.search_data', ['doctors' => $doctors]);
        }

        elseif($type == 'visit')
        {
             $visits = Visit::where('patient_name', 'like', "%". $q."%")
             ->orWhere('patient_mobile', 'like', "%". $q."%")
             ->orWhere('patient_details', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('patient_name')
             ->paginate(100);
             $html = view('admin.visit.search_data', ['visits' => $visits]);
        }



        elseif($type == 'subCategory')
        {
             $blog_sub_categories = BlogSubCategory::where('name', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name')
             ->paginate(100);
             $html = view('admin.blog-sub-category.search_data', ['blog_sub_categories' => $blog_sub_categories]);
        }

        elseif($type == 'menu')
        {
             $menus = Menu::where('name', 'like', "%". $q."%")
             ->orWhere('type', 'like', "%". $q ."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name')
             ->paginate(100);
             $html = view('admin.menu.search_data', ['menus' => $menus]);
        }

        elseif($type == 'page')
        {
             $pages = Page::where('name', 'like', "%". $q."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name')
             ->paginate(100);
             $html = view('admin.page.search_data', ['pages' => $pages]);
        }


        elseif($type == 'ambulance')
        {
             $ambulances = AmbulanceService::where('name', 'like', "%". $q."%")
             ->orWhere('email', 'like', "%". $q ."%")
             ->orWhere('mobile', 'like', "%". $q ."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name')
             ->paginate(100);
             $html = view('admin.ambulances.search_data', ['ambulances' => $ambulances]);
        }


        elseif($type == 'appointment')
        {
             $appointments = BookAppointment::where('name', 'like', "%". $q."%")
             ->orWhere('email', 'like', "%". $q ."%")
             ->orWhere('mobile', 'like', "%". $q ."%")
             ->orWhere('id', 'like', "%". $q ."%")
             ->orderBy('name')
             ->paginate(100);
             $html = view('admin.appointments.search_data', ['appointments' => $appointments]);
        }


        return response()->json([
            'success' => true,
            'html' => $html->render()
        ]);
    }
}
