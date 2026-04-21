<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookAppointment;
use Karim007\SslCommerz\SslCommerz;

class AppointmentController extends Controller
{
    // AJAX Form Submit + Payment Initiate
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
            'appointment_date' => 'required|date',
            'doctor_id' => 'required',
            'department_id' => 'required',
            'doctor_fee' => 'required',
        ]);

        // Save Appointment
        $appointment = BookAppointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'appointment_date' => $request->appointment_date,
            'doctor_id' => $request->doctor_id,
            'department_id' => $request->department_id,
            'doctor_fee' => $request->doctor_fee,
            'message' => $request->message,
            'payment_status' => 'pending',
            'chambar_location' => $request->chambar_location ?? '',
        ]);

        // Payment Data
        $post_data = [
            'total_amount' => $appointment->doctor_fee,
            'currency' => 'BDT',
            'tran_id' => 'APP'.$appointment->id,
            'success_url' => route('appointment.success'),
            'fail_url' => route('appointment.fail'),
            'cancel_url' => route('appointment.cancel'),
            'cus_name' => $appointment->name,
            'cus_email' => $appointment->email,
            'cus_phone' => $appointment->mobile,
        ];

        // Initiate Payment
        $sslcommerz = new SslCommerz();
        $payment_url = $sslcommerz->makePayment($post_data, 'hosted', true);

        if($payment_url){
            return response()->json(['gateway_page_url' => $payment_url]);
        } else {
            return response()->json(['error'=>'Payment initiation failed'],500);
        }
    }

    // Payment Success
    public function paymentSuccess(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $appointmentId = str_replace('APP','',$tran_id);

        $appointment = BookAppointment::find($appointmentId);
        if($appointment){
            $appointment->payment_status = 'paid';
            $appointment->save();
        }

        return redirect()->route('home')->with('success','Appointment booked & Payment Successful!');
    }

    // Payment Fail
    public function paymentFail(Request $request)
    {
        return redirect()->route('home')->with('error','Payment Failed!');
    }

    // Payment Cancel
    public function paymentCancel(Request $request)
    {
        return redirect()->route('home')->with('error','Payment Cancelled!');
    }
}
