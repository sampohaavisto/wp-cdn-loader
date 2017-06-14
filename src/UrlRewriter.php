<?php

namespace CDN_Loader;

class UrlRewriter {
	/**
	 * @var string
	 */
	private $cdn_urls = array();

	/**
	 * @var string
	 */
	private $site_url = '';

	/**
	 * Constructor
	 *
	 * @param string $cdn_url
	 * @param string $site_url
	 */
	public function __construct( $cdn_urls, $site_url ) {
		// Store cdn url & site url in property
		$this->cdn_urls = $cdn_urls;
		$this->site_url = $site_url;
	}

	public function add_hooks() {
		// add nothing if cdn url is empty
		if( count($this->cdn_urls) === 0 && is_array($this->cdn_urls) ) {
			return false;
		}

		// add rewrite filters for plugin & theme assets
		if ( isset( $this->cdn_urls['theme'] ) ) {
			add_filter( 'theme_root_uri', array( $this, 'rewrite_theme' ), 99, 1 );
		}
		if ( isset( $this->cdn_urls['plugins'] ) ) {
			add_filter( 'plugins_url', array( $this, 'rewrite_plugins' ), 99, 1 );
		}

		// add rewrite filters for custom scripts and styles
		if ( isset( $this->cdn_urls['script'] ) ) {
			add_filter( 'script_loader_src', array( $this, 'rewrite_scripts' ), 99, 1 );
		}
		
		if ( isset( $this->cdn_urls['style'] ) ) {
			add_filter( 'style_loader_src', array( $this, 'rewrite_styles' ), 99, 1 );
		}
		return true;
	}

	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	public function rewrite_scripts( $url ) {
		$url = str_replace( $this->site_url, $this->cdn_urls["script"], $url );
		return $url;
	}

	public function rewrite_plugins( $url ) {
		$url = str_replace( $this->site_url, $this->cdn_urls["plugins"], $url );
		return $url;
	}

	public function rewrite_styles( $url ) {
		$url = str_replace( $this->site_url, $this->cdn_urls["style"], $url );
		return $url;
	}

	public function rewrite_theme( $url ) {
		$url = str_replace( $this->site_url, $this->cdn_urls["theme"], $url );
		return $url;
	}

}