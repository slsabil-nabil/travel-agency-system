@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6 text-right">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">تفاصيل المستخدم</h2>

    <div class="bg-white shadow rounded-xl p-6 space-y-4 border">
        <div>
            <p class="text-sm text-gray-500 mb-1">الاسم</p>
            <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">البريد الإلكتروني</p>
            <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">الوكالة</p>
            @if ($user->agency)
                <p class="text-lg font-semibold text-blue-700 hover:underline">
                    <a href="{{ route('agencies.show', $user->agency->id) }}">{{ $user->agency->name }}</a>
                </p>
            @else
                <p class="text-lg font-semibold text-gray-400">لا يوجد</p>
            @endif
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-2">الأدوار</p>
            <div class="flex flex-wrap gap-2">
                @forelse ($roles as $role)
                    <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">{{ $role }}</span>
                @empty
                    <span class="text-gray-400 text-sm">لا يوجد</span>
                @endforelse
            </div>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-2">الصلاحيات</p>
            <div class="flex flex-wrap gap-2">
                @forelse ($permissions as $permission)
                    <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">{{ $permission }}</span>
                @empty
                    <span class="text-gray-400 text-sm">لا يوجد</span>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('users.index') }}" class="inline-block bg-gray-600 text-white px-5 py-2 rounded-lg hover:bg-gray-700 transition">رجوع</a>
    </div>
</div>
@endsection
