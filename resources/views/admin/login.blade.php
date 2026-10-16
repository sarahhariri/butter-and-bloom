<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Owner Login | Butter & Bloom</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Nunito+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet">
</head>

<body>
   <main class="container min-vh-100 d-flex align-items-center py-4 py-lg-5">
    <div class="row align-items-center justify-content-center
                gx-lg-5 gy-4 w-100 mx-0">

        <div class="col-lg-6 d-none d-lg-block">
            <div class="position-relative">
                <img src="{{ asset('assets/images/baking-story.png') }}"
                     alt="Decorating a cake with pink buttercream"
                     class="bb-admin-story img-fluid w-100">

                <div class="bb-admin-photo-note position-absolute
                            bottom-0 start-0 m-4 p-4">
                    <p class="bb-eyebrow mb-2">BEHIND THE BUTTERCREAM</p>
                    <h2 class="h3 mb-0">
                        A little care.<br>
                        In every detail.
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-sm-10 col-md-8 col-lg-5">
            <div class="bb-admin-login p-4 p-md-5">
                    <div class="text-center mb-4">
                        <x-cake-icon class="mx-auto mb-3" />

                        <p class="bb-eyebrow mb-2">BUTTER & BLOOM</p>
                        <h1 class="h2 mb-2">Welcome back.</h1>
                        <p class="small mb-0">
                            Your little bakery, behind the scenes.
                        </p>
                    </div>

                    <form action="{{ route('admin.login.store') }}" method="POST">
                        

                        <label for="adminPassword" class="form-label">
                            Password
                        </label>

                        <input type="password" id="adminPassword" name="password"
                            class="form-control py-3 @error('password') is-invalid @enderror"
                            autocomplete="current-password"
                            aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                            @error('password') aria-describedby="passwordError" @enderror required>

                        @error('password')
                            <div class="bb-login-error small mt-3 px-3 py-2" id="passwordError" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit"
                              class="bb-admin-signin d-flex align-items-center
                                justify-content-center gap-2 w-100
                                rounded-pill py-3 px-4 mt-4 fw-bold">
                             <span>Sign in</span>

                             <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="5" y="10" width="14" height="11" rx="3" />
                                <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                             </svg>
                        </button>
                      </form>

                      <div class="text-center mt-4">
                        <a href="{{ url('/') }}"
                            class="bb-admin-back d-inline-flex align-items-center
                            gap-2 text-decoration-none small py-2 px-3 rounded-pill">
                            <span aria-hidden="true">←</span>
                            <span>Back to website</span>
                        </a>
                    </div>
                </div>
        </div>

    </div>
</main>
</body>

</html>
