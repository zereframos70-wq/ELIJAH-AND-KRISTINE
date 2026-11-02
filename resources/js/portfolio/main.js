export function initializePortfolioNavigation() {
    const menuButton = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.nav-links');
    const navigationLinks = document.querySelectorAll('.nav-link');
    const contactForm = document.querySelector('#contact-form');
    const formFeedback = document.querySelector('#form-feedback');

    if (!menuButton || !navigation || !contactForm || !formFeedback) {
        throw new Error(
            'The portfolio navigation or contact form could not be initialized.',
        );
    }

    const controller = new AbortController();

    menuButton.addEventListener(
        'click',
        () => {
            const isExpanded =
                menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', String(!isExpanded));
            menuButton.setAttribute(
                'aria-label',
                isExpanded ? 'Open navigation menu' : 'Close navigation menu',
            );
            navigation.classList.toggle('is-open', !isExpanded);
        },
        { signal: controller.signal },
    );

    navigationLinks.forEach((link) => {
        link.addEventListener(
            'click',
            () => {
                menuButton.setAttribute('aria-expanded', 'false');
                menuButton.setAttribute('aria-label', 'Open navigation menu');
                navigation.classList.remove('is-open');
            },
            { signal: controller.signal },
        );
    });

    const sections = document.querySelectorAll('main section[id]');
    const sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                navigationLinks.forEach((link) => {
                    link.classList.toggle(
                        'is-active',
                        link.getAttribute('href') === `#${entry.target.id}`,
                    );
                });
            });
        },
        { rootMargin: '-35% 0px -55% 0px' },
    );

    sections.forEach((section) => sectionObserver.observe(section));

    contactForm.addEventListener(
        'submit',
        (event) => {
            event.preventDefault();
            formFeedback.hidden = true;

            if (!contactForm.reportValidity()) {
                return;
            }

            formFeedback.textContent =
                'Thanks for reaching out! Your message passed validation. This demo form does not send it.';
            formFeedback.hidden = false;
            contactForm.reset();
        },
        { signal: controller.signal },
    );

    return () => {
        controller.abort();
        sectionObserver.disconnect();
    };
}
