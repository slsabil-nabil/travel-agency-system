@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-8" dir="rtl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-right">تعديل المستخدم</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm text-right">
            <strong class="block mb-2">حدثت الأخطاء التالية:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
            <input type="text" name="name" value="{{ $user->name }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ $user->email }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">الأدوار</label>
            <select name="roles[]" multiple
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach ($roles as $id => $role)
                    <option value="{{ $id }}" {{ in_array($id, $userRoles) ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition-all"> تحديث</button>
            <a href="{{ route('users.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg transition-all">رجوع</a>
        </div>
    </form>
</div>
@endsection
