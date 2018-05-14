<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aza-lite
 */
if( is_active_sidebar( 'sidebar-1' ) ) {
    $class_to_add = "col-md-8";
} else {
    $class_to_add = "col-md-8 col-md-offset-2";
}

get_header(); ?>

<div class="blog-content-wrapper">
    <div class="container blog-content">
        <div class="row">
            <div id="primary" class="content-area <?php echo esc_attr( $class_to_add ); ?>">
                <main id="main" class="site-main" role="main">
                    <?php if ( have_posts() ) :

                        if ( is_home() && ! is_front_page() ) : ?>

                            <header>
                                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                            </header>

                        <?php endif;

                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content', get_post_format() );

                        endwhile;

                        the_posts_navigation();

                    else :

                        get_template_part( 'template-parts/content', 'none' );

                    endif; ?>

                </main><!-- #main -->
            </div><!-- #primary -->

            <?php if( is_active_sidebar( 'sidebar-1' ) ) { ?>
                <div class="col-md-3 col-md-offset-1">
                    <?php get_sidebar( 'sidebar-1' ); ?>
                </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
