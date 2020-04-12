<?php 
/**
 * Template part for displaying Blog Section
 *
 *@package Creativ Preschool
 */
?>
<?php 
    $blog_section_title    = creativ_preschool_get_option( 'blog_section_title' );
	$blog_category 		   = creativ_preschool_get_option( 'blog_category' );
	$blog_number		   = creativ_preschool_get_option( 'blog_number' );
?> 
    <?php if( !empty($blog_section_title) ):?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($blog_section_title);?></h2>
        </div><!-- .section-header -->
    <?php endif;?>

  	<div class="section-content col-3">
	  	<?php
			$blog_args = array(
				'posts_per_page' =>absint( $blog_number ),				
				'post_type' => 'post',
	            'post_status' => 'publish',
	            'paged' => 1,
				);

			if ( absint( $blog_category ) > 0 ) {
				$blog_args['cat'] = absint( $blog_category );
			}
			
			// Fetch posts.
			$the_query = new WP_Query( $blog_args );
			
		?>

		<?php if ( $the_query->have_posts() ) : 			
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			    <article>
			    	<div class="post-item">
				      	<?php if(has_post_thumbnail()):?>
					        <div class="featured-image">
					        	<a href="<?php the_permalink();?>"><?php the_post_thumbnail('full');?></a>  
					        </div>
				    	<?php endif?>

				    	<div class="entry-container">
					        <header class="entry-header">
								<h2 class="entry-title">
									<a href="<?php the_permalink();?>"><?php the_title();?></a>
								</h2>
					        </header>

					        <div class="entry-content">
			 				    <?php
									$excerpt = creativ_preschool_the_excerpt( 20 );
									echo wp_kses_post( wpautop( $excerpt ) );
								?>
					        </div><!-- .entry-content -->

					        <div class="entry-meta">		         
					            <?php creativ_preschool_posted_on();
								creativ_preschool_entry_meta(); ?>
					        </div><!-- .entry-meta -->
				        </div><!-- .entry-container -->
				    </div><!-- .post-item -->
			    </article>
		    <?php endwhile;?>
		    <?php wp_reset_postdata(); ?>
	    <?php endif;?>
  	</div><!-- .section-content -->