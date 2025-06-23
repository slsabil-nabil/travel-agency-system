@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-50 p-6">
        <div class="w-full max-w-6xl bg-white rounded-lg shadow-md p-6">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">🛡️ قائمة الأدوار</h2>
                <a href="{{ route('roles.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">إضافة دور جديد
                </a>
            </div>

            @if ($roles->isEmpty())
                <div class="text-center text-gray-500 bg-gray-100 py-8 rounded-lg shadow-inner">
                    لا توجد أدوار مضافة بعد.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-fixed border border-gray-300 rounded-lg overflow-hidden text-sm text-center">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-3 border border-gray-300 w-1/4">اسم الدور</th>
                                <th class="px-4 py-3 border border-gray-300 w-1/2">الصلاحيات</th>
                                <th class="px-4 py-3 border border-gray-300 w-1/4">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($roles as $role)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border border-gray-200 text-gray-800 align-middle">
                                        {{ $role->name }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 align-middle space-y-1">
                                        @foreach ($role->permissions as $permission)
                                            <span class="inline-block bg-indigo-100 text-indigo-700 px-2 py-1 rounded text-xs">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 align-middle">
                                        <div class="flex justify-center gap-2 flex-wrap">
                                            <a href="{{ route('roles.show', $role->id) }}"
                                               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">
                                                عرض
                                            </a>
                                            <a href="{{ route('roles.edit', $role->id) }}"
                                               class="bg-yellow-200 hover:bg-yellow-300 text-yellow-900 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">
                                                تعديل
                                            </a>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف هذا الدور؟');">
    @csrf
    @method('DELETE')
    <button class="bg-red-200 hover:bg-red-300 text-red-800 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">حذف</button>
</form>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
@endsection
