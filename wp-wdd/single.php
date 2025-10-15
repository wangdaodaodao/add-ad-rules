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
            <?php the_content(); ?>
            <?php set_post_views(get_the_ID()); ?>
        </div>
    </article>

    <div class="post-footer" style="margin-top: 40px; border-top: none !important;">
        <!-- Tags Module -->
        <div class="post-tags" style="margin-bottom: 20px;">
            <?php
            $post_tags = get_the_tags();
            if ( ! empty( $post_tags ) ) {
                echo '<p class="tags">标签: ';
                $tag_links = array();
                foreach ( $post_tags as $tag ) {
                    $tag_links[] = '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a>';
                }
                echo implode(', ', $tag_links);
                echo '</p>';
            }
            ?>
        </div>

        <!-- Donation Module -->
        <div class="post-donation" style="margin-bottom: 40px; text-align: center;">
            <a href="#" style="text-decoration: none;"><button style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">赞赏</button></a>
        </div>

        <!-- Prev/Next Navigation -->
        <ul class="post-near" style="list-style: none; padding: 0; margin-bottom: 40px;">
            <?php
            $prev_post = get_previous_post();
            if ( ! empty( $prev_post ) ) : ?>
                <li style="margin-bottom: 10px;">上一篇: <a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr( $prev_post->post_title ); ?>" style="color: #333;"><?php echo esc_html( $prev_post->post_title ); ?></a></li>
            <?php else: ?>
                <li style="margin-bottom: 10px;">上一篇: <span style="color: #888;">没有了</span></li>
            <?php endif; ?>

            <?php
            $next_post = get_next_post();
            if ( ! empty( $next_post ) ) : ?>
                <li>下一篇: <a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr( $next_post->post_title ); ?>" style="color: #333;"><?php echo esc_html( $next_post->post_title ); ?></a></li>
            <?php else: ?>
                <li>下一篇: <span style="color: #888;">没有了</span></li>
            <?php endif; ?>
        </ul>
    </div>

    <?php comments_template(); ?>

    <?php endwhile; endif; ?>
</div><!-- end #main-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>