<x-admin.layout>
    <a href="{{ route('admin.dashboard') }}" class="bb-admin-site-link text-decoration-none small">
        ← Back to requests
    </a>

    <div class="d-flex flex-wrap align-items-center
                justify-content-between gap-3 mt-4 mb-4">
        <div>
            <p class="bb-eyebrow mb-2">CAKE REQUEST</p>
            <h1 class="h2 mb-0">Request #{{ $order->id }}</h1>
        </div>

        <span class="bb-request-status rounded-pill px-3 py-2 bb-status-{{ $order->status }}">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <section class="bb-admin-order p-4 h-100">
                <h2 class="h5 mb-4">Customer details</h2>

                <p class="fw-bold mb-1">
                    {{ $order->customer_name }}
                </p>

                <a href="tel:{{ $order->phone }}"
                    class="bb-customer-phone d-inline-flex align-items-center
          gap-2 rounded-pill px-3 py-2 text-decoration-none">

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                 19.79 19.79 0 0 1-8.63-3.07
                 19.5 19.5 0 0 1-6-6
                 19.79 19.79 0 0 1-3.07-8.67
                 A2 2 0 0 1 4.11 2h3
                 a2 2 0 0 1 2 1.72
                 c.13.96.36 1.9.69 2.79
                 a2 2 0 0 1-.45 2.11L8.09 9.89
                 a16 16 0 0 0 6 6l1.27-1.27
                 a2 2 0 0 1 2.11-.45
                 c.89.33 1.83.56 2.79.69
                 A2 2 0 0 1 22 16.92z" />
                    </svg>

                    <span dir="ltr">{{ $order->phone }}</span>
                </a>

                <p class="small mt-4 mb-0">
                    Received {{ $order->created_at->copy()->timezone('Asia/Beirut')->format('d M Y, H:i') }}
                    <span class="d-block mt-1">Beirut time</span>
                </p>
            </section>
        </div>

        <div class="col-lg-7">
            <section class="bb-admin-order p-4">
                <h2 class="h5 mb-4">Cake details</h2>

                <dt class="col-sm-4">Selected cake</dt>
                <dd class="col-sm-8">
                    {{ $order->cake_name ?: 'Custom cake request' }}
                </dd>
                <dl class="row gy-3 mb-0">
                    <dt class="col-sm-4">Flavour</dt>
                    <dd class="col-sm-8">
                        {{ ucfirst($order->flavour) }}
                    </dd>

                    <dt class="col-sm-4">Guests</dt>
                    <dd class="col-sm-8">
                        {{ $order->guest_count }}
                    </dd>

                    <dt class="col-sm-4">Pickup date</dt>
                    <dd class="col-sm-8">
                        {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}
                    </dd>

                    <dt class="col-sm-4">Cake message</dt>
                    <dd class="col-sm-8 text-break">
                        {{ $order->cake_message ?: 'No message requested.' }}
                    </dd>

                    <dt class="col-sm-4">Notes</dt>
                    <dd class="col-sm-8 text-break bb-request-notes">{{ $order->notes ?: 'No additional notes.' }}
                    </dd>
                </dl>
            </section>
        </div>
    </div>



    <div class="row g-4 mt-1 align-items-start">

        @if ($order->reference_image)
            <div class="col-lg-4">
                <section class="bb-admin-order p-4">
                    <h2 class="h5 mb-3">Inspiration photo</h2>

                    <a href="{{ route('admin.orders.reference', $order) }}" target="_blank" rel="noopener">
                        <img src="{{ route('admin.orders.reference', $order) }}"
                            alt="Customer inspiration for request #{{ $order->id }}"
                            class="bb-admin-reference img-fluid d-block mx-auto">
                    </a>

                    <p class="small mt-2 mb-0">
                        Click the photo to view it in full size.
                    </p>
                </section>
            </div>
        @endif

        <div class="{{ $order->reference_image ? 'col-lg-8' : 'col-12' }}">
            <section class="bb-admin-order p-4">
                <h2 class="h5 mb-4">Manage request</h2>

                @if (session('success'))
                    <div class="alert bb-order-success" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert bb-order-errors" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    
                    @method('PATCH')

                    <div class="row g-3">
                       <div class="col-12">
    <fieldset>
        <legend class="fs-6 mb-3">Request status</legend>

        <div class="d-flex flex-wrap gap-2">
            @foreach ([
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ] as $value => $label)

                <input type="radio"
                       class="btn-check"
                       name="status"
                       id="status-{{ $value }}"
                       value="{{ $value }}"
                       @checked(old('status', $order->status) === $value)
                       required>

                <label for="status-{{ $value }}"
                       class="btn bb-status-choice rounded-pill px-3 py-2">
                    <span class="bb-status-dot bb-dot-{{ $value }}"
                          aria-hidden="true"></span>
                    {{ $label }}
                </label>
            @endforeach
        </div>
    </fieldset>
</div>

                        <div class="col-md-6">
                            <label for="finalPrice" class="form-label">
                                Final price (USD)
                            </label>

                            <input type="number" id="finalPrice" name="final_price" class="form-control py-3"
                                min="0" max="99999999.99" step="0.01"
                                value="{{ old('final_price', $order->final_price) }}">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn bb-admin-logout rounded-pill w-100 py-3">
                                Save changes
                            </button>
                        </div>
                    </div>

                    <p class="small mt-3 mb-0">
                        Confirm only after agreeing on the details and price
                        with the customer. Saving does not send a notification.
                    </p>
                </form>
            </section>
        </div>

    </div>


</x-admin.layout>
