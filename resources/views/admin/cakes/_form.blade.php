  <form action="{{ isset($cake)
        ? route('admin.cakes.update', $cake)
        : route('admin.cakes.store') }}"
      method="POST"
      enctype="multipart/form-data">
    

    @isset($cake)
        @method('PUT')
    @endisset

    @if ($errors->any())
        <div class="alert bb-order-errors" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6">
            <label for="cakeName" class="form-label">
                Cake name
            </label>

            <input type="text" id="cakeName" name="name"
                   class="form-control py-3"
                   value="{{ old('name', $cake->name ?? '') }}"
                   placeholder="Strawberry Bloom"
                   maxlength="100" required>
        </div>

        <div class="col-md-6">
            <label for="cakeTagline" class="form-label">
                Short tagline
            </label>

            <input type="text" id="cakeTagline" name="tagline"
                   class="form-control py-3"
                   value="{{ old('tagline', $cake->tagline ?? '') }}"
                   placeholder="Fresh & Fruity"
                   maxlength="100" required>
        </div>
        <div class="col-12">
    <label for="cakeFlavour" class="form-label">
        Cake flavour
    </label>

    <select id="cakeFlavour" name="flavour_id"
            class="form-select py-3" required>

        <option value="" disabled
                @selected(!old('flavour_id', $cake->flavour_id ?? null))>
            Choose a flavour
        </option>

        @foreach ($flavours as $flavour)
            <option value="{{ $flavour->id }}"
                    @selected(
                        (string) old('flavour_id', $cake->flavour_id ?? '')
                        === (string) $flavour->id
                    )>
                {{ $flavour->name }}{{ $flavour->is_active ? '' : ' — Hidden' }}
            </option>
        @endforeach
    </select>
</div>

        <div class="col-12">
            <label for="cakeDescription" class="form-label">
                Description
            </label>

           <textarea id="cakeDescription" name="description"
          class="form-control p-3"
          rows="3" maxlength="1000"
          placeholder="Describe your cake"
          required>{{ old('description', $cake->description ?? '') }}</textarea>
        </div>

        <div class="col-md-8">
            <label for="cakeImage" class="form-label">
                Cake photo
            </label>
<input type="file" id="cakeImage" name="image"
       class="form-control py-3"
       accept="image/jpeg,image/png,image/webp"
       @required(!isset($cake))>

@isset($cake)
    <img src="{{ asset('storage/' . $cake->image) }}"
         alt="{{ $cake->name }}"
         class="bb-admin-cake-thumb d-block mt-3">

    <p class="small mt-2 mb-0">
        Leave empty to keep the current photo.
    </p>
@endisset
        </div>

        <div class="col-md-4">
            <label for="cakeSortOrder" class="form-label">
                Display order
            </label>

            <input type="number" id="cakeSortOrder" name="sort_order"
                   class="form-control py-3"
                   value="{{ old('sort_order', $cake->sort_order ?? 0) }}"
                   min="0" step="1" required>

            <p class="small mt-2 mb-0">
                Lower numbers appear first.
            </p>
        </div>
    </div>
    <div class="row g-3 mt-3">
    <div class="col-md-6">
        <div class="form-check form-switch">
            <input type="hidden" name="is_active" value="0">

            <input type="checkbox"
                   id="cakeActive"
                   name="is_active"
                   value="1"
                   class="form-check-input"
                   role="switch"
                  @checked(old('is_active', $cake->is_active ?? true))>

            <label for="cakeActive" class="form-check-label">
                Show in the collection
            </label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-check form-switch">
            <input type="hidden" name="is_featured" value="0">

            <input type="checkbox"
                   id="cakeFeatured"
                   name="is_featured"
                   value="1"
                   class="form-check-input"
                   role="switch"
                   @checked(old('is_featured', $cake->is_featured ?? false))>

            <label for="cakeFeatured" class="form-check-label">
                Feature on the home page
            </label>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap gap-2 mt-4 pt-3">
    <button type="submit"
            class="btn bb-admin-logout rounded-pill px-4 py-3">
        {{ isset($cake) ? 'Save changes' : 'Save cake' }}
    </button>

    <a href="{{ route('admin.cakes.index') }}"
       class="btn bb-request-filter rounded-pill px-4 py-3">
        Cancel
    </a>
</div>
</form>