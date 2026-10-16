<x-admin.layout>
    <a href="{{ route('admin.flavours.index') }}"
       class="bb-admin-site-link small text-decoration-none">
        ← Back to flavours
    </a>

    <p class="bb-eyebrow mt-4 mb-2">REFINE YOUR FLAVOURS</p>
    <h1 class="h2 mb-4">Edit flavour</h1>

    <div class="row">
        <div class="col-lg-7">
            <section class="bb-admin-order p-4 p-md-5">
                @if ($errors->any())
                    <div class="alert bb-order-errors" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.flavours.update', $flavour) }}"
                      method="POST">
                  
                    @method('PUT')

                    <div class="mb-3">
                        <label for="flavourName" class="form-label">
                            Flavour name
                        </label>

                        <input type="text" id="flavourName" name="name"
                               class="form-control py-3"
                               value="{{ old('name', $flavour->name) }}"
                               maxlength="100" required>
                    </div>

                    <div class="mb-4">
                        <label for="flavourOrder" class="form-label">
                            Display order
                        </label>

                        <input type="number" id="flavourOrder"
                               name="sort_order"
                               class="form-control py-3"
                               value="{{ old('sort_order', $flavour->sort_order) }}"
                               min="0" max="100000" step="1" required>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input type="hidden" name="is_active" value="0">

                        <input type="checkbox"
                               id="flavourActive"
                               name="is_active"
                               value="1"
                               class="form-check-input"
                               role="switch"
                               @checked(old('is_active', $flavour->is_active))>

                        <label for="flavourActive" class="form-check-label">
                            Available to customers
                        </label>
                    </div>

                    <p class="small mb-4">
                        Hidden flavours cannot be selected in new requests.
                        Existing orders remain unchanged.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit"
                                class="btn bb-admin-logout rounded-pill px-4 py-3">
                            Save changes
                        </button>

                        <a href="{{ route('admin.flavours.index') }}"
                           class="btn bb-request-filter rounded-pill px-4 py-3">
                            Cancel
                        </a>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-admin.layout>
