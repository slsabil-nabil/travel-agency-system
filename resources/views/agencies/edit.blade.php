@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6 bg-white rounded-xl shadow" dir="rtl">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">تعديل بيانات الوكالة</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('agencies.update', $agency) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">اسم الوكالة</label>
            <input type="text" name="name" value="{{ $agency->name }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 text-right" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ $agency->email }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 text-right">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
            <input type="text" name="phone" value="{{ $agency->phone }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 text-right">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
            <input type="text" name="address" value="{{ $agency->address }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 text-right">
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('agencies.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm shadow">
                رجوع
            </a>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm shadow">
                تحديث
            </button>
        </div>
    </form>
</div>
@endsection
