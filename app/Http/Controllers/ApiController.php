<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\OfficeLocation;
use App\Models\User;
use App\Models\UserLocation;
use App\Models\Location;
use App\Models\VisitPlan;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function trackingData(Request $request)
    {

        // dd(Carbon::parse(time())->format('Y-m-d'));
        // dd($request->all(), time());
        $l = new Location;
        $l->lat = $request->latitude;
        $l->lng = $request->longitude;
        $l->name = $request->user_id;
        $l->created_at = $request->timestamp;
        $l->save();
        
        

        if (!$request->user_id || !$request->latitude || !$request->longitude || !$request->timestamp) {
            return response()->json([
                'success' => false, 
            ], 200);
        }
        
        // $this->lSet($request->user_id, $request->latitude, $request->longitude, $request->timestamp);
        $this->locationSet($request->user_id, $request->latitude, $request->longitude, $request->timestamp);

        return response()->json([
            'success' => true,
        ], 200);

        // $locations = json_decode($request->locations);
        // foreach ($locations as  $location) {
        //     $user = User::find($location->user);
        //     if ($user) {
        //         $this->locationSet($location->user, $location->lat, $location->lng, $location->date);
        //     } else {
        //         return response()->json([
        //             'success' => false,
        //             'message' => "User Not Found"
        //         ]);
        //     }
        // }
    }

    public function lSet( $u, $lat, $lng, $date )
    {
        $date = $date ?: now();
        $user = User::find($u);
        if($user)
        {
            if($user->employee)
            {
                if($lat and $lng)
                {
                    $location = new UserLocation;
                    $location->lat = $lat;
                    $location->lng = $lng;
                    $location->ip = request()->ip();
                    $location->data_by = 'android_app';
                    $location->user_id = $user->id;
                    $location->date = Carbon::parse($date)->format('Y-m-d');
                    $location->addedby_id = Auth::id();
                    $location->created_at = $date;
                    $location->office_location_id = $user->employee->office_location_id;
                    $location->save();

                    return response()->json([
                        'success' => true,
                        'lat' => $location->lat,
                        'lng' => $location->lng,
                        'isApp' => 1
                    ]);
                }
            }
        }

        return response()->json([
            'success' => false,
        ]);
    }


    public function locationSet($u, $lat, $lng, $timestamp)
    {
        
        $user = User::with('employee')->where('id', $u)->first();
        
        $date = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
        
        // dd($date, $user);

        if ($user) 
        {
            $employee = $user->employee;

            if($employee)
            {
                if ($lat and $lng) 
                {
                    
                
                    //Attandance Tracking Start
                    if ($employee->attendanceOfficeLocation) 
                    {        
                        
                    
                        $radius = .2;
                        $haversine = "(6371 * acos(cos(radians(" . $lat . "))
                                    * cos(radians(`lat`))
                                    * cos(radians(`lng`)
                        - radians(" . $lng . "))
                        + sin(radians(" . $lat . "))
                                    * sin(radians(`lat`))))";

                        $officeLocation = OfficeLocation::where('id', $employee->office_location_id)
                        ->where('active', true)
                        ->where('company_id', $employee->company_id)
                        ->select('id', 'lat', 'lng', 'title')
                        ->whereRaw("{$haversine} < ?", [$radius])
                        ->selectRaw("{$haversine} AS distance")
                        ->latest()
                        ->orderBy('distance')
                        ->first();
                        
                    
                        
                        if ($officeLocation) 
                        {
                            
                        //   $aa =  Carbon::createFromTimestamp($date)->toDateTimeString();
                           
                        //   dd($aa);
                          
                            $attendance = Attendance::where('user_id', $user->id)
                            ->whereDate('date', Carbon::createFromTimestamp($timestamp)->toDateString())
                            ->first(); 
                            
                            // dd($attendance,'ok');
                            
                            if ($attendance) 
                            {
                                $attendance->lat = $officeLocation->lat;
                                $attendance->lng = $officeLocation->lng;
                                $attendance->ip = request()->ip();
                                $attendance->logged_out_at = $date;
                                $attendance->save();
                            } else 
                            {
                                $attendance = new Attendance;
                                $attendance->user_id = $user->id;
                                $attendance->date = $date;
                                $attendance->employee_id = $employee->id;
                                $attendance->office_location_id = $employee->office_location_id;
                                $attendance->company_id = $employee->company_id;
                                $attendance->lat = $officeLocation->lat;
                                $attendance->lng = $officeLocation->lng;
                                $attendance->ip = request()->ip();
                                $attendance->logged_in_at = $date;
                                $attendance->logged_out_at = $date;
                                $attendance->save();

                                //Customized Date 21-08-2022
                                if ($attendance->office) {
                                    $attendance->office_start_time = $attendance->office->office_start_time;
                                    $attendance->office_end_time = $attendance->office->office_end_time;
                                    $attendance->office_late_time = $attendance->office->office_late_time;
                                    $attendance->office_absent_time = $attendance->office->office_absent_time;
                                }

                                if ((Carbon::parse($attendance->logged_in_at)->format('H:m:s') > $attendance->office_start_time) && (Carbon::parse($attendance->logged_in_at)->format('H:m:s') <= $attendance->office_late_time)) 
                                {
                                    $attendance->status = 'late_entry';

                                } elseif (Carbon::parse($attendance->logged_in_at)->format('H:m:s') > $attendance->office_late_time) 
                                {
                                    $attendance->status = 'absent';

                                } else {
                                    $attendance->status = 'present';
                                }

                                $attendance->save();
                                //Customized Date 21-08-2022
                                
                                
                            }
                            // dd($attendance);
                        }                        
                    }
                    //Attandance Tracking End

                    //for 3 minutes mute of data entry start
                    // $oldLocation =  UserLocation::where('user_id', $user->id)->where('date', Carbon::parse($date)->format('Y-m-d'))->whereTime('created_at', '>', Carbon::parse($date)->subMinutes(2))->first();
                    // if ($oldLocation) {
                    //     return response()->json([
                    //         'success' => false,

                    //     ]);
                    // }
                    //for 3 minutes mute of data entry end


                    // user_id
                    // lat
                    // lng
                    // ip
                    // location
                    // data_by
                    // date
                    // office_location_id
                    // addedby_id
                    // editedby_id

                    $location = new UserLocation;
                    $location->lat = $lat;
                    $location->lng = $lng;
                    $location->ip = request()->ip();
                    $location->data_by = 'android_app';
                    $location->user_id = $user->id;
                    $location->date = $date;
                    $location->addedby_id = Auth::id();
                    $location->created_at = $date;
                    $location->save();
                    
                    // dd($location);

                    

                    // Office Location track Start
                        $radius = .2;
                        $haversine = "(6371 * acos(cos(radians(" . $location->lat . "))
                                        * cos(radians(`lat`))
                                        * cos(radians(`lng`)
                        - radians(" . $location->lng . "))
                        + sin(radians(" . $location->lat . "))
                                        * sin(radians(`lat`))))";

                        $office_location = OfficeLocation::select('id', 'lat', 'lng', 'title')
                        ->where('active', true)
                        ->whereRaw("{$haversine} < ?", [$radius])
                        ->selectRaw("{$haversine} AS distance")
                        ->latest()
                        ->orderBy('distance')
                        ->first();
                        
                        // dd($office_location);
                        
                        if ($office_location) 
                        {
                            $location->location = $office_location->title;
                            $location->office_location_id = $office_location->id;
                            $location->save();
                        }
                  
                    // Office Location End

                    //Poi Api Run in background for Location name START
                    if(!$location->location)
                    {
                        
                        $this->Wo_RunInBackground(['lat' => $location->lat, 'lng' => $location->lng, 'success' => true,]);
                        $this->locationNameSet($lat, $lng, $location);
                        //Poi Api Run in background for Location name START
                    }

                    return response()->json([
                        'success' => true,
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                    ]);
                }
            }

            
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }


    public function locationNameSet($lat, $lng, $location)
    {

        $url = url("http://poi.18gps.net/poi?lat={$lat}&lon={$lng}");
        $client = new Client();
        $r = $client->request('GET', $url);
        $result = $r->getBody()->getContents();
        $location->location = $result ?? null;
        $location->save();
        if (!$location->location) {
            $this->locationNameSet2($lat, $lng, $location);
        }
    }

    public function Wo_RunInBackground($data = array())
    {
        if (!empty(ob_get_status())) {
            ob_end_clean();
            header("Content-Encoding: none");
            header("Connection: close");
            ignore_user_abort();
            ob_start();
            if (!empty($data)) {
                header('Content-Type: application/json');
                echo json_encode($data);
            }
            $size = ob_get_length();
            header("Content-Length: $size");
            ob_end_flush();
            flush();
            session_write_close();
            if (is_callable('fastcgi_finish_request')) {
                fastcgi_finish_request();
            }
        }
    }

    public function locationNameSet2($lat, $lng, $location)
    {
        // $url = url("http://poi.18gps.net/poi?lat={$request->lat}&lon={$request->lng}");
        $url = url("http://open.mapquestapi.com/geocoding/v1/reverse?key=LGIyuPsyN7sbFV4FK8OZse4XzR2NZfu5&location={$lat},{$lng}&includeRoadMetadata=true&includeNearestIntersection=true");

        $client = new Client();
        $r = $client->request('GET', $url);

        $result = $r->getBody()->getContents();

        $result = json_decode($result);


        $locationObj = $result->results[0]->locations[0];

        $street =  $locationObj->street;
        $city = $locationObj->adminArea5;
        $postalCode = $locationObj->postalCode;
        $division = $locationObj->adminArea3;
        $country = $locationObj->adminArea1;

        $address = $street . ", " . $city . "-" . $postalCode . ", " . $division . ", " . $country . ".";

        $location->location = $result ?? '';
        $location->save();
    }
    

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
                [
                    'username' => 'required',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['username', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Username & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('username', $request->username)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    
}
