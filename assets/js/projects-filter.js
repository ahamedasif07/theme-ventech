/**
 * projects-filter.js — Region filter for the Projects page
 *
 * Replaces React's useState filter pattern from projects.tsx:
 *   const [active, setActive] = useState("ALL");
 *   const visible = regions.filter((r) => active === "ALL" || r.key === active);
 *
 * Implementation:
 * - Listens for click on .filter-btn buttons (ALL / VIC / NSW / QLD)
 * - Reads the data-filter attribute on the clicked button
 * - Shows/hides .project-card elements based on their data-region attribute
 * - Manages the is-active CSS class on buttons
 */

(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    var filterBtns = document.querySelectorAll(".filter-btn");
    var projectCards = document.querySelectorAll(".project-card");

    if (!filterBtns.length || !projectCards.length) return;

    /**
     * Filter the project grid.
     * @param {string} region  "ALL", "VIC", "NSW", or "QLD"
     */
    function applyFilter(region) {
      projectCards.forEach(function (card) {
        var cardRegion = card.getAttribute("data-region");

        if (region === "ALL" || cardRegion === region) {
          // Show card
          card.style.display = "";
        } else {
          // Hide card
          card.style.display = "none";
        }
      });
    }

    /**
     * Update the active button state.
     * @param {Element} activeBtn  The button that was clicked.
     */
    function setActiveButton(activeBtn) {
      filterBtns.forEach(function (btn) {
        btn.classList.remove("is-active");
        btn.setAttribute("aria-pressed", "false");
      });
      activeBtn.classList.add("is-active");
      activeBtn.setAttribute("aria-pressed", "true");
    }

    // Attach click listeners to all filter buttons
    filterBtns.forEach(function (btn) {
      // Set initial ARIA pressed state
      var isInitiallyActive = btn.classList.contains("is-active");
      btn.setAttribute("aria-pressed", isInitiallyActive ? "true" : "false");

      btn.addEventListener("click", function () {
        var filter = btn.getAttribute("data-filter") || "ALL";
        setActiveButton(btn);
        applyFilter(filter);
      });
    });

    // Run the initial filter (ALL by default — all cards visible)
    applyFilter("ALL");
  });
})();
