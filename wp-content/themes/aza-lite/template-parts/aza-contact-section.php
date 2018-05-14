<?php
/**
 * Contact Section
 */

$frontpage_contact_shortcode = get_theme_mod('frontpage_contact_shortcode');
$heading = get_theme_mod('aza_contact_title');
$subheading = get_theme_mod('aza_contact_subtitle');
$separator_top = get_theme_mod('aza_separator_contact_top', '1');

?>
<section id="contact">
    <div class="container">
        <?php if( ! empty( $heading ) || ! empty( $subheading )) { ?>
            <div class="row">
                <div class="col-lg-12 col-centered text-center">
                    <?php
                    if(!empty($heading)) {
                        echo '<h2>'. esc_html( $heading ).'</h2>';
                    }

                    if ($separator_top) {
                        echo "<hr class='separator'/>";
                    }

                    if(!empty($subheading)) {
                        echo '<p class="section-subheading">'.esc_html( $subheading ).'</p>';
                    }?>
                </div>
            </div>
        <?php }

        if( !empty($frontpage_contact_shortcode) ){

            ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo do_shortcode( strip_tags( $frontpage_contact_shortcode ) );?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
