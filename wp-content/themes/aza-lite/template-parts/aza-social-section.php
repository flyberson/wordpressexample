<?php
/**
 * Social Section
 */

$aza_primary_header = get_theme_mod( 'aza_social_heading_1' );
$aza_secondary_header = get_theme_mod( 'aza_social_heading_2' );
$aza_appstore_link = get_theme_mod( 'aza_appstore_link', esc_url( '#' ) );
$aza_playstore_link = get_theme_mod( 'aza_playstore_link', esc_url( '#' ) );

$separator = get_theme_mod('aza_separator_social_ribbon', '1');

$social_icons = get_theme_mod('aza_social_ribbon_icons', json_encode(
    array(
        array('icon_value' => 'icon-social-facebook' ,
              'link' => '#' ,
              'color' => '#4597d1'),
        array('icon_value' => 'icon-social-twitter' ,
              'link' => '#' ,
              'color' => '#45d1c2'),
        array('icon_value' => 'icon-social-googleplus' ,
              'link' => '#' ,
              'color' => '#fc535f'),
    )));

?>
<section id="social">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php
                if( ! empty( $aza_primary_header ) ) { ?>
                    <h3>
                        <?php echo esc_html( $aza_primary_header ); ?>
                    </h3>
                <?php }
                if( ! empty ( $social_icons ) ) {
                    $social_icons_decoded = json_decode( $social_icons );

                    if( ! empty( $social_icons_decoded ) ) {
                        echo '<p>';

                        foreach( $social_icons_decoded as $social_icon ) {
                            echo '<a href="'. esc_url( $social_icon->link ) .'" style="color:'. esc_html( $social_icon->color ).';"><i class="fa '. esc_html( $social_icon->icon_value ) .'"></i></a>';
                        }

                        echo '</p>';
                    }
                }

                echo ( $separator ) ? "<hr class='separator'/>" : "";

                if( ! empty( $aza_secondary_header ) ) { ?>
                    <p class="section-subheading">
                        <?php echo esc_html( $aza_secondary_header ); ?>
                    </p>
                <?php } ?>
            </div>
        </div>
        <?php if( get_theme_mod( 'aza_social_ribbon_store_buttons' ) ) { ?>
            <div class='row social-btn-row'>
                <div class="col-lg-12 text-center">
                    <?php
                    if( ! empty( $aza_appstore_link ) ) { ?>
                        <a class="btn btn-stores" href="<?php echo esc_url( $aza_appstore_link );?>">
                            <img src=" <?php echo get_template_directory_uri() . '/images/appstore.png'; ?>" alt="#">
                        </a>
                    <?php }
                    if( ! empty( $aza_playstore_link ) ) { ?>
                        <a class="btn btn-stores" href="<?php echo esc_url( $aza_playstore_link );?>">
                            <img src=" <?php echo get_template_directory_uri() . '/images/playstore.png';?>" alt="#">
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
