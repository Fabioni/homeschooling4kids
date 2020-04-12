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
		<!-- Where am I: date.php -->
		<main id="main" class="site-main blog-posts-wrapper" role="main">
			<div class="section-content clear col-2">
				<?php
				if ( have_posts() ) {

					foreach ( array( "fachbeitrag", "gutzuwissenbeitrag", "spassbeitrag", "post" ) as $posttype ) {
						global $wp_query;
						$args = array_merge( $wp_query->query_vars, array( 'post_type' => $posttype ) );
						query_posts( $args );

						if ( have_posts() ) {
							?>
							<div class="blog-posts-wrapper"><h1 class="archivUnterteiltitel"><a
									href="<?= get_post_type_archive_link( $posttype ) ?>"><?= get_post_type_object( $posttype )->labels->singular_name ?></a>
							</h1>
							<div
								class="section-content clear col-3 archivunterteil"><?php

								while ( have_posts() ) : the_post();
									$irgendwasangeziegt = true;
									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_format() );

								endwhile;

								?></div></div><?php
						}
						wp_reset_query();
					}

					if ( ! $irgendwasangeziegt ) {
						get_template_part( 'template-parts/content', 'none' );
					}

				} else {
					get_template_part( 'template-parts/content', 'none' );
				} ?>
			</div>
			<?php the_posts_navigation(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
