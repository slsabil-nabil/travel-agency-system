@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">إدارة المستخدمين</h2>
        <a href="{{ route('users.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
            + مستخدم جديد
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
            <thead class="bg-gray-50 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-3">الاسم</th>
                    <th class="px-4 py-3">البريد الإلكتروني</th>
                    <th class="px-4 py-3">الأدوار</th>
                    <th class="px-4 py-3">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2 space-x-1 space-y-1">
                            @forelse ($user->roles as $role)
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                                    {{ $role->name }}
                                </span>
                            @empty
                                <span class="text-gray-400">بدون دور</span>
                            @endforelse
                        </td>
                       <td class="px-4 py-2">
    <div class="flex flex-row-reverse gap-2">
        <a href="{{ route('users.edit', $user->id) }}"
           class="bg-yellow-200 hover:bg-yellow-300 text-yellow-900 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">
            تعديل
        </a>

        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block"
              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-200 hover:bg-red-300 text-red-800 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">
                حذف
            </button>
        </form>

        <a href="{{ route('users.show', $user->id) }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-xs shadow-sm cursor-not-allowed">
            عرض
        </a>
    </div>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-gray-500">لا يوجد مستخدمون حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
