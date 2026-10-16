<x-admin.layout>
    <p class="bb-eyebrow mb-2">HELP YOUR CUSTOMERS</p>
    <div class="d-flex flex-wrap align-items-center
            justify-content-between gap-3 mb-4">
    <h1 class="h2 mb-0">Manage FAQs</h1>

    <a href="{{ route('admin.faqs.create') }}"
       class="btn bb-admin-logout rounded-pill px-4 py-2">
        + Add question
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
                        <th scope="col">Question</th>
                        <th scope="col">Order</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($faqs as $faq)
                        <tr>
                            <td>
                                <span class="fw-bold">
                                    {{ $faq->question }}
                                </span>

                                <small class="d-block mt-1 text-break">
                                    {{ \Illuminate\Support\Str::limit($faq->answer, 100) }}
                                </small>
                            </td>

                            <td>{{ $faq->sort_order }}</td>

                            <td>
                                <span class="badge rounded-pill
                                    {{ $faq->is_active
                                        ? 'bb-status-completed'
                                        : 'bb-status-cancelled' }}">
                                    {{ $faq->is_active ? 'Visible' : 'Hidden' }}
                                </span>
                            </td>
                            <td>
    <div class="d-flex flex-nowrap align-items-center gap-2">
        <a href="{{ route('admin.faqs.edit', $faq) }}"
           class="btn bb-admin-logout rounded-pill px-3 nowrap">
            Edit
        </a>

        <form action="{{ route('admin.faqs.destroy', $faq) }}"
              method="POST"
              class="bb-delete-faq-form nowrap">
            
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
                            <td colspan="3" class="text-center py-5">
                                <p class="fw-bold mb-1">No FAQs added yet.</p>
                                <p class="small mb-0">
                                    Add helpful answers for your customers.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($faqs->hasPages())
        <div class="mt-4">
            {{ $faqs->links('pagination::bootstrap-5') }}
        </div>
    @endif
</x-admin.layout>