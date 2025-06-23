<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:agencies.view')->only(['index', 'show']);
        $this->middleware('permission:agencies.create')->only(['create', 'store']);
        $this->middleware('permission:agencies.edit')->only(['edit', 'update']);
        $this->middleware('permission:agencies.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Agency::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        $bookings = $query->latest()->paginate(10); // حسب ما يناسبك
        $agencies = \App\Models\Agency::latest()->paginate(10);
        return view('agencies.index', compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $query = Agency::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
        return view('agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $query = Agency::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        \App\Models\Agency::create($request->only(['name', 'email', 'phone', 'address']));

        return redirect()->route('agencies.index')->with('success', 'تم إضافة الوكالة بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $query = Agency::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Agency $agency)
    {
        $query = Agency::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
        return view('agencies.edit', compact('agency'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Agency $agency)
    {
        $query = Agency::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $agency->update($request->only(['name', 'email', 'phone', 'address']));

        return redirect()->route('agencies.index')->with('success', 'تم تعديل بيانات الوكالة بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Agency $agency)
    {
        $query = Agency::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
        $agency->delete();

        return redirect()->route('agencies.index')->with('success', 'تم حذف الوكالة بنجاح');
    }
}
