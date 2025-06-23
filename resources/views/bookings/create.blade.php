@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4" dir="rtl">
        <h1 class="text-2xl font-bold mb-6 text-right">إضافة حجز جديد</h1>

        <div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">اسم العميل</label>
                    <input type="text" name="customer_name" id="customer_name" class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <div>
                    <label for="destination" class="block text-sm font-medium text-gray-700 mb-1">الوجهة</label>
                    <input type="text" name="destination" id="destination" class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
                <div>
    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">السعر</label>
    <input type="number" name="price" id="price" class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
</div>


                <div>
                    <label for="travel_date" class="block text-sm font-medium text-gray-700 mb-1">تاريخ الحجز</label>
                    <input type="date" name="travel_date" id="travel_date" class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
