<nav x-data="{ open: false }" class="bg-white shadow-md border-b border-blue-100" dir="rtl">
    <!-- الشريط العلوي -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- القسم الأيمن: الشعار والروابط -->
            <div class="flex flex-row-reverse items-center gap-8">
                <!-- الشعار المخصص -->
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/Traveling.jpg') }}" alt="Logo" class="h-10 w-auto">
                </a>

                <!-- روابط التنقل -->
                <div class="hidden sm:flex gap-4 items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-blue-700 hover:text-blue-900 font-semibold text-sm flex items-center gap-1">
                        🧭 <span>لوحة التحكم</span>
                    </x-nav-link>
                </div>
            </div>

            <!-- معلومات المستخدم -->
            <div class="hidden sm:flex sm:items-center gap-4">
                <!-- صورة المستخدم -->
                <img class="h-8 w-8 rounded-full object-cover border-2 border-blue-200"
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                     alt="{{ Auth::user()->name }}">

                <!-- القائمة المنسدلة -->
                <x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="flex items-center text-sm font-medium text-blue-900 hover:text-blue-700 focus:outline-none gap-2">
            <span>{{ Auth::user()->name }}</span>
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l7 7 7-7"/>
            </svg>
        </button>
    </x-slot>

    <x-slot name="content">
        <!-- الملف الشخصي -->
        <x-dropdown-link :href="route('profile.show')" class="flex items-center gap-2">
            ⚙️ <span>الملف الشخصي</span>
        </x-dropdown-link>

        <!-- تسجيل الخروج -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                class="flex items-center gap-2 text-red-600 hover:text-red-700">
                🚪 <span>تسجيل الخروج</span>
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>

            </div>

            <!-- زر القائمة للجوال -->
            <div class="sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 transition shadow-sm">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- القائمة الجانبية للجوال -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden bg-blue-50 border-t border-blue-100">
        <div class="pt-4 pb-3 space-y-2 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-blue-800">
                🧭 لوحة التحكم
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('profile.show')" class="text-blue-800">
                ⚙️ الملف الشخصي
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                                       onclick="event.preventDefault(); this.closest('form').submit();" class="text-blue-800">
                    🚪 تسجيل الخروج
                </x-responsive-nav-link>
            </form>
        </div>
    </div>

    <!-- قسم إدارة النظام -->
    <!-- قسم إدارة النظام -->
@canany(['users.view', 'roles.view', 'permissions.view', 'agencies.view'])
    <div class="border-t border-blue-100 mt-4 py-4 px-6 bg-blue-50">
        <h6 class="text-blue-700 text-sm font-bold uppercase mb-4 tracking-wide">
            إدارة النظام
        </h6>

        <div class="space-y-2">
            @can('users.view')
                <a href="{{ route('users.index') }}"
                   class="flex items-center gap-2 text-sm text-blue-900 hover:bg-blue-100 px-3 py-2 rounded-md transition font-medium">
                    👥 <span>المستخدمين</span>
                </a>
            @endcan

            @can('roles.view')
                <a href="{{ route('roles.index') }}"
                   class="flex items-center gap-2 text-sm text-blue-900 hover:bg-blue-100 px-3 py-2 rounded-md transition font-medium">
                    🛡️ <span>الأدوار</span>
                </a>
            @endcan

            @can('permissions.view')
                <a href="{{ route('permissions.index') }}"
                   class="flex items-center gap-2 text-sm text-blue-900 hover:bg-blue-100 px-3 py-2 rounded-md transition font-medium">
                    🔐 <span>الصلاحيات</span>
                </a>
            @endcan

            @can('agencies.view')
                <a href="{{ route('agencies.index') }}"
                   class="flex items-center gap-2 text-sm text-blue-900 hover:bg-blue-100 px-3 py-2 rounded-md transition font-medium">
                    🏢 <span>الوكالات</span>
                </a>
            @endcan
        </div>
    </div>
@endcanany

</nav>
