<?php
/*
Template Name: About
*/
get_header(); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article class="post">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div><!-- end #main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
