<?php
/*
// nur gebraucht als es Child Theme war
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
*/

// Update CSS within in Admin
function admin_style() {
	wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri() . '/admin.css' );
}

add_action( 'admin_enqueue_scripts', 'admin_style' );


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
		$titlePosttype = post_type_archive_title( '', false );
		$title         = $titlePosttype;
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
		$title = sprintf( '%s am %s', $titlePosttype, $titleDate );;
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
		?>

		<div id="page-site-header">
			<img class="<?= get_field( "titelbild_volle_breite_oder_volle_hoehe_oder_contain" ) ?>"
			     id="page-site-header-image"
			     src="<?php echo esc_url( $header_image ); ?>">
			<div class="overlay"></div>
			<header class='page-header'>
				<div class="wrapper">
					<?php creativ_preschool_banner_title(); ?>
				</div><!-- .wrapper -->
			</header>
		</div><!-- #page-site-header -->
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
                <span class="copy-right"><?php echo esc_html( $copyright_footer ); ?> Child Theme of <a target="_blank"
                                                                                                        href="http://creativthemes.com/">Creativ Preschool Free</a> customized by <a
		                target="_blank" rel="designer" href="http://fabianscherer.de/">Fabian Scherer</a></span>
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


function get_heute_seite() {
	$today = getdate();
	$args  = array(
		'post_type'      => 'fachbeitrag',
		'post_status'    => 'publish',
		'posts_per_page' => - 1,
		//'orderby' => 'title',
		'order'          => 'ASC',
		'date_query'     => array(
			array(
				'year'  => $today['year'],
				'month' => $today['mon'],
				'day'   => $today['mday'],
			),
		),
	);
	$loop  = new WP_Query( $args );

	if ( $loop->have_posts() ) {
		if ( $loop->post_count > 1 ) {
			return array( get_site_url() . "?post_type=fachbeitrag&m=" . current_time( "Ymd" ), false );
			// TODO ACHTUNG BEI ÄNDERUNG DER LINK STRUKTUR!!!
			/*return wp_get_archives(array("before" => "before", "after" => "after", 'echo' => false, "format" => "", "post_type" => "fachbeitrag"));
			//return wp_get_archives(array("echo" => false, "post_type" => "fachbeitrag"));
			global $wp_rewrite;
			$link = $wp_rewrite->get_day_permastruct();
			return $wp_rewrite->get_day_permastruct();
			$link = str_replace( '%year%', $today['year'], $link );
			$link = str_replace( '%monthnum%', zeroise( intval( $today['mon'] ), 2 ), $link );
			$link = str_replace( '%day%', zeroise( intval( $today['mday'] ), 2 ), $link );
			return $link;
			//return get_day_link( $today['year'], $today['mon'], $today['mday'] );
			*/
		} elseif ( $loop->post_count == 1 ) {
			$loop->the_post();

			return array( get_permalink(), get_the_title() );
		} else {
			return false;
		}
	} else {
		return null;
	}
	//wp_reset_postdata(); //TODO drüber nachdenken ob ich das brauch
}


// --------------------- wie category

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_Leistungsstufe_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_Leistungsstufe_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

	$labels = array(
		'name'          => "Leistungsstufen", //_x( 'Topics', 'taxonomy general name' ),
		'singular_name' => "Leistungsstufe", //_x( 'Topic', 'taxonomy singular name' ),
		/*'search_items' =>  __( 'Search Topics' ),
		'all_items' => __( 'All Topics' ),
		'parent_item' => __( 'Parent Topic' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item' => __( 'Edit Topic' ),
		'update_item' => __( 'Update Topic' ),
		'add_new_item' => __( 'Add New Topic' ),
		'new_item_name' => __( 'New Topic Name' ),
		'menu_name' => __( 'Topics' ),*/
	);

// Now register the taxonomy

	register_taxonomy( 'leistungsstufe', array( 'fachbeitrag' ), array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		//'rewrite' => array( 'slug' => 'topic' ),
	) );

}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_Fach_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_Fach_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

	$labels = array(
		'name'          => "Fächer", //_x( 'Topics', 'taxonomy general name' ),
		'singular_name' => "Fach", //_x( 'Topic', 'taxonomy singular name' ),
		/*'search_items' =>  __( 'Search Topics' ),
		'all_items' => __( 'All Topics' ),
		'parent_item' => __( 'Parent Topic' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item' => __( 'Edit Topic' ),
		'update_item' => __( 'Update Topic' ),
		'add_new_item' => __( 'Add New Topic' ),
		'new_item_name' => __( 'New Topic Name' ),
		'menu_name' => __( 'Topics' ),*/
	);

// Now register the taxonomy

	register_taxonomy( 'fach', array( 'fachbeitrag' ), array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		//'rewrite' => array( 'slug' => 'topic' ),
	) );

}

// ---------------------//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_spasskategorien_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_spasskategorien_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

	$labels = array(
		'name'          => "Spaßkategorien", //_x( 'Topics', 'taxonomy general name' ),
		'singular_name' => "Spaßkategorie", //_x( 'Topic', 'taxonomy singular name' ),
		/*'search_items' =>  __( 'Search Topics' ),
		'all_items' => __( 'All Topics' ),
		'parent_item' => __( 'Parent Topic' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item' => __( 'Edit Topic' ),
		'update_item' => __( 'Update Topic' ),
		'add_new_item' => __( 'Add New Topic' ),
		'new_item_name' => __( 'New Topic Name' ),
		'menu_name' => __( 'Topics' ),*/
	);

// Now register the taxonomy

	register_taxonomy( 'spasskategorie', array( 'spassbeitrag' ), array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		//'rewrite' => array( 'slug' => 'topic' ),
	) );

}

// ---------------------

// --------------------- wie tags

//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires

add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );

function create_topics_nonhierarchical_taxonomy() {

// Labels part for the GUI

	$labels = array(
		'name'          => "Schlagwörter", //_x( 'Topics', 'taxonomy general name' ),
		'singular_name' => "Schlagwort", //_x( 'Topic', 'taxonomy singular name' ),
		/*'search_items' =>  __( 'Search Topics' ),
		'popular_items' => __( 'Popular Topics' ),
		'all_items' => __( 'All Topics' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Topic' ),
		'update_item' => __( 'Update Topic' ),
		'add_new_item' => __( 'Add New Topic' ),
		'new_item_name' => __( 'New Topic Name' ),
		'separate_items_with_commas' => __( 'Separate topics with commas' ),
		'add_or_remove_items' => __( 'Add or remove topics' ),
		'choose_from_most_used' => __( 'Choose from the most used topics' ),
		'menu_name' => __( 'Topics' ),*/
	);

// Now register the non-hierarchical taxonomy like tag

	register_taxonomy( 'schlagwort', array( 'spassbeitrag', 'gutzuwissenbeitrag' ), array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
	) );
}

// ---------------------


// Our custom post type function
function create_Fachbeitragtype() {

	register_post_type( 'fachbeitrag',
		// CPT Options
		array(
			'labels'        => array(
				'name'          => __( 'Fachbeiträge' ),
				'singular_name' => __( 'Fachbeitrag' )
			),
			//'description'   => "Beiträge, die jeden Tag raus kommen zu Mathe, Deutsch und Co",
			'description'   => "",
			'public'        => true,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'rewrite'       => array( 'with_front' => false, 'slug' => 'fachbeitrag' ),
			'menu_position' => 4,
			'taxonomies'    => array( "fach", "leistungsstufe" ),
			'supports'      => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author', 'revisions' ),
		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_Fachbeitragtype' );


// Our custom post type function
function create_Gutzuwissenbeitragtype() {

	register_post_type( 'gutzuwissenbeitrag',
		// CPT Options
		array(
			'labels'        => array(
				'name'          => __( 'Wissensbeiträge' ),
				'singular_name' => __( 'Wissensbeitrag' )
			),
			//'description'   => "Ein unregelmäßig rauskommender Beitrag über z.b aktuelle Sachen",
			'description'   => "",
			'public'        => true,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_position' => 4,
			'rewrite'       => array( 'with_front' => false, 'slug' => 'gutzuwissenbeitrag' ),
			'taxonomies'    => array( 'schlagwort' ),
			'supports'      => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author', 'revisions' ),
		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_Gutzuwissenbeitragtype' );


// Our custom post type function
function create_Spassbeitragtype() {

	register_post_type( 'spassbeitrag',
		// CPT Options
		array(
			'labels'        => array(
				'name'          => __( 'Spaßbeiträge' ),
				'singular_name' => __( 'Spaßbeitrag' )
			),
			//'description'   => "Basteln, Singen & Co.",
			'description'   => "",
			'public'        => true,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_position' => 4,
			'rewrite'       => array( 'with_front' => false, 'slug' => 'spassbeitrag' ),
			'taxonomies'    => array( 'schlagwort', 'spasskategorie' ),
			'supports'      => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author', 'revisions' ),
		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_Spassbeitragtype' );


// -----------------


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


add_action( 'wp_enqueue_scripts', 'enqueue_scripts_so_22382151' );
add_action( 'wp_header', 'print_header_so_22382151' );
add_action( 'wp_footer', 'print_footer_so_22382151_externeLinks' );
add_action( 'wp_footer', 'print_footer_so_22382151_footer' );

/**
 * Enqueue jQuery Dialog and its dependencies
 * Enqueue jQuery UI theme from Google CDN
 */
function enqueue_scripts_so_22382151() {
	wp_enqueue_script( 'jquery-ui-dialog', false, array( 'jquery-ui', 'jquery' ) );
	wp_enqueue_style( 'jquery-ui-cdn', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/dot-luv/jquery-ui.min.css' );
}


/**
 * Print Dialog custom style
 */
function print_header_so_22382151() {
	?>
	<style>
		/* A class used by the jQuery UI CSS framework for their dialogs. */
		.ui-front {
			z-index: 1000000 !important; /* The default is 100. !important overrides the default. */
		}

		.ui-widget-overlay {
			opacity: .8;
		}
	</style>
	<?php
}

/**
 * Print Dialog script
 */
function print_footer_so_22382151_externeLinks() {
	$current_domain = $_SERVER['SERVER_NAME'];
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$('a[href^="http://"],a[href^="https://"]')
				.not('[href*="<?php echo $current_domain; ?>"]')
				.not('.noLeavingWarning')
				.click(function (e) {
					e.preventDefault();
					var url = this.href;
					$('<div></div>').appendTo('body')
						.html('<div><p>Hier verlässt du homeschooling4kids.at</p><p>Möchtest du fortfahren?</p></div>')
						.dialog({
							show: {effect: "blind", duration: 500},
							hide: 'fold',
							modal: true, title: 'Unsere Seite verlassen', zIndex: 10000, autoOpen: true,
							width: 'auto', resizable: false,
							buttons: {
								Ja: function () {
									window.open(url);
									$(this).dialog("close");
								},
								Nein: function () {
									$(this).dialog("close");
								}
							},
							close: function (event, ui) {
								$(this).remove();
							}
						});
				})
		});
	</script>
	<?php
}


/**
 * Print Dialog script
 */
function print_footer_so_22382151_footer() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$('#menu-rechtliches a')
				.click(function (e) {
					e.preventDefault();
					var url = this.href;
					$('<div></div>').appendTo('body')
						.html('<div><p>Möchtest du wirklich den Kinderbereich verlassen?</p></div>')
						.dialog({
							show: {effect: 'fade', speed: 1000},
							hide: 'fold',
							modal: true, title: 'Elternbereich', zIndex: 10000, autoOpen: true,
							width: 'auto', resizable: false,
							buttons: {
								Ja: function () {
									window.open(url);
									$(this).dialog("close");
								},
								Nein: function () {
									$(this).dialog("close");
								}
							},
							close: function (event, ui) {
								$(this).remove();
							}
						});
				})
		});
	</script>
	<?php
}


function add_meta_tags() {
	if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
		echo '<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">';
	}
}

add_action( 'wp_head', 'add_meta_tags' );
add_action( 'admin_head', 'add_meta_tags' );


add_filter( 'get_post_status', function ( $post_status, $post ) {
	if ( isset( $_GET['korrektur'] ) && $_GET['korrektur'] == "true" && $post_status == 'future' ) {
		return "publish";
	}

	return $post_status;
}, 10, 2 );


if ( function_exists( 'acf_add_local_field_group' ) ):

	acf_add_local_field_group( array(
		'key'                   => 'group_5e9488fb01214',
		'title'                 => 'Titelbild Format',
		'fields'                => array(
			array(
				'key'               => 'field_5e9489780c494',
				'label'             => 'Zeige Titelbild bei der Anzeige mit voller Breite oder mit voller Höhe oder vollständig',
				'name'              => 'titelbild_volle_breite_oder_volle_hoehe_oder_contain',
				'type'              => 'radio',
				'instructions'      => '',
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'volle_Breite'       => 'volle Breite zentriert',
					'volle_BreiteTop'    => 'volle Breite bündig oben',
					'volle_BreiteBottom' => 'volle Breite bündig unten',
					'volle_Hoehe'        => 'volle Höhe',
					'contain'            => 'vollständig'
				),
				'allow_null'        => 0,
				'other_choice'      => 0,
				'default_value'     => 'volle_Breite',
				'layout'            => 'vertical',
				'return_format'     => 'value',
				'save_other_choice' => 0,
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'post',
				),
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'fachbeitrag',
				),
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'gutzuwissenbeitrag',
				),
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'spassbeitrag',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'side',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	) );

endif;


function should_show_donate(){
	if (! (is_front_page() or is_page("ueber-uns") or is_page("datenschutzerklaerung") or is_page("haftungsausschluss") or is_page("fuer-eltern"))) return false;

	if (! isset($_COOKIE["cookie_notice_accepted"])) return false;

	return rand(0, 2) == 0;
}

function addDonateButton() {
	if (! should_show_donate()) return;

	$texte = [
		"Schön, dass du da bist!<br>Möchtest du uns was Gutes tun?",
		"Hallo, vielen Dank für deinen Besuch,<br>möchtest du uns unterstützen?",
		"Gefällt dir unsere Website,<br>wir wären um eine Spende dankbar."
	]

	?>
	<script type="text/javascript" defer="" src="https://donorbox.org/install-popup-button.js"></script>
	<a class="dbox-donation-button noLeavingWarning" href="https://donorbox.org/homeschooling4kids-unterstutzung?default_interval=o">
	<div id="donatecup" onclick="jQuery(this).addClass('loader')"
	     style="display: flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: rgb(255, 129, 63); color: white; border-radius: 32px; position: fixed; left: 18px; bottom: 18px; box-shadow: rgba(0, 0, 0, 0.4) 0px 4px 8px; z-index: 999; cursor: pointer; font-weight: 600; transition: all 0.2s ease 0s;">
		<img id="donateMitDampf" src="/wp-content/themes/creativ-preschool-child/Coffee_cup_icon.svg" alt="Buy Me A Coffee"
		     style="height: 40px; width: 40px; margin: 0; padding: 0;"><img id="donateOhneDampf" src="/wp-content/themes/creativ-preschool-child/Coffee_cup_icon_OhneDampf.svg" alt="Buy Me A Coffee"
		                                                                    style="height: 40px; width: 40px; margin: 0; padding: 0;"></div>
	<div id="donateinfo"
		style="position: fixed; display: block; opacity: 1; left: 90px; bottom: 16px; background: rgb(255, 255, 255); z-index: 999; transition: all 0.4s ease 0s; box-shadow: rgba(0, 0, 0, 0.3) 0px 4px 8px; padding: 16px; border-radius: 4px; font-size: 14px; color: rgb(0, 0, 0); width: auto; max-width: 280px; line-height: 1.5; font-family: sans-serif;">
		<?= $texte[rand(0, count($texte) - 1)] ?>
	</div>
	</a>
	<style>

		.loader {
			animation-name: spin;
			animation-timing-function: linear;
			animation-duration: 3s;
			animation-iteration-count: infinite;
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}

		#donatecup:hover{
			border: 2px solid;
			border-color: gray;
		}

		#donatecup{
			border: 2px solid;
			border-color: transparent;
			-webkit-transition: border-color 1s ease;
			-moz-transition: border-color 1s ease;
			-o-transition: border-color 1s ease;
			-ms-transition: border-color 1s ease;
			transition: border-color 1s ease;
		}

		#donatecup:hover #donateMitDampf{
			display: initial;
		}
		#donatecup:hover #donateOhneDampf{
			display: none;
		}

		#donateOhneDampf{
			display: initial;
		}

		#donateMitDampf{
			display: none;
		}
	</style>
	<script>
		jQuery(function(){
			jQuery("#donateinfo").delay(4000).fadeOut(1000);
			jQuery(".dbox-donation-button").click(function () {
				jQuery("#donatecup").addClass('loader')
				setTimeout(function(){
					jQuery("iframe").on("load", function() {
						jQuery("#donatecup").removeClass('loader')
					})
				}, 1)
				try {
					ga('send', 'event', 'donation_clicked');
				} catch (ignore) {
					console.log("kein gtag möglich");
				}
			})
		})
	</script>
	<?php
}


add_action( 'creativ_preschool_action_before_footer', 'addDonateButton' );


require get_template_directory() . '/functionsParent.php';
