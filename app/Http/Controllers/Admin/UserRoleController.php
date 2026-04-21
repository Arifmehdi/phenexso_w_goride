<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function allUser(){
        return view('admin.userroles.index',['users'=>User::all(),'roles'=>Role::all()]);
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'role_name'   => 'required|string|max:255',
            'added_by_id' => 'required|exists:users,id',
        ]);

        Role::create([
            'user_id'      => $request->user_id,
            'role_name'    => strtolower($request->role_name),
            'role_value'   => ucfirst($request->role_name),
            'added_by_id'  => $request->added_by_id,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        menuSubmenu('roles', 'assignRole');

        return redirect('/admin/assign/role')
            ->with('success', 'Successfully added role');
    }


    public function userRole(){
        menuSubmenu('roles', 'assignRole');
        return view('admin.userroles.assign',[
            'users'=>User::select(['id','email','name'])->get(),
            // 'roles'=>Role::all()
            'roles' => Role::select('role_name', 'role_value')->distinct()->get()

        ]);
    }
    public function manageRole(){
        menuSubmenu('roles', 'allRoles');
        return view('admin.userroles.role_manage',['roles'=>Role::all()]);
    }
    public function editRole($id){
        menuSubmenu('roles', 'allRoles');
        return view('admin.userroles.edit',[
            'role'=>Role::find($id),
            'users'=>User::all(),
            // 'roles'=>Role::all()
            'roles' => Role::select('role_name', 'role_value')->distinct()->get()
        ]);
    }

    // public function updateRole(Request $request,$id)
    // {
    //     dd($request->all());
    //     Role::updateRole($request,$id);
    //     menuSubmenu('roles', 'allRoles');
    //     return redirect('/admin/manage/role')->with('success','Successfully Updated');
    // }

    public function updateRole(Request $request, $id)
    {
        $data = $request->except('_token', 'edited_by_id', 'role_name');

        // Get the dynamic user_id (165)
        $userId = array_key_first($data);

        Role::where('id', $id)->update([
            'user_id'      => $userId,
            'role_name'    => $request->role_name,
            'role_value'   => ucfirst($request->role_name),
            'edited_by_id' => $request->edited_by_id,
            'updated_at'   => now(),
        ]);

        menuSubmenu('roles', 'allRoles');

        return redirect('/admin/manage/role')
            ->with('success', 'Successfully Updated');
    }


    public function deleteRole($id){
        Role::deleteRole($id);
        menuSubmenu('roles', 'allRoles');
        return redirect('/admin/manage/role')->with('success','Successfully Deleted');
    }

}
