@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">👋 أهلاً بك في لوحة التحكم</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <x-permission ability="view currencies">
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">💰 العملات</h2>
                    <a href="{{ route('currencies.index') }}" class="text-blue-600 hover:underline">عرض العملات</a>
                </div>
            </x-permission>

            <x-permission ability="view suppliers">
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">🚚 المزودين</h2>
                    <a href="{{ route('suppliers.index') }}" class="text-blue-600 hover:underline">عرض المزودين</a>
                </div>
            </x-permission>

            <x-permission ability="configure settings">
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition-all duration-300">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">⚙️ الإعدادات</h2>
                    <a href="{{ route('settings.index') }}" class="text-blue-600 hover:underline">إدارة الإعدادات</a>
                </div>
            </x-permission>

        </div>
    </div>
@endsection
