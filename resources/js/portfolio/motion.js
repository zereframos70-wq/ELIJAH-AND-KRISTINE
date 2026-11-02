export function initializePortfolioMotion() {
    const root = document.documentElement;
    const prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)',
    ).matches;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        return () => {};
    }

    const targets = [];

    function markForReveal(element, index, stagger) {
        if (element.hasAttribute('data-reveal')) {
            return;
        }

        element.setAttribute('data-reveal', '');
        element.style.setProperty('--motion-delay', `${index * stagger}ms`);
        targets.push(element);
    }

    document
        .querySelectorAll('main section:not(#home) > div')
        .forEach((wrapper) => {
            Array.from(wrapper.children).forEach((child, index) => {
                markForReveal(child, index, 90);
            });
        });

    document
        .querySelectorAll('#skills article, #projects article')
        .forEach((item, index) => {
            markForReveal(item, index, 70);
        });

    document.querySelectorAll('#journey article').forEach((item, index) => {
        markForReveal(item, index, 100);
    });

    const footer = document.querySelector('footer > div');

    if (footer) {
        markForReveal(footer, 0, 0);
    }

    const visibleTargets = new Set();
    targets.forEach((target) => {
        const bounds = target.getBoundingClientRect();

        if (bounds.top < window.innerHeight && bounds.bottom > 0) {
            target.classList.add('in');
            visibleTargets.add(target);
        }
    });

    const observer = new IntersectionObserver(
        (entries, currentObserver) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('in');
                currentObserver.unobserve(entry.target);
            });
        },
        {
            threshold: 0.12,
            rootMargin: '0px 0px -6% 0px',
        },
    );

    root.classList.add('mo');
    targets.forEach((target) => {
        if (!visibleTargets.has(target)) {
            observer.observe(target);
        }
    });

    const progress = document.createElement('div');
    progress.className = 'motion-progress';
    progress.setAttribute('aria-hidden', 'true');
    document.body.appendChild(progress);

    let updatePending = false;
    function updateProgress() {
        const scrollableHeight = root.scrollHeight - window.innerHeight;
        const progressRatio =
            scrollableHeight > 0
                ? Math.min(window.scrollY / scrollableHeight, 1)
                : 0;

        progress.style.transform = `scaleX(${progressRatio})`;
        updatePending = false;
    }

    function scheduleProgressUpdate() {
        if (updatePending) {
            return;
        }

        updatePending = true;
        window.requestAnimationFrame(updateProgress);
    }

    const controller = new AbortController();
    window.addEventListener('scroll', scheduleProgressUpdate, {
        passive: true,
        signal: controller.signal,
    });
    window.addEventListener('resize', scheduleProgressUpdate, {
        passive: true,
        signal: controller.signal,
    });
    updateProgress();

    return () => {
        controller.abort();
        observer.disconnect();
        root.classList.remove('mo');
        progress.remove();
        targets.forEach((target) => {
            target.removeAttribute('data-reveal');
            target.classList.remove('in');
            target.style.removeProperty('--motion-delay');
        });
    };
}
