<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bookings.view')->only(['index', 'show']);
        $this->middleware('permission:bookings.create')->only(['create', 'store']);
        $this->middleware('permission:bookings.edit')->only(['edit', 'update']);
        $this->middleware('permission:bookings.delete')->only(['destroy']);
    }

    public function index()
    {
        $currentUser = Auth::user();
        $query = Booking::query();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }

        $bookings = $query->latest()->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'destination'   => 'required|string|max:255',
            'travel_date'   => 'required|date',
            'price'         => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        $booking = new Booking([
            'customer_name' => $request->customer_name,
            'destination'   => $request->destination,
            'travel_date'   => $request->travel_date,
            'price'         => $request->price,
            'agency_id'     => $user->hasRole('system_admin') ? ($request->agency_id ?? null) : $user->agency_id,
        ]);

        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'تم إنشاء الحجز بنجاح.');
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $booking->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $booking->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'destination'   => 'required|string|max:255',
            'travel_date'   => 'required|date',
        ]);

        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $booking->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        $booking->update([
            'customer_name' => $request->customer_name,
            'destination'   => $request->destination,
            'travel_date'   => $request->travel_date,
        ]);

        return redirect()->route('bookings.index')->with('success', 'تم تعديل الحجز بنجاح.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        if (!$user->hasRole('system_admin') && $user->agency_id !== $booking->agency_id) {
            abort(403, 'لا تملك الصلاحية');
        }

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'تم حذف الحجز بنجاح.');
    }
}
