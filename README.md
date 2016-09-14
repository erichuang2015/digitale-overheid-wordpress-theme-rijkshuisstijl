
# [WP-rijkshuisstijl](https://digitaleoverheid.nl) - WordPress-theme voor Digitale Overheid

WP-rijkshuisstijl is ontwikkeld als WordPress-theme voor [digitaleoverheid.nl](https://digitaleoverheid.nl). Opdrachtgever is ICTU (ICT Uitvoeringsorganisatie). Ontwikkelaar is Paul van Buuren ([WBVB Rotterdam](https://wbvb.nl)). 

## Contact
* Victor Zuydweg
* Paul van Buuren: paul@wbvb.nl


## Theme structure

```shell
themes/wp-rijkshuisstijl/                   # → Folder met alle theme-bestanden
├── 404.php                                 # → Afhandeling voor niet-gevonden pagina's
├── archive.php                             # → Algemeen berichten-overzicht
├── css/                                    # → Extra CSS-bestanden
│   └── editor-styles.css                   # → CSS voor juist tonen van vormgeving in WYSIWIG-editor in admin
├── fonts/                                  # → Webfonts
│   ├── ro-sanswebtext-bold-webfont.eot     # → Embedded OpenType RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.svg     # → SVG RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.ttf     # → True Type RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.woff    # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-bold-webfont.woff2   # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.eot   # → Embedded OpenType RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.svg   # → SVG RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.ttf   # → True Type RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.woff  # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-italic-webfont.woff2 # → Web Open Font Forma RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.eot   # → Embedded OpenType RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.svg   # → SVG RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.ttf   # → True Type RO Sans Web
│   ├── ro-sanswebtext-regular-webfont.woff  # → Web Open Font Forma RO Sans Web
│   └── ro-sanswebtext-regular-webfont.woff2 # → Web Open Font Forma RO Sans Web
├── front-page.php                          # → Algemene functies, theme includes
├── functions.php                           # → Algemene functies, theme includes
├── images/                                 # → Theme-gerelateerde beeldbestanden
├── includes/                               # → Bevat settings voor o.m. javascript-check
│   └── nojs.php                            # → include voor check of JS wel / niet aan staat
├── js/                                     # → Bevat javascript
├── languages/                              # → Bevat vertalingen voor het theme
├── less/                                   # → LESS-bronbestanden
├── page_sitemap.php                        # → Pagina voor het tonen van een sitemap
├── page.php                                # → Algemene contentpagina
├── screenshot.png                          # → Theme screenshot voor in WP admin
├── search.php                              # → Toont zoekresultaten
├── sidebar.php                             # → Code voor custom sidebar
├── style.css                               # → Bevat alle CSS (wordt samengesteld via LESS)
└── taxonomy.php                            # → Code voor het tonen van een taxonomie

```
