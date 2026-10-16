<x-layout>
    <section class="bb-hero py-5">
        <div class="container">
            <div class="row align-items-center gx-4 gy-5">

                <div class="col-lg-6">
                    <p class="bb-eyebrow">
                        HANDMADE WITH LOVE
                    </p>

                    <h1 class="bb-hero-title mb-4">
                        Little cakes.<br>
                        <span>Lovely moments.</span>
                    </h1>

                    <p class="bb-hero-description mb-4">
                        Made with love, styled for you.<br>
                        A sweet little centrepiece for your special moments.
                    </p>

                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <a class="bb-order-btn" href="{{ url('/custom-order') }}">
                            Create Your Cake
                            <span aria-hidden="true">↗</span>
                        </a>

                        <a class="bb-collection-link" href="{{ url('/cakes') }}">
                            Explore the Collection
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="bb-hero-visual">
                        <span class="bb-cake-note">
                            Made by hand.<br>
                            <strong>Made for you.</strong>
                        </span>

                        <img src="{{ asset('assets/images/hero-cake.png') }}" class="img-fluid bb-hero-image"
                            alt="Pink buttercream cake with delicate flowers and bows">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bb-layer-section ">
        <div class="container">
            <div class="row align-items-center gx-4 gy-5">

                <div class="col-lg-5">
                    <p class="bb-eyebrow">LAYERED WITH LOVE</p>

                    <h2 class="display-5 mb-4">
                        A little magic.<br>
                        In every layer.
                    </h2>

                    <p class="bb-hero-description mb-0">
                        Soft sponge, strawberry filling, and a lovely finishing touch.
                        Every layer brings your celebration together.
                    </p>
                    <div class="bb-layer-details d-flex flex-wrap gap-2 mt-4">
                        <span>Soft sponge</span>
                        <span>Strawberry filling</span>
                        <span>Your finishing touch</span>
                    </div>

                    <a class="bb-order-btn mt-4" href="{{ url('/custom-order') }}">
                        Create Your Cake
                        <span aria-hidden="true">↗</span>
                    </a>
                </div>


                <div class="col-lg-7">
                    <div class="bb-layer-stage">

                        <div class="bb-cake-group">
                            <img src="{{ asset('assets/images/cake-sponge.png') }}" class="bb-cake-layer"
                                alt="">

                            <img src="{{ asset('assets/images/cake-filling.png') }}" class="bb-cake-layer"
                                alt="">

                            <img src="{{ asset('assets/images/cake-sponge.png') }}" class="bb-cake-layer"
                                alt="">

                            <img src="{{ asset('assets/images/cake-filling.png') }}" class="bb-cake-layer"
                                alt="">

                            <img src="{{ asset('assets/images/cake-top.png') }}" class="bb-cake-layer" alt="">
                        </div>
                        <svg class="bb-bloom bb-bloom-right" viewBox="0 0 64 64" aria-hidden="true">
                            <defs>
                                <g id="bb-bloom-flower">
                                    <ellipse cx="32" cy="19" rx="6" ry="10" />
                                    <ellipse cx="32" cy="19" rx="6" ry="10"
                                        transform="rotate(72 32 32)" />
                                    <ellipse cx="32" cy="19" rx="6" ry="10"
                                        transform="rotate(144 32 32)" />
                                    <ellipse cx="32" cy="19" rx="6" ry="10"
                                        transform="rotate(216 32 32)" />
                                    <ellipse cx="32" cy="19" rx="6" ry="10"
                                        transform="rotate(288 32 32)" />
                                    <circle cx="32" cy="32" r="4" />
                                </g>
                            </defs>

                            <use href="#bb-bloom-flower" />
                        </svg>

                        <svg class="bb-bloom bb-bloom-left" viewBox="0 0 64 64" aria-hidden="true">
                            <use href="#bb-bloom-flower" />
                        </svg>

                        <span class="bb-cake-sparkle" aria-hidden="true">✧</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
                <div>
                    <p class="bb-eyebrow mb-2">THE CAKE COLLECTION</p>

                    <h2 class="display-6 mb-0">
                        Find your sweet favourite.
                    </h2>
                </div>

                <a class="bb-collection-link" href="{{ url('/cakes') }}">
                    View All Cakes
                    <span aria-hidden="true">→</span>
                </a>
            </div>
            <div class="row g-4">
   @forelse ($featuredCakes as $cake)
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
    <div class="col-12 text-center py-4">
        <p class="mb-0">
            Something lovely is baking. Check back soon!
        </p>
    </div>
@endforelse
</div>

        </div>

    </section>

    <section class="bb-story-section py-5">
        <div class="container">
            <div class="row align-items-center gx-4 gy-5">

                <div class="col-lg-6 bb-story-photo">
                    <img src="{{ asset('assets/images/baking-story.png') }}" class="img-fluid w-100 bb-story-image"
                        alt="Hands carefully decorating a cake with pink buttercream" loading="lazy">
                </div>

                <div class="col-lg-5 offset-lg-1 bb-story-copy">
                    <p class="bb-eyebrow mb-3">BEHIND THE BUTTERCREAM</p>

                    <h2 class="display-5 mb-4">
                        From our kitchen,<br>
                        to your celebration.
                    </h2>

                    <p class="bb-hero-description mb-0">
                        Butter & Bloom is a home bakery where every cake
                        begins with a little care and your inspiration.
                        From the flavour to the finishing touches,
                        we make it personal.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="bb-how-section py-5">
        <div class="container">
            <p class="bb-eyebrow text-center mb-3">HOW IT WORKS</p>

            <h2 class="display-6 text-center mb-5">
                Your celebration starts here.
            </h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bb-step-number">01</span>

                        <span class="bb-step-line flex-grow-1 d-none d-md-block" aria-hidden="true"></span>
                    </div>
                    <p class="bb-eyebrow mb-2">DREAM IT</p>
                    <h3 class="h5">Tell us your idea</h3>
                    <p class="bb-hero-description mb-0">
                        Choose your flavour, size, and finishing touches.
                    </p>
                </div>

                <div class="col-md-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bb-step-number">02</span>

                        <span class="bb-step-line flex-grow-1 d-none d-md-block" aria-hidden="true"></span>
                    </div>
                    <p class="bb-eyebrow mb-2">CONFIRM IT</p>
                    <h3 class="h5">We review the details</h3>
                    <p class="bb-hero-description mb-0">
                        We confirm availability and the final price with you.
                    </p>
                </div>

                <div class="col-md-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bb-step-number">03</span>


                    </div>
                    <p class="bb-eyebrow mb-2">CELEBRATE</p>
                    <h3 class="h5">Pick up your cake</h3>
                    <p class="bb-hero-description mb-0">
                        Collect your cake on your confirmed pickup date.
                    </p>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ url('/custom-order') }}"
                    class="bb-order-btn bb-how-button d-inline-flex align-items-center
               justify-content-center gap-2">
                    <x-cake-icon class="bb-order-cake" />
                    <span>Start Your Cake Request</span>
                </a>

                <p class="bb-request-note mt-3 mb-0">
                    Final price and pickup date confirmed after review.
                </p>
            </div>
        </div>
    </section>

    <x-faq-section :faqs="$faqs" />
</x-layout>
