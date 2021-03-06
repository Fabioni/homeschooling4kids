<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */
?>
<!-- Where am I: content.php -->
<?php
$colorStyle = "";
if (has_post_thumbnail()) {
	$post_thumbnail_id = get_post_thumbnail_id();
	$filelocation = get_attached_file($post_thumbnail_id);
	$colors = averageColor($filelocation);
	if ($colors !== null && !isGray($colors, 10)) {
		$colors = lightDown($colors, 150);
		$colorStyle = "style='background-color: rgb($colors[red], $colors[green], $colors[blue]);'";
	}
	?>
<?php } ?>
<?php
$zusatzklassen = "notSingle ";
if (get_field("audiofilevorlesen")) $zusatzklassen .= "hasAudio ";
if (get_field("hervorheben")) $zusatzklassen .= get_field("hervorheben") . " ";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($zusatzklassen); ?>>
	<div
		class="post-item <?= get_the_time('Ymd') === current_time('Ymd') ? "heutigerBeitrag" : "" ?>" <?= $colorStyle ?>>
		<i title="hervorgehobener Artikel" class="sternAnzeige fa fa-star"></i>
		<?php if (is_sticky()) { ?>
			<div class="favourite"><i class="fa fa-star"></i></div>
		<?php } ?>
		<?php
		$korrek = "";
		if (isset($_GET['korrektur']) && $_GET['korrektur'] == "true") {
			$korrek = "?korrektur=true";
		}
		?>
		<?php if (has_post_thumbnail()) { ?>
			<figure style="background-color: white; border-top-left-radius: 25px; border-top-right-radius: 25px">
				<a href="<?php the_permalink(); ?><?= $korrek ?>"><?php the_post_thumbnail('post-thumbnail', array('loading' => 'lazy')); ?></a>
			</figure>
		<?php } ?>
		<header class="entry-header">
			<?php
			if (is_single()) :
				the_title('<h1 class="entry-title">', '</h1>');
			else :
				the_title('<h2 class="entry-title"><a class="fabian-Pfeil" href="' . esc_url(get_permalink()) . $korrek . '" rel="bookmark">', '</a></h2>');
			endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-container">
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

			<div class="entry-meta-wrapper">
				<div class="entry-meta">
					<?php if (get_field("audiofilevorlesen")) { ?>
						<span>
					<img src="/wp-content/themes/creativ-preschool-child/Speaker_Icon.svg" style="height: 1.5em"
						 title="Diesen Beitrag kannst du dir vorlesen lassen">
					</span>
					<?php } ?>
					<?php
					if (function_exists('wp_ulike_get_post_likes') && wp_ulike_get_post_likes(get_the_ID()) > 0) { //TODO nur vorübergehende Deaktvierung, da wahrscheinlich Bug in WP-Ulike
						?>
						<span class="cat-links cat_post_likes"><?= wp_ulike_get_post_likes(get_the_ID()) ?></span>
					<?php } ?>
				</div>
				<div class="entry-meta-upperline entry-meta">
					<?php creativ_preschool_posted_on(); ?>
					<wbr>
					<?php
					if (is_post_type_archive("fachbeitrag")) {
						creativ_preschool_entry_meta(array("spasskategorie", "leistungsstufe", "schlagwort"));
					} elseif (is_post_type_archive("spassbeitrag")) {
						creativ_preschool_entry_meta(array("leistungsstufe", "schlagwort"));
					} else {
						creativ_preschool_entry_meta();
					} ?>
				</div>
			</div><!-- .entry-meta -->
		</div>
	</div><!-- .post-item -->
</article><!-- #post-## -->
