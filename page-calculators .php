<?php

/**
 * Template Name: calculators  Page
 *
 * Matches about.tsx exactly:
 *  1. Page Header (banner with hero image background)
 *  2. Intro paragraph (centered, with blue highlight)
 *  3. "Why Choose Us" blue section (2-col card grid)
 *  4. Head Office info (address, phone, email)
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/page-header', null, [
    'title'     => 'Calculators ',
    'image_url' => ventech_image_url('hero-ceiling.jpg'),
]);
?>


<!-- ====================================================
     SECTION 2: INTRO PARAGRAPH
     Matches: <section className="bg-background py-20">
     ==================================================== -->
<section>
    <!-- ===== HEADER ===== -->
    <header class="calculator-header">
        <div class="calculator-inner">
            <div class="brand">
                <span class="brand-eng">ENGINEERING</span>
                <span class="brand-calc">CALCULATORS</span>
            </div>
            <p class="brand-sub">Professional HVAC tools with instant results.</p>
        </div>
    </header>

    <!-- ===== MAIN LAYOUT ===== -->
    <main class="calc-layout">

        <!-- ===== SIDEBAR NAV ===== -->
        <aside class="calc-sidebar">
            <nav>
                <button class="nav-item active" data-tab="airflow">
                    <span class="nav-icon">
                        <!-- Airflow icon -->
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                            <path d="M3 6c0-1.1.9-2 2-2h4" />
                            <path d="M3 18c0 1.1.9 2 2 2h4" />
                        </svg>
                    </span>
                    <span class="nav-label">AIRFLOW</span>
                    <span class="nav-arrow">›</span>
                </button>

                <button class="nav-item" data-tab="ductsize">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                    </span>
                    <span class="nav-label">DUCT SIZE</span>
                </button>

                <button class="nav-item" data-tab="pressure">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path
                                d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" />
                        </svg>
                    </span>
                    <span class="nav-label">PRESSURE</span>
                </button>

                <button class="nav-item" data-tab="freearea">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                            <line x1="7" y1="7" x2="7.01" y2="7" />
                        </svg>
                    </span>
                    <span class="nav-label">FREE AREA</span>
                </button>

                <button class="nav-item" data-tab="unitconverter">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="17 1 21 5 17 9" />
                            <path d="M3 11V9a4 4 0 0 1 4-4h14" />
                            <polyline points="7 23 3 19 7 15" />
                            <path d="M21 13v2a4 4 0 0 1-4 4H3" />
                        </svg>
                    </span>
                    <span class="nav-label">UNIT CONVERTER</span>
                </button>

                <button class="nav-item" data-tab="arclength">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 22C6.5 22 2 17.5 2 12" />
                            <circle cx="12" cy="12" r="2" />
                            <path d="M12 2v2M22 12h-2" />
                        </svg>
                    </span>
                    <span class="nav-label">ARC LENGTH</span>
                </button>
            </nav>
        </aside>

        <!-- ===== CALCULATOR PANELS ===== -->
        <section class="calc-panel">

            <!-- AIRFLOW CALCULATOR -->
            <div class="calc-card active" id="tab-airflow">
                <h2 class="calc-title">
                    <span class="title-bar"></span>
                    Airflow Calculator
                </h2>
                <div class="input-row">
                    <div class="input-group">
                        <label>VELOCITY (M/S)</label>
                        <input type="number" id="airflow-velocity" value="2.5" step="0.1" min="0">
                    </div>
                    <div class="input-group">
                        <label>EFFECTIVE AREA (M²)</label>
                        <input type="number" id="airflow-area" value="0.1" step="0.01" min="0">
                    </div>
                </div>
                <div class="result-box">
                    <div class="result-label">RESULTING AIRFLOW</div>
                    <div class="result-value" id="airflow-result">250.00 <span class="result-unit">L/s</span></div>
                </div>
            </div>

            <!-- DUCT SIZE CALCULATOR -->
            <div class="calc-card" id="tab-ductsize">
                <h2 class="calc-title">
                    <span class="title-bar"></span>
                    Duct Sizing
                </h2>
                <div class="input-row">
                    <div class="input-group">
                        <label>WIDTH (MM)</label>
                        <input type="number" id="duct-width" value="300" step="1" min="1">
                    </div>
                    <div class="input-group">
                        <label>HEIGHT (MM)</label>
                        <input type="number" id="duct-height" value="200" step="1" min="1">
                    </div>
                </div>
                <div class="result-box">
                    <div class="result-label">CIRCULAR EQUIVALENT (Ø)</div>
                    <div class="result-value" id="duct-result">266 <span class="result-unit">mm</span></div>
                </div>
            </div>

            <!-- PRESSURE CONVERSION -->
            <div class="calc-card" id="tab-pressure">
                <h2 class="calc-title">
                    <span class="title-bar"></span>
                    Pressure Conversion
                </h2>
                <div class="input-row single">
                    <div class="input-group full">
                        <input type="number" id="pressure-pa" value="50" step="1" min="0" class="big-input">
                    </div>
                </div>
                <div class="result-box two-col">
                    <div class="result-col">
                        <div class="result-label">MMWG</div>
                        <div class="result-value" id="pressure-mmwg">5.10</div>
                    </div>
                    <div class="result-col">
                        <div class="result-label">IN.W.G</div>
                        <div class="result-value" id="pressure-inwg">0.200</div>
                    </div>
                </div>
            </div>

            <!-- FREE AREA CALCULATOR -->
            <div class="calc-card" id="tab-freearea">
                <h2 class="calc-title">
                    <span class="title-bar"></span>
                    Free Area Calculator
                </h2>
                <div class="input-row three-col">
                    <div class="input-group">
                        <label>W (mm)</label>
                        <input type="number" id="free-w" value="600" step="1" min="1">
                    </div>
                    <div class="input-group">
                        <label>H (mm)</label>
                        <input type="number" id="free-h" value="600" step="1" min="1">
                    </div>
                    <div class="input-group">
                        <label>Factor (%)</label>
                        <input type="number" id="free-factor" value="0.7" step="0.01" min="0" max="1">
                    </div>
                </div>
                <div class="result-box">
                    <div class="result-label">EFFECTIVE FREE AREA</div>
                    <div class="result-value" id="freearea-result">0.252 <span class="result-unit">m²</span></div>
                </div>
            </div>

            <!-- UNIT CONVERTER -->
            <div class="calc-card" id="tab-unitconverter">
                <h2 class="calc-title">
                    <span class="title-bar"></span>
                    Flow Unit Converter
                </h2>
                <div class="input-row single">
                    <div class="input-group full">
                        <input type="number" id="unit-ls" value="100" step="1" min="0" class="big-input">
                    </div>
                </div>
                <div class="result-box two-col">
                    <div class="result-col">
                        <div class="result-label">CFM</div>
                        <div class="result-value" id="unit-cfm">211.8</div>
                    </div>
                    <div class="result-col">
                        <div class="result-label">M³/H</div>
                        <div class="result-value" id="unit-m3h">360.0</div>
                    </div>
                </div>
            </div>

            <!-- ARC LENGTH CALCULATOR -->
            <div class="calc-card" id="tab-arclength">
                <h2 class="calc-title">
                    <span class="title-bar"></span>
                    Arc Length Calculator
                </h2>
                <div class="input-row">
                    <div class="input-group">
                        <label>RADIUS (MM)</label>
                        <input type="number" id="arc-radius" value="200" step="1" min="1">
                    </div>
                    <div class="input-group">
                        <label>ANGLE (°)</label>
                        <input type="number" id="arc-angle" value="90" step="1" min="0" max="360">
                    </div>
                </div>
                <div class="result-box">
                    <div class="result-label">ARC LENGTH</div>
                    <div class="result-value" id="arc-result">314.16 <span class="result-unit">mm</span></div>
                </div>
            </div>

        </section>
</section>





<?php get_footer(); ?>