<?php
/**
 * Services options.
 *
 * @package Creativ Preschool
 */

$default = creativ_preschool_get_default_theme_options();

// About Us Section
$wp_customize->add_section( 'section_home_about_us',
	array(
		'title'      => __( 'About Us', 'creativ-preschool' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);

// Enable About Us Section
$wp_customize->add_setting('theme_options[enable_about_us_section]', 
	array(
	'default' 			=> $default['enable_about_us_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_preschool_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_about_us_section]', 
	array(		
	'label' 	=> __('Enable About Us Section', 'creativ-preschool'),
	'section' 	=> 'section_home_about_us',
	'settings'  => 'theme_options[enable_about_us_section]',
	'type' 		=> 'checkbox',	
	)
);

// About Us Section Content Type
$wp_customize->add_setting('theme_options[about_us_content_type]', 
	array(
	'default' 			=> $default['about_us_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_preschool_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[about_us_content_type]', 
	array(
	'label'       => __('Content Type', 'creativ-preschool'),
	'section'     => 'section_home_about_us',   
	'settings'    => 'theme_options[about_us_content_type]',		
	'type'        => 'select',
	'active_callback' => 'creativ_preschool_about_us_active',
	'choices'	  => array(
			'about_us_page'	  => __('Page','creativ-preschool'),
			'about_us_post'	  => __('Post','creativ-preschool'),
		),
	)
);

// Page
$wp_customize->add_setting('theme_options[about_us_page]', 
	array(
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_preschool_dropdown_pages'
	)
);

$wp_customize->add_control('theme_options[about_us_page]', 
	array(
	'label'       => sprintf( __('Select Page', 'creativ-preschool')),
	'section'     => 'section_home_about_us',   
	'settings'    => 'theme_options[about_us_page]',		
	'type'        => 'dropdown-pages',
	'active_callback' => 'creativ_preschool_about_us_page',
	)
);

// Posts
$wp_customize->add_setting('theme_options[about_us_post]', 
	array(
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_preschool_dropdown_pages'
	)
);

$wp_customize->add_control('theme_options[about_us_post]', 
	array(
	'label'       => sprintf( __('Select Post', 'creativ-preschool')),
	'section'     => 'section_home_about_us',   
	'settings'    => 'theme_options[about_us_post]',		
	'type'        => 'select',
	'choices'	  => creativ_preschool_dropdown_posts(),
	'active_callback' => 'creativ_preschool_about_us_post',
	)
);