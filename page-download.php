<?php

/**
 * Template Name: download Page
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
    'title'     => 'Download',
    'image_url' => ventech_image_url('hero-ceiling.jpg'),
]);
?>


<!-- ====================================================
     SECTION 2: INTRO PARAGRAPH
     Matches: <section className="bg-background py-20">
     ==================================================== -->
<section class="download-section">
    <div class="container">
        <div class="tabs-header">
            <button class="tab-btn active" data-tab="tab-datasheets">Datasheets</button>
            <button class="tab-btn" data-tab="tab-brochures">Brochures</button>
            <button class="tab-btn" data-tab="tab-installation">Installation Guides</button>
            <button class="tab-btn" data-tab="tab-compliance">Compliance Certificates</button>
            <button class="tab-btn" data-tab="tab-cad">CAD Drawings</button>
            <button class="tab-btn" data-tab="tab-revit">Revit Files</button>
            <button class="tab-btn" data-tab="tab-technical">Technical Articles</button>
        </div>

        <div class="tabs-body">
            <div id="tab-datasheets" class="tab-panel active">
                <h3>Datasheets</h3>
                <p>Technical specifications and data sheets for all Ventech products.</p>
            </div>
            <div id="tab-brochures" class="tab-panel">
                <h3>Brochures</h3>
                <p>Download our latest product brochures in high-quality PDF format.</p>
            </div>
            <div id="tab-installation" class="tab-panel">
                <h3>Installation Guides</h3>
                <p>Step-by-step guides to ensure proper installation of your equipment.</p>
            </div>
            <div id="tab-compliance" class="tab-panel">
                <h3>Compliance Certificates</h3>
                <p>Official compliance documents and industry certifications.</p>
            </div>
            <div id="tab-cad" class="tab-panel">
                <h3>CAD Drawings</h3>
                <p>Precision CAD files for architectural and engineering planning.</p>
            </div>
            <div id="tab-revit" class="tab-panel">
                <h3>Revit Files</h3>
                <p>BIM-ready Revit files for your design integration.</p>
            </div>
            <div id="tab-technical" class="tab-panel">
                <h3>Technical Articles</h3>
                <p>In-depth technical insights and industry articles by our experts.</p>
            </div>
        </div>
    </div>
</section>





<?php get_footer(); ?>