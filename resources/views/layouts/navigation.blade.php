<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm" dir="rtl">
    <!-- الشريط العلوي -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- القسم الأيمن: الشعار وروابط التنقل -->
            <div class="flex flex-row-reverse items-center gap-8">
                <!-- الشعار -->
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>

                <!-- روابط التنقل -->
                <div class="hidden sm:flex gap-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        لوحة التحكم
                    </x-nav-link>
                </div>
            </div>

            <!-- القائمة المنسدلة للمستخدم -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8l7 7 7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.show')">
                            الملف الشخصي
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                تسجيل الخروج
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- زر القائمة (للجوال) -->
            <div class="sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- القائمة الجانبية للجوال -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                لوحة التحكم
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 px-4">
            <div class="mb-2">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <x-responsive-nav-link :href="route('profile.show')">
                الملف الشخصي
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    تسجيل الخروج
                </x-responsive-nav-link>
            </form>
        </div>
    </div>

    <!-- قسم إدارة النظام -->
    @canany(['users.view', 'roles.view', 'permissions.view', 'agencies.view'])
        <div class="border-t border-gray-200 mt-4 py-4 px-6 bg-gray-50">
            <h6 class="text-gray-500 text-xs font-bold uppercase mb-2">إدارة النظام</h6>

            <div class="space-y-1">
                @can('users.view')
                    <a href="{{ route('users.index') }}" class="block text-sm text-gray-700 hover:bg-gray-100 px-3 py-2 rounded">
                        المستخدمين
                    </a>
                @endcan

                @can('roles.view')
                    <a href="{{ route('roles.index') }}" class="block text-sm text-gray-700 hover:bg-gray-100 px-3 py-2 rounded">
                        الأدوار
                    </a>
                @endcan

                @can('permissions.view')
                    <a href="{{ route('permissions.index') }}" class="block text-sm text-gray-700 hover:bg-gray-100 px-3 py-2 rounded">
                        الصلاحيات
                    </a>
                @endcan

                @can('agencies.view')
                    <a href="{{ route('agencies.index') }}" class="block text-sm text-gray-700 hover:bg-gray-100 px-3 py-2 rounded">
                        الوكالات
                    </a>
                @endcan
            </div>
        </div>
    @endcanany
</nav>
