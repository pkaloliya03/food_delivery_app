@extends('user.layout')

@section('content')
    @php
        use App\Models\Item;

        $cart = session('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        $itemIds = array_keys($cart['items'] ?? []);

        $checkoutItems = Item::with('restaurant')->whereIn('id', $itemIds)->get()->keyBy('id');

        $subtotal = 0;
        $totalQuantity = 0;
    @endphp

    <section class="min-h-screen bg-slate-50 px-4 py-10 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-6xl">

            {{-- Page Header --}}
            <div class="mb-8">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-600">
                    Almost There
                </p>

                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                    Checkout
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Complete your delivery details to place your order.
                </p>
            </div>

            <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-[1fr_360px]">

                {{-- Delivery Details --}}
                <div class="space-y-6">

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">

                        <div class="mb-6 flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <i data-lucide="map-pin" class="h-5 w-5"></i>
                            </div>

                            <div>
                                <h2 class="text-lg font-extrabold text-slate-900">
                                    Delivery Address
                                </h2>

                                <p class="text-xs text-slate-400">
                                    Where should we deliver your order?
                                </p>
                            </div>

                        </div>

                        <form id="checkoutForm" class="space-y-5">

                            {{-- Customer Name --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Full Name
                                </label>

                                <input type="text" name="customer_name" placeholder="Enter your full name" required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                            </div>

                            {{-- Mobile --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Mobile Number
                                </label>

                                <input type="tel" name="mobile" value="{{ auth()->user()->mobile ?? '' }}"
                                    placeholder="Enter mobile number" maxlength="10" pattern="[0-9]{10}" required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                            </div>

                            {{-- Address --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Full Address
                                </label>

                                <textarea name="address" rows="3" placeholder="House no, street, area, landmark..." required
                                    class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"></textarea>
                            </div>

                            {{-- City + Pincode --}}
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                                        City
                                    </label>

                                    <input type="text" name="city" value="{{ session('selected_city_name', '') }}"
                                        placeholder="Enter city" required
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                                        Pincode
                                    </label>

                                    <input type="text" name="pincode" placeholder="6-digit pincode" maxlength="6"
                                        pattern="[0-9]{6}" required
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                                </div>

                            </div>

                            {{-- Delivery Instructions --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Delivery Instructions
                                    <span class="font-normal text-slate-400">(Optional)</span>
                                </label>

                                <textarea name="instructions" rows="2" placeholder="Any instructions for delivery?"
                                    class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"></textarea>
                            </div>

                        </form>

                    </div>

                </div>

                {{-- Order Summary --}}
                <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <h2 class="text-lg font-extrabold text-slate-900">
                        Order Summary
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        {{ count($itemIds) }} different food items
                    </p>

                    <div class="mt-5 space-y-4">

                        @foreach ($cart['items'] as $itemId => $cartItem)
                            @php
                                $item = $checkoutItems->get($itemId);

                                if (!$item) {
                                    continue;
                                }

                                $quantity = (int) $cartItem['quantity'];
                                $lineTotal = (float) $item->price * $quantity;

                                $subtotal += $lineTotal;
                                $totalQuantity += $quantity;
                            @endphp

                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-bold text-slate-800">
                                        {{ $item->name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        ₹{{ number_format((float) $item->price, 2) }}
                                        × {{ $quantity }}
                                    </p>
                                </div>

                                <p class="shrink-0 text-sm font-bold text-slate-900">
                                    ₹{{ number_format($lineTotal, 2) }}
                                </p>

                            </div>
                        @endforeach

                    </div>

                    <div class="my-5 border-t border-slate-100"></div>

                    <div class="flex items-center justify-between text-sm text-slate-500">
                        <span>Total Items</span>
                        <span id="checkoutQuantity">{{ $totalQuantity }}</span>
                    </div>

                    <div class="mt-3 flex items-center justify-between text-sm text-slate-500">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="mt-3 flex items-center justify-between text-sm text-slate-500">
                        <span>Delivery Charges</span>
                        <span class="font-semibold text-emerald-600">To be confirmed</span>
                    </div>

                    <div class="my-5 border-t border-slate-100"></div>

                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-900">
                            Item Total
                        </span>

                        <span class="text-xl font-extrabold text-slate-900">
                            ₹{{ number_format($subtotal, 2) }}
                        </span>
                    </div>

                    {{-- Place Order --}}
                    <button type="submit" form="checkoutForm"
                        class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3.5 text-sm font-bold text-white transition hover:bg-emerald-600">

                        Place Order

                        <i data-lucide="arrow-right" class="h-4 w-4"></i>

                    </button>

                    <p class="mt-3 text-center text-[11px] leading-5 text-slate-400">
                        Your order details will be confirmed before final submission.
                    </p>

                    <a href="{{ route('cart.index') }}"
                        class="mt-4 flex w-full items-center justify-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-emerald-600">

                        <i data-lucide="arrow-left" class="h-4 w-4"></i>
                        Back to Cart

                    </a>

                </aside>

            </div>

        </div>

    </section>
@endsection
