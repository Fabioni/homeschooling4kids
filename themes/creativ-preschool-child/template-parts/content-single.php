<?php
/*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Creativ Preschool
*/
?>
<!-- Where am I: content-single.php -->

<script>
	jQuery(function () {
		jQuery("[data-audiostelle]").click(function () {
			if (jQuery('#audiofile').hasClass('ausgeklappt')) {
				var zeit = jQuery(this).data("audiostelle").split(":")
				jQuery("#audiofilewrapper audio").get(0).currentTime = parseInt(zeit[0]) * 60 + parseInt(zeit[1]);
				jQuery("#audiofilewrapper audio").get(0).play();
				jQuery("#audiofilewrapper audio").get(0).muted = false
			}
		})
		jQuery("#audiofilewrapper button").click(function () {
			jQuery("[data-audiostelle]").toggleClass("has-vorleseHook");
		});

	})
</script>
<?php
$colorStyle = "";
if (has_post_thumbnail()) {
	$post_thumbnail_id = get_post_thumbnail_id();
	$filelocation = get_attached_file($post_thumbnail_id);
	$colors = averageColor($filelocation);
	if ($colors != null) $colorStyle = "style='border: 3px solid rgb($colors[red], $colors[green], $colors[blue]);'";
	?>
<?php } ?>
<?php
$zusatzklassen = "";
if (get_field("audiofilevorlesen")) $zusatzklassen .= "hasAudio ";
if (get_field("hervorheben")) $zusatzklassen .= get_field("hervorheben") . " ";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($zusatzklassen) ?>>
	<i title="hervorgehobener Artikel" class="sternAnzeige fa fa-star"></i>
	<div class="entry-meta">
		<?php creativ_preschool_posted_on();
		creativ_preschool_entry_meta(); ?>
	</div><!-- .entry-meta -->
	<?php
	if ($url = get_field("audiofilevorlesen")) {
		?>
		<div id="audiofilewrapper">
			<button
				onclick="jQuery('#audiofile').toggleClass('ausgeklappt'); jQuery('#audiofilewrapper audio').get(0).pause()"
				id="openVorlesenAudio"><img src="/wp-content/themes/creativ-preschool-child/Speaker_Icon.svg">
				<span>Vorlesen</span></button>
			<div id="audiofile"><?= do_shortcode('[audio src="' . $url . '"]') ?></div>
		</div>
		<?php
	}
	?>
	<div class="entry-content-wrapperforimages <?= get_field("vorgabe_hintergrunde") ?>">
		<?php if (get_field("vorgabe_hintergrunde") == "schriftrolle1") { ?>
			<div class="entry-content-backgroundimage-oben">
				<img src="/wp-content/themes/creativ-preschool-child/hintergründe/schriftrolle1-oben.png">
			</div>
		<?php } ?>
		<div class="entry-content-backgroundimage-mitte">
			<div <?= $colorStyle ?>
				class="entry-content <?= get_the_time('Ymd') === current_time('Ymd') ? "heutigerBeitrag" : "" ?>">
				<?php the_content(); ?>
				<?php
				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'creativ-preschool'),
					'after' => '</div>',
				));
				?>
				<div id="likerButtonWrapper"><?= do_shortcode("[wp_ulike]") ?></div>
			</div>
			<?php if ($lz = get_field("lernziele_text")){ ?>
			<div class="lernzieleWrapper">
				<h2 class="lernzieleÖffnen lernzieleÖffnenOben">Lernziele<i class="fa fa-long-arrow-alt-down"></i></h2>
				<div class="lernziele">
					<?= get_field("lernziele_text") ?>
				</div>
				<h2 class="lernzieleÖffnen lernzieleÖffnenUnten">Lernziele <i class="fa fa-long-arrow-alt-down"></i></h2>
			</div>
			<?php } ?>
		</div>
		<?php if (get_field("vorgabe_hintergrunde") == "schriftrolle1") { ?>
			<div class="entry-content-backgroundimage-unten">
				<img src="/wp-content/themes/creativ-preschool-child/hintergründe/schriftrolle1-unten.png">
			</div>
		<?php } ?>
	</div><!-- .entry-content -->
	<?php creativ_preschool_posts_tags(); ?>
	<?php if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__('Edit %s', 'creativ-preschool'),
					the_title('<span class="screen-reader-text">"', '"</span>', false)
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
