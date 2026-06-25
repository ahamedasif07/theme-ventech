/**
 * nav.js — Mobile hamburger menu toggle
 *
 * Replaces React's useState(false) open/close pattern from Nav.tsx.
 * Toggles the 'is-open' class on the mobile nav panel and
 * swaps the hamburger / X icon visibility.
 */

(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    var btn = document.getElementById("nav-hamburger-btn");
    var panel = document.getElementById("nav-mobile-panel");

    if (!btn || !panel) return;

    var hamburgerIcon = btn.querySelector(".hamburger-icon");
    var closeIcon = btn.querySelector(".close-icon");

    /**
     * Toggle the mobile menu open / closed.
     */
    function toggleMenu() {
      var isOpen = panel.classList.toggle("is-open");

      // Update ARIA attributes for accessibility
      btn.setAttribute("aria-expanded", isOpen ? "true" : "false");
      panel.setAttribute("aria-hidden", isOpen ? "false" : "true");

      // Swap icon: hamburger ↔ X (matches React's conditional render)
      if (hamburgerIcon) hamburgerIcon.style.display = isOpen ? "none" : "";
      if (closeIcon) closeIcon.style.display = isOpen ? "" : "none";
    }

    // Open / close on button click
    btn.addEventListener("click", toggleMenu);

    // Close when a mobile nav link is clicked (matches React's onClick={() => setOpen(false)})
    var mobileLinks = panel.querySelectorAll("a");
    mobileLinks.forEach(function (link) {
      link.addEventListener("click", function () {
        if (panel.classList.contains("is-open")) {
          toggleMenu();
        }
      });
    });

    // Close when clicking outside the header (optional UX improvement)
    document.addEventListener("click", function (e) {
      var header = document.querySelector(".site-header");
      if (
        header &&
        !header.contains(e.target) &&
        panel.classList.contains("is-open")
      ) {
        toggleMenu();
      }
    });
    // nav.js
    var dropdownBtn = document.querySelector(".nav-link-dropdown");
    if (dropdownBtn) {
      dropdownBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var menu = this.nextElementSibling;
        menu.style.display = menu.style.display === "block" ? "none" : "block";
      });
    }
    // Mobile Dropdown Toggle
    var mobileDropdownBtn = document.querySelector(".mobile-dropdown-toggle");
    var mobileDropdownMenu = document.querySelector(".mobile-dropdown-menu");

    if (mobileDropdownBtn) {
      mobileDropdownBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        var isVisible = mobileDropdownMenu.style.display === "block";
        mobileDropdownMenu.style.display = isVisible ? "none" : "block";
      });
    }
  });
})();
