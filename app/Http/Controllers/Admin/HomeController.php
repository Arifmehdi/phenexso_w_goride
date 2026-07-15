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
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Driver;
use App\Models\Corporate;
use App\Models\Admin;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        menuSubmenu('dashboardM','dashboardSM');
        $users = User::count();
        $drivers = Driver::count();
        $corporates = Corporate::count();
        $admins = Admin::count();

        $cat = ProductCategory::where('parent_id', null)->count();
        $productcount = Product::count();
        $orders = Order::count();
        $products = Product::latest()->take(10)->get();

        // ── Ride-share dashboard data ──
        $rideModel = \App\Models\RideRequest::class;
        $today = \Illuminate\Support\Carbon::today();
        $monthStart = \Illuminate\Support\Carbon::now()->startOfMonth();

        $ride = [
            'today_rides'      => $rideModel::whereDate('created_at', $today)->count(),
            'today_revenue'    => (float) $rideModel::where('status', 'completed')
                                    ->whereDate('completed_at', $today)->sum('fare'),
            'month_revenue'    => (float) $rideModel::where('status', 'completed')
                                    ->where('completed_at', '>=', $monthStart)->sum('fare'),
            'total_completed'  => $rideModel::where('status', 'completed')->count(),
            'active_rides'     => $rideModel::whereIn('status', ['accepted', 'arriving', 'in_progress'])->count(),
            'cancelled_today'  => $rideModel::where('status', 'cancelled')->whereDate('updated_at', $today)->count(),
            'online_drivers'   => Driver::where('is_online', true)->count(),
            'new_users_today'  => User::whereDate('created_at', $today)->count(),
        ];

        // Pending approvals (drivers/users awaiting activation)
        $pendingApprovals = User::where(function ($q) {
            $q->whereIn('status', ['pending', 0, '0', 'inactive'])->orWhere('is_approve', 0);
        })->count();

        // Rides per weekday (last 7 days) for the mini bar chart
        $weekly = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = \Illuminate\Support\Carbon::today()->subDays($i);
            $weekly[] = [
                'label'   => $d->format('D'),
                'rides'   => $rideModel::whereDate('created_at', $d)->count(),
                'revenue' => (float) $rideModel::where('status', 'completed')->whereDate('completed_at', $d)->sum('fare'),
            ];
        }
        $weeklyMax = max(1, collect($weekly)->max('rides'));

        // Recent rides table
        $recentRides = $rideModel::with(['user:id,name,mobile', 'driver:id,name'])
            ->latest()->take(8)->get();

        return view('admin.index', compact(
            'users', 'drivers', 'corporates', 'admins', 'cat', 'products', 'orders', 'productcount',
            'ride', 'pendingApprovals', 'weekly', 'weeklyMax', 'recentRides'
        ));
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
