@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" dir="rtl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">الملف الشخصي</h1>

    <div class="bg-white shadow rounded-2xl p-6">
        <div class="mb-4">
            <p class="text-gray-700"><span class="font-semibold">الاسم:</span> {{ $user->name }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><span class="font-semibold">البريد الإلكتروني:</span> {{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><span class="font-semibold">الوكالة:</span> {{ $user->agency->name ?? 'بدون وكالة' }}</p>
        </div>

        <div>
            <p class="text-gray-700 font-semibold mb-2">الأدوار:</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($roles as $role)
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                        {{ $role }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
