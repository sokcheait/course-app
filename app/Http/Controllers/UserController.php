<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Team;

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
        $filed = $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'max:50',
                'email',
                'unique:users',
            ],
            'password' => [
                'required',
                'string',
                'same:password_confirmation',
                'min:6',             // must be at least 6 characters in length
                // 'regex:/[a-z]/',      // must contain at least one lowercase letter
                // 'regex:/[A-Z]/',      // must contain at least one uppercase letter
                // 'regex:/[0-9]/',      // must contain at least one digit
                // 'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'password_confirmation' => [
                'required',
                'min:6',
            ],
            'roles' => ['required']
        ]);
        $user =app(User::class)->create([
            'name' => $filed['name'],
            'email' => $filed['email'],
            'password' => bcrypt($filed['password'])
        ]);
        app(Team::class)->forceCreate([
            'user_id' => $user->id,
            'name' => $user->name."'s Team",
            'personal_team' => true
        ]);
        $user->assignRole($filed['roles']);
        return redirect()->route('users.index');
    }

}
