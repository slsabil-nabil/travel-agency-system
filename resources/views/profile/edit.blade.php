<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- معلومات الحساب -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form id="profile-form" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        @include('profile.partials.update-profile-information-form')
                    </form>
                </div>
            </div>

            <!-- الصورة الشخصية -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.update.avatar') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="avatar" class="block text-sm font-medium text-gray-700">الصورة الشخصية</label>
                            <input type="file" name="avatar" id="avatar" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">حفظ الصورة</button>
                    </form>
                </div>
            </div>

            <!-- كلمة المرور -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- حذف الحساب -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

        <!-- ✅ أزرار الحفظ والرجوع -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="flex justify-between">
                <a href="{{ route('profile.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    ↩️ العودة إلى الملف الشخصي
                </a>
            </div>
        </div>
    </div>

    {{-- ✅ Toastr Script --}}
    @if (session('status') === 'profile-updated')
        <script>
            toastr.success("تم حفظ التغييرات بنجاح ✅", '', {
                timeOut: 4000,
                closeButton: true,
                progressBar: true
            });
        </script>
    @endif
</x-app-layout>
