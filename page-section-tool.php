<?php

/**
 * Template Name: Projects Page
 *
 * Matches projects.tsx exactly:
 *  1. Page Header (NSW hero image background)
 *  2. "Discover our projects" heading
 *  3. Region filter bar: ALL / VIC / NSW / QLD
 *  4. 3-col card grid filtered by data-region attribute via JS
 *
 * The React useState filter is replaced by projects-filter.js
 * which reads data-region attributes and toggles card visibility.
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/page-header', null, [
    'title'     => 'Projects',
    'image_url' => ventech_image_url('region-nsw.jpg'),
]);

$regions = [
    ['key' => 'VIC', 'name' => 'Victoria',        'image' => ventech_image_url('project-victoriya.jpg')],
    ['key' => 'NSW', 'name' => 'New South Wales',  'image' => ventech_image_url('project-new-south-wales.jpg')],
    ['key' => 'QLD', 'name' => 'Queensland',       'image' => ventech_image_url('queensland.jpg')],
];
?>

<!-- ====================================================
     PROJECTS SECTION
     Matches: <section className="bg-background py-16">
     ==================================================== -->
<section class="section-projects-page">
    <div class="container">
        <h2 class="section-heading section-heading--lg text-center">
            Discover <span class="text-brand-blue">our projects</span>
        </h2>

        <!-- ===============================================
             REGION FILTER BAR
             Replaces React's useState filter.
             Active state managed by projects-filter.js.
             First button (ALL) starts as active.
             =============================================== -->
        <div class="filter-bar" role="group" aria-label="Filter projects by region">
            <button class="filter-btn is-active" data-filter="ALL" type="button">ALL</button>
            <button class="filter-btn" data-filter="VIC" type="button">VIC</button>
            <button class="filter-btn" data-filter="NSW" type="button">NSW</button>
            <button class="filter-btn" data-filter="QLD" type="button">QLD</button>
        </div>

        <!-- ===============================================
             PROJECTS GRID
             Each card has data-region="VIC|NSW|QLD" for JS filter.
             =============================================== -->
        <div class="projects-grid" id="projects-grid">
            <?php foreach ($regions as $region) : ?>
                <article class="project-card" data-region="<?php echo esc_attr($region['key']); ?>">

                    <div class="project-card__image-wrap">
                        <img src="<?php echo esc_url($region['image']); ?>" alt="<?php echo esc_attr($region['name']); ?>"
                            loading="lazy" width="1200" height="800">
                    </div>

                    <div class="project-card__footer">
                        <h3 class="project-card__name">
                            <?php echo esc_html($region['name']); ?>
                        </h3>
                        <span class="project-card__badge">
                            <?php echo esc_html($region['key']); ?>
                        </span>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>