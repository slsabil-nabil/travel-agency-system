@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6" dir="rtl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">وكالات السفر</h1>

        @can('create agencies')
        <a href="{{ route('agencies.create') }}"
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow text-sm">
            + إضافة وكالة جديدة
        </a>
        @endcan
    </div>

    <div class="overflow-x-auto bg-white rounded-2xl shadow-md">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
            <thead class="bg-gray-200 text-gray-800 text-xs font-bold uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3">اسم الوكالة</th>
                    <th class="px-6 py-3">البريد الإلكتروني</th>
                    <th class="px-6 py-3">رقم الهاتف</th>
                    <th class="px-6 py-3">العنوان</th>
                    <th class="px-6 py-3">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($agencies as $agency)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-900">{{ $agency->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $agency->email }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $agency->phone }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $agency->address }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-2">
                                @can('edit agencies')
                                <a href="{{ route('agencies.edit', $agency->id) }}"
                                   class="bg-yellow-200 hover:bg-yellow-300 text-yellow-900 px-3 py-1 rounded text-xs shadow-sm">
                                    تعديل
                                </a>
                                @endcan

                                @can('delete agencies')
                                <form action="{{ route('agencies.destroy', $agency->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-200 hover:bg-red-300 text-red-800 px-3 py-1 rounded text-xs shadow-sm">
                                        حذف
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-gray-500">لا توجد وكالات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $agencies->links() }}
    </div>
</div>
@endsection
