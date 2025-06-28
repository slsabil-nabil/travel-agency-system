@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10" dir="rtl">

        <!-- الغلاف -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 h-32 rounded-t-2xl relative shadow">
        </div>

        <!-- صندوق البيانات -->
        <div class="bg-white rounded-b-2xl shadow-lg px-6 pt-16 pb-8 -mt-12 relative">

            <!-- صورة المستخدم -->
            <div class="absolute -top-12 right-6">
                <img class="w-24 h-24 rounded-full border-4 border-white shadow"
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff"
                    alt="{{ $user->name }}">
            </div>

            <!-- العنوان -->
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-right">👤 الملف الشخصي</h1>

            <!-- بيانات المستخدم -->
            <div class="space-y-4 text-right">
                <p class="text-gray-700">
                    <span class="font-semibold">الاسم:</span> {{ $user->name }}
                </p>

                <p class="text-gray-700">
                    <span class="font-semibold">البريد الإلكتروني:</span> {{ $user->email }}
                </p>

                <p class="text-gray-700">
                    <span class="font-semibold">الوكالة:</span> {{ $user->agency->name ?? 'بدون وكالة' }}
                </p>

                <div>
                    <p class="font-semibold text-gray-700 mb-2">الأدوار:</p>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($roles as $role)
                            <span class="inline-flex items-center bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                🔐 {{ $role }}
                            </span>
                        @empty
                            <span class="text-gray-500 text-sm">لا يوجد دور مخصص</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
