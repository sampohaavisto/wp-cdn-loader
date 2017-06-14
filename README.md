# CDN Loader for WordPress

> Forked from [@dannyvankooten](https://github.com/dannyvankooten/wp-cdn-loader)'s plugin to allow a private `WP_SITE_URL` and a public `WP_HOME`. Now we can go ahead and isolate `/wp-admin` in to a private network.

Simple plugin that will rewrite/load all public assets from a CDN instead of dictated by WP_SITE_URL.

### Usage

1. Install the plugin
2. Define the following constant in your `wp-config.php`

```php
define( 'DVK_CDN_STYLE_URL', '//xxxxxx.cloudfront.net' );
define( 'DVK_CDN_THEME_URL', '//xxxxxx.cloudfront.net' );
define( 'DVK_CDN_PLUGINS_URL', '//xxxxxx.cloudfront.net' );
define( 'DVK_CDN_SCRIPT_URL', '//xxxxxx.cloudfront.net' );
```

The plugin won't replace assets when `SCRIPT_DEBUG` is enabled.
