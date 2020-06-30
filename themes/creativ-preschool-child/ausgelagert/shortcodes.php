<?php
function weiterlesen_shortcode_func( $atts, $content ) {
	$a = shortcode_atts( array(
		'titleAusklappen' => 'Weiterlesen',
		'titleEinklappen' => 'Weniger anzeigen',
	), $atts );
	$id = uniqid();
	$titleAusklappen = $a["titleAusklappen"];
	$titleEinklappen = $a["titleEinklappen"];

	$tmp = preg_split("<\/.*>", $content, 2);
	$contentBisEnde_pSpan = "";
	$contentAbEnde_p = $tmp[0];
	if (count($tmp) > 1){
		list($contentBisEnde_p, $contentAbEnde_p) = $tmp;
		$contentBisEnde_p = substr($contentBisEnde_p, 0, -1);
		$contentBisEnde_pSpan = "<span class='EinAusShortcode_content id_$id'>$contentBisEnde_p</span>";
	}

	return
		<<<EOD
		<span class='EinAusShortcode_dreiPunkte id_$id'> [...]</span>
		$contentBisEnde_pSpan
		<div class='EinAusShortcode_content id_$id'>$contentAbEnde_p</div>

		<div class="weiterlesen_shortcode_button" id='weiterlesen_shortcode_button$id' onclick='jQuery("#weiterlesen_shortcode_button$id").toggleClass("ausgeklappt"); jQuery(".EinAusShortcode_dreiPunkte.id_$id").toggleClass("ausgeklappt"); jQuery(".EinAusShortcode_content.id_$id").toggleClass("ausgeklappt")'>
			<span class="ausklappen"><i class='fa fa-angle-down'></i> $titleAusklappen</span>
			<span class="einklappen"><i class='fa fa-angle-up'></i> $titleEinklappen</span>
		</div>
EOD;
}
add_shortcode( 'weiterlesen', 'weiterlesen_shortcode_func' );



function worterklärung_shortcode_func( $atts, $content ) {
	$a = shortcode_atts( array(
		'tipp' => 'Das ist der Tipp',
	), $atts );

	$tipp = $a["tipp"];

	return do_shortcode("[su_tooltip position=\"north\" size=\"h4k_tooltip\" content=\"$tipp\"]<span class='underlinewhenhover'>{$content}</span>[/su_tooltip]");
}
add_shortcode( 'worterklärung', 'worterklärung_shortcode_func' );



function lautsprecher_shortcode_func( $atts, $content ) {
	return "<img src=\"/wp-content/themes/creativ-preschool-child/Speaker_Icon.svg\" style='height: 1.2em'>";
}
add_shortcode( 'lautsprecher', 'lautsprecher_shortcode_func' );

function teamsenden_shortcode_func( $atts, $content ) {
	return "";
	// TODO teamsenden!!!
	return "<input type='text' placeholder='$content' class='teamsendeninput'>";
}
add_shortcode( 'teamsenden', 'teamsenden_shortcode_func' );
