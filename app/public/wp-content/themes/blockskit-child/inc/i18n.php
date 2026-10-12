<?php
/**
 * Bilingual Engine (Arabic RTL / English LTR)
 * Ensures 100% pure Arabic with 0 English words in AR mode,
 * and 100% pure English with 0 Arabic words in EN mode.
 * Routes English to clean /en/ subdirectory architecture.
 *
 * @package Blockskit_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Determine current active language ('ar' or 'en').
 *
 * @return string
 */
function interior_get_current_lang() {
	// 1. URL Path is the authoritative source of truth
	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		$path = wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
		if ( preg_match( '#^/en(/.*)?$#i', $path ) ) {
			return 'en';
		}
	}

	// 2. Query var 'lang' set by rewrite rules
	if ( function_exists( 'get_query_var' ) && 'en' === get_query_var( 'lang' ) ) {
		return 'en';
	}

	// 3. Fallback for immediate query parameter handling
	if ( isset( $_GET['lang'] ) && 'en' === $_GET['lang'] ) {
		return 'en';
	}

	return 'ar'; // Default pure Arabic
}

/**
 * Register English rewrite rules and query vars.
 */
function interior_register_i18n_rewrites() {
	add_rewrite_tag( '%lang%', '([^&]+)' );

	$front_id = get_option( 'page_on_front' );
	if ( ! $front_id ) {
		$front_id = 7;
	}

	// 1. Front page in English: /en or /en/
	add_rewrite_rule(
		'^en/?$',
		'index.php?page_id=' . $front_id . '&lang=en',
		'top'
	);

	// 2. Project CPT in English: /en/project/<slug>/?
	add_rewrite_rule(
		'^en/project/([^/]+)/?$',
		'index.php?project=$matches[1]&lang=en',
		'top'
	);

	// 3. Regular pages in English: /en/<pagename>/?
	add_rewrite_rule(
		'^en/(.+?)/?$',
		'index.php?pagename=$matches[1]&lang=en',
		'top'
	);
}
add_action( 'init', 'interior_register_i18n_rewrites', 10 );

function interior_register_query_vars( $vars ) {
	$vars[] = 'lang';
	return $vars;
}
add_filter( 'query_vars', 'interior_register_query_vars' );

/**
 * Resolve standard posts under /en/<slug>/ when queried as pagename.
 */
function interior_resolve_bilingual_post_requests( $query_vars ) {
	if ( isset( $query_vars['pagename'] ) && isset( $query_vars['lang'] ) && 'en' === $query_vars['lang'] ) {
		$slug = $query_vars['pagename'];
		// Check if a regular page exists
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( ! $page ) {
			// Check if a post exists
			global $wpdb;
			$post_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'post' AND post_status = 'publish' LIMIT 1", $slug ) );
			if ( $post_id ) {
				unset( $query_vars['pagename'] );
				$query_vars['name'] = $slug;
				$query_vars['post_type'] = 'post';
			}
		}
	}
	return $query_vars;
}
add_filter( 'request', 'interior_resolve_bilingual_post_requests' );

/**
 * Prevent WordPress canonical redirect from stripping /en/ prefix.
 */
function interior_filter_redirect_canonical( $redirect_url, $requested_url ) {
	$requested_path = wp_parse_url( $requested_url, PHP_URL_PATH );

	if ( preg_match( '#^/en(/.*)?$#i', $requested_path ) ) {
		// Enforce trailing slash for English URLs if missing
		if ( ! str_ends_with( $requested_path, '/' ) ) {
			$parsed_req = wp_parse_url( $requested_url );
			$clean_path = trailingslashit( $requested_path );
			$new_url    = ( isset( $parsed_req['scheme'] ) ? $parsed_req['scheme'] . '://' : 'http://' )
						. $parsed_req['host']
						. ( isset( $parsed_req['port'] ) ? ':' . $parsed_req['port'] : '' )
						. $clean_path;
			if ( ! empty( $parsed_req['query'] ) ) {
				$new_url .= '?' . $parsed_req['query'];
			}
			return $new_url;
		}

		// Prevent WordPress core from redirecting English URL back to the Arabic root
		if ( $redirect_url ) {
			$redirect_path = wp_parse_url( $redirect_url, PHP_URL_PATH );
			if ( ! preg_match( '#^/en(/.*)?$#i', $redirect_path ) ) {
				return false; // Stop redirect; stay on valid English URL
			}
		}
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'interior_filter_redirect_canonical', 10, 2 );

/**
 * 301 Permanent Redirect for legacy ?lang= query parameters to clean paths.
 */
function interior_handle_legacy_lang_redirects() {
	if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}

	if ( ! isset( $_GET['lang'] ) ) {
		return;
	}

	$lang_param = sanitize_text_field( wp_unslash( $_GET['lang'] ) );
	if ( ! in_array( $lang_param, array( 'ar', 'en' ), true ) ) {
		return;
	}

	$req_uri  = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '/';
	$url_path = wp_parse_url( $req_uri, PHP_URL_PATH );
	$url_path = trailingslashit( $url_path );

	if ( 'en' === $lang_param ) {
		if ( ! preg_match( '#^/en(/.*)?$#i', $url_path ) ) {
			$new_path = '/en' . ( '/' === $url_path ? '/' : $url_path );
		} else {
			$new_path = $url_path;
		}
	} else {
		if ( preg_match( '#^/en(/.*)?$#i', $url_path ) ) {
			$new_path = preg_replace( '#^/en#i', '', $url_path );
			if ( empty( $new_path ) || '/' !== substr( $new_path, 0, 1 ) ) {
				$new_path = '/' . ltrim( $new_path, '/' );
			}
		} else {
			$new_path = $url_path;
		}
	}

	$query_params = $_GET;
	unset( $query_params['lang'] );

	$site_root    = untrailingslashit( get_option( 'home' ) );
	$redirect_url = $site_root . $new_path;
	if ( ! empty( $query_params ) ) {
		$redirect_url = add_query_arg( $query_params, $redirect_url );
	}

	wp_safe_redirect( $redirect_url, 301 );
	exit;
}
add_action( 'template_redirect', 'interior_handle_legacy_lang_redirects', 0 );

/**
 * Return an i18n-aware URL for the given path.
 *
 * @param string      $path Path relative to home (e.g. '/about/').
 * @param string|null $target_lang Specific language or null for current.
 * @return string Fully qualified URL.
 */
function interior_i18n_url( $path = '/', $target_lang = null ) {
	$lang = $target_lang ? $target_lang : interior_get_current_lang();
	$clean_path = '/' . ltrim( $path, '/' );

	if ( 'en' === $lang ) {
		if ( ! preg_match( '#^/en(/.*)?$#i', $clean_path ) ) {
			$clean_path = '/en' . ( '/' === $clean_path ? '/' : $clean_path );
		}
	} else {
		if ( preg_match( '#^/en(/.*)?$#i', $clean_path ) ) {
			$clean_path = preg_replace( '#^/en#i', '', $clean_path );
			if ( empty( $clean_path ) || '/' !== substr( $clean_path, 0, 1 ) ) {
				$clean_path = '/' . ltrim( $clean_path, '/' );
			}
		}
	}

	return home_url( $clean_path );
}

/**
 * Filter home_url so calls like home_url('/about/') in English mode return /en/about/.
 */
function interior_filter_home_url( $url, $path, $orig_scheme, $blog_id ) {
	static $in_filter = false;
	if ( $in_filter ) {
		return $url;
	}

	if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $url;
	}

	if ( 'en' !== interior_get_current_lang() ) {
		return $url;
	}

	// Do not rewrite assets, uploads, admin, api, or sitemap
	if ( ! empty( $path ) ) {
		if ( preg_match( '#^/?(wp-|sitemap|indexnow|favicon|robots)#i', $path ) ) {
			return $url;
		}
		if ( preg_match( '#\.(css|js|jpg|jpeg|png|gif|svg|webp|woff|woff2|ttf|json|xml|txt)$#i', $path ) ) {
			return $url;
		}
		if ( preg_match( '#^/?en(/.*)?$#i', $path ) ) {
			return $url;
		}
	}

	$base_home = untrailingslashit( get_option( 'home' ) );

	if ( empty( $path ) || '/' === $path ) {
		return $base_home . '/en/';
	}

	$clean_path = '/' . ltrim( $path, '/' );
	return $base_home . '/en' . $clean_path;
}
add_filter( 'home_url', 'interior_filter_home_url', 10, 4 );

/**
 * Filter language attributes to dynamically update lang and dir attributes.
 *
 * @param string $output
 * @return string
 */
function interior_filter_language_attributes( $output ) {
	$lang = interior_get_current_lang();
	if ( 'en' === $lang ) {
		return 'lang="en-US" dir="ltr"';
	}
	return 'lang="ar" dir="rtl"';
}
add_filter( 'language_attributes', 'interior_filter_language_attributes' );

/**
 * Filter WordPress locale so is_rtl() correctly reflects the active language.
 */
function interior_filter_locale( $locale ) {
	$lang = interior_get_current_lang();
	if ( 'en' === $lang ) {
		return 'en_US';
	}
	return 'ar';
}
add_filter( 'locale', 'interior_filter_locale', 99 );

/**
 * Filter body_class to replace rtl with ltr class when in English mode.
 */
function interior_filter_body_class( $classes ) {
	$lang = interior_get_current_lang();
	if ( 'en' === $lang ) {
		$classes = array_diff( $classes, array( 'rtl' ) );
		$classes[] = 'ltr';
	} else {
		$classes = array_diff( $classes, array( 'ltr' ) );
		$classes[] = 'rtl';
	}
	return $classes;
}
add_filter( 'body_class', 'interior_filter_body_class', 99 );

/**
 * Render the Header Language Switcher Component.
 */
function interior_render_lang_switcher() {
	$current_lang = interior_get_current_lang();
	$site_root    = untrailingslashit( get_option( 'home' ) );

	if ( is_front_page() ) {
		$pure_path = '/';
	} elseif ( is_singular() ) {
		$raw_path  = wp_parse_url( get_permalink(), PHP_URL_PATH );
		$pure_path = '/' . trim( preg_replace( '#^/en/#i', '/', $raw_path ), '/' ) . '/';
	} else {
		$req_path  = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) : '/';
		$pure_path = '/' . trim( preg_replace( '#^/en/#i', '/', $req_path ), '/' ) . '/';
	}

	$url_ar = $site_root . $pure_path;
	$url_en = $site_root . ( '/' === $pure_path ? '/en/' : '/en' . $pure_path );
	?>
	<div class="luxe-lang-switcher" aria-label="<?php echo 'en' === $current_lang ? 'Language Switcher' : 'تبديل لغة الموقع'; ?>">
		<a href="<?php echo esc_url( $url_ar ); ?>" class="luxe-lang-btn <?php echo 'ar' === $current_lang ? 'is-active' : ''; ?>" data-lang="ar" aria-label="النسخة العربية">عربي</a>
		<span class="luxe-lang-divider">/</span>
		<a href="<?php echo esc_url( $url_en ); ?>" class="luxe-lang-btn <?php echo 'en' === $current_lang ? 'is-active' : ''; ?>" data-lang="en" aria-label="English Edition">English</a>
	</div>
	<?php
}

/**
 * Filter gettext for WordPress core strings like skip link to guarantee strict bilingual purity.
 */
function interior_filter_core_strings( $translation, $text, $domain ) {
	if ( 'Skip to content' === $text ) {
		$lang = interior_get_current_lang();
		return 'en' === $lang ? 'Skip to content' : 'تخطى إلى المحتوى';
	}
	return $translation;
}
add_filter( 'gettext', 'interior_filter_core_strings', 10, 3 );

/**
 * Server-Side Render (SSR) HTML Translation Engine.
 * When in English mode, replaces all [data-i18n], [data-i18n-placeholder], [data-i18n-title], and [data-i18n-aria]
 * elements with their pure English translations before the HTML is sent to the client.
 */
function interior_ssr_translate_html( $html ) {
	static $en_dict = null;
	if ( null === $en_dict ) {
		$json_path = get_stylesheet_directory() . '/inc/i18n-dictionary.json';
		if ( file_exists( $json_path ) ) {
			$data    = json_decode( file_get_contents( $json_path ), true );
			$en_dict = isset( $data['en'] ) ? $data['en'] : array();
		} else {
			$en_dict = array();
		}
	}

	if ( empty( $en_dict ) || empty( $html ) ) {
		return $html;
	}

	// 1. Elements with data-i18n: <TAG attrs data-i18n="key" attrs>inner</TAG>
	$pattern = '/<([a-zA-Z0-9]+)([^>]*?\bdata-i18n=["\']([a-zA-Z0-9_\-]+)["\'][^>]*)>(.*?)<\/\1>/s';
	for ( $i = 0; $i < 2; $i++ ) {
		$html = preg_replace_callback( $pattern, function ( $matches ) use ( $en_dict ) {
			$tag   = $matches[1];
			$attrs = $matches[2];
			$key   = $matches[3];
			if ( isset( $en_dict[ $key ] ) ) {
				return '<' . $tag . $attrs . '>' . $en_dict[ $key ] . '</' . $tag . '>';
			}
			return $matches[0];
		}, $html );
	}

	// 2. Attributes: data-i18n-placeholder
	$p_pattern = '/(\bdata-i18n-placeholder=["\']([a-zA-Z0-9_\-]+)["\'][^>]*?\bplaceholder=["\'])([^"\']*)(["\'])/';
	$html      = preg_replace_callback( $p_pattern, function ( $matches ) use ( $en_dict ) {
		$prefix = $matches[1];
		$key    = $matches[2];
		$quote  = $matches[4];
		if ( isset( $en_dict[ $key ] ) ) {
			return $prefix . esc_attr( $en_dict[ $key ] ) . $quote;
		}
		return $matches[0];
	}, $html );

	// 3. Attributes: data-i18n-title
	$t_pattern = '/(\bdata-i18n-title=["\']([a-zA-Z0-9_\-]+)["\'][^>]*?\btitle=["\'])([^"\']*)(["\'])/';
	$html      = preg_replace_callback( $t_pattern, function ( $matches ) use ( $en_dict ) {
		$prefix = $matches[1];
		$key    = $matches[2];
		$quote  = $matches[4];
		if ( isset( $en_dict[ $key ] ) ) {
			return $prefix . esc_attr( $en_dict[ $key ] ) . $quote;
		}
		return $matches[0];
	}, $html );

	// 4. Attributes: data-i18n-aria
	$a_pattern = '/(\bdata-i18n-aria=["\']([a-zA-Z0-9_\-]+)["\'][^>]*?\baria-label=["\'])([^"\']*)(["\'])/';
	$html      = preg_replace_callback( $a_pattern, function ( $matches ) use ( $en_dict ) {
		$prefix = $matches[1];
		$key    = $matches[2];
		$quote  = $matches[4];
		if ( isset( $en_dict[ $key ] ) ) {
			return $prefix . esc_attr( $en_dict[ $key ] ) . $quote;
		}
		return $matches[0];
	}, $html );

	return $html;
}

/**
 * Initialize Output Buffer for SSR Translation when in English mode.
 */
function interior_start_ssr_i18n_buffer() {
	if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}
	if ( 'en' === interior_get_current_lang() ) {
		ob_start( 'interior_ssr_translate_html' );
	}
}
add_action( 'template_redirect', 'interior_start_ssr_i18n_buffer', 1 );
