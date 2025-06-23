<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users.view'])->only(['index', 'show']);
        $this->middleware(['permission:users.create'])->only(['create', 'store']);
        $this->middleware(['permission:users.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:users.delete'])->only(['destroy']);
    }

    public function index()
    {
        $query = User::with('roles', 'agency');
        $user = Auth::user();

        if (!$user->hasRole('system_admin')) {
            $query->where('agency_id', $user->agency_id);
        }

        $users = $query->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $agencies = Agency::all();

        return view('users.create', compact('roles', 'agencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:8',
            'roles'      => 'required|array',
            'agency_id'  => 'nullable|exists:agencies,id',
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'agency_id'  => $request->agency_id,
        ]);

        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        $user->syncRoles($roleNames);

        return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $userRoles = $user->roles->pluck('id')->toArray();
        $agencies = Agency::all();

        return view('users.edit', compact('user', 'roles', 'userRoles', 'agencies'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'nullable|confirmed|min:8',
            'roles'      => 'required|array',
            'agency_id'  => 'nullable|exists:agencies,id',
        ]);

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'agency_id'  => $request->agency_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        $user->syncRoles($roleNames);

        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح.');
    }

    public function show(User $user)
    {
        $roles = $user->roles->pluck('name')->toArray();
        $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();

        return view('users.show', compact('user', 'roles', 'permissions'));
    }

    public function destroy(User $user)
    {
        if ($user->id == 1) {
            return redirect()->back()->with('error', 'لا يمكن حذف هذا المستخدم.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }
}
