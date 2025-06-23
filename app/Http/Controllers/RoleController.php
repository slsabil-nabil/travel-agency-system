<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RoleController extends Controller
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

        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
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

        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
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

        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        // استرجاع الصلاحيات من الـ IDات وتحويلها إلى كائنات
        if ($request->has('permissions')) {
            $permissions = Permission::findMany($request->permissions);
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'تم إنشاء الدور بنجاح.');
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

        $role = Role::findOrFail($id); // جلب الدور أولاً
        $role->load('permissions'); // تحميل الصلاحيات المرتبطة بالدور

        $allPermissions = Permission::all(); // جلب كل الصلاحيات

        return view('roles.show', compact('role', 'allPermissions'));
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

        $role = Role::findOrFail($id); // جلب الدور أولاً
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
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

        $role = Role::findOrFail($id); // جلب الدور أولاً

        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update(['name' => $validated['name']]);

        if (isset($validated['permissions'])) {
            // ✅ هذا هو التعديل: نحول الـ IDs إلى كائنات Permission
            $permissions = Permission::whereIn('id', $validated['permissions'])->get();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]); // نزيل كل الصلاحيات
        }

        return redirect()->route('roles.index')->with('success', 'تم تحديث الدور بنجاح.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = User::with('roles', 'agency');
        $currentUser = Auth::user(); // تم التغيير هنا

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
        
        $role = Role::findOrFail($id);

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'تم حذف الدور بنجاح.');
    }
}
