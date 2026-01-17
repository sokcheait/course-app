<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Inertia\Inertia;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $query = Country::query();
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }
        // if ($request->filled('dateRange')) {
        //     $query->where('created_at', '>=', now()->subDays($request->dateRange));
        // }
        // if ($request->filled('searchQuery')) {
        //     $query->where(function($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->searchQuery}%");
        //     });
        // }
        $perPage = $request->input('per_page', 10);
        $countres = $query->paginate($perPage)->withQueryString();
        $view = "Countres/Index";
        return Inertia::render($view,[
            'countres' => $countres
        ]);
    }
}
