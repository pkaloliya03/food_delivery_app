<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Ordering - Restaurant Owner</title>

    <script src="https://cdn.tailwindcss.com"></script>
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
        body {
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
        }

        .auth-panel {
            transition:
                opacity 0.35s ease,
                transform 0.35s ease;
        }

        .hidden-panel {
            display: none;
        }

        .fade-in {
            animation: fadeIn 0.35s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-[#f7f7f5] text-slate-900">

    {{-- =========================================================
     AUTH NOTIFICATION POPUP
========================================================= --}}

    @if (session('success') || session('error') || $errors->any())

        <div id="authNotification"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/30 px-4 backdrop-blur-sm transition-opacity duration-300">

            <div id="authNotificationBox"
                class="w-full max-w-sm translate-y-2 scale-95 rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_25px_70px_-20px_rgba(15,23,42,0.35)] opacity-0 transition-all duration-300">

                <div class="flex items-start gap-4">

                    {{-- Icon --}}

                    @if (session('success'))
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50">
                            <i data-lucide="circle-check" class="h-6 w-6 text-emerald-500">
                            </i>
                        </div>
                    @else
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50">
                            <i data-lucide="circle-alert" class="h-6 w-6 text-red-500">
                            </i>
                        </div>
                    @endif


                    {{-- Content --}}

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


                            <button type="button" onclick="closeAuthNotification()"
                                class="shrink-0 rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                                <i data-lucide="x" class="h-4 w-4">
                                </i>

                            </button>

                        </div>


                        <p class="mt-1 text-sm leading-5 text-slate-500">

                            @if (session('success'))
                                {{ session('success') }}
                            @elseif(session('error'))
                                {{ session('error') }}
                            @else
                                {{ $errors->first() }}
                            @endif

                        </p>

                    </div>

                </div>


                {{-- Progress bar --}}

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div id="authNotificationProgress" class="h-full w-full origin-left rounded-full bg-orange-500">
                    </div>

                </div>

            </div>

        </div>

    @endif

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

        <div
            class="w-full max-w-6xl overflow-hidden rounded-[28px] border border-slate-200/80 bg-white shadow-[0_25px_80px_-25px_rgba(15,23,42,0.20)]">

            <div class="grid min-h-[680px] lg:grid-cols-2">

                <!-- =====================================================
                     LEFT BRAND PANEL
                ====================================================== -->

                <div
                    class="relative hidden overflow-hidden bg-slate-950 p-10 text-white lg:flex lg:flex-col lg:justify-between xl:p-14">

                    <!-- Decorative shapes -->

                    <div class="absolute -right-28 -top-28 h-80 w-80 rounded-full bg-orange-500/20 blur-3xl">
                    </div>

                    <div class="absolute -bottom-32 -left-20 h-96 w-96 rounded-full bg-amber-400/10 blur-3xl">
                    </div>

                    <div
                        class="absolute right-16 top-1/2 h-40 w-40 -translate-y-1/2 rounded-full border border-white/5">
                    </div>

                    <!-- Logo -->

                    <div class="relative z-10">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-500 shadow-lg shadow-orange-500/20">

                                <i data-lucide="utensils" class="h-5 w-5 text-white">
                                </i>

                            </div>

                            <div>
                                <p class="text-lg font-bold tracking-tight">
                                    FoodOrder
                                </p>

                                <p class="text-xs text-slate-400">
                                    Restaurant Partner
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- Main Content -->

                    <div class="relative z-10 max-w-md">

                        <div
                            class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-slate-300 backdrop-blur">

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                            Grow your restaurant with us
                        </div>

                        <h1 class="text-4xl font-bold leading-[1.1] tracking-tight xl:text-5xl">

                            Turn your food into
                            <span class="text-orange-400">
                                orders.
                            </span>

                        </h1>

                        <p class="mt-5 max-w-sm text-sm leading-6 text-slate-400">
                            Manage your restaurant, showcase your menu and
                            receive customer orders from one simple platform.
                        </p>

                        <!-- Features -->

                        <div class="mt-9 space-y-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                                    <i data-lucide="store" class="h-4 w-4 text-orange-400">
                                    </i>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold">
                                        Manage your restaurant
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Keep your restaurant details updated
                                    </p>
                                </div>

                            </div>

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                                    <i data-lucide="utensils-crossed" class="h-4 w-4 text-orange-400">
                                    </i>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold">
                                        Build your menu
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Add categories and food items easily
                                    </p>
                                </div>

                            </div>

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                                    <i data-lucide="shopping-bag" class="h-4 w-4 text-orange-400">
                                    </i>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold">
                                        Receive orders
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Manage customer orders from one place
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Bottom -->

                    <div class="relative z-10 text-xs text-slate-600">
                        © {{ date('Y') }} FoodOrder. All rights reserved.
                    </div>

                </div>


                <!-- =====================================================
                     RIGHT AUTH PANEL
                ====================================================== -->

                <div class="flex items-center justify-center p-6 sm:p-10 lg:p-12">

                    <div class="w-full max-w-md">

                        <!-- Mobile Logo -->

                        <div class="mb-8 flex items-center gap-3 lg:hidden">

                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-500">

                                <i data-lucide="utensils" class="h-5 w-5 text-white">
                                </i>

                            </div>

                            <div>
                                <p class="font-bold tracking-tight">
                                    FoodOrder
                                </p>

                                <p class="text-xs text-slate-500">
                                    Restaurant Partner
                                </p>
                            </div>

                        </div>


                        <!-- =================================================
                             LOGIN
                        ================================================== -->

                        <div id="loginPanel" class="auth-panel fade-in">

                            <div class="mb-8">

                                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-orange-500">
                                    Restaurant Partner
                                </p>

                                <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                                    Welcome back
                                </h2>

                                <p class="mt-2 text-sm text-slate-500">
                                    Login to manage your restaurant and orders.
                                </p>

                            </div>


                            <form action="{{ route('login.store') }}" method="POST" class="space-y-5">

                                @csrf

                                <!-- Email -->

                                <div>

                                    <label for="login_email" class="mb-2 block text-sm font-medium text-slate-700">
                                        Email address
                                    </label>

                                    <div class="relative">

                                        <i data-lucide="mail"
                                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                        </i>

                                        <input type="email" id="login_email" name="email"
                                            value="{{ old('email') }}" placeholder="you@example.com"
                                            autocomplete="email" required
                                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-500/10">

                                    </div>

                                </div>


                                <!-- Password -->

                                <div>

                                    <div class="mb-2 flex items-center justify-between">

                                        <label for="login_password" class="block text-sm font-medium text-slate-700">
                                            Password
                                        </label>

                                        <a href="#"
                                            class="text-xs font-medium text-orange-500 hover:text-orange-600">
                                            Forgot password?
                                        </a>

                                    </div>

                                    <div class="relative">

                                        <i data-lucide="lock-keyhole"
                                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                        </i>

                                        <input type="password" id="login_password" name="password"
                                            placeholder="Enter your password" autocomplete="current-password" required
                                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-12 text-sm outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-500/10">

                                        <button type="button" onclick="togglePassword('login_password', 'loginEye')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                                            <i data-lucide="eye" id="loginEye" class="h-4 w-4">
                                            </i>

                                        </button>

                                    </div>

                                </div>


                                <!-- Remember -->

                                <div class="flex items-center">

                                    <label class="flex cursor-pointer items-center gap-2">

                                        <input type="checkbox" name="remember"
                                            class="h-4 w-4 rounded border-slate-300 text-orange-500 focus:ring-orange-500">

                                        <span class="text-xs text-slate-500">
                                            Remember me
                                        </span>

                                    </label>

                                </div>


                                <!-- Button -->

                                <button type="submit"
                                    class="flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-slate-950 text-sm font-semibold text-white shadow-lg shadow-slate-950/10 transition hover:bg-orange-500 hover:shadow-orange-500/20 active:scale-[0.99]">

                                    Login to Dashboard

                                    <i data-lucide="arrow-right" class="h-4 w-4">
                                    </i>

                                </button>

                            </form>


                            <!-- Toggle -->

                            <div class="mt-7 text-center">

                                <p class="text-sm text-slate-500">

                                    Don't have an account?

                                    <button type="button" onclick="showRegister()"
                                        class="font-semibold text-orange-500 hover:text-orange-600">
                                        Create restaurant account
                                    </button>

                                </p>

                            </div>

                        </div>


                        <!-- =================================================
                             REGISTER
                        ================================================== -->

                        <div id="registerPanel" class="auth-panel hidden-panel">

                            <div class="mb-8">

                                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-orange-500">
                                    Restaurant Partner
                                </p>

                                <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                                    Create your account
                                </h2>

                                <p class="mt-2 text-sm text-slate-500">
                                    Start managing your restaurant with FoodOrder.
                                </p>

                            </div>


                            @if ($errors->any())
                                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                                    <div class="flex items-center gap-2 font-semibold">

                                        <i data-lucide="circle-alert" class="h-4 w-4">
                                        </i>

                                        Please check the following:
                                    </div>

                                    <ul class="mt-2 list-inside list-disc space-y-1 text-xs">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>

                                </div>
                            @endif


                            <form action="{{ route('register.store') }}" method="POST" class="space-y-4">

                                @csrf

                                <!-- Username -->

                                <div>

                                    <label for="username" class="mb-2 block text-sm font-medium text-slate-700">
                                        Username
                                    </label>

                                    <div class="relative">

                                        <i data-lucide="user-round"
                                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                        </i>

                                        <input type="text" id="username" name="username"
                                            value="{{ old('username') }}" placeholder="Choose a username"
                                            autocomplete="username" required
                                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-500/10">

                                    </div>

                                </div>


                                <!-- Email + Mobile -->

                                <div class="grid gap-4 sm:grid-cols-2">

                                    <div>

                                        <label for="register_email"
                                            class="mb-2 block text-sm font-medium text-slate-700">
                                            Email
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="mail"
                                                class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                            </i>

                                            <input type="email" id="register_email" name="email"
                                                value="{{ old('email') }}" placeholder="you@example.com"
                                                autocomplete="email" required
                                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-500/10">

                                        </div>

                                    </div>


                                    <div>

                                        <label for="mobile" class="mb-2 block text-sm font-medium text-slate-700">
                                            Mobile
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="phone"
                                                class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                            </i>

                                            <input type="tel" id="mobile" name="mobile"
                                                value="{{ old('mobile') }}" placeholder="9876543210"
                                                autocomplete="tel" required
                                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-500/10">

                                        </div>

                                    </div>

                                </div>


                                <!-- Password -->

                                <div>

                                    <label for="register_password"
                                        class="mb-2 block text-sm font-medium text-slate-700">
                                        Password
                                    </label>

                                    <div class="relative">

                                        <i data-lucide="lock-keyhole"
                                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                        </i>

                                        <input type="password" id="register_password" name="password"
                                            placeholder="Create a password" autocomplete="new-password" required
                                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-12 text-sm outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-500/10">

                                        <button type="button"
                                            onclick="togglePassword('register_password', 'registerEye')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                                            <i data-lucide="eye" id="registerEye" class="h-4 w-4">
                                            </i>

                                        </button>

                                    </div>

                                </div>


                                <!-- Confirm Password -->

                                <div>

                                    <label for="password_confirmation"
                                        class="mb-2 block text-sm font-medium text-slate-700">
                                        Confirm password
                                    </label>

                                    <div class="relative">

                                        <i data-lucide="shield-check"
                                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                        </i>

                                        <input type="password" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm your password"
                                            autocomplete="new-password" required
                                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-500/10">

                                    </div>

                                </div>


                                <!-- Terms -->

                                <label class="flex cursor-pointer items-start gap-2 pt-1">

                                    <input type="checkbox" required
                                        class="mt-0.5 h-4 w-4 rounded border-slate-300 text-orange-500 focus:ring-orange-500">

                                    <span class="text-xs leading-5 text-slate-500">
                                        I agree to the
                                        <a href="#" class="font-medium text-slate-700 hover:text-orange-500">
                                            Terms & Conditions
                                        </a>
                                        and
                                        <a href="#" class="font-medium text-slate-700 hover:text-orange-500">
                                            Privacy Policy
                                        </a>.
                                    </span>

                                </label>


                                <!-- Button -->

                                <button type="submit"
                                    class="flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-slate-950 text-sm font-semibold text-white shadow-lg shadow-slate-950/10 transition hover:bg-orange-500 hover:shadow-orange-500/20 active:scale-[0.99]">

                                    Create Restaurant Account

                                    <i data-lucide="arrow-right" class="h-4 w-4">
                                    </i>

                                </button>

                            </form>


                            <!-- Toggle -->

                            <div class="mt-6 text-center">

                                <p class="text-sm text-slate-500">

                                    Already have an account?

                                    <button type="button" onclick="showLogin()"
                                        class="font-semibold text-orange-500 hover:text-orange-600">
                                        Login here
                                    </button>

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>
        lucide.createIcons();


        function showRegister() {

            const loginPanel = document.getElementById('loginPanel');
            const registerPanel = document.getElementById('registerPanel');

            loginPanel.classList.add('hidden-panel');
            loginPanel.classList.remove('fade-in');

            registerPanel.classList.remove('hidden-panel');

            void registerPanel.offsetWidth;

            registerPanel.classList.add('fade-in');

            lucide.createIcons();
        }


        function showLogin() {

            const loginPanel = document.getElementById('loginPanel');
            const registerPanel = document.getElementById('registerPanel');

            registerPanel.classList.add('hidden-panel');
            registerPanel.classList.remove('fade-in');

            loginPanel.classList.remove('hidden-panel');

            void loginPanel.offsetWidth;

            loginPanel.classList.add('fade-in');

            lucide.createIcons();
        }


        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                input.type = 'text';

                icon.setAttribute('data-lucide', 'eye-off');

            } else {

                input.type = 'password';

                icon.setAttribute('data-lucide', 'eye');

            }

            lucide.createIcons();
        }

        // =========================================================
        // AUTH NOTIFICATION
        // =========================================================

        function closeAuthNotification() {

            const notification = document.getElementById('authNotification');
            const box = document.getElementById('authNotificationBox');

            if (!notification || !box) {
                return;
            }

            box.classList.remove('translate-y-0', 'scale-100', 'opacity-100');

            box.classList.add('translate-y-2', 'scale-95', 'opacity-0');

            notification.classList.add('opacity-0');

            setTimeout(() => {
                notification.remove();
            }, 300);
        }


        // Show popup smoothly

        document.addEventListener('DOMContentLoaded', function() {

            const notification = document.getElementById('authNotification');
            const box = document.getElementById('authNotificationBox');
            const progress = document.getElementById('authNotificationProgress');

            if (!notification || !box) {
                return;
            }

            lucide.createIcons();

            setTimeout(() => {

                box.classList.remove('translate-y-2', 'scale-95', 'opacity-0');

                box.classList.add('translate-y-0', 'scale-100', 'opacity-100');

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

                closeAuthNotification();

            }, 4000);

        });
    </script>

</body>

</html>
