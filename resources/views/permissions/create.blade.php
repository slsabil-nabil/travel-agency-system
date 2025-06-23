@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">إضافة صلاحية جديدة</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('permissions.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-bold mb-1">اسم الصلاحية</label>
            <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label for="guard_name" class="block font-bold mb-1">اسم الحارس (Guard)</label>
            <select name="guard_name" id="guard_name" class="w-full border px-4 py-2 rounded">
                <option value="web">web</option>
                <option value="api">api</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                حفظ الصلاحية
            </button>
            <a href="{{ route('permissions.index') }}" class="text-gray-600 hover:underline ml-4">رجوع</a>
        </div>
    </form>
</div>
@endsection
