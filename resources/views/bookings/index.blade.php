@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4" dir="rtl">
        <h1 class="text-2xl font-bold mb-6 text-center">قائمة الحجوزات</h1>

        {{-- زر إضافة حجز بمحاذاة اليمين --}}
        <div class="mb-4 text-right">
            <a href="{{ route('bookings.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                + إضافة حجز
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">اسم العميل</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">الوجهة</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">تاريخ السفر</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $booking->customer_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $booking->destination }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $booking->travel_date }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="bg-yellow-200 hover:bg-yellow-300 text-yellow-900 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">
                                    تعديل
                                </a>
                                <a href="{{ route('bookings.show', $booking->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">عرض</a>
<form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الحجز؟');" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-200 hover:bg-red-300 text-red-800 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">حذف</button>
</form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-sm text-gray-500 text-center">لا توجد حجوزات حالياً.</td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-center">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection
