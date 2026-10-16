@props(['faqs'])

@if ($faqs->isNotEmpty())
    <section class="bb-faq py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <p class="bb-eyebrow mb-3">
                            A LITTLE HELP
                        </p>

                        <h2 class="display-6">
                            Before your sweet celebration.
                        </h2>
                    </div>

                    <div class="accordion bb-faq-list" id="cakeFaq">
                        @foreach ($faqs as $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faqAnswer-{{ $faq->id }}"
                                            aria-expanded="false"
                                            aria-controls="faqAnswer-{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h3>

                                <div id="faqAnswer-{{ $faq->id }}"
                                     class="accordion-collapse collapse"
                                     data-bs-parent="#cakeFaq">
                                    <div class="accordion-body bb-faq-answer">{{ $faq->answer }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif