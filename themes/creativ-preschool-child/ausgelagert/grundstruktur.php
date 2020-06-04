<?php
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
			'taxonomies'    => array( "fach", "leistungsstufe", "themen"),
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
			'taxonomies'    => array( 'schlagwort', 'spasskategorie', 'themen'),
			'supports'      => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author', 'revisions' ),
		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_Spassbeitragtype' );


// -----------------


add_action( 'init', 'create_Thema_taxonomy', 0 );
function create_Thema_taxonomy() {
	$labels = array(
		'name'          => "Themen", //_x( 'Topics', 'taxonomy general name' ),
		'singular_name' => "Thema", //_x( 'Topic', 'taxonomy singular name' ),
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
	register_taxonomy( 'thema', array( 'fachbeitrag', 'spassbeitrag' ), array(
		'hierarchical'      => true,
		'description'		=> "",
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		//'rewrite' => array( 'slug' => 'topic' ),
	) );
}
