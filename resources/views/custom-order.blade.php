<x-layout>
    <div class="bb-custom-order-page">
       <section class="py-5">
    <div class="container">
        <div class="row align-items-center gx-4 gy-4">

            <div class="col-lg-6">
                <p class="bb-eyebrow mb-3">
                    MADE FOR YOUR MOMENT
                </p>

                <h1 class="display-4 mb-3">
                    Let’s create<br>
                    something lovely.
                </h1>

                <p class="bb-description fs-6 mb-0">
                    Share your cake idea with us.
                    We’ll review the details and confirm
                    availability and the final price with you.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="bb-order-image-frame p-2 p-md-3">
                <img src="{{ asset('assets/images/cake-pickup.png') }}"
                     alt="Pink strawberry cake packaged with a ribbon for pickup"
                     class="bb-order-hero-image img-fluid w-100">
            </div>
            </div>

        </div>
    </div>
</section>
        <section class="pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data"
                            class="bb-order-panel p-4 p-md-5">
                            <input type="hidden"
       name="cake_id"
       value="{{ old('cake_id', $selectedCake?->id) }}">

                            

@if ($errors->any())
    <div class="alert bb-order-errors mb-4" role="alert">
        <p class="fw-bold mb-2">
            Please check your request:
        </p>

        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span
                                    class="bb-form-step d-inline-flex align-items-center
                                    justify-content-center flex-shrink-0">
                                    01
                                </span>

                                <div>
                                    <p class="bb-eyebrow mb-1">YOUR DETAILS</p>
                                    <h2 class="h4 mb-0">Let’s get to know you.</h2>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="customerName" class="form-label">
                                        Your name
                                    </label>

                                    <input type="text" id="customerName" name="customer_name"
                                        class="form-control py-3" autocomplete="name" placeholder="Full name" value="{{ old('customer_name') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="customerPhone" class="form-label">
                                        Phone number
                                    </label>

                                    <input type="tel" id="customerPhone" name="phone" class="form-control py-3"
                                        autocomplete="tel" placeholder="Your contact number" value="{{ old('phone') }}" required>
                                </div>
                                <hr class="my-4">

                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <span
                                        class="bb-form-step d-inline-flex align-items-center
                                        justify-content-center flex-shrink-0">
                                        02
                                    </span>

                                    <div>
                                        <p class="bb-eyebrow mb-1">YOUR CAKE</p>
                                        <h2 class="h4 mb-0">Make it yours.</h2>
                                    </div>
                                </div>
                                @if ($selectedCake)
    <div class="bb-selected-cake d-flex align-items-center gap-3 p-3 mb-4">
        <img src="{{ asset('storage/' . $selectedCake->image) }}"
             alt="{{ $selectedCake->name }}"
             class="bb-selected-cake-photo flex-shrink-0">

        <div>
            <p class="bb-eyebrow mb-1">YOUR PICK</p>

            <h3 class="h5 mb-1">
                {{ $selectedCake->name }}
            </h3>

            <p class="small mb-0">
                Add your personal touches below.
            </p>
        </div>
    </div>
@endif

 <div class="row g-3">
 <div class="col-md-6">
  
    <fieldset>
        <legend class="fs-6 mb-2">Cake flavour</legend>

        <div class="d-flex flex-wrap gap-2">
            @foreach ($flavours as $flavour)
                <input type="radio"
                       class="btn-check"
                       name="flavour"
                       id="flavour-{{ $flavour->id }}"
                       value="{{ $flavour->name }}"
                       @checked(
                           old('flavour', $selectedCake?->flavour?->name)
                           === $flavour->name
                       )
                       required>

                <label for="flavour-{{ $flavour->id }}"
                       class="btn bb-flavour-choice rounded-pill px-3 py-2">
                    {{ $flavour->name }}
                </label>
            @endforeach
        </div>
    </fieldset>
</div>


                                    <div class="col-md-6">
                                        <label for="guestCount" class="form-label">
                                            Number of people
                                        </label>

                                        <input type="number" id="guestCount" name="guest_count"
                                            class="form-control py-3" min="1" step="1"
                                            placeholder="How many will be celebrating?" value="{{ old('guest_count') }}" required>
                                            <div class="form-text"> We’ll recommend the right cake size for your guest count.</div>
                                    </div>
                                    <div class="col-md-6">
    <label for="pickupDate" class="form-label">
        Preferred pickup date
    </label>

    <input type="date"
           id="pickupDate"
           name="pickup_date"
           class="form-control py-3"
           min="{{ today()->format('Y-m-d') }}"
           value="{{ old('pickup_date') }}"
           aria-describedby="pickupDateFeedback pickupDateHint"
           required>

    <div id="pickupDateFeedback"
         class="invalid-feedback"
         aria-live="polite">
    </div>

    <div id="pickupDateHint" class="form-text">
            Pickup is reserved after we confirm your request.
    </div>
</div>


                                    <div class="col-md-6">
                                        <label for="cakeMessage" class="form-label">
                                            Message on the cake <span class="small">(optional)</span>
                                        </label>

                                        <input type="text" id="cakeMessage" name="cake_message"
                                            class="form-control py-3" maxlength="60" value="{{ old('cake_message') }}"
                                            placeholder="Happy Birthday, Sara!">
                                    </div>
                                    <div class="col-12">
                                        <div class="bb-upload-box p-4 text-center">
                                            <h3 class="h5 mb-2">Share your inspiration</h3>

                                            <p class="small mb-3">
                                                Have a design in mind? Add a photo you love.
                                            </p>

                                            <label for="referenceImage"
                                                class="bb-upload-button d-inline-flex
                                                 align-items-center justify-content-center
                                                 gap-2 py-2 px-4 rounded-pill">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" aria-hidden="true">
                                                    <rect x="3" y="3" width="18" height="18" rx="4" />
                                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                                    <path d="m21 15-5-5L5 21" />
                                                </svg>

                                                <span>Choose a photo</span>
                                            </label>

                                            <input type="file" id="referenceImage" name="reference_image"
                                                class="bb-upload-input visually-hidden"
                                                accept="image/jpeg,image/png,image/webp"
                                                aria-describedby="referenceHint">

                                            <p id="referenceHint" class="small mt-3 mb-0">
                                                Optional · JPG, PNG or WebP
                                            </p>
                                            <div id="referencePreview" class="d-none mt-4">
                                                <img id="referencePreviewImage" class="bb-reference-preview img-fluid"
                                                    alt="Your selected cake inspiration">

                                                <p id="referenceFileName" class="small text-break mt-2 mb-0"></p>
                                                <button type="button" id="removeReference"
                                                    class="btn btn-sm rounded-pill px-3 py-2 mt-3 bb-remove-photo">
                                                    Remove photo
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="cakeNotes" class="form-label">
                                            Tell us about your idea <span class="small">(optional)</span>
                                        </label>

                                        <textarea id="cakeNotes" name="notes"
          class="form-control" rows="4" maxlength="1000"
          placeholder="Your occasion, favourite colours, or finishing touches…">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 text-center">
                                <button type="submit"
                                     class="bb-order-btn border-0 d-inline-flex
                                     align-items-center justify-content-center gap-2">
                                    <x-cake-icon class="bb-order-cake" />
                                    <span>Send My Cake Request</span>
                                </button>

                                <p class="small mt-3 mb-0">
                                    Your request is confirmed only after we review
                                    availability and agree on the final price.
                                </p>
                            </div>
                        </form>

                </div>
            </div>
    </div>
    </section>
    </div>
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'success',
                iconColor: '#c44775',
                title: 'Request received!',
                text: {{ Illuminate\Support\Js::from(session('success')) }},
                confirmButtonText: 'Lovely!',
                background: '#fff8f0',
                color: '#65483f',
                buttonsStyling: false,
                customClass: {
                    popup: 'bb-success-popup',
                    confirmButton: 'btn rounded-pill px-4 py-2 bb-success-confirm'
                }
            });
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const unavailableDates =
            {{ Illuminate\Support\Js::from($unavailableDates) }};

        const pickupInput = document.getElementById('pickupDate');
        const feedback = document.getElementById('pickupDateFeedback');

        if (!pickupInput || !feedback) return;

        function checkPickupDate() {
            const isUnavailable =
                unavailableDates.includes(pickupInput.value);

            const message = isUnavailable
                ? 'This date is unavailable. Please choose another day.'
                : '';

            pickupInput.setCustomValidity(message);
            pickupInput.classList.toggle('is-invalid', isUnavailable);
            pickupInput.setAttribute(
                'aria-invalid',
                String(isUnavailable)
            );

            feedback.textContent = message;
        }

        pickupInput.addEventListener('input', checkPickupDate);
        pickupInput.addEventListener('change', checkPickupDate);

        checkPickupDate();
    });
</script>
</x-layout>
