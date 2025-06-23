@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-50 p-6">
        <div class="w-full max-w-3xl bg-white rounded-xl shadow-lg p-6 text-right space-y-6">

            <h1 class="text-2xl font-extrabold text-gray-800 border-b pb-2">✏️ تعديل الدور: {{ $role->name }}</h1>

            <form action="{{ route('roles.update', $role->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- اسم الدور --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">اسم الدور:</label>
                    <input type="text" name="name" id="name"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 text-right"
                           value="{{ old('name', $role->name) }}" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- الصلاحيات --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">الصلاحيات:</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($permissions as $permission)
                            <label class="flex flex-row-reverse items-center bg-gray-50 border rounded-md px-3 py-2 hover:bg-gray-100 transition">
                                <input type="checkbox"
                                       name="permissions[]"
                                       value="{{ $permission->id }}"
                                       id="perm_{{ $permission->id }}"
                                       class="form-checkbox text-blue-600 rounded border-gray-300 ml-2"
                                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-800">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('permissions')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- أزرار --}}
                <div class="flex justify-start gap-4 mt-6">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                         تحديث
                    </button>
                    <a href="{{ route('roles.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow">
                         رجوع
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
