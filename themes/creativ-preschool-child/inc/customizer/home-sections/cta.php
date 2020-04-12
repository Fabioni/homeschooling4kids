<?php
/**
 * Call to action options.
 *
 * @package Creativ Preschool
 */

$default = creativ_preschool_get_default_theme_options();

// Call to action section
$wp_customize->add_section( 'section_cta',
	array(
		'title'      => __( 'Call To Action', 'creativ-preschool' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);

// Enable Call to action section
$wp_customize->add_setting('theme_options[enable_cta_section]', 
	array(
	'default' 			=> $default['enable_cta_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_preschool_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[enable_cta_section]', 
	array(		
	'label' 	=> __('Enable Call to action section', 'creativ-preschool'),
	'section' 	=> 'section_cta',
	'settings'  => 'theme_options[enable_cta_section]',
	'type' 		=> 'checkbox',	
	)
);

// Title
$wp_customize->add_setting('theme_options[cta_title]', 
	array(
	'default' 			=> $default['cta_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_title]', 
	array(
	'label'       => __('Title', 'creativ-preschool'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_title]',
	'active_callback' => 'creativ_preschool_cta_active',		
	'type'        => 'text'
	)
);

// Button Text
$wp_customize->add_setting('theme_options[cta_button_label]', 
	array(
	'default' 			=> $default['cta_button_label'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_button_label]', 
	array(
	'label'       => __('Button Label', 'creativ-preschool'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_button_label]',	
	'active_callback' => 'creativ_preschool_cta_active',	
	'type'        => 'text'
	)
);
// Button Url
$wp_customize->add_setting('theme_options[cta_button_url]', 
	array(
	'default' 			=> $default['cta_button_url'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'esc_url_raw'
	)
);

$wp_customize->add_control('theme_options[cta_button_url]', 
	array(
	'label'       => __('Button Url', 'creativ-preschool'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_button_url]',	
	'active_callback' => 'creativ_preschool_cta_active',	
	'type'        => 'url'
	)
);