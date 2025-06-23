<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:invoices.view')->only(['index', 'show']);
        $this->middleware('permission:invoices.create')->only(['create', 'store']);
        $this->middleware('permission:invoices.edit')->only(['edit', 'update']);
        $this->middleware('permission:invoices.delete')->only(['destroy']);
    }

    public function index()
    {
        $user = Auth::user();
        $query = Invoice::query();

        if (!$user->hasRole('system_admin')) {
            $query->where('agency_id', $user->agency_id);
        }

        $invoices = $query->latest()->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        $user = Auth::user();

        $invoice = new Invoice([
            'client_name' => $request->client_name,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'agency_id' => $user->hasRole('system_admin') ? ($request->agency_id ?? null) : $user->agency_id,
        ]);

        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'تم إنشاء الفاتورة بنجاح.');
    }

    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $invoice->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        return view('invoices.show', compact('invoice'));
    }

    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $invoice->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        $invoice = Invoice::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $invoice->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        $invoice->update([
            'client_name' => $request->client_name,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('invoices.index')->with('success', 'تم تعديل الفاتورة بنجاح.');
    }

    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $invoice->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'تم حذف الفاتورة بنجاح.');
    }
}
