<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Team;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    public function __construct()
    {
        //  $this->middleware('permission:users.index|users.create|users.edit|users-destroy', ['only' => ['index','show']]);
        //  $this->middleware('permission:users.create', ['only' => ['create','store']]);
        //  $this->middleware('permission:users.edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:users.destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $this->authorize('users.index');
        $query = User::query();
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }
        if ($request->filled('dateRange')) {
            $query->where('created_at', '>=', now()->subDays($request->dateRange));
        }
        if ($request->filled('searchQuery')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->searchQuery}%")
                ->orWhere('email', 'like', "%{$request->searchQuery}%");
            });
        }
        $perPage = $request->input('per_page', 10);
        $users = $query->paginate($perPage)->withQueryString();
        $view = "Users/Index";
        return Inertia::render($view)->with(['users' => $users]);
    }

    public function create()
    {
        $this->authorize('users.create');
        $view = "Users/Create";
        $roles = app(Role::class)->all();
        return Inertia::render($view,['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $this->authorize('users.store');
        $filed = $request->validate([
            'name' => 'required|string|min:3',
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

    public function edit($id)
    {

    }

    public function importUser(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);
        Excel::queueImport(new UsersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Users imported successfully');
    }
}
