<?php

namespace App\Http\Controllers;

use App\models\Rolem;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function getUsersRole()
    {
        $user_arr = json_decode(json_encode(User::where('branch_id', Auth::user()->branch_id)->get()), true);
        return $user_arr;

    }

    public function getPermissions()
    {
        return Permission::all();
    }

    public function store(Request $request)
    {
        // return $request->all();
        // $this->Validate($request, [
        //     'form.name' => 'required',
        // ]);
        $role = Role::create(['name' => $request->form['name']]);
        $role->givePermissionTo($request->selected);
        // $role = Role::create(['name' => 'super-admin']);
        // $role->givePermissionTo(Permission::all());

        return $role;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rolem  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $role = Role::find($id);
        $role->name = $request->form['name'];
        $role->save();
        $role->syncPermissions($request->selected);
        return $role;
    }

    public function destroy(Rolem $role)
    {
        // return $role->id;
        Role::find($role->id)->delete();
    }

    public function getRoles()
    {
        return Role::all();
    }

    public function getRolesPerm(Request $request)
    {
        // return $request->all();
        return Role::findByName($request->name)->permissions->pluck('name');
    }

    public function assignR(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {

            $user->assignRole('New');
        }
    }

}
