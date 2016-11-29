
# [WP-rijkshuisstijl](https://digitaleoverheid.nl) - WordPress-theme voor Digitale Overheid

WP-rijkshuisstijl is ontwikkeld als WordPress-theme voor [digitaleoverheid.nl](https://digitaleoverheid.nl). Opdrachtgever is ICTU (ICT Uitvoeringsorganisatie). Ontwikkelaar is Paul van Buuren ([WBVB Rotterdam](https://wbvb.nl)). 

## Contact
* Victor Zuydweg
* Pim Nieuwenburg
* Paul van Buuren: paul@wbvb.nl

## Version history

* 0.7.15 - Kleine CSS bugs
* 0.7.14 - Contentblock kan dossiers tonen. Extra check op taxonomy contentblock toegevoegd.
* 0.7.13 - Contentblok-checker op diverse pagina's
* 0.7.12 - Added extra styling for &lt;table&gt;
* 0.7.11 - Contentblok check op dossier archive pages. 
* 0.7.10 - CSS: list item arrow, flex on .home, search form in header
* 0.7.9 - CSS for pagination updated
* 0.7.8 - Added message for no results on search page. Translations updated.
* 0.7.7 - Removed double paging block on archives
* 0.7.6 - Fixed text for 2nd menu item in dossiers
* 0.7.5 - Text changes ACF contentblock
* 0.7.4 - Added SVG icons
* 0.7.3 - contentblock revised 
* 0.7.2 - Search functions - paging 
* 0.7.1 - Search functions - search via SearchWP 
* 0.6.35 - Screen reader response added for CF7 
* 0.6.34 - Alt-attribute added to slider 
* 0.6.33 - Search results - mark PDF attachments 
* 0.6.32 - Incorrect styling for content without featured image corrected
* 0.6.31 - Rewrite rules added to prevent 404 after URL tampering 
* 0.6.30 - Event context added for a dossier 
* 0.6.29 - Paging on page_dossiersingleactueel.php 
* 0.6.28 - Check in dossier if menu item is parent of child page. Error
* 0.6.27 - Check on number of found document in dossier menu - bugfix 2 
* 0.6.26 - Check on number of found document in dossier menu - bugfix
* 0.6.25 - Check on number of found document in dossier menu. CSS bugfixes 
* 0.6.24 - Modified Event Widget, updated pagination - bugfixes 
* 0.6.23 - Modified Event Widget, updated pagination. Extra event funct 
* 0.6.22 - Script minification check. 
* 0.6.21 - IE8 checks, scripts concatenated 
* 0.6.20 - 01-home .blocks, pagination, 404 content list, translation u
* 0.6.19 - Form elements. Contact form validation. 
* 0.6.18 - CSS for news items widget. Styling for post-meta. Link colors.
* 0.6.17 - .slidenav corrected - bugfixes 
* 0.6.16 - .slidenav corrected 
* 0.6.15 - Kaderblok toegevoegd 
* 0.6.14 - genesis_entry_footer disabled 
* 0.6.13 - Improved dossier-helper-functions. Only direct descendants i 
* 0.6.12 - Removed post-meta. Added class .intro. Font-size check for H 
* 0.6.11 - Various small code and CSS bugfixes - widget, archive-loop 
* 0.6.10 - Various small code and CSS bugfixes 
* 0.6.9 - Renamed 'overzichtspagina' to 'inhoudspagina' in dossier 
* 0.6.8 - Editor styles: &lt;div&gt; warning added 
* 0.6.7 - Widget title: less padding between widgets 
* 0.6.6 - Widget title: class always widgettitle (not: widget-title) 
* 0.6.5 - News widget aangepast (banner-border weg) 
* 0.6.4 - (temporary) remove relevante links CPT 
* 0.6.3 - Remove Genesis SEO in-post options 
* 0.6.2 - Bugfix: Footerwidgets weer zichtbaar 
* 0.6.1 - Editor CSS: beperkingen en waarschuwingen 
* 0.5.1 - Carrousel, js-actions - bugfixes 
* 0.4.3 - Carrousel, js-actions 
* 0.4.2 - Theme-check, carrousel en extra pagina-layout - bugfixes 
* 0.4.1 - Theme-check, carrousel en extra pagina-layout 


## Theme structure

```shell
themes/wp-rijkshuisstijl/                     # → Folder met alle theme-bestanden
├── css/                                      # → Extra CSS-bestanden
│   ├── debug-css.css                         # → CSS voor debugging (header-niveaus etc)
│   ├── editor-styles.css                     # → CSS voor juist tonen van vormgeving in WYSIWIG-editor in admin
│   ├── header.css                            # → CSS voor debugging (header-niveaus etc)
│   ├── revenge.css                           # → CSS voor debugging (lege elementen etc)
│   └── style-for-banner.css                  # → placeholder bestand om extra css in <style> op te namen
├── fonts/                                    # → Webfonts
│   ├── ro-icons.eot                          # → Icon font
│   ├── ro-icons.ttf                          # → Icon font
│   ├── ro-icons.woff                         # → Icon font
│   ├── ro-sanswebtext-bold-webfont.eot       # → Embedded OpenType RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.eot       # → Embedded OpenType RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.svg       # → SVG RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.ttf       # → True Type RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.woff      # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.woff2     # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.eot     # → Embedded OpenType RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.svg     # → SVG RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.ttf     # → True Type RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.woff    # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.woff2   # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.eot    # → Embedded OpenType RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.svg    # → SVG RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.ttf    # → True Type RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.woff   # → Web Open Font Forma RO Sans Web
│   └── ro-sanswebtext-regular-webfont.woff2  # → Web Open Font Forma RO Sans Web
├── images/                                   # → Theme-gerelateerde beeldbestanden
│   └── svg/                                  # → SVG plaatjes
├── includes/                                 # → Bevat settings voor o.m. javascript-check
│   ├── admin-helper-functions.php            # → functies voor wp-admin 
│   ├── class.taxonomy-single-term.php        # → functies voor wel of niet tonen van radiobuttons voor dossier
│   ├── contact-form7-validation.php          # → validatie voor CF7
│   ├── cpt-acf.php                           # → definities van custom post types, custom taxonomies, ACF-velden
│   ├── dossier-helper-functions.php          # → functies voor werken met dossiers aan de front-end
│   ├── event-manager-functions.php           # → functies / filters tbv de event-plugin
│   ├── metadata-boxes.php                    # → custom velden
│   ├── nojs.php                              # → include voor check of JS wel / niet aan staat
│   ├── walker.taxonomy-single-term.php       # → hoort bij class.taxonomy-single-term.php
│   ├── widget-banner.php                     # → widget voor banner
│   ├── widget-events.php                     # → widget voor events
│   ├── widget-home.php                       # → widget voor gebruik op home widget area
│   ├── widget-newswidget.php                 # → widget voor tonen van berichten
│   └── widget-paginalinks.php                # → widget voor tonen van bijbehorende paginalinks
├── js/                                       # → Bevat javascript
├── languages/                                # → Bevat vertalingen voor het theme
├── less/                                     # → LESS-bronbestanden
├── plugins/                                  # → ruimte voor o.m. extra styling t.b.v. event plugin
│  
├── 404.php                                   # → Afhandeling voor niet-gevonden pagina's
├── archive.php                               # → Algemeen berichten-overzicht
├── front-page.php                            # → Algemene functies, theme includes
├── functions.php                             # → Algemene functies, theme includes
├── page_dossier-document-overview.php        # → 
├── page_dossier-events-overview.php          # → 
├── page_dossiersingleactueel.php             # → 
├── page_evenement.php                        # → 
├── page_show-child-pages.php                 # → 
├── page_showalldossiers.php                  # → 
├── page_sitemap.php                          # → Pagina voor het tonen van een sitemap
├── page.php                                  # → Algemene contentpagina
├── screenshot.png                            # → Theme screenshot voor in WP admin
├── search.php                                # → Toont zoekresultaten
├── sidebar.php                               # → Code voor custom sidebar
├── sidebar-alt.php                           # → Code voor custom sidebar
├── style.css                                 # → Bevat alle CSS (wordt samengesteld via LESS)
└── taxonomy.php                              # → Code voor het tonen van een taxonomie

```

