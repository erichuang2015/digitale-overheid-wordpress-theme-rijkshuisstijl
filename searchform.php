<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - searchform.php
// * ----------------------------------------------------------------------------------
// * Overwrite default searchform
// * ----------------------------------------------------------------------------------
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 1.2.7
// * @desc.   Voor dossiers: automatische links toegevoegd voor berichten, events, documenten. Plus: search form in breadcrumb.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

//========================================================================================================
?>
<div id="searchForm" class="searchForm initSearch searchOpened" data-search-closed="Open het zoekveld" data-search-opened="Zoeken">
  <form method="get" action="/zoeken" id="search-form">
    <label for="search-keyword">Zoek binnen Rijkshuisstijl</label> 
    <div class="clearFieldWrapper"><input type="text" id="search-keyword" class="searchInput" name="trefwoord" title="Type hier uw zoektermen" placeholder="Zoeken"><button class="clearField" type="button">invoer wissen</button></div>
    <button id="search-submit" class="searchSubmit" name="search-submit" type="submit" title="Zoeken">Zoeken</button>
  </form>
</div>

<form tabindex="-1" id="rhswp-searchform-nav-primary" class="search-form" itemprop="potentialAction" itemscope="" itemtype="https://schema.org/SearchAction" method="get" action="http://appelflap.local:5757/" role="search"><meta itemprop="target" content="http://appelflap.local:5757/?s={s}"><label class="search-form-label screen-reader-text" for="searchform-5b76693b620789.96992489">Zoek op deze website</label><input itemprop="query-input" type="search" name="s" id="searchform-5b76693b620789.96992489" placeholder="Zoek op deze website …"><input type="submit" value="Zoek"></form>

the get_search_form() fun
