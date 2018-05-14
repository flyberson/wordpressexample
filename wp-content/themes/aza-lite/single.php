<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aza-lite
 */

get_header();
?>

<div class="blog-content-wrapper">
    <div class="container blog-content">
        <div class="row">
            <?php if( is_active_sidebar( 'sidebar-1' ) ) { ?>
            <div class="col-md-8">
                <?php } else { ?>
                <div class="col-md-8 col-md-offset-2">
                    <?php } ?>
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'template-parts/content', 'single' ); ?>
                                <?php the_post_navigation(); ?>
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                                ?>

                            <?php endwhile; // End of the loop. ?>

                        </main>
                        <!-- #main -->
                    </div>
                    <!-- #primary -->
                </div>
                <?php if( is_active_sidebar( 'sidebar-1' ) ) { ?>
                    <div class="col-md-3 col-md-offset-1">
                        <?php get_sidebar( 'sidebar-1' ); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>
