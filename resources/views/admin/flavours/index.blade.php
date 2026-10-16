<x-admin.layout>
    <p class="bb-eyebrow mb-2">A LITTLE TASTE OF YOUR BAKERY</p>
    <h1 class="h2 mb-4">Manage flavours</h1>

    @if (session('success'))
        <div class="alert bb-order-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert bb-order-errors" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@if (session('error'))
    <div class="alert bb-order-errors" role="alert">
        {{ session('error') }}
    </div>
@endif
    <div class="row g-4 align-items-start">
        <div class="col-lg-5">
            <section class="bb-admin-order p-4">
                <h2 class="h5 mb-4">Add a flavour</h2>

                <form action="{{ route('admin.flavours.store') }}"
                      method="POST">
                    

                    <div class="mb-3">
                        <label for="flavourName" class="form-label">
                            Flavour name
                        </label>

                        <input type="text"
                               id="flavourName"
                               name="name"
                               class="form-control py-3"
                               value="{{ old('name') }}"
                               placeholder="Chocolate"
                               maxlength="100" required>
                    </div>

                    <div class="mb-4">
                        <label for="flavourOrder" class="form-label">
                            Display order
                        </label>

                        <input type="number"
                               id="flavourOrder"
                               name="sort_order"
                               class="form-control py-3"
                               value="{{ old('sort_order', 0) }}"
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
                               @checked(old('is_active', 1))>

                        <label for="flavourActive" class="form-check-label">
                            Available to customers
                        </label>
                    </div>

                    <button type="submit"
                            class="btn bb-admin-logout rounded-pill w-100 py-3">
                        Add flavour
                    </button>
                </form>
            </section>
        </div>

        <div class="col-lg-7">
            <section class="bb-admin-order p-4">
                <h2 class="h5 mb-3">Your flavours</h2>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Flavour</th>
                                <th scope="col">Order</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($flavours as $flavour)
                                <tr>
                                    <td>{{ $flavour->name }}</td>
                                    <td>{{ $flavour->sort_order }}</td>
                                    <td>
                                        <span class="badge rounded-pill
                                            {{ $flavour->is_active
                                                ? 'bb-status-completed'
                                                : 'bb-status-cancelled' }}">
                                            {{ $flavour->is_active
                                                ? 'Available'
                                                : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td>
    <div class="d-flex flex-nowrap align-items-center gap-2">
        <a href="{{ route('admin.flavours.edit', $flavour) }}"
           class="btn bb-admin-logout rounded-pill px-3 nowrap">
            Edit
        </a>

        <form action="{{ route('admin.flavours.destroy', $flavour) }}"
              method="POST"
              class="bb-delete-flavour-form"
              data-flavour-name="{{ $flavour->name }}">
            
            @method('DELETE')

            <button type="submit"
                    class="btn bb-admin-delete rounded-pill px-3 nowrap">
                Delete
            </button>
        </form>
    </div>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        No flavours added yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($flavours->hasPages())
                    <div class="mt-4">
                        {{ $flavours->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-admin.layout>