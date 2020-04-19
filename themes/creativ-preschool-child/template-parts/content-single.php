<?php
 /*
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */
?>
<!-- Where am I: content-single.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-meta">
		<?php creativ_preschool_posted_on();
		creativ_preschool_entry_meta(); ?>
	</div><!-- .entry-meta -->
	<?php
	if ($url = get_field("audiofilevorlesen")){
		?>
		<div id="audiofilewrapper"><button onclick="jQuery('#audiofile').css('display', 'initial')" id="openVorlesenAudio"><img src="/wp-content/themes/creativ-preschool-child/Speaker_Icon.svg">
				<span>Vorlesen</span></button><div id="audiofile"><?= do_shortcode('[audio src="'.$url.'"]') ?></div></div>
		<?php
	}
	?>
	<div class="entry-content <?= get_the_time( 'Ymd' ) === current_time( 'Ymd' ) ? "heutigerBeitrag" : "" ?>">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'creativ-preschool' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php creativ_preschool_posts_tags(); ?>
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
