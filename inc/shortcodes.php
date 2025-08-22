<?php
/**
 * SWOOFLE Shortcodes
 * Datei: inc/shortcodes.php
 */

// Sicherheitscheck
if (!defined('ABSPATH')) {
    exit;
}

// Hero Section Shortcode
function swoofle_hero_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Exklusiv. im Stil<br>Inklusiv. im Anspruch',
        'background' => 'woman.png',
        'show_buttons' => 'true'
    ), $atts);
    
    ob_start();
    ?>
    <section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo esc_attr($atts['background']); ?>') center/cover;">
        <div class="hero-content">
            <?php if ($atts['show_buttons'] === 'true'): ?>
            <div class="hero-cta-buttons">
                <button class="cta-button glass-button" data-action="open-quick-booking">
                    INSTANTBOOKING
                </button>
                <a href="<?php echo site_url('/manufaktur'); ?>" class="cta-button glass-button1">
                    MANUFAKTUR 
                </a>
            </div>
            <?php endif; ?>
            
            <div class="hero-text">
                <h1 class="hero-title"><?php echo wp_kses_post($atts['title']); ?></h1>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('swoofle_hero', 'swoofle_hero_shortcode');

// Produktgrid Shortcode
function swoofle_products_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 3,
        'category' => '',
        'show_booking_button' => 'true'
    ), $atts);
    
    $args = array(
        'post_type' => 'swoofle_product',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish'
    );
    
    if (!empty($atts['category'])) {
        $args['meta_query'] = array(
            array(
                'key' => 'product_category',
                'value' => $atts['category'],
                'compare' => '='
            )
        );
    }
    
    $products = new WP_Query($args);
    
    ob_start();
    ?>
    <div class="swoofle-product-grid">
        <?php if ($products->have_posts()): ?>
            <?php while ($products->have_posts()): $products->the_post(); ?>
                <article class="product-card" 
                         data-action="<?php echo $atts['show_booking_button'] === 'true' ? 'open-quick-booking' : ''; ?>" 
                         data-category="<?php echo esc_attr(get_field('product_category')); ?>" 
                         tabindex="0" 
                         role="button" 
                         aria-label="<?php the_title(); ?> Produktdetails und Buchung">
                    
                    <div class="product-image">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else: ?>
                            <span><?php echo strtoupper(substr(get_the_title(), 0, 2)); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    
                    <?php if (get_field('product_price')): ?>
                        <div class="product-price">ab <?php echo number_format(get_field('product_price'), 2); ?>€</div>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else: ?>
            <p>Keine Produkte gefunden.</p>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('swoofle_products', 'swoofle_products_shortcode');

// Booking Widget Shortcode
function swoofle_booking_widget_shortcode($atts) {
    $atts = shortcode_atts(array(
        'type' => 'quick',
        'title' => 'Jetzt buchen',
        'show_categories' => 'true'
    ), $atts);
    
    ob_start();
    ?>
    <div class="swoofle-booking-widget swoofle-glass-card">
        <h3><?php echo esc_html($atts['title']); ?></h3>
        
        <?php if ($atts['type'] === 'quick'): ?>
            <div class="booking-quick-form">
                <div class="date-inputs">
                    <input type="date" id="quick-start" placeholder="Startdatum" min="<?php echo date('Y-m-d'); ?>">
                    <input type="date" id="quick-end" placeholder="Enddatum" min="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <?php if ($atts['show_categories'] === 'true'): ?>
                <div class="category-selection">
                    <label><input type="checkbox" value="flatcubes"> FlatCubes</label>
                    <label><input type="checkbox" value="desks"> Desks & Tables</label>
                    <label><input type="checkbox" value="accessories"> Zubehör</label>
                </div>
                <?php endif; ?>
                
                <button class="btn btn-primary btn-glass" onclick="swoofleStartBooking()">
                    Verfügbarkeit prüfen
                </button>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
    function swoofleStartBooking() {
        const startDate = document.getElementById('quick-start').value;
        const endDate = document.getElementById('quick-end').value;
        const categories = Array.from(document.querySelectorAll('.category-selection input:checked')).map(cb => cb.value);
        
        let url = '<?php echo site_url("/booking/"); ?>?';
        if (startDate) url += 'startDate=' + encodeURIComponent(startDate) + '&';
        if (endDate) url += 'endDate=' + encodeURIComponent(endDate) + '&';
        if (categories.length > 0) url += 'categories=' + encodeURIComponent(categories.join(','));
        
        window.location.href = url;
    }
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('swoofle_booking', 'swoofle_booking_widget_shortcode');

// Theme Toggle Button Shortcode
function swoofle_theme_toggle_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text' => 'Theme wechseln',
        'position' => 'inline'
    ), $atts);
    
    $classes = 'theme-toggle';
    if ($atts['position'] === 'fixed') {
        $classes .= ' theme-toggle-fixed';
    }
    
    ob_start();
    ?>
    <button class="<?php echo esc_attr($classes); ?>" 
            data-action="toggle-theme" 
            aria-label="<?php echo esc_attr($atts['text']); ?>">
        <span class="theme-icon">🌙</span>
        <?php if ($atts['position'] === 'inline'): ?>
            <span class="theme-text"><?php echo esc_html($atts['text']); ?></span>
        <?php endif; ?>
    </button>
    <?php
    return ob_get_clean();
}
add_shortcode('swoofle_theme_toggle', 'swoofle_theme_toggle_shortcode');

?>