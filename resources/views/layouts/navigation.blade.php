<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="bg-gradient-to-r from-cyan-600 to-teal-600 p-2 rounded-lg">
                            <x-application-logo class="block h-6 w-auto fill-current text-white" />
                        </div>
                        <span class="ml-3 text-xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">
                            LearningLog
                        </span>
                    </a>
                </div>

                <!-- Navigation Links : role-based conditional branching -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    @if(auth()->check() && auth()->user()->isTeacher())
                        <x-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')"
                                    class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-semibold leading-5 focus:outline-none">
                            <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                            {{ __('先生ダッシュボード')}}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.invitation.index')" :active="request()->routeIs('teacher.invitation.index')"
                                    class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-semibold leading-5 focus:outline-none">
                            <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                            {{ __('先生招待')}}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('student.daily_study_logs.index')" :active="request()->routeIs('student.daily_study_logs.index')"
                                    class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-semibold leading-5 focus:outline-none">
                            <x-heroicon-o-book-open class="w-5 h-5 mr-2" />
                            {{ __(auth()->user()->name.'の学習記録')}}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-semibold rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-cyan-600 to-teal-600 flex items-center justify-center mr-2">
                                    <span class="text-white text-sm font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <x-heroicon-o-user class="w-4 h-4 mr-2 text-gray-400" />
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="flex items-center text-red-600 hover:bg-red-50">
                                <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 mr-2" />
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-gray-50">
            @if(auth()->check() && auth()->user()->isTeacher())
                <x-responsive-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.dashboard')"
                                      class="flex items-center">
                    <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                    {{ __('先生ダッシュボード') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.invitation.index')" :active="request()->routeIs('teacher.invitation.index')"
                                      class="flex items-center">
                    <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                    {{ __('先生招待') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('student.daily_study_logs.index')" :active="request()->routeIs('student.daily_study_logs.index')"
                                      class="flex items-center">
                    <x-heroicon-o-book-open class="w-5 h-5 mr-2" />
                    {{ __('学習記録') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
            <div class="px-4 mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-600 to-teal-600 flex items-center justify-center mr-3">
                        <span class="text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div>
                        <div class="font-semibold text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center">
                    <x-heroicon-o-user class="w-5 h-5 mr-2 text-gray-400" />
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center text-red-600">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 mr-2" />
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
