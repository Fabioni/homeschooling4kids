<?php
/**
 * Template part for displaying Services Section
 *
 *@package Creativ Preschool
 */

    $about_us_content_type     = creativ_preschool_get_option( 'about_us_content_type' );

    if( $about_us_content_type == 'about_us_page' ) :
        $featured_about_us_posts[] = creativ_preschool_get_option( 'about_us_page');
    elseif( $about_us_content_type == 'about_us_post' ) :
        $featured_about_us_posts[] = creativ_preschool_get_option( 'about_us_post');
    endif;
    ?>

    <?php if( $about_us_content_type == 'about_us_page' ) : ?>
        <div class="section-content">
            <?php
			$args = array (
                'post_type'     => 'page',
                'post_per_page' => count( $featured_about_us_posts ),
                'post__in'      => $featured_about_us_posts,
                'orderby'       =>'post__in',
            );
            $loop = new WP_Query($args);
            if ( $loop->have_posts() ) :
                if ($loop->have_posts()) : $loop->the_post(); ?>

                <article>
                    <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                        <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
                    </div><!-- .featured-image -->

                    <div class="entry-container">
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        </header>

                        <div class="entry-content">
	                        <p>
								<em>homeschooling4kids.at</em> ist die Plattform für Volksschulkinder, erstellt von Lehramtsstudentinnen der Pädagogischen Hochschule Wien.
							</p>
							<p style="margin-top: 0.5em">
								Wir möchten langfristig unseren Beitrag dazu leisten, den Heimunterricht spannender und lustiger zu gestalten. Das Team hofft, dass es dir gefällt und freut sich, dass du da bist&nbsp;:-)
							</p>
							<p style="margin-top: 1em">
								Hier kannst du mehr über uns erfahren:
							</p>
                            <?php /*
                                $excerpt = creativ_preschool_the_excerpt( 50 );
                                echo wp_kses_post( wpautop( $excerpt ) ); */
                            ?>
                        </div><!-- .entry-content -->

                        <?php $readmore_text = creativ_preschool_get_option( 'readmore_text' );?>
                        <?php if (!empty($readmore_text) ) :?>
                            <div class="read-more">
                                <a href="<?php the_permalink();?>" class="btn btn-primary"><?php echo esc_html($readmore_text);?></a>
                            </div><!-- .read-more -->
                        <?php endif; ?>
                    </div><!-- .entry-container -->
                </article>

              <?php endif;?>
              <?php wp_reset_postdata(); ?>
            <?php endif;?>
        </div>

    <?php else: ?>
        <div class="section-content">
            <?php $args = array (
                'post_type'     => 'post',
                'post_per_page' => count( $featured_about_us_posts ),
                'post__in'      => $featured_about_us_posts,
                'orderby'       =>'post__in',
            );
            $loop = new WP_Query($args);
            if ( $loop->have_posts() ) :
                if ($loop->have_posts()) : $loop->the_post(); ?>

                <article>
                    <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                        <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
                    </div><!-- .featured-image -->

                    <div class="entry-container">
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        </header>

                        <div class="entry-content">
                            <?php
                                $excerpt = creativ_preschool_the_excerpt( 50 );
                                echo wp_kses_post( wpautop( $excerpt ) );
                            ?>
                        </div><!-- .entry-content -->

                        <?php $readmore_text = creativ_preschool_get_option( 'readmore_text' );?>
                        <?php if (!empty($readmore_text) ) :?>
                            <div class="read-more">
                                <a href="<?php the_permalink();?>" class="btn btn-primary"><?php echo esc_html($readmore_text);?></a>
                            </div><!-- .read-more -->
                        <?php endif; ?>
                    </div><!-- .entry-container -->
                </article>

              <?php endif;?>
              <?php wp_reset_postdata(); ?>
            <?php endif;?>
        </div>
    <?php endif;
