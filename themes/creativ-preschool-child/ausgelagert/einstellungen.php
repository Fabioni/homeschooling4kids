<?php
function einstellungen()
{
	?>
	<div class="einstellungen">
		<?php
		$druck = true;
		$schreib = false;
		$computer = false;
		$opendyslexic = false;
		if (isset($_COOKIE["schriftart"])) {
			switch ($_COOKIE["schriftart"]) {
				case "druckschrift":
					$druck = true;
					$schreib = false;
					$computer = false;
					$opendyslexic = false;
					break;
				case "schreibschrift":
					$druck = false;
					$schreib = true;
					$computer = false;
					$opendyslexic = false;
					break;
				case "opendyslexic":
					$druck = false;
					$schreib = false;
					$computer = false;
					$opendyslexic = true;
					break;
				case "computerschrift":
					$druck = false;
					$schreib = false;
					$opendyslexic = false;
					$computer = true;
					break;
			}
		}
		?>
		<div style="margin: 10px 0 0 10px"><i style="font-size: 30px; cursor: pointer; background-color: #ddd" class="fa fa-cogs"></i></div>
		<ul id="einstellungenSlider">
			<li><input style="display: none" type="radio"
					   id="radioSchriftartSchreib" <?= $schreib ? "checked" : "" ?> name="schriftart"><label
					for="radioSchriftartSchreib" style="cursor: pointer; font-family: oesterschreibschrift"
					class="btn">Schreibschrift</label></li>
			<li><input style="display: none" type="radio" id="radioSchriftartDruck" <?= $druck ? "checked" : "" ?>
					   name="schriftart"><label for="radioSchriftartDruck"
												style="cursor: pointer; font-family: oesterdruckschrift"
												class="btn">Druckschrift</label></li>
			<li><input style="display: none" type="radio"
					   id="radioSchriftartComputer" <?= $computer ? "checked" : "" ?> name="schriftart"><label
					for="radioSchriftartComputer" style="cursor: pointer" class="btn">Computerschrift</label></li>
			<li><input style="display: none" type="radio"
					   id="radioSchriftartOpendyslexic" <?= $opendyslexic ? "checked" : "" ?>
					   name="schriftart"><label for="radioSchriftartOpendyslexic"
												style="cursor: pointer; font-family: opendyslexic" class="btn">Open
					Dyslexic</label></li>
			<li>
				<i id="schriftgrößeAnzeigeBuchstabe" style="font-size: 20px; color: green" class="fa fa-text-height"></i>
				<button type="button" class="fa-plus-square schriftgröße" id="schriftgrößePlus"/>
				<button type="button" class="fa-minus-square schriftgröße" id="schriftgrößeMinus"/>
			</li>
		</ul>
		<style>
			.einstellungen{
				display: inline-block;
			}

			#einstellungenSlider {
				background-color: #dddc;
				padding: 5px 5px 5px 1px;
				box-shadow: 2px 10px 8px 2px #0008
				list-style-type: none;
				margin: 0;
				position: absolute;
				z-index: 100;
				visibility: hidden;
				transform: translate(-100%, 0);
				transition: transform, visibility;
				transition-duration: 1s, 0s;
			}

			#einstellungenSlider * {
				margin-left: 0;
			}

			.einstellungen:hover #einstellungenSlider {
				visibility: visible;
				transform: translate(0, 0);
				transition-delay: 0s, 0s;
			}

			.einstellungen:not(:hover) #einstellungenSlider {
				transition-delay: 0.5s, 1.5s;
			}


			.einstellungen .schriftgröße {
				border: none;
				margin: 0 1px;
				width: 32px;
			}

			.einstellungen .schriftgröße:hover, .einstellungen .schriftgröße:focus {
				background: none;
				color: #FF8080;
				border: none;
			}

			.einstellungen label{
				width: 100%;
			}

			.einstellungen button:before {
				font-family: 'Font Awesome 5 Free';
				font-weight: 900;
			}

			.einstellungen button {
				padding: 0.2em;
			}

			.einstellungen input[type="radio"]:checked + label {
				border: 2px solid gray;
			}

			.einstellungen input[type="radio"] + label {
				font-size: 85%;
				padding: 5px 10px;
				border-radius: 5px;
				background-color: lightgrey;
				flex-grow: 1;
				flex-basis: 100%;
				text-align: center;
				margin: 5px;
				border: 2px solid transparent;
				box-shadow: rgba(0, 0, 0, 0.2) 2px 4px 8px 2px;
			}
		</style>
		<script>
			jQuery(function () {
				jQuery('input:radio[name="schriftart"]').change(
					function () {
						if (jQuery("#radioSchriftartDruck").is(':checked')) {
							jQuery("body").addClass("österdruck")
							jQuery("body").removeClass("österschreib")
							jQuery("body").removeClass("opendyslexic")
							try {
								ga('send', 'event', 'schriftart_geändert', "druckschrift");
							} catch (ignore) {
								console.log("kein gtag möglich");
							}
							document.cookie = "schriftart=druckschrift; path=/";
							toastr["success"]("Schriftart in Beiträgen auf die österreichische <span style='font-weight: bold;'>Druckschrift</span> gesetzt.", "Schriftart geändert");
						}
						if (jQuery("#radioSchriftartSchreib").is(':checked')) {
							jQuery("body").addClass("österschreib")
							jQuery("body").removeClass("österdruck")
							jQuery("body").removeClass("opendyslexic")
							try {
								ga('send', 'event', 'schriftart_geändert', "schreibschrift");
							} catch (ignore) {
								console.log("kein gtag möglich");
							}
							document.cookie = "schriftart=schreibschrift; path=/";
							toastr["success"]("Schriftart in Beiträgen auf die österreichische <span style='font-weight: bold;'>Schreibschrift</span> gesetzt.", "Schriftart geändert");
						}
						if (jQuery("#radioSchriftartOpendyslexic").is(':checked')) {
							jQuery("body").addClass("opendyslexic")
							jQuery("body").removeClass("österdruck")
							jQuery("body").removeClass("österschreib")
							try {
								ga('send', 'event', 'schriftart_geändert', "opendyslexic");
							} catch (ignore) {
								console.log("kein gtag möglich");
							}
							document.cookie = "schriftart=opendyslexic; path=/";
							toastr["success"]("Schriftart in Beiträgen auf <span style='font-weight: bold;'>OpenDyslexic</span> gesetzt. Diese ist speziell für LegasthenikerInnen.", "Schriftart geändert");
						}
						if (jQuery("#radioSchriftartComputer").is(':checked')) {
							jQuery("body").removeClass("österschreib")
							jQuery("body").removeClass("österdruck")
							jQuery("body").removeClass("opendyslexic")
							try {
								ga('send', 'event', 'schriftart_geändert', "computerschrift");
							} catch (ignore) {
								console.log("kein gtag möglich");
							}
							document.cookie = "schriftart=computerschrift; path=/";
							toastr["success"]("Schriftart in Beiträgen auf <span style='font-weight: bold;'>Computerschrift</span> gesetzt.", "Schriftart geändert");
						}
						setTimeout(function () {
							jQuery('.blog-posts-wrapper:not(.noMatchHeight) article .post-item').matchHeight();
						}, 600)
					}
				);
				var schriftgrößelimit = 0;

				jQuery('#schriftgrößePlus').click(function () {
					if (schriftgrößelimit >= 3) return;
					jQuery("article[id^='post-'] *").add("#schriftgrößeAnzeigeBuchstabe").css("font-size", function () {
						return parseInt(jQuery(this).css('font-size')) + 2 + 'px';
					});
					schriftgrößelimit++;
					if (schriftgrößelimit == 0){
						jQuery("#schriftgrößeAnzeigeBuchstabe").css("color", "green");
					} else {
						jQuery("#schriftgrößeAnzeigeBuchstabe").css("color", "");
					}
					if (toastOn)
					toastr["success"]("Schriftgröße in Beiträgen <span style='font-weight: bold;'>vergrößert</span> auf " + schriftgrößelimit, "Schriftgröße geändert");
					document.cookie = "schriftsize=" + schriftgrößelimit + "; path=/";
				})

				jQuery('#schriftgrößeMinus').click(function () {
					if (schriftgrößelimit <= -3) return;
					jQuery("article[id^='post-'] *").add("#schriftgrößeAnzeigeBuchstabe").css("font-size", function () {
						return parseInt(jQuery(this).css('font-size')) - 2 + 'px';
					});
					schriftgrößelimit--;
					if (schriftgrößelimit == 0){
						jQuery("#schriftgrößeAnzeigeBuchstabe").css("color", "green");
					} else {
						jQuery("#schriftgrößeAnzeigeBuchstabe").css("color", "");
					}
					if (toastOn)
					toastr["success"]("Schriftgröße in Beiträgen <span style='font-weight: bold;'>verkleinert</span> auf " + schriftgrößelimit, "Schriftgröße geändert");
					document.cookie = "schriftsize=" + schriftgrößelimit + "; path=/";
				})

				toastOn = false;
				var tmp = getCookieValue("schriftsize");
				if (parseInt(tmp) <= 3 && parseInt(tmp) >= 1){
					while (tmp > 0){
						jQuery('#schriftgrößePlus').click()
						tmp--;
					}
				}

				if (parseInt(tmp) >= -3 && parseInt(tmp) <= -1){
					while (tmp < 0){
						jQuery('#schriftgrößeMinus').click()
						tmp++;
					}
				}
				toastOn = true;
			});

			function getCookieValue(a) {
				const b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
				return b ? b.pop() : '';
			}
		</script>
	</div>
	<?php
}

function my_plugin_body_class($classes)
{
	$class = "österdruck";
	if (isset($_COOKIE["schriftart"])) {
		switch ($_COOKIE["schriftart"]) {
			case "druckschrift":
				$class = "österdruck";
				break;
			case "schreibschrift":
				$class = "österschreib";
				break;
			case "opendyslexic":
				$class = "opendyslexic";
				break;
			case "computerschrift":
				$class = "";
				break;
		}
	}

	$classes[] = $class;
	return $classes;
}

add_filter('body_class', 'my_plugin_body_class');
