@extends('layouts.app')

@section('content')
<div dir="rtl" class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-2">إنشاء مستخدم جديد</h2>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 p-4 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-right" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-right" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                <input type="password" name="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-right" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-right" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">الأدوار</label>
                <select name="roles[]" multiple class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-right">
                    @foreach ($roles as $id => $role)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">يمكنك اختيار أكثر من دور بالضغط على Ctrl.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">الوكالة</label>
                <select name="agency_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-right">
                    <option value="">-- اختر وكالة --</option>
                    @foreach($agencies as $agency)
                        <option value="{{ $agency->id }}" {{ old('agency_id') == $agency->id ? 'selected' : '' }}>
                            {{ $agency->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="pt-4 text-right">
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
