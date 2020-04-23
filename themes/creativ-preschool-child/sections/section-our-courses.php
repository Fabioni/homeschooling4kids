<?php
/**
 * Template part for displaying About Section
 *
 *@package Creativ Preschool
 */
    $our_courses_section_title    = creativ_preschool_get_option( 'our_courses_section_title' );
    $cs_content_type              = creativ_preschool_get_option( 'cs_content_type' );
    $number_of_cs_items           = creativ_preschool_get_option( 'number_of_cs_items' );

    if( $cs_content_type == 'cs_page' ) :
        for( $i=1; $i<=$number_of_cs_items; $i++ ) :
            $our_courses_posts[] = creativ_preschool_get_option( 'our_courses_page_'.$i );
        endfor;
    elseif( $cs_content_type == 'cs_post' ) :
        for( $i=1; $i<=$number_of_cs_items; $i++ ) :
            $our_courses_posts[] = creativ_preschool_get_option( 'our_courses_post_'.$i );
        endfor;
    elseif ($cs_content_type == 'cs_gutzuwissenbeitrag') :
	    for( $i=1; $i<=$number_of_cs_items; $i++ ) :
		    $our_courses_posts[] = creativ_preschool_get_option( 'our_courses_wissen_'.$i );
	    endfor;
    endif;
    ?>

    <!--FABIAN: <?= $cs_content_type ?> - <?= implode(", ", $our_courses_posts) ?> - <?= $number_of_cs_items ?> -->

    <?php if( !empty($our_courses_section_title) ):?>
        <div class="section-header">
            <div class="wrapper">
                <h2 class="section-title"><?php echo esc_html($our_courses_section_title);?></h2>
            </div><!-- .wrapper -->
        </div><!-- .section-header -->
    <?php endif;?>

    <?php if( $cs_content_type == 'cs_page' ) : ?>
        <div class="section-content page-section clear">
            <div class="wrapper courses-slider" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": false, "speed": 500, "dots": true, "arrows":false, "autoplay": false, "fade": false }'>
                <?php $args = array (
                    'post_type'     => 'page',
                    'post_per_page' => count( $our_courses_posts ),
                    'post__in'      => $our_courses_posts,
                    'orderby'       =>'post__in',
                );
                $loop = new WP_Query($args);
                if ( $loop->have_posts() ) :
                $i=-1;
                    while ($loop->have_posts()) : $loop->the_post(); $i++;?>

                    <article>
                        <div class="featured-course-wrapper">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="featured-image">
                                    <a href="<?php the_permalink();?>"><img src="<?php the_post_thumbnail_url(); ?>"/></a>
                                </div><!-- .featured-image -->
                            <?php endif; ?>

                            <div class="entry-container">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                </header>

                                <div class="entry-content">
                                    <?php
                                        $excerpt = creativ_preschool_the_excerpt( 25 );
                                        echo wp_kses_post( wpautop( $excerpt ) );
                                    ?>
                                </div><!-- .entry-content -->
                            </div><!-- .entry-container -->
                        </div><!-- .featured-course-wrapper -->
                    </article>

                  <?php endwhile;?>
                  <?php wp_reset_postdata(); ?>
                <?php endif;?>
            </div><!-- .wrapper -->
        </div><!-- .section-content -->
    <?php else: ?>
	<div class="makescroll">
        <div class="section-content clear horizontal-scroll-wrapper">
            <div class="horizontal-scroll XXXcourses-slider blog-posts-wrapper noMatchHeight" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": false, "speed": 500, "dots": true, "arrows":true, "autoplay": false, "fade": false }'>
                <?php $args = array (
                    'post_type'     => $cs_content_type == "cs_post" ? 'post' : 'gutzuwissenbeitrag',
                    'post_per_page' => count( $our_courses_posts ),
                    'post__in'      => $our_courses_posts,
                    'orderby'       =>'post__in',
                    'ignore_sticky_posts' => true,
                );
                $loop = new WP_Query($args);
                if ( $loop->have_posts() ) :
                $i=-1;
                    while ($loop->have_posts()) : $loop->the_post(); $i++;
                    ?> <div class="horizontal-scroll-item"> <?php
						get_template_part( 'template-parts/content', $loop->get_post_format() );
							?> </div> <?php

                  endwhile;?>
					<div class="horizontal-scroll-item"></div><div class="horizontal-scroll-item"></div><div class="horizontal-scroll-item"></div>
                  <?php wp_reset_postdata(); ?>
                <?php endif;?>
            </div><!-- .wrapper -->
        </div><!-- .section-content -->
	</div>
    <?php endif;
