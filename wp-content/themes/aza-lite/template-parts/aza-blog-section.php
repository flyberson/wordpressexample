<?php
/**
 * Blog Section
 */

$heading = get_theme_mod('aza_blog_title');
$subheading = get_theme_mod('aza_blog_subtitle');
$separator_top = get_theme_mod('aza_separator_blog_top', '1');
$separator_bottom = get_theme_mod('aza_separator_blog_bottom', '0');


?>
<section id="blog">
    <?php if( ! empty( $heading ) || ! empty( $subheading ) ) { ?>
        <div class="container title-subtitle-container">
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center">
                    <?php
                    if( ! empty( $heading ) ) {
                        echo '<h2>'. esc_html( $heading ).'</h2>';
                    }

                    if ( $separator_top ) {
                        echo "<hr class='separator'/>";
                    }

                    if( ! empty( $subheading ) ) {
                        echo '<p class="section-subheading">'. esc_html( $subheading ) .'</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php }  ?>

    <div class="container posts-container">
        <div class="row">


            <?php
            $posts_number = get_theme_mod('aza_blog_posts_number', 3);
            $loop = new WP_Query( array( 'posts_per_page' => $posts_number, 'ignore_sticky_posts' => true ) );
            if ( $loop->have_posts() ) {
                while ( $loop->have_posts() ) {
                    $loop->the_post();
                    get_template_part( 'template-parts/blog-posts', get_post_format() );
                }
            } else {
                    get_template_part( 'template-parts/content', 'none' );
            } ?>
        </div>

        <?php if( $separator_bottom ) {
            echo "<hr class='separator'/>";
        } ?>
    </div>
</section>
