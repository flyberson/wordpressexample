<?php
/**
 * Template Name: Homepage Template
 *
 * The template for the homepage of the theme.
 *
 **/

get_header(); ?>

	</div>

	</header>

	<div id="content" class="content-warp" role="main">

		<?php

		get_template_part('/template-parts/aza-header-section');

		get_template_part('/template-parts/aza-blog-section');

		get_template_part('/template-parts/aza-parallax-section');

		get_template_part('/template-parts/aza-ribbon-section');

		get_template_part('/template-parts/aza-social-section');

		get_template_part('/template-parts/aza-contact-section');

		get_template_part('/template-parts/aza-map-section');

		?>

	</div><!-- .content-wrap -->

<?php	get_footer();