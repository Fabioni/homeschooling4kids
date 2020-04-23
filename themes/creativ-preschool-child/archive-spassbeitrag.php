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
		<!-- Where am I: archive-spassbeitrag.php -->
		<main id="main" class="site-main <?= ( ! is_date() ) ? "makevorschau" : "" ?>" role="main">
			<div class="">

				<?php

				if ( have_posts() ) {
					/* Start the Loop */


					$terms = get_terms( array(
						'taxonomy' => 'spasskategorie',
						'hide_empty' => false,
					) );

					usort( $terms, function ( $a, $b ) {
						$sortierung = array(
							"spielideen-fuer-zuhause",
							"lass-uns-singen-und-tanzen",
							"wir-halten-uns-fit",
							"rezept-fuer-gross-und-klein",
							"knobelaufgaben",
							"witz-der-woche"
						);
						$i1         = array_search( $a->slug, $sortierung );
						$i2         = array_search( $b->slug, $sortierung );

						if ( $i1 === false ) {
							return true;
						}
						if ( $i2 === false ) {
							return false;
						}

						return ( $i1 > $i2 );
					} );

					$irgendwasangeziegt = false;
					foreach ( $terms as $sk ) {
						global $wp_query;
						$args = array_merge( $wp_query->query_vars, array( 'spasskategorie' => $sk->slug ) );
						query_posts( $args );
						if ( have_posts() ) {
							?>
							<div class="blog-posts-wrapper noMatchHeight">
							<h1 class="archivUnterteiltitel archivUnterteiltitel-<?= $sk->slug ?>">
								<a href="<?= get_term_link( $sk->slug, "spasskategorie" ) ?>"><?= $sk->name ?></a>
								&nbsp;<i class="fa fa-angle-down"
										 onclick="jQuery(this).toggleClass('fa-angle-down').toggleClass('fa-angle-up');jQuery(this).closest('.blog-posts-wrapper').find('.archivunterteil').toggleClass('closed')"></i>
							</h1>

							<div class="horizontal-scroll-wrapper">
								<div class="horizontal-scroll archivunterteil closed">
									<?php

									while ( have_posts() ) : the_post(); ?>
										<div class="horizontal-scroll-item">
										<?php $irgendwasangeziegt = true;
										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'template-parts/content', get_post_format() );
										?></div><?php
									endwhile;
									?>
									<!-- folgendes braucht man, damit alles items gleich breit sind -->
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
									<div class="horizontal-scroll-item"></div>
								</div>
							</div>
							</div><?php
						}
						wp_reset_query();
					}

					if ( ! $irgendwasangeziegt ) {
						get_template_part( 'template-parts/content', 'none' );
					}
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
				?>
			</div>
			<?php the_posts_navigation(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
