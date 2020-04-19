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
        $heuteString = "Heute";
        if ($heute){
	        $heuteTitel = $heute[1] != false ? "<i class='fa fa-arrow-right'></i> " . $heute[1] : "<i class='fa fa-arrow-right'></i> Schau dir die heutigen Beiträge an"; $heuteURL = $heute[0];
        } else {
            /*$heuteTitel = "Kein Fachbeitrag für heute vorhanden";
            $heuteURL = "";*/
	        $heuteTitel = "<i class='fa fa-arrow-right'></i> Zu allen Fachbeiträgen";
	        $heuteString = "Freu dich auf Montag";
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
            color: #ff7096;
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
            background-color: #ff7096;
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
            background-color: #ff7096;
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
            background: #ff7096b0;
        }

        #heute_button:before {

        }

        #heute_button:hover {
            background: #ff7096;
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
    </style>
    <div id="heuteButtonMobilDesktopContainer" class="<?= $heute ? "heuteBeitragJa" : "heuteBeitragNein" ?>">
        <div class="fabianHandy">
            <a id="heute_button" href="<?= $heuteURL ?>" class="btn btn-primary"><?= $heuteString ?><br><?= $heuteTitel ?></a>
        </div>
        <div class="fabianPC">
            <div class="flip-cover-heute_button_flip"></div>
        </div>
    </div>
    <!--<div style="background: #ddd"><div class="wrapper"><?php // echo do_shortcode('[metaslider id="382"]');
	?></div></div>-->
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
