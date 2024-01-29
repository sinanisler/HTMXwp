<?php get_header(); ?>



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<div class="single-post-content">
<?php the_content(); ?>
</div>



<?php endwhile; else : ?>
<?php endif; ?>





<?php get_footer(); ?>