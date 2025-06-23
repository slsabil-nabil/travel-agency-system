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

    public function index()
    {
        $query = Agency::query();
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('id', $currentUser->agency_id);
        }

        $agencies = $query->latest()->paginate(10);
        return view('agencies.index', compact('agencies'));
    }

    public function create()
    {
        return view('agencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Agency::create($request->only(['name', 'email', 'phone', 'address']));

        return redirect()->route('agencies.index')->with('success', 'تم إضافة الوكالة بنجاح');
    }

    public function show($id)
    {
        $agency = Agency::findOrFail($id);
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin') && $currentUser->agency_id !== $agency->id) {
            abort(403, 'لا تملك الصلاحية');
        }

        return view('agencies.show', compact('agency'));
    }

    public function edit(Agency $agency)
    {
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin') && $currentUser->agency_id !== $agency->id) {
            abort(403, 'لا تملك الصلاحية');
        }

        return view('agencies.edit', compact('agency'));
    }

    public function update(Request $request, Agency $agency)
    {
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin') && $currentUser->agency_id !== $agency->id) {
            abort(403, 'لا تملك الصلاحية');
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

    public function destroy(Agency $agency)
    {
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin') && $currentUser->agency_id !== $agency->id) {
            abort(403, 'لا تملك الصلاحية');
        }

        $agency->delete();

        return redirect()->route('agencies.index')->with('success', 'تم حذف الوكالة بنجاح');
    }
}
