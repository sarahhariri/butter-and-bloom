<form action="{{ isset($faq)
        ? route('admin.faqs.update', $faq)
        : route('admin.faqs.store') }}"
      method="POST">
    

    @isset($faq)
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
        <div class="col-12">
            <label for="faqQuestion" class="form-label">
                Question
            </label>

            <input type="text"
                   id="faqQuestion"
                   name="question"
                   class="form-control py-3"
                   value="{{ old('question', $faq->question ?? '') }}"
                   placeholder="How is my custom cake priced?"
                   maxlength="255" required>
        </div>

        <div class="col-12">
            <label for="faqAnswer" class="form-label">
                Answer
            </label>

            <textarea id="faqAnswer"
                      name="answer"
                      class="form-control p-3"
                      rows="5"
                      maxlength="3000"
                      placeholder="Write a clear, helpful answer…"
                      required>{{ old('answer', $faq->answer ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label for="faqOrder" class="form-label">
                Display order
            </label>

            <input type="number"
                   id="faqOrder"
                   name="sort_order"
                   class="form-control py-3"
                   value="{{ old('sort_order', $faq->sort_order ?? 0) }}"
                   min="0" max="100000" step="1" required>
        </div>

        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check form-switch">
                <input type="hidden" name="is_active" value="0">

                <input type="checkbox"
                       id="faqActive"
                       name="is_active"
                       value="1"
                       class="form-check-input"
                       role="switch"
                       @checked(old('is_active', $faq->is_active ?? true))>

                <label for="faqActive" class="form-check-label">
                    Show on the website
                </label>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 mt-4 pt-3">
        <button type="submit"
                class="btn bb-admin-logout rounded-pill px-4 py-3">
            {{ isset($faq) ? 'Save changes' : 'Add question' }}
        </button>

        <a href="{{ route('admin.faqs.index') }}"
           class="btn bb-request-filter rounded-pill px-4 py-3">
            Cancel
        </a>
    </div>
</form>