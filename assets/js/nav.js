(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    /* =====================================================
       1. MOBILE HAMBURGER
    ===================================================== */
    var btn = document.getElementById("nav-hamburger-btn");
    var panel = document.getElementById("nav-mobile-panel");

    if (btn && panel) {
      var hamburgerIcon = btn.querySelector(".hamburger-icon");
      var closeIcon = btn.querySelector(".close-icon");

      function toggleMenu() {
        var isOpen = panel.classList.toggle("is-open");
        btn.setAttribute("aria-expanded", isOpen ? "true" : "false");
        panel.setAttribute("aria-hidden", isOpen ? "false" : "true");
        if (hamburgerIcon) hamburgerIcon.style.display = isOpen ? "none" : "";
        if (closeIcon) closeIcon.style.display = isOpen ? "" : "none";
      }

      btn.addEventListener("click", toggleMenu);

      panel.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
          if (panel.classList.contains("is-open")) toggleMenu();
        });
      });
    }

    /* =====================================================
       2. DESKTOP + MOBILE DROPDOWNS
       Safe-triangle mouse-bridge prevents accidental close
       when cursor moves from button down into the panel.
    ===================================================== */
    var dropdownContainers = document.querySelectorAll(".nav-item-dropdown");

    dropdownContainers.forEach(function (container) {
      var dropdownBtn = container.querySelector(".nav-link-dropdown");
      var menu = container.querySelector(".dropdown-menu, .products-grid");
      var triangle = container.querySelector(".safe-triangle");

      if (!dropdownBtn || !menu) return;

      var closeTimer = null;

      function openMenu() {
        if (window.innerWidth < 1024) return;
        clearTimeout(closeTimer);
        closeAllDropdowns();
        container.classList.add("is-open");
        menu.classList.add("is-open");
        menu.style.display = "";
        dropdownBtn.setAttribute("aria-expanded", "true");
      }

      function scheduleClose() {
        closeTimer = setTimeout(function () {
          container.classList.remove("is-open");
          menu.classList.remove("is-open");
          menu.style.display = "none";
          dropdownBtn.setAttribute("aria-expanded", "false");
        }, 120);
      }

      function cancelClose() {
        clearTimeout(closeTimer);
      }

      // --- DESKTOP: hover ---
      dropdownBtn.addEventListener("mouseenter", function () {
        if (window.innerWidth >= 1024) openMenu();
      });

      menu.addEventListener("mouseenter", cancelClose);
      menu.addEventListener("mouseleave", scheduleClose);

      // Safe triangle: invisible bridge between button and panel
      if (triangle) {
        triangle.addEventListener("mouseenter", cancelClose);
        triangle.addEventListener("mouseleave", scheduleClose);
      }

      container.addEventListener("mouseleave", scheduleClose);

      // --- DESKTOP: click toggle (keyboard / touch fallback) ---
      dropdownBtn.addEventListener("click", function (e) {
        if (window.innerWidth >= 1024) {
          e.stopPropagation();
          var alreadyOpen = container.classList.contains("is-open");
          closeAllDropdowns();
          if (!alreadyOpen) openMenu();
        }
      });

      // --- MOBILE: click toggle ---
      dropdownBtn.addEventListener("click", function (e) {
        if (window.innerWidth < 1024) {
          e.preventDefault();
          e.stopPropagation();
          var isVisible = menu.classList.contains("is-open");
          closeAllDropdowns();
          if (!isVisible) {
            menu.classList.add("is-open");
            menu.style.display = "block";
          }
        }
      });
    });

    /* =====================================================
       3. RESOURCES MOBILE DROPDOWN
    ===================================================== */
    var mobileDropdownBtns = document.querySelectorAll(
      ".mobile-dropdown-toggle",
    );
    mobileDropdownBtns.forEach(function (mBtn) {
      var mMenu = mBtn
        .closest(".mobile-dropdown")
        .querySelector(".mobile-dropdown-menu");
      if (!mMenu) return;

      mBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        var isVisible = mMenu.style.display === "block";
        document
          .querySelectorAll(".mobile-dropdown-menu")
          .forEach(function (m) {
            m.style.display = "none";
          });
        mMenu.style.display = isVisible ? "none" : "block";
      });
    });

    /* =====================================================
       4. CLICK OUTSIDE — close everything
    ===================================================== */
    document.addEventListener("click", function (e) {
      var header = document.querySelector(".site-header");
      if (header && !header.contains(e.target)) {
        if (panel && panel.classList.contains("is-open")) {
          panel.classList.remove("is-open");
          if (btn) {
            btn.setAttribute("aria-expanded", "false");
            panel.setAttribute("aria-hidden", "true");
            var hi = btn.querySelector(".hamburger-icon");
            var ci = btn.querySelector(".close-icon");
            if (hi) hi.style.display = "";
            if (ci) ci.style.display = "none";
          }
        }
        closeAllDropdowns();
      }
    });

    /* =====================================================
       5. SMOOTH CARD HOVER EFFECTS
    ===================================================== */
    document.querySelectorAll(".ventech-product-card").forEach(function (card) {
      card.addEventListener("mouseenter", function () {
        this.style.willChange = "transform";
      });
      card.addEventListener("mouseleave", function () {
        this.style.willChange = "auto";
      });
    });

    /* =====================================================
       HELPER — close all dropdown menus
    ===================================================== */
    function closeAllDropdowns() {
      document.querySelectorAll(".nav-item-dropdown").forEach(function (c) {
        c.classList.remove("is-open");
      });
      document
        .querySelectorAll(
          ".nav-item-dropdown .dropdown-menu, .nav-item-dropdown .products-grid",
        )
        .forEach(function (m) {
          m.classList.remove("is-open");
          m.style.display = "none";
        });
      document.querySelectorAll(".nav-link-dropdown").forEach(function (b) {
        b.setAttribute("aria-expanded", "false");
      });
    }
  }); // DOMContentLoaded
})();
