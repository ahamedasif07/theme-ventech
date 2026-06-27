(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    // Mobile Hamburger Menu
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

    // Dropdown Logic (Resources & Products)
    var dropdownContainers = document.querySelectorAll(".nav-item-dropdown");

    dropdownContainers.forEach(function (container) {
      var dropdownBtn = container.querySelector(".nav-link-dropdown");
      var menu = container.querySelector(".dropdown-menu");

      if (dropdownBtn && menu) {
        // Desktop Hover
        container.addEventListener("mouseenter", function () {
          if (window.innerWidth >= 1024) menu.style.display = "block";
        });
        container.addEventListener("mouseleave", function () {
          if (window.innerWidth >= 1024) menu.style.display = "none";
        });

        // Mobile Click
        dropdownBtn.addEventListener("click", function (e) {
          if (window.innerWidth < 1024) {
            e.preventDefault();
            e.stopPropagation();
            var isVisible = menu.style.display === "block";
            document
              .querySelectorAll(".dropdown-menu")
              .forEach((m) => (m.style.display = "none"));
            menu.style.display = isVisible ? "none" : "block";
          }
        });
      }
    });

    // Mobile Dropdown Toggle
    var mobileDropdownBtn = document.querySelector(".mobile-dropdown-toggle");
    var mobileDropdownMenu = document.querySelector(".mobile-dropdown-menu");
    if (mobileDropdownBtn && mobileDropdownMenu) {
      mobileDropdownBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        var isVisible = mobileDropdownMenu.style.display === "block";
        mobileDropdownMenu.style.display = isVisible ? "none" : "block";
      });
    }

    // Click outside to close
    document.addEventListener("click", function (e) {
      var header = document.querySelector(".site-header");
      if (header && !header.contains(e.target)) {
        if (panel && panel.classList.contains("is-open")) {
          panel.classList.remove("is-open");
          btn.setAttribute("aria-expanded", "false");
          panel.setAttribute("aria-hidden", "true");
          if (btn) {
            btn.querySelector(".hamburger-icon").style.display = "";
            btn.querySelector(".close-icon").style.display = "none";
          }
        }
        document
          .querySelectorAll(".dropdown-menu")
          .forEach((m) => (m.style.display = "none"));
      }
    });
  });
})();
