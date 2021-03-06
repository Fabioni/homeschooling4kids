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

<script>
	jQuery(function () {
		jQuery("[data-audiostelle]").click(function () {
			if (jQuery('#audiofile').hasClass('ausgeklappt')){
				var zeit = jQuery(this).data("audiostelle").split(":")
				jQuery("#audiofilewrapper audio").get(0).currentTime = parseInt(zeit[0]) * 60 + parseInt(zeit[1]);
				jQuery("#audiofilewrapper audio").get(0).play();
				jQuery("#audiofilewrapper audio").get(0).muted=false
			}
		})
		jQuery("#audiofilewrapper button").click(function () {
			jQuery("[data-audiostelle]").toggleClass("has-vorleseHook");
		});

	})
</script>
<?php
$zusatzklassen = "";
if (get_field("audiofilevorlesen")) $zusatzklassen .= "hasAudio ";
if (get_field("hervorheben")) $zusatzklassen .= get_field("hervorheben") . " ";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($zusatzklassen); ?>>
	<?php
	if ($url = get_field("audiofilevorlesen")){
		?>
		<div id="audiofilewrapper"><button onclick="jQuery('#audiofile').toggleClass('ausgeklappt'); jQuery('#audiofilewrapper audio').get(0).pause()" id="openVorlesenAudio"><img src="/wp-content/themes/creativ-preschool-child/Speaker_Icon.svg">
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
