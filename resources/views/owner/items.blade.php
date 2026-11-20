@extends('owner.layout')

@section('title', 'Food Items')
@section('page-title', 'Food Items')
@section('breadcrumb', 'Manage Food Items')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
        PAGE HEADER
        ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Food Items
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage your restaurant food items, pricing and availability.
                </p>
            </div>

            <button type="button" onclick="openItemModal('add')"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 sm:w-auto">

                <i data-lucide="plus" class="h-4 w-4"></i>

                Add Food Item

            </button>

        </div>


        {{-- =========================================================
        SUMMARY CARDS
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Total --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Items
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $items->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100">
                        <i data-lucide="utensils" class="h-5 w-5 text-slate-700"></i>
                    </div>

                </div>

            </div>


            {{-- Active --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Active Items
                        </p>

                        <p class="mt-2 text-2xl font-bold text-emerald-600">
                            {{ $items->where('status', true)->count() }}
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
                            Inactive Items
                        </p>

                        <p class="mt-2 text-2xl font-bold text-rose-600">
                            {{ $items->where('status', false)->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-rose-50">
                        <i data-lucide="circle-x" class="h-5 w-5 text-rose-600"></i>
                    </div>

                </div>

            </div>


            {{-- Veg --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Veg Items
                        </p>

                        <p class="mt-2 text-2xl font-bold text-green-600">
                            {{ $items->where('is_veg', true)->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50">
                        <i data-lucide="leaf" class="h-5 w-5 text-green-600"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        ITEMS LIST
        ========================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-base font-semibold text-slate-900">
                            Your Food Items
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $items->count() }}
                            {{ $items->count() == 1 ? 'item' : 'items' }}
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
                                Food Item
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Restaurant
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Category
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Price
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Type
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

                        @forelse($items as $item)
                            <tr class="transition hover:bg-slate-50/70">

                                {{-- Food Item --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-50">

                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                                    class="h-full w-full object-cover">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center">
                                                    <i data-lucide="utensils" class="h-6 w-6 text-slate-400"></i>
                                                </div>
                                            @endif

                                        </div>


                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-900">
                                                {{ $item->name }}
                                            </p>

                                            @if ($item->description)
                                                <p class="mt-1 max-w-xs truncate text-xs text-slate-400">
                                                    {{ $item->description }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Restaurant --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2 text-sm text-slate-700">

                                        <i data-lucide="store" class="h-4 w-4 text-slate-400"></i>

                                        <span>
                                            {{ $item->restaurant->name ?? '-' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Category --}}
                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-semibold text-slate-600">
                                        {{ $item->category->name ?? '-' }}
                                    </span>

                                </td>


                                {{-- Price --}}
                                <td class="px-6 py-4">

                                    <span class="text-sm font-bold text-slate-900">
                                        ₹{{ number_format($item->price, 2) }}
                                    </span>

                                </td>


                                {{-- Veg / Non Veg --}}
                                <td class="px-6 py-4">

                                    @if ($item->is_veg)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700">
                                            <span
                                                class="flex h-3.5 w-3.5 items-center justify-center rounded-sm border border-green-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            </span>
                                            Veg
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700">
                                            <span
                                                class="flex h-3.5 w-3.5 items-center justify-center rounded-sm border border-rose-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                                            </span>
                                            Non-Veg
                                        </span>
                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    <form action="{{ route('owner.items.toggle-status', $item->id) }}" method="POST">

                                        @csrf

                                        <button type="submit"
                                            title="{{ $item->status ? 'Click to deactivate' : 'Click to activate' }}"
                                            class="group inline-flex items-center gap-2 rounded-lg px-1 py-1 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200">

                                            <span
                                                class="relative inline-flex h-6 w-11 shrink-0 items-center rounded-full transition-colors duration-200
                                                {{ $item->status ? 'bg-emerald-500' : 'bg-slate-300' }}">

                                                <span
                                                    class="inline-block h-4 w-4 rounded-full bg-white shadow-sm transition-transform duration-200
                                                    {{ $item->status ? 'translate-x-6' : 'translate-x-1' }}">
                                                </span>

                                            </span>

                                            <span
                                                class="text-xs font-semibold
                                                {{ $item->status ? 'text-emerald-700' : 'text-slate-500' }}">

                                                {{ $item->status ? 'Active' : 'Inactive' }}

                                            </span>

                                        </button>

                                    </form>

                                </td>


                                {{-- Actions --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Edit --}}
                                        <button type="button" onclick='openItemModal("edit", @json($item))'
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:border-slate-300 hover:bg-slate-100 hover:text-slate-900"
                                            title="Edit">

                                            <i data-lucide="pencil" class="h-4 w-4"></i>

                                        </button>


                                        {{-- View --}}
                                        <button type="button" onclick='openItemViewModal(@json($item))'
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:border-slate-300 hover:bg-slate-100 hover:text-slate-900"
                                            title="View">

                                            <i data-lucide="eye" class="h-4 w-4"></i>

                                        </button>


                                        {{-- Delete --}}
                                        <form action="{{ route('owner.items.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this food item?')">

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

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex max-w-sm flex-col items-center">

                                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">

                                            <i data-lucide="utensils" class="h-7 w-7 text-slate-400"></i>

                                        </div>

                                        <h3 class="mt-4 text-base font-semibold text-slate-900">
                                            No food items yet
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Add your first food item to start building your restaurant menu.
                                        </p>

                                        <button type="button" onclick="openItemModal('add')"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">

                                            <i data-lucide="plus" class="h-4 w-4"></i>

                                            Add Food Item

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

                @forelse($items as $item)
                    <div class="p-4">

                        <div class="flex gap-3">

                            {{-- Image --}}
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                    class="h-16 w-16 shrink-0 rounded-xl border border-slate-200 object-cover">
                            @else
                                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-slate-100">

                                    <i data-lucide="utensils" class="h-6 w-6 text-slate-400"></i>

                                </div>
                            @endif


                            {{-- Main --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-2">

                                    <div class="min-w-0">

                                        <h4 class="truncate text-sm font-bold text-slate-900">
                                            {{ $item->name }}
                                        </h4>

                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $item->restaurant->name ?? '-' }}
                                        </p>

                                    </div>


                                    {{-- Status Toggle --}}
                                    <form action="{{ route('owner.items.toggle-status', $item->id) }}" method="POST"
                                        class="shrink-0">

                                        @csrf

                                        <button type="submit"
                                            title="{{ $item->status ? 'Click to deactivate' : 'Click to activate' }}"
                                            class="inline-flex items-center gap-1.5">

                                            <span
                                                class="relative inline-flex h-5 w-9 items-center rounded-full transition
                                                {{ $item->status ? 'bg-emerald-500' : 'bg-slate-300' }}">

                                                <span
                                                    class="inline-block h-3.5 w-3.5 rounded-full bg-white shadow-sm transition-transform
                                                    {{ $item->status ? 'translate-x-[18px]' : 'translate-x-0.5' }}">
                                                </span>

                                            </span>

                                        </button>

                                    </form>

                                </div>


                                {{-- Category + Price --}}
                                <div class="mt-2 flex flex-wrap items-center gap-2">

                                    <span
                                        class="rounded-lg bg-slate-100 px-2 py-1 text-[10px] font-semibold text-slate-600">
                                        {{ $item->category->name ?? '-' }}
                                    </span>

                                    <span class="text-sm font-bold text-slate-900">
                                        ₹{{ number_format($item->price, 2) }}
                                    </span>

                                    @if ($item->is_veg)
                                        <span
                                            class="rounded-full bg-green-50 px-2 py-1 text-[10px] font-bold text-green-700">
                                            Veg
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-rose-50 px-2 py-1 text-[10px] font-bold text-rose-700">
                                            Non-Veg
                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Mobile Status Text --}}
                        <div class="mt-3 flex items-center justify-between">

                            <span
                                class="text-xs font-semibold
                                {{ $item->status ? 'text-emerald-700' : 'text-slate-500' }}">

                                {{ $item->status ? 'Active' : 'Inactive' }}

                            </span>


                            {{-- Actions --}}
                            <div class="grid grid-cols-3 gap-2">

                                {{-- Edit --}}
                                <button type="button" onclick='openItemModal("edit", @json($item))'
                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                                    <i data-lucide="pencil" class="h-3.5 w-3.5"></i>

                                    Edit

                                </button>


                                {{-- View --}}
                                <button type="button" onclick='openItemViewModal(@json($item))'
                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                                    <i data-lucide="eye" class="h-3.5 w-3.5"></i>

                                    View

                                </button>


                                {{-- Delete --}}
                                <form action="{{ route('owner.items.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this food item?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-500 transition hover:bg-rose-50">

                                        <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-5 py-14 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">

                            <i data-lucide="utensils" class="h-7 w-7 text-slate-400"></i>

                        </div>

                        <h3 class="mt-4 text-base font-semibold text-slate-900">
                            No food items yet
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Add your first food item to start building your menu.
                        </p>

                        <button type="button" onclick="openItemModal('add')"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">

                            <i data-lucide="plus" class="h-4 w-4"></i>

                            Add Food Item

                        </button>

                    </div>
                @endforelse

            </div>

        </div>

    </div>


    {{-- =============================================================
    ADD / EDIT ITEM MODAL
    ============================================================= --}}
    <div id="itemModal" class="fixed inset-0 z-[100] hidden" aria-hidden="true">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" onclick="closeItemModal()">
        </div>


        {{-- Modal --}}
        <div class="relative flex min-h-full items-end justify-center p-0 sm:items-center sm:p-4">

            <div
                class="relative flex max-h-[95vh] w-full max-w-2xl flex-col overflow-hidden rounded-t-3xl bg-white shadow-2xl sm:max-h-[92vh] sm:rounded-2xl">

                {{-- Header --}}
                <div
                    class="flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-5 py-4 sm:px-6">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-900">

                            <i data-lucide="utensils" class="h-5 w-5 text-white">
                            </i>

                        </div>

                        <div class="min-w-0">

                            <h3 id="itemModalTitle" class="truncate text-base font-bold text-slate-900 sm:text-lg">
                                Add Food Item
                            </h3>

                            <p id="itemModalSubtitle" class="truncate text-xs text-slate-500 sm:text-sm">
                                Add a new item to your restaurant menu.
                            </p>

                        </div>

                    </div>


                    <button type="button" onclick="closeItemModal()"
                        class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

                        <i data-lucide="x" class="h-5 w-5">
                        </i>

                    </button>

                </div>


                {{-- Form --}}
                <form id="itemForm" action="{{ route('owner.items.store') }}" method="POST"
                    enctype="multipart/form-data" class="flex min-h-0 flex-1 flex-col">

                    @csrf

                    <input type="hidden" id="itemFormMethod" value="POST">


                    {{-- Scroll Content --}}
                    <div class="min-h-0 flex-1 overflow-y-auto">

                        <div class="space-y-6 p-5 sm:p-6">

                            {{-- =================================================
                            BASIC INFORMATION
                            ================================================== --}}
                            <div>

                                <div class="mb-4">

                                    <h4 class="text-sm font-bold text-slate-900">
                                        Basic Information
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Select the restaurant and category for this item.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                    {{-- Restaurant --}}
                                    <div>

                                        <label for="item_restaurant_id"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                                            Restaurant

                                            <span class="text-rose-500">*</span>

                                        </label>

                                        <div class="relative">

                                            <i data-lucide="store"
                                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                            </i>

                                            <select id="item_restaurant_id" name="restaurant_id" required
                                                class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-10 text-sm text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                                <option value="">
                                                    Select restaurant
                                                </option>

                                                @foreach ($restaurants as $restaurant)
                                                    <option value="{{ $restaurant->id }}">
                                                        {{ $restaurant->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            <i data-lucide="chevron-down"
                                                class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                            </i>

                                        </div>

                                    </div>


                                    {{-- Category --}}
                                    <div>

                                        <label for="item_category_id"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                                            Category

                                            <span class="text-rose-500">*</span>

                                        </label>

                                        <div class="relative">

                                            <i data-lucide="layers"
                                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                            </i>

                                            <select id="item_category_id" name="category_id" required
                                                class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-10 text-sm text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                                <option value="">
                                                    Select category
                                                </option>

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            <i data-lucide="chevron-down"
                                                class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                            </i>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                            ITEM DETAILS
                            ================================================== --}}
                            <div class="border-t border-slate-100 pt-6">

                                <div class="mb-4">

                                    <h4 class="text-sm font-bold text-slate-900">
                                        Item Details
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Add the food item name, price and description.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                    {{-- Name --}}
                                    <div>

                                        <label for="item_name" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                            Food Item Name

                                            <span class="text-rose-500">*</span>

                                        </label>

                                        <div class="relative">

                                            <i data-lucide="utensils"
                                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                            </i>

                                            <input type="text" id="item_name" name="name" maxlength="150" required
                                                placeholder="Enter food item name"
                                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                        </div>

                                    </div>


                                    {{-- Price --}}
                                    <div>

                                        <label for="item_price" class="mb-1.5 block text-sm font-semibold text-slate-700">

                                            Price

                                            <span class="text-rose-500">*</span>

                                        </label>

                                        <div class="relative">

                                            <span
                                                class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-400">
                                                ₹
                                            </span>

                                            <input type="number" id="item_price" name="price" min="0"
                                                step="0.01" required placeholder="0.00"
                                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-8 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">

                                        </div>

                                    </div>


                                    {{-- Description --}}
                                    <div class="sm:col-span-2">

                                        <label for="item_description"
                                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                                            Description

                                        </label>

                                        <textarea id="item_description" name="description" rows="3" placeholder="Describe this food item..."
                                            class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"></textarea>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                            ITEM IMAGE
                            ================================================== --}}
                            <div class="border-t border-slate-100 pt-6">

                                <div class="mb-4">

                                    <h4 class="text-sm font-bold text-slate-900">
                                        Item Image
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Upload a clear image of your food item.
                                    </p>

                                </div>


                                <label for="item_image"
                                    class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center transition hover:border-slate-400 hover:bg-slate-100">

                                    <div id="itemImagePreviewWrapper"
                                        class="mb-3 flex h-32 w-full max-w-[260px] items-center justify-center overflow-hidden rounded-xl bg-white shadow-sm">

                                        <img id="itemImagePreview" src="" alt="Item Preview"
                                            class="hidden h-full w-full object-cover">

                                        <i id="itemImagePlaceholder" data-lucide="image-plus"
                                            class="h-8 w-8 text-slate-400">
                                        </i>

                                    </div>


                                    <span class="text-xs font-semibold text-slate-700">
                                        Click to upload image
                                    </span>

                                    <span class="mt-1 text-[11px] text-slate-400">
                                        JPG, JPEG, PNG, WEBP · Max 2MB
                                    </span>

                                    <input type="file" id="item_image" name="image" accept=".jpg,.jpeg,.png,.webp"
                                        class="hidden">

                                </label>

                            </div>


                            {{-- =================================================
                            FOOD TYPE
                            ================================================== --}}
                            <div class="border-t border-slate-100 pt-6">

                                <div class="mb-4">

                                    <h4 class="text-sm font-bold text-slate-900">
                                        Food Type
                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Select whether this food item is vegetarian or non-vegetarian.
                                    </p>

                                </div>


                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                                    {{-- Veg --}}
                                    <label class="cursor-pointer">

                                        <input type="radio" name="is_veg" value="1" id="item_veg"
                                            class="peer sr-only" checked>

                                        <div
                                            class="flex items-center gap-3 rounded-xl border border-slate-200 p-4 transition peer-checked:border-green-500 peer-checked:bg-green-50">

                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-100">

                                                <i data-lucide="leaf" class="h-5 w-5 text-green-600">
                                                </i>

                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-slate-800">
                                                    Vegetarian
                                                </p>

                                                <p class="mt-0.5 text-xs text-slate-500">
                                                    This item is vegetarian.
                                                </p>

                                            </div>

                                        </div>

                                    </label>


                                    {{-- Non Veg --}}
                                    <label class="cursor-pointer">

                                        <input type="radio" name="is_veg" value="0" id="item_non_veg"
                                            class="peer sr-only">

                                        <div
                                            class="flex items-center gap-3 rounded-xl border border-slate-200 p-4 transition peer-checked:border-rose-500 peer-checked:bg-rose-50">

                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-100">

                                                <i data-lucide="drumstick" class="h-5 w-5 text-rose-600">
                                                </i>

                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-slate-800">
                                                    Non-Vegetarian
                                                </p>

                                                <p class="mt-0.5 text-xs text-slate-500">
                                                    This item contains non-veg ingredients.
                                                </p>

                                            </div>

                                        </div>

                                    </label>

                                </div>

                            </div>


                            {{-- =================================================
                            STATUS
                            ================================================== --}}
                            <div class="border-t border-slate-100 pt-6">

                                <label
                                    class="flex cursor-pointer items-center justify-between gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4">

                                    <div>

                                        <p class="text-sm font-semibold text-slate-800">
                                            Item Status
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Active items can be displayed and ordered by customers.
                                        </p>

                                    </div>


                                    <div class="relative shrink-0">

                                        <input type="checkbox" name="status" id="item_status" value="1"
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
                    FOOTER
                    ================================================== --}}
                    <div
                        class="flex shrink-0 flex-col-reverse gap-2 border-t border-slate-200 bg-white px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

                        <button type="button" onclick="closeItemModal()"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 sm:w-auto">

                            Cancel

                        </button>


                        <button type="submit" id="itemSubmitButton"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 sm:w-auto">

                            <i data-lucide="save" class="h-4 w-4">
                            </i>

                            <span id="itemSubmitText">
                                Save Food Item
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =============================================================
    VIEW ITEM MODAL
    ============================================================= --}}
    <div id="itemViewModal" class="fixed inset-0 z-[100] hidden" aria-hidden="true">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" onclick="closeItemViewModal()">
        </div>


        {{-- Modal --}}
        <div class="relative flex min-h-full items-end justify-center p-0 sm:items-center sm:p-4">

            <div
                class="relative flex max-h-[95vh] w-full max-w-2xl flex-col overflow-hidden rounded-t-3xl bg-white shadow-2xl sm:max-h-[92vh] sm:rounded-2xl">

                {{-- Header --}}
                <div
                    class="flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-5 py-4 sm:px-6">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-900">

                            <i data-lucide="eye" class="h-5 w-5 text-white">
                            </i>

                        </div>

                        <div class="min-w-0">

                            <h3 class="truncate text-base font-bold text-slate-900 sm:text-lg">
                                Food Item Details
                            </h3>

                            <p class="truncate text-xs text-slate-500 sm:text-sm">
                                View item information
                            </p>

                        </div>

                    </div>


                    <button type="button" onclick="closeItemViewModal()"
                        class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

                        <i data-lucide="x" class="h-5 w-5">
                        </i>

                    </button>

                </div>


                {{-- Content --}}
                <div class="min-h-0 flex-1 overflow-y-auto">

                    <div class="space-y-6 p-5 sm:p-6">

                        {{-- Image --}}
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">

                            <div id="viewItemImageWrapper" class="flex h-52 items-center justify-center sm:h-64">

                                <img id="viewItemImage" src="" alt="Food Item"
                                    class="hidden h-full w-full object-cover">

                                <i id="viewItemImagePlaceholder" data-lucide="utensils" class="h-12 w-12 text-slate-300">
                                </i>

                            </div>

                        </div>


                        {{-- Name + Status --}}
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                            <div class="min-w-0">

                                <h4 id="viewItemName" class="text-xl font-bold text-slate-900">
                                    -
                                </h4>

                                <p id="viewItemRestaurant" class="mt-1 text-sm text-slate-500">
                                    -
                                </p>

                            </div>


                            <div id="viewItemStatus">
                            </div>

                        </div>


                        {{-- Information --}}
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-500">
                                    Category
                                </p>

                                <p id="viewItemCategory" class="mt-1 text-sm font-semibold text-slate-900">
                                    -
                                </p>

                            </div>


                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-500">
                                    Price
                                </p>

                                <p id="viewItemPrice" class="mt-1 text-sm font-bold text-slate-900">
                                    -
                                </p>

                            </div>


                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-500">
                                    Food Type
                                </p>

                                <p id="viewItemType" class="mt-1 text-sm font-semibold text-slate-900">
                                    -
                                </p>

                            </div>


                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-500">
                                    Item ID
                                </p>

                                <p id="viewItemId" class="mt-1 text-sm font-semibold text-slate-900">
                                    -
                                </p>

                            </div>

                        </div>


                        {{-- Description --}}
                        <div id="viewItemDescriptionWrapper" class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                            <p class="text-xs font-medium text-slate-500">
                                Description
                            </p>

                            <p id="viewItemDescription" class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700">
                                -
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="flex shrink-0 justify-end border-t border-slate-200 bg-white px-5 py-4 sm:px-6">

                    <button type="button" onclick="closeItemViewModal()"
                        class="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 sm:w-auto">

                        Close

                    </button>

                </div>

            </div>

        </div>

    </div>


@endsection


{{-- =============================================================
SCRIPTS
============================================================= --}}
@push('scripts')
    <script>
        /*
            |--------------------------------------------------------------------------
            | ITEM MODAL
            |--------------------------------------------------------------------------
            */

        const itemModal = document.getElementById('itemModal');
        const itemForm = document.getElementById('itemForm');

        const itemModalTitle = document.getElementById('itemModalTitle');
        const itemModalSubtitle = document.getElementById('itemModalSubtitle');

        const itemSubmitText = document.getElementById('itemSubmitText');


        function openItemModal(mode = 'add', item = null) {

            if (!itemModal || !itemForm) {
                return;
            }


            itemForm.reset();


            // Default values
            document.getElementById('item_veg').checked = true;
            document.getElementById('item_status').checked = true;


            // Reset image preview
            resetItemImagePreview();


            if (mode === 'edit' && item) {

                itemModalTitle.textContent = 'Edit Food Item';

                itemModalSubtitle.textContent =
                    'Update your food item information.';

                itemSubmitText.textContent = 'Update Food Item';


                itemForm.action =
                    "{{ url('owner/items') }}/" + item.id;


                let methodInput =
                    document.getElementById('itemFormMethod');

                methodInput.outerHTML =
                    '<input type="hidden" name="_method" id="itemFormMethod" value="PUT">';


                document.getElementById('item_restaurant_id').value =
                    item.restaurant_id ?? '';

                document.getElementById('item_category_id').value =
                    item.category_id ?? '';

                document.getElementById('item_name').value =
                    item.name ?? '';

                document.getElementById('item_price').value =
                    item.price ?? '';

                document.getElementById('item_description').value =
                    item.description ?? '';


                if (item.is_veg) {

                    document.getElementById('item_veg').checked = true;

                } else {

                    document.getElementById('item_non_veg').checked = true;

                }


                document.getElementById('item_status').checked =
                    Boolean(item.status);


                if (item.image) {

                    document.getElementById('itemImagePreview').src =
                        "{{ asset('storage') }}/" + item.image;

                    document.getElementById('itemImagePreview').classList.remove('hidden');

                    document.getElementById('itemImagePlaceholder').classList.add('hidden');

                }

            } else {

                itemModalTitle.textContent = 'Add Food Item';

                itemModalSubtitle.textContent =
                    'Add a new item to your restaurant menu.';

                itemSubmitText.textContent = 'Save Food Item';


                itemForm.action =
                    "{{ route('owner.items.store') }}";


                let methodInput =
                    document.getElementById('itemFormMethod');

                methodInput.outerHTML =
                    '<input type="hidden" id="itemFormMethod" value="POST">';

            }


            itemModal.classList.remove('hidden');

            itemModal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('overflow-hidden');


            setTimeout(() => {

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            }, 50);

        }


        function closeItemModal() {

            if (!itemModal) {
                return;
            }

            itemModal.classList.add('hidden');

            itemModal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | IMAGE PREVIEW
        |--------------------------------------------------------------------------
        */

        const itemImageInput =
            document.getElementById('item_image');


        if (itemImageInput) {

            itemImageInput.addEventListener('change', function() {

                const file = this.files[0];

                const preview =
                    document.getElementById('itemImagePreview');

                const placeholder =
                    document.getElementById('itemImagePlaceholder');


                if (!file) {

                    resetItemImagePreview();

                    return;
                }


                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];


                if (!allowedTypes.includes(file.type)) {

                    alert('Please select a valid image file.');

                    this.value = '';

                    resetItemImagePreview();

                    return;
                }


                if (file.size > 2 * 1024 * 1024) {

                    alert('Image size must be less than 2MB.');

                    this.value = '';

                    resetItemImagePreview();

                    return;
                }


                const reader = new FileReader();


                reader.onload = function(event) {

                    preview.src =
                        event.target.result;

                    preview.classList.remove('hidden');

                    placeholder.classList.add('hidden');

                };


                reader.readAsDataURL(file);

            });

        }


        function resetItemImagePreview() {

            const preview =
                document.getElementById('itemImagePreview');

            const placeholder =
                document.getElementById('itemImagePlaceholder');

            const input =
                document.getElementById('item_image');


            if (preview) {

                preview.src = '';

                preview.classList.add('hidden');

            }


            if (placeholder) {

                placeholder.classList.remove('hidden');

            }


            if (input) {

                input.value = '';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | VIEW MODAL
        |--------------------------------------------------------------------------
        */

        const itemViewModal =
            document.getElementById('itemViewModal');


        function openItemViewModal(item) {

            if (!itemViewModal || !item) {
                return;
            }


            document.getElementById('viewItemName').textContent =
                item.name ?? '-';


            document.getElementById('viewItemRestaurant').textContent =
                item.restaurant?.name ?? '-';


            document.getElementById('viewItemCategory').textContent =
                item.category?.name ?? '-';


            document.getElementById('viewItemPrice').textContent =
                '₹' + Number(item.price ?? 0).toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });


            document.getElementById('viewItemType').textContent =
                item.is_veg ? 'Vegetarian' : 'Non-Vegetarian';


            document.getElementById('viewItemId').textContent =
                '#' + item.id;


            document.getElementById('viewItemDescription').textContent =
                item.description ?? 'No description available.';


            const statusWrapper =
                document.getElementById('viewItemStatus');


            if (item.status) {

                statusWrapper.innerHTML = `
                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Active
                </span>
            `;

            } else {

                statusWrapper.innerHTML = `
                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                    Inactive
                </span>
            `;

            }


            const image =
                document.getElementById('viewItemImage');

            const placeholder =
                document.getElementById('viewItemImagePlaceholder');


            if (item.image) {

                image.src =
                    "{{ asset('storage') }}/" + item.image;

                image.classList.remove('hidden');

                placeholder.classList.add('hidden');

            } else {

                image.src = '';

                image.classList.add('hidden');

                placeholder.classList.remove('hidden');

            }


            itemViewModal.classList.remove('hidden');

            itemViewModal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('overflow-hidden');


            setTimeout(() => {

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            }, 50);

        }


        function closeItemViewModal() {

            if (!itemViewModal) {
                return;
            }

            itemViewModal.classList.add('hidden');

            itemViewModal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | ESCAPE KEY
        |--------------------------------------------------------------------------
        */

        document.addEventListener('keydown', function(event) {

            if (event.key !== 'Escape') {
                return;
            }


            closeItemModal();

            closeItemViewModal();

        });


        /*
        |--------------------------------------------------------------------------
        | LUCIDE ICONS
        |--------------------------------------------------------------------------
        */

        document.addEventListener('DOMContentLoaded', function() {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

        });
    </script>
@endpush
