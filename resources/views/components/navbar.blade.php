<header class="bb-header sticky-top">
    <nav class="navbar navbar-expand-lg bb-navbar">
        <div class="container-fluid px-3 px-md-4">

            <a class="navbar-brand bb-brand m-0" href="{{ url('/') }}">
                <span class="bb-brand-flower" aria-hidden="true"><x-cake-icon /></span>
                <span class="bb-brand-text">
                    <span>Butter & Bloom</span>
                    <small>HOMEMADE HAPPINESS</small>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"
                aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mobileMenu">
                <div class="navbar-nav ms-auto align-items-lg-center gap-3 gap-lg-4 pt-3 pt-lg-0">
                    <a class="bb-nav-link {{ request()->is('/') ? 'is-active' : '' }}" href="{{ url('/') }}"
                        @if (request()->is('/')) aria-current="page" @endif>
                        Home
                    </a>

                    <a class="bb-nav-link {{ request()->routeIs('cakes.index') ? 'is-active' : '' }}"
                        href="{{ route('cakes.index') }}" @if (request()->routeIs('cakes.index')) aria-current="page" @endif>
                        Cake Collection
                    </a>

                    <a class="bb-order-btn align-self-start" href="{{ url('/custom-order') }}">
                        Create Your Cake <span aria-hidden="true">↗</span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
</header>
