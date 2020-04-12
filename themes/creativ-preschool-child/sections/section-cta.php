<?php 
/**
 * Template part for displaying About Section
 *
 *@package Creativ Preschool
 */
?>
    <?php 
        $cta_title              = creativ_preschool_get_option( 'cta_title' );
        $cta_button_label       = creativ_preschool_get_option( 'cta_button_label' );
        $cta_button_url         = creativ_preschool_get_option( 'cta_button_url' );
    ?>

    <div class="wrapper">
        <?php if ( !empty($cta_title ) )  :?>
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html($cta_title); ?></h2>
            </div><!-- .section-header -->
        <?php endif;?>

        <?php if ( !empty($cta_button_label) && !empty($cta_button_url) )  :?>
            <div class="read-more">
                <a href="<?php echo esc_url($cta_button_url); ?>" class="btn"><?php echo esc_html($cta_button_label); ?></a>
            </div><!-- .read-more -->
        <?php endif;?>
    </div><!-- .wrapper -->

