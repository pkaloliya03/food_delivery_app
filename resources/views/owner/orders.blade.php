@extends('owner.layout')

@section('title', 'Orders')
@section('page-title', 'Orders')
@section('breadcrumb', 'Manage Orders')

@section('content')

    <div class="space-y-6">

        {{-- PAGE HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                    Orders
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage customer orders received by your restaurants.
                </p>
            </div>

            <div
                class="inline-flex items-center gap-2 self-start rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm">
                <i data-lucide="clipboard-list" class="h-4 w-4 text-slate-400"></i>
                {{ $orders->total() }} Total Orders
            </div>
        </div>


        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Total Orders --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Orders
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $orderStats['total'] }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100">
                        <i data-lucide="shopping-bag" class="h-5 w-5 text-slate-700"></i>
                    </div>
                </div>
            </div>

            {{-- Pending --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Pending Orders
                        </p>

                        <p class="mt-2 text-2xl font-bold text-amber-600">
                            {{ $orderStats['pending'] }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50">
                        <i data-lucide="clock" class="h-5 w-5 text-amber-600"></i>
                    </div>
                </div>
            </div>

            {{-- Accepted --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Accepted Orders
                        </p>

                        <p class="mt-2 text-2xl font-bold text-blue-600">
                            {{ $orderStats['accepted'] }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <i data-lucide="check-circle" class="h-5 w-5 text-blue-600"></i>
                    </div>
                </div>
            </div>

            {{-- Delivered --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Delivered Orders
                        </p>

                        <p class="mt-2 text-2xl font-bold text-emerald-600">
                            {{ $orderStats['delivered'] }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                        <i data-lucide="package-check" class="h-5 w-5 text-emerald-600"></i>
                    </div>
                </div>
            </div>

        </div>


        {{-- ORDERS LIST --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- LIST HEADER --}}
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-base font-semibold text-slate-900">
                            Customer Orders
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Showing {{ $orders->count() }} of {{ $orders->total() }} orders
                        </p>
                    </div>

                    <div class="inline-flex items-center gap-2 text-xs font-medium text-slate-400">
                        <i data-lucide="refresh-cw" class="h-3.5 w-3.5"></i>
                        Latest orders first
                    </div>

                </div>
            </div>


            {{-- DESKTOP TABLE --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Order
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Restaurant
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Order Items
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Amount
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>
                        </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse ($orders as $order)

                            @php
                                $statusStyles = [
                                    'pending' => 'bg-amber-50 text-amber-700',
                                    'accepted' => 'bg-blue-50 text-blue-700',
                                    'preparing' => 'bg-indigo-50 text-indigo-700',
                                    'ready' => 'bg-purple-50 text-purple-700',
                                    'out_for_delivery' => 'bg-orange-50 text-orange-700',
                                    'delivered' => 'bg-emerald-50 text-emerald-700',
                                    'rejected' => 'bg-rose-50 text-rose-700',
                                ];

                                $statusClass = $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-600';
                            @endphp

                            <tr class="transition hover:bg-slate-50/70">

                                {{-- Order --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-slate-900">
                                        {{ $order->order_no }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->created_at->format('d M Y, h:i A') }}
                                    </p>
                                </td>


                                {{-- Customer --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-slate-800">
                                        {{ $order->customer_name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->username }}
                                    </p>

                                    <p class="mt-1 flex items-center gap-1 text-xs text-slate-500">
                                        <i data-lucide="phone" class="h-3 w-3"></i>
                                        {{ $order->mobile }}
                                    </p>
                                </td>


                                {{-- Restaurant --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-sm text-slate-700">
                                        <i data-lucide="store" class="h-4 w-4 text-slate-400"></i>
                                        {{ $order->restaurant->name ?? '-' }}
                                    </div>
                                </td>


                                {{-- Order Items --}}
                                <td class="px-6 py-4">
                                    <div class="space-y-1.5">
                                        @foreach ($order->items as $orderItem)
                                            <div class="flex items-center gap-2 text-xs">
                                                <span class="font-bold text-slate-700">
                                                    {{ $orderItem->quantity }} ×
                                                </span>

                                                <span class="max-w-[160px] truncate text-slate-600">
                                                    {{ $orderItem->item_name }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>


                                {{-- Amount --}}
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-slate-900">
                                        ₹{{ number_format((float) $order->total_amount, 2) }}
                                    </span>
                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold {{ $statusClass }}">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex max-w-sm flex-col items-center">

                                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">
                                            <i data-lucide="shopping-bag" class="h-7 w-7 text-slate-400"></i>
                                        </div>

                                        <h3 class="mt-4 text-base font-semibold text-slate-900">
                                            No orders yet
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            New customer orders will appear here when they place an order.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- MOBILE ORDER CARDS --}}
            <div class="divide-y divide-slate-100 md:hidden">

                @forelse ($orders as $order)

                    @php
                        $statusClass = $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-600';
                    @endphp

                    <div class="space-y-4 p-4">

                        {{-- Order Header --}}
                        <div class="flex items-start justify-between gap-3">

                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900">
                                    {{ $order->order_no }}
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                </p>
                            </div>

                            <span
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-full px-2.5 py-1.5 text-[10px] font-bold {{ $statusClass }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>

                        </div>


                        {{-- Customer --}}
                        <div class="rounded-xl bg-slate-50 p-3">

                            <div class="flex items-center gap-2">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-slate-500">
                                    <i data-lucide="user-round" class="h-4 w-4"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800">
                                        {{ $order->customer_name }}
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        {{ $order->username }} · {{ $order->mobile }}
                                    </p>
                                </div>
                            </div>

                        </div>


                        {{-- Restaurant --}}
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <i data-lucide="store" class="h-4 w-4"></i>
                            {{ $order->restaurant->name ?? '-' }}
                        </div>


                        {{-- Items --}}
                        <div>
                            <p class="mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Ordered Items
                            </p>

                            <div class="space-y-2">
                                @foreach ($order->items as $orderItem)
                                    <div class="flex items-center justify-between gap-3 text-sm">
                                        <span class="min-w-0 truncate text-slate-600">
                                            {{ $orderItem->quantity }} × {{ $orderItem->item_name }}
                                        </span>

                                        <span class="shrink-0 font-semibold text-slate-800">
                                            ₹{{ number_format((float) $orderItem->total, 2) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        {{-- Total --}}
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            <span class="text-xs font-semibold text-slate-500">
                                Order Total
                            </span>

                            <span class="text-base font-extrabold text-slate-900">
                                ₹{{ number_format((float) $order->total_amount, 2) }}
                            </span>
                        </div>

                    </div>

                @empty

                    <div class="px-5 py-14 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">
                            <i data-lucide="shopping-bag" class="h-7 w-7 text-slate-400"></i>
                        </div>

                        <h3 class="mt-4 text-base font-semibold text-slate-900">
                            No orders yet
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            New customer orders will appear here.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- PAGINATION --}}
            @if ($orders->hasPages())
                <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>

    </div>

@endsection
