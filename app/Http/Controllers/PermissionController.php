<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'guard_name' => 'required|string',
        ]);

        Permission::create($validated);

        return redirect()->route('permissions.index')->with('success', 'تم إنشاء الصلاحية بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

         $permission = Permission::findOrFail($id);
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        $permission = Permission::findOrFail($id); // ✅

        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|string',
        ]);

        $permission->update($validated);

        return redirect()->route('permissions.index')->with('success', 'تم تعديل الصلاحية بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'تم حذف الصلاحية بنجاح');
    }
}
