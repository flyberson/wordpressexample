<div class="archive-content-wrapper">

<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aza-lite
 */

get_header(); ?>
    
        <div class="container">
            <div class="row">
                <?php if( is_active_sidebar( 'sidebar-1' ) ) { ?>
                <div class="col-md-8">
                    <?php } else { ?>
                    <div class="col-md-8 col-md-offset-2">
                        <?php } ?>
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">

                            <?php if ( have_posts() ) : ?>

                                <header class="page-header">
                                    <?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
                                </header>
                                <!-- .page-header -->

                                <?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>

                                        <?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

                                            <?php endwhile; ?>

                                                <?php the_posts_navigation(); ?>

                                                    <?php else : ?>

                                                        <?php get_template_part( 'template-parts/content', 'none' ); ?>

                                                            <?php endif; ?>

                        </main>
                        <!-- #main -->
                    </div>
                </div>
                <!-- #primary -->
                    <?php if( is_active_sidebar( 'sidebar-1' ) ) { ?>
                        <div class="col-md-3 col-md-offset-1">
                            <?php get_sidebar( 'sidebar-1' ); ?>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>