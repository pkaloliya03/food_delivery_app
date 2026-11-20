@extends('owner.layout')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-xl font-semibold tracking-tight text-slate-900">
                    Categories
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Manage food categories for your restaurants.
                </p>
            </div>

            <button type="button" onclick="openCategoryModal('add')"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5
                   text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800
                   focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2">

                <i data-lucide="plus" class="h-4 w-4"></i>

                <span>Add Category</span>

            </button>

        </div>


        {{-- =========================================================
        SUMMARY
    ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Total Categories --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Categories
                        </p>

                        <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                            {{ $categories->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100">
                        <i data-lucide="layers" class="h-5 w-5 text-slate-600"></i>
                    </div>

                </div>

            </div>


            {{-- Active Categories --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Active Categories
                        </p>

                        <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                            {{ $categories->where('status', true)->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                        <i data-lucide="check-circle" class="h-5 w-5 text-emerald-600"></i>
                    </div>

                </div>

            </div>


            {{-- Restaurants --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Restaurants
                        </p>

                        <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                            {{ $restaurants->count() }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <i data-lucide="store" class="h-5 w-5 text-blue-600"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        CATEGORY LIST
    ========================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Table Header --}}
            <div class="border-b border-slate-200 px-5 py-4">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            Category List
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Categories available across your restaurants.
                        </p>
                    </div>

                </div>

            </div>


            {{-- =====================================================
            DESKTOP TABLE
        ====================================================== --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="w-full text-left">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Category
                            </th>

                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Restaurant
                            </th>

                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Sort Order
                            </th>

                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($categories as $category)
                            <tr class="transition hover:bg-slate-50/70">

                                {{-- Category --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100">

                                            <i data-lucide="utensils" class="h-5 w-5 text-slate-600">
                                            </i>

                                        </div>


                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-900">
                                                {{ $category->name }}
                                            </p>

                                            @if ($category->description)
                                                <p class="mt-0.5 max-w-xs truncate text-xs text-slate-500">
                                                    {{ $category->description }}
                                                </p>
                                            @else
                                                <p class="mt-0.5 text-xs text-slate-400">
                                                    No description
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Restaurant --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-2">

                                        <i data-lucide="store" class="h-4 w-4 text-slate-400">
                                        </i>

                                        <span class="text-sm font-medium text-slate-700">
                                            {{ $category->restaurant->name }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Sort Order --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex min-w-[32px] items-center justify-center rounded-lg
                                           bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">

                                        {{ $category->sort_order }}

                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4">

                                    <form action="{{ route('owner.categories.toggle-status', $category->id) }}"
                                        method="POST">

                                        @csrf

                                        <button type="submit"
                                            title="{{ $category->status ? 'Click to deactivate' : 'Click to activate' }}"
                                            class="group inline-flex items-center gap-2 rounded-lg px-1 py-1
                                               transition hover:bg-slate-50
                                               focus:outline-none focus:ring-2 focus:ring-slate-200">

                                            {{-- Toggle --}}
                                            <span
                                                class="relative inline-flex h-6 w-11 shrink-0 items-center rounded-full
                                                   transition-colors duration-200
                                                   {{ $category->status ? 'bg-emerald-500' : 'bg-slate-300' }}">

                                                <span
                                                    class="inline-block h-4 w-4 rounded-full bg-white shadow-sm
                                                       transition-transform duration-200
                                                       {{ $category->status ? 'translate-x-6' : 'translate-x-1' }}">
                                                </span>

                                            </span>


                                            {{-- Status Text --}}
                                            <span
                                                class="text-xs font-semibold
                                                   {{ $category->status ? 'text-emerald-700' : 'text-slate-500' }}">

                                                {{ $category->status ? 'Active' : 'Inactive' }}

                                            </span>

                                        </button>

                                    </form>

                                </td>


                                {{-- Actions --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-1">

                                        {{-- View --}}
                                        <button type="button" onclick='openCategoryViewModal(@json($category))'
                                            title="View"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg
                                               text-slate-500 transition
                                               hover:bg-slate-100 hover:text-slate-900
                                               focus:outline-none focus:ring-2 focus:ring-slate-200">

                                            <i data-lucide="eye" class="h-4 w-4"></i>

                                        </button>


                                        {{-- Edit --}}
                                        <button type="button"
                                            onclick='openCategoryModal("edit", @json($category))' title="Edit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg
                                               text-slate-500 transition
                                               hover:bg-slate-100 hover:text-slate-900
                                               focus:outline-none focus:ring-2 focus:ring-slate-200">

                                            <i data-lucide="pencil" class="h-4 w-4"></i>

                                        </button>


                                        {{-- Delete --}}
                                        <button type="button"
                                            onclick='openCategoryDeleteModal(@json($category))' title="Delete"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg
                                               text-slate-500 transition
                                               hover:bg-red-50 hover:text-red-600
                                               focus:outline-none focus:ring-2 focus:ring-red-100">

                                            <i data-lucide="trash-2" class="h-4 w-4"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-5 py-14 text-center">

                                    <div class="mx-auto flex max-w-sm flex-col items-center">

                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">

                                            <i data-lucide="layers" class="h-6 w-6 text-slate-400">
                                            </i>

                                        </div>


                                        <h3 class="mt-4 text-sm font-semibold text-slate-900">
                                            No categories yet
                                        </h3>


                                        <p class="mt-1 text-sm text-slate-500">
                                            Create your first category to organize your food items.
                                        </p>


                                        <button type="button" onclick="openCategoryModal('add')"
                                            class="mt-4 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5
                                               text-sm font-semibold text-white transition hover:bg-slate-800">

                                            <i data-lucide="plus" class="h-4 w-4"></i>

                                            Add Category

                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
            MOBILE CATEGORY CARDS
        ====================================================== --}}
            <div class="divide-y divide-slate-100 md:hidden">

                @forelse($categories as $category)
                    <div class="p-4">

                        {{-- Top --}}
                        <div class="flex items-start justify-between gap-3">

                            {{-- Category Info --}}
                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100">

                                    <i data-lucide="utensils" class="h-5 w-5 text-slate-600">
                                    </i>

                                </div>


                                <div class="min-w-0">

                                    <p class="truncate text-sm font-semibold text-slate-900">
                                        {{ $category->name }}
                                    </p>

                                    <p class="mt-0.5 truncate text-xs text-slate-500">
                                        {{ $category->restaurant->name }}
                                    </p>

                                </div>

                            </div>


                            {{-- Status Toggle --}}
                            <form action="{{ route('owner.categories.toggle-status', $category->id) }}" method="POST"
                                class="shrink-0">

                                @csrf

                                <button type="submit"
                                    title="{{ $category->status ? 'Click to deactivate' : 'Click to activate' }}"
                                    class="inline-flex items-center gap-2 rounded-lg px-1 py-1
                                       transition hover:bg-slate-50
                                       focus:outline-none focus:ring-2 focus:ring-slate-200">

                                    <span
                                        class="relative inline-flex h-6 w-11 shrink-0 items-center rounded-full
                                           transition-colors duration-200
                                           {{ $category->status ? 'bg-emerald-500' : 'bg-slate-300' }}">

                                        <span
                                            class="inline-block h-4 w-4 rounded-full bg-white shadow-sm
                                               transition-transform duration-200
                                               {{ $category->status ? 'translate-x-6' : 'translate-x-1' }}">
                                        </span>

                                    </span>


                                    <span
                                        class="text-[11px] font-semibold
                                           {{ $category->status ? 'text-emerald-700' : 'text-slate-500' }}">

                                        {{ $category->status ? 'Active' : 'Inactive' }}

                                    </span>

                                </button>

                            </form>

                        </div>


                        {{-- Description --}}
                        @if ($category->description)
                            <p class="mt-3 text-xs leading-5 text-slate-500">
                                {{ $category->description }}
                            </p>
                        @else
                            <p class="mt-3 text-xs text-slate-400">
                                No description
                            </p>
                        @endif


                        {{-- Bottom --}}
                        <div class="mt-4 flex items-center justify-between gap-3 border-t border-slate-100 pt-3">

                            {{-- Sort --}}
                            <div class="flex items-center gap-1.5 text-xs text-slate-500">

                                <i data-lucide="arrow-down-up" class="h-3.5 w-3.5">
                                </i>

                                <span>
                                    Sort:
                                </span>

                                <span class="font-semibold text-slate-700">
                                    {{ $category->sort_order }}
                                </span>

                            </div>


                            {{-- Actions --}}
                            <div class="flex items-center gap-1">

                                {{-- View --}}
                                <button type="button" onclick='openCategoryViewModal(@json($category))'
                                    title="View"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg
                                       text-slate-500 transition
                                       hover:bg-slate-100 hover:text-slate-900
                                       focus:outline-none focus:ring-2 focus:ring-slate-200">

                                    <i data-lucide="eye" class="h-4 w-4"></i>

                                </button>


                                {{-- Edit --}}
                                <button type="button" onclick='openCategoryModal("edit", @json($category))'
                                    title="Edit"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg
                                       text-slate-500 transition
                                       hover:bg-slate-100 hover:text-slate-900
                                       focus:outline-none focus:ring-2 focus:ring-slate-200">

                                    <i data-lucide="pencil" class="h-4 w-4"></i>

                                </button>


                                {{-- Delete --}}
                                <button type="button" onclick='openCategoryDeleteModal(@json($category))'
                                    title="Delete"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg
                                       text-slate-500 transition
                                       hover:bg-red-50 hover:text-red-600
                                       focus:outline-none focus:ring-2 focus:ring-red-100">

                                    <i data-lucide="trash-2" class="h-4 w-4"></i>

                                </button>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-5 py-14 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">

                            <i data-lucide="layers" class="h-6 w-6 text-slate-400">
                            </i>

                        </div>


                        <h3 class="mt-4 text-sm font-semibold text-slate-900">
                            No categories yet
                        </h3>


                        <p class="mt-1 text-sm text-slate-500">
                            Create your first category.
                        </p>


                        <button type="button" onclick="openCategoryModal('add')"
                            class="mt-4 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5
                               text-sm font-semibold text-white transition hover:bg-slate-800">

                            <i data-lucide="plus" class="h-4 w-4"></i>

                            Add Category

                        </button>

                    </div>
                @endforelse

            </div>

        </div>

    </div>


    {{-- =============================================================
    ADD / EDIT CATEGORY MODAL
============================================================= --}}
    <div id="categoryModal" class="fixed inset-0 z-[100] hidden">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeCategoryModal()">
        </div>


        {{-- Modal Wrapper --}}
        <div class="relative flex min-h-full items-center justify-center p-4">

            <div class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">

                    <div>

                        <h2 id="categoryModalTitle" class="text-base font-semibold text-slate-900">

                            Add Category

                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Add a category to your restaurant.
                        </p>

                    </div>


                    <button type="button" onclick="closeCategoryModal()"
                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-400
                           transition hover:bg-slate-100 hover:text-slate-700">

                        <i data-lucide="x" class="h-5 w-5"></i>

                    </button>

                </div>


                {{-- Form --}}
                <form id="categoryForm" action="{{ route('owner.categories.store') }}" method="POST">

                    @csrf

                    <input type="hidden" id="categoryMethod" name="_method" value="POST">


                    <div class="max-h-[70vh] overflow-y-auto px-5 py-5">

                        <div class="space-y-5">

                            {{-- Restaurant --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-slate-700">

                                    Restaurant

                                    <span class="text-red-500">*</span>

                                </label>


                                <select id="categoryRestaurant" name="restaurant_id" required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5
                                       text-sm text-slate-900 outline-none transition
                                       focus:border-slate-400 focus:ring-2 focus:ring-slate-100">

                                    <option value="">
                                        Select Restaurant
                                    </option>

                                    @foreach ($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}">
                                            {{ $restaurant->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            {{-- Category Name --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-slate-700">

                                    Category Name

                                    <span class="text-red-500">*</span>

                                </label>


                                <input type="text" id="categoryName" name="name" required maxlength="150"
                                    placeholder="e.g. Pizza, Burgers, Beverages"
                                    class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5
                                       text-sm text-slate-900 outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-slate-400 focus:ring-2 focus:ring-slate-100">

                            </div>


                            {{-- Description --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                    Description
                                </label>


                                <textarea id="categoryDescription" name="description" rows="3"
                                    placeholder="Short description about this category..."
                                    class="w-full resize-none rounded-xl border border-slate-200 px-3.5 py-2.5
                                       text-sm text-slate-900 outline-none transition
                                       placeholder:text-slate-400
                                       focus:border-slate-400 focus:ring-2 focus:ring-slate-100"></textarea>

                            </div>


                            {{-- Sort Order --}}
                            <div>

                                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                    Sort Order
                                </label>


                                <input type="number" id="categorySortOrder" name="sort_order" min="0"
                                    value="0" placeholder="0"
                                    class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5
                                       text-sm text-slate-900 outline-none transition
                                       focus:border-slate-400 focus:ring-2 focus:ring-slate-100">


                                <p class="mt-1.5 text-xs text-slate-400">
                                    Lower numbers will appear first.
                                </p>

                            </div>


                            {{-- Status --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <label class="flex cursor-pointer items-center justify-between gap-4">

                                    <div>

                                        <p class="text-sm font-medium text-slate-800">
                                            Active Category
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-500">
                                            Inactive categories won't be available for normal use.
                                        </p>

                                    </div>


                                    <div class="relative shrink-0">

                                        <input type="checkbox" id="categoryStatus" name="status" value="1"
                                            class="peer sr-only">


                                        <div
                                            class="h-6 w-11 rounded-full bg-slate-300 transition
                                               peer-checked:bg-emerald-500">
                                        </div>


                                        <div
                                            class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-sm transition
                                               peer-checked:translate-x-5">
                                        </div>

                                    </div>

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div
                        class="flex flex-col-reverse gap-2 border-t border-slate-200 bg-slate-50 px-5 py-4
                           sm:flex-row sm:justify-end">

                        <button type="button" onclick="closeCategoryModal()"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white
                               px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                            Cancel

                        </button>


                        <button type="submit" id="categorySubmitButton"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900
                               px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition
                               hover:bg-slate-800">

                            <i data-lucide="check" class="h-4 w-4"></i>

                            <span id="categorySubmitText">
                                Save Category
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =============================================================
    VIEW CATEGORY MODAL
============================================================= --}}
    <div id="categoryViewModal" class="fixed inset-0 z-[100] hidden">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeCategoryViewModal()">
        </div>


        <div class="relative flex min-h-full items-center justify-center p-4">

            <div class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">

                    <div>

                        <h2 class="text-base font-semibold text-slate-900">
                            Category Details
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            View category information.
                        </p>

                    </div>


                    <button type="button" onclick="closeCategoryViewModal()"
                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-400
                           transition hover:bg-slate-100 hover:text-slate-700">

                        <i data-lucide="x" class="h-5 w-5"></i>

                    </button>

                </div>


                {{-- Content --}}
                <div class="px-5 py-5">

                    <div class="space-y-4">

                        {{-- Category Header --}}
                        <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white shadow-sm">

                                <i data-lucide="utensils" class="h-6 w-6 text-slate-600">
                                </i>

                            </div>


                            <div class="min-w-0">

                                <h3 id="viewCategoryName" class="truncate text-lg font-semibold text-slate-900">

                                    —

                                </h3>


                                <p id="viewCategoryRestaurant"
                                    class="mt-1 flex items-center gap-1.5 text-sm text-slate-500">

                                    <i data-lucide="store" class="h-3.5 w-3.5"></i>

                                    —

                                </p>

                            </div>

                        </div>


                        {{-- Information Grid --}}
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                            {{-- Status --}}
                            <div class="rounded-xl border border-slate-200 p-4">

                                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                    Status
                                </p>

                                <div id="viewCategoryStatus" class="mt-2">
                                </div>

                            </div>


                            {{-- Sort Order --}}
                            <div class="rounded-xl border border-slate-200 p-4">

                                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                    Sort Order
                                </p>

                                <p id="viewCategorySortOrder" class="mt-2 text-sm font-semibold text-slate-900">

                                    —

                                </p>

                            </div>

                        </div>


                        {{-- Description --}}
                        <div class="rounded-xl border border-slate-200 p-4">

                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Description
                            </p>

                            <p id="viewCategoryDescription"
                                class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-600">

                                —

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="flex justify-end border-t border-slate-200 bg-slate-50 px-5 py-4">

                    <button type="button" onclick="closeCategoryViewModal()"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5
                           text-sm font-semibold text-white transition hover:bg-slate-800">

                        Close

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =============================================================
    DELETE CATEGORY MODAL
============================================================= --}}
    <div id="categoryDeleteModal" class="fixed inset-0 z-[110] hidden">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeCategoryDeleteModal()">
        </div>


        <div class="relative flex min-h-full items-center justify-center p-4">

            <div class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

                {{-- Content --}}
                <div class="p-6 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50">

                        <i data-lucide="trash-2" class="h-6 w-6 text-red-600">
                        </i>

                    </div>


                    <h2 class="mt-4 text-lg font-semibold text-slate-900">
                        Delete Category?
                    </h2>


                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Are you sure you want to delete

                        <span id="deleteCategoryName" class="font-semibold text-slate-700">
                        </span>?

                    </p>


                    <p class="mt-2 text-xs text-slate-400">
                        This action cannot be undone.
                    </p>

                </div>


                {{-- Footer --}}
                <div
                    class="flex flex-col-reverse gap-2 border-t border-slate-200 bg-slate-50 px-5 py-4
                       sm:flex-row sm:justify-end">

                    <button type="button" onclick="closeCategoryDeleteModal()"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white
                           px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                        Cancel

                    </button>


                    <form id="categoryDeleteForm" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" id="categoryDeleteButton"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-red-600
                               px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700
                               sm:w-auto">

                            <i data-lucide="trash-2" class="h-4 w-4"></i>

                            Delete Category

                        </button>

                    </form>

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
        | Open Category Modal
        |--------------------------------------------------------------------------
        */

        function openCategoryModal(mode, category = null) {

            const modal = document.getElementById('categoryModal');

            const form = document.getElementById('categoryForm');

            const title = document.getElementById('categoryModalTitle');

            const submitText = document.getElementById('categorySubmitText');

            const method = document.getElementById('categoryMethod');

            const restaurant = document.getElementById('categoryRestaurant');

            const name = document.getElementById('categoryName');

            const description = document.getElementById('categoryDescription');

            const sortOrder = document.getElementById('categorySortOrder');

            const status = document.getElementById('categoryStatus');


            /*
            |--------------------------------------------------------------------------
            | ADD MODE
            |--------------------------------------------------------------------------
            */

            if (mode === 'add') {

                title.textContent = 'Add Category';

                submitText.textContent = 'Save Category';

                form.action = "{{ route('owner.categories.store') }}";

                method.value = 'POST';

                restaurant.value = '';

                name.value = '';

                description.value = '';

                sortOrder.value = '0';

                status.checked = true;

            }


            /*
            |--------------------------------------------------------------------------
            | EDIT MODE
            |--------------------------------------------------------------------------
            */

            if (mode === 'edit' && category) {

                title.textContent = 'Edit Category';

                submitText.textContent = 'Update Category';

                form.action = "{{ url('owner/categories') }}/" + category.id;

                method.value = 'PUT';

                restaurant.value = category.restaurant_id;

                name.value = category.name ?? '';

                description.value = category.description ?? '';

                sortOrder.value = category.sort_order ?? 0;

                status.checked = Boolean(category.status);

            }


            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');


            setTimeout(() => {
                name.focus();
            }, 100);

        }


        /*
        |--------------------------------------------------------------------------
        | Close Category Modal
        |--------------------------------------------------------------------------
        */

        function closeCategoryModal() {

            const modal = document.getElementById('categoryModal');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | Prevent Double Submit
        |--------------------------------------------------------------------------
        */

        const categoryForm = document.getElementById('categoryForm');

        if (categoryForm) {

            categoryForm.addEventListener('submit', function() {

                const button =
                    document.getElementById('categorySubmitButton');

                const text =
                    document.getElementById('categorySubmitText');


                button.disabled = true;

                button.classList.add(
                    'opacity-70',
                    'cursor-not-allowed'
                );

                text.textContent = 'Saving...';

            });

        }


        /*
        |--------------------------------------------------------------------------
        | View Category Modal
        |--------------------------------------------------------------------------
        */

        function openCategoryViewModal(category) {

            const modal =
                document.getElementById('categoryViewModal');

            const name =
                document.getElementById('viewCategoryName');

            const restaurant =
                document.getElementById('viewCategoryRestaurant');

            const status =
                document.getElementById('viewCategoryStatus');

            const sortOrder =
                document.getElementById('viewCategorySortOrder');

            const description =
                document.getElementById('viewCategoryDescription');


            name.textContent =
                category.name ?? '—';


            restaurant.innerHTML = `
            <i data-lucide="store" class="h-3.5 w-3.5"></i>
            <span>
                ${category.restaurant
                    ? category.restaurant.name
                    : '—'}
            </span>
        `;


            sortOrder.textContent =
                category.sort_order ?? '0';


            description.textContent =
                category.description?.trim() ?
                category.description :
                'No description available.';


            if (Boolean(category.status)) {

                status.innerHTML = `
                <span class="inline-flex items-center gap-1.5 rounded-full
                             bg-emerald-50 px-2.5 py-1
                             text-xs font-semibold text-emerald-700">

                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                    Active

                </span>
            `;

            } else {

                status.innerHTML = `
                <span class="inline-flex items-center gap-1.5 rounded-full
                             bg-slate-100 px-2.5 py-1
                             text-xs font-semibold text-slate-600">

                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                    Inactive

                </span>
            `;

            }


            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');


            if (window.lucide) {
                lucide.createIcons();
            }

        }


        /*
        |--------------------------------------------------------------------------
        | Close View Modal
        |--------------------------------------------------------------------------
        */

        function closeCategoryViewModal() {

            const modal =
                document.getElementById('categoryViewModal');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | Delete Category Modal
        |--------------------------------------------------------------------------
        */

        function openCategoryDeleteModal(category) {

            const modal =
                document.getElementById('categoryDeleteModal');

            const form =
                document.getElementById('categoryDeleteForm');

            const name =
                document.getElementById('deleteCategoryName');


            name.textContent =
                category.name ?? 'this category';


            form.action =
                "{{ url('owner/categories') }}/" + category.id;


            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | Close Delete Modal
        |--------------------------------------------------------------------------
        */

        function closeCategoryDeleteModal() {

            const modal =
                document.getElementById('categoryDeleteModal');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | ESC KEY
        |--------------------------------------------------------------------------
        */

        document.addEventListener('keydown', function(event) {

            if (event.key !== 'Escape') {
                return;
            }


            const categoryModal =
                document.getElementById('categoryModal');

            const viewModal =
                document.getElementById('categoryViewModal');

            const deleteModal =
                document.getElementById('categoryDeleteModal');


            if (!categoryModal.classList.contains('hidden')) {

                closeCategoryModal();

                return;

            }


            if (!viewModal.classList.contains('hidden')) {

                closeCategoryViewModal();

                return;

            }


            if (!deleteModal.classList.contains('hidden')) {

                closeCategoryDeleteModal();

            }

        });
    </script>
@endpush
