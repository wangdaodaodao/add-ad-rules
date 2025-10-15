<?php get_header(); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h2 class="post-title" itemprop="name headline">
            <a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <ul class="post-meta">
            <li>
                <time datetime="<?php the_time('c'); ?>" itemprop="datePublished"><?php the_time('Y-m-d H:i:s'); ?></time>
            </li>
            <li>
                <?php the_category(', '); ?>
            </li>
            <li itemprop="interactionCount">
                <a itemprop="discussionUrl" href="<?php comments_link(); ?>"><?php comments_number('暂无评论', '1 条评论', '% 条评论'); ?></a>
            </li>
            <li><?php echo get_post_word_count(); ?></li>
            <li><?php echo get_post_views(get_the_ID()); ?></li>
        </ul>
        <div class="post-content" itemprop="articleBody">
            <?php the_excerpt(); ?>
            <p class="more">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">- 阅读剩余部分 -</a>
            </p>
        </div>
    </article>
    <?php endwhile; endif; ?>

    <?php 
        the_posts_pagination( array(
            'prev_text' => __('&laquo; 上一页', 'textdomain'),
            'next_text' => __('下一页 &raquo;', 'textdomain'),
            'before_page_number' => '<li class="current"><span>', 
            'after_page_number' => '</span></li>'
        ) ); 
    ?>
</div><!-- end #main-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
