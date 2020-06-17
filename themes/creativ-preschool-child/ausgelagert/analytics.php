<?php

function gaactions(){
	?>
	<script>
		jQuery(function () {
			var firsttimelernziele = true;
			jQuery(".wp-block-otfm-box-spoiler-start.otfm-sp__wrapper.otfm-sp__box.otfm-sp__XXXXXX").click(function (event) {
				if (firsttimelernziele) {
					try {
						gtag('event', 'lernziele_aufgeklappt');
					} catch (ignore) {
						console.log("kein gtag möglich");
					}
				}
				firsttimelernziele = false;
			})
		})
		jQuery(function () {
			jQuery(".astm-search-menu").click(function () {
				try {
					gtag('event', 'suche_aufgemacht');
				} catch (ignore) {
					console.log("kein gtag möglich");
				}
			})
		})

		jQuery(function () {
			jQuery(".fabian_check_me_submit").click(function () {
				try {
					gtag('event', 'abfrage_checkmesubmit_geclicked');
				} catch (ignore) {
					console.log("kein gtag möglich");
				}
			})
		})

		jQuery(function () {
			var audioerstesmal = true;
			jQuery("#audiofile audio").on("play", function () {
				if (audioerstesmal) {
					try {
					} catch (ignore) {
						console.log("kein gtag möglich");
					}
				}
				audioerstesmal = false;
			})
		})

		jQuery(function () {
			try {
				gtag('event', 'seite_geladen', {
					'event_label': '<?= isset($_COOKIE["schriftart"]) ? $_COOKIE["schriftart"] : "notSetStandart" ?>',
					'non_interaction': true
				});
			} catch (ignore) {
				console.log("kein gtag möglich");
			}
		})

		//fix für learningapps
		jQuery(function () {
			setTimeout(function () {
				var fq = jQuery(".is-provider-learningapps-org iframe");
				fq.on("load", function () {
					var fq = jQuery(".is-provider-learningapps-org iframe");
					var f = fq.get(0);
					f.parentNode.replaceChild(f.cloneNode(), f)
				})
			}, 100)
		})
	</script>
	<?php
}


add_action("wp_footer", "gaactions"); //TODO Javscript auslagern

