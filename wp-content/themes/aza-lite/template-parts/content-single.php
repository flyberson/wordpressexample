<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aza-lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php aza_posted_on(); ?>
		</div>
		<!-- .entry-meta -->
	</header>
	<div class="featured-image">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		} ?>

	</div>
	<!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aza-lite' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php aza_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

