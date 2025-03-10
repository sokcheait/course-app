<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Team;
use Illuminate\Validation\ValidationException;

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
        // dd($request);
        $this->authorize('users.index');
        $view = "Users/Index";
        $users = User::paginate(10);
        return Inertia::render($view)->with(['users' => $users]);
        // return response()->json([
        //     'message' => 'User created successfully!',
        //     'redirect' => route('users.index'), // URL to redirect to
        //     'users' => $users, // Optionally return the created user data
        // ]);
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

    public function storeDynamicForm(Request $request)
    {
        // Get all input data
        $data = $request->all();

        // Initialize validation rules
        $rules = [];
        $messages = [];

        // Iterate through input data
        foreach ($data as $key => $items) {
            if (is_array($items)) {
                foreach ($items as $index => $item) {
                    foreach ($item as $fieldKey => $fieldValue) {
                        if (array_key_exists('value', $fieldValue)) {
                            $rule = '';

                            // Add 'required' rule if specified and value is empty
                            if (isset($fieldValue['required']) && $fieldValue['required']) {
                                $rule .= 'required|';
                            }
                             // Add dynamic rules (like email)
                            if (isset($fieldValue['required']) && $fieldValue['required'] && $fieldKey === 'email') {
                                $rule .= 'email|'; // Add email rule here
                            }

                            // Check if the field contains a 'rules' key with dynamic validation rules
                            if (isset($fieldValue['rules']) && is_string($fieldValue['rules'])) {
                                $rule .= $fieldValue['rules'];
                            }

                            // Assign the rule to the corresponding validation key
                            if ($rule) {
                                $rules["$key.$index.$fieldKey.value"] = rtrim($rule, '|'); // Remove trailing pipe

                                // Custom messages
                                $fieldName = ucfirst(str_replace('_', ' ', $fieldKey)); // Format field name

                                if (strpos($rule, 'email') !== false) {
                                    $messages["$key.$index.$fieldKey.value.email"] = "The $fieldName field must be a valid email address.";
                                }
                                if (strpos($rule, 'required') !== false) {
                                    $messages["$key.$index.$fieldKey.value.required"] = "The $fieldName field is required.";
                                }
                            }
                        }
                    }
                }
            }
        }
        try {
            // $validatedData = $request->validate($rules);
            $validatedData = $request->validate($rules, $messages);
            $transformedData = $this->extractValues($data);
            dd($transformedData);

        } catch (ValidationException $e) {
            // Customize the error messages
            $errors = $e->validator->errors();
    
            // Return the customized error messages
            // return response()->json(['errors' => $customErrors], 422);
            return redirect()->back()->withErrors($errors);
        }
        //  $validatedData = $request->validate($rules);
         dd($validatedData);

    }

    // Helper function to recursively extract 'value' fields
    private function extractValues(array $data): array
    {
        $result = [];

        foreach ($data as $key => $items) {
            if (is_array($items)) {
                foreach ($items as $subKey => $subItems) {
                    if (is_array($subItems)) {
                        foreach ($subItems as $field => $attributes) {
                            // Check if 'value' exists in attributes and assign it to result
                            // if (isset($attributes['value'])) {
                                $result[$key][$field] = $attributes['value'];
                            // }
                        }
                    }
                }
            }
        }

        return $result;
    }

}
