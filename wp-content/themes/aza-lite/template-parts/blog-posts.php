<?php
/**
 * Frontpage single post content
 */
?>

<div class="col-xs-12 col-lg-4 col-md-4">

    <a href="<?php the_permalink() ?>">



        <?php if( has_post_thumbnail() ) {
            the_post_thumbnail('aza-post-small');
        }
        ?>

        <h4><?php the_title() ?></h4>
    </a>
    <p><?php the_excerpt();?></p>

</div>
