<?php
/**
 * Template Name: Music List
 * 
 * 使用说明:
 * 1. 在WordPress后台创建一个新页面 (例如, 标题为“音乐”).
 * 2. 在页面编辑界面的右侧，“页面属性” -> “模板”中，选择本模板“Music List”。
 * 3. 在该页面的“自定义栏目”中，添加一个新的栏目:
 *    名称 (Name): douban_music_data
 *    值 (Value): 粘贴你的音乐信息的JSON数据。
 * 4. JSON数据格式为一个数组，每个音乐是一个对象，包含 title, link, image, artist 四个字段。
 * 
 * JSON 示例:
 * [
 *   {
 *     "title": "folklore",
 *     "link": "https://music.douban.com/subject/35133789/",
 *     "image": "https://img9.doubanio.com/view/subject/l/public/s33683485.jpg",
 *     "artist": "Taylor Swift"
 *   },
 *   {
 *     "title": "JAY",
 *     "link": "https://music.douban.com/subject/1401143/",
 *     "image": "https://img9.doubanio.com/view/subject/l/public/s1441935.jpg",
 *     "artist": "周杰伦"
 *   }
 * ]
 */

get_header(); 
?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1 class="post-title" itemprop="name headline"><?php the_title(); ?></h1>
            <div class="post-content" itemprop="articleBody">
                <?php the_content(); // 显示在后台编辑器中输入的任何介绍性文字 ?>
            </div>
        <?php endwhile; ?>

        <?php
        $music_data_json = get_post_meta(get_the_ID(), 'douban_music_data', true);
        $musics = json_decode($music_data_json, true);

        if (is_array($musics) && !empty($musics)) :
        ?>
            <div class="movielist">
                <h2>听过<?php echo count($musics); ?>张专辑</h2>
                <ul>
                    <?php foreach ($musics as $music) : ?>
                        <li>
                            <a href="<?php echo esc_url($music['link']); ?>" title="<?php echo esc_attr($music['title']); ?> - <?php echo esc_attr($music['artist']); ?>" target="_blank">
                                <img loading="lazy" src="<?php echo esc_url($music['image']); ?>" alt="<?php echo esc_attr($music['title']); ?>" width="98" height="98" style="height: 98px;"/>
                                <span><?php echo esc_html($music['title']); ?></span>
                                <?php if (!empty($music['artist'])) : ?>
                                    <em class="rating-content" style="color: #888; font-size: 12px;">
                                        <?php echo esc_html($music['artist']); ?>
                                    </em>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else : ?>
            <p>暂无音乐数据，请检查后台页面的“自定义栏目”是否已正确填写。</p>
        <?php endif; ?>

    </article>
</div><!-- end #main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
