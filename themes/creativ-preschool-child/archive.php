<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */

get_header(); ?>
    <div id="primary" class="content-area">
        <!-- Where am I: archive.php -->
        <main id="main" class="site-main blog-posts-wrapper" role="main">
            <div class="section-content clear col-2">
				<?php
				//global $wp_query;
				//$args = array_merge( $wp_query->query_vars, array( 'post_type' => array("post", "fachbeitrag", "spassbeitrag", "gutzuwissenbeitrag") ) );
				//query_posts( $args ); ?>
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
            </div>
			<?php the_posts_navigation(); ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
