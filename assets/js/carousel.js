/**
 * ventech-carousel.js
 * -------------------------------------------------------
 * Featured Hero Slider — Content (left) + Image (right)
 *
 * Features:
 *  - Auto-play with configurable interval
 *  - Pause on hover / focus
 *  - Touch / swipe support
 *  - Keyboard navigation (← →)
 *  - Dot navigation + prev/next buttons
 *  - Animated progress bar
 *  - ARIA live region for accessibility
 *  - Graceful no-op when the element is absent
 * -------------------------------------------------------
 */

(function () {
  'use strict';

  /* ── Constants ─────────────────────────────────────── */
  const AUTOPLAY_MS  = 5000;
  const TRANSITION_MS = 700;

  /* ── Selector helpers ──────────────────────────────── */
  function qs(sel, ctx) { return (ctx || document).querySelector(sel); }
  function qsa(sel, ctx) { return Array.from((ctx || document).querySelectorAll(sel)); }

  /* ── Init ──────────────────────────────────────────── */
  function initCarousel(wrapper) {
    const slides      = qsa('.vc-slide', wrapper);
    const dotsWrap    = qs('.vc-dots', wrapper);
    const btnPrev     = qs('.vc-btn-prev', wrapper);
    const btnNext     = qs('.vc-btn-next', wrapper);
    const progressBar = qs('.vc-progress-bar', wrapper);
    const liveRegion  = qs('[aria-live]', wrapper);

    if (!slides.length) return;

    let current    = 0;
    let timer      = null;
    let progTimer  = null;
    let paused     = false;
    let isAnimating = false;

    /* Build dots */
    const dots = slides.map((_, i) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'vc-dot';
      btn.setAttribute('aria-label', 'Go to slide ' + (i + 1));
      btn.addEventListener('click', () => goTo(i));
      dotsWrap && dotsWrap.appendChild(btn);
      return btn;
    });

    /* ── Go to slide ───────────────────────────────── */
    function goTo(index, direction) {
      if (isAnimating || index === current) return;
      isAnimating = true;

      const prev = current;
      current    = (index + slides.length) % slides.length;
      const dir  = direction !== undefined ? direction : (current > prev ? 1 : -1);

      // Outgoing slide
      slides[prev].classList.add(dir > 0 ? 'vc-slide--exit-left' : 'vc-slide--exit-right');
      slides[prev].classList.remove('vc-slide--active');

      // Incoming slide
      slides[current].classList.add(dir > 0 ? 'vc-slide--enter-right' : 'vc-slide--enter-left');
      slides[current].classList.add('vc-slide--active');

      // Force reflow so the entering animation fires
      slides[current].getBoundingClientRect();
      slides[current].classList.remove('vc-slide--enter-right', 'vc-slide--enter-left');

      updateDots();
      updateLiveRegion();

      setTimeout(() => {
        slides[prev].classList.remove('vc-slide--exit-left', 'vc-slide--exit-right');
        isAnimating = false;
      }, TRANSITION_MS);

      resetProgress();
    }

    function next() { goTo(current + 1, 1); }
    function prev() { goTo(current - 1, -1); }

    /* ── Dots ──────────────────────────────────────── */
    function updateDots() {
      dots.forEach((d, i) => {
        d.classList.toggle('vc-dot--active', i === current);
        d.setAttribute('aria-current', i === current ? 'true' : 'false');
      });
    }

    /* ── ARIA live region ──────────────────────────── */
    function updateLiveRegion() {
      if (!liveRegion) return;
      liveRegion.textContent = 'Slide ' + (current + 1) + ' of ' + slides.length;
    }

    /* ── Progress bar ──────────────────────────────── */
    function resetProgress() {
      if (!progressBar) return;
      clearTimeout(progTimer);
      progressBar.style.transition = 'none';
      progressBar.style.width = '0%';

      // Allow the browser to reset width before animating
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          if (!paused) {
            progressBar.style.transition = 'width ' + AUTOPLAY_MS + 'ms linear';
            progressBar.style.width = '100%';
          }
        });
      });
    }

    /* ── Auto-play ─────────────────────────────────── */
    function startAutoplay() {
      clearInterval(timer);
      if (paused) return;
      resetProgress();
      timer = setInterval(next, AUTOPLAY_MS);
    }

    function stopAutoplay() {
      clearInterval(timer);
      if (progressBar) {
        const computed = getComputedStyle(progressBar).width;
        const parentW  = progressBar.parentElement
          ? parseFloat(getComputedStyle(progressBar.parentElement).width)
          : 0;
        progressBar.style.transition = 'none';
        progressBar.style.width = computed;
        // Convert to percentage
        if (parentW) {
          progressBar.style.width = (parseFloat(computed) / parentW * 100) + '%';
        }
      }
    }

    /* ── Pause / resume helpers ────────────────────── */
    function pause()  { paused = true;  stopAutoplay(); }
    function resume() { paused = false; startAutoplay(); }

    /* ── Button listeners ──────────────────────────── */
    btnPrev && btnPrev.addEventListener('click', () => { pause(); prev(); setTimeout(resume, 4000); });
    btnNext && btnNext.addEventListener('click', () => { pause(); next(); setTimeout(resume, 4000); });

    /* ── Hover / focus pause ───────────────────────── */
    wrapper.addEventListener('mouseenter', pause);
    wrapper.addEventListener('mouseleave', resume);
    wrapper.addEventListener('focusin',   pause);
    wrapper.addEventListener('focusout',  (e) => {
      if (!wrapper.contains(e.relatedTarget)) resume();
    });

    /* ── Keyboard ──────────────────────────────────── */
    wrapper.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft')  { pause(); prev(); setTimeout(resume, 4000); }
      if (e.key === 'ArrowRight') { pause(); next(); setTimeout(resume, 4000); }
    });

    /* ── Touch / swipe ─────────────────────────────── */
    let touchStartX = 0;
    let touchStartY = 0;

    wrapper.addEventListener('touchstart', (e) => {
      touchStartX = e.touches[0].clientX;
      touchStartY = e.touches[0].clientY;
    }, { passive: true });

    wrapper.addEventListener('touchend', (e) => {
      const dx = e.changedTouches[0].clientX - touchStartX;
      const dy = e.changedTouches[0].clientY - touchStartY;
      if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 40) {
        pause();
        dx < 0 ? next() : prev();
        setTimeout(resume, 4000);
      }
    }, { passive: true });

    /* ── Initialise first slide ────────────────────── */
    slides[0].classList.add('vc-slide--active');
    updateDots();
    updateLiveRegion();
    startAutoplay();

    /* ── Respect reduced-motion preference ─────────── */
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      clearInterval(timer);
      if (progressBar) progressBar.style.display = 'none';
    }
  }

  /* ── Bootstrap on DOMContentLoaded ──────────────── */
  document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.vc-hero-slider');
    if (wrapper) initCarousel(wrapper);
  });

})();
