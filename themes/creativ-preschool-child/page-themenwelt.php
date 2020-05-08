<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */

get_header(); ?>
<style>
	#content .wrapper.page-section{
		max-width: 1200px;
	}

	.timeline-content{
		transition: transform 1s ease;
	}

	.timeline .timeline-item.deaktiviert:hover .timeline-content{
		transform: none !important;
	}

	.timeline .timeline-item.deaktiviert .timeline-content > *:not(.date){
		filter: blur(1px) contrast(0.8);
	}

	.post-item.deaktiviert{
		filter: contrast(0.3);
	}

	@media screen and (min-width: 784px) {
		.timeline .timeline-item:nth-child(odd):hover .timeline-content{
			transform: scale(1.1) rotate(2deg);
		}

		.timeline .timeline-item:nth-child(even):hover .timeline-content{
			transform: scale(1.1) rotate(-2deg);
		}

		.timeline .timeline-item:nth-child(odd) .timeline-vorschau{
			float: right;
			width: calc(48vw - 5%);
			right: calc( (-100vw / 2 + 100% / 2) + 2vw);
			position: absolute;
			z-index: 5;
		}

		.timeline .timeline-item:nth-child(even) .timeline-vorschau{
			float: left;
			width: calc(48vw - 5%);
			left: calc( (-100vw / 2 + 100% / 2) + 2vw);
			position: absolute;
			z-index: 5;
		}

		.timeline-vorschau{
			opacity: 0;
			width: 45%;
			transition: opacity 1s ease;
		}

		.timeline-item:hover .timeline-vorschau{
			opacity: 1;
		}
	}


	.post-item figure > a {
		display: block;
		position: relative;
		padding-bottom: 66%;
	}

	.post-item figure > a img {
		position: absolute;
		max-height: 100%;
		width: 100%;
		object-fit: cover;
	}

	@media screen and (max-width: 783px) {

		.timeline-item.open .timeline-vorschau{
			visibility: visible;
			opacity: 1;
		}

		.timeline-item.open .horizontal-scroll-wrapper {
			background: #0009;
			box-shadow: -4px -4px 12px 3px #0009;
		}

		.timeline-item .timeline-vorschau{
			visibility: hidden;
			opacity: 0;
			width: 100%;
			transition: all 1s ease;
			float: none;
			position: absolute;
			z-index: 5;
		}

		.timeline .timeline-item.timeline_fadein .timeline-content-wrapper{
			animation-name: timeline_fade-in_right;
		}
	}

	header.timeline-vorschau-header {
		position: absolute;
		z-index: 1;
		width: 100%;
		padding: 0px 20px;
		background: linear-gradient(rgba(0, 0, 0, .6), rgba(0,0,0,.5), rgba(0, 0, 0, 0));
		border-radius: 25px;
	}

	.timeline-vorschau-title a {
		color: white;
		font-size: 38px;
	}

	.post-item figure {
		position: relative;
	}

	.timeline-vorschau-excerpt {
		color: white;
		padding: 20px 20px;
	}

	.timeline-content-wrapper{
		opacity: 0;
	}

	.timeline .timeline-item:nth-child(odd).timeline_fadein .timeline-content-wrapper{
		animation-name: timeline_fade-in_right;
	}

	.timeline .timeline-item:nth-child(even).timeline_fadein .timeline-content-wrapper{
		animation-name: timeline_fade-in_left;
	}

	.timeline .timeline-item.timeline_fadein .timeline-content-wrapper{
		animation-duration: 2s;
		animation-fill-mode: both;
	}

	@keyframes timeline_fade-in_right {
		from {
			opacity: 0;
			transform: translate(50px);
		}
		to {
			opacity: 1;
			transform: translate(0);
		}
	}

	@keyframes timeline_fade-in_left {
		from {
			opacity: 0;
			transform: translate(-50px);
		}
		to {
			opacity: 1;
			transform: translate(0);
		}
	}

	.post-item.deaktiviert, .post-item.deaktiviert *{
		cursor: default !important;
	}

	.heutigesThema{
		border: 2px solid darkred;
	}
</style>
<script>
	jQuery(function () {
		jQuery("body").on("click", function (event) {
			if (! jQuery(event.target).is(".bnt-more")){
				jQuery('.timeline-item').removeClass('open');
				jQuery(event.target).closest(".timeline-item").addClass('open');
			}
		})

		jQuery('.timeline-item:not(.timeline_fadein):in-viewport(0)').addClass("timeline_fadein");

		jQuery(window).scroll(function () {
			jQuery('.timeline-item:not(.timeline_fadein):in-viewport(0)').addClass("timeline_fadein");
		})

		jQuery(".post-item.deaktiviert").click(function (event) {
			<?php
			$korrek2 = "false";
			if ( isset( $_GET['korrektur'] ) && $_GET['korrektur'] == "true" ) {
				$korrek2 = "true";
			} ?>
			if (! <?= $korrek2 ?>){
				event.preventDefault();
			}
		})
	})
</script>
	<div id="primary" class="content-area">
		<!-- Where am I: alle-themen.php -->
		<main id="main" class="site-main" role="main">
			<section class="timeline">
				<div class="container">
				<?php
				global $wpdb;

				$terms = $wpdb->get_results(/** @lang MySQL */ "
						SELECT t.*, tt.*, postdates.startdate, postdates.enddate, postdates.postids
						FROM wp_terms AS t
						INNER JOIN wp_term_taxonomy AS tt
						ON t.term_id = tt.term_id
                        LEFT JOIN (
							SELECT GROUP_CONCAT(wp_posts.ID SEPARATOR ',') as postids, MIN(wp_posts.post_date) as startdate,  MAX(wp_posts.post_date) as enddate, wp_term_relationships.term_taxonomy_id as termid
							FROM wp_posts
							LEFT JOIN wp_term_relationships
							ON (wp_posts.ID = wp_term_relationships.object_id)
							WHERE
								wp_posts.post_status = 'publish'
								OR wp_posts.post_status = 'future'
								OR wp_posts.post_status = 'acf-disabled'
								OR wp_posts.post_status = 'private'
                            GROUP BY termid
						) as postdates ON postdates.termid = t.term_id
						WHERE tt.taxonomy IN ('thema')
                        ORDER BY isnull(startdate), startdate ASC, enddate ASC
					");
				$heutigerTerm = null;
				foreach ($terms as $fa) {
					if ($fa->startdate !== NULL && strtotime($fa->startdate) < time()) {
						$heutigerTerm = $fa;
					}
				}
				foreach ($terms as $fa) {
					$jetzigesThema = ($fa == $heutigerTerm);
					?>
					<div class="timeline-item <?= $fa->startdate === NULL ? "deaktiviert": "" ?>">
						<div class="timeline-img"></div>
						<?php if ($fa->startdate !== NULL){ ?>
						<div class="timeline-vorschau">
							<div class="makescroll makescrollalways">
								<div class="section-content clear horizontal-scroll-wrapper">
									<div class="horizontal-scroll blog-posts-wrapper noMatchHeight">
										<?php
										$ids = explode(",", $fa->postids);
										$args = array(
											'post_type' => "any",
											'orderby' => 'date',
											'order'   => 'ASC',
											'post_status' => array(
												"future",
												"publish"
											),
											'post__in' => $ids
										);

										$loop = new WP_Query( $args );
										if ( $loop->have_posts() ) :
											$i=-1;
											while ($loop->have_posts()) : $loop->the_post(); $i++;?>
												<div class="horizontal-scroll-item">
													<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
															<div class="post-item <?= (strtotime(get_the_time("d.m.Y H:i:s")) > time()) ? "deaktiviert" : "" ?> <?= get_the_time( 'Ymd' ) === current_time( 'Ymd' ) ? "heutigerBeitrag" : "" ?>">
																<?php
																$korrek = "";
																if ( isset( $_GET['korrektur'] ) && $_GET['korrektur'] == "true" ) {
																	$korrek = "?korrektur=true";
																}
																?>
																<?php if ( true ) { ?>
																	<figure>
																		<header class="timeline-vorschau-header">
																			<?php
																			the_title( '<h2 class="timeline-vorschau-title"><a href="' . esc_url( get_permalink() ) . $korrek . '" rel="bookmark">', '</a></h2>' );
																			?>
																		</header><!-- .entry-header -->
																		<a href="<?php the_permalink(); ?><?= $korrek ?>"><?php the_post_thumbnail(); ?></a>
																	</figure>
																<?php }  ?>
																<div class="timeline-vorschau-excerpt">
																	<?= the_excerpt() ?>
																</div>
															</div><!-- .post-item -->
														</article>
												</div>
											<?php
											endwhile;?>
											<div class="horizontal-scroll-item"></div><div class="horizontal-scroll-item"></div><div class="horizontal-scroll-item"></div>
											<?php wp_reset_postdata(); ?>
										<?php endif;?>
									</div><!-- .wrapper -->
								</div><!-- .section-content -->
							</div>
						</div>
						<?php } ?>
						<div class="timeline-content-wrapper">
							<div class="timeline-content timeline-card <?= $jetzigesThema ? "heutigesThema":"" ?>">
								<!--<h2><a href="<?/*= get_term_link($fa) */?>"><?/*= $fa->name */?></a></h2>
								<div class="date"><?/*= date("d.m.y", strtotime($fa->startdate)) . " bis " . date("d.m.y", strtotime($fa->enddate)) */?></div>
								<p><?/*= $fa->description */?></p>
								<p class="themenwelt_beitragstitel"><?/*= implode(" ... ", array_map(function ($postid){$p = get_post($postid); return "<a href='".get_post_permalink($p)."'>$p->post_title</a>";}, explode(",", $fa->postids))) */?></p>
								<a class="bnt-more" href="<?/*= get_term_link($fa) */?>">Mehr</a>-->
								<div class="timeline-img-header" style="background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, .4)), url('<?= get_field("themabild", $fa) ?>') center center/cover no-repeat;">
									<h2><?= $fa->name ?></h2>
								</div>
								<div class="date"><?= ($fa->startdate === NULL) ? "geplant" : ("ab " . date("d.m.Y", strtotime($fa->startdate))) //TODO Monat als österreischiches Wort?></div>
								<p><?= $fa->description ?></p>
								<p style="font-size: 80%"><?= implode(" ... ", array_map(function ($postid){$p = get_post($postid); return $p->post_title;}, explode(",", $fa->postids))) ?></p>
								<?php if ((strtotime($fa->startdate) < time()) && ($fa->startdate !== NULL)){?>
								<a class="bnt-more" href="<?= get_term_link($fa) ?>">Anschauen</a>
								<?php } else { ?>
								<a style="background: gray">Zukünftig</a>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
				</div></section>
			<?php the_posts_navigation(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
