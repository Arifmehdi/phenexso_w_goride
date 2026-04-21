<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;
    private static $user;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'father_name',
        'address',
        'present_address',
        'permanent_address',
        'reg_date',
        'nid',
        'tin_number',
        'bkash_number',
        'mobile',
        'dob',
        'ssc_passing',
        'ssc_registration',
        'blood_group',
        'license_no',
        'image',
        'role',
        'is_approve',
        'short_bio',
        'vehicle_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_approve' => 'boolean',
    ];

    public static function createUser($request){
        self::$user=new User();
        self::$user->name=$request->name;
        self::$user->email=$request->email;
        self::$user->password=bcrypt($request->password);
        self::$user->save();

    }
    public static function updateUser($request,$id){
        self::$user=User::find($id);
        self::$user->name=$request->name;
        self::$user->email=$request->email;
        self::$user->mobile=$request->mobile;
        self::$user->save();
    }
    public static function changePassword($request,$id){
        self::$user=User::find($id);
        self::$user->password=bcrypt($request->password);
        self::$user->save();
    }
    public static function deleteUser($id){
        self::$user=User::find($id);
        self::$user->delete();
    }
 

    public function roles(){
        return $this->hasMany(Role::class,'user_id','id');
    }

    public function hasRole($role){
        return (bool) $this->roles()->where('role_name',$role)->count();
    }
    public function hasAnyRole(){
        return (bool) $this->roles()->count();
    }


    public function locations()
    {
        return $this->hasMany(DeliveryLocation::class);
    }



    public function fi()
    {
        return $this->image ?: 'profile.jpg';
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ApiResetPasswordNotification($token));
    }

 


    public function doctor(){
        return $this->hasOne(Doctor::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }


     public function carts()
    {
        return $this->hasMany(Cart::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function assignedOrders()
    {
        return $this->hasMany(Order::class, 'driver_id');
    }


    public function idcard()
    {
        return $this->hasOne(IdCard::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    
    // conversation , message , chat method 
    // Add to your existing User model
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_participants');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function productsAsSeller()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function productsAsRider()
    {
        return $this->hasMany(Product::class, 'rider_id');
    }
    

}
