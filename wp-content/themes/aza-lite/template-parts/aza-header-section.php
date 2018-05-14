<?php
/**
 * Hero Section
 */

$aza_appstore = get_theme_mod('aza_appstore', get_template_directory_uri() . '/images/appstore.png');
$aza_playstore = get_theme_mod('aza_playstore', get_template_directory_uri() . '/images/playstore.png');
$aza_main_header = get_theme_mod('aza_header_title');
$aza_secondary_header = get_theme_mod('aza_subheader_title');
$aza_appstore_link = get_theme_mod('aza_appstore_link', esc_url( '#' ) );
$aza_playstore_link = get_theme_mod('aza_playstore_link', esc_url( '#' ) );
$aza_buttons_type = get_theme_mod ('aza_header_buttons_type','normal_buttons');
$aza_button_text_1 = get_theme_mod ('aza_button_text_1', esc_html__( 'Button 1', 'aza-lite' ) );
$aza_button_text_2 = get_theme_mod ('aza_button_text_2', esc_html__( 'Button 2', 'aza-lite' ) );
$aza_button_link_1 = get_theme_mod ('aza_button_link_1', esc_url('#') );
$aza_button_link_2 = get_theme_mod ('aza_button_link_2', esc_url('#') );

?>


<section id="cover">
    <div class="header-image">
        <div class="container">
            <?php
            $allowed = array(
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                );
            if( ! empty ( $aza_main_header ) || ! empty( $aza_secondary_header ) ) { ?>
                <div class="row heading-row">
                    <div class="col-md-12 text-center cover-text">
                        <?php

                        if( ! empty( $aza_main_header ) ){
                            echo "<h1>". wp_kses( $aza_main_header, $allowed )."</h1>";
                        }

                        if( ! empty( $aza_secondary_header ) ){
                            echo "<h2>". wp_kses( $aza_secondary_header, $allowed ) ."</h2>";
                        }

                        ?>
                    </div>
                </div>
            <?php } elseif( is_customize_preview()  ) { ?>
            <div class="row heading-row">
                <div class="col-md-12 text-center cover-text">
                    <h1 class="aza_only_customizer"></h1>
                    <h2 class="aza_only_customizer"></h2>
                </div>
            </div>
            <?php } ?>

            <div class="row btn-row">
                <div class="col-lg-12 text-center">
                    <?php
                    switch ( $aza_buttons_type ) {
                        case 'store_buttons':
                            if( ! empty( $aza_appstore_link ) ) { ?>
                                <a class="btn btn-stores" href="<?php echo esc_url( $aza_appstore_link );?>">
                                    <img src=" <?php echo esc_url( $aza_appstore );?>" alt="#">
                                </a>
                            <?php }

                            if( ! empty( $aza_playstore_link ) ) { ?>
                                <a class="btn btn-stores" href="<?php echo esc_url( $aza_playstore_link );?>">
                                    <img src=" <?php echo esc_url( $aza_playstore );?>" alt="#">
                                </a>
                            <?php }
                            break;

                        case 'normal_buttons':
                            if( ! empty( $aza_button_text_1 ) && ! empty($aza_button_link_1) ) { ?>
                                <a href="<?php echo esc_url( $aza_button_link_1 ); ?>" class="btn btn-normal-header first-header-button">
                                    <?php echo esc_html( $aza_button_text_1 ); ?>
                                </a>
                            <?php } else {
                                if ( is_customize_preview() ) { ?>
                                    <a class="btn btn-normal-header first-header-button aza_only_customizer"></a>
                                <?php }
                            }
                            if( ! empty( $aza_button_text_2 ) && ! empty( $aza_button_link_2 ) ) { ?>
                                <a href="<?php echo esc_url( $aza_button_link_2 ); ?>" class="btn btn-normal-header second-header-button">
                                    <?php echo esc_html( $aza_button_text_2 ); ?>
                                </a>
                            <?php } else {
                                if ( is_customize_preview() ) { ?>
                                    <a class="btn btn-normal-header second-header-button aza_only_customizer"></a>
                                <?php }
                            }
                            break;

                        case 'disabled_buttons':
                            break;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
