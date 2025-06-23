@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-md" dir="rtl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4 text-center">🛡️ تفاصيل الصلاحية</h2>

    <div class="space-y-4 text-sm text-gray-700">
        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm text-center">
            <div class="w-1/2 font-medium text-gray-600">الاسم</div>
            <div class="w-1/2 font-semibold text-gray-900">{{ $permission->name }}</div>
        </div>

        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm text-center">
            <div class="w-1/2 font-medium text-gray-600">المعرف (ID)</div>
            <div class="w-1/2 text-gray-900">{{ $permission->id }}</div>
        </div>

        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm text-center">
            <div class="w-1/2 font-medium text-gray-600">تاريخ الإنشاء</div>
            <div class="w-1/2 text-gray-900">{{ $permission->created_at->format('Y-m-d H:i') }}</div>
        </div>

        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm text-center">
            <div class="w-1/2 font-medium text-gray-600">آخر تعديل</div>
            <div class="w-1/2 text-gray-900">{{ $permission->updated_at->format('Y-m-d H:i') }}</div>
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('permissions.index') }}"
           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow transition duration-200">
            ← رجوع إلى قائمة الصلاحيات
        </a>
    </div>
</div>
@endsection
