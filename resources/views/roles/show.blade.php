@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        تفاصيل الدور: <span class="text-indigo-600">{{ $role->name }}</span>
    </h1>

    {{-- الصلاحيات المرتبطة بالدور --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">الصلاحيات المرتبطة بالدور:</h2>

        @if ($role->permissions->isEmpty())
            <p class="text-gray-500">لا توجد صلاحيات مضافة لهذا الدور.</p>
        @else
            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                @foreach ($role->permissions as $permission)
                    <li>{{ $permission->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- كل الصلاحيات --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">كل الصلاحيات المتوفرة:</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
            @foreach ($allPermissions as $permission)
                <span class="px-3 py-1 text-xs rounded-full font-medium text-white
                    {{ $role->permissions->contains($permission) ? 'bg-green-500' : 'bg-gray-400' }}">
                    {{ $permission->name }}
                </span>
            @endforeach
        </div>
    </div>

    {{-- زر الرجوع --}}
    <div class="mt-6 text-left">
        <a href="{{ route('roles.index') }}"
           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded shadow transition">
            ← رجوع إلى قائمة الأدوار
        </a>
    </div>
</div>
@endsection
