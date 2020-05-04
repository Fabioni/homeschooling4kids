<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */

get_header(); ?>
	<div id="primary" class="content-area <?= (!is_date()) ? "makevorschau" : "" ?>">
		<!-- Where am I: alle-themen.php -->
		<main id="main" class="site-main" role="main">
			<div class="">
				<?php
				global $wpdb;

				$terms = $wpdb->get_results(/** @lang MySQL */ "
						SELECT t.*, tt.*, postdates.startdate, postdates.enddate, postdates.postids
						FROM wp_terms AS t
						INNER JOIN wp_term_taxonomy AS tt
						ON t.term_id = tt.term_id
                        JOIN (
							SELECT GROUP_CONCAT(wp_posts.ID SEPARATOR ',') as postids, MIN(wp_posts.post_date) as startdate,  MAX(wp_posts.post_date) as enddate, wp_term_relationships.term_taxonomy_id as termid
							FROM wp_posts
							LEFT JOIN wp_term_relationships
							ON (wp_posts.ID = wp_term_relationships.object_id)
							WHERE
                            wp_posts.post_type = 'fachbeitrag'
							AND (wp_posts.post_status = 'publish'
							OR wp_posts.post_status = 'acf-disabled'
							OR wp_posts.post_status = 'private')
                            GROUP BY termid
						) as postdates ON postdates.termid = t.term_id
						WHERE tt.taxonomy IN ('thema')
                        ORDER BY startdate, enddate
					");
				foreach ($terms as $fa) { ?>
					<div style="border: 1px dotted black; margin: 20px">
						<header style="border: 1px solid black">
							<h2><a href="<?= get_term_link($fa) ?>"><?= $fa->name ?></a></h2>
							<img style="float: right; max-height: 5em" src="<?= get_field("themabild", $fa) ?> ">
							<p><?= date("d.m.y", strtotime($fa->startdate)) . " bis " . date("d.m.y", strtotime($fa->enddate)) ?></p>
							<p class="clear"><?= $fa->description ?></p>
						</header>
						<p><?= implode(" ... ", array_map(function ($postid){$p = get_post($postid); return "<a href='".get_post_permalink($p)."'>$p->post_title</a>";}, explode(",", $fa->postids))) ?></p>
					</div>
				<?php } ?>
			</div>
			<?php the_posts_navigation(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
