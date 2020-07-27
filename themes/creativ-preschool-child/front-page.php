<?php
/**
 * The template for displaying home page.
 * @package Creativ Preschool
 */

/* our-servies our-courses about-us */

?><?php
if ( 'posts' != get_option( 'show_on_front' ) ) {
	get_header(); ?>
    <!-- Where am I: front-page.php -->
	<style>
		div.democracy {
			background: darkorange;
			max-width: 600px;
			border-radius: 25px;
			border: 3px solid gray;
			animation-delay: 1s;
			animation-fill-mode: both;
			animation-name: headShakeCopy;
			animation-timing-function: ease-in-out;
			animation-duration: 1s;
		}

		@keyframes headShakeCopy {
			0% {
				-webkit-transform: translateX(0);
				transform: translateX(0)
			}
			6.5% {
				-webkit-transform: translateX(-6px) rotateY(-9deg);
				transform: translateX(-6px) rotateY(-9deg)
			}
			18.5% {
				-webkit-transform: translateX(5px) rotateY(7deg);
				transform: translateX(5px) rotateY(7deg)
			}
			31.5% {
				-webkit-transform: translateX(-3px) rotateY(-5deg);
				transform: translateX(-3px) rotateY(-5deg)
			}
			43.5% {
				-webkit-transform: translateX(2px) rotateY(3deg);
				transform: translateX(2px) rotateY(3deg)
			}
			50% {
				-webkit-transform: translateX(0);
				transform: translateX(0)
			}
		}

		strong.dem-poll-title {
			background: white;
			margin: 5px;
			border: 2px solid green;
			border-radius: 5px;
		}

		.dem-screen {
			margin-top: 20px;
			height: unset !important;
		}


		.democracy.open .dem-screen{
			max-height: 550px;
		}

		.democracy.open .dem-poll-title:after{
			content: "\f062";
		}

		.democracy .dem-poll-title{
			cursor: pointer;
		}

		.democracy .dem-poll-title:after{
			content: "\f063";
			font-family: 'Font Awesome 5 Free';
			position: absolute;
			bottom: 0;
			right: 0.5em;
		}


		.democracy .dem-poll-title{
			position: relative;
		}

		.democracy .dem-screen{
			max-height: 0px;
			transition: all 2s;
			overflow: hidden;
		}


		.democracy .dem-vote li {
			background: white;
			display: flex;
			padding: 10px 20px;
			margin: 10px 0;
			border: 2px solid black;
			position: relative;
		}

		.democracy ul.dem-vote, .democracy ul.dem-answers {
			padding: 0 40px;
			max-height: 400px !important;
			overflow-y: scroll !important;
		}

		.democracy ul.dem-vote::-webkit-scrollbar, .democracy ul.dem-answers::-webkit-scrollbar {
			-webkit-appearance: none;
			width: 8px;
		}

		.democracy ul.dem-vote::-webkit-scrollbar-thumb, .democracy ul.dem-answers::-webkit-scrollbar-thumb {
			border-radius: 5px;
			background-color: rgb(166, 52, 52);
			-webkit-box-shadow: 0 0 1px rgb(166, 52, 52);
		}


		.democracy .dem-vote li label {
			width: 100%;
		}

		ul.dem-answers .dem-winner .dem-label{
			position: relative;
		}

		ul.dem-answers .dem-winner .dem-label:before {
			/* background-color: black; */
			content: "\f004";
			color: red;
			position: absolute;
			font-family: "Font Awesome 5 Free";
			font-weight: bold;
			left: -1.5em;
		}

		li.dem-winner .dem-label {
			color: darkgreen;
		}

		body:not(.logged-in) .dem-poll-info {
			display: none;
		}

		@supports (appearance: none) or (-webkit-appearance: none) or (-moz-appearance: none) {
			input.dem__checkbox:checked {
				appearance: none;
				-webkit-appearance: none;
				-moz-appearance: none;
				display: block !important;
				width: 100%;
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-color: #0a0a;
			}

			.dem__checkbox_label, .dem__radio_label {
				position: static !important;
			}
		}


	</style>
<script>
	jQuery(function () {
		jQuery(".dem-poll-title").click(function () {
			jQuery(this).parent(".democracy").toggleClass("open");
		})
	})
</script>
	<script>
        var $ = jQuery

        function flipCover(css, options) {
            var options = options || {}
            if (typeof css === "object") {
                options = css
            } else {
                options.css = css
            }

            var css = options.css
            var url = options.url
            var text = options.text || css
            var width = options.width
            var height = options.height

            var $section = $(".flip-cover-" + css).addClass(css + "-section")
            var $button = $("<div>").addClass(css + "-button")
            var $cover = $("<div>").addClass(css + "-cover")
            var $outer = $("<div>").addClass(css + "-outer")
            var $inner = $("<div>").addClass(css + "-inner")

            if (width) {
                $section.css("width", width)
            }

            if (height) {
                $section.css("height", height)

                var lineHeight = ':after{ line-height: ' + height + ';}'
                var $outerStyle = $('<style>').text('.' + css + '-outer' + lineHeight)
                $outerStyle.appendTo($outer)
                var $innerStyle = $('<style>').text('.' + css + '-inner' + lineHeight)
                $innerStyle.appendTo($inner)
            }

            $cover.html($outer)
            $inner.insertAfter($outer)

            $button.html($("<a>").html(text).attr("href", url))

            $section.html($button)
            $cover.insertAfter($button)
        }

        <?php
        $heute = get_heute_seite();
        $heuteString = "Neues von heute";
        if ($heute){
	        $heuteTitel = $heute[1] != false ? "<i class='fa fa-arrow-right'></i> " . $heute[1] : "<i class='fa fa-arrow-right'></i> Schau dir die heutigen Beiträge an";
	        $heuteURL = $heute[0];
        } else {
            /*$heuteTitel = "Kein Fachbeitrag für heute vorhanden";
            $heuteURL = "";*/
	        $heuteTitel = "<i class='fa fa-arrow-right'></i> Zu allen Fachbeiträgen";
			$heuteString = "Hier geht es direkt zur Übersicht";
	        if (date("N") >= 6){ //Samstag oder Sonntag
				$heuteString = "Genieße das Wochenende";
			}
	        $heuteURL = get_post_type_archive_link("fachbeitrag");
        }
        ?>

        $(function () {
            flipCover({
                css: "heute_button_flip",
                url: "<?= $heuteURL ?>",
                text: "<?= $heuteTitel ?>",
                width: "fit-content"
            })
        })

		$(function () {
			$("#heuteButtonMobilDesktopContainer").on("click", "a", function () {
				try {
					gtag('event', 'heute_button_clicked', {
						'transport_type': 'beacon'
					}); //Todo nicht sicher ob das noch so geht oder man mit Callback Funktion arbeiten muss
				} catch (ignore) {
					console.log("kein gtag möglich");
				}
			})
		})

    </script>
    <style>
        @media screen and (min-width: 1300px) {
            .fabianHandy {
                display: none !important;
            }

            .fabianPC {
                display: block !important;
            }
        }

        .fabianPC {
            display: none;
        }

        .fabianHandy {
            display: block;
        }


        .heute_button_flip-section, .heute_button_flip-section * {
            box-sizing: border-box;
        }

        .heute_button_flip-section, .heute_button_flip-section div {
            transition-duration: 0.6s;
        }

        .heute_button_flip-section {
            margin-bottom: 10px;
            /*display: inline-block;*/
            min-width: 40%; /* Fabian */
            margin: auto; /* Fabian */
            display: table;
            position: relative;
            padding: 0.375em 0.375em 0;
            min-height: 2.5em;
            background: #a9adb6;
            border-radius: 0.25em;
            perspective: 300px;
            height: ;
            box-shadow: 0 -1px 2px #fff, inset 0 1px 2px rgba(0, 0, 0, .2), inset 0 0.25em 1em rgba(0, 0, 0, .1);
        }

        .heute_button_flip-section, .heute_button_flip-inner, .heute_button_flip-outer {
            font-size: 16px;
            padding: 10px 45px;
            border: 2px solid #ff90b6;
            border-radius: 50px;
            font-family: 'Sniglet', cursive;
        }


        .heute_button_flip-button {
            text-align: center;
            transition-timing-function: ease;
            opacity: 0;
        }

        .heute_button_flip-button a {
            text-decoration: none;
            font-weight: bold;
            color: #ff4d81;
        }

        .heute_button_flip-cover {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform-origin: left top;
            transform-style: preserve-3d;
            font: 1.25em / 2 "icon";
            color: white;
            text-align: center;
            pointer-events: none;
            z-index: 100;
        }

        .heute_button_flip-inner, .heute_button_flip-outer {
            position: absolute;
            width: 100%;
            height: 100%;
            text-shadow: 0 2px 4px rgba(0, 0, 0, .2);
            padding: 0px;
            /*border-radius: 0.25em;*/
            background-image: -webkit-linear-gradient(top, transparent 0%, rgba(0, 0, 0, .1) 100%);
        }

        .heute_button_flip-inner:after, .heute_button_flip-outer:after {
            content: "<?= $heuteString ?>";
            line-height: ;
            top: 50%;
            transform: translateY(-50%);
            position: relative;
            display: block;
        }

        .heute_button_flip-outer {
            background-color: #ff4d81;
            transform: translateZ(0.25em);
        }

        .heute_button_flip-inner {
            background-color: #ffa3bb;
        }

        .heute_button_flip-section:hover {
            background: #ebeff2;
        }

        .heute_button_flip-section:hover .heute_button_flip-button {
            opacity: 1;
        }

        .heute_button_flip-section:hover .heute_button_flip-cover {
            transform: rotateX(120deg);
        }

        .heute_button_flip-section:hover .heute_button_flip-inner {
            background-color: #ff4d81;
        }

        .heute_button_flip-section:hover .heute_button_flip-outer {
            background-color: #ff0a4b;
        }

        .heute_button_flip-section:hover .heute_button_flip-cover, .heute_button_flip-section:hover .heute_button_flip-inner, .heute_button_flip-section:hover .heute_button_flip-outer {
            transition-timing-function: cubic-bezier(0.2, 0.7, 0.1, 1.1);
        }

    </style>


    <style>
        .quote-container {
            margin-top: 50px;
            position: relative;
        }

		#notizzettel-wrapper *{
			max-width: 100%;
		}

		.home .section-header{
			margin-bottom: 20px;
		}

        .note {
            color: #333;
            position: relative;
            width: 18em;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Indie Flower', cursive;
			letter-spacing: 1px;
            font-size: 125%;
            box-shadow: 0 10px 10px 2px rgba(0, 0, 0, 0.3);
            min-height: 18em;
            vertical-align: center;
            padding-top: 30px;
            padding-bottom: 10px;
        }

        .note ul{
            padding-left: 0.5em;
        }

        .note ul li{
            margin-bottom: 0.5em;
        }

        .note .author {
            display: block;
            margin: 40px 0 0 0;
            text-align: right;
        }

        .yellow {
            background: #eae672;
            -webkit-transform: rotate(2deg);
            -moz-transform: rotate(2deg);
            -o-transform: rotate(2deg);
            -ms-transform: rotate(2deg);
            transform: rotate(2deg);
        }

        .section-content.col-3 article:nth-child(3n+1) .yellow {
            background: #eae672;
            -webkit-transform: rotate(-2deg);
            -moz-transform: rotate(-2deg);
            -o-transform: rotate(-2deg);
            -ms-transform: rotate(-2deg);
            transform: rotate(-2deg);
        }

        .section-content.col-3 article:nth-child(3n+2) .yellow {
            background: #eae672;
            -webkit-transform: rotate(4deg);
            -moz-transform: rotate(4deg);
            -o-transform: rotate(4deg);
            -ms-transform: rotate(4deg);
            transform: rotate(4deg);
        }

        .pin {
            background-color: #aaa;
            display: block;
            height: 32px;
            width: 2px;
            position: absolute;
            left: 50%;
            top: -16px;
            z-index: 1;
        }

        .pin:after {
            background-color: #A31;
            background-image: radial-gradient(25% 25%, circle, hsla(0, 0%, 100%, .3), hsla(0, 0%, 0%, .3));
            border-radius: 50%;
            box-shadow: inset 0 0 0 1px hsla(0, 0%, 0%, .1),
            inset 3px 3px 3px hsla(0, 0%, 100%, .2),
            inset -3px -3px 3px hsla(0, 0%, 0%, .2),
            23px 20px 3px hsla(0, 0%, 0%, .15);
            content: '';
            height: 12px;
            left: -5px;
            position: absolute;
            top: -10px;
            width: 12px;
        }

        .pin:before {
            background-color: hsla(0, 0%, 0%, 0.1);
            box-shadow: 0 0 .25em hsla(0, 0%, 0%, .1);
            content: '';
            height: 24px;
            width: 2px;
            left: 0;
            position: absolute;
            top: 8px;
            transform: rotate(57.5deg);
            -moz-transform: rotate(57.5deg);
            -webkit-transform: rotate(57.5deg);
            -o-transform: rotate(57.5deg);
            -ms-transform: rotate(57.5deg);
            transform-origin: 50% 100%;
            -moz-transform-origin: 50% 100%;
            -webkit-transform-origin: 50% 100%;
            -ms-transform-origin: 50% 100%;
            -o-transform-origin: 50% 100%;
        }

        #heute_button {
            display: table;
            min-width: 50%;
			box-shadow: 4px 4px 6px #0008;
            text-align: center;
            margin: auto;
            background: #ff4d81d0;
        }

        #heute_button:before {

        }

        #heute_button:hover {
            background: #ff4d81;
        }

		#notizzettel-wrapper a{
			color: inherit;
		}

		#notizzettel-wrapper h3{
			font-weight: bold;
			color: inherit;
			font-family: inherit;
			/*filter: drop-shadow(0px 0px 5px #F3B005);*/
		}

		#notizzettel-wrapper a:hover{
			filter: drop-shadow(2px 4px 6px black);
		}

		#notizzettel-wrapper{
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around;
		}

		#linkthemenwelt{
			background: aliceblue;
			text-align: center;
			margin-bottom: 1em;
			animation-name: verticalaufgehen;
			animation-delay: 3s;
			animation-fill-mode: both;
			animation-duration: 1.5s;
		}

		@keyframes verticalaufgehen {
			from{
				transform: scaleY(0);
			}
			to {
				transform: scaleY(1);
			}
		}

		#linkthemenwelt p{
			display: inline-block;
			vertical-align: middle;
			padding: 0;
			margin: 0;
			line-height: 3em;
			font-size: 20px;
		}

		#linkthemenwelt i:after{
			content: "\f0a6";
			transform: rotate(110deg);
			position: absolute;
			top: -1.3em;
			left: -1em;
			z-index: 2;
			font-family: "Font Awesome 5 Free";
			color: #512424;
			font-size: 1.2em;
		}

		#linkthemenwelt i{
			position: relative;
		}

    </style>
    <div id="heuteButtonMobilDesktopContainer" class="<?= $heute ? "heuteBeitragJa" : "heuteBeitragNein" ?>">
        <div class="fabianHandy">
            <!--<a id="heute_button" href="<?= $heuteURL ?>" class="btn btn-primary"><?= $heuteString ?><br><?= $heuteTitel ?></a>-->
            <a id="heute_button" href="<?= $heuteURL ?>" class="btn btn-primary"><?= $heuteTitel ?></a>
        </div>
        <div class="fabianPC">
            <div class="flip-cover-heute_button_flip"></div>
        </div>
    </div>
	<?php if (strpos($_SERVER['HTTP_HOST'], "h4k.dev") !== false && false){ ?>
	<div id="linkthemenwelt">
		<p><a href="/themenwelt"><i></i>Schau dir die neue Themenwelt an!</a></p>
	</div>
	<?php } ?>
	<div id="sommerNachricht">
		<h2>Es gibt Neuigkeiten!</h2>
		<p>Liebe Kinder!</br>
		Wir wünschen euch schöne Sommerferien.</p>

		<p>Auch wir gehen auf Sommerpause und starten wieder <u>nach den Ferien</u>!</p>

		<p>Natürlich kannst du auch im Sommer tolle Inhalte bei uns finden. In der <a href="/themenwelt">Themenwelt</a> findest du viele spannende Themen! Stöbere einfach durch und schaue dir die Beiträge an, die dich interessieren. Gerne kannst du uns auch weiterhin schreiben.</p>
		<p>Im <a href="/gutzuwissenbeitrag">Gut zu wissen Bereich</a> bist du immer auf dem neuesten Stand. Ob coole Veranstaltungen im Sommer oder wichtige Nachrichten, all das findest du auch in den Ferien.</p>

		<p>Alles Liebe und viel Spaß in deinen Sommerferien,</br>
		Fabian, Anna, Viktoria und Valerie</p>
		<?php if (is_user_logged_in()){ ?>
		<hr style="background-color: #7b7b7b">
		<div>
			<h3>Unser Sommerprogramm – Sport mit Markus</h3>
			<?php require(get_template_directory() . "/youtubeZeug/youtubeAPI.php");
				$videos = getMarkusVideos();
				foreach ($videos as $video){
			?>
			<div style="display: flex; margin: 20px 0">
				<div style="max-width: 800px; min-width: 60%;">
					<div style="padding-bottom: 56.25%; position: relative; width: 100%;">
						<iframe src="https://www.youtube.com/embed/<?= $video["id"] ?>" frameborder="0"
								allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen="" style="width: 100%; height: 100%; position: absolute; box-shadow: none;"></iframe>
					</div>
				</div>
				<div style="padding: 20px;background: #112;color: white; position: relative">
					<h2 style="color: white; font-size: 30px;">
						<?= $video["title"] ?>
					</h2>
					<p>
						<?= $video["description"] ?>
					</p>
					<div style="position: absolute; right: 10px; bottom: 10px" >
						<a href="/plaplub"><i style="font-size: 45px; color: orange;" class="fa fa-plus-circle turnover"></i></a>
					</div>
				</div>
			</div>
			<?php
				}
			?>

		</div>
		<?php } ?>
	</div>
	<style>
		.turnover{
			transition: transform 2s;
		}
		.turnover:hover{
			transform: rotate(90deg) scale(1.1);
			transition: transform 1s;
			cursor: pointer;
		}
	</style>
    <!--<div style="background: #ddd"><div class="wrapper"><?php // echo do_shortcode('[metaslider id="382"]');
	?></div></div>-->
	<?php /*
 	TODO Democrazy Poll so dass automatisch ...
	if (shortcode_exists("democracy")){
		echo do_shortcode( "[democracy id=1]" );
	}*/ ?>
	<?php /* <div id="pollWinnerWrapper">
		<div id="pollWinner">
			<strong class="pollWinner-title">Gewonnen hat das <a href="/themenwelt#heutigesThemaAnker">Thema Roboter</a>. Diese Woche beschäftigen wir uns damit!</strong>
		</div>
	</div> */ ?>
	<?php $enabled_sections = creativ_preschool_get_sections();
	if ( is_array( $enabled_sections ) ) {
		foreach ( $enabled_sections as $section ) {

			if ( ( $section['id'] == 'featured-slider' ) ) { ?>
				<?php $enable_featured_slider = creativ_preschool_get_option( 'enable_featured_slider' );
				if ( true == $enable_featured_slider ): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>">
						<?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cloud-bg.png' ) ?>"
                             class="cloud-bg">
                    </section>
				<?php endif; ?>

			<?php } elseif ( $section['id'] == 'our-services' ) { ?>
				<?php $enable_our_services_section = creativ_preschool_get_option( 'enable_our_services_section' );
				if ( true == $enable_our_services_section ): ?>
                    <section id="XXX<?php echo esc_attr( $section['id'] ); ?>" >
						<div class="section-header">
							<h2 class="section-title">Das findest du auf unserer Seite</h2>
						</div><!-- .section-header -->

						<div class="section-content" id="notizzettel-wrapper">
							<article><!-- class="fabianPC">-->
								<div>
									<div class="quote-container">
										<i class="pin"></i>
										<blockquote class="note yellow">
											<h3><a href="/mitmachbereich">Mach mit!</a></h3>
											<p>Von Kindern für Kinder. Hier bestimmst du den Inhalt! Selbst geschriebene Geschichten, Rätsel, Bilder und vieles mehr!</p>
										</blockquote>
									</div><!-- .entry-content -->
								</div><!-- .service-item-wrapper -->
							</article>


							<article><!-- class="fabianPC">-->
								<div>
									<div class="quote-container">
										<i class="pin"></i>
										<blockquote class="note yellow">
											<h3><a href="/gutzuwissenbeitrag">Infos und Nachrichten</a></h3>
											<p>Jetzt verpasst du nichts mehr! Aktuelle Nachrichten, Tipps und was du wissen musst, verständlich und leicht erklärt.</p>
										</blockquote>
									</div><!-- .entry-content -->
								</div><!-- .service-item-wrapper -->
							</article>


							<article><!-- class="fabianPC">-->
								<div>
									<div class="quote-container">
										<i class="pin"></i>
										<blockquote class="note yellow">
											<h3><a href="/fachbeitrag">Zuhause lernen</a></h3>
											<p>Täglich spannende Aufgaben, Spiele und Videos warten darauf von dir entdeckt zu werden!</p>
										</blockquote>
									</div><!-- .entry-content -->
								</div><!-- .service-item-wrapper -->
							</article>

							<!--
							<article class="fabianHandy" style="width: 100%">
								<div>
									<div class="quote-container">
										<i class="pin"></i>
										<blockquote class="note yellow" style="width: fit-content">
											<ul>
												<li>
													<b>Mitmach&shy;bereich</b>
													<p>Die Kinder können uns Rätselfragen schicken, Bilder die wir ausstellen und plapla</p>
												</li>
												<li>
													<b>Lern&shy;ziel&shy;orientierung</b>
													<p>Wir überlegen uns zu allen Beiträgen die Lernziele und plapla</p>
												</li>
												<li>
													<b>abwechslungs&shy;reiches Angebot</b>
													<p>Fachbeiträge sind eichtig aber der Spaß darf auch nicht fehlen etc etc pp</p>
												</li>
											</ul>
										</blockquote>
									</div>
								</div>
							</article>
							-->

						</div><!-- .section-content -->

							<?php /* get_template_part( 'sections/section', esc_attr( $section['id'] ) ); */ ?>

                    </section>
				<?php endif; ?>

			<?php } elseif ( $section['id'] == 'our-courses' ) { ?>
				<?php $enable_our_courses_section = creativ_preschool_get_option( 'enable_our_courses_section' );
				if ( true == $enable_our_courses_section ): ?>
                    <section id="XXX<?php echo esc_attr( $section['id'] ); //TODO schöner machen ?>" >
                        <!--<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/top-cloud-bg.png' ) ?>">-->
						<?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </section>
				<?php endif; ?>

			<?php } elseif ( $section['id'] == 'about-us' ) { ?>
				<?php $enable_about_us_section = creativ_preschool_get_option( 'enable_about_us_section' );
				if ( true == $enable_about_us_section ): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>" >
                        <div class="wrapper">
							<?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        </div>
                    </section>
				<?php endif; ?>

			<?php } elseif ( $section['id'] == 'team' ) { ?>
				<?php $enable_team_section = creativ_preschool_get_option( 'enable_team_section' );
				if ( true == $enable_team_section ): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/top-cloud-bg.png' ) ?>">
						<?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </section>
				<?php endif; ?>

			<?php } elseif ( $section['id'] == 'cta' ) { ?>
				<?php $enable_cta_section = creativ_preschool_get_option( 'enable_cta_section' );
				if ( true == $enable_cta_section ): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>">
						<?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </section>
				<?php endif;

			} elseif ( ( $section['id'] == 'blog' ) ) { ?>
				<?php $enable_blog_section = creativ_preschool_get_option( 'enable_blog_section' );
				if ( true == $enable_blog_section ): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>" class="blog-posts-wrapper page-section">
                        <div class="wrapper">
							<?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        </div>
                    </section>
				<?php endif;
			}
		}
	}
	?>
	<?php $likeposts = wp_ulike_get_most_liked_posts( 4, array( 'fachbeitrag', 'spassbeitrag', 'gutzuwissenbeitrag' ), 'post', 'all', 'like' ); ?>
	<h2>Diese Beiträge gefallen euch am meisten <i style="color: darkred" class="fa fa-heart"></i></h2>
	<div class="makescroll" id="frontpagemostlikedposts">
		<div class="section-content clear horizontal-scroll-wrapper">
			<div class="horizontal-scroll blog-posts-wrapper noMatchHeight">
				<?php

					foreach ($likeposts as $post){
						setup_postdata($post);
						?> <div class="horizontal-scroll-item"> <?php
							get_template_part( 'template-parts/content', get_post_format() );
							?> </div> <?php

					} ?>
					<div class="horizontal-scroll-item"></div><div class="horizontal-scroll-item"></div><div class="horizontal-scroll-item"></div>
			</div><!-- .wrapper -->
		</div><!-- .section-content -->
	</div>
	<h2>Was andere über uns sagen</h2>
	<?= do_shortcode("[testimonial_view id='1']"); ?>
	<?php
	if ( true == creativ_preschool_get_option( 'enable_frontpage_content' ) ) { ?>
        <div class="wrapper page-section">
			<?php include( get_page_template() ); ?>
        </div>
	<?php }
	get_footer();
} elseif ( 'posts' == get_option( 'show_on_front' ) ) {
	include( get_home_template() );
}
