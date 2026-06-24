/**
 * contact-form.js — AJAX contact form submission
 *
 * Replaces React's useState sent pattern from contact.tsx:
 *   const [sent, setSent] = useState(false);
 *   onSubmit={(e) => { e.preventDefault(); setSent(true); }}
 *
 * Implementation:
 * - Intercepts the form submit event
 * - Collects form data and sends via fetch() to WordPress AJAX endpoint
 * - On success: changes button text to "Message sent ✓"
 * - On error: shows error message near the submit button
 * - Uses WordPress nonce (passed via ventechAjax.nonce from wp_localize_script)
 */

(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("ventech-contact-form");
    var submitBtn = document.getElementById("contact-submit-btn");
    var statusEl = document.getElementById("contact-form-status");

    if (!form || !submitBtn) return;

    // ventechAjax is set by wp_localize_script in functions.php
    var ajaxUrl = typeof ventechAjax !== "undefined" ? ventechAjax.ajaxUrl : "/wp-admin/admin-ajax.php";
    var nonce = typeof ventechAjax !== "undefined" ? ventechAjax.nonce : "";

    form.addEventListener("submit", function (e) {
      e.preventDefault();

      // Disable button while submitting
      submitBtn.disabled = true;
      submitBtn.textContent = "Sending…";
      if (statusEl) statusEl.textContent = "";

      // Collect form data
      var formData = new FormData(form);
      formData.set("action", "ventech_contact");
      formData.set("nonce", nonce);

      fetch(ajaxUrl, {
        method: "POST",
        credentials: "same-origin",
        body: formData,
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          if (data.success) {
            // Match React's setSent(true) → button text becomes "Message sent"
            submitBtn.textContent = "Message sent ✓";
            submitBtn.disabled = false;
            if (statusEl) {
              statusEl.textContent = "Thank you! We'll be in touch shortly.";
              statusEl.style.color = "oklch(0.65 0.15 145)"; // soft green
            }
            // Reset the form fields
            form.reset();
          } else {
            var errorMsg =
              data.data && data.data.message
                ? data.data.message
                : "Something went wrong. Please try again.";
            if (statusEl) {
              statusEl.textContent = errorMsg;
              statusEl.style.color = "oklch(0.7 0.19 30)"; // brand-red
            }
            submitBtn.textContent = "Contact us";
            submitBtn.disabled = false;
          }
        })
        .catch(function () {
          if (statusEl) {
            statusEl.textContent = "Network error. Please check your connection and try again.";
            statusEl.style.color = "oklch(0.7 0.19 30)";
          }
          submitBtn.textContent = "Contact us";
          submitBtn.disabled = false;
        });
    });
  });
})();
