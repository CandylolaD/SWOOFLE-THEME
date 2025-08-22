<?php
/**
 * SWOOFLE Theme - Index Template
 * Fallback Template für alle Seiten
 */

get_header(); ?>

<?php if (is_front_page()): ?>
    <!-- Homepage Content -->
    <section class="hero-section" role="banner">
        <div class="hero-content">
            <!-- CTA-Buttons ganz oben -->
            <div class="hero-cta-buttons">
                <button class="cta-button glass-button" data-action="open-quick-booking" aria-describedby="booking-description">
                    INSTANTBOOKING
                </button>
                <a href="<?php echo esc_url(home_url('/manufaktur')); ?>" class="cta-button glass-button1" aria-describedby="manufaktur-description">
                    MANUFAKTUR 
                </a>
            </div>
            
            <!-- Text links oben -->
            <div class="hero-text">
                <h1 class="hero-title">Exklusiv. im Stil<br>Inklusiv. im Anspruch</h1>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="section" role="region" aria-labelledby="products-title">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" id="products-title">Unsere Produkte</h2>
                <p class="section-subtitle">
                    Entdecke unsere vielfältige Auswahl an nachhaltigen Mietmöbeln für jeden Anlass
                </p>
            </div>

            <div class="product-grid">
                <article class="product-card" data-action="open-quick-booking" data-category="flatcubes" tabindex="0" role="button" aria-label="FlatCube Produktdetails und Buchung">
                    <div class="product-image" role="img" aria-label="FlatCube Produktbild">
                        <?php 
                        $flatcube_image = get_template_directory_uri() . '/assets/img/flatcube.png';
                        if (file_exists(get_template_directory() . '/assets/img/flatcube.png')): ?>
                            <img src="<?php echo esc_url($flatcube_image); ?>" alt="FlatCube" />
                        <?php else: ?>
                            <span>FLATCUBE</span>
                        <?php endif; ?>
                    </div>
                    <h3>FLATCUBE</h3>
                    <p>Modulare Sitzwürfel in verschiedenen Farben. Platzsparend, leicht und vielseitig - perfekt für Events und flexible Raumgestaltung.</p>
                </article>
                
                <article class="product-card" data-action="open-quick-booking" data-category="accessories" tabindex="0" role="button" aria-label="FlowerPot Produktdetails und Buchung">
                    <div class="product-image" role="img" aria-label="FlowerPot Produktbild">
                        <?php 
                        $flowerpot_image = get_template_directory_uri() . '/assets/img/flowerpot.png';
                        if (file_exists(get_template_directory() . '/assets/img/flowerpot.png')): ?>
                            <img src="<?php echo esc_url($flowerpot_image); ?>" alt="FlowerPot" />
                        <?php else: ?>
                            <span>FLOWERPOT</span>
                        <?php endif; ?>
                    </div>
                    <h3>FLOWERPOT</h3>
                    <p>Das vielseitige Deko-Element für dein Event. 3D-gedruckt in Berlin, nahezu unzerbrechlich und aus recycelbarem Filament.</p>
                </article>
                
                <article class="product-card" data-action="open-quick-booking" data-category="desks" tabindex="0" role="button" aria-label="Zubehör Produktdetails und Buchung">
                    <div class="product-image" role="img" aria-label="Zubehör Produktbild">
                        <?php 
                        $zubehoer_image = get_template_directory_uri() . '/assets/img/zubehoer.png';
                        if (file_exists(get_template_directory() . '/assets/img/zubehoer.png')): ?>
                            <img src="<?php echo esc_url($zubehoer_image); ?>" alt="Zubehör" />
                        <?php else: ?>
                            <span>ZUBEHÖR</span>
                        <?php endif; ?>
                    </div>
                    <h3>ZUBEHÖR</h3>
                    <p>FlatDesk und ThinkTable - die perfekten Ergänzungen zum FlatCube. Verwandle deinen Sitzwürfel in praktische Arbeits- und Kreativflächen.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section testimonials" role="region" aria-labelledby="testimonials-title">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" id="testimonials-title">Was unsere Kunden sagen</h2>
            </div>
            
            <div class="testimonial-carousel" role="group" aria-label="Kundenbewertungen" aria-live="polite">
                <blockquote class="testimonial active">
                    <p class="testimonial-text">"Swoofle hat unsere Veranstaltung zu einem echten Erfolg gemacht. Die Möbel sind hochwertig und das Service-Team ist fantastisch!"</p>
                    <cite class="testimonial-author">— Maria Schmidt, Event-Managerin</cite>
                </blockquote>
                
                <blockquote class="testimonial">
                    <p class="testimonial-text">"Die Flatcubes sind nicht nur funktional, sondern auch echte Hingucker. Unsere Gäste waren begeistert!"</p>
                    <cite class="testimonial-author">— Thomas Weber, Hochzeitsplaner</cite>
                </blockquote>
                
                <blockquote class="testimonial">
                    <p class="testimonial-text">"Schnelle Lieferung, einfache Buchung und top Qualität. Swoofle ist unser Go-to Partner für Mietmöbel!"</p>
                    <cite class="testimonial-author">— Anna Müller, Corporate Events</cite>
                </blockquote>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section" role="region" aria-labelledby="about-title">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" id="about-title">Über SWOOFLE</h2>
                <p class="section-subtitle">Design, Nachhaltigkeit und Verantwortung</p>
            </div>
            
            <div class="about-grid">
                <div class="about-text">
                    <h3>Unsere Mission</h3>
                    <p>Mit SWOOFLE wollen wir einen <span class="highlight">Mehrwert schaffen, der über das reine Produkt hinausgeht</span>. Wir entwickeln Möbel, die leicht, platzsparend und gleichzeitig stabil sind.</p>

                    <h3>Nachhaltig gedacht, regional gemacht</h3>
                    <p>Unsere Materialien stammen aus Deutschland und werden in Berlin verarbeitet. Durch kurze Lieferwege können wir unseren <span class="highlight">ökologischen Fußabdruck minimieren</span>.</p>

                    <h3>Inklusion als Kern unserer Arbeit</h3>
                    <p>Von Anfang an arbeiten wir eng mit <span class="highlight">Werkstätten für Menschen mit Behinderung</span> zusammen und fördern so echte Inklusion.</p>
                </div>

                <div class="about-visual">
                    <h3>Die Geschichte hinter SWOOFLE</h3>
                    <p>Gegründet 2013 von Georg Winkel, entstand SWOOFLE aus dem Wunsch, bessere, leichtere und flexiblere Lösungen für Events zu schaffen.</p>
                    <div style="margin: 24px 0; font-size: 12px; color: var(--text-tertiary);" role="img" aria-label="SWOOFLE Timeline">
                        <?php 
                        $timeline_image = get_template_directory_uri() . '/assets/img/timeline.png';
                        if (file_exists(get_template_directory() . '/assets/img/timeline.png')): ?>
                            <img src="<?php echo esc_url($timeline_image); ?>" alt="SWOOFLE Timeline" />
                        <?php else: ?>
                            <span>TIMELINE</span>
                        <?php endif; ?>
                    </div>
                    <p>Heute sind unsere FlatCubes, FlatDesks und weiteren Designmöbel europaweit auf Events im Einsatz.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section" role="region" aria-labelledby="faq-title">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" id="faq-title">Häufig gestellte Fragen</h2>
                <p class="section-subtitle">Alle wichtigen Informationen auf einen Blick</p>
            </div>
            
            <div class="faq-grid">
                <div class="faq-category">
                    <h3 class="faq-category-title">FlatCube</h3>
                    
                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-1">
                            Was ist der FlatCube?
                            <span class="faq-toggle" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer" id="faq-answer-1">
                            Der FlatCube ist ein faltbarer, nachhaltiger Hocker für Innen- und geschützte Außenbereiche. Er ist leicht, platzsparend und individuell gestaltbar.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-2">
                            Wie funktioniert die Vermietung?
                            <span class="faq-toggle" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer" id="faq-answer-2">
                            FlatCubes werden in Sets zu je 5 Stück vermietet. Mindestbestellmenge ist ein Set. Bei anderen Mengen wird auf volle Sets aufgerundet.
                        </div>
                    </div>
                </div>

                <div class="faq-category">
                    <h3 class="faq-category-title">Versand & Lieferung</h3>
                    
                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-3">
                            Welche Versandoptionen gibt es?
                            <span class="faq-toggle" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer" id="faq-answer-3">
                            Deutschland: Standard (11,95€), Express bis 10 Uhr (24,95€), bis 9 Uhr (29,95€), bis 8 Uhr (49,95€). Europa: Standard (39,95€), Overnight (79,95€) - alle Preise pro Set.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-4">
                            Was ist das Schutzpaket?
                            <span class="faq-toggle" aria-hidden="true">▼</span>
                        </button>
                        <div class="faq-answer" id="faq-answer-4">
                            Das Schutzpaket reduziert die Selbstbeteiligung auf 30% bei Beschädigung und 70% bei Verlust oder Diebstahl.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-sm" role="region" aria-labelledby="contact-title">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" id="contact-title">Kontakt</h2>
                <p class="section-subtitle">Hast du Fragen? Wir freuen uns auf deine Nachricht!</p>
            </div>
            
            <div class="about-grid">
                <div class="about-text">
                    <h3>SWOOFLE GmbH</h3>
                    <address>
                        <p><strong>Adresse:</strong><br>Musterstraße 123<br>10115 Berlin<br>Deutschland</p>
                        <p><strong>Kontakt:</strong><br>Telefon: <a href="tel:+493012345678">+49 (0) 30 12345678</a><br>E-Mail: <a href="mailto:info@swoofle.de">info@swoofle.de</a></p>
                    </address>
                </div>
                <div class="about-visual">
                    <div style="text-align: center;">
                        <h3>Jetzt buchen</h3>
                        <p style="margin-bottom: 24px;">Nutze unser InstantBooking-Tool für eine schnelle Buchung.</p>
                        <button class="btn btn-primary" data-action="open-quick-booking">
                            Booking starten
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php else: ?>
    <!-- Standard WordPress Loop für andere Seiten -->
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="container">
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>