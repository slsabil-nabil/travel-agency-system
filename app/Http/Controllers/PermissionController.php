<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions.view')->only(['index', 'show']);
        $this->middleware('permission:permissions.edit')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'guard_name' => 'required|string',
        ]);

        Permission::create($validated);

        return redirect()->route('permissions.index')->with('success', 'تم إنشاء الصلاحية بنجاح.');
    }

    public function show(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.show', compact('permission'));
    }

    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|string',
        ]);

        $permission->update($validated);

        return redirect()->route('permissions.index')->with('success', 'تم تعديل الصلاحية بنجاح.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'تم حذف الصلاحية بنجاح');
    }
}
