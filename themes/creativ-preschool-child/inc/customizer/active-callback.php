<?php
/**
 * Active callback functions.
 *
 * @package Creativ Preschool
 */

function creativ_preschool_slider_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_featured_slider]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}

function creativ_preschool_slider_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[slider_content_type]' )->value();
    return ( creativ_preschool_slider_active( $control ) && ( 'slider_page' == $content_type ) );
}

function creativ_preschool_slider_post( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[slider_content_type]' )->value();
    return ( creativ_preschool_slider_active( $control ) && ( 'slider_post' == $content_type ) );
}

function creativ_preschool_our_services_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_our_services_section]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}

function creativ_preschool_our_services_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[services_content_type]' )->value();
    return ( creativ_preschool_our_services_active( $control ) && ( 'services_page' == $content_type ) );
}

function creativ_preschool_our_services_post( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[services_content_type]' )->value();
    return ( creativ_preschool_our_services_active( $control ) && ( 'services_post' == $content_type ) );
}

function creativ_preschool_our_courses_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_our_courses_section]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}

function creativ_preschool_our_courses_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[cs_content_type]' )->value();
    return ( creativ_preschool_our_courses_active( $control ) && ( 'cs_page' == $content_type ) );
}

function creativ_preschool_our_courses_post( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[cs_content_type]' )->value();
    return ( creativ_preschool_our_courses_active( $control ) && ( 'cs_post' == $content_type ) );
}

function creativ_preschool_our_courses_wissen( $control ) {
	$content_type = $control->manager->get_setting( 'theme_options[cs_content_type]' )->value();
	return ( creativ_preschool_our_courses_active( $control ) && ( 'cs_gutzuwissenbeitrag' == $content_type ) );
}

function creativ_preschool_about_us_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_about_us_section]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}

function creativ_preschool_about_us_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[about_us_content_type]' )->value();
    return ( creativ_preschool_about_us_active( $control ) && ( 'about_us_page' == $content_type ) );
}

function creativ_preschool_about_us_post( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[about_us_content_type]' )->value();
    return ( creativ_preschool_about_us_active( $control ) && ( 'about_us_post' == $content_type ) );
}

function creativ_preschool_team_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_team_section]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}

function creativ_preschool_team_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[ts_content_type]' )->value();
    return ( creativ_preschool_team_active( $control ) && ( 'ts_page' == $content_type ) );
}

function creativ_preschool_team_post( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[ts_content_type]' )->value();
    return ( creativ_preschool_team_active( $control ) && ( 'ts_post' == $content_type ) );
}

function creativ_preschool_cta_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_cta_section]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}

function creativ_preschool_blog_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_blog_section]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}