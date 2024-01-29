<?php get_header(); ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
<div class="single-post-loop-item">


<a  href="<?php the_permalink( ); ?>"
    hx-get="<?php the_permalink( ); ?>"
    hx-target=".render-the-content-here-senpai"
    hx-select=".single-post-content"
><?php the_title(); ?></a>


</div>

<?php endwhile; else : ?>
<?php endif; ?>


<div class="render-the-content-here-senpai">
</div>



<?php get_footer(); ?>