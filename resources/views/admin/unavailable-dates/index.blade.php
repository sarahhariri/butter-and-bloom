<x-admin.layout>
    <p class="bb-eyebrow mb-2">PLAN YOUR BAKING DAYS</p>
    <h1 class="h2 mb-4">Unavailable dates</h1>

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

    <div class="row g-4 align-items-start">
        <div class="col-lg-5">
            <section class="bb-admin-order p-4">
                <h2 class="h5 mb-3">Block a pickup date</h2>

                <form action="{{ route('admin.unavailable-dates.store') }}"
                      method="POST">
                    

                    <div class="mb-3">
                        <label for="unavailableDate" class="form-label">
                            Date
                        </label>

                        <input type="date"
                               id="unavailableDate"
                               name="date"
                               class="form-control py-3"
                               min="{{ today()->format('Y-m-d') }}"
                               value="{{ old('date') }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="dateNote" class="form-label">
                            Internal note (optional)
                        </label>

                        <input type="text"
                               id="dateNote"
                               name="note"
                               class="form-control py-3"
                               value="{{ old('note') }}"
                               maxlength="255"
                               placeholder="Fully booked, day off…">
                    </div>

                    <button type="submit"
                            class="btn bb-admin-logout rounded-pill w-100 py-3">
                        Block date
                    </button>

                    <p class="small mt-3 mb-0">
                        Internal notes are visible only to you.
                        Blocking a date does not cancel existing requests.
                    </p>
                </form>
            </section>
        </div>

        <div class="col-lg-7">
            <section class="bb-admin-order p-4">
                <h2 class="h5 mb-3">Blocked dates</h2>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Internal note</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($dates as $date)
                                <tr>
                                    <td class="text-nowrap">
                                        {{ $date->date->format('d M Y') }}
                                    </td>
                                    <td class="text-break">
                                        {{ $date->note ?: '—' }}
                                    </td>
                                    <td class="text-end">
    <form action="{{ route('admin.unavailable-dates.destroy', $date) }}"
          method="POST">
       
        @method('DELETE')

        <button type="submit"
                class="btn bb-admin-logout rounded-pill px-3">
            Unblock
        </button>
    </form>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        No blocked dates yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($dates->hasPages())
                    <div class="mt-4">
                        {{ $dates->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-admin.layout>