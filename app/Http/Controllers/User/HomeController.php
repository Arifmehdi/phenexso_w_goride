<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function profileEdit(){
        menuSubmenu('users', 'profileEdit');
        return view('user.edit',['user'=>User::find(auth()->user()->id)]);
    }
    public function profileUpdate(Request $request, $id){

        $this->validate($request,[
            'name'=>'required|string',
            'email'=>'nullable',Rule::unique('users')->ignore(User::find($id)),
        ]);
        User::updateUser($request, $id);
        menuSubmenu('users', 'profileEdit');
        return redirect('user/profile-edit/')->with('success','Successfully User Updated');
    }

    public function changePassword(Request $request, $id){
        $user=User::find($id);
        if(password_verify($request->old_password,$user->password)){
            User::changePassword($request, $id);
            menuSubmenu('users', 'profileEdit');
            return redirect('/user/profile-edit/')->with('success','Successfully Password Updated');
        }
        menuSubmenu('users', 'profileEdit');
        return redirect('user/profile-edit/')->with('success','Password Does Not Match');
    }


    public function writercreate(Request $request){
        $writer = User::find($request->writer_id);
        if($writer->writer == 0){
            $writer->writer = 1;
            $writer->save();
        }else{
            $writer->writer = 0;
            $writer->save();
        }
         return response()->json([
            'success' => true,
         ]);
    }
}
