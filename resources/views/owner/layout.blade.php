<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - FoodOrder</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        * {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
        }

        .sidebar-transition {
            transition: transform 0.25s ease-in-out;
        }

        .overlay-transition {
            transition: opacity 0.25s ease-in-out;
        }
    </style>

    @stack('styles')
</head>


<body class="bg-[#f7f8fa] text-slate-900 antialiased">

    <!-- =========================================================
         MOBILE OVERLAY
    ========================================================== -->

    <div id="sidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-slate-950/50 opacity-0 backdrop-blur-sm lg:hidden overlay-transition"
        onclick="closeSidebar()">
    </div>


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

    <aside id="sidebar"
        class="sidebar-transition fixed inset-y-0 left-0 z-50 flex w-[270px] -translate-x-full flex-col border-r border-slate-200 bg-white lg:translate-x-0">

        <!-- Logo -->

        <div class="flex h-[76px] shrink-0 items-center border-b border-slate-100 px-6">

            <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 shadow-lg shadow-orange-500/20">

                    <i data-lucide="utensils" class="h-5 w-5 text-white">
                    </i>

                </div>

                <div>
                    <div class="text-[16px] font-bold tracking-tight text-slate-900">
                        FoodOrder
                    </div>

                    <div class="text-[10px] font-medium uppercase tracking-[0.16em] text-slate-400">
                        Restaurant Partner
                    </div>
                </div>

            </a>


            <!-- Mobile Close -->

            <button type="button" onclick="closeSidebar()"
                class="ml-auto flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 lg:hidden">

                <i data-lucide="x" class="h-5 w-5"></i>

            </button>

        </div>


        <!-- =====================================================
             NAVIGATION
        ====================================================== -->

        <div class="flex-1 overflow-y-auto px-4 py-6">

            <div class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Main Menu
            </div>


            <nav class="space-y-1">

                <!-- Dashboard -->

                <a href="{{ route('owner.dashboard') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('owner.dashboard')
                        ? 'bg-orange-50 text-orange-600'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

                    <i data-lucide="layout-dashboard"
                        class="h-[18px] w-[18px]
                        {{ request()->routeIs('owner.dashboard') ? 'text-orange-500' : 'text-slate-400 group-hover:text-slate-600' }}">
                    </i>

                    <span>Dashboard</span>

                </a>


                <!-- Restaurants -->

                <a href="{{ route('owner.restaurants.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('owner.restaurants*')
                        ? 'bg-slate-900 text-white shadow-sm'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

                    <i data-lucide="store"
                        class="h-[18px] w-[18px]
                        {{ request()->routeIs('owner.restaurants*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">
                    </i>

                    <span>Restaurants</span>

                </a>


                <!-- Categories -->

                <a href="{{ route('owner.categories.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('owner.categories*')
                        ? 'bg-slate-900 text-white shadow-sm'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

                    <i data-lucide="layers"
                        class="h-[18px] w-[18px]
                        {{ request()->routeIs('owner.categories*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">
                    </i>

                    <span>Categories</span>

                </a>


                <!-- Food Items -->

                <a href="{{ route('owner.items.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('owner.items*')
                        ? 'bg-slate-900 text-white shadow-sm'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

                    <i data-lucide="utensils-crossed"
                        class="h-[18px] w-[18px]
                        {{ request()->routeIs('owner.items*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}">
                    </i>

                    <span>Food Items</span>

                </a>


                <!-- Orders -->

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">

                    <i data-lucide="shopping-bag" class="h-[18px] w-[18px] text-slate-400 group-hover:text-slate-600">
                    </i>

                    <span>Orders</span>

                    <!-- Example notification -->

                    <span
                        class="ml-auto hidden min-w-[20px] items-center justify-center rounded-full bg-orange-100 px-1.5 py-0.5 text-[10px] font-bold text-orange-600">
                        0
                    </span>

                </a>


                <!-- Delivery Boys -->

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">

                    <i data-lucide="bike" class="h-[18px] w-[18px] text-slate-400 group-hover:text-slate-600">
                    </i>

                    <span>Delivery Boys</span>

                </a>

            </nav>


            <!-- Management -->

            <div class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Management
            </div>


            <nav class="space-y-1">

                <!-- Profile -->

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">

                    <i data-lucide="user-round" class="h-[18px] w-[18px] text-slate-400 group-hover:text-slate-600">
                    </i>

                    <span>Profile</span>

                </a>


                <!-- Settings -->

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">

                    <i data-lucide="settings-2" class="h-[18px] w-[18px] text-slate-400 group-hover:text-slate-600">
                    </i>

                    <span>Settings</span>

                </a>

            </nav>

        </div>


        <!-- =====================================================
             USER / LOGOUT AREA
        ====================================================== -->

        <div class="shrink-0 border-t border-slate-100 p-4">

            <!-- User Info -->

            <div class="mb-3 flex items-center gap-3 rounded-xl bg-slate-50 p-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-orange-100 text-sm font-bold text-orange-600">

                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}

                </div>

                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-semibold text-slate-800">
                        {{ auth()->user()->username }}
                    </p>

                    <p class="truncate text-[11px] text-slate-400">
                        Restaurant Owner
                    </p>

                </div>

            </div>


            <!-- Logout -->

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit"
                    class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600">

                    <i data-lucide="log-out"
                        class="h-[18px] w-[18px] text-slate-400 transition group-hover:text-red-500">
                    </i>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </aside>


    <!-- =========================================================
         MAIN CONTENT
    ========================================================== -->

    <div class="min-h-screen lg:pl-[270px]">

        <!-- =====================================================
             TOP HEADER
        ====================================================== -->

        <header
            class="sticky top-0 z-30 flex h-[76px] items-center justify-between border-b border-slate-200/80 bg-white/90 px-4 backdrop-blur-md sm:px-6 lg:px-8">

            <!-- Mobile Menu -->

            <div class="flex items-center gap-3">

                <button type="button" onclick="openSidebar()"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 shadow-sm hover:bg-slate-50 lg:hidden">

                    <i data-lucide="menu" class="h-5 w-5"></i>

                </button>


                <div class="lg:hidden">

                    <p class="text-sm font-bold text-slate-900">
                        FoodOrder
                    </p>

                </div>


                <!-- Desktop Page Title -->

                <div class="hidden lg:block">

                    <p class="text-xs font-medium text-slate-400">
                        @yield('breadcrumb', 'Restaurant Owner')
                    </p>

                    <h1 class="text-lg font-bold tracking-tight text-slate-900">
                        @yield('page-title', 'Dashboard')
                    </h1>

                </div>

            </div>


            <!-- Right Side -->

            <div class="flex items-center gap-2 sm:gap-3">

                <!-- Notifications -->

                <button type="button"
                    class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:bg-slate-50 hover:text-slate-800">

                    <i data-lucide="bell" class="h-[18px] w-[18px]">
                    </i>

                    <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-orange-500">
                    </span>

                </button>


                <!-- User -->

                <div
                    class="hidden items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 sm:flex">

                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-100 text-xs font-bold text-orange-600">

                        {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}

                    </div>

                    <div class="max-w-[120px]">

                        <p class="truncate text-xs font-semibold text-slate-800">
                            {{ auth()->user()->username }}
                        </p>

                        <p class="truncate text-[10px] text-slate-400">
                            Owner
                        </p>

                    </div>

                </div>

            </div>

        </header>


        <!-- =====================================================
             PAGE CONTENT
        ====================================================== -->

        <main class="p-4 sm:p-6 lg:p-8">

            {{-- =========================================================
            COMMON SUCCESS / ERROR NOTIFICATION MODAL
            ========================================================= --}}

            @if (session('success') || session('error'))
                <div id="ownerNotification"
                    class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/30 px-4 backdrop-blur-sm transition-opacity duration-300">

                    <div id="ownerNotificationBox"
                        class="w-full max-w-sm translate-y-2 scale-95 rounded-2xl border border-slate-200 bg-white p-5 opacity-0 shadow-[0_25px_70px_-20px_rgba(15,23,42,0.35)] transition-all duration-300">

                        <div class="flex items-start gap-4">

                            {{-- Icon --}}
                            @if (session('success'))
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50">
                                    <i data-lucide="circle-check" class="h-6 w-6 text-emerald-500"></i>
                                </div>
                            @else
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50">
                                    <i data-lucide="circle-alert" class="h-6 w-6 text-red-500"></i>
                                </div>
                            @endif

                            {{-- Message --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-3">

                                    <div>
                                        @if (session('success'))
                                            <h3 class="text-sm font-bold text-slate-900">
                                                Success
                                            </h3>
                                        @else
                                            <h3 class="text-sm font-bold text-slate-900">
                                                Something went wrong
                                            </h3>
                                        @endif
                                    </div>

                                    {{-- Close --}}
                                    <button type="button" onclick="closeOwnerNotification()"
                                        class="shrink-0 rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                                        <i data-lucide="x" class="h-4 w-4"></i>

                                    </button>

                                </div>

                                <p class="mt-1 text-sm leading-5 text-slate-500">
                                    @if (session('success'))
                                        {{ session('success') }}
                                    @else
                                        {{ session('error') }}
                                    @endif
                                </p>

                            </div>
                        </div>

                        {{-- Progress Bar --}}
                        <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div id="ownerNotificationProgress"
                                class="h-full w-full origin-left rounded-full
                                    {{ session('success') ? 'bg-emerald-500' : 'bg-red-500' }}">
                            </div>

                        </div>

                    </div>
                </div>
            @endif

            @yield('content')

        </main>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>
        lucide.createIcons();


        // ---------------------------------------------------------
        // Mobile Sidebar
        // ---------------------------------------------------------

        function openSidebar() {

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.remove('-translate-x-full');

            overlay.classList.remove('hidden');

            setTimeout(() => {
                overlay.classList.remove('opacity-0');
            }, 10);

            document.body.classList.add('overflow-hidden');
        }


        function closeSidebar() {

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.add('-translate-x-full');

            overlay.classList.add('opacity-0');

            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 250);

            document.body.classList.remove('overflow-hidden');
        }


        // ---------------------------------------------------------
        // Common Success / Error Notification
        // ---------------------------------------------------------

        function closeOwnerNotification() {

            const notification = document.getElementById('ownerNotification');
            const box = document.getElementById('ownerNotificationBox');

            if (!notification || !box) return;

            box.classList.remove(
                'translate-y-0',
                'scale-100',
                'opacity-100'
            );

            box.classList.add(
                'translate-y-2',
                'scale-95',
                'opacity-0'
            );

            notification.classList.add('opacity-0');

            setTimeout(() => {
                notification.remove();
            }, 300);
        }


        document.addEventListener('DOMContentLoaded', function() {

            const notification = document.getElementById('ownerNotification');
            const box = document.getElementById('ownerNotificationBox');
            const progress = document.getElementById('ownerNotificationProgress');

            if (!notification || !box) return;

            // Initialize Lucide icons
            lucide.createIcons();


            // Show popup animation
            setTimeout(() => {

                box.classList.remove(
                    'translate-y-2',
                    'scale-95',
                    'opacity-0'
                );

                box.classList.add(
                    'translate-y-0',
                    'scale-100',
                    'opacity-100'
                );

            }, 50);


            // Progress bar animation
            if (progress) {

                progress.style.transition = 'transform 2.8s linear';

                setTimeout(() => {
                    progress.style.transform = 'scaleX(0)';
                }, 100);

            }


            // Auto close after 3 seconds
            setTimeout(() => {
                closeOwnerNotification();
            }, 4000);

        });
    </script>

    @stack('scripts')

</body>

</html>
