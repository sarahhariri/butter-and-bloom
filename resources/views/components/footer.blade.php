<footer class="bb-footer py-5">
    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-6">
                <a
                    href="{{ url('/') }}"
                    class="bb-brand d-inline-flex align-items-center
                           gap-2 m-0 text-decoration-none"
                >
                    <x-cake-icon />
                    <span>Butter & Bloom</span>
                </a>

                <p class="bb-hero-description mt-3 mb-0">
                    Homemade cakes, personal touches,<br>
                    and lovely reasons to celebrate.
                </p>
                              <a href="{{ route('admin.login') }}"
   class="bb-owner-login d-inline-flex align-items-center
          gap-2 rounded-pill px-3 py-2 mt-3
          small fw-semibold text-decoration-none">

    <svg width="15" height="15" viewBox="0 0 24 24"
         fill="none" stroke="currentColor" stroke-width="1.5"
         stroke-linecap="round" stroke-linejoin="round"
         aria-hidden="true">
        <rect x="5" y="10" width="14" height="11" rx="3"/>
        <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
    </svg>

    <span>Owner sign in</span>
</a>
            </div>

            <div class="col-6 col-lg-3">
                <h2 class="bb-eyebrow mb-3">EXPLORE</h2>

                <nav
                    class="d-flex flex-column align-items-start gap-2"
                    aria-label="Footer navigation"
                >
                    <a class="bb-nav-link" href="{{ url('/') }}">
                        Home
                    </a>

                    <a class="bb-nav-link" href="{{ url('/cakes') }}">
                        Cake Collection
                    </a>

                    <a class="bb-nav-link" href="{{ url('/custom-order') }}">
                        Custom Order
                    </a>
      
                </nav>
            </div>

            <div class="col-6 col-lg-3">
                <h2 class="bb-eyebrow mb-3">A LITTLE NOTE</h2>

                <p class="small mb-2">Pickup only.</p>

                <p class="small mb-0">
                    Every order is reviewed and confirmed personally.
                </p>
            </div>

        </div>

        <div class="bb-footer-bottom mt-4 pt-3">
            <p class="small text-center mb-0">
                &copy; {{ now()->year }} Butter & Bloom
            </p>
        </div>
    </div>
</footer>