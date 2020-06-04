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
            <div class="">
				<?php
				global $wp_query;
				//$args = array_merge( $wp_query->query_vars, array( 'post_type' => array("post", "fachbeitrag", "spassbeitrag", "gutzuwissenbeitrag") ) );
				//query_posts( $args ); ?>
				<?php
				if ( have_posts() ) :
						$makevorschau = $wp_query->post_count > 6 ? "makevorschau" : "";
						?>
						<div class="horizontal-scroll-wrapper <?= $makevorschau ?>">
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
