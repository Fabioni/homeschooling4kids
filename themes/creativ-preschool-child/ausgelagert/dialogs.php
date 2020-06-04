<?php
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_so_22382151' );
add_action( 'wp_header', 'print_header_so_22382151' );
add_action( 'wp_footer', 'print_footer_so_22382151_externeLinks' );
add_action( 'wp_footer', 'print_footer_so_22382151_footer' );

/**
 * Enqueue jQuery Dialog and its dependencies
 * Enqueue jQuery UI theme from Google CDN
 */
function enqueue_scripts_so_22382151() {
	wp_enqueue_script( 'jquery-ui-dialog', false, array( 'jquery-ui', 'jquery' ) );
	wp_enqueue_style( 'jquery-ui-cdn', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/dot-luv/jquery-ui.min.css' );
}


/**
 * Print Dialog custom style
 */
function print_header_so_22382151() {
	?>
	<style>
		/* A class used by the jQuery UI CSS framework for their dialogs. */
		.ui-front {
			z-index: 1000000 !important; /* The default is 100. !important overrides the default. */
		}

		.ui-widget-overlay {
			opacity: .8;
		}
	</style>
	<?php
}

/**
 * Print Dialog script
 */
function print_footer_so_22382151_externeLinks() {
	$current_domain = $_SERVER['SERVER_NAME'];
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$('a[href^="http://"],a[href^="https://"]')
				.not('[href*="<?php echo $current_domain; ?>"]')
				.not('.noLeavingWarning')
				.click(function (e) {
					e.preventDefault();
					var url = this.href;
					$('<div></div>').appendTo('body')
						.html('<div><p>Hier verlässt du homeschooling4kids.at</p><p>Möchtest du fortfahren?</p></div>')
						.dialog({
							show: {effect: "blind", duration: 500},
							hide: 'fold',
							modal: true, title: 'Unsere Seite verlassen', zIndex: 10000, autoOpen: true,
							width: 'auto', resizable: false,
							buttons: {
								Ja: function () {
									window.open(url);
									$(this).dialog("close");
								},
								Nein: function () {
									$(this).dialog("close");
								}
							},
							close: function (event, ui) {
								$(this).remove();
							}
						});
				})
		});
	</script>
	<?php
}


/**
 * Print Dialog script
 */
function print_footer_so_22382151_footer() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$('#menu-rechtliches a')
				.click(function (e) {
					e.preventDefault();
					var url = this.href;
					$('<div></div>').appendTo('body')
						.html('<div><p>Möchtest du wirklich den Kinderbereich verlassen?</p></div>')
						.dialog({
							show: {effect: 'fade', speed: 1000},
							hide: 'fold',
							modal: true, title: 'Elternbereich', zIndex: 10000, autoOpen: true,
							width: 'auto', resizable: false,
							buttons: {
								Ja: function () {
									window.open(url);
									$(this).dialog("close");
								},
								Nein: function () {
									$(this).dialog("close");
								}
							},
							close: function (event, ui) {
								$(this).remove();
							}
						});
				})
		});
	</script>
	<?php
}
