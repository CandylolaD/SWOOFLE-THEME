<?php
/**
 * SWOOFLE Theme - Standard Page Template
 * Für normale WordPress-Seiten
 */

get_header(); ?>

<?php while (have_posts()): the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('swoofle-page'); ?>>
        <div class="container">
            <!-- Page Header -->
            <?php if (!is_front_page()): ?>
                <div class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php if (has_excerpt()): ?>
                        <p class="page-subtitle"><?php the_excerpt(); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="entry-content">
                <?php 
                the_content();
                
                // Wenn es ein mehrseitiger Beitrag ist
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'swoofle'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <!-- Custom Fields Support (für Oxygen/Breakdance) -->
            <?php if (function_exists('get_field')): ?>
                <?php 
                // Zusätzliche Inhalte über ACF Fields
                $additional_content = get_field('additional_content');
                if ($additional_content): ?>
                    <div class="additional-content">
                        <?php echo wp_kses_post($additional_content); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>