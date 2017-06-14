<?php
/*
Plugin Name: CDN Loader
Description: This plugin will load your assets from a given CDN instead of the local server.
Author: Danny van Kooten (fork modification by Sampo Haavisto to allow more assets to be CDN'd)
Version: 1.0.0
Author URI: https://dannyvankooten.com/
*/

namespace CDN_Loader;

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'template_redirect', function() {

	// Don't run if SCRIPT_DEBUG is set to true
	if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return;
	}

	// load class
	require_once __DIR__ . '/src/UrlRewriter.php';

	// get url of cdn & site
	$cdn_urls = array();

  if ( defined( 'DVK_CDN_STYLE_URL' ) ) {
    $cdn_urls["style"] = DVK_CDN_STYLE_URL;
  }
  if ( defined( 'DVK_CDN_THEME_URL' ) ) {
    $cdn_urls["theme"] = DVK_CDN_THEME_URL;
  }
  if ( defined( 'DVK_CDN_PLUGINS_URL' ) ) {
    $cdn_urls["plugins"] = DVK_CDN_PLUGINS_URL;
  }
  if ( defined( 'DVK_CDN_SCRIPT_URL' ) ) {
    $cdn_urls["script"] = DVK_CDN_SCRIPT_URL;
  }

	$site_url = get_site_url();

	// instantiate class
	$url_rewriter = new UrlRewriter( $cdn_urls, $site_url );
	$url_rewriter->add_hooks();
});
