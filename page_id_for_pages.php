<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_fullwidth.php
// * ----------------------------------------------------------------------------------
// * Pagina met alleen full width, geen zijbalk
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 1.3.1
// * @desc.   Script voor genereren redirectlijst.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: XX - get Page ID plus URL

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'rhswp_get_pageidslist', 15 );

genesis();


//========================================================================================================

function rhswp_get_pageidslist() {
  
  $filtersitemap    = true;
  $showpagetemplate = false;
  $listitem         = 'ul';
  
  if ( isset( $_GET['filtersitemap'] ) ) {
    $filtersitemap = filter_input(INPUT_GET, 'filtersitemap', FILTER_SANITIZE_SPECIAL_CHARS);
    if ( $filtersitemap == 'nee' ) {
      $filtersitemap = false;
      $listitem = 'ol';
    }
  }

  
  ?>        
  <section aria-labelledby="title_sitemap_pages2">
    <h2 id="title_sitemap_pages2"><?php _e( "Pagina's:", 'wp-rijkshuisstijl' ); ?></h2>
    <<?php echo $listitem; ?>>
        <?php

        $args = array(    
          'title_li'  => '',
          'echo'      => 0,
          'walker'    => new rhswp_custom_walker_for_pageidslist()
        );

        $fulter   = wp_list_pages( $args ); 
        $pattern  = "/<ol[^>]*><\\/ol[^>]*>/"; 
        $fulter   = preg_replace($pattern, '', $fulter); 
        echo $fulter;
 ?>
      </<?php echo $listitem; ?>>
  </section>
  <?php

}

//========================================================================================================

class rhswp_custom_walker_for_pageidslist extends Walker_Page {

  // -------------------------

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '<ol class="children">';
  }
  
  // -------------------------

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '</ol>';
  }
  
  // -------------------------

  function end_el( &$output, $page, $depth = 0, $args = array() ) {

    $indent       = '';
    $css_class    = '';
    $link_before  = '';
    $icon_class   = '';
    $link_after   = '';

    $pagetemplate = get_page_template_slug( $page->ID );

    if ( ( 'page_dossiersingleactueel.php' != $pagetemplate ) 
        && ( 'page_dossier-document-overview.php' != $pagetemplate ) 
        && ( 'page_dossier-events-overview.php' != $pagetemplate ) 
        ) {
  
//        $output .= 'BOE';

    }
    else {
//        $output .= '-';
    }

  }
  
  // -------------------------
  
  function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {


$arraylala = array();

$arraylala['6'] = array( 'title' => 'Home', 'liveurl' => '/');
$arraylala['9'] = array( 'title' => 'Beleid', 'liveurl' => '/archief/beleid/');
$arraylala['11'] = array( 'title' => 'Planning', 'liveurl' => '/planning/');
$arraylala['13'] = array( 'title' => 'Uitvoering', 'liveurl' => '/hoe/');
$arraylala['23'] = array( 'title' => 'Inleiding', 'liveurl' => '/archief/beleid/verhoging-gebruik/inleiding/');
$arraylala['25'] = array( 'title' => 'Verhoging gebruik', 'liveurl' => '/archief/beleid/verhoging-gebruik/');
$arraylala['29'] = array( 'title' => 'Abonneren', 'liveurl' => '/abonneren/');
$arraylala['31'] = array( 'title' => 'Contact', 'liveurl' => '/contact/');
$arraylala['33'] = array( 'title' => 'Colofon', 'liveurl' => '/colofon/');
$arraylala['37'] = array( 'title' => 'Proclaimer', 'liveurl' => '/proclaimer/');
$arraylala['43'] = array( 'title' => 'Inleiding', 'liveurl' => '/hoe/inleiding-2/');
$arraylala['65'] = array( 'title' => 'Voorzieningen', 'liveurl' => '/voorzieningen/');
$arraylala['70'] = array( 'title' => 'Implementatieagenda', 'liveurl' => '/archief/implementatieagenda/');
$arraylala['73'] = array( 'title' => 'Releasekalender Digitale Overheid', 'liveurl' => '/planning/releasekalender-digitale-overheid/');
$arraylala['102'] = array( 'title' => 'Identificatie en authenticatie', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/');
$arraylala['105'] = array( 'title' => 'Dienstverlening', 'liveurl' => '/voorzieningen/dienstverlening/');
$arraylala['108'] = array( 'title' => 'Gegevens', 'liveurl' => '/voorzieningen/gegevens/');
$arraylala['115'] = array( 'title' => 'Interconnectiviteit', 'liveurl' => '/voorzieningen/interconnectiviteit/');
$arraylala['120'] = array( 'title' => 'Sitemap', 'liveurl' => '/sitemap/');
$arraylala['126'] = array( 'title' => 'Digitalisering aanbod', 'liveurl' => '/archief/beleid/digitalisering-aanbod/');
$arraylala['132'] = array( 'title' => 'Kwaliteit/tevredenheid', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/');
$arraylala['214'] = array( 'title' => 'Vertrouwen in generieke voorzieningen digitaal zakendoen', 'liveurl' => '/vertrouwen-in-generieke-voorzieningen-digitaal-zakendoen/');
$arraylala['216'] = array( 'title' => 'Berichtenbox voor bedrijven', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/');
$arraylala['218'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/actueel/');
$arraylala['220'] = array( 'title' => 'Vraag en antwoord', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/');
$arraylala['222'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/documenten/');
$arraylala['242'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/achtergrondartikelen/');
$arraylala['246'] = array( 'title' => 'Evenementen', 'liveurl' => '/hoe/evenementen/');
$arraylala['251'] = array( 'title' => 'Agenda', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/evenementen/');
$arraylala['372'] = array( 'title' => 'Video Digitaal 2017', 'liveurl' => '/archief/beleid/video-digitaal-2017/');
$arraylala['375'] = array( 'title' => 'Overzicht van alle onderwerpen', 'liveurl' => '/overzicht-van-alle-onderwerpen/');
$arraylala['387'] = array( 'title' => 'Over Optimaal Digitaal', 'liveurl' => '/archief/beleid/digitalisering-aanbod/inhoud-2/');
$arraylala['398'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/digitalisering-aanbod/inhoud-2/actueel-massaal-digitaal/');
$arraylala['401'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/hoe/achtergrondartikelen/');
$arraylala['421'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/archief/beleid/digitalisering-aanbod/inhoud-2/achtergrondartikelen-md/');
$arraylala['427'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/beleid/digitalisering-aanbod/inhoud-2/documenten-md/');
$arraylala['430'] = array( 'title' => 'Agenda', 'liveurl' => '/hoe/evenementen-overzicht/');
$arraylala['469'] = array( 'title' => 'Documenten', 'liveurl' => '/planning/voortgang/documenten/');
$arraylala['481'] = array( 'title' => 'Nieuws', 'liveurl' => '/planning/voortgang/actueel-2/');
$arraylala['619'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/digitalisering-aanbod/actueel/');
$arraylala['621'] = array( 'title' => 'Wetgeving', 'liveurl' => '/archief/beleid/digitalisering-aanbod/inhoud/');
$arraylala['622'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/archief/beleid/digitalisering-aanbod/achtergrondartikelen/');
$arraylala['625'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/beleid/digitalisering-aanbod/documenten/');
$arraylala['637'] = array( 'title' => 'RSS', 'liveurl' => '/rss-feeds/');
$arraylala['640'] = array( 'title' => 'Nieuwsbrief Digitale Overheid', 'liveurl' => '/nieuwsbrief/');
$arraylala['643'] = array( 'title' => 'Twitter', 'liveurl' => '/twitter/');
$arraylala['648'] = array( 'title' => 'Copyright', 'liveurl' => '/copyright/');
$arraylala['651'] = array( 'title' => 'Privacy', 'liveurl' => '/privacy/');
$arraylala['656'] = array( 'title' => 'Toegankelijkheidsverklaring', 'liveurl' => '/toegankelijkheidsverklaring/');
$arraylala['671'] = array( 'title' => 'Evenementen Massaal Digitaal', 'liveurl' => '/evenementen-massaal-digitaal/');
$arraylala['680'] = array( 'title' => 'Evenementen Berichtenbox voor bedrijven', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/evenementen-2/');
$arraylala['685'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/planning/');
$arraylala['702'] = array( 'title' => 'Overzichtspagina GDI / Voorzieningen', 'liveurl' => '/archief/beleid/digitalisering-aanbod/gdi-voorzieningen/');
$arraylala['705'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/digitalisering-aanbod/gdi-voorzieningen/actueel/');
$arraylala['706'] = array( 'title' => 'Evenementen GDI / Voorzieningen', 'liveurl' => '/evenementen-gdi-voorzieningen/');
$arraylala['711'] = array( 'title' => 'Bevorderen digivaardigheid', 'liveurl' => '/archief/beleid/verhoging-gebruik/bevorderen-digivaardigheid/');
$arraylala['721'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/verhoging-gebruik/bevorderen-digivaardigheid/actueel-bevorderen-digivaardigheid/');
$arraylala['723'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/archief/beleid/verhoging-gebruik/bevorderen-digivaardigheid/achtergrondartikelen-bevorderen-digivaardigheid/');
$arraylala['726'] = array( 'title' => 'Agenda', 'liveurl' => '/archief/beleid/verhoging-gebruik/bevorderen-digivaardigheid/evenementen-bevorderen-digivaardigheid/');
$arraylala['730'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/beleid/verhoging-gebruik/bevorderen-digivaardigheid/documenten-bevordering-digivaardigheid/');
$arraylala['768'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/archief/beleid/digitalisering-aanbod/gdi-voorzieningen/achtergrondartikelen/');
$arraylala['775'] = array( 'title' => 'Agenda', 'liveurl' => '/archief/beleid/digitalisering-aanbod/gdi-voorzieningen/agenda/');
$arraylala['777'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/beleid/digitalisering-aanbod/gdi-voorzieningen/documenten/');
$arraylala['779'] = array( 'title' => 'Basisregistraties', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/');
$arraylala['783'] = array( 'title' => 'BRP', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/inhoud-brp/');
$arraylala['792'] = array( 'title' => 'Agenda', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/inhoud-brp/agenda/');
$arraylala['794'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/inhoud-brp/achtergrondartikelen/');
$arraylala['798'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/inhoud-brp/planning/');
$arraylala['800'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/inhoud-brp/documenten/');
$arraylala['813'] = array( 'title' => 'HR', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/nhr/');
$arraylala['815'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/nhr/actueel/');
$arraylala['817'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/nhr/documenten/');
$arraylala['822'] = array( 'title' => 'Actueel', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/actueel/');
$arraylala['824'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/documenten/');
$arraylala['832'] = array( 'title' => 'BAG', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bag/');
$arraylala['836'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bag/documenten/');
$arraylala['843'] = array( 'title' => 'BRT', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brt/');
$arraylala['847'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brt/documenten/');
$arraylala['852'] = array( 'title' => 'BRK', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brk/');
$arraylala['856'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brk/documenten/');
$arraylala['861'] = array( 'title' => 'BRV', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brv/');
$arraylala['863'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brv/actueel/');
$arraylala['865'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brv/documenten/');
$arraylala['880'] = array( 'title' => 'BRI', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bri/');
$arraylala['884'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bri/documenten/');
$arraylala['889'] = array( 'title' => 'WOZ', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/woz/');
$arraylala['893'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/woz/documenten/');
$arraylala['898'] = array( 'title' => 'BGT', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bgt/');
$arraylala['902'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bgt/documenten/');
$arraylala['907'] = array( 'title' => 'BRO', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bro/');
$arraylala['909'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bro/actueel/');
$arraylala['911'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bro/documenten/');
$arraylala['920'] = array( 'title' => 'Evenementen', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/nhr/evenementen/');
$arraylala['922'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/nhr/achtergrondartikelen/');
$arraylala['925'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/nhr/planning/');
$arraylala['941'] = array( 'title' => 'Toegangsverleningservice', 'liveurl' => '/archief/toegangsverleningservice/');
$arraylala['943'] = array( 'title' => 'Planning', 'liveurl' => '/archief/toegangsverleningservice/planning/');
$arraylala['945'] = array( 'title' => 'Vraag en antwoord', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/');
$arraylala['947'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/toegangsverleningservice/actueel/');
$arraylala['949'] = array( 'title' => 'Agenda', 'liveurl' => '/archief/toegangsverleningservice/agenda/');
$arraylala['953'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/archief/toegangsverleningservice/achtergrondartikelen/');
$arraylala['955'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/toegangsverleningservice/documenten/');
$arraylala['971'] = array( 'title' => 'MijnOverheid', 'liveurl' => '/voorzieningen/dienstverlening/mijnoverheid/');
$arraylala['1025'] = array( 'title' => 'Aansluiten op de TVS', 'liveurl' => '/archief/toegangsverleningservice/aansluiten-op-toegangsverleningservice/');
$arraylala['1027'] = array( 'title' => 'Voorwaarden deelname TVS', 'liveurl' => '/archief/toegangsverleningservice/voorwaarden-deelname-toegangsverleningservice/');
$arraylala['1029'] = array( 'title' => 'Acceptatie TVS', 'liveurl' => '/archief/toegangsverleningservice/acceptatie-toegangsverleningservice/');
$arraylala['1031'] = array( 'title' => 'Checklist testen', 'liveurl' => '/archief/toegangsverleningservice/checklist-testen-en-pdf/');
$arraylala['1033'] = array( 'title' => 'Beheer TVS', 'liveurl' => '/archief/toegangsverleningservice/beheer-toegangsverleningservice/');
$arraylala['1036'] = array( 'title' => 'Gegevenslandschap', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/');
$arraylala['1038'] = array( 'title' => 'Aanpak', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/aanpak-gegevenslandschap/');
$arraylala['1041'] = array( 'title' => 'Thema’s', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/');
$arraylala['1044'] = array( 'title' => 'Documenten', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/documenten/');
$arraylala['1048'] = array( 'title' => 'Nieuws', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/nieuws/');
$arraylala['1050'] = array( 'title' => 'Agenda', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/agenda/');
$arraylala['1052'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/achtergrondartikelen/');
$arraylala['1163'] = array( 'title' => '', 'liveurl' => '/archief/toegangsverleningservice/1163-2/');
$arraylala['1166'] = array( 'title' => 'Samenhang met andere toegangsmiddelen', 'liveurl' => '/archief/toegangsverleningservice/voordelen-van-de-toegangsverleningservice/');
$arraylala['1194'] = array( 'title' => 'Overige voorzieningen', 'liveurl' => '/voorzieningen/overige-voorzieningen/');
$arraylala['1195'] = array( 'title' => 'MijnOverheid voor Ondernemers', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/wat-is-het/');
$arraylala['1205'] = array( 'title' => 'MijnOverheid voor Ondernemers', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/');
$arraylala['1207'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/planning/');
$arraylala['1209'] = array( 'title' => 'Vraag en antwoord', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/vraag-en-antwoord/');
$arraylala['1211'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/nieuws/');
$arraylala['1214'] = array( 'title' => 'Agenda', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/agenda/');
$arraylala['1218'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/documenten/');
$arraylala['1232'] = array( 'title' => 'Voortgang', 'liveurl' => '/planning/voortgang/');
$arraylala['1244'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/mijnoverheid/planning/');
$arraylala['1248'] = array( 'title' => 'Agenda', 'liveurl' => '/voorzieningen/dienstverlening/mijnoverheid/agenda/');
$arraylala['1250'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/voorzieningen/dienstverlening/mijnoverheid/achtergrondartikelen/');
$arraylala['1252'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/dienstverlening/mijnoverheid/documenten/');
$arraylala['1255'] = array( 'title' => 'NORA', 'liveurl' => '/voorzieningen/interconnectiviteit/nora/');
$arraylala['1257'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/interconnectiviteit/nora/planning/');
$arraylala['1261'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/interconnectiviteit/nora/nieuws/');
$arraylala['1263'] = array( 'title' => 'Agenda', 'liveurl' => '/voorzieningen/interconnectiviteit/nora/agenda/');
$arraylala['1266'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/voorzieningen/interconnectiviteit/nora/achtergrondartikelen/');
$arraylala['1268'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/interconnectiviteit/nora/documenten/');
$arraylala['1277'] = array( 'title' => 'Berichtenbox voor burgers', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-burgers/');
$arraylala['1283'] = array( 'title' => 'Kanalenstrategie', 'liveurl' => '/archief/beleid/verhoging-gebruik/kanalenstrategie/');
$arraylala['1286'] = array( 'title' => 'Gebruikersvriendelijkheid', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/gebruikersvriendelijkheid/');
$arraylala['1289'] = array( 'title' => 'Informatiepositie', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/informatiepositie/');
$arraylala['1292'] = array( 'title' => 'Informatieveiligheid', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/informatieveiligheid/');
$arraylala['1295'] = array( 'title' => 'Webrichtlijnen', 'liveurl' => '/archief/webrichtlijnen/');
$arraylala['1298'] = array( 'title' => 'Privacy', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/privacy/');
$arraylala['1302'] = array( 'title' => 'Regeldruk', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/regeldruk/');
$arraylala['1367'] = array( 'title' => 'Idensys', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/idensys/');
$arraylala['1370'] = array( 'title' => 'eHerkenning', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eherkenning/');
$arraylala['1373'] = array( 'title' => 'Overzicht DigiD', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/digid/');
$arraylala['1376'] = array( 'title' => 'DigiD Machtigen', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/digid-machtigen/');
$arraylala['1379'] = array( 'title' => 'Klankbordgroepen', 'liveurl' => '/archief/beleid/verhoging-gebruik/bevorderen-digivaardigheid/klankbordgroepen/');
$arraylala['1382'] = array( 'title' => 'Digitaal Hulpplein', 'liveurl' => '/archief/beleid/verhoging-gebruik/ondersteuning/');
$arraylala['1384'] = array( 'title' => 'Digivaardigheid', 'liveurl' => '/archief/beleid/verhoging-gebruik/inleiding-digivaardigheid/');
$arraylala['1388'] = array( 'title' => 'Berichten Verzend Service (BVS)', 'liveurl' => '/archief/berichten-verzend-service-bvs/');
$arraylala['1392'] = array( 'title' => 'Samenhang met andere e-OvB voorzieningen en de relatie tot de Generieke Digitale Infrastructuur (GDI)', 'liveurl' => '/archief/berichten-verzend-service-bvs/samenhang-bvs/');
$arraylala['1394'] = array( 'title' => 'Stappenplan aansluiten', 'liveurl' => '/archief/berichten-verzend-service-bvs/stappenplan-aansluiten-op-bvs/');
$arraylala['1396'] = array( 'title' => 'Algemene voorwaarden', 'liveurl' => '/archief/berichten-verzend-service-bvs/algemene-voorwaarden-bvs/');
$arraylala['1398'] = array( 'title' => 'Acceptatie', 'liveurl' => '/archief/berichten-verzend-service-bvs/acceptatie-bvs/');
$arraylala['1400'] = array( 'title' => 'Beheer', 'liveurl' => '/archief/berichten-verzend-service-bvs/beheer-bvs/');
$arraylala['1403'] = array( 'title' => 'Planning', 'liveurl' => '/archief/berichten-verzend-service-bvs/planning/');
$arraylala['1405'] = array( 'title' => 'Vraag en antwoord', 'liveurl' => '/archief/berichten-verzend-service-bvs/vraag-en-antwoord-bvs/');
$arraylala['1407'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/berichten-verzend-service-bvs/nieuws/');
$arraylala['1410'] = array( 'title' => 'Agenda', 'liveurl' => '/archief/berichten-verzend-service-bvs/agenda/');
$arraylala['1412'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/archief/berichten-verzend-service-bvs/achtergrondartikelen/');
$arraylala['1414'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/berichten-verzend-service-bvs/documenten/');
$arraylala['1429'] = array( 'title' => 'Twaalf eisen Stelsel van Basisregistraties', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/twaalf-eisen-stelsel-van-basisregistraties/');
$arraylala['1431'] = array( 'title' => 'Stelselafspraken', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/stelselafspraken/');
$arraylala['1433'] = array( 'title' => 'Rollen in het Stelsel van Basisregistraties', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/rollen-stelsel-basisregistraties/');
$arraylala['1435'] = array( 'title' => 'Eenmalig uitvragen, verplicht gebruiken', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/eenmalig-uitvragen-verplicht-gebruiken/');
$arraylala['1437'] = array( 'title' => 'Knooppunten en het Stelsel van Basisregistraties', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/knooppunten-en-stelsel-basisregistraties/');
$arraylala['1441'] = array( 'title' => 'Kwaliteit en terugmelden', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/kwaliteit-en-terugmelden/');
$arraylala['1443'] = array( 'title' => 'Sectorregistraties', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/sectorregistraties/');
$arraylala['1445'] = array( 'title' => 'Verbindingen', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/verbindingen/');
$arraylala['1447'] = array( 'title' => 'Schrijfwijze registreren en presenteren adressen Stelsel van Basisregistraties', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/schrijfwijze-registreren-en-presenteren-adressen-stelsel-basisregistraties/');
$arraylala['1449'] = array( 'title' => 'Besturing en financiering', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/besturing-en-financiering/');
$arraylala['1451'] = array( 'title' => 'Informatiebeveiliging en privacy', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/themas/informatiebeveiliging-en-privacy/');
$arraylala['1486'] = array( 'title' => 'Ondernemersplein.nl', 'liveurl' => '/voorzieningen/dienstverlening/digitaal-ondernemersplein/');
$arraylala['1489'] = array( 'title' => 'Samenwerkende Catalogi', 'liveurl' => '/voorzieningen/dienstverlening/samenwerkende-catalogi/');
$arraylala['1505'] = array( 'title' => 'Toepassingen', 'liveurl' => '/hoe/toepassingen/');
$arraylala['1506'] = array( 'title' => 'Aanpak', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/planning/1506-2/');
$arraylala['1513'] = array( 'title' => 'Gemeentelijke dienstverlening', 'liveurl' => '/hoe/toepassingen/gemeentelijke-dienstverlening/');
$arraylala['1517'] = array( 'title' => 'Het nieuwe Omgevingsloket', 'liveurl' => '/hoe/toepassingen/omgevingsloket-3-0/');
$arraylala['1521'] = array( 'title' => 'Ondersteuning Omgevingswet', 'liveurl' => '/hoe/toepassingen/ondersteuning-omgevingswet/');
$arraylala['1523'] = array( 'title' => 'Inspectieview', 'liveurl' => '/archief/inspectieview/');
$arraylala['1526'] = array( 'title' => 'TenderNed', 'liveurl' => '/archief/tenderned/');
$arraylala['1528'] = array( 'title' => 'Maritiem Single Window', 'liveurl' => '/archief/maritiem-single-window/');
$arraylala['1531'] = array( 'title' => 'Rijksdienst voor Ondernemend Nederland', 'liveurl' => '/hoe/toepassingen/rvo/');
$arraylala['1533'] = array( 'title' => 'Regelhulpen', 'liveurl' => '/voorzieningen/overige-voorzieningen/regelhulpen/');
$arraylala['1562'] = array( 'title' => 'Internationaal', 'liveurl' => '/archief/beleid/internationaal/');
$arraylala['1564'] = array( 'title' => 'Europese samenwerking', 'liveurl' => '/archief/beleid/internationaal/europese-samenwerking/');
$arraylala['1566'] = array( 'title' => 'EU voorzitterschap 2016', 'liveurl' => '/archief/beleid/internationaal/eu-voorzitterschap-2016/');
$arraylala['1572'] = array( 'title' => 'Overheid.nl', 'liveurl' => '/voorzieningen/dienstverlening/overheid-nl/');
$arraylala['1582'] = array( 'title' => 'Standard Business Reporting', 'liveurl' => '/voorzieningen/dienstverlening/sbr/');
$arraylala['1584'] = array( 'title' => 'Elektronisch factureren', 'liveurl' => '/voorzieningen/dienstverlening/efactureren/');
$arraylala['1591'] = array( 'title' => 'Stelselvoorzieningen', 'liveurl' => '/voorzieningen/gegevens/stelselvoorzieningen/');
$arraylala['1593'] = array( 'title' => 'Digikoppeling', 'liveurl' => '/digikoppeling/');
$arraylala['1595'] = array( 'title' => 'Digilevering', 'liveurl' => '/digilevering/');
$arraylala['1597'] = array( 'title' => 'Digimelding', 'liveurl' => '/digimelding/');
$arraylala['1599'] = array( 'title' => 'Stelselcatalogus', 'liveurl' => '/stelselcatalogus/');
$arraylala['1601'] = array( 'title' => 'Beheervoorziening BSN', 'liveurl' => '/voorzieningen/gegevens/beheervoorziening-bsn/');
$arraylala['1609'] = array( 'title' => 'Diginetwerk', 'liveurl' => '/voorzieningen/interconnectiviteit/diginetwerk/');
$arraylala['1611'] = array( 'title' => 'Digipoort', 'liveurl' => '/voorzieningen/interconnectiviteit/digipoort/');
$arraylala['1613'] = array( 'title' => 'Certificering / PKIoverheid', 'liveurl' => '/archief/certificeringpkioverheid/');
$arraylala['1615'] = array( 'title' => 'Standaarden', 'liveurl' => '/voorzieningen/interconnectiviteit/standaarden/');
$arraylala['1694'] = array( 'title' => 'Stelselvoorzieningen', 'liveurl' => '/stelselvoorzieningen/');
$arraylala['1706'] = array( 'title' => 'Stelselplaat basisregistraties', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/stelselplaat/');
$arraylala['1738'] = array( 'title' => 'Klankbordgroepen', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/gebruikersvriendelijkheid/klankbordgroepen/');
$arraylala['1740'] = array( 'title' => 'Gebruiker Centraal', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/gebruikersvriendelijkheid/gebruiker-centraal/');
$arraylala['1751'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/gebruikersvriendelijkheid/nieuws/');
$arraylala['1777'] = array( 'title' => 'Wat is MijnOverheid voor Ondernemers?', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/is-mijnoverheid-ondernemers/');
$arraylala['1781'] = array( 'title' => 'Hoe werkt MijnOverheid voor Ondernemers?', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/hoe-werkt-mijnoverheid-ondernemers/');
$arraylala['1794'] = array( 'title' => 'Over MOvO', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/over-mijnoverheid-voor-ondernemers/');
$arraylala['1824'] = array( 'title' => 'Uitgangspunten', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/over-mijnoverheid-voor-ondernemers/uitgangspunten/');
$arraylala['1862'] = array( 'title' => 'Governance', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/over-mijnoverheid-voor-ondernemers/governance/');
$arraylala['1872'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/overige-voorzieningen/regelhulpen/nieuws/');
$arraylala['1877'] = array( 'title' => 'Feiten en cijfers', 'liveurl' => '/archief/berichten-verzend-service-bvs/feiten-en-cijfers-bvs/');
$arraylala['1897'] = array( 'title' => 'Eigenschappen BVS', 'liveurl' => '/archief/berichten-verzend-service-bvs/eigenschappen-bvs/');
$arraylala['2012'] = array( 'title' => 'Juridische status', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/juridische-status/');
$arraylala['2020'] = array( 'title' => 'Procedures', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/procedures/');
$arraylala['2027'] = array( 'title' => 'Verschil met Berichtenbox voor burgers', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/verschil-met-berichtenbox-voor-burgers/');
$arraylala['2035'] = array( 'title' => 'Business case Berichtenbox voor Bedrijven', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/kosten/');
$arraylala['2039'] = array( 'title' => 'Praktijkvoorbeelden', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/praktijkvoorbeelden/');
$arraylala['2044'] = array( 'title' => 'Feiten en cijfers', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/feiten-en-cijfers/');
$arraylala['2052'] = array( 'title' => 'Releasenotes 2016', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/releasenotes/');
$arraylala['2062'] = array( 'title' => 'Aansluiten', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/aansluiten/');
$arraylala['2068'] = array( 'title' => 'Stappenplan', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/stappenplan/');
$arraylala['2073'] = array( 'title' => 'Geautomatiseerd verzenden', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/achtergrondartikelen/geautomatiseerd-verzenden/');
$arraylala['2078'] = array( 'title' => 'Handmatig gebruik', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/achtergrondartikelen/handmatig-gebruik/');
$arraylala['2089'] = array( 'title' => 'Feiten en cijfers TVS', 'liveurl' => '/archief/toegangsverleningservice/feiten-en-cijfers-tvs/');
$arraylala['2092'] = array( 'title' => 'Kosten TVS', 'liveurl' => '/archief/toegangsverleningservice/kosten/');
$arraylala['2359'] = array( 'title' => 'Actueel', 'liveurl' => '/actueel/');
$arraylala['2375'] = array( 'title' => 'ENSIA: Eenduidige Normatiek Single Information Audit', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/informatieveiligheid/ensia/');
$arraylala['2405'] = array( 'title' => 'Releasekalender BVS', 'liveurl' => '/archief/berichten-verzend-service-bvs/planning/releasekalender-bvs/');
$arraylala['2412'] = array( 'title' => 'Storingsinformatie BVS', 'liveurl' => '/archief/berichten-verzend-service-bvs/beheer-bvs/storingsinformatie-bvs/');
$arraylala['2467'] = array( 'title' => 'Hoe werkt de Berichten Verzend Service?', 'liveurl' => '/archief/berichten-verzend-service-bvs/vraag-en-antwoord-bvs/hoe-werkt-berichten-verzend-service/');
$arraylala['2471'] = array( 'title' => 'Waarom de Berichten Verzend Service gebruiken?', 'liveurl' => '/archief/berichten-verzend-service-bvs/vraag-en-antwoord-bvs/waarom-berichten-verzend-service-gebruiken/');
$arraylala['2483'] = array( 'title' => 'Wat zijn de voordelen van de Berichten Verzend Service?', 'liveurl' => '/archief/berichten-verzend-service-bvs/vraag-en-antwoord-bvs/voordelen-berichten-verzend-service/');
$arraylala['2485'] = array( 'title' => 'Samenhang met andere e-OvB voorzieningen en de relatie tot de Generieke Digitale Infrastructuur (GDI)', 'liveurl' => '/archief/berichten-verzend-service-bvs/vraag-en-antwoord-bvs/hoe-vindt-aansluiting-op-berichten-verzend-service-plaats/');
$arraylala['2504'] = array( 'title' => 'Contact', 'liveurl' => '/contact-2/');
$arraylala['2524'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/idensys/nieuws/');
$arraylala['2527'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eherkenning/nieuws/');
$arraylala['2563'] = array( 'title' => 'Contact', 'liveurl' => '/voorzieningen/overige-voorzieningen/regelhulpen/2563-2/');
$arraylala['2564'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/verhoging-gebruik/kanalenstrategie/nieuws/');
$arraylala['2566'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/informatiepositie/nieuws/');
$arraylala['2568'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/informatieveiligheid/nieuws/');
$arraylala['2576'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/privacy/nieuws/');
$arraylala['2579'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/regeldruk/nieuws/');
$arraylala['2581'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/webrichtlijnen/nieuws/');
$arraylala['2593'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eidas/nieuws/');
$arraylala['2596'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/digid/nieuws/');
$arraylala['2598'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/digid-machtigen/nieuws/');
$arraylala['2601'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/overheid-nl/nieuws/');
$arraylala['2605'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/digitaal-ondernemersplein/nieuws/');
$arraylala['2607'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/samenwerkende-catalogi/nieuws/');
$arraylala['2609'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-burgers/nieuws/');
$arraylala['2611'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/nieuws/');
$arraylala['2615'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/efactureren/nieuws/');
$arraylala['2618'] = array( 'title' => 'Nieuws', 'liveurl' => '/stelselvoorzieningen/nieuws/');
$arraylala['2621'] = array( 'title' => 'Nieuws', 'liveurl' => '/digikoppeling/nieuws/');
$arraylala['2624'] = array( 'title' => 'Nieuws', 'liveurl' => '/digilevering/nieuws/');
$arraylala['2628'] = array( 'title' => 'Nieuws', 'liveurl' => '/digimelding/nieuws/');
$arraylala['2631'] = array( 'title' => 'Nieuws', 'liveurl' => '/stelselcatalogus/nieuws/');
$arraylala['2662'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/gegevens/beheervoorziening-bsn/nieuws/');
$arraylala['2665'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/interconnectiviteit/diginetwerk/nieuws/');
$arraylala['2669'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/interconnectiviteit/digipoort/nieuws/');
$arraylala['2672'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/certificeringpkioverheid/nieuws/');
$arraylala['2674'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/interconnectiviteit/standaarden/nieuws/');
$arraylala['2677'] = array( 'title' => 'Nieuws', 'liveurl' => '/hoe/toepassingen/gemeentelijke-dienstverlening/nieuws/');
$arraylala['2681'] = array( 'title' => 'Nieuws', 'liveurl' => '/hoe/toepassingen/omgevingsloket-3-0/nieuws/');
$arraylala['2683'] = array( 'title' => 'Nieuws', 'liveurl' => '/hoe/toepassingen/ondersteuning-omgevingswet/nieuws/');
$arraylala['2687'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/inspectieview/nieuws/');
$arraylala['2695'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/maritiem-single-window/nieuws/');
$arraylala['2737'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/informatieveiligheid/ensia/nieuws/');
$arraylala['2790'] = array( 'title' => 'Wat zijn de voordelen van de TVS?', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/voordelen-toegangsverleningservice-tvs/');
$arraylala['2910'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/dienstverlening/samenwerkende-catalogi/documenten/');
$arraylala['2995'] = array( 'title' => 'Wat is e-Overheid voor Bedrijven (e-OvB)?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/is-e-overheid-bedrijven-e-ovb/');
$arraylala['3000'] = array( 'title' => 'Wat is de Berichtenbox voor bedrijven?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/is-berichtenbox-bedrijven/');
$arraylala['3005'] = array( 'title' => 'Waarom via de Berichtenbox verzenden en niet gewoon per e-mail?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/waarom-berichtenbox-verzenden-en-gewoon-per-e-mail/');
$arraylala['3010'] = array( 'title' => 'Hoe kan onze overheidsorganisatie aansluiten op de Berichtenbox?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/hoe-overheidsorganisatie-aansluiten-op-berichtenbox/');
$arraylala['3014'] = array( 'title' => 'Hoe kan onze organisatie als bevoegde instantie een Berichtenbox aanmaken?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/hoe-organisatie-als-bevoegde-instantie-berichtenbox-aanmaken/');
$arraylala['3024'] = array( 'title' => 'Wordt de Berichtenbox voor bedrijven vervangen door MijnOverheid voor Ondernemers?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/wordt-berichtenbox-bedrijven-straks-vervangen-mijnoverheid-ondernemers/');
$arraylala['3042'] = array( 'title' => 'Is de Berichtenbox altijd beschikbaar?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/is-berichtenbox-altijd-beschikbaar/');
$arraylala['3065'] = array( 'title' => 'Waar is de Berichtenbox voor bedoeld?', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/vraag-en-antwoord/is-berichtenbox-bedoeld/');
$arraylala['3183'] = array( 'title' => 'Over het iBestuur Congres', 'liveurl' => '/archief/over-het-ibestuur-congres/');
$arraylala['3201'] = array( 'title' => 'iBestuur Congres 2016', 'liveurl' => '/archief/over-het-ibestuur-congres/ibestuur-congres-2016/');
$arraylala['3254'] = array( 'title' => 'Digitale overheid voor ondernemers', 'liveurl' => '/archief/digitale-overheid-ondernemers/');
$arraylala['3292'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/digitale-overheid-ondernemers/nieuws/');
$arraylala['3294'] = array( 'title' => 'Achtergrondartikelen', 'liveurl' => '/archief/digitale-overheid-ondernemers/achtergrondartikelen/');
$arraylala['3303'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/beheervoorziening-bsn/planning/');
$arraylala['3307'] = array( 'title' => 'Planning', 'liveurl' => '/digikoppeling/planning/');
$arraylala['3310'] = array( 'title' => 'Planning', 'liveurl' => '/digilevering/planning/');
$arraylala['3312'] = array( 'title' => 'Planning', 'liveurl' => '/digimelding/planning/');
$arraylala['3314'] = array( 'title' => 'Planning', 'liveurl' => '/stelselcatalogus/planning/');
$arraylala['3319'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bgt/planning/');
$arraylala['3332'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brk/planning/');
$arraylala['3340'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bro/planning/');
$arraylala['3349'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brt/planning/');
$arraylala['3354'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/brv/planning/');
$arraylala['3356'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/woz/planning/');
$arraylala['3358'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/bag/planning/');
$arraylala['3369'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/efactureren/planning/');
$arraylala['3389'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/overheid-nl/planning/');
$arraylala['3391'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/samenwerkende-catalogi/planning/');
$arraylala['3397'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/sbr/planning/');
$arraylala['3399'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/digid/planning/');
$arraylala['3403'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eherkenning/planning/');
$arraylala['3407'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/interconnectiviteit/diginetwerk/planning/');
$arraylala['3410'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/interconnectiviteit/digipoort/planning/');
$arraylala['3412'] = array( 'title' => 'Planning', 'liveurl' => '/archief/certificeringpkioverheid/planning/');
$arraylala['3529'] = array( 'title' => 'Documenten', 'liveurl' => '/stelselvoorzieningen/documenten/');
$arraylala['7833'] = array( 'title' => 'Legenda releasekalender', 'liveurl' => '/planning/releasekalender-digitale-overheid/legenda-releasekalender/');
$arraylala['7846'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/beleid/kwaliteittevredenheid/informatieveiligheid/documenten/');
$arraylala['7943'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/dienstverlening/nieuws-2/');
$arraylala['7952'] = array( 'title' => 'Studiegroep Informatiesamenleving en Overheid', 'liveurl' => '/archief/studiegroep-informatiesamenleving-en-overheid/');
$arraylala['7955'] = array( 'title' => 'Planning', 'liveurl' => '/archief/studiegroep-informatiesamenleving-en-overheid/planning/');
$arraylala['7985'] = array( 'title' => 'Aantal geregistreerde gebruikers', 'liveurl' => '/aantal-geregistreerde-gebruikers/');
$arraylala['7989'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/planning-2/');
$arraylala['8057'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/studiegroep-informatiesamenleving-en-overheid/nieuws/');
$arraylala['8059'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/studiegroep-informatiesamenleving-en-overheid/documenten/');
$arraylala['8062'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/studiegroep-informatiesamenleving-en-overheid/documenten-2/');
$arraylala['9209'] = array( 'title' => 'Releasenotes 2017', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/realease-notes-2017/');
$arraylala['9218'] = array( 'title' => 'Nieuwsbriefarchief', 'liveurl' => '/nieuwsbrief/nieuwsbriefarchief/');
$arraylala['9226'] = array( 'title' => 'Nieuwsbrief Digitale Overheid', 'liveurl' => '/inschrijven-voor-de-nieuwsbrief/');
$arraylala['9275'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/dienstverlening/mijnoverheid/documenten-2/');
$arraylala['9536'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/implementatieagenda/nieuws/');
$arraylala['9538'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/implementatieagenda/documenten/');
$arraylala['9543'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/gegevens/inhoud-basisregistraties/inhoud-brp/nieuws/');
$arraylala['9573'] = array( 'title' => 'Filmpje: hoe werkt DigiD?', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/digid/filmpje-hoe-werkt-digid/');
$arraylala['9592'] = array( 'title' => 'Planning', 'liveurl' => '/voorzieningen/dienstverlening/digitaal-ondernemersplein/planning/');
$arraylala['10687'] = array( 'title' => 'iBewustzijn Overheid', 'liveurl' => '/archief/ibewustzijn-overheid/');
$arraylala['10689'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/ibewustzijn-overheid/nieuws/');
$arraylala['10692'] = array( 'title' => 'Campagnemateriaal', 'liveurl' => '/archief/ibewustzijn-overheid/campagnemateriaal/');
$arraylala['10694'] = array( 'title' => 'Video’s', 'liveurl' => '/archief/ibewustzijn-overheid/video/');
$arraylala['10696'] = array( 'title' => 'e-Learning', 'liveurl' => '/archief/ibewustzijn-overheid/e-learning/');
$arraylala['10698'] = array( 'title' => 'Workshopaanbod', 'liveurl' => '/archief/ibewustzijn-overheid/workshopaanbod/');
$arraylala['10700'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/ibewustzijn-overheid/archief-publicaties/');
$arraylala['10882'] = array( 'title' => 'Gouden Regels iBewustzijn', 'liveurl' => '/archief/ibewustzijn-overheid/campagnemateriaal/gouden-regels/');
$arraylala['10890'] = array( 'title' => 'Best Practices veranderen informatiegedrag', 'liveurl' => '/archief/ibewustzijn-overheid/campagnemateriaal/best-practices/');
$arraylala['10895'] = array( 'title' => 'Posters Campagne iBewustzijn Overheid', 'liveurl' => '/archief/ibewustzijn-overheid/campagnemateriaal/posters-campagne-ibewustzijn-overheid/');
$arraylala['10973'] = array( 'title' => 'Wat is de TVS?', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/wat-is-de-tvs/');
$arraylala['10998'] = array( 'title' => 'Beheer Berichtenbox voor bedrijven', 'liveurl' => '/voorzieningen/dienstverlening/berichtenbox-voor-bedrijven/beheer-berichtenbox-bedrijven/');
$arraylala['11062'] = array( 'title' => 'Waarom de TVS?', 'liveurl' => '/archief/toegangsverleningservice/waarom-de-tvs/');
$arraylala['11066'] = array( 'title' => 'Samenhang met andere e-OvB voorzieningen.', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/vraag-en-antwoordsamenhang-e-ovb-voorzieningen/');
$arraylala['11068'] = array( 'title' => 'Wat is de relatie van de TVS tot de Generieke Digitale Infrastructuur (GDI)?', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/is-relatie-tvs-tot-generieke-digitale-infrastructuur-gdi/');
$arraylala['11072'] = array( 'title' => 'Wat zijn de eigenschappen van de TVS?', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/wat-zijn-de-eigenschappen-van-de-tvs/');
$arraylala['11076'] = array( 'title' => 'Hoe kan een overheidsorganisatie aansluiten op de TVS?', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/hoe-overheidsorganisatie-aansluiten-op-tvs/');
$arraylala['11080'] = array( 'title' => 'Hoe word ik op de hoogte gehouden van actuele storingen en onderhoud?', 'liveurl' => '/archief/toegangsverleningservice/vraag-en-antwoord/hoe-weet-er-storing-is-op-tvs/');
$arraylala['11112'] = array( 'title' => 'WMK-toets: Willen, Mogen, Kunnen', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/aanpak-gegevenslandschap/wmk-toets-willen-mogen-kunnen/');
$arraylala['11189'] = array( 'title' => 'Doelstellingen kwaliteit', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/doelstellingen-kwaliteit/');
$arraylala['11192'] = array( 'title' => 'Doelstellingen toegankelijkheid', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/doelstellingen-toegankelijkheid/');
$arraylala['11194'] = array( 'title' => 'Doelstellingen transparantie', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/doelstellingen-transparantie/');
$arraylala['11215'] = array( 'title' => 'Planning doorontwikkeling Ondernemingsdossier', 'liveurl' => '/voorzieningen/dienstverlening/planning-doorontwikkeling-ondernemningsdossier/');
$arraylala['11249'] = array( 'title' => 'eID', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/');
$arraylala['11251'] = array( 'title' => 'Inlogmiddelen', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/inlogmiddelen/');
$arraylala['11253'] = array( 'title' => 'Plannen', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/plannen/');
$arraylala['11255'] = array( 'title' => 'Veelgestelde vragen', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/veelgestelde-vragen/');
$arraylala['11257'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/documenten/');
$arraylala['11259'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/nieuws/');
$arraylala['11692'] = array( 'title' => 'eIDAS', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eidas/');
$arraylala['11699'] = array( 'title' => 'eIDAS ondersteuning', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eidas/informatie-eidas/');
$arraylala['11701'] = array( 'title' => 'Factsheet over de AVG', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/aanpak-gegevenslandschap/factsheet-avg/');
$arraylala['11778'] = array( 'title' => 'Storingsinformatie BVS', 'liveurl' => '/archief/berichten-verzend-service-bvs/vraag-en-antwoord-bvs/storingsinformatie-bvs/');
$arraylala['11897'] = array( 'title' => 'Principes dienstverleningsconcept', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/aanpak-gegevenslandschap/principes-dienstverleningsconcept/');
$arraylala['11902'] = array( 'title' => 'Memo Concept Dienstverlening – 01-02-2017', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/aanpak-gegevenslandschap/principes-dienstverleningsconcept/memo-dienstverleningsconcept-01-02-2017/');
$arraylala['11912'] = array( 'title' => 'Expertnetwerk Gegevens', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/aanpak-gegevenslandschap/memo-expertnetwerk-gegevens/');
$arraylala['12132'] = array( 'title' => 'eID: veilig inloggen bij overheidsorganisaties en zorginstellingen', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/veilig-inloggen-overheden-en-zorgverleners/');
$arraylala['12136'] = array( 'title' => 'Vragen', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/vragen/');
$arraylala['12138'] = array( 'title' => 'Nieuws', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/nieuws-2/');
$arraylala['12141'] = array( 'title' => 'DigiD', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/digid/');
$arraylala['12143'] = array( 'title' => 'Wet digitale overheid', 'liveurl' => '/wet-gdi/');
$arraylala['12560'] = array( 'title' => 'Documenten', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/documenten-2/');
$arraylala['13184'] = array( 'title' => 'Animatie Toegangsverleningservice', 'liveurl' => '/animatie-toegangsverleningservice/');
$arraylala['13322'] = array( 'title' => 'Regie op Gegevens', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/');
$arraylala['13325'] = array( 'title' => 'Vraag en antwoord', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vraag-en-antwoord/');
$arraylala['13329'] = array( 'title' => 'Documenten', 'liveurl' => '/documenten-2/');
$arraylala['13565'] = array( 'title' => 'Positie Functionaris Gegevensbescherming (FG) bij AVG', 'liveurl' => '/overzicht-van-alle-onderwerpen/naar-een-gegevenslandschap/aanpak-gegevenslandschap/factsheet-avg/positie-functionaris-gegevensbescherming-avg/');
$arraylala['17338'] = array( 'title' => 'Wet GDI', 'liveurl' => '/voorzieningen/identificatie-en-authenticatie/eid/wet-gdi-2/');
$arraylala['29998'] = array( 'title' => 'Maak Waar!', 'liveurl' => '/archief/studiegroeprapport-maak-waar/');
$arraylala['30004'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/studiegroeprapport-maak-waar/nieuws/');
$arraylala['30008'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/studiegroeprapport-maak-waar/documenten/');
$arraylala['30013'] = array( 'title' => 'Publieke waarden', 'liveurl' => '/archief/beleid/publieke-waarden/');
$arraylala['30016'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/publieke-waarden/nieuws/');
$arraylala['31824'] = array( 'title' => 'Rijk aan Informatie', 'liveurl' => '/archief/beleid/rijk-aan-informatie/');
$arraylala['31826'] = array( 'title' => 'Evenementen', 'liveurl' => '/archief/beleid/rijk-aan-informatie/evenementen/');
$arraylala['31829'] = array( 'title' => 'Nieuwsbrief', 'liveurl' => '/archief/beleid/rijk-aan-informatie/nieuwsbrief-rijk-aan-informatie/');
$arraylala['31991'] = array( 'title' => 'Wat zijn de basisfunctionaliteiten?', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/vraag-en-antwoord/wat-zijn-de-basisfunctionaliteiten/');
$arraylala['31999'] = array( 'title' => 'Wie werkt er mee aan MijnOverheid voor Ondernemers?', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/vraag-en-antwoord/werkt-er-mee-aan-mijnoverheid-ondernemers/');
$arraylala['32005'] = array( 'title' => 'Het ontwikkelproces', 'liveurl' => '/voorzieningen/overige-voorzieningen/movo/vraag-en-antwoord/het-ontwikkelproces/');
$arraylala['32517'] = array( 'title' => 'Onderzoek', 'liveurl' => '/archief/beleid/onderzoeksagenda-informatiesamenleving-en-overheid-2018/');
$arraylala['32524'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/beleid/onderzoeksagenda-informatiesamenleving-en-overheid-2018/documenten/');
$arraylala['32526'] = array( 'title' => 'Digicommissaris', 'liveurl' => '/archief/digicommissaris/');
$arraylala['32528'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/digicommissaris/nieuws/');
$arraylala['32531'] = array( 'title' => 'Documenten', 'liveurl' => '/archief/digicommissaris/documenten/');
$arraylala['32639'] = array( 'title' => 'Initiatieven', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/initiatieven/');
$arraylala['32697'] = array( 'title' => 'Het belang van persoonlijke gegevens', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/het-belang-van-persoonlijke-gegevens/');
$arraylala['32699'] = array( 'title' => 'Vertrouwen essentieel', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vertrouwen-essentieel/');
$arraylala['32701'] = array( 'title' => 'Nieuwe regelgeving op komst', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/nieuwe-regelgeving-op-komst/');
$arraylala['32703'] = array( 'title' => 'AVG, TOOP en PSD2', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/avg-toop-en-psd2/');
$arraylala['32705'] = array( 'title' => 'Er is meer nodig', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/er-is-meer-nodig/');
$arraylala['32707'] = array( 'title' => '‘iDeal voor Data’', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/ideal-voor-data/');
$arraylala['32709'] = array( 'title' => 'Men kijkt naar de overheid', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/men-kijkt-naar-de-overheid/');
$arraylala['32723'] = array( 'title' => 'Nieuws', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/nieuws/');
$arraylala['32728'] = array( 'title' => 'Wat doet het programma ‘Regie op Gegevens’?', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vraag-en-antwoord/wat-doet-het-programma-regie-op-gegevens/');
$arraylala['32730'] = array( 'title' => 'Als ik ‘regie’ heb over mijn gegevens, wat kan ik dan?', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vraag-en-antwoord/als-ik-regie-heb-over-mijn-gegevens-wat-kan-ik-dan/');
$arraylala['32732'] = array( 'title' => 'Kan ik dat allemaal, altijd en met alle gegevens?', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vraag-en-antwoord/kan-ik-dat-allemaal-altijd-en-met-alle-gegevens/');
$arraylala['32734'] = array( 'title' => 'Over wat voor gegevens gaat PDM?', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vraag-en-antwoord/over-wat-voor-gegevens-gaat-pdm/');
$arraylala['32740'] = array( 'title' => 'Is PDM een nieuw concept?', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vraag-en-antwoord/is-pdm-een-nieuw-concept/');
$arraylala['32742'] = array( 'title' => 'Wat is er nodig?', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/vraag-en-antwoord/wat-is-er-nodig/');
$arraylala['32914'] = array( 'title' => 'Over programma Regie op Gegevens', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/over-programma-regie-op-gegevens/');
$arraylala['32924'] = array( 'title' => 'Agenda', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/');
$arraylala['33123'] = array( 'title' => 'Open Source Software-Kennisnetwerk', 'liveurl' => '/archief/beleid/open-source-software-kennisnetwerk/');
$arraylala['33128'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/beleid/open-source-software-kennisnetwerk/nieuws/');
$arraylala['33169'] = array( 'title' => 'Werkconferentie ‘Gewoon zelf geregeld. Veilig & betrouwbaar’', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/');
$arraylala['33359'] = array( 'title' => 'Hackathon', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/hackathon/');
$arraylala['33361'] = array( 'title' => 'Scrum: de juiste spelregels?', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/scrum-juiste-spelregels/');
$arraylala['33363'] = array( 'title' => 'Workshop Juridische kaders regie op gegevens', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-juridische-kaders-regie-op-gegevens/');
$arraylala['33365'] = array( 'title' => 'Workshop Uniforme Set van Eisen en Impact Assessment', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-uniforme-set-van-eisen-en-impact-assessment/');
$arraylala['33367'] = array( 'title' => 'Workshop De Europese kijk op mensen en gegevens', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-eu-perspectief-regie-op-gegevens/');
$arraylala['33369'] = array( 'title' => 'Workshop Introductie regie op gegevens', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-introductie-regie-op-gegevens/');
$arraylala['33371'] = array( 'title' => 'Workshop Ontstaan en werking van afsprakenstelsels', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-governance/');
$arraylala['33373'] = array( 'title' => 'SBIR', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/sbir/');
$arraylala['33375'] = array( 'title' => 'Workshop Mijn financiën. Gewoon zelf geregeld.', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-mijn-financien-gewoon-zelf-geregeld/');
$arraylala['33377'] = array( 'title' => 'Workshop Mijn zorg. Gewoon zelf geregeld.', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-mijn-zorg-gewoon-zelf-geregeld/');
$arraylala['33379'] = array( 'title' => 'Workshop Mijn vervoer. Gewoon zelf geregeld.', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-mijn-vervoer-gewoon-zelf-geregeld/');
$arraylala['33381'] = array( 'title' => 'Workshop Mijn wooncarrière. Gewoon zelf geregeld.', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/workshop-mijn-wooncarriere-gewoon-zelf-geregeld/');
$arraylala['33514'] = array( 'title' => 'Programma werkconferentie', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/conferentie-regie-op-gegevens-28-juni-save-the-date/programma-werkconferentie/');
$arraylala['33906'] = array( 'title' => 'In beeld', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/regie-op-gegevens-de-praktijk-in-beeld/');
$arraylala['33961'] = array( 'title' => 'Verslag conferentie juni 2018', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/nieuws/verslag-conferentie-juni-2018/');
$arraylala['33985'] = array( 'title' => 'Hackathon (27 en 28 juni)', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/nieuws/verslag-conferentie-juni-2018/hackathon-27-en-28-juni/');
$arraylala['33996'] = array( 'title' => 'Werkconferentie (28 juni)', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/nieuws/verslag-conferentie-juni-2018/werkconferentie-28-juni/');
$arraylala['34110'] = array( 'title' => 'NL DIGIbeter', 'liveurl' => '/nldigibeter/');
$arraylala['34113'] = array( 'title' => 'Planning Agenda Digitale Overheid', 'liveurl' => '/nldigibeter/planning-agenda-digitale-overheid/');
$arraylala['34118'] = array( 'title' => 'Investeren in innovatie', 'liveurl' => '/nldigibeter/investeren-in-innovatie/');
$arraylala['34121'] = array( 'title' => 'Beschermen van grondrechten en publieke waarden', 'liveurl' => '/nldigibeter/beschermen-van-grondrechten-en-publieke-waarden/');
$arraylala['34124'] = array( 'title' => 'Toegankelijk, begrijpelijk en voor íedereen', 'liveurl' => '/nldigibeter/toegankelijk-begrijpelijk-en-voor-iedereen/');
$arraylala['34126'] = array( 'title' => 'Onze dienstverlening maken we persoonlijker', 'liveurl' => '/nldigibeter/onze-dienstverlening-maken-we-persoonlijker/');
$arraylala['34128'] = array( 'title' => 'Klaar voor de toekomst!', 'liveurl' => '/nldigibeter/klaar-voor-de-toekomst/');
$arraylala['34130'] = array( 'title' => 'Over de Agenda Digitale Overheid', 'liveurl' => '/nldigibeter/over-de-agenda-digitale-overheid/');
$arraylala['34162'] = array( 'title' => 'Slimmer – toegankelijker – persoonlijker', 'liveurl' => '/slimmer-toegankelijker-persoonlijker/');
$arraylala['34228'] = array( 'title' => 'Video’s NL DIGIbeter', 'liveurl' => '/nldigibeter/videos-nl-digibeter/');
$arraylala['34486'] = array( 'title' => 'Regelhulpen', 'liveurl' => '/voorzieningen/overige-voorzieningen/regelhulpen-2/');
$arraylala['34489'] = array( 'title' => 'Over ons', 'liveurl' => '/voorzieningen/overige-voorzieningen/regelhulpen-over-ons/');
$arraylala['34501'] = array( 'title' => 'Archief', 'liveurl' => '/archief/');
$arraylala['34651'] = array( 'title' => 'Nieuws', 'liveurl' => '/archief/nieuws/');
$arraylala['34732'] = array( 'title' => 'Hackathon RoG – 12 en 13 oktober', 'liveurl' => '/overzicht-van-alle-onderwerpen/regie-op-gegevens/agenda/hackathon-rog-12-en-13-oktober/');
$arraylala['34826'] = array( 'title' => 'Vraag en Antwoord', 'liveurl' => '/vraag-en-antwoord/');
$arraylala['34834'] = array( 'title' => 'Documenten', 'liveurl' => '/relevante-documenten/');
$arraylala['34837'] = array( 'title' => 'Blockchain', 'liveurl' => '/overzicht-van-alle-onderwerpen/blockchain/');
$arraylala['34840'] = array( 'title' => 'Projecten', 'liveurl' => '/tijdlijn-blockchain/');
$arraylala['34881'] = array( 'title' => 'Inhoud', 'liveurl' => '/overzicht-van-alle-onderwerpen/radio/');
$arraylala['34960'] = array( 'title' => 'ZZZ overzicht pagina’s', 'liveurl' => '/zzz-overzicht-paginas/');


      if ( $depth ) {
        $indent = str_repeat("\t", $depth);
      }
      else {
        $indent = '';
      }
          
      extract($args, EXTR_SKIP);

      $css_class = array('page_item', 'page-item-' . $page->ID);
  
      if ( !empty($current_page) ) {
          $_current_page = get_post( $current_page );

          if ( in_array( $page->ID, $_current_page->ancestors ) ) {
            $css_class[] = 'current_page_ancestor';
          }
          if ( $page->ID == $current_page ) {
            $css_class[] = 'current_page_item';
          }
          elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
            $css_class[] = 'current_page_parent';
          }
      }
      elseif ( $page->ID == get_option('page_for_posts') ) {
          $css_class[] = 'current_page_parent';
      }
  
      $css_class    = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
      $icon_class   = get_post_meta($page->ID, 'icon_class', true); //Retrieve stored icon class from post meta

      $pagetemplate = get_page_template_slug( $page->ID );

      $bestaatniet = 'VERWIJDERD  $arraylala[' . $page->ID . ']';

      $bestondal = false;

//      if ( isset( $arraylala[ (string) $page->ID ] ) ) {
      if ( $arraylala[ $page->ID ] ) {
        $bestondal = true;
      }

      if ( $bestondal ) {
        $oudeurl    = $arraylala[ $page->ID ]['liveurl'];
        $nieuweurl  = get_permalink( $page->ID );
        $nieuweurl  = str_replace( $_SERVER["HTTP_HOST"], '', $nieuweurl );
        $nieuweurl  = str_replace( 'http://', '', $nieuweurl );
        $nieuweurl  = str_replace( 'https://', '', $nieuweurl );

        $status = '<span class="dobug">VERPLAATST</span>';
        
        if ( $nieuweurl == $oudeurl ) {
          // niks veranderd
          $status = '<span class="nobug">NIETS MEE DOEN</span>';
  
          $output .= $indent . '<li class="' . $css_class . '">|' . $page->ID . '|' . $status . '|<a target="_blank" href="' . $nieuweurl . '">' . apply_filters( 'the_title', $page->post_title, $page->ID ) . '</a>' . $link_after . '|</li>';
          
        }
        else {
          // verplaatst
          $oudeurl    = 'https://www.digitaleoverheid.nl' . $oudeurl;
          $nieuweurl  = 'https://accept.digitaleoverheid.nl' . $nieuweurl;
          
          $output .= $indent . '<li class="' . $css_class . '">|' . $page->ID . '|' . $status . '|<br><a target="_blank" href="' . $oudeurl . '">' . $oudeurl . '</a>|<br><a target="_blank" href="' . $nieuweurl . '">' . $nieuweurl . '</a>|<br>' . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '|</li>';
        }
        
      }
      else {
        $output .= $indent . '<li class="' . $css_class . '">|' . $page->ID . '|<span class="nobug yellow">BESTOND NIET</span>|' . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '|' . get_permalink( $page->ID ) . '|</li>';
      }
  
  
    if ( !empty($show_date) ) {
      if ( 'modified' == $show_date ) {
        $time = $page->post_modified;
      }
      else {
        $time = $page->post_date;
        $output .= " " . mysql2date($date_format, $time);
      }
    }
  }

  // -------------------------
  
}

//========================================================================================================
