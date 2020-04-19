<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */

?>
<!-- Where am I: content-page.php -->
<!--
<script>
    jQuery(function () {
        for (var i = 1; i <= 5; i++){jQuery("#post-47 > div ul li:nth-child(" +i +")").css('opacity', '0').delay(700).fadeTo(1000 + 400 * i, 1);}
    })
</script>
<style>
    #post-47 > div ul li{
        opacity: 0;
    }
</style>-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ($url = get_field("audiofilevorlesen")){
		?>
		<div id="audiofilewrapper"><button onclick="jQuery('#audiofile').css('display', 'initial')" id="openVorlesenAudio"><img src="/wp-content/themes/creativ-preschool-child/Speaker_Icon.svg">
				<span>Vorlesen</span></button><div id="audiofile"><?= do_shortcode('[audio src="'.$url.'"]') ?></div></div>
		<?php
	}
	?>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'creativ-preschool' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'creativ-preschool' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
