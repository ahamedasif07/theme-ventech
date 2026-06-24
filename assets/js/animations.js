/**
 * Ventech Grilles — GSAP Animations Script
 * 
 * Controls initial page loads, banner animations, 
 * scroll reveals, and grid item transitions.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Check if gsap and ScrollTrigger are available
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger is not loaded.');
        return;
    }

    // Register ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    // ==========================================
    // 1. SITE HEADER & LOGO ANIMATION (ON LOAD)
    // ==========================================
    gsap.from('.site-header', {
        y: -60,
        opacity: 0,
        duration: 1,
        ease: 'power3.out'
    });

    gsap.from('.site-logo, .nav-links a, .nav-icons a, .nav-hamburger', {
        opacity: 0,
        scale: 0.95,
        duration: 0.8,
        delay: 0.3,
        stagger: 0.05,
        ease: 'power2.out'
    });

    // ==========================================
    // 2. HERO SECTION ANIMATION (ON LOAD)
    // ==========================================
    const hero = document.querySelector('.hero');
    if (hero) {
        const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });
        
        // Parallax effect on hero background on scroll
        gsap.to('.hero__bg', {
            yPercent: 20,
            ease: 'none',
            scrollTrigger: {
                trigger: '.hero',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });

        heroTl.from('.hero__bg', {
            scale: 1.15,
            duration: 2,
            ease: 'power2.out'
        })
        .from('.hero__eyebrow', {
            opacity: 0,
            y: 25,
            duration: 0.7
        }, '-=1.4')
        .from('.hero__heading', {
            opacity: 0,
            y: 35,
            duration: 0.8
        }, '-=1.1')
        .from('.hero__desc', {
            opacity: 0,
            y: 25,
            duration: 0.7
        }, '-=0.8')
        .from('.hero__ctas .btn', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            stagger: 0.12
        }, '-=0.6');
    }

    // ==========================================
    // 3. INNER PAGE BANNER ANIMATION
    // ==========================================
    const banner = document.querySelector('.page-banner');
    if (banner) {
        const bannerTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        // Subtle background image scale/parallax
        gsap.to('.page-banner__bg', {
            yPercent: 15,
            ease: 'none',
            scrollTrigger: {
                trigger: '.page-banner',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });

        bannerTl.from('.page-banner__bg', {
            scale: 1.15,
            duration: 1.8,
            ease: 'power2.out'
        })
        .from('.page-banner__eyebrow', {
            opacity: 0,
            y: 20,
            duration: 0.6
        }, '-=1.3')
        .from('.page-banner__title', {
            opacity: 0,
            y: 30,
            duration: 0.7
        }, '-=1.0');
    }

    // ==========================================
    // 4. WELCOME SECTION REVEAL
    // ==========================================
    const welcome = document.querySelector('.section-welcome');
    if (welcome) {
        gsap.from('.section-welcome__inner h2, .section-welcome__inner p, .section-welcome__inner a', {
            opacity: 0,
            y: 30,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: welcome,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    }

    // ==========================================
    // 5. STAGGER REVEAL FOR GRIDS
    // ==========================================
    const grids = ['.products-grid-home', '.regions-grid', '.why-us-grid', '.projects-grid', '.office-info-grid'];
    grids.forEach(gridSelector => {
        const grid = document.querySelector(gridSelector);
        if (grid) {
            const children = Array.from(grid.children);
            
            // Set initial state via gsap to avoid layout jumps
            gsap.set(children, { opacity: 0, y: 40 });

            ScrollTrigger.batch(children, {
                start: 'top 85%',
                onEnter: batch => gsap.to(batch, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: 'power3.out',
                    overwrite: true
                })
            });
        }
    });

    // ==========================================
    // 6. PRODUCTS PAGE ARTICLES REVEAL
    // ==========================================
    const productArticles = document.querySelectorAll('.product-article');
    if (productArticles.length > 0) {
        productArticles.forEach((article) => {
            const isReverse = article.classList.contains('reverse');
            const slideDirection = isReverse ? 50 : -50;

            gsap.from(article, {
                opacity: 0,
                x: slideDirection,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: article,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                }
            });
        });
    }

    // ==========================================
    // 7. CONTACT CTA BAND REVEAL
    // ==========================================
    const contactCta = document.querySelector('.section-contact-cta');
    if (contactCta) {
        gsap.from('.contact-cta-inner h2, .contact-cta-inner p, .contact-cta-inner a', {
            opacity: 0,
            y: 35,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: contactCta,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    }

    // ==========================================
    // 8. CONTACT PAGE GRID REVEAL
    // ==========================================
    const contactGrid = document.querySelector('.contact-grid');
    if (contactGrid) {
        gsap.from('.contact-info > h2, .contact-info__block', {
            opacity: 0,
            x: -40,
            duration: 0.8,
            stagger: 0.2,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: contactGrid,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });

        gsap.from('.contact-form-card', {
            opacity: 0,
            x: 40,
            duration: 0.8,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: contactGrid,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    }

    // ==========================================
    // 9. ABOUT PAGE INTRO PARAGRAPH
    // ==========================================
    const aboutIntro = document.querySelector('.section-about-intro');
    if (aboutIntro) {
        gsap.from('.section-about-intro p', {
            opacity: 0,
            y: 30,
            duration: 1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: aboutIntro,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    }

    // ==========================================
    // 10. SITE FOOTER REVEAL
    // ==========================================
    const footer = document.querySelector('.site-footer');
    if (footer) {
        const cols = footer.querySelectorAll('.footer-col');
        gsap.from(cols, {
            opacity: 0,
            y: 30,
            duration: 0.8,
            stagger: 0.12,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: footer,
                start: 'top 90%',
                toggleActions: 'play none none none'
            }
        });
    }
});
