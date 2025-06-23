<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Booking::with('agency');
        $currentUser = Auth::user();

        if (!$currentUser->hasRole('system_admin')) {
            $query->where('agency_id', $currentUser->agency_id);
        }
        $bookings = $query->latest()->paginate(10);

        return view('bookings.index', compact('bookings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'travel_date' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        $booking = new Booking([
            'customer_name' => $request->customer_name,
            'destination' => $request->destination,
            'travel_date' => $request->travel_date,
            'price' => $request->price,
        ]);

        if (!$user->hasRole('system_admin')) {
            $booking->agency_id = $user->agency_id;
        } else {
            $booking->agency_id = $request->agency_id ?? null;
        }

        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'تم إنشاء الحجز بنجاح.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        $user = Auth::user();
        if (!$user->hasRole('system_admin') && $booking->agency_id !== $user->agency_id) {
            abort(403, 'غير مصرح لك بعرض هذا الحجز.');
        }

        return view('bookings.show', compact('booking'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        // تأكد أن المستخدم لا يقدر يعدل على حجز من وكالة غير وكالته (إلا إذا كان مدير النظام)
        $user = Auth::user();
        if (!$user->hasRole('system_admin') && $booking->agency_id !== $user->agency_id) {
            abort(403, 'غير مصرح لك بالوصول إلى هذا الحجز.');
        }

        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'travel_date' => 'required|date',
        ]);

        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        // التأكد من الملكية
        if (!$user->hasRole('system_admin') && $booking->agency_id !== $user->agency_id) {
            abort(403, 'غير مصرح لك بتعديل هذا الحجز.');
        }

        $booking->update([
            'customer_name' => $request->customer_name,
            'destination' => $request->destination,
            'travel_date' => $request->travel_date,
        ]);

        return redirect()->route('bookings.index')->with('success', 'تم تعديل الحجز بنجاح.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $booking = Booking::findOrFail($id);

    $user = Auth::user();
    if (!$user->hasRole('system_admin') && $booking->agency_id !== $user->agency_id) {
        abort(403, 'غير مصرح لك بحذف هذا الحجز.');
    }

    $booking->delete();

    return redirect()->route('bookings.index')->with('success', 'تم حذف الحجز بنجاح.');
}

}
