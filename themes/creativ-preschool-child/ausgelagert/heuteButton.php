<?php
function get_heute_seite() {
	$today = getdate();
	$args  = array(
		'post_type'      => 'fachbeitrag',
		'post_status'    => 'publish',
		'posts_per_page' => - 1,
		//'orderby' => 'title',
		'order'          => 'ASC',
		'date_query'     => array(
			array(
				'year'  => $today['year'],
				'month' => $today['mon'],
				'day'   => $today['mday'],
			),
		),
	);
	$loop  = new WP_Query( $args );

	if ( $loop->have_posts() ) {
		if ( $loop->post_count > 1 ) {
			return array( get_site_url() . "?m=" . current_time( "Ymd" ), false );
			// TODO ACHTUNG BEI ÄNDERUNG DER LINK STRUKTUR!!!
			/*return wp_get_archives(array("before" => "before", "after" => "after", 'echo' => false, "format" => "", "post_type" => "fachbeitrag"));
			//return wp_get_archives(array("echo" => false, "post_type" => "fachbeitrag"));
			global $wp_rewrite;
			$link = $wp_rewrite->get_day_permastruct();
			return $wp_rewrite->get_day_permastruct();
			$link = str_replace( '%year%', $today['year'], $link );
			$link = str_replace( '%monthnum%', zeroise( intval( $today['mon'] ), 2 ), $link );
			$link = str_replace( '%day%', zeroise( intval( $today['mday'] ), 2 ), $link );
			return $link;
			//return get_day_link( $today['year'], $today['mon'], $today['mday'] );
			*/
		} elseif ( $loop->post_count == 1 ) {
			$loop->the_post();

			return array( get_permalink(), get_the_title() );
		} else {
			return false;
		}
	} else {
		return null;
	}
	//wp_reset_postdata(); //TODO drüber nachdenken ob ich das brauch
}
