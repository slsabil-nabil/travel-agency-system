@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4" dir="rtl">
        <h1 class="text-2xl font-bold mb-6 text-center">تعديل الحجز</h1>

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="customer_name" class="block text-gray-700 font-bold mb-2">اسم العميل</label>
                <input type="text" name="customer_name" value="{{ $booking->customer_name }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="destination" class="block text-gray-700 font-bold mb-2">الوجهة</label>
                <input type="text" name="destination" value="{{ $booking->destination }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
            </div>

            <div class="mb-6">
                <label for="travel_date" class="block text-gray-700 font-bold mb-2">تاريخ السفر</label>
                <input type="date" name="travel_date" value="{{ $booking->travel_date }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    تحديث
                </button>
            </div>
        </form>
    </div>
@endsection
