<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aza-lite
 */

get_header(); ?>

<div class="blog-content-wrapper">
    <div class="container blog-content">
        <div class="row">
            <div id="primary" class="content-area col-md-9">
                <main id="main" class="site-main" role="main">

                    <?php while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'page' );

						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

                    endwhile; // End of the loop. ?>

                </main><!-- #main -->

            </div><!-- #primary -->

            <div class="col-md-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
