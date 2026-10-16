<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bakery Admin | Butter & Bloom</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Nunito+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
</head>

<body>
    <header class="bb-admin-header py-3">
        <div class="container d-flex flex-wrap align-items-center
                    justify-content-between gap-3">

            <a href="{{ route('admin.dashboard') }}"
                class="d-inline-flex align-items-center gap-2
                      text-decoration-none bb-admin-brand">
                <x-cake-icon />

                <div>
                    <span class="d-block">Butter & Bloom</span>
                    <small class="bb-eyebrow">BAKERY ADMIN</small>
                </div>
            </a>

           <div class="d-flex flex-wrap align-items-center gap-2">
    <a href="{{ url('/') }}"
       class="bb-header-action bb-header-website
              d-inline-flex align-items-center justify-content-center
              gap-2 rounded-pill px-3 py-2 text-decoration-none">

        <svg width="17" height="17" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="1.5"
             stroke-linecap="round" stroke-linejoin="round"
             aria-hidden="true">
            <rect x="3" y="4" width="18" height="16" rx="3"/>
            <path d="M3 9h18M7 6.5h.01M10 6.5h.01"/>
        </svg>

        <span>View website</span>
    </a>

    <form action="{{ route('admin.logout') }}" method="POST"
          class="m-0">
        @csrf

        <button type="submit"
                class="bb-header-action bb-header-signout
                       d-inline-flex align-items-center justify-content-center
                       gap-2 rounded-pill px-3 py-2">

            <svg width="17" height="17" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.5"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <path d="M16 17l5-5-5-5M21 12H9"/>
            </svg>

            <span>Sign out</span>
        </button>
    </form>
</div>

        </div>
    </header>
    <nav class="container d-flex flex-wrap gap-2 pt-4" aria-label="Admin navigation">

        <a href="{{ route('admin.dashboard') }}"
            class="btn bb-request-filter rounded-pill px-4
              {{ request()->routeIs('admin.dashboard', 'admin.orders.*') ? 'is-active' : '' }}">
            Requests
        </a>

        <a href="{{ route('admin.cakes.index') }}"
            class="btn bb-request-filter rounded-pill px-4
              {{ request()->routeIs('admin.cakes.*') ? 'is-active' : '' }}">
            Cakes
        </a>
        <a href="{{ route('admin.flavours.index') }}"
            class="btn bb-request-filter rounded-pill px-4
          {{ request()->routeIs('admin.flavours.*') ? 'is-active' : '' }}">
            Flavours
        </a>

        <a href="{{ route('admin.unavailable-dates.index') }}"
            class="btn bb-request-filter rounded-pill px-4
          {{ request()->routeIs('admin.unavailable-dates.*') ? 'is-active' : '' }}">
            Unavailable dates
        </a>
        <a href="{{ route('admin.faqs.index') }}"
   class="btn bb-request-filter rounded-pill px-4
          {{ request()->routeIs('admin.faqs.*') ? 'is-active' : '' }}">
    FAQs
</a>
    </nav>

    <main class="container py-4 py-lg-5">
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.bb-delete-cake-form').forEach((form) => {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const result = await Swal.fire({
                    icon: 'warning',
                    iconColor: '#b58a36',
                    title: 'Delete this cake?',
                    text: `${form.dataset.cakeName} and its photo will be permanently deleted.`,
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Keep it',
                    background: '#fff8f0',
                    color: '#65483f',
                    buttonsStyling: false,
                    focusCancel: true,
                    customClass: {
                        popup: 'bb-admin-confirm',
                        confirmButton: 'btn bb-admin-delete rounded-pill px-4 py-2 m-1',
                        cancelButton: 'btn bb-admin-logout rounded-pill px-4 py-2 m-1'
                    }
                });

                if (result.isConfirmed) {
                    HTMLFormElement.prototype.submit.call(form);
                }
            });
        });
   
   
    document.querySelectorAll('.bb-delete-faq-form').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const result = await Swal.fire({
            icon: 'warning',
            iconColor: '#b58a36',
            title: 'Delete this question?',
            text: 'The question and its answer will be permanently deleted.',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Keep it',
            background: '#fff8f0',
            color: '#65483f',
            buttonsStyling: false,
            focusCancel: true,
            customClass: {
                popup: 'bb-admin-confirm',
                confirmButton: 'btn bb-admin-delete rounded-pill px-4 py-2 m-1',
                cancelButton: 'btn bb-admin-logout rounded-pill px-4 py-2 m-1'
            }
        });

        if (result.isConfirmed) {
            HTMLFormElement.prototype.submit.call(form);
        }
    });
});

document.querySelectorAll('.bb-delete-flavour-form').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const result = await Swal.fire({
            icon: 'warning',
            iconColor: '#b58a36',
            title: 'Delete this flavour?',
            text: `${form.dataset.flavourName} will be permanently deleted.`,
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Keep it',
            background: '#fff8f0',
            color: '#65483f',
            buttonsStyling: false,
            focusCancel: true,
            customClass: {
                popup: 'bb-admin-confirm',
                confirmButton: 'btn bb-admin-delete rounded-pill px-4 py-2 m-1',
                cancelButton: 'btn bb-admin-logout rounded-pill px-4 py-2 m-1'
            }
        });

        if (result.isConfirmed) {
            HTMLFormElement.prototype.submit.call(form);
        }
    });
});

document.querySelectorAll('.alert.bb-order-success').forEach((alert) => {
    setTimeout(() => {
        alert.remove();
    }, 4000);
});
</script>
</body>

</html>
