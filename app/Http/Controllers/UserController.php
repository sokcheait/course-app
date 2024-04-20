<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $view = "Users/Index";
        return Inertia::render($view);
    }

    public function create()
    {
        $view = "Users/Create";
        $roles = app(Role::class)->all();
        return Inertia::render($view,['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        // $user = app(User::class)->create($data);
        dd($request->all());
    }

}
