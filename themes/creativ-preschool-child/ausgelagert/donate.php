<?php

function should_show_donate(){
	if (! (is_front_page() or is_page("wir-stellen-uns-vor") or is_page("datenschutzerklaerung") or is_page("haftungsausschluss") or is_page("elterninformation"))) {return false;}

	if (! isset($_COOKIE["cookie_notice_accepted"])) {return false;}

	if (! isset($_COOKIE["erstbenutzung"])) {return false;}

	if (is_front_page()){
		if ($_COOKIE["erstbenutzung"] + 60*60*12 < time()){ //12h später
			return (rand(0, 2) == 0);
		}
	} else {
		return true;
	}
	return false;
}


function addDonateButton() {
	if (! should_show_donate()) {return;}

	$texte = [
		"Schön, dass du da bist!<br>Möchtest du uns was Gutes tun?",
		"Hallo, vielen Dank für deinen Besuch!<br>Möchtest du uns unterstützen?",
		"Gefällt dir unsere Website?<br>Wir wären um eine Spende dankbar.",
		"Ein Kaffee für das Team?",
		"Harte Arbeit darf gerne belohnt werden :)"
	]

	?>
	<script type="text/javascript" defer="" src="https://donorbox.org/install-popup-button.js"></script>
	<a class="dbox-donation-button noLeavingWarning" href="https://donorbox.org/homeschooling4kids-unterstutzung?default_interval=o">
		<div id="donatecup"
			 style="display: flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: rgb(255, 129, 63); color: white; border-radius: 32px; position: fixed; left: 18px; bottom: 18px; box-shadow: rgba(0, 0, 0, 0.4) 0px 4px 8px; z-index: 85; cursor: pointer; font-weight: 600; transition: all 0.2s ease 0s;">
			<img id="donateMitDampf" src="/wp-content/themes/creativ-preschool-child/Coffee_cup_icon.svg" alt="Buy Me A Coffee"
				 style="height: 40px; width: 40px; margin: 0; padding: 0;"><img id="donateOhneDampf" src="/wp-content/themes/creativ-preschool-child/Coffee_cup_icon_OhneDampf.svg" alt="Buy Me A Coffee"
																				style="height: 40px; width: 40px; margin: 0; padding: 0;"></div>
		<div id="donateinfo_wrapper">
			<div id="donateinfo"
				 style="position: fixed; display: block; opacity: 1; left: 90px; bottom: 16px; background: rgb(255, 255, 255); z-index: 85; transition: all 0.4s ease 0s; box-shadow: rgba(0, 0, 0, 0.3) 0px 4px 8px; padding: 16px; border-radius: 4px; font-size: 14px; color: rgb(0, 0, 0); width: auto; max-width: 280px; line-height: 1.5; font-family: sans-serif;">
				<?= $texte[rand(0, count($texte) - 1)] ?>
			</div></div>
	</a>
	<style>

		.loader {
			animation-name: spin;
			animation-timing-function: linear;
			animation-duration: 3s;
			animation-iteration-count: infinite;
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}

		#donatecup:hover{
			border: 2px solid;
			border-color: gray;
		}

		#donatecup{
			border: 2px solid;
			border-color: transparent;
			-webkit-transition: border-color 1s ease;
			-moz-transition: border-color 1s ease;
			-o-transition: border-color 1s ease;
			-ms-transition: border-color 1s ease;
			transition: border-color 1s ease;
		}

		#donatecup:hover #donateMitDampf{
			display: initial;
		}
		#donatecup:hover #donateOhneDampf{
			display: none;
		}

		#donateOhneDampf{
			display: initial;
		}

		#donateMitDampf{
			display: none;
		}
	</style>
	<script>
		jQuery(function(){
			jQuery("#donateinfo_wrapper").delay(11000).fadeOut(1000); //es erscheint erst nach 4s
			jQuery(".dbox-donation-button").click(function () {
				jQuery("#donatecup").children().addClass('loader')
				setTimeout(function(){
					var f = jQuery("#donorbox_widget_frame")
					if (f.length === 0){
						setTimeout(function(){
							jQuery("#donatecup").children().removeClass('loader')
						}, 2)
					} else {
						f.on("load", function () {
							jQuery("#donatecup").children().removeClass('loader')
						})
					}
				}, 1)
				try {
					gtag('event', 'donation_clicked');
				} catch (ignore) {
					console.log("kein gtag möglich");
				}
			})
		})
	</script>
	<?php
}


add_action( 'creativ_preschool_action_before_footer', 'addDonateButton' );
