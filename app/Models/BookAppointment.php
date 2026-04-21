<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'appointment_date',
        'doctor_id',
        'department_id',
        'doctor_fee',
        'message',
        'payment_status',
        'order_status',
        'chambar_location',
        'chamber_schedule',
        'paid_amount',
        'transaction_id',
        'whatsapp_number',
        'editedby_id'
    ];

    public function department(){
        return $this->belongsTo(BisesoggoCategory::class, 'department_id');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
