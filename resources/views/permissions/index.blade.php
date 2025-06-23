@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-8 bg-white rounded-xl shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">إدارة الصلاحيات</h1>

    {{-- زر إضافة صلاحية --}}
    <div class="mb-6 text-left">
        <a href="{{ route('permissions.create') }}"
           class="bg-black text-white hover:bg-gray-800 font-semibold py-2 px-6 rounded shadow transition duration-200">
            + إضافة صلاحية
        </a>
    </div>

    {{-- جدول عرض الصلاحيات --}}
    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-300 rounded-lg shadow-sm text-sm text-center">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4 border">#</th>
                    <th class="p-4 border">الاسم</th>
                    <th class="p-4 border">الحارس</th>
                    <th class="p-4 border">العمليات</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($permissions as $permission)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border p-4">{{ $loop->iteration }}</td>
                        <td class="border p-4">{{ $permission->name }}</td>
                        <td class="border p-4">{{ $permission->guard_name }}</td>
                        <td class="border p-2 text-center">
                           {{-- زر العمليات --}}
<div class="flex flex-wrap justify-center gap-2">
    {{-- زر تعديل --}}
    <a href="{{ route('permissions.edit', $permission->id) }}"
       class="bg-yellow-200 hover:bg-yellow-300 text-yellow-900 px-3 py-1 rounded text-xs shadow-sm">
        تعديل
    </a>

    {{-- زر حذف --}}
    <form action="{{ route('permissions.destroy', $permission->id) }}"
          method="POST"
          onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="bg-red-200 hover:bg-red-300 text-red-800 px-3 py-1 rounded text-xs shadow-sm">
            حذف
        </button>
    </form>

    {{-- زر تفاصيل --}}
    <a href="{{ route('permissions.show', $permission->id) }}"
       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-xs shadow-sm">
        تفاصيل
    </a>
</div>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">لا توجد صلاحيات بعد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
