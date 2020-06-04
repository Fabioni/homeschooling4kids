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
			<div>
				<?php
				global $wp_query;
				if ( have_posts() ) {
					$makevorschau = $wp_query->post_count > 6 ? "makevorschau" : "";
					foreach ( array( "fachbeitrag", "gutzuwissenbeitrag", "spassbeitrag", "post" ) as $posttype ) {
						global $wp_query;
						$args = array_merge( $wp_query->query_vars, array( 'post_type' => $posttype ) );
						query_posts( $args );

						if ( have_posts() ) {
							?>
							<div class="horizontal-scroll-wrapper <?= $makevorschau ?>">
								<h1 class="archivUnterteiltitel"><a
										href="<?= get_post_type_archive_link( $posttype ) ?>"><?= get_post_type_object( $posttype )->labels->frontend_name ?></a>
								</h1>
								<div class="horizontal-scroll">
									<?php
									$first = true;
									/* Start the Loop */
									while ( have_posts() ) {
										the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										?>
										<div class="horizontal-scroll-item"><?php
											$first = false;
											get_template_part( 'template-parts/content', get_post_format() );
											?></div>
									<?php } ?>
									<!-- folgendes braucht man, damit alles items gleich breit sind -->
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
								</div>
							</div>
							<?php
						}
						wp_reset_query();
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
