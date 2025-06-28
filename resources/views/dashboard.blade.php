@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-10 bg-gray-100 min-h-screen" dir="rtl">

        <!-- العنوان الرئيسي -->
        <h1 class="text-3xl font-bold text-gray-800 mb-10">👋 أهلاً بك في لوحة التحكم</h1>

        <!-- البطاقات -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- بطاقة العملات -->
            <x-permission ability="view currencies">
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-all duration-300 p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="text-4xl">💰</div>
                        <h2 class="text-xl font-semibold text-gray-800">العملات</h2>
                    </div>
                    <a href="{{ route('currencies.index') }}" class="text-blue-600 hover:underline text-sm">
                        عرض العملات
                    </a>
                </div>
            </x-permission>

            <!-- بطاقة المزودين -->
            <x-permission ability="view suppliers">
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-all duration-300 p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="text-4xl">🚚</div>
                        <h2 class="text-xl font-semibold text-gray-800">المزودين</h2>
                    </div>
                    <a href="{{ route('suppliers.index') }}" class="text-blue-600 hover:underline text-sm">
                        عرض المزودين
                    </a>
                </div>
            </x-permission>

            <!-- بطاقة الإعدادات -->
            <x-permission ability="configure settings">
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-all duration-300 p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="text-4xl">⚙️</div>
                        <h2 class="text-xl font-semibold text-gray-800">الإعدادات</h2>
                    </div>
                    <a href="{{ route('settings.index') }}" class="text-blue-600 hover:underline text-sm">
                        إدارة الإعدادات
                    </a>
                </div>
            </x-permission>

        </div>
    </div>
@endsection
