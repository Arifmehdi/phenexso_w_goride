<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Driver; // Import Driver model

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'email',
        'address_title',
        'subtotal',
        'grand_total',
        'payment_method',
        'payment_status',
        'payment_gateway',
        'delivery_cost',
        'addedby_id',
        'editedby_id',
        'order_note',
        'payment_trx_id',
        'seller_id',
        'rider_id',
        'driver_id',
        'vehicle_id',
        'assigned_at',
        'pending_at',
        'confirmed_at',
        'ready_to_ship_at',
        'shiped_at',
        'delivered_at',
        'canceled_at',
        'order_status',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'pending_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'ready_to_ship_at' => 'datetime',
        'shiped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'canceled_at' => 'datetime',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function driver()
    // {
    //     return $this->belongsTo(Driver::class);
    // }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id');
       
    }

    public function due()
    {
        return $this->grand_total - $this->payments()->sum('paid_amount');
       
    }

    public function paid()
    {
        return  $this->payments()->sum('paid_amount');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}