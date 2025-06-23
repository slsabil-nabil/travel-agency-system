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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $query = Invoice::with('agency');

        if (!$user->hasRole('system_admin')) {
            $query->where('agency_id', $user->agency_id);
        }

        $invoices = $query->latest()->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
