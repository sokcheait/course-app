<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Jobs\CreatePermissionJob;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $view = "Roles/Index";
        return Inertia::render($view);
    }

    public function create()
    {
        $view = "Roles/Create";
        $list_permissions = config('set-permission.permissions');
        CreatePermissionJob::dispatch();
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
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index');
    }
}
