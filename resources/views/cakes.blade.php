<x-layout>
    <section class="py-5">
        <div class="container text-center">
            <p class="bb-eyebrow mb-3">THE CAKE COLLECTION</p>

            <h1 class="display-4 mb-3">
                A cake for every lovely moment.
            </h1>

            <p class="bb-hero-description mb-0">
                Explore our cakes and find your celebration favourite.
            </p>
        </div>
    </section>
    <section class="pb-5">
    <div class="container">
        <div class="row g-4">
           <div class="row g-4">
    @forelse ($cakes as $cake)
        <div class="col-md-6 col-lg-4">
            <x-cake-card
                :cake-id="$cake->id"
                :name="$cake->name"
                :image="$cake->image"
                :image-url="asset('storage/' . $cake->image)"
                :tagline="$cake->tagline"
                :description="$cake->description"
            />
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h2 class="h4">Something lovely is baking.</h2>
            <p class="mb-0">Our cake collection will be here soon.</p>
        </div>
    @endforelse
</div>
     



        </div>
    </div>
</section>
</x-layout>