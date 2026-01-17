<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SystemController extends Controller
{
    public function index(Request $request)
    {
        $view = "System/Index";
        return Inertia::render($view);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'       => 'required|string|max:50',
            'name'       => 'required|string|max:255',
            'code'       => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        dd($request->all());
    }
}
