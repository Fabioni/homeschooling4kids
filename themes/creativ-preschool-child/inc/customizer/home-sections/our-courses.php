<?php
/**
 * Our Courses options.
 *
 * @package Creativ Preschool
 */

$default = creativ_preschool_get_default_theme_options();

// Featured Our Courses Section
$wp_customize->add_section( 'section_our_courses',
	array(
		'title'      => __( 'Our Courses', 'creativ-preschool' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Our Courses Section
$wp_customize->add_setting('theme_options[enable_our_courses_section]', 
	array(
	'default' 			=> $default['enable_our_courses_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_preschool_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_our_courses_section]', 
	array(		
	'label' 	=> __('Enable Our Courses Section', 'creativ-preschool'),
	'section' 	=> 'section_our_courses',
	'settings'  => 'theme_options[enable_our_courses_section]',
	'type' 		=> 'checkbox',	
	)
);

// Section Title
$wp_customize->add_setting('theme_options[our_courses_section_title]', 
	array(
	'default'           => $default['our_courses_section_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[our_courses_section_title]', 
	array(
	'label'       => __('Section Title', 'creativ-preschool'),
	'section'     => 'section_our_courses',   
	'settings'    => 'theme_options[our_courses_section_title]',	
	'active_callback' => 'creativ_preschool_our_courses_active',		
	'type'        => 'text'
	)
);

// Number of items
$wp_customize->add_setting('theme_options[number_of_cs_items]', 
	array(
	'default' 			=> $default['number_of_cs_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_preschool_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_cs_items]', 
	array(
	'label'       => __('Number Of Items', 'creativ-preschool'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 3.', 'creativ-preschool'),
	'section'     => 'section_our_courses',   
	'settings'    => 'theme_options[number_of_cs_items]',		
	'type'        => 'number',
	'active_callback' => 'creativ_preschool_our_courses_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 3,
			'step'	=> 1,
		),
	)
);

$wp_customize->add_setting('theme_options[cs_content_type]', 
	array(
	'default' 			=> $default['cs_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_preschool_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[cs_content_type]', 
	array(
	'label'       => __('Content Type', 'creativ-preschool'),
	'section'     => 'section_our_courses',   
	'settings'    => 'theme_options[cs_content_type]',		
	'type'        => 'select',
	'active_callback' => 'creativ_preschool_our_courses_active',
	'choices'	  => array(
			'cs_page'	  => __('Page','creativ-preschool'),
			'cs_post'	  => __('Post','creativ-preschool'),
			'cs_gutzuwissenbeitrag'   => "GutZuWissen",
		),
	)
);

$number_of_cs_items = creativ_preschool_get_option( 'number_of_cs_items' );

for( $i=1; $i<=$number_of_cs_items; $i++ ){

	// Page
	$wp_customize->add_setting('theme_options[our_courses_page_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'creativ_preschool_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[our_courses_page_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Page #%1$s', 'creativ-preschool'), $i),
		'section'     => 'section_our_courses',   
		'settings'    => 'theme_options[our_courses_page_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback' => 'creativ_preschool_our_courses_page',
		)
	);

	// Posts
	$wp_customize->add_setting('theme_options[our_courses_post_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'creativ_preschool_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[our_courses_post_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Post #%1$s', 'creativ-preschool'), $i),
		'section'     => 'section_our_courses',   
		'settings'    => 'theme_options[our_courses_post_'.$i.']',		
		'type'        => 'select',
		'choices'	  => creativ_preschool_dropdown_posts(),
		'active_callback' => 'creativ_preschool_our_courses_post',
		)
	);

	// Wissen
	$wp_customize->add_setting('theme_options[our_courses_wissen_'.$i.']',
		array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'creativ_preschool_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[our_courses_wissen_'.$i.']',
		array(
			'label'       => sprintf( __('Select Post #%1$s', 'creativ-preschool'), $i),
			'section'     => 'section_our_courses',
			'settings'    => 'theme_options[our_courses_wissen_'.$i.']',
			'type'        => 'select',
			'choices'	  => creativ_preschool_dropdown_wissen(),
			'active_callback' => 'creativ_preschool_our_courses_wissen',
		)
	);
}