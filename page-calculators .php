<?php

/**
 * Template Name: Calculators Page
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/page-header', null, [
    'title'     => 'Calculators',
    'image_url' => ventech_image_url('hero-ceiling.jpg'),
]);
?>

<!-- ============================================================
     CALCULATORS SECTION
     Place calculators.css in your theme's /assets/css/ folder
     Place calculators.js  in your theme's /assets/js/  folder
     Enqueue both in functions.php (see bottom of this file)
     ============================================================ -->

<section class="vc-calculators-section">
    <!-- ===== CALCULATOR PAGE HEADER ===== -->
    <div class="vc-calc-header">
        <div class="vc-calc-header-inner">
            <h1 style="margin:0; line-height:1;">
                <span style="
                color:#0D8BDB;
                font-size:28px;
                font-weight:900;
                text-transform:uppercase;
                font-family:Arial, sans-serif;
                letter-spacing:-1px;
            ">
                    ENGINEERING
                </span>
                <span style="
                color:#1F3B6D;
                font-size:28px;
                font-weight:900;
                text-transform:uppercase;
                font-family:Arial, sans-serif;
                letter-spacing:-1px;
            ">
                    CALCULATORS
                </span>
            </h1>

            <p style="
            margin-top:10px;
            color:#7A7A7A;
            font-size:15px;
            font-family:Arial, sans-serif;
        ">
                Professional HVAC tools with instant results.
            </p>
        </div>
    </div>
    <div class="vc-calc-wrap">

        <!-- ===== HEADER ===== -->


        <!-- ===== SIDEBAR NAV ===== -->
        <aside class="vc-calc-sidebar">
            <nav>

                <button class="vc-nav-item active" data-tab="airflow">
                    <span class="vc-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                            <path d="M3 6c0-1.1.9-2 2-2h4" />
                            <path d="M3 18c0 1.1.9 2 2 2h4" />
                        </svg>
                    </span>
                    <span class="vc-nav-label">AIRFLOW</span>
                    <span class="vc-nav-arrow">›</span>
                </button>

                <button class="vc-nav-item" data-tab="ductsize">
                    <span class="vc-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                    </span>
                    <span class="vc-nav-label">DUCT SIZE</span>
                </button>

                <button class="vc-nav-item" data-tab="pressure">
                    <span class="vc-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path
                                d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" />
                        </svg>
                    </span>
                    <span class="vc-nav-label">PRESSURE</span>
                </button>

                <button class="vc-nav-item" data-tab="freearea">
                    <span class="vc-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                            <line x1="7" y1="7" x2="7.01" y2="7" />
                        </svg>
                    </span>
                    <span class="vc-nav-label">FREE AREA</span>
                </button>

                <button class="vc-nav-item" data-tab="unitconverter">
                    <span class="vc-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="17 1 21 5 17 9" />
                            <path d="M3 11V9a4 4 0 0 1 4-4h14" />
                            <polyline points="7 23 3 19 7 15" />
                            <path d="M21 13v2a4 4 0 0 1-4 4H3" />
                        </svg>
                    </span>
                    <span class="vc-nav-label">UNIT CONVERTER</span>
                </button>

                <button class="vc-nav-item" data-tab="arclength">
                    <span class="vc-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 22C6.5 22 2 17.5 2 12" />
                            <circle cx="12" cy="12" r="2" />
                            <path d="M12 2v2M22 12h-2" />
                        </svg>
                    </span>
                    <span class="vc-nav-label">ARC LENGTH</span>
                </button>

            </nav>
        </aside>

        <!-- ===== CALCULATOR PANELS ===== -->
        <div class="vc-calc-panel">

            <!-- 1. AIRFLOW -->
            <div class="vc-calc-card active" id="vc-tab-airflow">
                <h2 class="vc-calc-title"><span class="vc-title-bar"></span>Airflow Calculator</h2>
                <div class="vc-input-row">
                    <div class="vc-input-group">
                        <label>VELOCITY (M/S)</label>
                        <input type="number" id="vc-airflow-velocity" value="2.5" step="0.1" min="0">
                    </div>
                    <div class="vc-input-group">
                        <label>EFFECTIVE AREA (M²)</label>
                        <input type="number" id="vc-airflow-area" value="0.1" step="0.01" min="0">
                    </div>
                </div>
                <div class="vc-result-box">
                    <div class="vc-result-label">RESULTING AIRFLOW</div>
                    <div class="vc-result-value" id="vc-airflow-result">250.00 <span class="vc-result-unit">L/s</span>
                    </div>
                </div>
            </div>

            <!-- 2. DUCT SIZE -->
            <div class="vc-calc-card" id="vc-tab-ductsize">
                <h2 class="vc-calc-title"><span class="vc-title-bar"></span>Duct Sizing</h2>
                <div class="vc-input-row">
                    <div class="vc-input-group">
                        <label>WIDTH (MM)</label>
                        <input type="number" id="vc-duct-width" value="300" step="1" min="1">
                    </div>
                    <div class="vc-input-group">
                        <label>HEIGHT (MM)</label>
                        <input type="number" id="vc-duct-height" value="200" step="1" min="1">
                    </div>
                </div>
                <div class="vc-result-box">
                    <div class="vc-result-label">CIRCULAR EQUIVALENT (Ø)</div>
                    <div class="vc-result-value" id="vc-duct-result">266 <span class="vc-result-unit">mm</span></div>
                </div>
            </div>

            <!-- 3. PRESSURE -->
            <div class="vc-calc-card" id="vc-tab-pressure">
                <h2 class="vc-calc-title"><span class="vc-title-bar"></span>Pressure Conversion</h2>
                <div class="vc-input-row vc-single">
                    <div class="vc-input-group vc-full">
                        <input type="number" id="vc-pressure-pa" value="50" step="1" min="0" class="vc-big-input">
                    </div>
                </div>
                <div class="vc-result-box vc-two-col">
                    <div class="vc-result-col">
                        <div class="vc-result-label">MMWG</div>
                        <div class="vc-result-value" id="vc-pressure-mmwg">5.10</div>
                    </div>
                    <div class="vc-result-col">
                        <div class="vc-result-label">IN.W.G</div>
                        <div class="vc-result-value" id="vc-pressure-inwg">0.200</div>
                    </div>
                </div>
            </div>

            <!-- 4. FREE AREA -->
            <div class="vc-calc-card" id="vc-tab-freearea">
                <h2 class="vc-calc-title"><span class="vc-title-bar"></span>Free Area Calculator</h2>
                <div class="vc-input-row vc-three-col">
                    <div class="vc-input-group">
                        <label>W (mm)</label>
                        <input type="number" id="vc-free-w" value="600" step="1" min="1">
                    </div>
                    <div class="vc-input-group">
                        <label>H (mm)</label>
                        <input type="number" id="vc-free-h" value="600" step="1" min="1">
                    </div>
                    <div class="vc-input-group">
                        <label>Factor (%)</label>
                        <input type="number" id="vc-free-factor" value="0.7" step="0.01" min="0" max="1">
                    </div>
                </div>
                <div class="vc-result-box">
                    <div class="vc-result-label">EFFECTIVE FREE AREA</div>
                    <div class="vc-result-value" id="vc-freearea-result">0.252 <span class="vc-result-unit">m²</span>
                    </div>
                </div>
            </div>

            <!-- 5. UNIT CONVERTER -->
            <div class="vc-calc-card" id="vc-tab-unitconverter">
                <h2 class="vc-calc-title"><span class="vc-title-bar"></span>Flow Unit Converter</h2>
                <div class="vc-input-row vc-single">
                    <div class="vc-input-group vc-full">
                        <input type="number" id="vc-unit-ls" value="100" step="1" min="0" class="vc-big-input">
                    </div>
                </div>
                <div class="vc-result-box vc-two-col">
                    <div class="vc-result-col">
                        <div class="vc-result-label">CFM</div>
                        <div class="vc-result-value" id="vc-unit-cfm">211.8</div>
                    </div>
                    <div class="vc-result-col">
                        <div class="vc-result-label">M³/H</div>
                        <div class="vc-result-value" id="vc-unit-m3h">360.0</div>
                    </div>
                </div>
            </div>

            <!-- 6. ARC LENGTH -->
            <div class="vc-calc-card" id="vc-tab-arclength">
                <h2 class="vc-calc-title"><span class="vc-title-bar"></span>Arc Length Calculator</h2>
                <div class="vc-input-row">
                    <div class="vc-input-group">
                        <label>RADIUS (MM)</label>
                        <input type="number" id="vc-arc-radius" value="200" step="1" min="1">
                    </div>
                    <div class="vc-input-group">
                        <label>ANGLE (°)</label>
                        <input type="number" id="vc-arc-angle" value="90" step="1" min="0" max="360">
                    </div>
                </div>
                <div class="vc-result-box">
                    <div class="vc-result-label">ARC LENGTH</div>
                    <div class="vc-result-value" id="vc-arc-result">314.16 <span class="vc-result-unit">mm</span></div>
                </div>
            </div>

        </div><!-- .vc-calc-panel -->
    </div><!-- .vc-calc-wrap -->
</section><!-- .vc-calculators-section -->

<?php get_footer(); ?>