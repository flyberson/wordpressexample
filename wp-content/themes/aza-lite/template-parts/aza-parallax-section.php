<!-- =========================
PARALLAX SECTION
============================== -->



    <?php
$parallax_image = get_theme_mod('aza_parallax_image', get_template_directory_uri() . '/images/parallax-image.png');
$parallax_text = get_theme_mod ('aza_parallax_text');
        ?>


<section id="parallax">
        <div class="parallax-container">
            <div class="parallax-background" data-parallax='{"y" : 10}'>
            </div>
            <div class="parallax-layer-1" data-parallax='{"y" : 25}'>
            </div>
            <div class="parallax-layer-2" data-parallax='{"y" : 100}'>
            </div>


            <div class="container parallax-content">
                <div class="row row-parallax">
                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">

                        <img class="img-responsive parallax-img" src="
                            <?php echo esc_url($parallax_image) ?>" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 parallax-features">


                        <?php
     if(!empty($parallax_text)){
            echo '<h3>'. wp_kses_post($parallax_text) . '</h3>'; }?>
                    </div>
                 </div>
            </div>


        </div>
</section>
