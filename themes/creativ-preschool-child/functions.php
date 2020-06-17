<?php
/*
// nur gebraucht als es Child Theme war
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
*/

function requireDir($path) {
    $dir      = new RecursiveDirectoryIterator($path);
    $iterator = new RecursiveIteratorIterator($dir);
    foreach ($iterator as $file) {
        $fname = $file->getFilename();
        if (preg_match('%\.php$%', $fname)) {
            require($file->getPathname());
        }
    }
}

requireDir(get_template_directory() . "/ausgelagert");


// Update CSS within in Admin
function admin_style() {
	wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri() . '/admin.css' );
}

add_action( 'admin_enqueue_scripts', 'admin_style' );

/**
 * Adds a "My Page" link to the Toolbar.
 *
 * @param WP_Admin_Bar $wp_admin_bar Toolbar instance.
 */
function toolbar_link_to_mypage( $wp_admin_bar ) {
	$args = array(
		'id'    => 'github_h4k_wiki',
		'title' => 'H4K Wiki <i class="fa  fa-question-circle" style="color: lightgreen"></i>',
		'href'  => 'https://github.com/Fabioni/homeschooling4kids/wiki',
	);
	$wp_admin_bar->add_node( $args );
}
add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 999 );

// -------- https://ericholmes.ca/custom-post-type-date-archive-links-in-wordpress/

/**
 * This allows us to generate any archive link – plain, yearly, monthly, daily
 *
 * @param string $post_type
 * @param int $year
 * @param int $month (optional)
 * @param int $day (optional)
 *
 * @return string
 */
function EH_get_post_type_date_link( $post_type, $year, $month = 0, $day = 0 ) {
	global $wp_rewrite;
	$post_type_obj  = get_post_type_object( $post_type );
	$post_type_slug = $post_type_obj->rewrite['slug'] ? $post_type_obj->rewrite['slug'] : $post_type_obj->name;
	if ( $day ) { // day archive link
// set to today’s values if not provided
		if ( ! $year ) {
			$year = gmdate( 'Y', current_time( 'timestamp' ) );
		}
		if ( ! $month ) {
			$month = gmdate( 'm', current_time( 'timestamp' ) );
		}
		$link = $wp_rewrite->get_day_permastruct();
	} else if ( $month ) { // month archive link
		if ( ! $year ) {
			$year = gmdate( 'Y', current_time( 'timestamp' ) );
		}
		$link = $wp_rewrite->get_month_permastruct();
	} else { // year archive link
		$link = $wp_rewrite->get_year_permastruct();
	}
	if ( ! empty( $link ) ) {
		$link = str_replace( '%year%', $year, $link );
		$link = str_replace( '%monthnum%', zeroise( intval( $month ), 2 ), $link );
		$link = str_replace( '%day%', zeroise( intval( $day ), 2 ), $link );

		return home_url( $link . "&" . $post_type_slug );
	}

	return "fail";//home_url( "$post_type_slug" );
}

//end --------


if ( ! function_exists( 'creativ_preschool_banner_title' ) ) :
	/**
	 * Page Header
	 */
	function creativ_preschool_banner_title() {
		if ( ( is_front_page() && is_home() ) || is_home() ) {
			$your_latest_posts_title = creativ_preschool_get_option( 'your_latest_posts_title' );
			$titleUntertitel         = explode( "§", esc_html( $your_latest_posts_title ) ); ?>
			<h2 class="page-title"><?php echo $titleUntertitel[0] ?></h2>
			<?php if ( array_key_exists( 1, $titleUntertitel ) ): ?>
				<h3 class="page-subtitle"><?php echo $titleUntertitel[1] ?></h3><?php endif ?>
			<?php
		}

		if ( is_front_page() ) {
			//$your_latest_posts_title = creativ_preschool_get_option( 'child_your_frontpage_title' ); TODO eigene Variable erstellen
			$your_latest_posts_title = creativ_preschool_get_option( 'your_latest_posts_title' );
			$titleUntertitel         = explode( "§", esc_html( $your_latest_posts_title ) ); ?>
			<h2 class="page-title"><?php echo $titleUntertitel[0] ?></h2>
			<?php if ( array_key_exists( 1, $titleUntertitel ) ): ?>
				<h3 class="page-subtitle"><?php echo $titleUntertitel[1] ?></h3><?php endif ?>
			<?php
		} else {

			if ( is_singular() ) {
				the_title( '<h2 class="page-title">', '</h2>' );
			}

			if ( is_archive() ) {
				the_archive_description( '<div class="archive-description">', '</div>' );
				the_archive_title( '<h2 class="page-title">', '</h2>' );
			}

			if ( is_search() ) { ?>
				<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'creativ-preschool' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			<?php }

			if ( is_404() ) {
				echo '<h2 class="page-title">' . esc_html__( 'Error 404', 'creativ-preschool' ) . '</h2>';
			}
		}
	}
endif;

add_filter( 'get_the_archive_title', function ( $title ) {
	if ( is_post_type_archive() ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}
		$post_type_obj = get_post_type_object( $post_type );
		$title = $post_type_obj->labels->frontend_name;
		$titlePosttype = $title;
	}
	if ( is_year() ) {
		/* translators: Yearly archive title. %s: Year. */
		$titleDate = get_the_date( _x( 'Y', 'yearly archives date format' ) );
		$title     = $titleDate;
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. %s: Month name and year. */
		$titleDate = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
		$title     = $titleDate;
	} elseif ( is_day() ) {
		/* translators: Daily archive title. %s: Date. */
		$titleDate = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
		$title     = $titleDate;
	}

	if ( is_tax() ) {
		$term = single_term_title( '', false );
	}

	if ( is_post_type_archive() && is_date() ) {
		if (is_day()){
			$title = sprintf( '%s am %s', $titlePosttype, $titleDate );
		} elseif (is_month()){
			$title = sprintf( '%s im %s', $titlePosttype, $titleDate );
		} elseif (is_year()){
			$title = sprintf( '%s in %s', $titlePosttype, $titleDate );
		} else {
			$title = sprintf( '%s: %s', $titlePosttype, $titleDate );
		}
	}

	if ( is_post_type_archive() && is_tax() ) {
		$title = sprintf( '%s - %s', $titlePosttype, $term );;
	}

	if ( is_date() && is_tax() ) {
		$title = sprintf( '%s - %s', $titleDate, $term );;
	}

	if ( is_post_type_archive() && is_date() && is_tax() ) {
		$title = sprintf( '%s am %s - %s', $titlePosttype, $titleDate, $term );;
	}


	return $title;
} );



if ( ! function_exists( 'creativ_preschool_banner_header' ) ) :
	/**
	 * Page Header
	 */
	function creativ_preschool_banner_header() {
		$header_image = get_header_image();
		if ( is_singular() ) :
			$header_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $header_image;
		endif;

		if (is_front_page()){
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$sitelogo_url = wp_get_attachment_image_url( $custom_logo_id, 'full', false);
		}
		?>

		<div id="page-site-header">
			<img class="<?= (is_single() || is_page() && ! is_front_page()) ? get_field( "titelbild_volle_breite_oder_volle_hoehe_oder_contain" ) : (is_front_page() ? "contain" : "") ?>"
			     id="page-site-header-image"
			     src="<?= is_front_page() ? $sitelogo_url : esc_url( $header_image ); ?>">
			<div class="overlay"></div>

			<?php if (! is_front_page()) { ?>
			<header class='page-header'>
				<div class="wrapper">
					<?php creativ_preschool_banner_title(); ?>
				</div><!-- .wrapper -->
			</header>

			<?php } ?>

			<?php if (! is_single()){
				?>
				<img src="/wp-content/themes/creativ-preschool-child/assets/images/cloud-bg.png" class="cloud-bg" style="filter: contrast(0.74);">
				<?php
			}
			?>
			</div><!-- #page-site-header -->
		<?php einstellungen(); ?>
		<?php echo '<div class= "wrapper page-section">';
	}
endif;
add_action( 'creativ_preschool_banner_header', 'creativ_preschool_banner_header', 10 );





if ( ! function_exists( 'creativ_preschool_footer_section' ) ) :

	/**
	 * Footer copyright
	 *
	 * @since 1.0.0
	 */
	function creativ_preschool_footer_section() { ?>
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/top-cloud-bg.png' ) ?>">
		<div class="site-info">
			<?php
			$copyright_footer = creativ_preschool_get_option( 'copyright_text' );

			if ( ! empty( $copyright_footer ) ) {
				$copyright_footer = wp_kses_data( $copyright_footer );
			}
			?>
			<div class="wrapper">
				<!--
                <span class="copy-right"><?php echo esc_html( $copyright_footer ); ?> Child Theme of <a target="_blank"
                                                                                                        href="http://creativthemes.com/">Creativ Preschool Free</a> customized by <a
		                target="_blank" rel="designer" href="http://fabianscherer.de/">Fabian Scherer</a></span>
		                -->
				<span class="copy-right">Entwickelt von <a
						target="_blank" rel="designer" href="http://fabianscherer.de/">Fabian Scherer</a></span>
				<span>Soweit im Einzelfall nicht anders geregelt oder Rechte Dritter betroffen sind, unterliegen unsere Inhalte der folgenden Lizenz <a rel="license"
														   href="http://creativecommons.org/licenses/by-nc/4.0/"><img
							alt="Creative Commons Lizenzvertrag" style="border-width:0"
							src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png"/></a></span>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'fußzeile',
					'fallback_cb'    => false,
					'menu_class'     => "fußzeilenmenu elternbereich"
				) );
				?>
			</div><!-- .wrapper -->
		</div> <!-- .site-info -->

	<?php }

endif;
add_action( 'creativ_preschool_action_footer', 'creativ_preschool_footer_section', 20 );

if ( ! function_exists( 'creativ_preschool_child_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function creativ_preschool_child_setup() {

		// This theme uses wp_nav_menu() in one other location.
		register_nav_menus( array(
			'fußzeile' => esc_html__( 'Fußzeile', 'creativ-preschool-child' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'creativ_preschool_child_setup' );


function redirect_to_todays_fachbeitrag() {

	if ( false ) {
		exit( wp_redirect( home_url( '/?m=20200324' ) ) ); //TODO heutiger Tag nicht Hardcoden! und eigentlich ja heutiger Fachbeitrag und nicht Tag
	}
}

add_action( 'template_redirect', 'redirect_to_todays_fachbeitrag', 1 );






add_action( 'pre_get_posts', 'djg_includ_my_cpt_in_query', 99 );
function djg_includ_my_cpt_in_query( $query ) {

	if ( is_home() && $query->is_main_query() || $query->is_date() ) :              // Ensure you only alter your desired query

		$post_types = $query->get( 'post_type' );             // Get the currnet post types in the query

		if ( ! is_array( $post_types ) && ! empty( $post_types ) )   // Check that the current posts types are stored as an array
		{
			$post_types = explode( ',', $post_types );
		}

		if ( empty( $post_types ) )                              // If there are no post types defined, be sure to include posts so that they are not ignored
		{
			$post_types   = array( 'post' );
			$post_types[] = 'fachbeitrag';                      // Add your custom post type
			$post_types[] = 'gutzuwissenbeitrag';
			$post_types[] = 'spassbeitrag';
		}

		$post_types = array_map( 'trim', $post_types );       // Trim every element, just in case
		$post_types = array_filter( $post_types );            // Remove any empty elements, just in case

		$query->set( 'post_type', $post_types );              // Add the updated list of post types to your query

	endif;

	return $query;

}


function fabian_getKorrekteur() {
	if ( isset( $_COOKIE['fabian-korrektur'] ) ) {
		return true;
	} else {
		return false;
	}
}

function fabian_setKorrekteur( $value ) {
	if ( $value ) {
		setcookie( "fabian-korrekteur", $value, time() + 10 * 365 * 24 * 3600 );  // verfällt in 1 Stunde
	} else {
		if ( isset( $_COOKIE['fabian-korrekteur'] ) ) {
			unset( $_COOKIE['fabian-korrekteur'] );
			setcookie( 'fabian-korrekteur', '', time() - 3600 ); // empty value and old timestamp
		}
	}
}


add_action( 'wp_enqueue_scripts', 'themeprefix_scripts' );
function themeprefix_scripts() {
	wp_enqueue_style( 'fabian-stickynoteFont', "https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" );
}


/*function example_getarchives_where($where)
{
	return str_replace("WHERE post_type = 'post'", "WHERE post_type IN ('post', 'spassbeitrag', 'fachbeitrag', 'gutzuwissenbeitrag')", $where);
}
add_filter('getarchives_where', 'example_getarchives_where');*/



function add_meta_tags() {
	if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
		echo '<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">';
	}
}

add_action( 'wp_head', 'add_meta_tags' );
add_action( 'admin_head', 'add_meta_tags' );


function add_h4k_dataKeys_DataList(){
	?>
	<datalist id="h4k-dataKeys">
		<option value="audioStelle"></option>
		<option value='übersetzungsTeil'></option>
	</datalist>
	<?php
}

add_action("admin_head", "add_h4k_dataKeys_DataList");


add_filter( 'get_post_status', function ( $post_status, $post ) {
	if ( isset( $_GET['korrektur'] ) && $_GET['korrektur'] == "true" && $post_status == 'future' ) {
		return "publish";
	}

	return $post_status;
}, 10, 2 );



function wiederkehrenderNutzerCookie(){
	if (isset($_COOKIE["firstTimeUsage"])){
		// Fehler dass ich das mal ohne strval gespeichert hatte:
		$korrigierteZahlWTF = intval(preg_replace('/[^0-9]/', '', $_COOKIE["firstTimeUsage"]));
		setcookie("erstbenutzung", strval($korrigierteZahlWTF), time() + 10 * 365 * 24 * 3600, "/" );
		setcookie("firstTimeUsage", "", time()-3600, "/");
	}
	if (! isset($_COOKIE["erstbenutzung"])) {setcookie( "erstbenutzung", strval(time()), time() + 10 * 365 * 24 * 3600, "/" );}  // verfällt in 10 Jahren
	if (! isset($_COOKIE["guid"])) {setcookie( "guid", uniqid("h4k"), time() + 10 * 365 * 24 * 3600, "/" );}  // verfällt in 10 Jahren
}
add_action( 'init', 'wiederkehrenderNutzerCookie', 0 );


$h4k_machAufmerksam = false;
function aufmerksam_check_body_class(){
	global $h4k_machAufmerksam;
	if (isset($_COOKIE["erstbenutzung"]) && is_front_page()) {
		if ($_COOKIE["erstbenutzung"] < strtotime("11.05.2020 13:00:00")){
			if (! isset($_COOKIE["aufmerksamThemenwelt"])){
				setcookie( "aufmerksamThemenwelt", strval(1), time() + 10 * 365 * 24 * 3600, "/" );
				$h4k_machAufmerksam = true;
			} elseif ($_COOKIE["aufmerksamThemenwelt"] < 5){
				setcookie( "aufmerksamThemenwelt", strval(intval($_COOKIE["aufmerksamThemenwelt"])+1), time() + 10 * 365 * 24 * 3600, "/" );
				$h4k_machAufmerksam = true;
			}
		}
	}
}
add_filter('wp', 'aufmerksam_check_body_class');

function aufmerksam_body_class($classes) {
	global $h4k_machAufmerksam;
	if ($h4k_machAufmerksam){$classes[] = "machAufmerksam";}

	return $classes;
}
add_filter('body_class', 'aufmerksam_body_class');


/**
 * Gutenberg scripts and styles
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 */
function be_gutenberg_scripts() {

	wp_enqueue_script(
		'be-editor',
		get_stylesheet_directory_uri() . '/assets/js/editor.js',
		array( 'wp-blocks', 'wp-dom' ),
		filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );


add_filter('wp_ulike_counter_value', 'wp_ulike_change_count', 10, 2);
function wp_ulike_change_count($counter_value) {
	if (is_user_logged_in()){
		return $counter_value;
	} else {
		//return $counter_value + get_the_ID() % 15;
		return floor($counter_value * 2.5);
	}
}






function oembed_iframe_overrides($html, $url, $attr) {

	if ( strpos( $html, "<iframe" ) !== false ) {
		return str_replace('sandbox="allow-scripts', 'allowfullscreen sandbox="allow-scripts allow-same-origin ', $html); }
	else {
		return $html;
	}
}
add_filter( 'embed_oembed_html', 'oembed_iframe_overrides', 10, 3);

add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
function your_custom_menu_item ( $items, $args ) {
	if ($args->theme_location == 'primary') {
		$form = do_shortcode('[ivory-search id="3652" title="Default Search Form"]'); //3283 für one.wordpress.test
		$li = <<<EOD
<li class="fa fa-search astm-search-menu desktopsearch menu-item is-menu popup">
    <a>Suche</a>
    <ul class="sub-menu" style="width: 225px;">
        <li class="astm-search-menu is-menu default menu-item">
            $form
        </li>
    </ul>
</li>
EOD;

		$li2 = <<<EOD
<li class=" astm-search-menu is-menu default">
$form
</li>
EOD;

		$items .= $li . $li2;
	}
	return $items;
}

function archive_posts_aufklappen(){
	?>
<script>
	jQuery(function () {
		jQuery(".makevorschau article").click(function (event) {
			if (jQuery(this).hasClass("open")){
				return;
			}
			jQuery(".makevorschau article").removeClass("open");
			jQuery(this).addClass("open");
			if (window.matchMedia("(max-width: 783px)").matches) {
				event.preventDefault();
				setTimeout(function (t) {
					jQuery(t).get(0).scrollIntoView({behavior: "smooth", block: "nearest", inline: "nearest"});
				}, 1000, this)
			}
		})
	})
</script>
<?php
}

add_action("wp_footer", "archive_posts_aufklappen");



function prefix_movie_rewrite_rule() {
	add_rewrite_rule( '^archive/thema$', 'index.php?pagename=themenwelt', 'top' );
	add_rewrite_rule( '^archive/thema/$', 'index.php?pagename=themenwelt', 'top' );
}

add_action( 'init', 'prefix_movie_rewrite_rule' );


function my_enqueue_stuff() {
	if (true || is_page_template( 'page-themenwelt' ) ) {
		wp_enqueue_style( 'timelinestyle', get_stylesheet_directory_uri() . '/extern/style.css' );
		wp_enqueue_script("isinviewport", get_stylesheet_directory_uri() . '/extern/isInViewport.min.js');
		//wp_enqueue_script( 'timelinescript', get_stylesheet_directory_uri() . '/extern/index.js' );
		//wp_enqueue_script("scrollreveal", "https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js");
	} else {
		/** Call regular enqueue */
	}
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_stuff' );

//ENDE-- Projekte

/*URL-Feld ausblenden */
add_filter('comment_form_default_fields', 'remove_url');
function remove_url($fields) {
	if(isset($fields['url']))
		unset($fields['url']);
	return $fields;
}
function wp44138_change_comment_form_cookies_consent( $fields ) {
	$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
	$fields['cookies'] = '<p class="comment-form-cookies-consent">' .
						 '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
						 '<label for="wp-comment-cookies-consent">' . "Meinen Namen und E-Mail in diesem Browser speichern, bis ich wieder kommentiere." . '</label>' .
						 '</p>';
	return $fields;
}
add_filter( 'comment_form_default_fields', 'wp44138_change_comment_form_cookies_consent' );


add_action("wp_footer", function (){
	if (! is_page()) return;
	$übersetzungen = get_field("ubersetzung");
	$übersetzungen = preg_replace("/\r\n/", "\n", $übersetzungen);

	$re = '/Sprache:\s*(.*)\s*((?:Teil:\s.*\s{.*}\s*)*)/m';
	$sprachen = [];

	preg_match_all($re, $übersetzungen, $matches, PREG_SET_ORDER, 0);
	foreach ($matches as $match){
		$sprachen[$match[1]] = [];
		preg_match_all("/Teil:\s(.*)\R{(.*)}/m", $match[2], $matches2, PREG_SET_ORDER, 0);
		foreach ($matches2 as $pla){
			$sprachen[$match[1]][$pla[1]] = $pla[2];
		}
	}
	?>
<script>
	var übersetzungen = <?= json_encode($sprachen, JSON_UNESCAPED_UNICODE) ?>

	function übersetzeZu(sprache) {
		jQuery('[data-übersetzungsteil]').each(function () {
			if (übersetzungen[sprache][jQuery(this).data('übersetzungsteil')] !== undefined){
				jQuery(this).html(übersetzungen[sprache][jQuery(this).data('übersetzungsteil')]);
			} else {
				jQuery(this).html(übersetzungen["Deutsch"][jQuery(this).data('übersetzungsteil')]);
			}
		}, sprache)
	}

	jQuery(function () {
		if (Object.keys(übersetzungen).length > 0) {
			jQuery(".einstellungen").append("<label>Sprache:\n" +
				"\t\t<select id=\"sprachAuswahl\">\n" +
				"\t\t\t<option selected>Deutsch</option>" +
				"\t\t</select>\n" +
				"\t</label>");

			Object.keys(übersetzungen).forEach(function (key) {
				jQuery("#sprachAuswahl").append("\t\t\t<option>" + key + "</option>")
			});

			übersetzungen["Deutsch"] = {}
			jQuery('[data-übersetzungsteil]').each(function () {
				übersetzungen["Deutsch"][jQuery(this).data('übersetzungsteil')] = jQuery(this).html();
			})

			jQuery("#sprachAuswahl").change(function () {
				console.log(jQuery(this).val());
				übersetzeZu(jQuery(this).val());
			})
		}
	})
</script>
<?php
});



add_action( 'wp_enqueue_scripts', function (){
	wp_enqueue_script("toastr-script", "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js");
	wp_enqueue_style("toastr-style", "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css");
    wp_enqueue_script( 'h4k-custom-js', get_template_directory_uri() . '/assets/js/h4kcustom.js', array('jquery'), '20200524', true );
} );

if (strpos($_SERVER['HTTP_HOST'], "dev") !== false)
{
	// Replace src paths
	add_filter('wp_get_attachment_url', function ($url)
	{
		if(file_exists($url))
		{
			return $url;
		}
		preg_match("/(.*)\/wp-content\//", $url, $m);
		$home = $m[1];
		return str_replace($home, 'https://homeschooling4kids.at', $url);
	});

	// Replace srcset paths
	add_filter('wp_calculate_image_srcset', function($sources)
	{
		foreach($sources as &$source)
		{
			if(!file_exists($source['url']))
			{
				preg_match("/(.*)\/wp-content\//", $source['url'], $m);
				$home = $m[1];
				$source['url'] = str_replace($home, 'https://homeschooling4kids.at', $source['url']);
			}
		}
		return $sources;
	});
}

function averageColor($filelocation){
	if (false !== ($color = get_transient("averageColor@" . $filelocation))){
		return $color;
	}
	try {
		$image = imagecreatefromstring(file_get_contents($filelocation));
		if ($image === false) return null;
		$width = imagesx($image);
		$height = imagesy($image);

		$pixel = imagecreatetruecolor(1, 1);
		imagealphablending( $pixel, false );
		imagesavealpha( $pixel, true );
		imagecopyresampled($pixel, $image, 0, 0, 0, 0, 1, 1, $width, $height);
		$rgb = imagecolorat($pixel, 0, 0);
		$color = imagecolorsforindex($pixel, $rgb);

		if ($color['alpha'] > 0){
			$color = averageColorTrans($filelocation);
		}
		set_transient("averageColor@" . $filelocation, $color);
		return $color;
	} catch (Exception $e){
		return null;
		//nothing
	}

}

function averageColorTrans($filelocation) {
	$r_total = $g_total = $b_total = $total = 0;
	$image = imagecreatefromstring(file_get_contents($filelocation));
	if ($image === false) return null;
	//$q = imagesx($image) / imagesy($image);
	//$i = imagescale($image, $q * 100, 100);
	$i = $image;
	for ($x=0;$x<imagesx($i);$x++) {
		for ($y=0;$y<imagesy($i);$y++) {
			$rgb = imagecolorat($i,$x,$y);
			$color = imagecolorsforindex($i, $rgb);
			$r = $color['red'];
			$g = $color['green'];
			$b = $color['blue'];
			$alpha = $color['alpha'];

			$anteil = (127-$alpha)/127;

			if ($alpha > 100) continue;

			$r_total += $r*$anteil;
			$g_total += $g*$anteil;
			$b_total += $b*$anteil;
			$total += $anteil;
		}
	}

	$r = round($r_total / $total);
	$g = round($g_total / $total);
	$b = round($b_total / $total);

	return array("red" => $r, "green" => $g, "blue" => $b);
}

function lightDown($colors, $schwelle){
	$r = 0.2126*$colors['red'];
	$g = 0.7152*$colors['green'];
	$b = 0.0722*$colors['blue'];

	$sum = $r + $g + $b;
	$diff = max($sum - $schwelle, 0);
	$neu = array("red" => $colors['red']-($diff), "green" => $colors['green']-($diff), "blue" => $colors['blue']-($diff));
	return $neu;
	/* werte können unter 0 gehen, deswegen wird es auch bei einer Schwelle von 0 nicht ganz schwarz*/
}

function lightUp($colors, $schwelle){
	$r = 0.2126*$colors['red'];
	$g = 0.7152*$colors['green'];
	$b = 0.0722*$colors['blue'];

	$sum = $r + $g + $b;
	$diff = max( $schwelle - $sum, 0);
	$neu = array("red" => $colors['red']+($diff), "green" => $colors['green']+($diff), "blue" => $colors['blue']+($diff));
	return $neu;
	/* werte können übber 255 gehen, deswegen wird es auch bei einer Schwelle von 255 nicht ganz weiß*/
}

function isGray($colors, $schwelle){
	$diff = max(abs($colors['red'] - $colors['green']), abs($colors['red'] - $colors['blue']), abs($colors['blue'] - $colors['green']));
	return $diff < $schwelle;
}

require get_template_directory() . '/functionsParent.php';
