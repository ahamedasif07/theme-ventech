/**
 * Hero Slider — vanilla JS
 * Features: autoplay, dot navigation, prev/next arrows, swipe (touch), pause on hover
 */
(function () {
    'use strict';

    function initHeroSlider(root) {
        var slides   = Array.prototype.slice.call(root.querySelectorAll('.hero-slider__slide'));
        var dots     = Array.prototype.slice.call(root.querySelectorAll('.hero-slider__dot'));
        var prevBtn  = root.querySelector('.hero-slider__arrow--prev');
        var nextBtn  = root.querySelector('.hero-slider__arrow--next');
        var interval = parseInt(root.getAttribute('data-autoplay'), 10) || 0;

        if (slides.length <= 1) return; // ekta slide thakle slider logic dorkar nei

        var current = 0;
        var timer   = null;

        function goTo(index) {
            index = (index + slides.length) % slides.length;

            slides[current].classList.remove('is-active');
            if (dots[current]) dots[current].classList.remove('is-active');

            current = index;

            slides[current].classList.add('is-active');
            if (dots[current]) dots[current].classList.add('is-active');
        }

        function next() { goTo(current + 1); }
        function prev() { goTo(current - 1); }

        function startAutoplay() {
            if (!interval) return;
            stopAutoplay();
            timer = setInterval(next, interval);
        }

        function stopAutoplay() {
            if (timer) clearInterval(timer);
        }

        // Arrows
        if (nextBtn) nextBtn.addEventListener('click', function () {
            next();
            startAutoplay();
        });

        if (prevBtn) prevBtn.addEventListener('click', function () {
            prev();
            startAutoplay();
        });

        // Dots
        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                var idx = parseInt(dot.getAttribute('data-goto'), 10);
                goTo(idx);
                startAutoplay();
            });
        });

        // Pause on hover
        root.addEventListener('mouseenter', stopAutoplay);
        root.addEventListener('mouseleave', startAutoplay);

        // Swipe support (touch devices)
        var touchStartX = 0;
        var touchEndX   = 0;

        root.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        root.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            var diff = touchStartX - touchEndX;
            var threshold = 40;

            if (diff > threshold) {
                next();
                startAutoplay();
            } else if (diff < -threshold) {
                prev();
                startAutoplay();
            }
        }

        // Keyboard navigation
        root.setAttribute('tabindex', '0');
        root.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowRight') { next(); startAutoplay(); }
            if (e.key === 'ArrowLeft')  { prev(); startAutoplay(); }
        });

        startAutoplay();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var sliders = document.querySelectorAll('.hero-slider');
        sliders.forEach(initHeroSlider);
    });
})();