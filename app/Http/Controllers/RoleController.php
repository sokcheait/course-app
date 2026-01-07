<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Jobs\CreatePermissionJob;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = app(Role::class)->isUser()->paginate(10);
        $view = "Roles/Index";
        return Inertia::render($view,[
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $view = "Roles/Create";
        $list_permissions = config('set-permission.permissions');
        $multi_dimensional_array = array_values($list_permissions);
        $single_array = array_merge(...$multi_dimensional_array);
        $array_keys = array_keys($single_array);
        $permiss = Permission::whereNotIn('name',$array_keys)->count();
        if($permiss>0){
            CreatePermissionJob::dispatch();
        }
        return Inertia::render($view,[
            'list_permissions' => $list_permissions
        ]);
    }
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index');
    }
    public function edit($id)
    {
        $role = app(Role::class)->with('permissions')->find($id);
        $role = [
            'id' => $role->id,
            'name' => $role->name,
            'is_active' => $role->is_active,
            'permissions' => $role->permissions->pluck('name')->toArray(),
        ];
        $list_permissions = config('set-permission.permissions');
        $view = "Roles/Edit";

        // $multi_dimensional_array = array_values($list_permissions);
        // $single_array = array_merge(...$multi_dimensional_array);
        // $array_keys = array_keys($single_array);
        // $permiss = Permission::whereNotIn('name',$array_keys)->count();
        // if($permiss>0){
        //     CreatePermissionJob::dispatch();
        // }
        return Inertia::render($view,[
            'role' => $role,
            'list_permissions' => $list_permissions
        ]);
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
        $role = app(Role::class)->with('permissions')->find($id);
        $role->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $role = app(Role::class)->with('permissions')->find($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
