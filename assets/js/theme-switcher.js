// ===== WORDPRESS THEME SWITCHER ===== 
// Kombiniert Theme-Switching mit WordPress-Kompatibilität

class SwoofleThemeManager {
    constructor() {
        this.currentTheme = localStorage.getItem('swoofle-theme') || 'light';
        this.init();
    }

    init() {
        // Theme beim Laden setzen
        this.applyTheme(this.currentTheme);
        
        // Event Listeners
        this.setupEventListeners();
        
        // WordPress Admin Bar berücksichtigen
        this.handleWordPressElements();
        
        // Builder-Kompatibilität
        this.handleBuilderCompatibility();
        
        console.log('🎨 SWOOFLE Theme Manager initialisiert');
    }

    setupEventListeners() {
        // Theme Toggle Buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('[data-action="toggle-theme"]')) {
                e.preventDefault();
                this.toggleTheme();
            }
        });

        // Mobile Menu Handling (WordPress-kompatibel)
        document.addEventListener('click', (e) => {
            if (e.target.closest('[data-action="toggle-menu"]')) {
                e.preventDefault();
                this.toggleMobileMenu();
            }
            
            if (e.target.closest('[data-action="close-menu"]')) {
                this.closeMobileMenu();
            }
        });

        // WordPress Customizer Live Preview
        if (typeof wp !== 'undefined' && wp.customize) {
            wp.customize('swoofle_theme_mode', (value) => {
                value.bind((newTheme) => {
                    this.applyTheme(newTheme);
                });
            });
        }
    }

    toggleTheme() {
        this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.applyTheme(this.currentTheme);
        localStorage.setItem('swoofle-theme', this.currentTheme);
        
        // WordPress AJAX für persistente Speicherung (falls User eingeloggt)
        if (typeof swoofle_ajax !== 'undefined') {
            this.saveThemeToWordPress();
        }
        
        console.log('🎯 Theme gewechselt zu:', this.currentTheme);
    }

    applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        
        // Theme Icon aktualisieren
        this.updateThemeIcons(theme);
        
        // WordPress Body Classes
        document.body.classList.remove('swoofle-light', 'swoofle-dark');
        document.body.classList.add(`swoofle-${theme}`);
        
        // Oxygen/Breakdance Body Classes
        if (document.body.classList.contains('oxygen-body')) {
            document.body.classList.toggle('oxygen-dark', theme === 'dark');
        }
        
        if (document.body.classList.contains('breakdance')) {
            document.body.classList.toggle('breakdance-dark', theme === 'dark');
        }

        // Custom Event für andere Scripts
        document.dispatchEvent(new CustomEvent('swoofleThemeChanged', {
            detail: { theme: theme }
        }));
    }

    updateThemeIcons(theme) {
        const icons = document.querySelectorAll('.theme-icon');
        icons.forEach(icon => {
            icon.textContent = theme === 'dark' ? '☀️' : '🌙';
        });
    }

    saveThemeToWordPress() {
        fetch(swoofle_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'save_user_theme_preference',
                theme: this.currentTheme,
                nonce: swoofle_ajax.nonce
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('✅ Theme-Präferenz in WordPress gespeichert');
            }
        })
        .catch(error => {
            console.error('❌ Fehler beim Speichern der Theme-Präferenz:', error);
        });
    }

    toggleMobileMenu() {
        const hamburger = document.querySelector('.hamburger');
        const menu = document.querySelector('.nav-menu');
        
        // WordPress Menu
        const wpMenu = document.querySelector('.wp-nav-menu');
        
        if (hamburger) hamburger.classList.toggle('active');
        if (menu) menu.classList.toggle('active');
        if (wpMenu) wpMenu.classList.toggle('active');
        
        // ARIA Accessibility
        const isOpen = hamburger?.classList.contains('active');
        hamburger?.setAttribute('aria-expanded', isOpen);
        
        console.log(`📱 Mobile Menu ${isOpen ? 'geöffnet' : 'geschlossen'}`);
    }

    closeMobileMenu() {
        const hamburger = document.querySelector('.hamburger');
        const menu = document.querySelector('.nav-menu');
        const wpMenu = document.querySelector('.wp-nav-menu');
        
        if (hamburger) hamburger.classList.remove('active');
        if (menu) menu.classList.remove('active');
        if (wpMenu) wpMenu.classList.remove('active');
        
        hamburger?.setAttribute('aria-expanded', 'false');
    }

    handleWordPressElements() {
        // Admin Bar Berücksichtigung
        const adminBar = document.querySelector('#wpadminbar');
        const header = document.querySelector('.header');
        
        if (adminBar && header) {
            const adminBarHeight = adminBar.offsetHeight;
            header.style.top = `${adminBarHeight}px`;
        }

        // WordPress Widgets Theme-Support
        const widgets = document.querySelectorAll('.widget');
        widgets.forEach(widget => {
            widget.classList.add('swoofle-widget');
        });
    }

    handleBuilderCompatibility() {
        // Oxygen Builder
        if (document.body.classList.contains('oxygen-body')) {
            this.initOxygenCompatibility();
        }

        // Breakdance Builder
        if (document.body.classList.contains('breakdance')) {
            this.initBreakdanceCompatibility();
        }
    }

    initOxygenCompatibility() {
        // Warte auf Oxygen's DOM-Ready
        if (typeof OxygenBuilderFramework !== 'undefined') {
            OxygenBuilderFramework.addCallback('oxygen-ajax-element-loaded', () => {
                this.applyTheme(this.currentTheme);
            });
        }

        // Oxygen Custom CSS Injection
        const oxygenStyle = document.createElement('style');
        oxygenStyle.id = 'swoofle-oxygen-vars';
        oxygenStyle.textContent = `
            .ct-section { 
                --swoofle-current-theme: "${this.currentTheme}";
            }
        `;
        document.head.appendChild(oxygenStyle);

        console.log('🔧 Oxygen Kompatibilität aktiviert');
    }

    initBreakdanceCompatibility() {
        // Breakdance Theme Support
        const breakdanceStyle = document.createElement('style');
        breakdanceStyle.id = 'swoofle-breakdance-vars';
        breakdanceStyle.textContent = `
            .bde-section { 
                --swoofle-current-theme: "${this.currentTheme}";
            }
        `;
        document.head.appendChild(breakdanceStyle);

        console.log('🔧 Breakdance Kompatibilität aktiviert');
    }

    // Public API für externe Verwendung
    getCurrentTheme() {
        return this.currentTheme;
    }

    setTheme(theme) {
        if (['light', 'dark'].includes(theme)) {
            this.currentTheme = theme;
            this.applyTheme(theme);
            localStorage.setItem('swoofle-theme', theme);
        }
    }
}

// WordPress-spezifische Booking Integration
class SwoofleWordPressBooking {
    constructor() {
        this.apiBase = swoofle_ajax?.site_url + '/wp-json/swoofle/v1' || '/wp-json/swoofle/v1';
        this.init();
    }

    init() {
        // WordPress REST API Nonce
        this.nonce = swoofle_ajax?.nonce || '';
        
        // Quick Booking Modal Integration
        this.setupQuickBooking();
        
        console.log('📅 WordPress Booking System initialisiert');
    }

    setupQuickBooking() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('[data-action="open-quick-booking"]')) {
                e.preventDefault();
                this.openQuickBooking();
            }
        });
    }

    async checkAvailability(startDate, endDate, categories = []) {
        try {
            const response = await fetch(`${this.apiBase}/booking/check-availability`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': this.nonce
                },
                body: JSON.stringify({
                    start_date: startDate,
                    end_date: endDate,
                    categories: categories
                })
            });

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('❌ Verfügbarkeitsprüfung fehlgeschlagen:', error);
            return { available: false, error: error.message };
        }
    }

    async createReservation(bookingData) {
        try {
            const response = await fetch(`${this.apiBase}/booking/create-reservation`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': this.nonce
                },
                body: JSON.stringify(bookingData)
            });

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('❌ Reservierung fehlgeschlagen:', error);
            return { success: false, error: error.message };
        }
    }

    openQuickBooking() {
        // Integration mit bestehenden Booking-System
        if (typeof window.openQuickBooking === 'function') {
            window.openQuickBooking();
        } else {
            // Fallback: Weiterleitung zur Booking-Seite
            window.location.href = swoofle_ajax?.site_url + '/booking/';
        }
    }
}

// WordPress-spezifische Initialisierung
function initSwoofleWordPress() {
    // Theme Manager starten
    window.swoofleTheme = new SwoofleThemeManager();
    
    // WordPress Booking System (nur wenn benötigt)
    if (typeof swoofle_ajax !== 'undefined') {
        window.swoofleBooking = new SwoofleWordPressBooking();
    }
    
    // User Theme Preference laden (falls eingeloggt)
    if (typeof swoofle_ajax !== 'undefined' && swoofle_ajax.theme_preference) {
        window.swoofleTheme.setTheme(swoofle_ajax.theme_preference);
    }
    
    console.log('🚀 SWOOFLE WordPress Integration geladen');
}

// Initialisierung wenn DOM bereit ist
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSwoofleWordPress);
} else {
    initSwoofleWordPress();
}

// Export für Module (falls verwendet)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { SwoofleThemeManager, SwoofleWordPressBooking };
}