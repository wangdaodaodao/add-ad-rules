<div class="col-mb-12 col-offset-1 col-3 kit-hidden-tb" id="secondary" role="complementary">
    <section class="widget">
        <h3 class="widget-title">最新文章</h3>
        <ol class="widget-list">
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 10,
                'post_status' => 'publish'
            ));
            foreach($recent_posts as $post_item) : ?>
                <li>
                    <a href="<?php echo get_permalink($post_item['ID']) ?>"><?php echo $post_item['post_title'] ?></a>
                </li>
            <?php endforeach; ?>
        </ol>
    </section>

    <section class="widget">
        <h3 class="widget-title">阅读排行榜</h3>
        <ol class="widget-list">
            <?php
            $args = array(
                'posts_per_page' => 10,
                'meta_key'       => 'post_views_count',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC',
                'ignore_sticky_posts' => 1
            );
            $top_posts_query = new WP_Query($args);
            if ($top_posts_query->have_posts()) :
                while ($top_posts_query->have_posts()) : $top_posts_query->the_post();
            ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <li>暂无排行数据</li>
            <?php
            endif;
            ?>
        </ol>
    </section>

    <section class="widget">
        <h3 class="widget-title">分类</h3>
        <ul class="widget-list">
            <?php wp_list_categories(array(
                'title_li' => '',
                'orderby' => 'name',
                'show_count' => true
            )); ?>
        </ul>
    </section>

    <section class="widget">
        <h3 class="widget-title">归档</h3>
        <ul class="widget-list">
            <?php wp_get_archives(array(
                'type' => 'monthly',
                'show_post_count' => true
            )); ?>
        </ul>
    </section>

    <section class="widget">
        <h3 class="widget-title">友情链接</h3>
        <ul class="widget-list">
            <li>
                <a href="#" title="这是一个模拟的友情链接" target="_blank" rel="noopener noreferrer">大麦网</a>
            </li>
            <li>
                <a href="#" title="这是另一个模拟的友情链接" target="_blank" rel="noopener noreferrer">高粱网</a>
            </li>
            <li>
                <a href="#" title="这是第三个模拟的友情链接" target="_blank" rel="noopener noreferrer">小麦网</a>
            </li>
        </ul>
    </section>
<!--
    <section class="widget">
        <h3 class="widget-title">其它</h3>
        <ul class="widget-list">
            <?php if (is_user_logged_in()) : ?>
            <li class="last"><a href="<?php echo wp_logout_url(home_url()); ?>">登出</a></li>
            <?php else : ?>
            <li class="last"><a href="<?php echo wp_login_url(home_url()); ?>">登录</a></li>
            <?php endif; ?>
            <li><a href="<?php bloginfo('rss2_url'); ?>">文章 RSS</a></li>
            <li><a href="<?php bloginfo('comments_rss2_url'); ?>">评论 RSS</a></li>
        </ul>
    </section>-->
</div><!-- end #sidebar -->