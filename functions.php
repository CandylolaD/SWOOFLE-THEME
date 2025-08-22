<?php
/**
 * SWOOFLE WordPress Theme - Functions.php
 * Vollständige Theme-Setup mit Oxygen/Breakdance Integration
 */

// Sicherheitscheck
if (!defined('ABSPATH')) {
    exit;
}

// Theme Setup
function swoofle_theme_setup() {
    // Theme Support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 40,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form', 
        'comment-form', 
        'comment-list', 
        'gallery', 
        'caption'
    ));
    add_theme_support('custom-background');
    add_theme_support('customize-selective-refresh-widgets');
    
    // RSS Feed Links
    add_theme_support('automatic-feed-links');
    
    // Menus registrieren
    register_nav_menus(array(
        'primary' => 'Hauptnavigation',
        'footer' => 'Footer Navigation'
    ));
    
    // Bildgrößen
    add_image_size('swoofle-thumbnail', 300, 200, true);
    add_image_size('swoofle-medium', 600, 400, true);
    add_image_size('swoofle-large', 1200, 800, true);
}
add_action('after_setup_theme', 'swoofle_theme_setup');

// CSS und JavaScript einbinden
function swoofle_enqueue_assets() {
    // Version basierend auf Datei-Änderungszeit für Cache-Busting
    $theme_version = wp_get_theme()->get('Version');
    
    // Google Fonts
    wp_enqueue_style(
        'swoofle-fonts', 
        'https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300;400;500;600&display=swap',
        array(),
        null
    );
    
    // CSS Files (in der richtigen Reihenfolge!)
    wp_enqueue_style(
        'swoofle-base', 
        get_template_directory_uri() . '/assets/css/shared-base.css', 
        array('swoofle-fonts'), 
        $theme_version
    );
    
    // Oxygen/Breakdance Kompatibilität
    wp_enqueue_style(
        'swoofle-compatibility', 
        get_template_directory_uri() . '/assets/css/oxygen-compatibility.css', 
        array('swoofle-base'), 
        $theme_version
    );
    
    // Seitenspezifische CSS
    if (is_front_page()) {
        wp_enqueue_style(
            'swoofle-index', 
            get_template_directory_uri() . '/assets/css/index-specific.css', 
            array('swoofle-base'), 
            $theme_version
        );
        wp_enqueue_script(
            'swoofle-index-js', 
            get_template_directory_uri() . '/assets/js/script.js', 
            array(), 
            $theme_version, 
            true
        );
    }
    
    if (is_page('booking') || is_page('instantbooking') || is_page_template('page-booking.php')) {
        wp_enqueue_style(
            'swoofle-booking', 
            get_template_directory_uri() . '/assets/css/booking.css', 
            array('swoofle-base'), 
            $theme_version
        );
        wp_enqueue_script(
            'swoofle-booking-js', 
            get_template_directory_uri() . '/assets/js/booking.js', 
            array(), 
            $theme_version, 
            true
        );
    }
    
    // Theme Switcher für alle Seiten
    wp_enqueue_script(
        'swoofle-theme-switcher', 
        get_template_directory_uri() . '/assets/js/theme-switcher.js', 
        array(), 
        $theme_version, 
        true
    );
    
    // Header Scroll Script für index
    if (is_front_page()) {
        wp_enqueue_script(
            'swoofle-header-scroll', 
            get_template_directory_uri() . '/assets/js/headerScroll.js', 
            array(), 
            $theme_version, 
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'swoofle_enqueue_assets');

// Custom Post Types für Produkte
function swoofle_register_post_types() {
    register_post_type('swoofle_product', array(
        'label' => 'Produkte',
        'labels' => array(
            'name' => 'Produkte',
            'singular_name' => 'Produkt',
            'add_new' => 'Neues Produkt',
            'add_new_item' => 'Neues Produkt hinzufügen',
            'edit_item' => 'Produkt bearbeiten',
            'new_item' => 'Neues Produkt',
            'view_item' => 'Produkt ansehen',
            'search_items' => 'Produkte suchen',
            'not_found' => 'Keine Produkte gefunden',
            'not_found_in_trash' => 'Keine Produkte im Papierkorb gefunden'
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'menu_icon' => 'dashicons-products',
        'show_in_rest' => true, // Für Gutenberg/Oxygen
        'rewrite' => array('slug' => 'produkte'),
        'capability_type' => 'post',
        'menu_position' => 20
    ));
    
    // Custom Taxonomy für Produktkategorien
    register_taxonomy('product_category', 'swoofle_product', array(
        'label' => 'Produktkategorien',
        'labels' => array(
            'name' => 'Produktkategorien',
            'singular_name' => 'Produktkategorie',
            'add_new_item' => 'Neue Kategorie hinzufügen',
            'edit_item' => 'Kategorie bearbeiten'
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'produkt-kategorie')
    ));
}
add_action('init', 'swoofle_register_post_types');

// Custom Fields für Produkte (ACF Integration)
function swoofle_register_product_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_swoofle_products',
            'title' => 'Produkt Details',
            'fields' => array(
                array(
                    'key' => 'field_product_price',
                    'label' => 'Preis pro Tag',
                    'name' => 'product_price',
                    'type' => 'number',
                    'step' => 0.01,
                    'min' => 0,
                    'append' => '€',
                    'instructions' => 'Preis pro Tag für dieses Produkt'
                ),
                array(
                    'key' => 'field_product_availability',
                    'label' => 'Verfügbarkeit',
                    'name' => 'product_availability',
                    'type' => 'number',
                    'min' => 0,
                    'instructions' => 'Anzahl verfügbarer Einheiten'
                ),
                array(
                    'key' => 'field_product_category',
                    'label' => 'Produktkategorie',
                    'name' => 'product_category',
                    'type' => 'select',
                    'choices' => array(
                        'flatcubes' => 'FlatCubes',
                        'desks' => 'Desks & Tables',
                        'accessories' => 'Zubehör'
                    ),
                    'default_value' => 'flatcubes'
                ),
                array(
                    'key' => 'field_product_featured',
                    'label' => 'Hervorgehoben',
                    'name' => 'product_featured',
                    'type' => 'true_false',
                    'instructions' => 'Soll dieses Produkt hervorgehoben werden?'
                ),
                array(
                    'key' => 'field_product_specifications',
                    'label' => 'Produktspezifikationen',
                    'name' => 'product_specifications',
                    'type' => 'textarea',
                    'instructions' => 'Technische Details, Maße, etc.'
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'swoofle_product',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'swoofle_register_product_fields');

// Oxygen/Breakdance Kompatibilität
function swoofle_oxygen_compatibility() {
    // Stelle sicher, dass unsere CSS-Variablen auch in Oxygen verfügbar sind
    add_action('wp_head', function() {
        ?>
        <style id="swoofle-css-vars">
        :root {
            --swoofle-primary: #f2f1f8;
            --swoofle-secondary: #cececd;
            --swoofle-text-primary: #1d1d1f;
            --swoofle-text-secondary: #2b2b2b;
            --swoofle-accent: #d3271b;
            --swoofle-accent-orange: #d3271b;
            --swoofle-radius-md: 12px;
            --swoofle-radius-lg: 18px;
            --swoofle-space-4: 1rem;
            --swoofle-space-6: 1.5rem;
            --swoofle-space-8: 2rem;
            --swoofle-transition-normal: 0.3s ease;
        }
        [data-theme="dark"] {
            --swoofle-primary: #2c2c2c;
            --swoofle-secondary: #5e5e5f;
            --swoofle-text-primary: #f5f5f7;
            --swoofle-text-secondary: #d8d8d9;
            --swoofle-accent: #fa612a;
        }
        </style>
        <?php
    }, 1);
}
add_action('init', 'swoofle_oxygen_compatibility');

// Fallback Navigation Menu
function swoofle_fallback_menu() {
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>">Startseite</a>
    <a href="<?php echo esc_url(home_url('/#products')); ?>">Produkte</a>
    <a href="<?php echo esc_url(home_url('/booking')); ?>">InstantBooking</a>
    <a href="<?php echo esc_url(home_url('/customersupport')); ?>">Support</a>
    <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
    <?php
}

// API Endpoints für Booking System
function swoofle_register_api_routes() {
    register_rest_route('swoofle/v1', '/booking/check-availability', array(
        'methods' => 'POST',
        'callback' => 'swoofle_check_availability',
        'permission_callback' => '__return_true',
        'args' => array(
            'start_date' => array(
                'required' => true,
                'type' => 'string',
                'format' => 'date',
            ),
            'end_date' => array(
                'required' => true,
                'type' => 'string',
                'format' => 'date',
            ),
            'categories' => array(
                'required' => false,
                'type' => 'array',
            ),
        ),
    ));
    
    register_rest_route('swoofle/v1', '/booking/create-reservation', array(
        'methods' => 'POST',
        'callback' => 'swoofle_create_reservation',
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'swoofle_register_api_routes');

// API Callback Funktionen
function swoofle_check_availability($request) {
    $start_date = sanitize_text_field($request->get_param('start_date'));
    $end_date = sanitize_text_field($request->get_param('end_date'));
    $categories = $request->get_param('categories') ?: array();
    
    // TODO: Implementierung der echten Verfügbarkeitsprüfung
    // Hier würde die Logik zur Prüfung der Produktverfügbarkeit stehen
    
    // Simulation für Demo
    $available_products = array();
    
    if (empty($categories) || in_array('flatcubes', $categories)) {
        $available_products['flatcubes'] = array(
            'available' => true,
            'quantity' => 15,
            'products' => array(
                'Flatcube Premium Black' => 10,
                'Flatcube Premium White' => 8,
                'Flatcube Premium Berry' => 3
            )
        );
    }
    
    if (empty($categories) || in_array('desks', $categories)) {
        $available_products['desks'] = array(
            'available' => true,
            'quantity' => 55,
            'products' => array(
                'FlatDesk' => 30,
                'ThinkTable' => 25
            )
        );
    }
    
    if (empty($categories) || in_array('accessories', $categories)) {
        $available_products['accessories'] = array(
            'available' => true,
            'quantity' => 50,
            'products' => array(
                'FlowerPot' => 50
            )
        );
    }
    
    return new WP_REST_Response(array(
        'available' => true,
        'message' => 'Verfügbar für den gewählten Zeitraum',
        'start_date' => $start_date,
        'end_date' => $end_date,
        'products' => $available_products
    ), 200);
}

function swoofle_create_reservation($request) {
    $reservation_data = $request->get_json_params();
    
    // TODO: Implementierung der echten Reservierungserstellung
    // Hier würde die Logik zur Speicherung der Reservierung stehen
    
    $reservation_code = 'SWF-' . strtoupper(substr(md5(time() . wp_rand()), 0, 6));
    
    // Simulation: Reservierung in WordPress speichern
    $reservation_post = wp_insert_post(array(
        'post_title' => 'Reservierung ' . $reservation_code,
        'post_content' => json_encode($reservation_data),
        'post_status' => 'private',
        'post_type' => 'swoofle_reservation'
    ));
    
    if ($reservation_post) {
        update_post_meta($reservation_post, 'reservation_code', $reservation_code);
        update_post_meta($reservation_post, 'reservation_data', $reservation_data);
    }
    
    return new WP_REST_Response(array(
        'reservation_code' => $reservation_code,
        'status' => 'created',
        'valid_until' => date('Y-m-d H:i:s', strtotime('+24 hours'))
    ), 200);
}

// Reservierungs-Post-Type
function swoofle_register_reservation_post_type() {
    register_post_type('swoofle_reservation', array(
        'label' => 'Reservierungen',
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-calendar-alt'
    ));
}
add_action('init', 'swoofle_register_reservation_post_type');

// AJAX Handler für Theme Speicherung
function swoofle_save_user_theme_preference() {
    check_ajax_referer('swoofle_nonce', 'nonce');
    
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $theme = sanitize_text_field($_POST['theme']);
        
        if (in_array($theme, array('light', 'dark'))) {
            update_user_meta($user_id, 'swoofle_theme_preference', $theme);
            wp_send_json_success(array('message' => 'Theme preference saved'));
        }
    }
    
    wp_send_json_error(array('message' => 'Could not save theme preference'));
}
add_action('wp_ajax_save_user_theme_preference', 'swoofle_save_user_theme_preference');
add_action('wp_ajax_nopriv_save_user_theme_preference', 'swoofle_save_user_theme_preference');

// AJAX Localize Script
function swoofle_localize_scripts() {
    $user_theme = '';
    if (is_user_logged_in()) {
        $user_theme = get_user_meta(get_current_user_id(), 'swoofle_theme_preference', true);
    }
    
    wp_localize_script('swoofle-theme-switcher', 'swoofle_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('swoofle_nonce'),
        'theme_preference' => $user_theme,
        'site_url' => home_url('/'),
        'template_url' => get_template_directory_uri()
    ));
    
    // Booking spezifische Daten
    if (is_page('booking') || is_page_template('page-booking.php')) {
        wp_localize_script('swoofle-booking-js', 'swoofle_booking', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'rest_url' => rest_url('swoofle/v1/'),
            'nonce' => wp_create_nonce('wp_rest'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'swoofle_localize_scripts');

// Admin-spezifische Styles
function swoofle_admin_styles() {
    wp_enqueue_style(
        'swoofle-admin', 
        get_template_directory_uri() . '/assets/css/admin-styles.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('admin_enqueue_scripts', 'swoofle_admin_styles');

// Widget Areas registrieren
function swoofle_register_widget_areas() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar-1',
        'description' => 'Haupt-Sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => 'Footer Widgets',
        'id' => 'footer-widgets',
        'description' => 'Widget-Bereich im Footer',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'swoofle_register_widget_areas');

// Customizer Settings
function swoofle_customize_register($wp_customize) {
    // Theme Options Section
    $wp_customize->add_section('swoofle_theme_options', array(
        'title' => 'SWOOFLE Theme Optionen',
        'priority' => 30,
    ));
    
    // Default Theme Mode
    $wp_customize->add_setting('swoofle_default_theme', array(
        'default' => 'light',
        'sanitize_callback' => 'swoofle_sanitize_theme_choice',
    ));
    
    $wp_customize->add_control('swoofle_default_theme', array(
        'label' => 'Standard Theme Modus',
        'section' => 'swoofle_theme_options',
        'type' => 'radio',
        'choices' => array(
            'light' => 'Hell',
            'dark' => 'Dunkel',
        ),
    ));
    
    // Contact Information
    $wp_customize->add_setting('swoofle_phone', array(
        'default' => '+49 (0) 30 12345678',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('swoofle_phone', array(
        'label' => 'Telefonnummer',
        'section' => 'swoofle_theme_options',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('swoofle_email', array(
        'default' => 'info@swoofle.de',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('swoofle_email', array(
        'label' => 'E-Mail Adresse',
        'section' => 'swoofle_theme_options',
        'type' => 'email',
    ));
}
add_action('customize_register', 'swoofle_customize_register');

// Sanitize Functions
function swoofle_sanitize_theme_choice($input) {
    $valid = array('light', 'dark');
    return in_array($input, $valid) ? $input : 'light';
}

// Body Classes
function swoofle_body_classes($classes) {
    // Theme Mode Class
    $default_theme = get_theme_mod('swoofle_default_theme', 'light');
    $classes[] = 'swoofle-' . $default_theme;
    
    // Page specific classes
    if (is_page('booking')) {
        $classes[] = 'swoofle-booking-page';
    }
    
    if (is_front_page()) {
        $classes[] = 'swoofle-homepage';
    }
    
    return $classes;
}
add_filter('body_class', 'swoofle_body_classes');

// Include Shortcodes
require_once get_template_directory() . '/inc/shortcodes.php';

// Include Helper Functions
require_once get_template_directory() . '/inc/helpers.php';

// Security Headers
function swoofle_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'swoofle_security_headers');

// Debug Information (nur für Development)
if (defined('WP_DEBUG') && WP_DEBUG) {
    function swoofle_debug_info() {
        if (current_user_can('manage_options')) {
            echo '<!-- SWOOFLE Theme Debug Info -->';
            echo '<!-- Theme Version: ' . wp_get_theme()->get('Version') . ' -->';
            echo '<!-- WordPress Version: ' . get_bloginfo('version') . ' -->';
        }
    }
    add_action('wp_footer', 'swoofle_debug_info');
}

?>