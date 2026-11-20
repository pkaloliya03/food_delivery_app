@extends('user.layout')

@section('title', 'Home | Foodly')
@section('meta_description', 'Discover restaurants, delicious dishes and great food around you.')

@section('content')

    {{-- =========================================================
        HERO SECTION
    ========================================================== --}}
    <section class="relative overflow-hidden bg-slate-950">

        {{-- Decorative background --}}
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl"></div>
            <div class="absolute -bottom-40 right-0 h-96 w-96 rounded-full bg-orange-400/15 blur-3xl"></div>
        </div>


        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="relative min-h-[520px] lg:min-h-[590px]">

                {{-- Slide 1 --}}
                <div class="home-slide absolute inset-0 opacity-100 transition-all duration-700 ease-out" data-slide="0">

                    <div
                        class="grid min-h-[520px] items-center gap-10 py-14 lg:min-h-[590px] lg:grid-cols-2 lg:gap-16 lg:py-20">

                        <div class="relative z-10 max-w-xl">

                            <div
                                class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3.5 py-2 text-xs font-semibold text-white backdrop-blur-md">
                                <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-400"></span>
                                Delicious food, delivered
                            </div>

                            <h1
                                class="text-4xl font-black leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl">
                                Good food is
                                <span class="text-emerald-400">always</span>
                                a good idea.
                            </h1>

                            <p class="mt-5 max-w-lg text-base leading-7 text-slate-300 sm:text-lg">
                                Discover the best restaurants and your favorite dishes around you. Order what you love,
                                whenever you want.
                            </p>


                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                                <a href="#restaurants"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:-translate-y-0.5 hover:bg-emerald-400">
                                    Explore Restaurants
                                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                                </a>

                                <a href="#popular"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/10">
                                    Browse Popular Food
                                </a>

                            </div>


                            <div class="mt-9 flex flex-wrap items-center gap-x-6 gap-y-3 text-xs text-slate-400">

                                <div class="flex items-center gap-2">
                                    <i data-lucide="shield-check" class="h-4 w-4 text-emerald-400"></i>
                                    Trusted restaurants
                                </div>

                                <div class="flex items-center gap-2">
                                    <i data-lucide="clock-3" class="h-4 w-4 text-emerald-400"></i>
                                    Easy ordering
                                </div>

                                <div class="flex items-center gap-2">
                                    <i data-lucide="heart" class="h-4 w-4 text-rose-400"></i>
                                    Made for food lovers
                                </div>

                            </div>

                        </div>


                        {{-- Hero Image --}}
                        <div class="relative hidden lg:block">

                            <div class="absolute -inset-5 rounded-[2rem] bg-emerald-500/10 blur-2xl">
                            </div>

                            <div
                                class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 p-2 shadow-2xl">

                                <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=1000&q=85"
                                    alt="Fresh pizza" class="h-[430px] w-full rounded-[1.5rem] object-cover">

                                <div
                                    class="absolute bottom-7 left-7 right-7 flex items-center justify-between rounded-2xl border border-white/20 bg-slate-950/75 p-4 backdrop-blur-xl">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-slate-900">
                                            <i data-lucide="utensils" class="h-5 w-5"></i>
                                        </div>

                                        <div>
                                            <p class="text-sm font-bold text-white">
                                                Your next favorite meal
                                            </p>
                                            <p class="mt-0.5 text-xs text-slate-400">
                                                Just a few clicks away
                                            </p>
                                        </div>

                                    </div>

                                    <div class="hidden items-center gap-1.5 sm:flex">
                                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                        <span class="text-xs font-semibold text-white">Fresh</span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Slide 2 --}}
                <div class="home-slide pointer-events-none absolute inset-0 opacity-0 transition-all duration-700 ease-out"
                    data-slide="1">

                    <div
                        class="grid min-h-[520px] items-center gap-10 py-14 lg:min-h-[590px] lg:grid-cols-2 lg:gap-16 lg:py-20">

                        <div class="relative z-10 max-w-xl">

                            <div
                                class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3.5 py-2 text-xs font-semibold text-white backdrop-blur-md">
                                <i data-lucide="sparkles" class="h-3.5 w-3.5 text-amber-300"></i>
                                Discover something delicious
                            </div>

                            <h2
                                class="text-4xl font-black leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl">
                                Cravings?
                                <span class="text-amber-300">We've got you.</span>
                            </h2>

                            <p class="mt-5 max-w-lg text-base leading-7 text-slate-300 sm:text-lg">
                                From quick bites to comforting classics, find dishes that match your mood and make your
                                day a little better.
                            </p>

                            <a href="#popular"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-slate-900 shadow-lg transition hover:-translate-y-0.5 hover:bg-slate-100">
                                See What's Popular
                                <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                            </a>

                        </div>


                        <div class="relative hidden lg:block">

                            <div class="relative overflow-hidden rounded-[2rem] border border-white/10 p-2 shadow-2xl">

                                <img src="https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=1000&q=85"
                                    alt="Healthy food bowl" class="h-[430px] w-full rounded-[1.5rem] object-cover">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Slide 3 --}}
                <div class="home-slide pointer-events-none absolute inset-0 opacity-0 transition-all duration-700 ease-out"
                    data-slide="2">

                    <div
                        class="grid min-h-[520px] items-center gap-10 py-14 lg:min-h-[590px] lg:grid-cols-2 lg:gap-16 lg:py-20">

                        <div class="relative z-10 max-w-xl">

                            <div
                                class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3.5 py-2 text-xs font-semibold text-white backdrop-blur-md">
                                <i data-lucide="map-pin" class="h-3.5 w-3.5 text-rose-300"></i>
                                Find food around you
                            </div>

                            <h2
                                class="text-4xl font-black leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl">
                                Your city.
                                <span class="text-rose-300">Your food.</span>
                            </h2>

                            <p class="mt-5 max-w-lg text-base leading-7 text-slate-300 sm:text-lg">
                                Explore restaurants near you, compare menus and choose exactly what you feel like eating
                                today.
                            </p>

                            <button type="button"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-rose-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition hover:-translate-y-0.5 hover:bg-rose-400">
                                Choose Your City
                                <i data-lucide="map-pin" class="h-4 w-4"></i>
                            </button>

                        </div>


                        <div class="relative hidden lg:block">

                            <div class="relative overflow-hidden rounded-[2rem] border border-white/10 p-2 shadow-2xl">

                                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1000&q=85"
                                    alt="Restaurant interior" class="h-[430px] w-full rounded-[1.5rem] object-cover">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Carousel Controls --}}
                <div class="absolute bottom-7 left-0 z-20 flex items-center gap-2 lg:bottom-9">

                    <button type="button" id="homePrev"
                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/10 text-white backdrop-blur transition hover:bg-white/20"
                        aria-label="Previous slide">
                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    </button>

                    <button type="button" id="homeNext"
                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/10 text-white backdrop-blur transition hover:bg-white/20"
                        aria-label="Next slide">
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </button>

                    <div class="ml-2 flex items-center gap-1.5" id="homeDots">

                        <button type="button" data-dot="0"
                            class="home-dot h-1.5 w-7 rounded-full bg-white transition-all"></button>
                        <button type="button" data-dot="1"
                            class="home-dot h-1.5 w-2 rounded-full bg-white/30 transition-all"></button>
                        <button type="button" data-dot="2"
                            class="home-dot h-1.5 w-2 rounded-full bg-white/30 transition-all"></button>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        QUICK CATEGORIES
    ========================================================== --}}
    <section class="border-b border-slate-100 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="flex items-end justify-between gap-4">

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-500">
                        Explore
                    </p>

                    <h2 class="mt-1 text-xl font-extrabold tracking-tight text-slate-900 sm:text-2xl">
                        What are you craving?
                    </h2>
                </div>

                <a href="#categories"
                    class="hidden items-center gap-1 text-sm font-semibold text-slate-500 transition hover:text-slate-900 sm:flex">
                    View all
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>

            </div>


            <div class="hide-scrollbar mt-6 flex gap-4 overflow-x-auto pb-1">

                @php
                    $categories = [
                        ['name' => 'Pizza', 'icon' => '🍕'],
                        ['name' => 'Burgers', 'icon' => '🍔'],
                        ['name' => 'Biryani', 'icon' => '🍛'],
                        ['name' => 'Chinese', 'icon' => '🥡'],
                        ['name' => 'South Indian', 'icon' => '🥞'],
                        ['name' => 'Desserts', 'icon' => '🍰'],
                        ['name' => 'Healthy', 'icon' => '🥗'],
                        ['name' => 'Drinks', 'icon' => '🥤'],
                    ];
                @endphp

                @foreach ($categories as $category)
                    <a href="#"
                        class="group flex min-w-[92px] shrink-0 flex-col items-center rounded-2xl border border-slate-200 bg-slate-50 px-3 py-4 transition duration-300 hover:-translate-y-1 hover:border-slate-300 hover:bg-white hover:shadow-lg">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-3xl shadow-sm transition duration-300 group-hover:scale-110">
                            {{ $category['icon'] }}
                        </div>

                        <span class="mt-3 text-xs font-bold text-slate-700">
                            {{ $category['name'] }}
                        </span>

                    </a>
                @endforeach

            </div>

        </div>

    </section>


    {{-- =========================================================
        POPULAR RESTAURANTS
    ========================================================== --}}

    {{-- <section class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-emerald-600">
                        Explore
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Popular Restaurants
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Discover great food from restaurants around you.
                    </p>
                </div>

                <button type="button"
                    class="hidden items-center gap-1.5 text-sm font-bold text-slate-600 transition hover:text-emerald-600 sm:flex">
                    View all
                    <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                </button>
            </div>

            @if ($restaurants->count())

                <div class="mt-9 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                    @foreach ($restaurants as $restaurant)
                        <article
                            class="group relative aspect-[4/5] overflow-hidden rounded-[1.75rem] bg-slate-900 shadow-sm transition duration-500 hover:-translate-y-1 hover:shadow-2xl">

                            @if ($restaurant->cover_image)
                                <img src="{{ asset('storage/' . $restaurant->cover_image) }}"
                                    alt="{{ $restaurant->name }}"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 ease-out group-hover:scale-110">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-slate-100">

                                    <i data-lucide="utensils-crossed" class="h-12 w-12 text-slate-300">
                                    </i>

                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-black/10">
                            </div>

                            <div class="absolute inset-0 bg-black/0 transition duration-500 group-hover:bg-black/10">
                            </div>

                            <div class="absolute left-4 top-4">

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-white/95 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wide text-slate-800 shadow-lg backdrop-blur">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    Open

                                </span>

                            </div>

                            <button type="button"
                                class="absolute right-4 top-4 flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-white backdrop-blur-md transition duration-300 hover:bg-white hover:text-slate-900">

                                <i data-lucide="heart" class="h-4 w-4">
                                </i>

                            </button>

                            <div class="absolute inset-x-0 bottom-0 p-5 sm:p-6">

                                @if ($restaurant->city)
                                    <div class="mb-2 flex items-center gap-1.5 text-xs font-medium text-white/75">

                                        <i data-lucide="map-pin" class="h-3.5 w-3.5">
                                        </i>

                                        <span>
                                            {{ $restaurant->city->name }}
                                        </span>

                                    </div>
                                @endif

                                <h3
                                    class="text-xl font-extrabold tracking-tight text-white transition duration-300 group-hover:text-emerald-300 sm:text-2xl">
                                    {{ $restaurant->name }}
                                </h3>


                                @if ($restaurant->description)
                                    <p class="mt-2 line-clamp-2 text-xs leading-5 text-white/70">
                                        {{ $restaurant->description }}
                                    </p>
                                @endif


                                <div class="mt-4 flex items-center justify-between border-t border-white/15 pt-4">

                                    <div class="flex items-center gap-1.5 text-xs font-medium text-white/75">

                                        <i data-lucide="clock" class="h-3.5 w-3.5">
                                        </i>

                                        <span>

                                            @if ($restaurant->opening_time && $restaurant->closing_time)
                                                {{ \Carbon\Carbon::parse($restaurant->opening_time)->format('g:i A') }}
                                                -
                                                {{ \Carbon\Carbon::parse($restaurant->closing_time)->format('g:i A') }}
                                            @else
                                                Open today
                                            @endif

                                        </span>

                                    </div>



                                    <button type="button"
                                        class="inline-flex items-center gap-1.5 text-xs font-bold text-white transition hover:text-emerald-300">

                                        Explore

                                        <i data-lucide="arrow-up-right"
                                            class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5">
                                        </i>

                                    </button>

                                </div>

                            </div>

                        </article>
                    @endforeach

                </div>
            @else
                <div class="mt-8 rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm">

                        <i data-lucide="store" class="h-6 w-6 text-slate-400">
                        </i>

                    </div>

                    <h3 class="mt-4 text-base font-bold text-slate-800">
                        No restaurants available
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        We couldn't find any active restaurants right now.
                    </p>

                </div>

            @endif

        </div>
    </section> --}}


    {{-- for Featured Restaurant this is the design. --}}

    <section class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            {{-- Section Header --}}
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-emerald-600">
                        Explore
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Popular Restaurants
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Discover great food from restaurants around you.
                    </p>
                </div>

                <button type="button"
                    class="hidden items-center gap-1.5 text-sm font-bold text-slate-600 transition hover:text-emerald-600 sm:flex">

                    View all

                    <i data-lucide="arrow-up-right" class="h-4 w-4"></i>

                </button>
            </div>


            {{-- Restaurants --}}
            @if ($restaurants->count())

                <div class="mt-9 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">

                    @foreach ($restaurants as $index => $restaurant)
                        @php
                            /*
                             * First restaurant becomes the featured bento card.
                             */
                            $isFeatured = $index === 0;
                        @endphp


                        <article
                            class="group relative overflow-hidden rounded-[1.75rem] bg-slate-900
                            {{ $isFeatured ? 'md:col-span-2 md:row-span-2 min-h-[430px]' : 'min-h-[250px]' }}">

                            {{-- Image --}}
                            @if ($restaurant->cover_image)
                                <img src="{{ asset('storage/' . $restaurant->cover_image) }}"
                                    alt="{{ $restaurant->name }}"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 ease-out group-hover:scale-110">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-slate-100">

                                    <i data-lucide="utensils-crossed" class="h-10 w-10 text-slate-300">
                                    </i>

                                </div>
                            @endif


                            {{-- Gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-black/5">
                            </div>


                            {{-- Hover Overlay --}}
                            <div class="absolute inset-0 bg-black/0 transition duration-500 group-hover:bg-black/10">
                            </div>


                            {{-- Top Badge --}}
                            <div class="absolute left-4 top-4">

                                @if ($isFeatured)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500 px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-wide text-white shadow-lg">

                                        <i data-lucide="sparkles" class="h-3 w-3">
                                        </i>

                                        Featured

                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-white/95 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wide text-emerald-600 shadow-sm backdrop-blur">

                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                        Open

                                    </span>
                                @endif

                            </div>


                            {{-- Favourite --}}
                            <button type="button"
                                class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full bg-white/15 text-white backdrop-blur-md transition duration-300 hover:bg-white hover:text-slate-900">

                                <i data-lucide="heart" class="h-4 w-4">
                                </i>

                            </button>


                            {{-- Content --}}
                            <div class="absolute inset-x-0 bottom-0 p-5 sm:p-6">

                                {{-- City --}}
                                @if ($restaurant->city)
                                    <div class="mb-2 flex items-center gap-1.5 text-xs font-medium text-white/70">

                                        <i data-lucide="map-pin" class="h-3.5 w-3.5">
                                        </i>

                                        {{ $restaurant->city->name }}

                                    </div>
                                @endif


                                {{-- Name --}}
                                <h3
                                    class="{{ $isFeatured ? 'text-2xl sm:text-3xl' : 'text-lg' }} font-extrabold tracking-tight text-white transition group-hover:text-emerald-300">

                                    {{ $restaurant->name }}

                                </h3>


                                {{-- Description --}}
                                @if ($restaurant->description)
                                    <p
                                        class="{{ $isFeatured ? 'max-w-md' : 'line-clamp-2' }} mt-2 text-xs leading-5 text-white/70">

                                        {{ $restaurant->description }}

                                    </p>
                                @endif


                                {{-- Bottom --}}
                                <div class="mt-4 flex items-center justify-between border-t border-white/15 pt-3">

                                    <div class="flex items-center gap-1.5 text-xs text-white/70">

                                        <i data-lucide="clock" class="h-3.5 w-3.5">
                                        </i>

                                        <span>

                                            @if ($restaurant->opening_time && $restaurant->closing_time)
                                                {{ \Carbon\Carbon::parse($restaurant->opening_time)->format('g:i A') }}
                                                -
                                                {{ \Carbon\Carbon::parse($restaurant->closing_time)->format('g:i A') }}
                                            @else
                                                Open today
                                            @endif

                                        </span>

                                    </div>


                                    <button type="button"
                                        class="flex items-center gap-1.5 text-xs font-bold text-white transition hover:text-emerald-300">

                                        Menu

                                        <i data-lucide="arrow-up-right"
                                            class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5">
                                        </i>

                                    </button>

                                </div>

                            </div>

                        </article>
                    @endforeach

                </div>
            @else
                {{-- Empty State --}}
                <div class="mt-8 rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm">

                        <i data-lucide="store" class="h-6 w-6 text-slate-400">
                        </i>

                    </div>

                    <h3 class="mt-4 text-base font-bold text-slate-800">
                        No restaurants available
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        We couldn't find any active restaurants right now.
                    </p>

                </div>

            @endif

        </div>
    </section>


    {{-- =========================================================
        POPULAR DISHES
    ========================================================== --}}
    <section id="popular" class="bg-white py-14 sm:py-16">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex items-end justify-between gap-4">

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-500">
                        Trending now
                    </p>

                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Popular dishes
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Delicious picks worth trying today.
                    </p>
                </div>

                <a href="#"
                    class="hidden items-center gap-2 text-sm font-bold text-slate-700 transition hover:text-emerald-600 sm:flex">
                    See all
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>

            </div>


            <div class="hide-scrollbar mt-8 flex gap-5 overflow-x-auto pb-4">

                @if ($items->count())

                    @foreach ($items as $item)
                        <div
                            class="group w-[260px] shrink-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                            {{-- Item Image --}}
                            <div class="relative h-48 overflow-hidden bg-slate-100">

                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <i data-lucide="utensils-crossed" class="h-10 w-10 text-slate-300">
                                        </i>
                                    </div>
                                @endif


                                {{-- Favourite --}}
                                <button type="button"
                                    class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-white/95 text-slate-600 shadow-sm transition hover:bg-white hover:text-rose-500"
                                    aria-label="Add to favorites">

                                    <i data-lucide="heart" class="h-4 w-4"></i>

                                </button>


                                {{-- Popular --}}
                                <span
                                    class="absolute bottom-3 left-3 rounded-lg bg-white/95 px-2.5 py-1 text-[11px] font-bold text-slate-700">

                                    Popular

                                </span>

                            </div>


                            {{-- Item Details --}}
                            <div class="p-4">

                                {{-- Item Name + Price --}}
                                <div class="flex items-start justify-between gap-3">

                                    <div class="min-w-0">

                                        <h3 class="truncate text-sm font-bold text-slate-900">
                                            {{ $item->name }}
                                        </h3>

                                        {{-- Restaurant --}}
                                        @if ($item->restaurant)
                                            <p class="mt-1 truncate text-xs text-slate-400">
                                                {{ $item->restaurant->name }}
                                            </p>
                                        @endif

                                    </div>

                                    {{-- Price --}}
                                    <p class="shrink-0 text-sm font-extrabold text-slate-900">
                                        ₹{{ number_format((float) $item->price, 2) }}
                                    </p>

                                </div>


                                {{-- Category + Veg / Non-Veg --}}
                                <div class="mt-2.5 flex items-center gap-2">

                                    {{-- Category --}}
                                    @if ($item->category)
                                        <span class="truncate text-[11px] font-medium text-slate-400">
                                            {{ $item->category->name }}
                                        </span>

                                        <span class="h-1 w-1 shrink-0 rounded-full bg-slate-300"></span>
                                    @endif


                                    {{-- Veg / Non-Veg --}}
                                    <span
                                        class="inline-flex shrink-0 items-center gap-1.5 text-[11px] font-semibold
                                            {{ $item->is_veg ? 'text-emerald-600' : 'text-rose-600' }}">

                                        <span
                                            class="flex h-3.5 w-3.5 items-center justify-center rounded-sm border
                                                {{ $item->is_veg ? 'border-emerald-600' : 'border-rose-600' }}">

                                            <span
                                                class="h-1.5 w-1.5 rounded-full rounded-full
                                                {{ $item->is_veg ? 'bg-emerald-600' : 'bg-rose-600' }}">
                                            </span>

                                        </span>

                                        {{ $item->is_veg ? 'Veg' : 'Non-Veg' }}

                                    </span>

                                </div>


                                {{-- Description --}}
                                @if ($item->description)
                                    <p class="mt-3 line-clamp-2 text-xs leading-5 text-slate-500">
                                        {{ $item->description }}
                                    </p>
                                @endif


                                {{-- Add To Cart --}}
                                <button type="button" onclick="addToCart({{ $item->id }})"
                                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 py-2.5 text-xs font-bold text-slate-700 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white">

                                    <i data-lucide="plus" class="h-3.5 w-3.5"></i>

                                    Add to Cart

                                </button>

                            </div>

                        </div>
                    @endforeach
                @else
                    {{-- Empty State --}}
                    <div
                        class="w-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">

                            <i data-lucide="utensils-crossed" class="h-5 w-5 text-slate-400">
                            </i>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-slate-800">
                            No dishes available
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            No active food items are available right now.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </section>


    {{-- =========================================================
        WHY FOODLY
    ========================================================== --}}
    <section class="bg-slate-50 py-14 sm:py-16">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">

                <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-500">
                    Why Foodly
                </p>

                <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                    Everything you need to enjoy great food
                </h2>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Simple discovery, easy ordering and a better way to find food you actually want.
                </p>

            </div>


            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                @php
                    $features = [
                        [
                            'icon' => 'map-pin',
                            'title' => 'Find nearby',
                            'text' => 'Discover restaurants and dishes around your location.',
                        ],
                        [
                            'icon' => 'search',
                            'title' => 'Search easily',
                            'text' => 'Find exactly what you are craving in seconds.',
                        ],
                        [
                            'icon' => 'shopping-bag',
                            'title' => 'Easy ordering',
                            'text' => 'Choose your food and place your order with ease.',
                        ],
                        [
                            'icon' => 'heart',
                            'title' => 'Love your food',
                            'text' => 'Explore new favorites and order them again.',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div
                        class="group rounded-2xl border border-slate-200 bg-white p-6 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition duration-300 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white">
                            <i data-lucide="{{ $feature['icon'] }}" class="h-5 w-5"></i>
                        </div>

                        <h3 class="mt-4 text-sm font-bold text-slate-900">
                            {{ $feature['title'] }}
                        </h3>

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            {{ $feature['text'] }}
                        </p>

                    </div>
                @endforeach

            </div>

        </div>

    </section>


    {{-- =========================================================
        RESTAURANT PARTNER CTA
    ========================================================== --}}
    <section class="bg-white py-14 sm:py-16">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 px-6 py-12 sm:px-10 lg:px-14">

                <div class="absolute -right-20 -top-32 h-72 w-72 rounded-full bg-emerald-500/20 blur-3xl"></div>
                <div class="absolute -bottom-32 left-20 h-72 w-72 rounded-full bg-amber-400/10 blur-3xl"></div>

                <div class="relative grid items-center gap-8 lg:grid-cols-2">

                    <div>

                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-semibold text-slate-200">
                            <i data-lucide="store" class="h-3.5 w-3.5 text-emerald-400"></i>
                            Restaurant owners
                        </span>

                        <h2 class="mt-4 text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                            Have a restaurant?
                            <span class="text-emerald-400">Grow with us.</span>
                        </h2>

                        <p class="mt-3 max-w-xl text-sm leading-6 text-slate-400">
                            Put your restaurant in front of hungry customers, manage your menu and receive online orders.
                        </p>

                    </div>


                    <div class="flex lg:justify-end">

                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-slate-900 shadow-lg transition hover:-translate-y-0.5 hover:bg-slate-100">

                            Become a restaurant partner

                            <i data-lucide="arrow-up-right" class="h-4 w-4"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const slides = document.querySelectorAll('.home-slide');
            const dots = document.querySelectorAll('.home-dot');
            const previousButton = document.getElementById('homePrev');
            const nextButton = document.getElementById('homeNext');

            if (!slides.length) {
                return;
            }

            let currentSlide = 0;
            let autoplayTimer;


            function showSlide(index) {

                currentSlide = (index + slides.length) % slides.length;

                slides.forEach((slide, i) => {

                    const active = i === currentSlide;

                    slide.classList.toggle('opacity-100', active);
                    slide.classList.toggle('opacity-0', !active);

                    slide.classList.toggle('pointer-events-none', !active);

                });


                dots.forEach((dot, i) => {

                    dot.classList.toggle('w-7', i === currentSlide);
                    dot.classList.toggle('w-2', i !== currentSlide);

                    dot.classList.toggle('bg-white', i === currentSlide);
                    dot.classList.toggle('bg-white/30', i !== currentSlide);

                });

            }


            function nextSlide() {
                showSlide(currentSlide + 1);
            }


            function previousSlide() {
                showSlide(currentSlide - 1);
            }


            function startAutoplay() {

                clearInterval(autoplayTimer);

                autoplayTimer = setInterval(() => {
                    nextSlide();
                }, 5000);

            }


            if (nextButton) {

                nextButton.addEventListener('click', function() {
                    nextSlide();
                    startAutoplay();
                });

            }


            if (previousButton) {

                previousButton.addEventListener('click', function() {
                    previousSlide();
                    startAutoplay();
                });

            }


            dots.forEach((dot) => {

                dot.addEventListener('click', function() {

                    showSlide(Number(this.dataset.dot));
                    startAutoplay();

                });

            });


            const heroSection = document.querySelector('.home-slide')?.closest('section');

            if (heroSection) {

                heroSection.addEventListener('mouseenter', function() {
                    clearInterval(autoplayTimer);
                });

                heroSection.addEventListener('mouseleave', function() {
                    startAutoplay();
                });

            }


            showSlide(0);
            startAutoplay();

        });

        // Add to Cart
        async function addToCart(itemId) {
            try {
                const csrfToken = document.querySelector(
                    'meta[name="csrf-token"]'
                )?.content;

                if (!csrfToken) {
                    showCartMessage('Security token missing. Please refresh the page.', true);
                    return;
                }

                const response = await fetch(
                    @json(route('cart.add')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            item_id: itemId,
                            quantity: 1,
                        }),
                    }
                );

                const data = await response.json();

                if (!response.ok || !data.success) {
                    showCartMessage(
                        data.message || 'Unable to add this item.',
                        true
                    );
                    return;
                }

                showCartMessage(data.message || 'Added to cart.');

                const cartCount = document.getElementById('cartCount');

                if (cartCount) {
                    cartCount.textContent = data.cart_count;
                    cartCount.classList.toggle('hidden', data.cart_count <= 0);
                }

                // Update mobile cart count
                const mobileCartCount = document.getElementById('mobileCartCount');

                if (mobileCartCount) {
                    mobileCartCount.textContent = data.cart_count;
                    mobileCartCount.classList.toggle('hidden', data.cart_count <= 0);
                }

            } catch (error) {
                console.error(error);
                showCartMessage('Something went wrong. Please try again.', true);
            }
        }

        function showCartMessage(message, isError = false) {
            let toast = document.getElementById('cartToast');

            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'cartToast';

                toast.className =
                    'fixed bottom-5 right-5 z-[100] max-w-sm rounded-xl px-5 py-3 text-sm font-semibold text-white shadow-xl';

                document.body.appendChild(toast);
            }

            toast.textContent = message;
            toast.classList.toggle('bg-rose-600', isError);
            toast.classList.toggle('bg-slate-900', !isError);
            toast.classList.remove('hidden');

            clearTimeout(window.cartToastTimeout);

            window.cartToastTimeout = setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }
    </script>
@endpush
