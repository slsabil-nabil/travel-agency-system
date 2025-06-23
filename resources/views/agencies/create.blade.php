@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6" dir="rtl">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-right">إضافة وكالة جديدة</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 border border-red-200 rounded-lg px-4 py-3 mb-6">
            <ul class="list-disc pr-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('agencies.store') }}" class="bg-white p-6 rounded-2xl shadow-md space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">اسم الوكالة</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
            <input type="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
            <input type="text" name="phone" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
            <input type="text" name="address" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow text-sm">
                حفظ
            </button>
            <a href="{{ route('agencies.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow text-sm">
                رجوع
            </a>
        </div>
    </form>
</div>
@endsection
