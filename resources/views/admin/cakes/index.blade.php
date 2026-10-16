<x-admin.layout>
    <p class="bb-eyebrow mb-2">YOUR CAKE COLLECTION</p>
    <div class="d-flex flex-wrap align-items-center
            justify-content-between gap-3 mb-4">
    <h1 class="h2 mb-0">Manage cakes</h1>

    <a href="{{ route('admin.cakes.create') }}"
       class="btn bb-admin-logout rounded-pill px-4 py-2">
        + Add cake
    </a>
</div>
@if (session('success'))
    <div class="alert bb-order-success" role="status">
        {{ session('success') }}
    </div>
@endif
    <div class="bb-admin-order p-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col">Cake</th>
                        <th scope="col">Flavour</th>
                        <th scope="col">Order</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($cakes as $cake)
                        <tr>
                           <td>
    <div class="d-flex align-items-center gap-3">
        <img src="{{ asset('storage/' . $cake->image) }}"
             alt="{{ $cake->name }}"
             class="bb-admin-cake-thumb flex-shrink-0"
             loading="lazy">

        <div>
            <span class="fw-bold">{{ $cake->name }}</span>
            <small class="d-block">{{ $cake->tagline }}</small>
        </div>
    </div>
</td>
<td>
    {{ $cake->flavour?->name ?? 'Not assigned' }}
</td>

                            <td>{{ $cake->sort_order }}</td>

                            <td>
                                <span class="badge rounded-pill
                                    {{ $cake->is_active ? 'bb-status-completed' : 'bb-status-cancelled' }}">
                                    {{ $cake->is_active ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>

                            <td>{{ $cake->is_featured ? 'Yes' : 'No' }}</td>

                  <td>
    <div class="d-flex flex-nowrap align-items-center gap-2">
        <a href="{{ route('admin.cakes.edit', $cake) }}"
           class="btn bb-admin-logout rounded-pill px-3 nowrap">
            Edit
        </a>

       <form action="{{ route('admin.cakes.destroy', $cake) }}"
      method="POST"
      class="bb-delete-cake-form nowrap"
      data-cake-name="{{ $cake->name }}">
    
    @method('DELETE')

    <button type="submit"
            class="btn bb-admin-delete rounded-pill px-3">
        Delete
    </button>
</form>
    </div>
</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <p class="fw-bold mb-1">No cakes added yet.</p>
                                <p class="small mb-0">
                                    Your collection will appear here.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($cakes->hasPages())
        <div class="mt-4">
            {{ $cakes->links('pagination::bootstrap-5') }}
        </div>
    @endif
</x-admin.layout>