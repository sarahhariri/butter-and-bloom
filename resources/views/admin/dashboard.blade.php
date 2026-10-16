<x-admin.layout>
    <p class="bb-eyebrow mb-2">YOUR BAKERY, AT A GLANCE</p>
    <h1 class="h2 mb-0">Cake requests</h1>

    <div class="row g-3 mt-2 mb-4">
    @foreach ([
        'total' => 'Total requests',
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
    ] as $key => $label)
        <div class="col-6 col-lg-3">
            <div class="bb-stat-card bb-stat-{{ $key }} p-3 p-md-4 h-100">
                <p class="small mb-2">{{ $label }}</p>
                <p class="bb-stat-number mb-0">
                    {{ number_format($stats[$key]) }}
                </p>
            </div>
        </div>
    @endforeach
</div>
    <form action="{{ route('admin.dashboard') }}" method="GET"
      class="row g-2 mt-3">

    @if ($status)
        <input type="hidden" name="status" value="{{ $status }}">
    @endif

    <div class="col">
        <label for="requestSearch" class="visually-hidden">
            Search by customer name or phone
        </label>

        <input type="search" id="requestSearch" name="search"
               class="form-control bb-request-search py-3"
               placeholder="Search by name or phone…"
               value="{{ $search }}" maxlength="100" autocomplete="off">
    </div>

    <div class="col-auto">
        <button type="submit"
                class="btn bb-admin-logout rounded-pill px-4 py-3 text-nowrap">
            Search
        </button>
    </div>

    @if ($search !== '')
        <div class="col-auto">
            <a href="{{ route('admin.dashboard', $status ? ['status' => $status] : []) }}"
               class="btn bb-request-filter rounded-pill px-3 py-3">
                Clear
            </a>
        </div>
    @endif
</form>
    <nav class="d-flex flex-wrap gap-2 mt-4"
     aria-label="Filter cake requests">

   <a href="{{ route('admin.dashboard', [
    'search' => $search !== '' ? $search : null,
]) }}"
       class="btn bb-request-filter rounded-pill px-3 {{ $status === null ? 'is-active' : '' }}"
       @if ($status === null) aria-current="page" @endif>
        All
    </a>

    @foreach ($filters as $value => $label)
       <a href="{{ route('admin.dashboard', [
    'status' => $value,
    'search' => $search !== '' ? $search : null,
]) }}"
           class="btn bb-request-filter rounded-pill px-3 {{ $status === $value ? 'is-active' : '' }}"
           @if ($status === $value) aria-current="page" @endif>
            {{ $label }}
        </a>
    @endforeach

</nav>
    <div class="row g-3 mt-3">
    @forelse ($orders as $order)
        <div class="col-md-6 col-xl-4">
            <article class="bb-admin-order p-4 h-100">
                <div class="d-flex align-items-center
                            justify-content-between gap-2 mb-3">
                    <span class="small">
                        Request #{{ $order->id }}
                    </span>

                    <span class="bb-request-status rounded-pill px-3 py-1 small bb-status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <h2 class="h5 mb-3">
                    {{ $order->customer_name }}
                </h2>

                <a href="tel:{{ $order->phone }}"
   class="bb-customer-phone d-inline-flex align-items-center
          gap-2 rounded-pill px-3 py-2 text-decoration-none">

    <svg width="16" height="16" viewBox="0 0 24 24"
         fill="none" stroke="currentColor" stroke-width="1.5"
         stroke-linecap="round" stroke-linejoin="round"
         aria-hidden="true">
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
                 A2 2 0 0 1 22 16.92z"/>
    </svg>

    <span dir="ltr">{{ $order->phone }}</span>
</a>

                <hr class="my-3">

                <dl class="row g-2 small mb-0">
                    <dt class="col-5">Flavour</dt>
                    <dd class="col-7 mb-0">
                        {{ ucfirst($order->flavour) }}
                    </dd>

                    <dt class="col-5">Guests</dt>
                    <dd class="col-7 mb-0">
                        {{ $order->guest_count }}
                    </dd>

                    <dt class="col-5">Pickup</dt>
                    <dd class="col-7 mb-0">
                        {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}
                    </dd>
                    <a href="{{ route('admin.orders.show', $order) }}"
   class="btn bb-admin-logout rounded-pill w-100 mt-4">
    View request
</a>
                </dl>
            </article>
        </div>
  @empty
    <div class="col-12">
        <div class="bb-admin-order p-5 text-center">
            <h2 class="h5">No requests found.</h2>

            <p class="small mb-0">
                {{ $status
                    ? 'There are no requests with this status.'
                    : 'New cake requests will appear here.' }}
            </p>
        </div>
    </div>
@endforelse
</div>

@if ($orders->hasPages())
    <div class="mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endif
</x-admin.layout>