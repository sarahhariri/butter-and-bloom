@props([
    'name',
    'image',
    'tagline',
    'description',
    'imageUrl' => null,
    'cakeId' => null,
])

<article class="bb-cake-card">
    <div class="bb-cake-photo">
    <a href="{{ route('orders.create', $cakeId ? ['cake' => $cakeId] : []) }}"
       class="d-block"
       aria-label="Request {{ $name }}">

        <img src="{{ $imageUrl ?: asset('assets/images/' . $image) }}"
             alt="{{ $name }}"
             class="img-fluid w-100"
             loading="lazy">
    </a>
</div>

    <div class="p-4">
        <p class="bb-eyebrow mb-2">{{ $tagline }}</p>

        <h3 class="h4 mb-2">{{ $name }}</h3>

        <p class="bb-cake-description mb-0">
            {{ $description }}
        </p>

        <a href="{{ route('orders.create', $cakeId ? ['cake' => $cakeId] : []) }}"
           class="bb-cake-order d-flex align-items-center
                  justify-content-center gap-2 py-3 px-3
                  rounded-pill fw-bold text-decoration-none mt-3">
            <x-cake-icon class="bb-order-cake" />
            <span>Request This Cake</span>
        </a>
    </div>
</article>