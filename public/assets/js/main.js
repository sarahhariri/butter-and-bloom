const cards = document.querySelectorAll(".bb-cake-card");

if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.intersectionRatio >= 0.2) {
                entry.target.classList.add("is-visible");
            } else if (!entry.isIntersecting) {
                entry.target.classList.remove("is-visible");
            }
        });
    }, {
        threshold: [0, 0.2]
    });

    cards.forEach((card) => {
        card.classList.add("will-reveal");
        observer.observe(card);
    });
}

const layerStage = document.querySelector(".bb-layer-stage");

const reduceCakeMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
).matches;

if (layerStage && window.gsap && !reduceCakeMotion) {
    const layers = layerStage.querySelectorAll(".bb-cake-layer");
    const layerSection = layerStage.closest(".bb-layer-section");

    const directions = [-1, 1, -1, 1, 1];
    const verticalOffsets = [0, -8, 8, -8, 0];

    let cakeTimeline;
    let cakeContext;
    let resizeTimer;
    let previousWidth = window.innerWidth;

    function buildCakeAnimation() {
        const progress = cakeTimeline ? cakeTimeline.progress() : 0;

        const wasPlaying = cakeTimeline
            ? !cakeTimeline.paused() && progress < 1
            : false;

        // Restore CSS positions before measuring again.
        if (cakeContext) {
            cakeContext.revert();
        }

        cakeContext = gsap.context(() => {
            cakeTimeline = gsap.timeline({
    paused: true,
    onComplete: () => {
        layerStage.classList.add("is-decorated");
    }
});

            layers.forEach((layer, index) => {
                const transform = getComputedStyle(layer).transform;

                const finalY = transform === "none"
                    ? 0
                    : new DOMMatrixReadOnly(transform).m42;

                const distance = layerStage.clientWidth * 0.22;

                cakeTimeline.fromTo(
                    layer,
                    {
                        x: directions[index] * distance,
                        y: finalY + verticalOffsets[index],
                        rotation: directions[index] * 4,
                        scale: 0.96
                    },
                    {
                        x: 0,
                        y: finalY,
                        rotation: 0,
                        scale: 1,
                        duration: 1.3,
                        ease: "power2.inOut"
                    },
                    index * 0.18
                );
            });

            cakeTimeline.progress(progress);

            if (wasPlaying) {
                cakeTimeline.play();
            }
        }, layerStage);
    }

    buildCakeAnimation();

    

    const cakeObserver = new IntersectionObserver((entries) => {
        
        entries.forEach((entry) => {
            if (entry.intersectionRatio >= 0.35) {
                cakeTimeline.play();
            } else if (!entry.isIntersecting) {
                cakeTimeline.pause(0);
                layerStage.classList.remove("is-decorated");
            }
        });
    }, {
        threshold: [0, 0.35],
        rootMargin: "-120px 0px -10% 0px"
    });

    cakeObserver.observe(layerSection);

    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);

        resizeTimer = setTimeout(() => {
            if (window.innerWidth !== previousWidth) {
                previousWidth = window.innerWidth;
                buildCakeAnimation();
            }
        }, 150);
    });

    const cakeGroup = document.querySelector(".bb-cake-group");

if (cakeGroup && window.gsap) {
    const cakeArea = cakeGroup.closest(".bb-layer-stage");

    const canTilt = window.matchMedia(
        "(hover: hover) and (pointer: fine) and (prefers-reduced-motion: no-preference)"
    );

    cakeArea.addEventListener("pointermove", (event) => {
        if (!canTilt.matches ||
            !cakeArea.classList.contains("is-decorated")) {
            return;
        }

        const bounds = cakeArea.getBoundingClientRect();

        const x = (event.clientX - bounds.left) / bounds.width - 0.5;
        const y = (event.clientY - bounds.top) / bounds.height - 0.5;

        gsap.to(cakeGroup, {
            rotationY: x * 12,
            rotationX: -y * 8,
            duration: 0.5,
            ease: "power2.out",
            overwrite: "auto"
        });
    });

    cakeArea.addEventListener("pointerleave", () => {
        gsap.to(cakeGroup, {
            rotationX: 0,
            rotationY: 0,
            duration: 0.7,
            ease: "power2.out",
            overwrite: "auto"
        });
    });
}
}

const storySection = document.querySelector(".bb-story-section");

const reduceStoryMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
).matches;

if (storySection && window.gsap && !reduceStoryMotion) {
    const storyPhoto = storySection.querySelector(".bb-story-photo");
    const storyCopy = storySection.querySelector(".bb-story-copy");

    const storyTimeline = gsap.timeline({
        paused: true
    });

    storyTimeline
        .fromTo(
            storyPhoto,
            { x: 40, opacity: 0 },
            {
                x: 0,
                opacity: 1,
                duration: 1.1,
                ease: "power2.out"
            }
        )
        .fromTo(
            storyCopy,
            { x: -40, opacity: 0 },
            {
                x: 0,
                opacity: 1,
                duration: 1.1,
                ease: "power2.out"
            },
            0.12
        );

   const storyObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            storyTimeline.play();
        } else {
            storyTimeline.pause(0);
        }
    });
}, {
    threshold: 0,
    rootMargin: "-120px 0px -45% 0px"
});

storyObserver.observe(storySection);
}

const referenceInput = document.getElementById("referenceImage");
const referencePreview = document.getElementById("referencePreview");
const referencePhoto = document.getElementById("referencePreviewImage");
const referenceFileName = document.getElementById("referenceFileName");

if (referenceInput && referencePreview && referencePhoto && referenceFileName) {
    let previewUrl;

    referenceInput.addEventListener("change", () => {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
            
        }

        referencePhoto.removeAttribute("src");
        referenceFileName.textContent = "";
        referencePreview.classList.add("d-none");

        const file = referenceInput.files[0];

        if (!file) return;

        const allowedTypes = ["image/jpeg", "image/png", "image/webp"];

        if (!allowedTypes.includes(file.type)) {
            referenceInput.value = "";
            return;
        }

        previewUrl = URL.createObjectURL(file);
        referencePhoto.src = previewUrl;
        referenceFileName.textContent = file.name;
        referencePreview.classList.remove("d-none");
    });
    const removeReference = document.getElementById("removeReference");

removeReference?.addEventListener("click", () => {
    referenceInput.value = "";

    if (previewUrl) {
        URL.revokeObjectURL(previewUrl);
        previewUrl = null;
    }

    referencePhoto.removeAttribute("src");
    referenceFileName.textContent = "";
    referencePreview.classList.add("d-none");
    const uploadBox = referenceInput.closest(".bb-upload-box");

if (uploadBox) {
    const header = document.querySelector(".bb-header");
    const headerHeight = header?.getBoundingClientRect().height || 0;

    const top = uploadBox.getBoundingClientRect().top
        + window.scrollY
        - headerHeight
        - 20;

    window.scrollTo({
        top: Math.max(0, top),
        behavior: window.matchMedia("(prefers-reduced-motion: reduce)").matches
            ? "instant"
            : "smooth"
    });
}

referenceInput.focus({ preventScroll: true });
});
}

const orderPanel = document.querySelector(".bb-order-panel");

if (
    orderPanel &&
    !window.matchMedia("(prefers-reduced-motion: reduce)").matches
) {
    const orderPanelObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                orderPanelObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0,
        rootMargin: "0px 0px -100px 0px"
    });

    orderPanel.classList.add("will-reveal");
    orderPanelObserver.observe(orderPanel);
}