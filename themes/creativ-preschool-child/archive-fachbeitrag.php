<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */

get_header(); ?>
	<script>
		jQuery(function () {
			jQuery(".togglepfeilchen").click(function () {
				jQuery(this).closest('.blog-posts-wrapper').find('.togglepfeilchen').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
				jQuery(this).closest('.blog-posts-wrapper').find('.archivunterteil').toggleClass('closed')
				jQuery(this).closest('.blog-posts-wrapper').find('.sticky_archivUnterteiltitel').toggleClass('closed')
				if (jQuery(this).hasClass("togglepfeilchen_handy") && jQuery(this).closest('.blog-posts-wrapper').find('.archivunterteil').hasClass('closed')){
					jQuery(this).get(0).scrollIntoView({
						behavior: 'auto',
						block: 'center',
						inline: 'center'
					});
				}
			})
		})
	</script>
	<div id="primary" class="content-area <?= ( ! is_date() ) ? "makevorschau" : "" ?>">
		<!-- Where am I: archive-fachbeitrag.php -->
		<main id="main" class="site-main" role="main">
			<div class="">
				<?php
				if ( ! is_tax( "leistungsstufe" ) ) {
					?>
					<script type="text/javascript">
						jQuery(function () {
							jQuery("#main").addClass('selected_leistungsstufe-alle');
							jQuery("input[name='leistungsstufe']").on('change', function () {
								jQuery("#main").removeClass('selected_leistungsstufe-3-klasse-4-klasse');
								jQuery("#main").removeClass('selected_leistungsstufe-1-klasse-2-klasse');
								jQuery("#main").removeClass('selected_leistungsstufe-alle');

								if (jQuery("#leistungsstufe1Radio").is(':checked')) {
									jQuery("#main").addClass('selected_leistungsstufe-1-klasse-2-klasse')
								} else if (jQuery("#leistungsstufe2Radio").is(':checked')) {
									jQuery("#main").addClass('selected_leistungsstufe-3-klasse-4-klasse')
								} else if (jQuery("#leistungsstufeAllesRadio").is(':checked')) {
									jQuery("#main").addClass('selected_leistungsstufe-alle')
								}
							});
						});
					</script>
					<style>
						#main.selected_leistungsstufe-1-klasse-2-klasse #leistungsstufe1Label {
							color: #fff;
							background-color: #ff7096;
						}

						#main.selected_leistungsstufe-3-klasse-4-klasse #leistungsstufe2Label {
							color: #fff;
							background-color: #ff7096;
						}

						#main.selected_leistungsstufe-alle #leistungsstufeAllesLabel {
							color: #fff;
							background-color: #ff7096;
						}

						#main .btn {
							margin: 10px;
						}

					</style>
					<div style="width: -moz-fit-content; width: fit-content; margin: auto;"
						 class="leistungsstufen-toggle">
						<label style="cursor: pointer" id="leistungsstufe1Label" class="btn"><input
								style="display: none" id="leistungsstufe1Radio" type="radio" name="leistungsstufe"
								value="1&2">1. & 2. Klasse</label>
						<label style="cursor: pointer" id="leistungsstufe2Label" class="btn"><input
								style="display: none" id="leistungsstufe2Radio" type="radio" name="leistungsstufe"
								value="3&4">3. & 4. Klasse</label>
						<label style="cursor: pointer" id="leistungsstufeAllesLabel" class="btn"><input
								checked="checked" style="display: none" id="leistungsstufeAllesRadio" type="radio"
								name="leistungsstufe" value="3&4">Alle Klassen</label>
					</div>
					<?php
				}
				?>

				<?php

				global $wp_query;
				if ( isset( $_GET['korrektur'] ) && $_GET['korrektur'] == "true" ) {
					$argsFut = array_merge( $wp_query->query_vars, array(
						'post_status' => array(
							"future",
							"publish"
						)
					) );
					query_posts( $argsFut );
				}

				if ( have_posts() ) {
					/* Start the Loop */


					$terms = get_terms( array(
						'taxonomy'   => 'fach',
						'hide_empty' => true,
						'orderby'    => 'id'
					) );

					function searchwitharraywithpatterns( $ar, $subj ) {
						$i = 0;
						foreach ( $ar as $tag ) {
							if ( preg_match( "/" . $tag . "/", $subj ) ) {
								return $i;
							}
							$i ++;
						}

						return null;
					}

					usort( $terms, function ( $a, $b ) {
						$sortierung = array( "montag", "dienstag", "mittwoch", "donnerstag", "freitag" );

						$i1 = searchwitharraywithpatterns( $sortierung, $a->slug );
						$i2 = searchwitharraywithpatterns( $sortierung, $b->slug );

						if ( $i1 === null ) {
							return true;
						}
						if ( $i2 === null ) {
							return false;
						}

						return ( $i1 > $i2 );
					} );

					?>
					<style>
						.fächerlinks li {
							display: inline-block;
							margin: 0px 10px;
						}

						.fächerlinks li:before {
							content: "\f0da";
							font-family: 'Font Awesome 5 Free';
							font-weight: 900;
							margin-right: 10px;
						}
					</style>
					<ul class="fächerlinks">
						<?php
						if (! is_day()){
							foreach ( $terms as $fa ) {
								?>
								<li><a href="#fach-<?= $fa->slug ?>"><?= $fa->name ?></a></li><?php
							}
						}
						?>
					</ul>
					<?php
					$irgendwasangeziegt = false;
					foreach ( $terms as $fa ) {
						global $wp_query;
						$args = array_merge( $wp_query->query_vars, array( 'fach' => $fa->slug ) );
						query_posts( $args );

						if ( have_posts() ) {
							$mehrals3 = $wp_query->post_count > 3 && ! is_day();
							?>
							<div class="blog-posts-wrapper noMatchHeight">
								<h1 class="archivUnterteiltitel" id="fach-<?= $fa->slug ?>"><a
										href="<?= get_term_link( $fa->slug, "fach" ) ?>"><?= $fa->name ?></a>&nbsp;<?php if ($mehrals3){?><i class="fa fa-angle-down togglepfeilchen togglepfeilchen_pc"></i><?php } ?>
								</h1>
								<span class="sticky_archivUnterteiltitel closed"><?= substr($fa->name, 0, 2) ?></span>
								<div class="horizontal-scroll-wrapper">
									<div class="horizontal-scroll archivunterteil <?= $mehrals3 ? 'closed' : ''?>">
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
									<div class="aufklapppfeilamende">
										<?php if ($mehrals3){ ?><i class="fa fa-angle-down togglepfeilchen togglepfeilchen_handy"></i> <?php } ?>
									</div>
								</div>
							</div>
						<?php }
						wp_reset_query();
						global $wp_query;
						if ( isset( $_GET['korrektur'] ) && $_GET['korrektur'] == "true" ) {
							$argsFut = array_merge( $wp_query->query_vars, array(
								'post_status' => array(
									"future",
									"publish"
								),
							) );
							query_posts( $argsFut );
						}
					}

					if ( ! $irgendwasangeziegt ) {
						get_template_part( 'template-parts/content', 'none' );
					}
				} else {
					get_template_part( 'template-parts/content', 'none' );
				} ?>
			</div>
			<?php /*the_posts_navigation(); TODO brauch ich das hier? */ ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
