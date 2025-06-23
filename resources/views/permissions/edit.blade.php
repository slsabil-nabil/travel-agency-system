
@extends('layouts.app')
@php
    /** @var \Spatie\Permission\Models\Permission $permission */
@endphp

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">تعديل الصلاحية</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-bold mb-1">اسم الصلاحية</label>
            <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded"
                   value="{{ old('name', $permission->name) }}" required>
        </div>

        <div>
            <label for="guard_name" class="block font-bold mb-1">اسم الحارس (Guard)</label>
            <select name="guard_name" id="guard_name" class="w-full border px-4 py-2 rounded">
                <option value="web" {{ $permission->guard_name === 'web' ? 'selected' : '' }}>web</option>
                <option value="api" {{ $permission->guard_name === 'api' ? 'selected' : '' }}>api</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                حفظ التعديلات
            </button>
            <a href="{{ route('permissions.index') }}" class="text-gray-600 hover:underline ml-4">رجوع</a>
        </div>
    </form>
</div>
@endsection
