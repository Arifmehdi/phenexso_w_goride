<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request){
        menuSubmenu('users', 'allUsers');

        if($request->id){
           $data['users'] = User::where('id',$request->id)->paginate(10);
        }else{
            $data['users'] = User::latest()->paginate(50);
        }

        return view('admin.users.index',$data);
    }
    public function show($id){
        menuSubmenu('users', 'allUsers');

        return view('admin.users.view',['user'=>User::find($id)]);
    }
    public function create(){
        menuSubmenu('users', 'createUser');

        return view('admin.users.create');
    }
    public function store(Request $request){
        menuSubmenu('users', 'createUser');

        $this->validate($request,[
            'name'=>'required|string',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8',
        ]);

        $pass = rand(10000000,99999999);
        $user = new User;
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->password_temp =  $pass;
        $user->password = Hash::make($pass);
        $user->save();
        return redirect('/admin/user/create')->with('success','Successfully User Created');
    }
    public function edit($id){
        menuSubmenu('users', 'allUsers');
        return view('admin.users.edit',['user'=>User::find($id)]);
    }
    public function update(Request $request, $id){
// dd($request->all());
        menuSubmenu('users', 'allUsers');

        $this->validate($request,[
            'name'   => 'required|string',
            'email'  => Rule::unique('users','email')->ignore($id),
            'mobile' => 'required',
        ]);

        User::updateUser($request, $id);
     
        return redirect('/admin/users')->with('success','Successfully User Updated');
    }
    public function changePassword(Request $request, $id){
         menuSubmenu('users', 'allUsers');

        $this->validate($request,[
            'password'=>'required|confirmed|min:6',
            'password_confirmation' => 'required| min:6'
        ]);

        User::changePassword($request, $id);
       
        return redirect('/admin/users')->with('success','Successfully Password Updated');
    }

    public function delete($id){
        User::deleteUser($id);
        menuSubmenu('users', 'allUsers');
        return redirect('/admin/users')->with('success','Successfully Deleted');
    }

    public function toggleApproval(User $user){
        $user->is_approve = !$user->is_approve;
        $user->save();

        return back()->with('success', 'User approval status updated successfully.');
    }
}
