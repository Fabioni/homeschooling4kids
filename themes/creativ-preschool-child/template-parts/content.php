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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-item <?= get_the_time( 'Ymd' ) === current_time( 'Ymd' ) ? "heutigerBeitrag" : "" ?>">
		<?php if ( is_sticky() ) { ?>
            <div class="favourite"><i class="fa fa-star"></i></div>
		<?php } ?>
		<?php
		$korrek = "";
		if (isset($_GET['korrektur']) && $_GET['korrektur'] == "true") {
			$korrek = "?korrektur=true";
		}
		?>
		<?php if ( has_post_thumbnail() ) { ?>
            <figure>
                <a href="<?php the_permalink(); ?><?= $korrek ?>"><?php the_post_thumbnail(); ?></a>
            </figure>
		<?php } ?>

        <div class="entry-container">
            <header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a class="fabian-Pfeil" href="' . esc_url( get_permalink() ) . $korrek . '" rel="bookmark">', '</a></h2>' );
				endif; ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
				<?php the_excerpt(); ?>
            </div><!-- .entry-content -->
			<?php
			if (get_field("audiofilevorlesen")){
				?>
				<img src="/wp-content/themes/creativ-preschool-child/Speaker_Icon.svg" style="height: 1.5em" title="Diesen Beitrag kannst du dir vorlesen lassen">
				<?php
			}
			?>
			<?php // if ( 'post' === get_post_type() ) : ?>
			<?php if ( true ) : ?>
                <div class="entry-meta">
					<?php creativ_preschool_posted_on();
					if (function_exists('wp_ulike_get_post_likes')){
					?>
					<span class="cat-links cat_post_likes"><?= wp_ulike_get_post_likes(get_the_ID()) ?></span>
					<?php }
					if ( is_post_type_archive( "fachbeitrag" ) ) {
						creativ_preschool_entry_meta( array( "spasskategorie", "leistungsstufe", "schlagwort" ) );
					} elseif ( is_post_type_archive( "spassbeitrag" ) ) {
						creativ_preschool_entry_meta( array( "leistungsstufe", "schlagwort" ) );
					} else {
						creativ_preschool_entry_meta();
					} ?>
                </div><!-- .entry-meta -->
			<?php endif; ?>
        </div><!-- .entry-container -->
    </div><!-- .post-item -->
</article><!-- #post-## -->
