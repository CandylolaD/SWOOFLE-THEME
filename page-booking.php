<?php
/**
 * SWOOFLE Theme - Booking Page Template
 * Spezielles Template für die Booking-Seite
 * Template Name: Booking Page
 */

get_header(); ?>

<div class="booking-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>SWOOFLE RENT</h1>
            <p>Buche deine Eventmöbel in einfachen Schritten</p>
        </div>

        <!-- Dynamic Stepper mit verbesserter Accessibility -->
        <div class="stepper" id="bookingStepper" role="navigation" aria-label="Buchungsfortschritt">
            <!-- Flow A: Von index.html (2 Schritte) -->
            <div class="stepper-variant flow-a" id="stepperFlowA" role="group" aria-label="2-Schritte Buchungsprozess">
                <div class="glass-step active" data-step="1" role="tab" aria-selected="true" aria-current="step">
                    <span class="step-number" aria-hidden="true">1</span>
                    <span class="step-label">Auswahl</span>
                </div>
                <div class="glass-step" data-step="2" role="tab" aria-selected="false" aria-current="false">
                    <span class="step-number" aria-hidden="true">2</span>
                    <span class="step-label">Übersicht</span>
                </div>
            </div>
            
            <!-- Flow B: Direkter Zugriff (3 Schritte) -->
            <div class="stepper-variant flow-b" id="stepperFlowB" role="group" aria-label="3-Schritte Buchungsprozess">
                <div class="glass-step active" data-step="1" role="tab" aria-selected="true" aria-current="step">
                    <span class="step-number" aria-hidden="true">1</span>
                    <span class="step-label">Verfügbarkeit</span>
                </div>
                <div class="glass-step" data-step="2" role="tab" aria-selected="false" aria-current="false">
                    <span class="step-number" aria-hidden="true">2</span>
                    <span class="step-label">Auswahl</span>
                </div>
                <div class="glass-step" data-step="3" role="tab" aria-selected="false" aria-current="false">
                    <span class="step-number" aria-hidden="true">3</span>
                    <span class="step-label">Übersicht</span>
                </div>
            </div>
        </div>

        <!-- Status Region für Screen Reader -->
        <div role="status" aria-live="polite" aria-atomic="true" class="sr-only"></div>

        <!-- Booking Content -->
        <div class="booking-content" role="tabpanel">
            
            <!-- Flow B - Schritt 1: Verfügbarkeitsprüfung (nur bei direktem Zugriff) -->
            <section class="step-content" data-step="availability" data-flow="b" aria-labelledby="availability-heading">
                <div class="availability-section">
                    <div class="section-card">
                        <h2 id="availability-heading">Verfügbarkeit prüfen</h2>
                        <p class="section-description">Gib deinen gewünschten Zeitraum an und wähle optional die passende Produktkategorien aus</p>
                        
                        <form class="availability-form" aria-label="Verfügbarkeitsprüfung Formular">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="directStartDate">Startdatum: <abbr title="Pflichtfeld" aria-label="Pflichtfeld">*</abbr></label>
                                    <input type="date" id="directStartDate" class="date-input-large" required aria-required="true" aria-describedby="date-format-help">
                                </div>
                                <div class="form-group">
                                    <label for="directEndDate">Enddatum: <abbr title="Pflichtfeld" aria-label="Pflichtfeld">*</abbr></label>
                                    <input type="date" id="directEndDate" class="date-input-large" required aria-required="true" aria-describedby="date-format-help">
                                </div>
                            </div>
                            <span id="date-format-help" class="help-text">Format: TT.MM.JJJJ</span>
                            
                            <div class="form-group">
                                <fieldset>
                                    <legend>Gewünschte Produktkategorien (optional):</legend>
                                    <div class="category-selection-grid" role="group">
                                        <label class="category-card-selection">
                                            <input type="checkbox" value="flatcubes" name="categories" aria-describedby="flatcubes-desc">
                                            <div class="category-content">
                                                <div class="category-icon">🪑</div>
                                                <span class="category-name">FlatCubes</span>
                                                <span class="category-price">ab 87€/Set</span>
                                            </div>
                                        </label>
                                        <span id="flatcubes-desc" class="sr-only">Modulare Sitzwürfel ab 87€/Set/Tag</span>
                                        
                                        <label class="category-card-selection">
                                            <input type="checkbox" value="desks" name="categories" aria-describedby="desks-desc">
                                            <div class="category-content">
                                                <div class="category-icon">🗃️</div>
                                                <span class="category-name">Desks & Tables</span>
                                                <span class="category-price">ab 7,54€/Tag</span>
                                            </div>
                                        </label>
                                        <span id="desks-desc" class="sr-only">Tische und Schreibtische ab 7,54€/Tag</span>
                                        
                                        <label class="category-card-selection">
                                            <input type="checkbox" value="accessories" name="categories" aria-describedby="accessories-desc">
                                            <div class="category-content">
                                                <div class="category-icon">🪴</div>
                                                <span class="category-name">Zubehör</span>
                                                <span class="category-price">ab 5,95€/Tag</span>
                                            </div>
                                        </label>
                                        <span id="accessories-desc" class="sr-only">FlowerPots und weiteres Zubehör ab 5,95€/Tag</span>
                                    </div>
                                </fieldset>
                            </div>
                            
                            <div class="form-group">
                                <label for="directReservationCode">Falls du bereits einen Reservierungscode hast:</label>
                                <input type="text" id="directReservationCode" placeholder="SWF-ABC123" maxlength="12" aria-describedby="code-format-help">
                                <p id="code-format-help" class="help-text">Reservierungscode eingeben (Format: SWF-XXXXXX)</p>
                            </div>
                            
                            <button type="button" class="btn btn-primary btn-glass btn-block" id="checkDirectAvailability" disabled aria-busy="false">
                                Verfügbarkeit prüfen
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Schritt 1/2: Produktauswahl -->
            <section class="step-content" data-step="selection" aria-labelledby="selection-heading">
                <h2 id="selection-heading" class="sr-only">Produktauswahl</h2>
                
                <div class="step1-two-column-layout">
                    <!-- Linke Spalte: Datum, Reservierungscode UND Akkordeons -->
                    <div class="left-column">
                        <!-- Datum Info (bei Flow A) oder Änderung (bei Flow B) -->
                        <div class="section-card">
                            <h3>Dein Mietzeitraum</h3>
                            
                            <div class="selected-dates-display" id="selectedDatesDisplay" role="region" aria-label="Ausgewählter Mietzeitraum">
                                <div class="date-info">
                                    <span class="date-label">Von:</span>
                                    <span class="date-value" id="displayStartDate" aria-live="polite">--</span>
                                </div>
                                <div class="date-info">
                                    <span class="date-label">Bis:</span>
                                    <span class="date-value" id="displayEndDate" aria-live="polite">--</span>
                                </div>
                                <div class="date-info">
                                    <span class="date-label">Dauer:</span>
                                    <span class="date-value" id="displayDuration" aria-live="polite">-- Tage</span>
                                </div>
                            </div>
                            
                            <!-- Flow B: Datum ändern möglich -->
                            <div class="date-change-section" id="dateChangeSection" style="display: none;">
                                <button class="btn btn-outline btn-sm" id="changeDatesBtn" aria-expanded="false" aria-controls="dateChangeForm">
                                    Datum ändern
                                </button>
                                
                                <div class="date-change-form" id="dateChangeForm" style="display: none;" role="region" aria-label="Datum ändern">
                                    <div class="date-inputs">
                                        <div class="date-input">
                                            <label for="newStartDate">Neues Startdatum:</label>
                                            <input type="date" id="newStartDate" class="date-input-large" aria-describedby="new-date-help">
                                        </div>
                                        <div class="date-input">
                                            <label for="newEndDate">Neues Enddatum:</label>
                                            <input type="date" id="newEndDate" class="date-input-large" aria-describedby="new-date-help">
                                        </div>
                                    </div>
                                    <span id="new-date-help" class="sr-only">Wähle neue Daten für deinen Mietzeitraum</span>
                                    <div class="date-change-actions">
                                        <button class="btn btn-primary btn-sm" id="updateDatesBtn">Aktualisieren</button>
                                        <button class="btn btn-outline btn-sm" id="cancelDateChangeBtn">Abbrechen</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="reservation-code-input" id="reservationCodeSection">
                                <label for="reservationCode">Reservierungscode (optional):</label>
                                <input id="reservationCode" placeholder="z.B. SWF-ABC123" type="text" aria-describedby="reservation-help"/>
                                <p id="reservation-help" class="help-text">Nicht sicher beim Datum? <a class="contact-link" href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontaktiere uns</a></p>
                            </div>
                        </div>

                        <!-- WordPress-Spezifischer Bereich für Oxygen/Breakdance -->
                        <div class="section-card">
                            <h3>Oxygen/Breakdance Bereich</h3>
                            <div class="wp-builder-content">
                                <?php
                                // Hier können Oxygen/Breakdance Inhalte eingefügt werden
                                // Oder Shortcodes für die Produktauswahl
                                echo do_shortcode('[swoofle_products limit="10" show_booking_button="false"]');
                                ?>
                            </div>
                        </div>

                        <!-- Produktauswahl Akkordeon -->
                        <div class="accordion-section" id="productAccordions" role="region" aria-label="Produkt- und Versandoptionen">
                            
                            <!-- FlatCubes Akkordeon -->
                            <div class="accordion-item" data-category="flatcubes">
                                <div class="accordion-header" data-action="toggle-accordion" role="button" aria-expanded="false" aria-controls="flatcubes-content">
                                    <div class="accordion-title-group">
                                        <span class="accordion-icon">🪑</span> 
                                        <h3>FlatCubes</h3>
                                    </div>
                                    <div class="accordion-controls">
                                        <button class="info-button" data-action="show-info" data-info="flatcubes" aria-label="Mehr Informationen über FlatCubes">
                                            <span aria-hidden="true">i</span>
                                        </button>
                                        <span class="accordion-toggle-icon" aria-hidden="true">▼</span>
                                    </div>
                                </div>
                                <div class="accordion-content" id="flatcubes-content" role="region" aria-labelledby="flatcubes-heading">
                                    <h4 id="flatcubes-heading" class="sr-only">FlatCube Produkte</h4>
                                    <div class="product-grid-simple">
                                        <!-- Die Produktliste wird hier durch JavaScript gefüllt oder kann durch WordPress-Posts ersetzt werden -->
                                        <?php
                                        // Beispiel: WordPress-Posts für Produkte
                                        $flatcube_products = new WP_Query(array(
                                            'post_type' => 'swoofle_product',
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'product_category',
                                                    'value' => 'flatcubes',
                                                    'compare' => '='
                                                )
                                            ),
                                            'posts_per_page' => -1
                                        ));
                                        
                                        if ($flatcube_products->have_posts()):
                                            while ($flatcube_products->have_posts()): $flatcube_products->the_post();
                                                $price = get_field('product_price');
                                                $availability = get_field('product_availability');
                                        ?>
                                            <div class="product-item-simple">
                                                <div class="product-info">
                                                    <div class="product-image-placeholder" role="img" aria-label="<?php the_title(); ?>">
                                                        <?php if (has_post_thumbnail()): ?>
                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                        <?php else: ?>
                                                            FC
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="product-details">
                                                        <div class="product-name"><?php the_title(); ?></div>
                                                        <?php if ($price): ?>
                                                            <div class="product-price"><?php echo number_format($price, 2); ?>€/Set/Tag</div>
                                                        <?php endif; ?>
                                                        <?php if ($availability): ?>
                                                            <div class="product-availability" aria-live="polite"><?php echo $availability; ?> Sets verfügbar</div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="product-quantity" role="group" aria-label="Menge für <?php the_title(); ?>">
                                                    <button class="quantity-btn" data-action="update-quantity" data-product="<?php the_title(); ?>" data-delta="-1" aria-label="Menge verringern">−</button>
                                                    <input class="quantity-input" min="0" max="<?php echo $availability; ?>" type="number" value="0" data-product="<?php the_title(); ?>" aria-label="Anzahl <?php the_title(); ?> Sets"/>
                                                    <button class="quantity-btn add" data-action="update-quantity" data-product="<?php the_title(); ?>" data-delta="1" aria-label="Menge erhöhen">+</button>
                                                </div>
                                            </div>
                                        <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Weitere Akkordeons können hier hinzugefügt werden -->
                            
                        </div>
                    </div>

                    <!-- Rechte Spalte: Live Übersicht -->
                    <div class="right-column">
                        <aside class="live-summary" role="complementary" aria-labelledby="summary-title">
                            <h3 id="summary-title">Zusammenfassung deiner Auswahl</h3>
                            <div class="summary-content">
                                <div class="summary-item">
                                    <span>Zeitraum:</span>
                                    <span id="selectedDateRange" aria-live="polite">Bitte Datum wählen</span>
                                </div>
                                <div class="summary-item">
                                    <span>Ausgewählte Artikel:</span>
                                    <span id="selectedItemsCount" aria-live="polite">0</span>
                                </div>
                                <div class="summary-item total">
                                    <span>Geschätzte Gesamtsumme:</span>
                                    <span id="estimatedTotal" aria-live="polite">0,00€</span>
                                </div>
                            </div>
                            
                            <button class="btn btn-primary btn-glass btn-block" data-action="next-step" id="proceedToSummary" disabled aria-busy="false">
                                Zur Übersicht
                            </button>
                        </aside>
                    </div>
                </div>
            </section>

            <!-- Schritt 2/3: Gesamtübersicht mit Reservierungscode -->
            <section class="step-content" data-step="summary" aria-labelledby="summary-main-heading">
                <h2 id="summary-main-heading" class="sr-only">Buchungsübersicht und Bestätigung</h2>
                
                <!-- Verbesserte Reservierungscode Anzeige -->
                <div class="reservation-display" style="display: none; opacity: 0;" id="reservationCodeDisplay" role="region" aria-label="Dein Reservierungscode">
                    <h3>Dein Reservierungscode</h3>
                    <div class="reservation-code-display" id="generatedReservationId" aria-live="polite" aria-atomic="true"></div>
                    <p>Dieser Code ist 24 Stunden gültig. Bitte notiere ihn dir für deine Unterlagen.</p>
                    <button class="copy-code-btn" id="copyReservationId" aria-label="Reservierungscode in Zwischenablage kopieren">
                        📋 Code kopieren
                    </button>
                </div>

                <div class="final-summary-layout">
                    <div class="final-summary-card">
                        <h2>Buchungsübersicht</h2>
                        
                        <div class="summary-sections">
                            <section class="summary-section" aria-labelledby="timeframe-title">
                                <h4 id="timeframe-title">Zeitraum</h4>
                                <div class="summary-details">
                                    <p><strong>Start:</strong> <span id="finalStartDate">--</span></p>
                                    <p><strong>Ende:</strong> <span id="finalEndDate">--</span></p>
                                    <p><strong>Dauer:</strong> <span id="finalDuration">-- Tage</span></p>
                                </div>
                            </section>
                            
                            <section class="summary-section" aria-labelledby="products-title-final">
                                <h4 id="products-title-final">Produkte</h4>
                                <div class="summary-details">
                                    <ul id="finalProductList" role="list">
                                        <li>Keine Produkte ausgewählt</li>
                                    </ul>
                                </div>
                            </section>
                            
                            <section class="summary-section cost-breakdown" aria-labelledby="costs-title">
                                <h4 id="costs-title">Kostenaufstellung</h4>
                                <div class="cost-details">
                                    <div class="cost-item">
                                        <span>Produkte:</span>
                                        <span id="finalProductCost" aria-label="Produktkosten">0,00€</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Versand:</span>
                                        <span id="finalShippingCost2" aria-label="Versandkosten">11,95€</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Schutzpaket:</span>
                                        <span id="finalInsuranceCost2" aria-label="Schutzpaket Kosten">0,00€</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>Zwischensumme:</span>
                                        <span id="finalSubtotal" aria-label="Zwischensumme">11,95€</span>
                                    </div>
                                    <div class="cost-item">
                                        <span>MwSt. (19%):</span>
                                        <span id="finalVat" aria-label="Mehrwertsteuer">2,27€</span>
                                    </div>
                                    <div class="cost-item total" role="status" aria-live="polite">
                                        <span>Gesamtsumme:</span>
                                        <span id="finalTotal" aria-label="Gesamtsumme inklusive Mehrwertsteuer">14,22€</span>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="final-actions" role="group" aria-label="Buchungsaktionen">
                            <button class="btn btn-primary btn-glass btn-large" data-action="complete-purchase" aria-busy="false">
                                Jetzt kaufen
                            </button>
                            <button class="btn btn-outline btn-large" data-action="generate-offer" aria-busy="false">
                                Angebot drucken
                            </button>
                            <button class="btn btn-outline" data-action="prev-step">
                                Zurück zur Auswahl
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Info Popups -->
<div class="info-popup" id="infoPopup" style="display: none;" role="dialog" aria-labelledby="infoTitle" aria-modal="true" aria-hidden="true">
    <div class="info-popup-content">
        <div class="info-popup-header">
            <h4 id="infoTitle">Information</h4>
            <button class="close-info" data-action="close-info" aria-label="Information schließen">×</button>
        </div>
        <div class="info-popup-body" id="infoContent" role="document">
            <!-- Inhalt wird dynamisch geladen -->
        </div>
        <div class="info-popup-footer">
            <a href="<?php echo esc_url(home_url('/customersupport')); ?>" class="help-link">Mehr Informationen findest du im Supportbereich</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>