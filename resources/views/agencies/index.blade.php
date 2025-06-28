@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" dir="rtl">
    <!-- رأس الصفحة -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            🧳 وكالات السفر
        </h1>

        @can('agencies.create')
        <a href="{{ route('agencies.create') }}"
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow text-sm transition">
            + إضافة وكالة جديدة
        </a>
        @endcan
    </div>

    <!-- الجدول -->
    <div class="overflow-x-auto bg-white rounded-2xl shadow-md">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
            <thead class="bg-blue-100 text-blue-900 text-xs font-bold uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3">🏢 اسم الوكالة</th>
                    <th class="px-6 py-3">📧 البريد الإلكتروني</th>
                    <th class="px-6 py-3">📞 رقم الهاتف</th>
                    <th class="px-6 py-3">📍 العنوان</th>
                    <th class="px-6 py-3">⚙️ الإجراءات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($agencies as $agency)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $agency->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $agency->email }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $agency->phone }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $agency->address }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-2">
                                @can('agencies.edit')
                                <a href="{{ route('agencies.edit', $agency->id) }}"
                                   class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 px-3 py-1 rounded-md text-xs shadow-sm transition">
                                    ✏️ تعديل
                                </a>
                                @endcan

                                @can('agencies.delete')
                                <form action="{{ route('agencies.destroy', $agency->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-md text-xs shadow-sm transition">
                                        🗑️ حذف
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

    <!-- ترقيم الصفحات -->
    <div class="mt-6">
        {{ $agencies->links() }}
    </div>
</div>
@endsection
