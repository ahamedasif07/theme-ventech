/**
 * calculators.js
 * Engineering Calculators — Tab switching + Live calculations
 */

document.addEventListener("DOMContentLoaded", function () {
  /* =============================================
       TAB SWITCHING
       ============================================= */
  const navItems = document.querySelectorAll(".nav-item");
  const calcCards = document.querySelectorAll(".calc-card");

  navItems.forEach(function (btn) {
    btn.addEventListener("click", function () {
      const target = btn.getAttribute("data-tab");

      // Update nav active state
      navItems.forEach(function (b) {
        b.classList.remove("active");
      });
      btn.classList.add("active");

      // Show matching card
      calcCards.forEach(function (card) {
        if (card.id === "tab-" + target) {
          card.classList.add("active");
        } else {
          card.classList.remove("active");
        }
      });
    });
  });

  /* =============================================
       1. AIRFLOW CALCULATOR
       Q (L/s) = Velocity (m/s) × Area (m²) × 1000
       ============================================= */
  var afVelocity = document.getElementById("airflow-velocity");
  var afArea = document.getElementById("airflow-area");
  var afResult = document.getElementById("airflow-result");

  function calcAirflow() {
    var v = parseFloat(afVelocity.value) || 0;
    var a = parseFloat(afArea.value) || 0;
    var q = v * a * 1000; // L/s
    afResult.innerHTML = q.toFixed(2) + ' <span class="result-unit">L/s</span>';
  }

  afVelocity.addEventListener("input", calcAirflow);
  afArea.addEventListener("input", calcAirflow);
  calcAirflow();

  /* =============================================
       2. DUCT SIZE — CIRCULAR EQUIVALENT
       De = 1.30 × (a×b)^0.625 / (a+b)^0.25
       a = width (mm), b = height (mm)
       ============================================= */
  var ductW = document.getElementById("duct-width");
  var ductH = document.getElementById("duct-height");
  var ductResult = document.getElementById("duct-result");

  function calcDuctSize() {
    var a = parseFloat(ductW.value) || 0;
    var b = parseFloat(ductH.value) || 0;
    if (a <= 0 || b <= 0) {
      ductResult.innerHTML = '— <span class="result-unit">mm</span>';
      return;
    }
    var de = (1.3 * Math.pow(a * b, 0.625)) / Math.pow(a + b, 0.25);
    ductResult.innerHTML =
      Math.round(de) + ' <span class="result-unit">mm</span>';
  }

  ductW.addEventListener("input", calcDuctSize);
  ductH.addEventListener("input", calcDuctSize);
  calcDuctSize();

  /* =============================================
       3. PRESSURE CONVERSION
       Input: Pascals (Pa)
       MMWG  = Pa × 0.10197
       IN.W.G = Pa × 0.004015
       ============================================= */
  var pressurePa = document.getElementById("pressure-pa");
  var pressureMmwg = document.getElementById("pressure-mmwg");
  var pressureInwg = document.getElementById("pressure-inwg");

  function calcPressure() {
    var pa = parseFloat(pressurePa.value) || 0;
    var mmwg = pa * 0.10197;
    var inwg = pa * 0.004015;
    pressureMmwg.textContent = mmwg.toFixed(2);
    pressureInwg.textContent = inwg.toFixed(3);
  }

  pressurePa.addEventListener("input", calcPressure);
  calcPressure();

  /* =============================================
       4. FREE AREA CALCULATOR
       Effective Free Area = (W × H / 1,000,000) × Factor
       W, H in mm → m², Factor is a decimal (0–1)
       ============================================= */
  var freeW = document.getElementById("free-w");
  var freeH = document.getElementById("free-h");
  var freeFactor = document.getElementById("free-factor");
  var freeResult = document.getElementById("freearea-result");

  function calcFreeArea() {
    var w = parseFloat(freeW.value) || 0;
    var h = parseFloat(freeH.value) || 0;
    var f = parseFloat(freeFactor.value) || 0;
    var area = ((w * h) / 1000000) * f;
    freeResult.innerHTML =
      area.toFixed(3) + ' <span class="result-unit">m²</span>';
  }

  freeW.addEventListener("input", calcFreeArea);
  freeH.addEventListener("input", calcFreeArea);
  freeFactor.addEventListener("input", calcFreeArea);
  calcFreeArea();

  /* =============================================
       5. FLOW UNIT CONVERTER
       Input: L/s
       CFM   = L/s × 2.11888
       M³/H  = L/s × 3.6
       ============================================= */
  var unitLs = document.getElementById("unit-ls");
  var unitCfm = document.getElementById("unit-cfm");
  var unitM3h = document.getElementById("unit-m3h");

  function calcUnitConverter() {
    var ls = parseFloat(unitLs.value) || 0;
    var cfm = ls * 2.11888;
    var m3h = ls * 3.6;
    unitCfm.textContent = cfm.toFixed(1);
    unitM3h.textContent = m3h.toFixed(1);
  }

  unitLs.addEventListener("input", calcUnitConverter);
  calcUnitConverter();

  /* =============================================
       6. ARC LENGTH CALCULATOR
       Arc Length = (Angle / 360) × 2π × Radius
       Radius in mm, Angle in degrees
       ============================================= */
  var arcRadius = document.getElementById("arc-radius");
  var arcAngle = document.getElementById("arc-angle");
  var arcResult = document.getElementById("arc-result");

  function calcArcLength() {
    var r = parseFloat(arcRadius.value) || 0;
    var deg = parseFloat(arcAngle.value) || 0;
    var arc = (deg / 360) * 2 * Math.PI * r;
    arcResult.innerHTML =
      arc.toFixed(2) + ' <span class="result-unit">mm</span>';
  }

  arcRadius.addEventListener("input", calcArcLength);
  arcAngle.addEventListener("input", calcArcLength);
  calcArcLength();
});
