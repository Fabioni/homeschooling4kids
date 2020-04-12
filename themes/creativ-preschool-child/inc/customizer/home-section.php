<?php
/**
 * Home Page Options.
 *
 * @package Creativ Preschool
 */

$default = creativ_preschool_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'home_page_panel',
	array(
	'title'      => __( 'Front Page Sections', 'creativ-preschool' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

/**
* Section Customizer Options.
*/
require get_stylesheet_directory() . '/inc/customizer/home-sections/slider.php';
require get_stylesheet_directory() . '/inc/customizer/home-sections/our-services.php';
require get_stylesheet_directory() . '/inc/customizer/home-sections/our-courses.php';
require get_stylesheet_directory() . '/inc/customizer/home-sections/about-us.php';
require get_stylesheet_directory() . '/inc/customizer/home-sections/team.php';
require get_stylesheet_directory() . '/inc/customizer/home-sections/blog.php';
require get_stylesheet_directory() . '/inc/customizer/home-sections/cta.php';

