<x-admin.layout>
    <a href="{{ route('admin.cakes.index') }}"
       class="bb-admin-site-link small text-decoration-none">
        ← Back to cakes
    </a>

    <p class="bb-eyebrow mt-4 mb-2">REFINE YOUR COLLECTION</p>
    <h1 class="h2 mb-4">Edit cake</h1>

    <div class="bb-admin-order p-4 p-md-5">
        @include('admin.cakes._form')
    </div>
</x-admin.layout>
