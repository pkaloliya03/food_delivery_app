@extends('user.layout')

@section('content')

    <section class="min-h-[65vh] bg-slate-50 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">

            {{-- Header --}}
            <div class="mb-8">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-600">
                    Your Selection
                </p>

                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                    My Cart
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Review your items before proceeding.
                </p>
            </div>

            @if ($cartItems->isNotEmpty())
                <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-[1fr_320px]">

                    {{-- Cart Items --}}
                    <div class="space-y-4" id="cartItemsContainer">

                        @foreach ($cartItems as $cartItem)
                            @php
                                $item = $cartItem['item'];
                                $quantity = $cartItem['quantity'];
                            @endphp

                            <article id="cart-item-{{ $item->id }}"
                                class="flex gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                                {{-- Image --}}
                                <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:h-28 sm:w-28">

                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full items-center justify-center">
                                            <i data-lucide="utensils-crossed" class="h-7 w-7 text-slate-300"></i>
                                        </div>
                                    @endif

                                </div>

                                {{-- Details --}}
                                <div class="flex min-w-0 flex-1 flex-col justify-between gap-3">

                                    <div class="flex items-start justify-between gap-2">

                                        <div class="min-w-0">
                                            <h2 class="font-bold text-slate-900">
                                                {{ $item->name }}
                                            </h2>

                                            @if ($item->restaurant)
                                                <p class="mt-1 text-xs text-slate-400">
                                                    {{ $item->restaurant->name }}
                                                </p>
                                            @endif

                                            <p class="mt-2 text-sm font-semibold text-slate-700">
                                                ₹{{ number_format((float) $item->price, 2) }}
                                            </p>
                                        </div>

                                        {{-- Remove Button --}}
                                        <button type="button" onclick="removeCartItem({{ $item->id }})"
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600"
                                            title="Remove item">

                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>

                                    </div>

                                    <div class="flex items-center justify-between gap-3">

                                        {{-- Quantity Controls --}}
                                        <div class="flex items-center rounded-xl border border-slate-200">

                                            <button type="button"
                                                onclick="updateCartQuantity({{ $item->id }}, {{ $quantity - 1 }})"
                                                {{ $quantity <= 1 ? 'disabled' : '' }}
                                                class="flex h-9 w-9 items-center justify-center rounded-l-xl text-slate-600 transition hover:bg-slate-100 disabled:cursor-not-allowed disabled:opacity-30">

                                                <i data-lucide="minus" class="h-3.5 w-3.5"></i>
                                            </button>

                                            <span id="quantity-{{ $item->id }}"
                                                class="min-w-9 text-center text-sm font-bold text-slate-800">
                                                {{ $quantity }}
                                            </span>

                                            <button type="button"
                                                onclick="updateCartQuantity({{ $item->id }}, {{ $quantity + 1 }})"
                                                {{ $quantity >= 99 ? 'disabled' : '' }}
                                                class="flex h-9 w-9 items-center justify-center rounded-r-xl text-slate-600 transition hover:bg-slate-100 disabled:cursor-not-allowed disabled:opacity-30">

                                                <i data-lucide="plus" class="h-3.5 w-3.5"></i>
                                            </button>

                                        </div>

                                        {{-- Item Subtotal --}}
                                        <p id="subtotal-{{ $item->id }}" class="text-sm font-extrabold text-slate-900">
                                            ₹{{ number_format($cartItem['subtotal'], 2) }}
                                        </p>

                                    </div>

                                </div>

                            </article>
                        @endforeach

                    </div>

                    {{-- Order Summary --}}
                    <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                        <h2 class="text-lg font-extrabold text-slate-900">
                            Order Summary
                        </h2>

                        <div class="mt-5 flex items-center justify-between text-sm text-slate-500">
                            <span>Items</span>
                            <span id="summaryItemCount">{{ $cartItems->sum('quantity') }}</span>
                        </div>

                        <div class="mt-4 flex items-center justify-between text-sm text-slate-500">
                            <span>Subtotal</span>
                            <span id="summarySubtotal">₹{{ number_format($total, 2) }}</span>
                        </div>

                        <div class="my-5 border-t border-slate-100"></div>

                        <div class="flex items-center justify-between gap-3">
                            <span class="font-bold text-slate-900">
                                Total
                            </span>

                            <span id="summaryTotal" class="text-xl font-extrabold text-slate-900">
                                ₹{{ number_format($total, 2) }}
                            </span>
                        </div>

                        <a href="{{ route('checkout') }}"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-600">

                            Proceed to Order

                            <i data-lucide="arrow-right" class="h-4 w-4"></i>
                        </a>

                        <a href="{{ route('home') }}#popular"
                            class="mt-4 flex w-full items-center justify-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-emerald-600">

                            <i data-lucide="arrow-left" class="h-4 w-4"></i>
                            Continue Shopping
                        </a>

                    </aside>

                </div>
            @else
                {{-- Empty Cart --}}
                <div class="rounded-3xl border border-dashed border-slate-200 bg-white px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50">
                        <i data-lucide="shopping-basket" class="h-8 w-8 text-slate-400"></i>
                    </div>

                    <h2 class="mt-5 text-xl font-extrabold text-slate-900">
                        Your cart is empty
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Explore our dishes and add something delicious.
                    </p>

                    <a href="{{ route('home') }}#popular"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-600">

                        Explore Dishes

                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </a>

                </div>
            @endif

        </div>
    </section>

    {{-- Cart JavaScript --}}
    <script>
        const cartUpdateUrl = @json(route('cart.update'));
        const cartRemoveUrl = @json(route('cart.remove'));
        const cartCsrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        async function cartRequest(url, itemId, quantity = null) {

            if (!cartCsrfToken) {
                alert('Security token missing. Please refresh the page.');
                return null;
            }

            const payload = {
                item_id: itemId
            };

            if (quantity !== null) {
                payload.quantity = quantity;
            }

            try {

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': cartCsrfToken
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    alert(data.message || 'Unable to update cart.');
                    return null;
                }

                return data;

            } catch (error) {

                console.error(error);
                alert('Something went wrong. Please try again.');
                return null;

            }
        }


        // Update item quantity
        async function updateCartQuantity(itemId, quantity) {

            if (quantity < 1 || quantity > 99) {
                return;
            }

            const data = await cartRequest(cartUpdateUrl, itemId, quantity);

            if (data) {
                // Reload page to refresh item subtotal and order total.
                window.location.reload();
            }
        }


        // Remove item from cart
        async function removeCartItem(itemId) {

            if (!confirm('Are you sure you want to remove this item?')) {
                return;
            }

            const data = await cartRequest(cartRemoveUrl, itemId);

            if (data) {
                // Reload page to show updated cart or empty cart screen.
                window.location.reload();
            }
        }
    </script>

@endsection
