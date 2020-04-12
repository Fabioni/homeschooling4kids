<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creativ Preschool
 */

?>
<!-- Where am I: content-search.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-item">
		<?php if( is_sticky() ){ ?>
	    	<div class="favourite"><i class="fa fa-star"></i></div>
		<?php } ?>

		<?php if ( has_post_thumbnail() ) { ?>
			<figure>
			    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</figure>
		<?php } ?>

		<div class="entry-container">
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php creativ_preschool_posted_on();
					creativ_preschool_entry_meta(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</div><!-- .entry-container -->
	</div><!-- .post-item -->
</article><!-- #post-## -->
