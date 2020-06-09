<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Creativ Preschool
 */

get_header();
?>
<style>
	.page-section{
		max-width: none;
	}
</style>
<?php
if ($maxbreite = get_field("max_breite")) {
	?>
	<style>
		#primary{
			max-width: <?= $maxbreite ?>px;
			margin: auto;
		}
	</style>
	<?php
}

if ($hintergrund = get_field("vorgabe_hintergrunde")) {
	if ($hintergrund == "bild") {
		?>
		<style>
			.entry-content{
				background: #ddd url("<?= get_field("hintergrundbild") ?>") top center;
				background-size: contain;
				background-repeat: space;
				box-shadow: none;
				border: none;
			}
		</style>
		<?php
	} else {
		if ( $hintergrund == "schriftrolle1" ) {
			?>
			<style>
				/*
				#primary.single-schmaler{
					max-width: 900px;
					margin: auto;
				}*/

				.entry-content-backgroundimage-oben{
					width: 100%;
				}

				.entry-content{
					background: none !important;
					box-shadow: none !important;
				}

				.entry-content{
					color: #2a2c2d !important;
				}

				.page-section{
					max-width: none;
				}

				.entry-content-backgroundimage-mitte{
					background: url("/wp-content/themes/creativ-preschool-child/hintergründe/schriftrolle1-mitte.png") top center repeat-y;
					background-size: 100%, 0;
					height: 100%;
					width: 100%;
					padding: 20px 20%;
				}

				.entry-content-backgroundimage-unten{
					width: 100%;
				}

				.entry-content-backgroundimage-unten img, .entry-content-backgroundimage-oben img{
					width: 100%;
				}

				@media screen and (max-width: 782px) {
					.entry-content-wrapperforimages{
						margin-left: calc(40% - 50vw);
						margin-right: calc(40% - 50vw);
					}

					.entry-content-backgroundimage-mitte{
						padding: 20px 15%;
					}
				}
			</style>
			<?php
		} else {
			// andere Schriftrolle
		}
	}
} ?>
    <!-- Where am I: single.php -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
