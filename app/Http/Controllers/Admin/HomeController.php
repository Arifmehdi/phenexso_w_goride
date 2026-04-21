<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\BisesoggoCategory;
use App\Models\BlogPost;
use App\Models\BookAppointment;
use App\Models\ContactUs;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Member;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        menuSubmenu('dashboardM','dashboardSM');
        $users = User::get()->count();
        $cat = ProductCategory::where('parent_id', null)->get()->count();
        $productcount = Product::get()->count();
        $orders = Order::get()->count();
        $products = Product::latest()->take(10)->get();
        return view('admin.index',compact('users','cat','products', 'orders', 'productcount'));
    }



    public function selectTagsOrAddNew(Request $request)
    {

        $tags = Tag::where('name', 'like', '%'.$request->q.'%')
        ->select(['name'])->take(30)->get();

        if($tags->count())
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
        else
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
    }


    public function selectAuthorsOrAddNew(Request $request)
    {

        $tags =Author::where('name', 'like', '%'.$request->q.'%')
        ->select(['name'])->take(30)->get();
        if($tags->count())
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
        else
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
    }


    public function allAppointments(){
        menuSubmenu('appointments','allAppointments');
        $data['appointments'] = BookAppointment::paginate(50);
        return view('admin.appointments.index',$data);
    }


    public function deleteAppointment($id){
        $appointment = BookAppointment::find($id);
        $appointment->delete();
        return back()->with("success","Appointment Delated Successfuly");
    }


}
