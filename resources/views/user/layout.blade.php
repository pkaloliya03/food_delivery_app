<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Food Ordering')</title>

    <meta name="description" content="@yield('meta_description', 'Discover restaurants and order your favorite food online.')">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
        }

        /* Hide scrollbar while keeping horizontal scrolling available */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-xl">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex h-16 items-center justify-between gap-4 lg:h-[72px]">

                {{-- Logo --}}
                <a href="{{ url('/') }}" class="group flex shrink-0 items-center gap-2.5">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm transition group-hover:scale-105">
                        <i data-lucide="utensils" class="h-5 w-5"></i>
                    </div>

                    <div class="hidden sm:block">
                        <div class="text-base font-extrabold tracking-tight text-slate-900">
                            Food<span class="text-emerald-500">ly</span>
                        </div>

                        <div class="text-[10px] font-medium uppercase tracking-[0.16em] text-slate-400">
                            Food & Restaurants
                        </div>
                    </div>

                </a>


                {{-- Desktop Location --}}
                <button type="button" onclick="openCityModal()"
                    class="hidden min-w-0 items-center gap-2 rounded-xl px-3 py-2 text-left transition hover:bg-slate-50 lg:flex">

                    <i data-lucide="map-pin" class="h-4 w-4 shrink-0 text-emerald-500"></i>

                    <div class="min-w-0">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">
                            Deliver to
                        </p>

                        <div class="flex items-center gap-1">
                            <span id="desktopSelectedCity"
                                class="max-w-36 truncate text-sm font-semibold text-slate-700">
                                {{ session('selected_city_name', 'Select your city') }}
                            </span>

                            <i data-lucide="chevron-down" class="h-3.5 w-3.5 text-slate-400"></i>
                        </div>
                    </div>

                </button>


                {{-- Desktop Search --}}
                <div class="hidden max-w-xl flex-1 md:flex">

                    <div class="relative w-full">

                        <i data-lucide="search"
                            class="pointer-events-none absolute left-4 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400"></i>

                        <input type="search" placeholder="Search for restaurants, dishes or cuisines..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">
                    </div>

                </div>


                {{-- Desktop Actions --}}
                <div class="hidden items-center gap-1 sm:flex">

                    {{-- Mobile/Desktop search shortcut --}}
                    <button type="button"
                        class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 md:hidden">
                        <i data-lucide="search" class="h-5 w-5"></i>
                    </button>

                    {{-- Orders : customer only --}}
                    @if (auth()->check() && auth()->user()->role === 'customer')
                        <a href="#"
                            class="hidden items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900 lg:flex">
                            <i data-lucide="receipt-text" class="h-4 w-4"></i>
                            Orders
                        </a>
                    @endif

                    {{-- Cart --}}
                    @php
                        $headerCart = session('cart', ['items' => []]);
                        $headerCartCount = collect($headerCart['items'] ?? [])->sum('quantity');
                    @endphp

                    <a href="{{ route('cart.index') }}"
                        class="relative flex h-10 w-10 items-center justify-center rounded-xl text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                        aria-label="Cart">

                        <i data-lucide="shopping-bag" class="h-5 w-5"></i>

                        <span id="cartCount"
                            class="{{ $headerCartCount > 0 ? '' : 'hidden' }} absolute -right-0.5 -top-0.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-emerald-500 px-1 text-[10px] font-bold text-white">
                            {{ $headerCartCount }}
                        </span>
                    </a>

                    {{-- Login / Customer account --}}
                    @if (auth()->check() && auth()->user()->role === 'customer')
                        <div class="relative ml-1" id="desktopAccountWrapper">

                            {{-- Account Button --}}
                            <button type="button" onclick="toggleDesktopAccountMenu()"
                                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 transition hover:bg-slate-50">

                                <div
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-xs font-bold text-emerald-600">
                                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                                </div>

                                <span class="max-w-24 truncate text-sm font-semibold text-slate-700">
                                    {{ auth()->user()->username }}
                                </span>

                                <i data-lucide="chevron-down" id="desktopAccountChevron"
                                    class="h-4 w-4 text-slate-400 transition-transform">
                                </i>

                            </button>


                            {{-- Account Dropdown --}}
                            <div id="desktopAccountMenu"
                                class="absolute right-0 top-[calc(100%+8px)] hidden w-52 overflow-hidden rounded-2xl border border-slate-200 bg-white p-1.5 shadow-xl shadow-slate-900/10">

                                {{-- User Info --}}
                                <div class="border-b border-slate-100 px-3 py-3">

                                    <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">
                                        Signed in as
                                    </p>

                                    <p class="mt-1 truncate text-sm font-bold text-slate-800">
                                        {{ auth()->user()->username }}
                                    </p>

                                </div>


                                {{-- Logout --}}
                                <form action="{{ route('user.logout') }}" method="POST">
                                    @csrf

                                    <button type="submit"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-red-50 hover:text-red-600">
                                        <i data-lucide="log-out" class="h-4 w-4"></i>
                                        Logout
                                    </button>
                                </form>

                            </div>

                        </div>
                    @else
                        <button type="button" onclick="openAuthModal('login')"
                            class="ml-1 hidden items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 lg:flex">

                            <i data-lucide="user-round" class="h-4 w-4"></i>
                            Login
                        </button>
                    @endif

                </div>


                {{-- Mobile Menu Button --}}
                <button type="button" id="userMobileMenuButton"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-slate-700 transition hover:bg-slate-100 lg:hidden"
                    aria-label="Open menu" aria-expanded="false">

                    <i data-lucide="menu" class="h-5 w-5"></i>

                </button>

            </div>


            {{-- Mobile Search --}}
            <div class="pb-3 md:hidden">

                <div class="relative">

                    <i data-lucide="search"
                        class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>

                    <input type="search" placeholder="Search restaurants, dishes..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">
                </div>

            </div>

        </div>


        {{-- Mobile Navigation --}}
        <div id="userMobileMenu" class="hidden border-t border-slate-100 bg-white lg:hidden">

            <div class="mx-auto max-w-7xl space-y-1 px-4 py-4 sm:px-6">

                <button type="button" onclick="openCityModal()"
                    class="flex w-full items-center gap-3 rounded-xl bg-slate-50 px-4 py-3 text-left">

                    <i data-lucide="map-pin" class="h-4.5 w-4.5 text-emerald-500"></i>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">
                            Deliver to
                        </p>

                        <p id="mobileSelectedCity" class="text-sm font-semibold text-slate-800">
                            {{ session('selected_city_name', 'Select your city') }}
                        </p>
                    </div>

                    <i data-lucide="chevron-right" class="ml-auto h-4 w-4 text-slate-400"></i>

                </button>


                @if (auth()->check() && auth()->user()->role === 'customer')
                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        <i data-lucide="receipt-text" class="h-4.5 w-4.5 text-slate-400"></i>
                        My Orders
                    </a>
                @endif


                {{-- Mobile Cart --}}
                @php
                    $mobileCart = session('cart', ['items' => []]);
                    $mobileCartCount = collect($mobileCart['items'] ?? [])->sum('quantity');
                @endphp

                <a href="{{ route('cart.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    <i data-lucide="shopping-bag" class="h-4.5 w-4.5 text-slate-400"></i>

                    Cart

                    <span id="mobileCartCount"
                        class="{{ $mobileCartCount > 0 ? '' : 'hidden' }} ml-auto rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-bold text-emerald-600">
                        {{ $mobileCartCount }}
                    </span>
                </a>


                @if (auth()->check() && auth()->user()->role === 'customer')
                    {{-- Mobile Account --}}
                    <div class="rounded-2xl border border-slate-200 bg-white">

                        <button type="button" onclick="toggleMobileAccountMenu()"
                            class="flex w-full items-center gap-3 px-4 py-3.5 text-left">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-sm font-bold text-emerald-600">

                                {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}

                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">
                                    Account
                                </p>

                                <p class="truncate text-sm font-bold text-slate-800">
                                    {{ auth()->user()->username }}
                                </p>

                            </div>

                            <i data-lucide="chevron-down" id="mobileAccountChevron"
                                class="h-4 w-4 shrink-0 text-slate-400 transition-transform">
                            </i>

                        </button>


                        {{-- Mobile Account Dropdown --}}
                        <div id="mobileAccountMenu" class="hidden border-t border-slate-100 px-2 pb-2 pt-2">

                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50">

                                    <i data-lucide="log-out" class="h-4 w-4"></i>

                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>
                @else
                    <button type="button" onclick="openAuthModal('login'); closeMobileMenu()"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">

                        <i data-lucide="user-round" class="h-4 w-4"></i>

                        Login / Register

                    </button>
                @endif

            </div>

        </div>

    </header>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <main class="min-h-[calc(100vh-72px)]">

        @yield('content')

    </main>


    {{-- =========================================================
        COMMON SUCCESS / ERROR NOTIFICATION
    ========================================================= --}}

    @if (session('success') || session('error'))
        @php
            $isSuccess = session()->has('success');
            $notificationMessage = session('success') ?? session('error');
        @endphp

        <div id="userNotification"
            class="fixed right-5 top-24 z-[200] w-[calc(100%-40px)] max-w-md overflow-hidden rounded-2xl border bg-white shadow-2xl
        {{ $isSuccess ? 'border-emerald-200' : 'border-red-200' }}">

            <div class="flex items-start gap-4 p-5">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                {{ $isSuccess ? 'bg-emerald-50' : 'bg-red-50' }}">

                    <i data-lucide="{{ $isSuccess ? 'circle-check' : 'circle-alert' }}"
                        class="h-6 w-6 {{ $isSuccess ? 'text-emerald-500' : 'text-red-500' }}">
                    </i>
                </div>

                <div class="min-w-0 flex-1">

                    <div class="flex items-start justify-between gap-3">

                        <h3 class="text-sm font-bold text-slate-900">
                            {{ $isSuccess ? 'Success!' : 'Something went wrong!' }}
                        </h3>

                        <button type="button" onclick="closeUserNotification()"
                            class="shrink-0 rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                            <i data-lucide="x" class="h-4 w-4"></i>
                        </button>

                    </div>

                    <p class="mt-1 text-sm leading-5 text-slate-500">
                        {{ $notificationMessage }}
                    </p>

                </div>
            </div>

            <div class="h-1 {{ $isSuccess ? 'bg-emerald-500' : 'bg-red-500' }}">
                <div id="userNotificationProgress" class="h-full w-full origin-left bg-current opacity-30">
                </div>
            </div>

        </div>

        <script>
            window.closeUserNotification = function() {
                const notification = document.getElementById('userNotification');

                if (!notification) return;

                notification.classList.add('opacity-0', 'translate-x-4');

                setTimeout(() => {
                    notification.remove();
                }, 300);
            };

            setTimeout(() => {
                closeUserNotification();
            }, 5000);
        </script>
    @endif


    {{-- =========================================================
    CITY SELECTION MODAL
    ========================================================== --}}
    <div id="cityModal" class="fixed inset-0 z-[100] hidden" aria-hidden="true">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" onclick="closeCityModal()">
        </div>

        {{-- Modal --}}
        <div class="relative flex min-h-full items-center justify-center p-4">

            <div class="relative w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-emerald-500">
                            Delivery location
                        </p>

                        <h2 class="mt-1 text-lg font-bold tracking-tight text-slate-900">
                            Where should we deliver?
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Select your city to discover restaurants near you.
                        </p>
                    </div>

                    <button type="button" onclick="closeCityModal()"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

                        <i data-lucide="x" class="h-5 w-5"></i>

                    </button>

                </div>

                {{-- Search --}}
                <div class="p-5 sm:p-6">

                    <div class="relative">

                        <i data-lucide="search"
                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                        </i>

                        <input type="text" id="citySearchInput" autocomplete="off"
                            placeholder="Search city, e.g. Jamnagar..."
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">

                    </div>

                    {{-- Loading --}}
                    <div id="citySearchLoading" class="hidden py-8 text-center">

                        <div
                            class="mx-auto h-6 w-6 animate-spin rounded-full border-2 border-slate-200 border-t-emerald-500">
                        </div>

                        <p class="mt-3 text-xs text-slate-400">
                            Finding cities...
                        </p>

                    </div>

                    {{-- Results --}}
                    <div id="cityResults" class="mt-3 max-h-72 overflow-y-auto">

                        <div class="py-8 text-center">

                            <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50">

                                <i data-lucide="map-pin" class="h-5 w-5 text-emerald-500">
                                </i>

                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Search for your city
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Start typing to find available cities.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- =========================================================
    AUTH MODAL
    ========================================================== --}}
    <div id="authModal" class="fixed inset-0 z-[110] hidden" aria-hidden="true">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" onclick="closeAuthModal()">
        </div>

        {{-- Modal Wrapper --}}
        <div class="relative flex min-h-full items-center justify-center p-4">

            <div class="relative w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

                {{-- Close Button --}}
                <button type="button" onclick="closeAuthModal()"
                    class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                    aria-label="Close">

                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>


                {{-- =================================================
                LOGIN SECTION
                ================================================== --}}
                <div id="loginAuthSection">

                    {{-- Header --}}
                    <div class="px-6 pb-5 pt-7 sm:px-8">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                            <i data-lucide="user-round" class="h-6 w-6"></i>
                        </div>

                        <h2 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900">
                            Welcome back
                        </h2>

                        <p class="mt-1.5 text-sm leading-6 text-slate-500">
                            Sign in to continue ordering your favorite food.
                        </p>

                    </div>


                    {{-- Login Form --}}
                    <form action="{{ route('user.login') }}" id="loginAuthForm" method="POST"
                        class="px-6 pb-7 sm:px-8">

                        @csrf

                        <div id="loginAuthError"
                            class="mb-4 hidden rounded-xl border border-red-100 bg-red-50 px-4 py-3">

                            <div class="flex items-start gap-2.5">

                                <i data-lucide="circle-alert" class="mt-0.5 h-4 w-4 shrink-0 text-red-500">
                                </i>

                                <p id="loginAuthErrorText" class="text-xs font-medium text-red-600">
                                </p>

                            </div>

                        </div>

                        <input type="hidden" name="auth_mode" value="login">


                        {{-- Username --}}
                        <div>
                            <label for="loginUsername" class="mb-2 block text-sm font-semibold text-slate-700">
                                Username
                            </label>

                            <div class="relative">

                                <i data-lucide="user"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" id="loginUsername" name="username"
                                    value="{{ old('username') }}" autocomplete="username"
                                    placeholder="Enter your username" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">
                            </div>
                        </div>


                        {{-- Password --}}
                        <div class="mt-4">

                            <label for="loginPassword" class="mb-2 block text-sm font-semibold text-slate-700">
                                Password
                            </label>

                            <div class="relative">

                                <i data-lucide="lock"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="password" id="loginPassword" name="password"
                                    autocomplete="current-password" placeholder="Enter your password" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-11 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">

                                <button type="button" onclick="toggleAuthPassword('loginPassword', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-slate-700"
                                    aria-label="Show password">

                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                </button>

                            </div>
                        </div>


                        {{-- Login Button --}}
                        <button type="submit"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800 active:scale-[0.99]">

                            <i data-lucide="log-in" class="h-4 w-4"></i>

                            Sign In
                        </button>


                        {{-- Switch To Register --}}
                        <div class="mt-5 text-center text-sm text-slate-500">

                            Don't have an account?

                            <button type="button" onclick="showRegisterAuth()"
                                class="font-bold text-emerald-600 transition hover:text-emerald-700">

                                Create account
                            </button>

                        </div>

                    </form>

                </div>


                {{-- =================================================
                REGISTER SECTION
                ================================================== --}}
                <div id="registerAuthSection" class="hidden">

                    {{-- Header --}}
                    <div class="px-6 pb-5 pt-7 sm:px-8">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                            <i data-lucide="user-plus" class="h-6 w-6"></i>
                        </div>

                        <h2 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900">
                            Create your account
                        </h2>

                        <p class="mt-1.5 text-sm leading-6 text-slate-500">
                            Join Foodly and start discovering great food around you.
                        </p>

                    </div>


                    {{-- Register Form --}}
                    <form action="{{ route('user.register') }}" method="POST" id="registerAuthForm"
                        class="max-h-[65vh] overflow-y-auto px-6 pb-7 sm:px-8">

                        @csrf

                        <div id="registerAuthError"
                            class="mb-4 hidden rounded-xl border border-red-100 bg-red-50 px-4 py-3">
                            <div class="flex items-start gap-2.5">
                                <i data-lucide="circle-alert" class="mt-0.5 h-4 w-4 shrink-0 text-red-500"></i>

                                <div id="registerAuthErrorText" class="space-y-1 text-xs font-medium text-red-600">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="auth_mode" value="register">

                        {{-- Role --}}
                        <input type="hidden" name="role" value="customer">


                        {{-- Username --}}
                        <div>

                            <label for="registerUsername" class="mb-2 block text-sm font-semibold text-slate-700">
                                Username
                            </label>

                            <div class="relative">

                                <i data-lucide="user"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" id="registerUsername" name="username"
                                    value="{{ old('username') }}" autocomplete="username"
                                    placeholder="Choose a username" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">
                            </div>

                        </div>


                        {{-- Email --}}
                        <div class="mt-4">

                            <label for="registerEmail" class="mb-2 block text-sm font-semibold text-slate-700">
                                Email
                            </label>

                            <div class="relative">

                                <i data-lucide="mail"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="email" id="registerEmail" name="email" value="{{ old('email') }}"
                                    autocomplete="email" placeholder="Enter your email" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">
                            </div>

                        </div>


                        {{-- Mobile --}}
                        <div class="mt-4">

                            <label for="registerMobile" class="mb-2 block text-sm font-semibold text-slate-700">
                                Mobile
                                <span class="font-normal text-slate-400">(Optional)</span>
                            </label>

                            <div class="relative">

                                <i data-lucide="phone"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="tel" id="registerMobile" name="mobile"
                                    value="{{ old('mobile') }}" autocomplete="tel"
                                    placeholder="Enter your mobile number"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">
                            </div>

                        </div>


                        {{-- Password --}}
                        <div class="mt-4">

                            <label for="registerPassword" class="mb-2 block text-sm font-semibold text-slate-700">
                                Password
                            </label>

                            <div class="relative">

                                <i data-lucide="lock"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="password" id="registerPassword" name="password"
                                    autocomplete="new-password" placeholder="Minimum 8 characters" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-11 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">

                                <button type="button" onclick="toggleAuthPassword('registerPassword', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-slate-700"
                                    aria-label="Show password">

                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                </button>

                            </div>

                        </div>

                        {{-- Confirm Password --}}
                        <div class="mt-4">

                            <label for="registerPasswordConfirmation"
                                class="mb-2 block text-sm font-semibold text-slate-700">
                                Confirm Password
                            </label>

                            <div class="relative">

                                <i data-lucide="lock-keyhole"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="password" id="registerPasswordConfirmation" name="password_confirmation"
                                    autocomplete="new-password" placeholder="Re-enter your password" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-11 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:bg-white focus:ring-4 focus:ring-slate-900/5">

                                <button type="button"
                                    onclick="toggleAuthPassword('registerPasswordConfirmation', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-slate-700"
                                    aria-label="Show password">

                                    <i data-lucide="eye" class="h-4 w-4"></i>

                                </button>

                            </div>

                            {{-- Password Match Message --}}
                            <p id="registerPasswordMatchMessage" class="mt-1.5 min-h-[16px] text-xs font-medium">
                            </p>

                        </div>


                        {{-- Register Button --}}
                        <button type="submit"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800 active:scale-[0.99]">

                            <i data-lucide="user-plus" class="h-4 w-4"></i>

                            Create Account
                        </button>


                        {{-- Switch To Login --}}
                        <div class="mt-5 text-center text-sm text-slate-500">

                            Already have an account?

                            <button type="button" onclick="showLoginAuth()"
                                class="font-bold text-emerald-600 transition hover:text-emerald-700">

                                Sign in
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="border-t border-slate-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-12">

                {{-- Brand --}}
                <div class="lg:col-span-4">

                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white">
                            <i data-lucide="utensils" class="h-5 w-5"></i>
                        </div>

                        <div>
                            <div class="text-base font-extrabold tracking-tight text-slate-900">
                                Food<span class="text-emerald-500">ly</span>
                            </div>

                            <div class="text-[10px] font-medium uppercase tracking-[0.16em] text-slate-400">
                                Food & Restaurants
                            </div>
                        </div>

                    </a>


                    <p class="mt-4 max-w-sm text-sm leading-6 text-slate-500">
                        Discover great food from restaurants around you and order your favorites with ease.
                    </p>


                    <div class="mt-5 flex items-center gap-2">

                        <a href="#" aria-label="Instagram"
                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white">
                            <i data-lucide="instagram" class="h-4 w-4"></i>
                        </a>

                        <a href="#" aria-label="Facebook"
                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white">
                            <i data-lucide="facebook" class="h-4 w-4"></i>
                        </a>

                        <a href="#" aria-label="Twitter"
                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white">
                            <i data-lucide="twitter" class="h-4 w-4"></i>
                        </a>

                    </div>

                </div>


                {{-- Explore --}}
                <div class="lg:col-span-2">

                    <h3 class="text-sm font-bold text-slate-900">
                        Explore
                    </h3>

                    <div class="mt-4 space-y-3">

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            Restaurants
                        </a>

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            Food & Dishes
                        </a>

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            Popular Near You
                        </a>

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            Offers
                        </a>

                    </div>

                </div>


                {{-- Company --}}
                <div class="lg:col-span-2">

                    <h3 class="text-sm font-bold text-slate-900">
                        Company
                    </h3>

                    <div class="mt-4 space-y-3">

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            About Us
                        </a>

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            Contact Us
                        </a>

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            Privacy Policy
                        </a>

                        <a href="#" class="block text-sm text-slate-500 transition hover:text-slate-900">
                            Terms & Conditions
                        </a>

                    </div>

                </div>


                {{-- For Partners --}}
                <div class="lg:col-span-4">

                    <h3 class="text-sm font-bold text-slate-900">
                        For Restaurant Owners
                    </h3>

                    <p class="mt-4 text-sm leading-6 text-slate-500">
                        Grow your restaurant, manage your menu and receive orders from customers around you.
                    </p>

                    <a href="#"
                        class="mt-4 inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white">

                        Partner With Us

                        <i data-lucide="arrow-up-right" class="h-4 w-4"></i>

                    </a>

                </div>

            </div>


            {{-- Bottom --}}
            <div
                class="mt-10 flex flex-col gap-3 border-t border-slate-100 pt-6 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">

                <p>
                    © {{ date('Y') }} Foodly. All rights reserved.
                </p>

                <div class="flex items-center gap-1.5">
                    <span>Made for food lovers</span>
                    <i data-lucide="heart" class="h-3.5 w-3.5 text-rose-400"></i>
                </div>

            </div>

        </div>

    </footer>


    {{-- =========================================================
        GLOBAL JAVASCRIPT
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            const authMode = @json(old('auth_mode'));

            @if ($errors->any())
                window.openAuthModal(authMode === 'register' ? 'register' : 'login');
            @endif

            const menuButton = document.getElementById('userMobileMenuButton');
            const mobileMenu = document.getElementById('userMobileMenu');

            if (menuButton && mobileMenu) {

                menuButton.addEventListener('click', function() {

                    const isOpen = !mobileMenu.classList.contains('hidden');

                    mobileMenu.classList.toggle('hidden');

                    menuButton.setAttribute('aria-expanded', String(!isOpen));

                    menuButton.innerHTML = isOpen ?

                        '<i data-lucide="menu" class="h-5 w-5"></i>' :

                        '<i data-lucide="x" class="h-5 w-5"></i>';

                    if (typeof lucide !== 'undefined') {

                        lucide.createIcons();

                    }

                });

            }

            window.closeMobileMenu = function() {

                const mobileMenu = document.getElementById('userMobileMenu');
                const menuButton = document.getElementById('userMobileMenuButton');

                if (mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }

                if (menuButton) {
                    menuButton.setAttribute('aria-expanded', 'false');
                    menuButton.innerHTML = '<i data-lucide="menu" class="h-5 w-5"></i>';

                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                }
            };

            window.openCityModal = function() {

                const modal = document.getElementById('cityModal');
                const input = document.getElementById('citySearchInput');

                if (!modal) return;

                modal.classList.remove('hidden');

                modal.setAttribute('aria-hidden', 'false');

                document.body.classList.add('overflow-hidden');

                setTimeout(() => {
                    input?.focus();
                }, 100);

                if (typeof lucide !== 'undefined') {

                    lucide.createIcons();

                }

            }

            window.closeCityModal = function() {

                const modal = document.getElementById('cityModal');

                if (!modal) return;

                modal.classList.add('hidden');

                modal.setAttribute('aria-hidden', 'true');

                document.body.classList.remove('overflow-hidden');

            }

            window.searchCities = async function(search = '') {

                const results = document.getElementById('cityResults');
                const loading = document.getElementById('citySearchLoading');

                if (!results || !loading) return;

                loading.classList.remove('hidden');

                results.innerHTML = '';

                try {

                    const url =
                        `{{ route('user.cities.search') }}?search=${encodeURIComponent(search)}`;

                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Unable to search cities.');
                    }

                    const cities = await response.json();

                    if (!cities.length) {

                        results.innerHTML = `

                <div class="py-8 text-center">

                    <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100">

                        <i data-lucide="map-pin-off" class="h-5 w-5 text-slate-400"></i>

                    </div>

                    <p class="mt-3 text-sm font-semibold text-slate-700">

                        No city found

                    </p>

                    <p class="mt-1 text-xs text-slate-400">

                        Try searching with another city name.

                    </p>

                </div>

            `;

                        lucide?.createIcons();

                        return;

                    }

                    results.innerHTML = cities.map(city => `

            <button

                type="button"

                onclick="selectCity(${city.id})"

                class="group flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-left transition hover:bg-slate-50">

                <span
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-500 group-hover:bg-emerald-100">
                    <i data-lucide="map-pin" class="h-4 w-4"></i>
                </span>

                <span class="min-w-0 flex-1">
                    <span class="block truncate text-sm font-semibold text-slate-800">
                        ${city.name}
                    </span>

                    <span class="mt-0.5 block truncate text-xs text-slate-400">
                        ${city.state}
                    </span>
                </span>

                <i data-lucide="chevron-right"
                    class="h-4 w-4 shrink-0 text-slate-300">
                </i>

            </button>

        `).join('');

                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }

                } catch (error) {

                    results.innerHTML = `

            <div class="py-8 text-center">

                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-2xl bg-red-50">
                    <i data-lucide="triangle-alert" class="h-5 w-5 text-red-500"></i>
                </div>



                <p class="mt-3 text-sm font-semibold text-slate-700">
                    Something went wrong
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Please try again.
                </p>
            </div>

        `;

                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }

                } finally {
                    loading.classList.add('hidden');
                }

            }

            window.selectCity = async function(cityId) {

                try {

                    const response = await fetch(

                        `{{ route('user.cities.select') }}`, {

                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },


                            body: JSON.stringify({
                                city_id: cityId
                            })
                        }
                    );


                    if (!response.ok) {
                        throw new Error('Unable to select city.');
                    }

                    const data = await response.json();

                    if (!data.success) {
                        throw new Error('City selection failed.');
                    }

                    closeCityModal();

                    // Reload so the selected city is available everywhere.

                    window.location.reload();

                } catch (error) {
                    alert('Unable to select city. Please try again.');
                }
            }

            const cityInput = document.getElementById('citySearchInput');

            if (cityInput) {

                let citySearchTimer;

                cityInput.addEventListener('input', function() {
                    clearTimeout(citySearchTimer);

                    const search = this.value.trim();
                    citySearchTimer = setTimeout(() => {
                        searchCities(search);
                    }, 300);
                });
            }

            document.addEventListener('keydown', function(event) {

                if (event.key === 'Escape') {

                    const authModal = document.getElementById('authModal');

                    if (authModal && !authModal.classList.contains('hidden')) {
                        closeAuthModal();
                        return;
                    }

                    closeCityModal();
                }

            });

            window.openAuthModal = function(mode = 'login') {
                const modal = document.getElementById('authModal');

                if (!modal) return;

                modal.classList.remove('hidden');
                modal.setAttribute('aria-hidden', 'false');

                document.body.classList.add('overflow-hidden');

                if (mode === 'register') {
                    showRegisterAuth();
                } else {
                    showLoginAuth();
                }

                setTimeout(() => {
                    if (mode === 'register') {
                        document.getElementById('registerUsername')?.focus();
                    } else {
                        document.getElementById('loginUsername')?.focus();
                    }
                }, 100);

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            };

            window.closeAuthModal = function() {
                const modal = document.getElementById('authModal');

                if (!modal) return;

                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', 'true');

                document.body.classList.remove('overflow-hidden');
            };

            window.showLoginAuth = function() {
                const loginSection = document.getElementById('loginAuthSection');
                const registerSection = document.getElementById('registerAuthSection');

                if (!loginSection || !registerSection) return;

                loginSection.classList.remove('hidden');
                registerSection.classList.add('hidden');

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            };

            window.showRegisterAuth = function() {
                const loginSection = document.getElementById('loginAuthSection');
                const registerSection = document.getElementById('registerAuthSection');

                if (!loginSection || !registerSection) return;

                loginSection.classList.add('hidden');
                registerSection.classList.remove('hidden');

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            };

            window.toggleAuthPassword = function(inputId, button) {
                const input = document.getElementById(inputId);

                if (!input || !button) return;

                const icon = button.querySelector('[data-lucide]');

                if (input.type === 'password') {
                    input.type = 'text';

                    if (icon) {
                        icon.setAttribute('data-lucide', 'eye-off');
                    }

                    button.setAttribute('aria-label', 'Hide password');
                } else {
                    input.type = 'password';

                    if (icon) {
                        icon.setAttribute('data-lucide', 'eye');
                    }

                    button.setAttribute('aria-label', 'Show password');
                }

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            };

            window.toggleDesktopAccountMenu = function() {

                const menu = document.getElementById('desktopAccountMenu');
                const chevron = document.getElementById('desktopAccountChevron');

                if (!menu) return;

                const isHidden = menu.classList.contains('hidden');

                menu.classList.toggle('hidden');

                if (chevron) {
                    chevron.classList.toggle('rotate-180', isHidden);
                }

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            };

            window.toggleMobileAccountMenu = function() {

                const menu = document.getElementById('mobileAccountMenu');
                const chevron = document.getElementById('mobileAccountChevron');

                if (!menu) return;

                const isHidden = menu.classList.contains('hidden');

                menu.classList.toggle('hidden');

                if (chevron) {
                    chevron.classList.toggle('rotate-180', isHidden);
                }

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            };

            const loginAuthForm = document.getElementById('loginAuthForm');

            if (loginAuthForm) {

                loginAuthForm.addEventListener('submit', async function(event) {

                    event.preventDefault();

                    const errorBox = document.getElementById('loginAuthError');
                    const errorText = document.getElementById('loginAuthErrorText');
                    const submitButton = loginAuthForm.querySelector('button[type="submit"]');

                    if (errorBox) {
                        errorBox.classList.add('hidden');
                    }

                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.classList.add('opacity-70');

                        submitButton.innerHTML = `
                <i data-lucide="loader-circle" class="h-4 w-4 animate-spin"></i>
                Signing in...
            `;

                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }

                    try {

                        const response = await fetch(loginAuthForm.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: new FormData(loginAuthForm)
                        });

                        const data = await response.json();

                        if (!response.ok || !data.success) {

                            if (errorText) {
                                errorText.textContent =
                                    data.message || 'Invalid username or password.';
                            }

                            if (errorBox) {
                                errorBox.classList.remove('hidden');
                            }

                            return;
                        }

                        window.location.reload();

                    } catch (error) {

                        if (errorText) {
                            errorText.textContent =
                                'Something went wrong. Please try again.';
                        }

                        if (errorBox) {
                            errorBox.classList.remove('hidden');
                        }

                    } finally {

                        if (submitButton) {

                            submitButton.disabled = false;
                            submitButton.classList.remove('opacity-70');

                            submitButton.innerHTML = `
                    <i data-lucide="log-in" class="h-4 w-4"></i>
                    Sign In
                `;

                            if (typeof lucide !== 'undefined') {
                                lucide.createIcons();
                            }
                        }
                    }
                });
            }

            const registerAuthForm = document.getElementById('registerAuthForm');

            if (registerAuthForm) {
                registerAuthForm.addEventListener('submit', async function(event) {
                    event.preventDefault();

                    if (!checkRegisterPasswordMatch()) {
                        registerPasswordConfirmation?.focus();
                        return;
                    }

                    const errorBox = document.getElementById('registerAuthError');
                    const errorText = document.getElementById('registerAuthErrorText');
                    const submitButton = registerAuthForm.querySelector('button[type="submit"]');

                    if (errorBox) {
                        errorBox.classList.add('hidden');
                    }

                    if (errorText) {
                        errorText.innerHTML = '';
                    }

                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.classList.add('opacity-70');

                        submitButton.innerHTML = `
                <i data-lucide="loader-circle" class="h-4 w-4 animate-spin"></i>
                Creating account...
            `;

                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }

                    try {
                        const response = await fetch(registerAuthForm.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: new FormData(registerAuthForm)
                        });

                        const data = await response.json();

                        if (!response.ok || !data.success) {

                            if (data.errors && errorText) {
                                Object.values(data.errors).flat().forEach(message => {
                                    const errorItem = document.createElement('p');
                                    errorItem.textContent = message;
                                    errorText.appendChild(errorItem);
                                });
                            } else if (errorText) {
                                errorText.textContent =
                                    data.message || 'Unable to create account. Please try again.';
                            }

                            if (errorBox) {
                                errorBox.classList.remove('hidden');
                            }

                            return;
                        }

                        window.location.reload();

                    } catch (error) {

                        if (errorText) {
                            errorText.textContent =
                                'Something went wrong. Please try again.';
                        }

                        if (errorBox) {
                            errorBox.classList.remove('hidden');
                        }

                    } finally {

                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.classList.remove('opacity-70');

                            submitButton.innerHTML = `
                    <i data-lucide="user-plus" class="h-4 w-4"></i>
                    Create Account
                `;

                            if (typeof lucide !== 'undefined') {
                                lucide.createIcons();
                            }
                        }
                    }
                });
            }

            const registerPassword = document.getElementById('registerPassword');
            const registerPasswordConfirmation = document.getElementById('registerPasswordConfirmation');
            const registerPasswordMatchMessage = document.getElementById('registerPasswordMatchMessage');

            function checkRegisterPasswordMatch() {
                const password = document.getElementById('registerPassword');
                const confirmation = document.getElementById('registerPasswordConfirmation');
                const message = document.getElementById('registerPasswordMatchMessage');

                if (!password || !confirmation || !message) {
                    return true;
                }

                const passwordValue = password.value;
                const confirmationValue = confirmation.value;

                // Nothing entered yet
                if (!confirmationValue) {
                    confirmation.classList.remove(
                        'border-red-400',
                        'border-emerald-400'
                    );

                    message.textContent = '';
                    message.classList.remove(
                        'text-red-600',
                        'text-emerald-600'
                    );

                    return true;
                }

                // Passwords match
                if (passwordValue === confirmationValue) {

                    confirmation.classList.remove(
                        'border-red-400'
                    );

                    confirmation.classList.add(
                        'border-emerald-400'
                    );

                    message.textContent = 'Passwords match.';

                    message.classList.remove(
                        'text-red-600'
                    );

                    message.classList.add(
                        'text-emerald-600'
                    );

                    return true;
                }

                // Passwords do not match
                confirmation.classList.remove(
                    'border-emerald-400'
                );

                confirmation.classList.add(
                    'border-red-400'
                );

                message.textContent = 'Passwords do not match.';

                message.classList.remove(
                    'text-emerald-600'
                );

                message.classList.add(
                    'text-red-600'
                );

                return false;
            }

            registerPassword?.addEventListener('input', checkRegisterPasswordMatch);

            registerPasswordConfirmation?.addEventListener('input', checkRegisterPasswordMatch);
        });
    </script>


    @stack('scripts')

</body>

</html>
