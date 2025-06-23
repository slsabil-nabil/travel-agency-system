@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6" dir="rtl">
        <h1 class="text-3xl font-extrabold text-right text-gray-800 mb-8">تفاصيل الحجز</h1>

        <div class="bg-white shadow-md rounded-2xl p-6 space-y-6 border border-gray-100 text-right">
            <div>
                <label class="block text-gray-600 font-semibold mb-1">اسم العميل:</label>
                <p class="text-gray-900">{{ $booking->customer_name }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold mb-1">الوجهة:</label>
                <p class="text-gray-900">{{ $booking->destination }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold mb-1">تاريخ السفر:</label>
                <p class="text-gray-900">{{ $booking->travel_date }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold mb-1">تاريخ الإنشاء:</label>
                <p class="text-gray-900">{{ $booking->created_at->format('Y-m-d') }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold mb-1">الوكالة:</label>
                <p class="text-gray-900">{{ $booking->agency->name ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('bookings.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-xl shadow">
                العودة للقائمة
            </a>
        </div>
    </div>
@endsection
