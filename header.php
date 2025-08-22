<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <?php if (is_front_page()): ?>
        <title>SWOOFLE - Mietmöbel Manufaktur | Nachhaltige Eventmöbel europaweit</title>
        <meta name="description" content="SWOOFLE FlatCube: Designmöbel, die dein Event prägen. Nachhaltig, faltbar, sofort buchbar und overnight geliefert. Für starke Markenauftritte und unvergessliche Events.">
        <meta name="keywords" content="Eventmöbel, FlatCube, Mietmöbel, nachhaltig, Berlin, Möbelverleih">
    <?php endif; ?>
    
    <meta name="author" content="SWOOFLE GmbH">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>">
    <meta name="theme-color" content="#fc3523">
    
    <!-- OpenGraph -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>">
    <meta property="og:locale" content="de_DE">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">

    <!-- Schema.org strukturierte Daten -->
    <?php if (is_front_page()): ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "SWOOFLE GmbH",
      "url": "<?php echo esc_url(home_url('/')); ?>",
      "logo": "<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/croppedlogoswoofle.png",
      "description": "Nachhaltige Eventmöbel-Vermietung mit FlatCubes, FlowerPots und Zubehör für Events europaweit",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Musterstraße 123",
        "addressLocality": "Berlin",
        "postalCode": "10115",
        "addressCountry": "DE"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+49-30-12345678",
        "contactType": "Kundenservice",
        "email": "info@swoofle.de",
        "availableLanguage": "de"
      },
      "sameAs": [
        "https://www.instagram.com/swoofle",
        "https://www.facebook.com/swoofle",
        "https://www.linkedin.com/company/swoofle"
      ],
      "offers": {
        "@type": "Offer",
        "category": "Eventmöbel-Vermietung",
        "businessFunction": "http://purl.org/goodrelations/v1#LeaseOut",
        "availability": "http://schema.org/InStock"
      }
    }
    </script>
    <?php endif; ?>

    <!-- Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "sfxag7z5wk");
    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header class="header" role="banner">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="logo">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/croppedlogoswoofle.png" alt="Swoofle Logo" class="logo-light">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logodarkmode.png" alt="Swoofle Logo" class="logo-dark">
                    <?php endif; ?>
                </div>
        
                <!-- Navigation -->
                <nav class="nav-menu" id="navMenu" role="navigation" aria-label="Hauptnavigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'nav-menu-list',
                        'container' => false,
                        'fallback_cb' => 'swoofle_fallback_menu'
                    ));
                    ?>
                </nav>

                <!-- Header Controls -->
                <div class="header-controls">
                    <button class="theme-toggle" data-action="toggle-theme" aria-label="Theme wechseln">
                        <span class="theme-icon">🌙</span>
                    </button>
                    <button class="hamburger" data-action="toggle-menu" aria-label="Menü öffnen" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content" role="main">
        <?php
        // Seitenspezifische Body-Klassen hinzufügen
        $page_slug = get_post_field('post_name', get_post());
        if ($page_slug) {
            echo '<div class="page-' . esc_attr($page_slug) . '">';
        }
        ?>