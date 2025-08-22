<?php
        // Schließe page-specific div
        $page_slug = get_post_field('post_name', get_post());
        if ($page_slug) {
            echo '</div>';
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>SWOOFLE</h4>
                    <a href="<?php echo esc_url(home_url('/#about')); ?>" data-action="close-menu">Über uns</a>
                    <a href="<?php echo esc_url(home_url('/karriere')); ?>">Karriere</a>
                    <a href="<?php echo esc_url(home_url('/presse')); ?>">Presse</a>
                    <a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a>
                </div>
                <div class="footer-section">
                    <h4>Service</h4>
                    <a href="<?php echo esc_url(home_url('/kontakt')); ?>">Kontakt</a>
                    <a href="<?php echo esc_url(home_url('/#faq')); ?>">FAQ</a>
                    <a href="<?php echo esc_url(home_url('/customersupport')); ?>">Support</a>
                    <a href="<?php echo esc_url(home_url('/2ndchance-shop')); ?>">2ndChance Shop</a>
                </div>
                <div class="footer-section">
                    <h4>Legal</h4>
                    <a href="<?php echo esc_url(home_url('/impressum')); ?>">Impressum</a>
                    <a href="<?php echo esc_url(home_url('/datenschutz')); ?>">Datenschutz</a>
                    <a href="<?php echo esc_url(home_url('/agb')); ?>">AGB</a>
                    <a href="<?php echo esc_url(home_url('/cookie-einstellungen')); ?>">Cookie-Einstellungen</a>
                </div>
                <div class="footer-section">
                    <h4>Folge uns</h4>
                    <a href="#" aria-label="SWOOFLE auf Instagram">Instagram</a>
                    <a href="#" aria-label="SWOOFLE auf Facebook">Facebook</a>
                    <a href="#" aria-label="SWOOFLE auf LinkedIn">LinkedIn</a>
                    <a href="#" aria-label="SWOOFLE auf YouTube">YouTube</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> SWOOFLE GmbH. Alle Rechte vorbehalten.</p>
            </div>
        </div>
    </footer>

    <!-- Chatbot -->
    <div class="chatbot" id="chatbot" role="complementary" aria-label="Chat-Assistent">
        <button class="chatbot-trigger" data-action="toggle-chatbot" aria-label="Chat öffnen">💬</button>
        
        <div class="chatbot-window" id="chatbotWindow" role="dialog" aria-labelledby="chatbot-title" aria-hidden="true">
            <div class="chatbot-header">
                <span id="chatbot-title"><strong>SWOOFY</strong> - Dein Assistent</span>
                <button data-action="toggle-chatbot" aria-label="Chat schließen" style="background: none; border: none; color: white; cursor: pointer;">×</button>
            </div>
            
            <div class="chatbot-messages" id="chatbotMessages" role="log" aria-live="polite">
                <div class="chatbot-message">
                    Hallo! Ich bin SWOOFY. Wie kann ich dir behilflich sein?
                </div>
            </div>
            
            <div class="chatbot-input">
                <label for="chatbotInput" class="sr-only">Nachricht eingeben</label>
                <input type="text" id="chatbotInput" placeholder="Deine Nachricht..." aria-describedby="chatbot-help">
                <div id="chatbot-help" class="sr-only">Drücke Enter zum Senden</div>
            </div>
        </div>
    </div>

    <!-- Quick Booking Modal für alle Seiten verfügbar -->
    <div class="quick-booking-modal" id="quickBookingModal" role="dialog" aria-labelledby="quick-booking-title" aria-hidden="true">
        <div class="quick-booking-container">
            <button class="close-modal" data-action="close-quick-booking" aria-label="Booking-Dialog schließen">×</button>
            
            <div class="quick-booking-header">
                <h2 id="quick-booking-title">SWOOFLE InstantBooking</h2>
                <p class="subtitle">Miete schnell & einfach in nur 2 Schritten</p>
            </div>
            
            <!-- Availability Check Flow -->
            <div class="availability-flow" id="availabilityFlow">
                <div class="availability-step active" data-step="select">
                    <h3>Schritt 1: Verfügbarkeit prüfen</h3>
                    
                    <div class="booking-options-layout">
                        <!-- Neue Buchung -->
                        <div class="booking-option">
                            <h4>Neue Buchung starten</h4>
                            <p>Wähle Zeitraum und gewünschte Produktkategorien</p>
                            
                            <div class="date-group">
                                <div class="date-input-quick">
                                    <label for="quickStartDate">Startdatum:</label>
                                    <input type="date" id="quickStartDate" required aria-describedby="date-help">
                                </div>
                                <div class="date-input-quick">
                                    <label for="quickEndDate">Enddatum:</label>
                                    <input type="date" id="quickEndDate" required aria-describedby="date-help">
                                </div>
                            </div>
                            <div id="date-help" class="help-text">Wähle deinen gewünschten Mietzeitraum</div>
                            
                            <div class="product-categories" id="productCategories">
                                <fieldset>
                                    <legend class="category-label">Gewünschte Produktkategorien (optional):</legend>
                                    <div class="category-grid">
                                        <div class="category-option">
                                            <input type="checkbox" id="cat-flatcubes" value="flatcubes">
                                            <label for="cat-flatcubes" class="category-card">
                                                <div class="category-icon" role="img" aria-label="FlatCube Icon">🪑</div>
                                                <span>FlatCubes</span>
                                                <small>ab 87€/Set</small>
                                            </label>
                                        </div>
                                        
                                        <div class="category-option">
                                            <input type="checkbox" id="cat-desks" value="desks">
                                            <label for="cat-desks" class="category-card">
                                                <div class="category-icon" role="img" aria-label="FlatDesk Icon">🗃️</div>
                                                <span>Desks</span>
                                                <small>ab 7,54€/Tag</small>
                                            </label>
                                        </div>
                                        
                                        <div class="category-option">
                                            <input type="checkbox" id="cat-accessories" value="accessories">
                                            <label for="cat-accessories" class="category-card">
                                                <div class="category-icon" role="img" aria-label="Zubehör Icon">🪴</div>
                                                <span>Zubehör</span>
                                                <small>ab 5,95€/Tag</small>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            
                            <button class="btn btn-primary btn-glass btn-block" id="checkAvailability" disabled>
                                Verfügbarkeit prüfen
                            </button>
                        </div>
                        
                        <!-- Reservierungscode -->
                        <div class="booking-option">
                            <h4>Du hast bereits ein Angebot erhalten?</h4>
                            <p>Gebe hier deinen Reservierungscode ein.</p>
                            
                            <div class="reservation-input-section">
                                <label for="quickReservationCode">Reservierungscode:</label>
                                <input type="text" id="quickReservationCode" placeholder="SWF-ABC123" maxlength="12" 
                                       pattern="SWF-[A-Z0-9]{6}" aria-describedby="code-help">
                                <div id="code-help" class="help-text">Format: SWF-ABC123</div>
                                <button class="btn btn-primary btn-glass btn-block" id="loadReservation" disabled>
                                    Code laden
                                </button>
                            </div>
                            
                            <div class="demo-codes" role="region" aria-labelledby="demo-title">
                                <h5 id="demo-title">Demo-Codes zum Testen:</h5>
                                <div class="demo-code-list">
                                    <button class="demo-code-btn" data-code="SWF-DEMO1" aria-describedby="demo1-desc">SWF-DEMO1</button>
                                    <span id="demo1-desc" class="demo-desc">2 FlatCube Sets + FlowerPots</span>
                                    
                                    <button class="demo-code-btn" data-code="SWF-DEMO2" aria-describedby="demo2-desc">SWF-DEMO2</button>
                                    <span id="demo2-desc" class="demo-desc">FlatCubes + Desks + Tables</span>
                                    
                                    <button class="demo-code-btn" data-code="SWF-TEST1" aria-describedby="demo3-desc">SWF-TEST1</button>
                                    <span id="demo3-desc" class="demo-desc">Berry FlatCubes + Express</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Trust Indicators -->
            <div class="trust-indicators" role="complementary" aria-label="Vertrauensmerkmale">
                <div class="trust-item">
                    <span class="trust-icon" role="img" aria-label="LKW Icon">🚚</span>
                    <span>Deutschlandweit</span>
                </div>
                <div class="trust-item">
                    <span class="trust-icon" role="img" aria-label="Blitz Icon">⚡</span>
                    <span>Express möglich</span>
                </div>
                <div class="trust-item">
                    <span class="trust-icon" role="img" aria-label="Schild Icon">🛡️</span>
                    <span>Schutzpaket</span>
                </div>
                <div class="trust-item">
                    <span class="trust-icon" role="img" aria-label="Recycling Icon">♻️</span>
                    <span>Nachhaltig</span>
                </div>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>