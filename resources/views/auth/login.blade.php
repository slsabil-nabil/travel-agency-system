<x-guest-layout>
    <div dir="rtl" class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-10" style="font-family: 'Tajawal', sans-serif;">

        <div class="bg-white w-full max-w-4xl rounded-2xl shadow-md border border-gray-200 p-10 px-8 lg:px-16 flex flex-col items-center space-y-6">

            <!-- الشعار -->
            <div class="flex justify-center">
                <img src="{{ asset('images/Traveling.jpg') }}" alt="شعار النظام" class="h-28 w-auto mb-4">
            </div>

            <!-- العنوان -->
            <h2 class="text-2xl font-extrabold text-blue-800 mb-4">مرحباً بعودتك</h2>

            <!-- النموذج -->
            <form method="POST" action="{{ route('login') }}" class="w-full space-y-5">
                @csrf

                <!-- البريد الإلكتروني -->
                <div class="text-right">
                    <label for="email" class="block mb-1 text-base text-gray-700">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email"
                        class="w-full p-3 text-base rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition"
                        required autofocus />
                </div>

                <!-- كلمة المرور -->
                <div class="text-right">
                    <label for="password" class="block mb-1 text-base text-gray-700">كلمة المرور</label>
                    <input type="password" name="password" id="password"
                        class="w-full p-3 text-base rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-200 transition"
                        required />
                </div>

                <!-- زر الدخول -->
                <div>
                    <button type="submit"
                        class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-base transition font-semibold">
                        تسجيل الدخول
                    </button>
                </div>

                <!-- روابط إضافية -->
                <div class="text-sm text-center text-gray-500 flex flex-wrap justify-center gap-2 mt-4">
                    <a href="#" class="text-blue-600 hover:underline">نسيت كلمة المرور؟</a>
                    <span>|</span>
                    <a href="#" class="text-blue-600 hover:underline">إنشاء حساب جديد</a>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>
