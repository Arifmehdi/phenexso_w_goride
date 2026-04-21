<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;
    protected $fillable =['user_id','role_name','role_value','added_by_id','edited_by_id'];
    private static $role;

    public static function newRole($request){
        self::basicInfo(new Role(), $request);
    }
    public static function updateRole($request,$id){
        self::basicInfo(Role::find($id), $request);
    }

    private static function basicInfo($role,$request){
        if($request->user_id){
            $role->user_id=$request->user_id;
        }
        else{
            $role->user_id=$role->user->id;
        }
        if($request->role_name=='admin'){
            $role->role_name='admin';
            $role->role_value='Admin';
        }
        if($request->role_name=='blog_admin'){
            $role->role_name='blog_admin';
            $role->role_value='BlogAdmin';
        }
        if($request->role_name=='user'){
            $role->role_name='user';
            $role->role_value='User';
        }
        if($request->role_name=='retailer'){
            $role->role_name='retailer';
            $role->role_value='Retailer';
        }

        if($request->added_by_id){
            $role->added_by_id=$request->added_by_id;
        }
        if($request->edited_by_id){
            $role->edited_by_id=$request->edited_by_id;
        }
//        dd($role);
        $role->save();
    }
//    public static function defaultRole(){
//        self::$role=new Role();
//        self::$role->role_name='User';
//        self::$role->role_value='Viewer';
//        self::$role->save();
//    }
    public static function deleteRole($id){
        self::$role=Role::find($id);
        self::$role->delete();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
