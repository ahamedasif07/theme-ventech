/**
 * calculators.js
 * Engineering Calculators — Tab switching + Live real-time calculations
 * Place in: /wp-content/themes/YOUR-THEME/assets/js/
 * All IDs and classes prefixed with "vc-" to avoid WordPress conflicts
 */

document.addEventListener("DOMContentLoaded", function () {
  /* =============================================
       TAB SWITCHING
       ============================================= */
  var navItems = document.querySelectorAll(".vc-nav-item");
  var calcCards = document.querySelectorAll(".vc-calc-card");

  navItems.forEach(function (btn) {
    btn.addEventListener("click", function () {
      var target = btn.getAttribute("data-tab");

      navItems.forEach(function (b) {
        b.classList.remove("active");
      });
      btn.classList.add("active");

      calcCards.forEach(function (card) {
        if (card.id === "vc-tab-" + target) {
          card.classList.add("active");
        } else {
          card.classList.remove("active");
        }
      });
    });
  });

  /* =============================================
       HELPER — safe parse
       ============================================= */
  function num(id) {
    var el = document.getElementById(id);
    return el ? parseFloat(el.value) || 0 : 0;
  }

  function set(id, html) {
    var el = document.getElementById(id);
    if (el) el.innerHTML = html;
  }

  function setText(id, txt) {
    var el = document.getElementById(id);
    if (el) el.textContent = txt;
  }

  function listen(id, fn) {
    var el = document.getElementById(id);
    if (el) el.addEventListener("input", fn);
  }

  /* =============================================
       1. AIRFLOW
       Q (L/s) = Velocity (m/s) × Area (m²) × 1000
       ============================================= */
  function calcAirflow() {
    var q = num("vc-airflow-velocity") * num("vc-airflow-area") * 1000;
    set(
      "vc-airflow-result",
      q.toFixed(2) + ' <span class="vc-result-unit">L/s</span>',
    );
  }
  listen("vc-airflow-velocity", calcAirflow);
  listen("vc-airflow-area", calcAirflow);
  calcAirflow();

  /* =============================================
       2. DUCT SIZE — Circular Equivalent Diameter
       De = 1.30 × (a×b)^0.625 / (a+b)^0.25
       ============================================= */
  function calcDuctSize() {
    var a = num("vc-duct-width");
    var b = num("vc-duct-height");
    if (a <= 0 || b <= 0) {
      set("vc-duct-result", '— <span class="vc-result-unit">mm</span>');
      return;
    }
    var de = (1.3 * Math.pow(a * b, 0.625)) / Math.pow(a + b, 0.25);
    set(
      "vc-duct-result",
      Math.round(de) + ' <span class="vc-result-unit">mm</span>',
    );
  }
  listen("vc-duct-width", calcDuctSize);
  listen("vc-duct-height", calcDuctSize);
  calcDuctSize();

  /* =============================================
       3. PRESSURE CONVERSION
       Input: Pascals (Pa)
       MMWG   = Pa × 0.10197
       IN.W.G = Pa × 0.004015
       ============================================= */
  function calcPressure() {
    var pa = num("vc-pressure-pa");
    setText("vc-pressure-mmwg", (pa * 0.10197).toFixed(2));
    setText("vc-pressure-inwg", (pa * 0.004015).toFixed(3));
  }
  listen("vc-pressure-pa", calcPressure);
  calcPressure();

  /* =============================================
       4. FREE AREA
       Effective Area = (W × H / 1,000,000) × Factor
       W & H in mm → converts to m²
       ============================================= */
  function calcFreeArea() {
    var w = num("vc-free-w");
    var h = num("vc-free-h");
    var f = num("vc-free-factor");
    var area = ((w * h) / 1000000) * f;
    set(
      "vc-freearea-result",
      area.toFixed(3) + ' <span class="vc-result-unit">m²</span>',
    );
  }
  listen("vc-free-w", calcFreeArea);
  listen("vc-free-h", calcFreeArea);
  listen("vc-free-factor", calcFreeArea);
  calcFreeArea();

  /* =============================================
       5. FLOW UNIT CONVERTER
       Input: L/s
       CFM  = L/s × 2.11888
       M³/H = L/s × 3.6
       ============================================= */
  function calcUnitConverter() {
    var ls = num("vc-unit-ls");
    setText("vc-unit-cfm", (ls * 2.11888).toFixed(1));
    setText("vc-unit-m3h", (ls * 3.6).toFixed(1));
  }
  listen("vc-unit-ls", calcUnitConverter);
  calcUnitConverter();

  /* =============================================
       6. ARC LENGTH
       Arc = (Angle / 360) × 2π × Radius
       ============================================= */
  function calcArcLength() {
    var r = num("vc-arc-radius");
    var deg = num("vc-arc-angle");
    var arc = (deg / 360) * 2 * Math.PI * r;
    set(
      "vc-arc-result",
      arc.toFixed(2) + ' <span class="vc-result-unit">mm</span>',
    );
  }
  listen("vc-arc-radius", calcArcLength);
  listen("vc-arc-angle", calcArcLength);
  calcArcLength();
});
