@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10" dir="rtl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-right">🆕 إضافة دور جديد</h1>

        <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- حقل اسم الدور --}}
            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-700">اسم الدور:</label>
                <input type="text" name="name" id="name"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- الصلاحيات --}}
            <div>
    <label class="block mb-2 text-sm font-medium text-gray-700">الصلاحيات:</label>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        @foreach ($permissions as $permission)
            <label class="inline-flex items-center space-x-2 space-x-reverse bg-gray-50 border rounded-md px-3 py-2 hover:bg-gray-100 transition">
                <input type="checkbox"
                       name="permissions[]"
                       value="{{ $permission->id }}"
                       class="form-checkbox text-blue-600 rounded border-gray-300">
                <span class="text-sm text-gray-800">{{ $permission->name }}</span>
            </label>
        @endforeach
    </div>
    @error('permissions')
        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
    @enderror
</div>


            {{-- أزرار الإجراء --}}
            <div class="flex justify-start space-x-3 rtl:space-x-reverse mt-6">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition shadow">
                    حفظ
                </button>
                <a href="{{ route('roles.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md transition shadow">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
@endsection
