<x-admin.layout>
    <a href="{{ route('admin.faqs.index') }}"
       class="bb-admin-site-link small text-decoration-none">
        ← Back to FAQs
    </a>

    <p class="bb-eyebrow mt-4 mb-2">A LITTLE CLARITY</p>
    <h1 class="h2 mb-4">Add a question</h1>

    <div class="bb-admin-order p-4 p-md-5">
        @include('admin.faqs._form')
    </div>
</x-admin.layout>
