@extends('owner.layout')

@section('title', 'Restaurants')
@section('page-title', 'Restaurants')
@section('breadcrumb', 'Manage Restaurants')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
        PAGE HEADER
        ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Restaurants
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage all your restaurants, locations and operating details.
                </p>
            </div>

            <button type="button" onclick="openRestaurantModal('add')"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 sm:w-auto">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Add Restaurant
            </button>

        </div>


        {{-- =========================================================
        RESTAURANT COUNT / SUMMARY
    ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Total --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Restaurants
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $restaurants->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100">
                        <i data-lucide="store" class="h-5 w-5 text-slate-700"></i>
                    </div>

                </div>
            </div>


            {{-- Active --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Active Restaurants
                        </p>

                        <p class="mt-2 text-2xl font-bold text-emerald-600">
                            {{ $restaurants->where('status', true)->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                        <i data-lucide="circle-check" class="h-5 w-5 text-emerald-600"></i>
                    </div>

                </div>
            </div>


            {{-- Inactive --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Inactive Restaurants
                        </p>

                        <p class="mt-2 text-2xl font-bold text-rose-600">
                            {{ $restaurants->where('status', false)->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-rose-50">
                        <i data-lucide="circle-x" class="h-5 w-5 text-rose-600"></i>
                    </div>

                </div>
            </div>

        </div>


        {{-- =========================================================
        RESTAURANT LIST
    ========================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Table Header --}}
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-base font-semibold text-slate-900">
                            Your Restaurants
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $restaurants->count() }}
                            {{ $restaurants->count() == 1 ? 'restaurant' : 'restaurants' }}
                            found
                        </p>
                    </div>

                </div>

            </div>


            {{-- =====================================================
            DESKTOP TABLE
        ====================================================== --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">
                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Restaurant
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                City
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Timing
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Actions
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse($restaurants as $restaurant)
                            <tr class="transition hover:bg-slate-50/70">

                                {{-- Restaurant --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        {{-- Restaurant Logo --}}
                                        <div
                                            class="h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-50">

                                            @if ($restaurant->logo)
                                                <img src="{{ asset('storage/' . $restaurant->logo) }}"
                                                    alt="{{ $restaurant->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center">
                                                    <i data-lucide="store" class="h-6 w-6 text-slate-400"></i>
                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </td>

                                {{-- City --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2 text-sm text-slate-700">

                                        <i data-lucide="map-pin" class="h-4 w-4 text-slate-400"></i>

                                        <span>
                                            {{ $restaurant->city->name ?? '-' }}
                                        </span>

                                    </div>

                                    @if ($restaurant->city?->state)
                                        <p class="mt-1 pl-6 text-xs text-slate-400">
                                            {{ $restaurant->city->state }}
                                        </p>
                                    @endif

                                </td>


                                {{-- Timing --}}
                                <td class="px-6 py-4">

                                    @if ($restaurant->opening_time || $restaurant->closing_time)
                                        <div class="flex items-center gap-2 text-sm text-slate-700">

                                            <i data-lucide="clock" class="h-4 w-4 text-slate-400"></i>

                                            <span>
                                                {{ $restaurant->opening_time ? \Carbon\Carbon::parse($restaurant->opening_time)->format('h:i A') : '--' }}
                                                -
                                                {{ $restaurant->closing_time ? \Carbon\Carbon::parse($restaurant->closing_time)->format('h:i A') : '--' }}
                                            </span>

                                        </div>
                                    @else
                                        <span class="text-sm text-slate-400">
                                            Not set
                                        </span>
                                    @endif

                                </td>


                                {{-- Status Toggle --}}
                                <td class="px-6 py-4">
                                    <form action="{{ route('owner.restaurants.toggle-status', $restaurant->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            title="{{ $restaurant->status ? 'Click to deactivate' : 'Click to activate' }}"
                                            class="group inline-flex items-center gap-2 rounded-lg px-1 py-1 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                            <span
                                                class="relative inline-flex h-6 w-11 shrink-0 items-center rounded-full transition-colors duration-200 {{ $restaurant->status ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                                <span
                                                    class="inline-block h-4 w-4 rounded-full bg-white shadow-sm transition-transform duration-200 {{ $restaurant->status ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                            </span>
                                            <span
                                                class="text-xs font-semibold {{ $restaurant->status ? 'text-emerald-700' : 'text-slate-500' }}">
                                                {{ $restaurant->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </button>
                                    </form>
                                </td>


                                {{-- Actions --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Edit --}}
                                        <button type="button"
                                            onclick='openRestaurantModal("edit", @json($restaurant))'
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:border-slate-300 hover:bg-slate-100 hover:text-slate-900"
                                            title="Edit">

                                            <i data-lucide="pencil" class="h-4 w-4"></i>

                                        </button>


                                        {{-- View --}}
                                        <button type="button"
                                            onclick='openRestaurantViewModal(@json($restaurant))'
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:border-slate-300 hover:bg-slate-100 hover:text-slate-900"
                                            title="View">

                                            <i data-lucide="eye" class="h-4 w-4"></i>

                                        </button>


                                        {{-- Delete --}}
                                        <form action="{{ route('owner.restaurants.destroy', $restaurant->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this restaurant?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-rose-200 text-rose-500 transition hover:bg-rose-50 hover:text-rose-600"
                                                title="Delete">

                                                <i data-lucide="trash-2" class="h-4 w-4"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex max-w-sm flex-col items-center">

                                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">
                                            <i data-lucide="store" class="h-7 w-7 text-slate-400"></i>
                                        </div>

                                        <h3 class="mt-4 text-base font-semibold text-slate-900">
                                            No restaurants yet
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Add your first restaurant to start managing your menu and orders.
                                        </p>

                                        <button type="button" onclick="openRestaurantModal('add')"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                                            <i data-lucide="plus" class="h-4 w-4"></i>
                                            Add Restaurant
                                        </button>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
            MOBILE CARDS
        ====================================================== --}}
            <div class="divide-y divide-slate-100 md:hidden">

                @forelse($restaurants as $restaurant)
                    <div class="p-4">

                        <div class="flex gap-3">

                            {{-- Logo --}}
                            @if ($restaurant->logo)
                                <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}"
                                    class="h-14 w-14 shrink-0 rounded-xl border border-slate-200 object-cover">
                            @else
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-100">
                                    <i data-lucide="store" class="h-6 w-6 text-slate-400"></i>
                                </div>
                            @endif


                            {{-- Main --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-2">

                                    <div class="min-w-0">

                                        <h4 class="truncate text-sm font-bold text-slate-900">
                                            {{ $restaurant->name }}
                                        </h4>

                                        <div class="mt-1 flex items-center gap-1.5 text-xs text-slate-500">
                                            <i data-lucide="map-pin" class="h-3.5 w-3.5"></i>
                                            {{ $restaurant->city->name ?? '-' }}
                                        </div>

                                    </div>


                                    <form action="{{ route('owner.restaurants.toggle-status', $restaurant->id) }}"
                                        method="POST" class="shrink-0">
                                        @csrf
                                        <button type="submit"
                                            title="{{ $restaurant->status ? 'Click to deactivate' : 'Click to activate' }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg px-1 py-1 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                            <span
                                                class="relative inline-flex h-5 w-9 shrink-0 items-center rounded-full transition-colors {{ $restaurant->status ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                                <span
                                                    class="inline-block h-3.5 w-3.5 rounded-full bg-white shadow-sm transition-transform {{ $restaurant->status ? 'translate-x-[18px]' : 'translate-x-1' }}"></span>
                                            </span>
                                            <span
                                                class="text-[10px] font-bold {{ $restaurant->status ? 'text-emerald-700' : 'text-slate-500' }}">
                                                {{ $restaurant->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </button>
                                    </form>

                                </div>


                                {{-- Details --}}
                                <div class="mt-3 grid grid-cols-1 gap-2 text-xs text-slate-500">

                                    @if ($restaurant->mobile)
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="phone" class="h-3.5 w-3.5"></i>
                                            {{ $restaurant->mobile }}
                                        </div>
                                    @endif


                                    @if ($restaurant->opening_time || $restaurant->closing_time)
                                        <div class="flex items-center gap-2">

                                            <i data-lucide="clock" class="h-3.5 w-3.5"></i>

                                            {{ $restaurant->opening_time ? \Carbon\Carbon::parse($restaurant->opening_time)->format('h:i A') : '--' }}
                                            -
                                            {{ $restaurant->closing_time ? \Carbon\Carbon::parse($restaurant->closing_time)->format('h:i A') : '--' }}

                                        </div>
                                    @endif

                                </div>


                                {{-- Actions --}}
                                <div class="mt-4 grid grid-cols-3 gap-2">

                                    <button type="button"
                                        onclick='openRestaurantModal("edit", @json($restaurant))'
                                        class="inline-flex min-w-0 items-center justify-center gap-1.5 rounded-lg border border-slate-200 px-2 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-50">
                                        <i data-lucide="pencil" class="h-3.5 w-3.5 shrink-0"></i>
                                        <span class="truncate">Edit</span>
                                    </button>

                                    <button type="button" onclick='openRestaurantViewModal(@json($restaurant))'
                                        class="inline-flex min-w-0 items-center justify-center gap-1.5 rounded-lg border border-slate-200 px-2 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-50">
                                        <i data-lucide="eye" class="h-3.5 w-3.5 shrink-0"></i>
                                        <span class="truncate">View</span>
                                    </button>

                                    <form action="{{ route('owner.restaurants.destroy', $restaurant->id) }}"
                                        method="POST" class="min-w-0"
                                        onsubmit="return confirm('Are you sure you want to delete this restaurant?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-rose-200 px-2 py-2.5 text-xs font-semibold text-rose-600 transition hover:bg-rose-50">
                                            <i data-lucide="trash-2" class="h-3.5 w-3.5 shrink-0"></i>
                                            <span class="truncate">Delete</span>
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-5 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">
                            <i data-lucide="store" class="h-7 w-7 text-slate-400"></i>
                        </div>

                        <h3 class="mt-4 text-base font-semibold text-slate-900">
                            No restaurants yet
                        </h3>

                        <p class="mx-auto mt-1 max-w-xs text-sm text-slate-500">
                            Add your first restaurant to start managing your menu and orders.
                        </p>

                        <button type="button" onclick="openRestaurantModal('add')"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white">
                            <i data-lucide="plus" class="h-4 w-4"></i>
                            Add Restaurant
                        </button>

                    </div>
                @endforelse

            </div>

        </div>

    </div>



    {{-- =============================================================
    SINGLE ADD / EDIT MODAL
============================================================= --}}
    <div id="restaurantModal" class="fixed inset-0 z-[100] hidden" aria-hidden="true">

        {{-- Backdrop --}}
        <div id="restaurantModalBackdrop" class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
            onclick="closeRestaurantModal()"></div>


        {{-- Modal Wrapper --}}
        <div class="relative flex min-h-full items-end justify-center p-0 sm:items-center sm:p-4">

            <div id="restaurantModalBox"
                class="relative flex w-full max-w-3xl max-h-[95vh] flex-col overflow-hidden rounded-t-3xl bg-white shadow-2xl sm:max-h-[92vh] sm:rounded-2xl">

                {{-- =================================================
                MODAL HEADER
            ================================================== --}}
                <div
                    class="flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-5 py-4 sm:px-6">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-900">
                            <i id="restaurantModalIcon" data-lucide="store" class="h-5 w-5 text-white"></i>
                        </div>

                        <div class="min-w-0">

                            <h3 id="restaurantModalTitle" class="truncate text-base font-bold text-slate-900 sm:text-lg">
                                Add Restaurant
                            </h3>

                            <p id="restaurantModalSubtitle" class="truncate text-xs text-slate-500 sm:text-sm">
                                Add a new restaurant to your account.
                            </p>

                        </div>

                    </div>


                    <button type="button" onclick="closeRestaurantModal()"
                        class="ml-3 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>

                </div>


                {{-- =================================================
                FORM
            ================================================== --}}
                <form id="restaurantForm" method="POST" enctype="multipart/form-data"
                    class="flex min-h-0 flex-1 flex-col">

                    @csrf

                    <div id="restaurantMethod"></div>


                    {{-- Scrollable Content --}}
                    <div class="min-h-0 flex-1 overflow-y-auto">

                        <div class="space-y-6 p-5 sm:p-6">


                            {{-- =====================================
                            BASIC INFORMATION
                        ====================================== --}}
                            <div>

                                <div class="mb-4">

                                    <h4 class="text-sm font-bold text-slate-900">
                                        Basic Information
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Enter the basic details of your restaurant.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                                    {{-- Restaurant Name --}}
                                    <div class="sm:col-span-2">

                                        <label for="restaurant_name"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Restaurant Name
                                            <span class="text-rose-500">*</span>
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="store"
                                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>

                                            <input type="text" id="restaurant_name" name="name" required
                                                maxlength="150" placeholder="Enter restaurant name"
                                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                        </div>

                                        @error('name')
                                            <p class="mt-1 text-xs text-rose-500">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    {{-- Mobile --}}
                                    <div>

                                        <label for="restaurant_mobile"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Mobile Number
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="phone"
                                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>

                                            <input type="text" id="restaurant_mobile" name="mobile" maxlength="20"
                                                placeholder="Enter mobile number"
                                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                        </div>

                                    </div>


                                    {{-- City --}}
                                    <div class="relative">

                                        <label for="citySearch" class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            City
                                            <span class="text-rose-500">*</span>
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="map-pin"
                                                class="pointer-events-none absolute left-3 top-1/2 z-10 h-4 w-4 -translate-y-1/2 text-slate-400"></i>

                                            <input type="text" id="citySearch" autocomplete="off"
                                                placeholder="Search city..." required
                                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-10 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                            <i data-lucide="chevron-down"
                                                class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>

                                        </div>


                                        <input type="hidden" name="city_id" id="restaurant_city_id" required>


                                        {{-- City Suggestions --}}
                                        <div id="citySuggestions"
                                            class="absolute left-0 right-0 top-[76px] z-50 hidden max-h-56 overflow-y-auto rounded-xl border border-slate-200 bg-white py-1 shadow-xl">
                                        </div>

                                    </div>


                                    {{-- Address --}}
                                    <div class="sm:col-span-2">

                                        <label for="restaurant_address"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Address
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="map"
                                                class="pointer-events-none absolute left-3 top-3.5 h-4 w-4 text-slate-400"></i>

                                            <textarea id="restaurant_address" name="address" rows="3" placeholder="Enter restaurant address"
                                                class="w-full resize-none rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"></textarea>

                                        </div>

                                    </div>


                                    {{-- Description --}}
                                    <div class="sm:col-span-2">

                                        <label for="restaurant_description"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Description
                                        </label>

                                        <textarea id="restaurant_description" name="description" rows="3"
                                            placeholder="Tell customers something about your restaurant..."
                                            class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"></textarea>

                                    </div>

                                </div>

                            </div>


                            {{-- =====================================
                            RESTAURANT IMAGES
                        ====================================== --}}
                            <div class="border-t border-slate-100 pt-6">

                                <div class="mb-4">

                                    <h4 class="text-sm font-bold text-slate-900">
                                        Restaurant Images
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Upload a logo and cover image for your restaurant.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                                    {{-- Logo --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Restaurant Logo
                                        </label>

                                        <label for="restaurant_logo"
                                            class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center transition hover:border-slate-400 hover:bg-slate-100">

                                            <div id="logoPreviewWrapper"
                                                class="mb-3 flex h-20 w-20 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-sm">

                                                <img id="logoPreview" src="" alt="Logo Preview"
                                                    class="hidden h-full w-full object-cover">

                                                <i id="logoPlaceholder" data-lucide="image-plus"
                                                    class="h-7 w-7 text-slate-400"></i>

                                            </div>


                                            <span class="text-xs font-semibold text-slate-700">
                                                Click to upload logo
                                            </span>

                                            <span class="mt-1 text-[11px] text-slate-400">
                                                JPG, JPEG, PNG, WEBP · Max 2MB
                                            </span>

                                            <input type="file" id="restaurant_logo" name="logo"
                                                accept=".jpg,.jpeg,.png,.webp" class="hidden">

                                        </label>

                                    </div>


                                    {{-- Cover --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Cover Image
                                        </label>

                                        <label for="restaurant_cover"
                                            class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center transition hover:border-slate-400 hover:bg-slate-100">

                                            <div id="coverPreviewWrapper"
                                                class="mb-3 flex h-20 w-full max-w-[220px] items-center justify-center overflow-hidden rounded-xl bg-white shadow-sm">

                                                <img id="coverPreview" src="" alt="Cover Preview"
                                                    class="hidden h-full w-full object-cover">

                                                <i id="coverPlaceholder" data-lucide="image-plus"
                                                    class="h-7 w-7 text-slate-400"></i>

                                            </div>


                                            <span class="text-xs font-semibold text-slate-700">
                                                Click to upload cover
                                            </span>

                                            <span class="mt-1 text-[11px] text-slate-400">
                                                JPG, JPEG, PNG, WEBP · Max 4MB
                                            </span>

                                            <input type="file" id="restaurant_cover" name="cover_image"
                                                accept=".jpg,.jpeg,.png,.webp" class="hidden">

                                        </label>

                                    </div>

                                </div>

                            </div>


                            {{-- =====================================
                            OPERATING HOURS
                        ====================================== --}}
                            <div class="border-t border-slate-100 pt-6">

                                <div class="mb-4">

                                    <h4 class="text-sm font-bold text-slate-900">
                                        Operating Hours
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Set the opening and closing time of your restaurant.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                    {{-- Opening --}}
                                    <div>

                                        <label for="opening_time"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Opening Time
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="clock-3"
                                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>

                                            <input type="time" id="opening_time" name="opening_time"
                                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                        </div>

                                    </div>


                                    {{-- Closing --}}
                                    <div>

                                        <label for="closing_time"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">
                                            Closing Time
                                        </label>

                                        <div class="relative">

                                            <i data-lucide="clock-3"
                                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>

                                            <input type="time" id="closing_time" name="closing_time"
                                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- =====================================
                            STATUS
                        ====================================== --}}
                            <div class="border-t border-slate-100 pt-6">

                                <label
                                    class="flex cursor-pointer items-center justify-between gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4">

                                    <div>

                                        <p class="text-sm font-semibold text-slate-800">
                                            Restaurant Status
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Active restaurants can receive orders.
                                        </p>

                                    </div>


                                    <div class="relative shrink-0">

                                        <input type="checkbox" name="status" id="restaurant_status" value="1"
                                            class="peer sr-only" checked>

                                        <div
                                            class="h-6 w-11 rounded-full bg-slate-300 transition peer-checked:bg-emerald-500">
                                        </div>

                                        <div
                                            class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-sm transition peer-checked:translate-x-5">
                                        </div>

                                    </div>

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                    MODAL FOOTER
                ================================================== --}}
                    <div
                        class="flex shrink-0 flex-col-reverse gap-2 border-t border-slate-200 bg-white px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

                        <button type="button" onclick="closeRestaurantModal()"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 sm:w-auto">
                            Cancel
                        </button>

                        <button type="submit" id="restaurantSubmitButton"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 sm:w-auto">
                            <i data-lucide="save" class="h-4 w-4"></i>

                            <span id="restaurantSubmitText">
                                Save Restaurant
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- =============================================================
VIEW RESTAURANT MODAL
============================================================= --}}
    <div id="restaurantViewModal" class="fixed inset-0 z-[100] hidden" aria-hidden="true">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" onclick="closeRestaurantViewModal()">
        </div>


        {{-- Modal Wrapper --}}
        <div class="relative flex min-h-full items-end justify-center p-0 sm:items-center sm:p-4">

            <div
                class="relative flex w-full max-w-3xl max-h-[95vh] flex-col overflow-hidden rounded-t-3xl bg-white shadow-2xl sm:max-h-[92vh] sm:rounded-2xl">


                {{-- =================================================
            HEADER
            ================================================== --}}
                <div
                    class="flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-5 py-4 sm:px-6">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-900">

                            <i data-lucide="eye" class="h-5 w-5 text-white">
                            </i>

                        </div>

                        <div class="min-w-0">

                            <h3 class="truncate text-base font-bold text-slate-900 sm:text-lg">
                                Restaurant Details
                            </h3>

                            <p class="truncate text-xs text-slate-500 sm:text-sm">
                                View restaurant information
                            </p>

                        </div>

                    </div>


                    <button type="button" onclick="closeRestaurantViewModal()"
                        class="ml-3 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

                        <i data-lucide="x" class="h-5 w-5"></i>

                    </button>

                </div>


                {{-- =================================================
            SCROLLABLE CONTENT
            ================================================== --}}
                <div class="min-h-0 flex-1 overflow-y-auto">

                    <div class="p-5 sm:p-6">

                        {{-- =================================================
                    COVER + LOGO
                    ================================================== --}}
                        <div class="relative">

                            {{-- Cover --}}
                            <div class="h-40 w-full overflow-hidden rounded-2xl bg-slate-100 sm:h-52">

                                <img id="viewRestaurantCover" src="" alt="Restaurant Cover"
                                    class="hidden h-full w-full object-cover">

                                <div id="viewRestaurantCoverPlaceholder"
                                    class="flex h-full w-full items-center justify-center">

                                    <i data-lucide="image" class="h-10 w-10 text-slate-300">
                                    </i>

                                </div>

                            </div>


                            {{-- Logo --}}
                            <div class="absolute -bottom-10 left-5">

                                <div
                                    class="h-20 w-20 overflow-hidden rounded-2xl border-4 border-white bg-slate-100 shadow-md sm:h-24 sm:w-24">

                                    <img id="viewRestaurantLogo" src="" alt="Restaurant Logo"
                                        class="hidden h-full w-full object-cover">

                                    <div id="viewRestaurantLogoPlaceholder"
                                        class="flex h-full w-full items-center justify-center">

                                        <i data-lucide="store" class="h-8 w-8 text-slate-300">
                                        </i>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                    RESTAURANT NAME / STATUS
                    ================================================== --}}
                        <div class="mt-14 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                            <div>

                                <h2 id="viewRestaurantName" class="text-xl font-bold text-slate-900 sm:text-2xl">
                                    -
                                </h2>

                                <div class="mt-1 flex items-center gap-2 text-sm text-slate-500">

                                    <i data-lucide="map-pin" class="h-4 w-4">
                                    </i>

                                    <span id="viewRestaurantCity">
                                        -
                                    </span>

                                </div>

                            </div>


                            <div id="viewRestaurantStatus">
                            </div>

                        </div>


                        {{-- =================================================
                    INFORMATION
                    ================================================== --}}
                        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">


                            {{-- Mobile --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white">

                                        <i data-lucide="phone" class="h-4 w-4 text-slate-500">
                                        </i>

                                    </div>

                                    <div>

                                        <p class="text-xs font-medium text-slate-400">
                                            Mobile
                                        </p>

                                        <p id="viewRestaurantMobile" class="mt-0.5 text-sm font-semibold text-slate-800">
                                            -
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Timing --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white">

                                        <i data-lucide="clock-3" class="h-4 w-4 text-slate-500">
                                        </i>

                                    </div>

                                    <div>

                                        <p class="text-xs font-medium text-slate-400">
                                            Operating Hours
                                        </p>

                                        <p id="viewRestaurantTiming" class="mt-0.5 text-sm font-semibold text-slate-800">
                                            -
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Address --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white">

                                        <i data-lucide="map" class="h-4 w-4 text-slate-500">
                                        </i>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-xs font-medium text-slate-400">
                                            Address
                                        </p>

                                        <p id="viewRestaurantAddress"
                                            class="mt-0.5 text-sm font-semibold leading-6 text-slate-800">
                                            -
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Description --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white">

                                        <i data-lucide="align-left" class="h-4 w-4 text-slate-500">
                                        </i>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-xs font-medium text-slate-400">
                                            Description
                                        </p>

                                        <p id="viewRestaurantDescription"
                                            class="mt-0.5 whitespace-pre-line text-sm leading-6 text-slate-700">
                                            -
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
            FOOTER
            ================================================== --}}
                <div
                    class="flex shrink-0 flex-col-reverse gap-2 border-t border-slate-200 bg-white px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

                    <button type="button" onclick="closeRestaurantViewModal()"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 sm:w-auto">

                        <i data-lucide="x" class="h-4 w-4">
                        </i>

                        Close

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =============================================================
    JAVASCRIPT
    ============================================================= --}}

    @push('scripts')
        <script>
            /*
                                                    RESTAUTRANTS
                                                    */

            const restaurantCities = @json($cities);


            /*
            |--------------------------------------------------------------------------
            | DOM Elements
            |--------------------------------------------------------------------------
            */

            const restaurantModal = document.getElementById('restaurantModal');
            const restaurantForm = document.getElementById('restaurantForm');

            const restaurantModalTitle =
                document.getElementById('restaurantModalTitle');

            const restaurantModalSubtitle =
                document.getElementById('restaurantModalSubtitle');

            const restaurantSubmitText =
                document.getElementById('restaurantSubmitText');

            const restaurantMethod =
                document.getElementById('restaurantMethod');

            const citySearch =
                document.getElementById('citySearch');

            const cityId =
                document.getElementById('restaurant_city_id');

            const citySuggestions =
                document.getElementById('citySuggestions');


            /*
            |--------------------------------------------------------------------------
            | Open Add / Edit Modal
            |--------------------------------------------------------------------------
            */

            function openRestaurantModal(mode, restaurant = null) {

                resetRestaurantForm();

                restaurantModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                if (mode === 'edit' && restaurant) {

                    restaurantModalTitle.textContent = 'Edit Restaurant';

                    restaurantModalSubtitle.textContent =
                        'Update your restaurant information.';

                    restaurantSubmitText.textContent =
                        'Update Restaurant';

                    restaurantForm.action =
                        "{{ url('/owner/restaurants') }}/" + restaurant.id;

                    restaurantMethod.innerHTML = `
                <input type="hidden" name="_method" value="PUT">
            `;


                    document.getElementById('restaurant_name').value =
                        restaurant.name ?? '';

                    document.getElementById('restaurant_mobile').value =
                        restaurant.mobile ?? '';

                    document.getElementById('restaurant_address').value =
                        restaurant.address ?? '';

                    document.getElementById('restaurant_description').value =
                        restaurant.description ?? '';

                    document.getElementById('opening_time').value =
                        restaurant.opening_time ?
                        String(restaurant.opening_time).substring(0, 5) :
                        '';

                    document.getElementById('closing_time').value =
                        restaurant.closing_time ?
                        String(restaurant.closing_time).substring(0, 5) :
                        '';

                    document.getElementById('restaurant_status').checked =
                        Boolean(restaurant.status);


                    /*
                    | City
                    */

                    if (restaurant.city) {

                        citySearch.value =
                            restaurant.city.name + ', ' + restaurant.city.state;

                        cityId.value =
                            restaurant.city_id;

                    }


                    /*
                    | Existing Logo
                    */

                    if (restaurant.logo) {

                        const logoPreview =
                            document.getElementById('logoPreview');

                        const logoPlaceholder =
                            document.getElementById('logoPlaceholder');

                        logoPreview.src =
                            "{{ asset('storage') }}/" + restaurant.logo;

                        logoPreview.classList.remove('hidden');

                        logoPlaceholder.classList.add('hidden');

                    }


                    /*
                    | Existing Cover
                    */

                    if (restaurant.cover_image) {

                        const coverPreview =
                            document.getElementById('coverPreview');

                        const coverPlaceholder =
                            document.getElementById('coverPlaceholder');

                        coverPreview.src =
                            "{{ asset('storage') }}/" + restaurant.cover_image;

                        coverPreview.classList.remove('hidden');

                        coverPlaceholder.classList.add('hidden');

                    }

                } else {

                    restaurantModalTitle.textContent =
                        'Add Restaurant';

                    restaurantModalSubtitle.textContent =
                        'Add a new restaurant to your account.';

                    restaurantSubmitText.textContent =
                        'Save Restaurant';

                    restaurantForm.action =
                        "{{ route('owner.restaurants.store') }}";

                    restaurantMethod.innerHTML = '';

                    document.getElementById('restaurant_status').checked = true;

                }


                /*
                | Re-render icons
                */

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }


                /*
                | Small delay for smooth appearance
                */

                requestAnimationFrame(() => {

                    restaurantModal
                        .querySelector('#restaurantModalBox')
                        .classList.add('restaurant-modal-visible');

                });

            }


            /*
            |--------------------------------------------------------------------------
            | Close Modal
            |--------------------------------------------------------------------------
            */

            function closeRestaurantModal() {

                restaurantModal.classList.add('hidden');

                document.body.classList.remove('overflow-hidden');

                citySuggestions.classList.add('hidden');

                resetRestaurantForm();

            }


            /*
            |--------------------------------------------------------------------------
            | Reset Form
            |--------------------------------------------------------------------------
            */

            function resetRestaurantForm() {

                restaurantForm.reset();

                restaurantMethod.innerHTML = '';

                cityId.value = '';

                citySearch.value = '';

                /*
                | Reset Images
                */

                const logoPreview =
                    document.getElementById('logoPreview');

                const logoPlaceholder =
                    document.getElementById('logoPlaceholder');

                const coverPreview =
                    document.getElementById('coverPreview');

                const coverPlaceholder =
                    document.getElementById('coverPlaceholder');


                logoPreview.src = '';

                logoPreview.classList.add('hidden');

                logoPlaceholder.classList.remove('hidden');


                coverPreview.src = '';

                coverPreview.classList.add('hidden');

                coverPlaceholder.classList.remove('hidden');


                document.getElementById('restaurant_status').checked = true;


                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            }


            /*
            |--------------------------------------------------------------------------
            | City Search
            |--------------------------------------------------------------------------
            */

            citySearch.addEventListener('input', function() {

                const query =
                    this.value.trim().toLowerCase();

                cityId.value = '';

                citySuggestions.innerHTML = '';


                if (!query) {

                    citySuggestions.classList.add('hidden');

                    return;

                }


                const results =
                    restaurantCities
                    .filter(city => {

                        const cityName =
                            city.name.toLowerCase();

                        const stateName =
                            city.state.toLowerCase();

                        return (
                            cityName.includes(query) ||
                            stateName.includes(query)
                        );

                    })
                    .slice(0, 8);


                if (!results.length) {

                    citySuggestions.innerHTML = `
                <div class="px-4 py-3 text-sm text-slate-500">
                    No city found
                </div>
            `;

                    citySuggestions.classList.remove('hidden');

                    return;

                }


                results.forEach(city => {

                    const item =
                        document.createElement('button');

                    item.type = 'button';

                    item.className =
                        'flex w-full items-center gap-3 px-4 py-3 text-left transition hover:bg-slate-50';


                    item.innerHTML = `
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100">
                    <i data-lucide="map-pin" class="h-4 w-4 text-slate-500"></i>
                </div>

                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-slate-800">
                        ${escapeHtml(city.name)}
                    </p>

                    <p class="truncate text-xs text-slate-400">
                        ${escapeHtml(city.state)}
                    </p>
                </div>
            `;


                    item.addEventListener('click', function() {

                        citySearch.value =
                            city.name + ', ' + city.state;

                        cityId.value =
                            city.id;

                        citySuggestions.classList.add('hidden');

                    });


                    citySuggestions.appendChild(item);

                });


                citySuggestions.classList.remove('hidden');


                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            });


            /*
            |--------------------------------------------------------------------------
            | City Search Focus
            |--------------------------------------------------------------------------
            */

            citySearch.addEventListener('focus', function() {

                if (this.value.trim() !== '') {
                    this.dispatchEvent(new Event('input'));
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Close City Suggestions Outside
            |--------------------------------------------------------------------------
            */

            document.addEventListener('click', function(event) {

                if (
                    !citySearch.contains(event.target) &&
                    !citySuggestions.contains(event.target)
                ) {
                    citySuggestions.classList.add('hidden');
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Image Preview
            |--------------------------------------------------------------------------
            */

            document.getElementById('restaurant_logo')
                .addEventListener('change', function(event) {

                    previewImage(
                        event.target.files[0],
                        'logoPreview',
                        'logoPlaceholder'
                    );

                });


            document.getElementById('restaurant_cover')
                .addEventListener('change', function(event) {

                    previewImage(
                        event.target.files[0],
                        'coverPreview',
                        'coverPlaceholder'
                    );

                });


            function previewImage(file, previewId, placeholderId) {

                if (!file) {
                    return;
                }

                const preview =
                    document.getElementById(previewId);

                const placeholder =
                    document.getElementById(placeholderId);

                const reader =
                    new FileReader();


                reader.onload = function(event) {

                    preview.src =
                        event.target.result;

                    preview.classList.remove('hidden');

                    placeholder.classList.add('hidden');

                };


                reader.readAsDataURL(file);

            }


            /*
            |--------------------------------------------------------------------------
            | Escape HTML
            |--------------------------------------------------------------------------
            */

            function escapeHtml(value) {

                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');

            }


            /*
            |--------------------------------------------------------------------------
            | Escape Key
            |--------------------------------------------------------------------------
            */

            document.addEventListener('keydown', function(event) {

                if (event.key !== 'Escape') {
                    return;
                }

                // Add/Edit modal
                if (!restaurantModal.classList.contains('hidden')) {
                    closeRestaurantModal();
                    return;
                }

                // View modal
                const viewModal =
                    document.getElementById('restaurantViewModal');

                if (viewModal && !viewModal.classList.contains('hidden')) {
                    closeRestaurantViewModal();
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Prevent Empty City Submission
            |--------------------------------------------------------------------------
            */

            restaurantForm.addEventListener('submit', function(event) {

                if (!cityId.value) {

                    event.preventDefault();

                    citySearch.focus();

                    citySuggestions.innerHTML = `
                <div class="px-4 py-3 text-sm text-rose-500">
                    Please select a city from the suggestions.
                </div>
            `;

                    citySuggestions.classList.remove('hidden');

                    return false;

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Initial Lucide Icons
            |--------------------------------------------------------------------------
            */

            document.addEventListener('DOMContentLoaded', function() {

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            });

            /* ==========================================================
                | View Restaurant Modal
                ========================================================== */

            function openRestaurantViewModal(restaurant) {

                const modal = document.getElementById('restaurantViewModal');

                /*
                |--------------------------------------------------------------------------
                | Basic Information
                |--------------------------------------------------------------------------
                */

                document.getElementById('viewRestaurantName').textContent =
                    restaurant.name ?? '-';


                document.getElementById('viewRestaurantMobile').textContent =
                    restaurant.mobile ?? 'Not provided';


                document.getElementById('viewRestaurantAddress').textContent =
                    restaurant.address ?? 'Not provided';


                document.getElementById('viewRestaurantDescription').textContent =
                    restaurant.description ?? 'No description available';


                /*
                |--------------------------------------------------------------------------
                | City
                |--------------------------------------------------------------------------
                */

                if (restaurant.city) {

                    document.getElementById('viewRestaurantCity').textContent =
                        restaurant.city.name + ', ' + restaurant.city.state;

                } else {

                    document.getElementById('viewRestaurantCity').textContent = '-';

                }


                /*
                |--------------------------------------------------------------------------
                | Operating Hours
                |--------------------------------------------------------------------------
                */

                let openingTime = '--';
                let closingTime = '--';

                if (restaurant.opening_time) {

                    openingTime =
                        String(restaurant.opening_time).substring(0, 5);

                }

                if (restaurant.closing_time) {

                    closingTime =
                        String(restaurant.closing_time).substring(0, 5);

                }


                document.getElementById('viewRestaurantTiming').textContent =
                    openingTime + ' - ' + closingTime;


                /*
                |--------------------------------------------------------------------------
                | Status
                |--------------------------------------------------------------------------
                */

                const statusContainer =
                    document.getElementById('viewRestaurantStatus');

                if (restaurant.status) {

                    statusContainer.innerHTML = `
            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                Active
            </span>
        `;

                } else {

                    statusContainer.innerHTML = `
            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                Inactive
            </span>
        `;

                }


                /*
                |--------------------------------------------------------------------------
                | Logo
                |--------------------------------------------------------------------------
                */

                const logo =
                    document.getElementById('viewRestaurantLogo');

                const logoPlaceholder =
                    document.getElementById('viewRestaurantLogoPlaceholder');


                if (restaurant.logo) {

                    logo.src =
                        "{{ asset('storage') }}/" + restaurant.logo;

                    logo.classList.remove('hidden');

                    logoPlaceholder.classList.add('hidden');

                } else {

                    logo.src = '';

                    logo.classList.add('hidden');

                    logoPlaceholder.classList.remove('hidden');

                }


                /*
                |--------------------------------------------------------------------------
                | Cover Image
                |--------------------------------------------------------------------------
                */

                const cover =
                    document.getElementById('viewRestaurantCover');

                const coverPlaceholder =
                    document.getElementById('viewRestaurantCoverPlaceholder');


                if (restaurant.cover_image) {

                    cover.src =
                        "{{ asset('storage') }}/" + restaurant.cover_image;

                    cover.classList.remove('hidden');

                    coverPlaceholder.classList.add('hidden');

                } else {

                    cover.src = '';

                    cover.classList.add('hidden');

                    coverPlaceholder.classList.remove('hidden');

                }


                /*
                |--------------------------------------------------------------------------
                | Open Modal
                |--------------------------------------------------------------------------
                */

                modal.classList.remove('hidden');

                document.body.classList.add('overflow-hidden');


                /*
                |--------------------------------------------------------------------------
                | Lucide Icons
                |--------------------------------------------------------------------------
                */

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            }


            /* ==========================================================
            | Close View Modal
            ========================================================== */

            function closeRestaurantViewModal() {

                const modal =
                    document.getElementById('restaurantViewModal');

                modal.classList.add('hidden');

                document.body.classList.remove('overflow-hidden');

            }
        </script>
    @endpush

@endsection
