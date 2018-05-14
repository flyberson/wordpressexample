<!-- =========================
INTERGEO MAPS 
============================== -->
<?php

$frontpage_map_shortcode = get_theme_mod('frontpage_map_shortcode');

if ( ! empty( $frontpage_map_shortcode ) ) {

    ?>

    <section id="map" class="map-section">

        <div class="map_overlay"></div>

            <div id="cd-google-map">

                <?php echo do_shortcode($frontpage_map_shortcode);?>

            </div>

        </div>

    </section>

    <?php
}
    ?>
