<?php
/**
 * Template Name: Movie List
 * 
 * 使用说明:
 * 1. 在WordPress后台创建一个新页面 (例如, 标题为“影单”).
 * 2. 在页面编辑界面的右侧，“页面属性” -> “模板”中，选择本模板“Movie List”。
 * 3. 在该页面的“自定义栏目”中，添加一个新的栏目:
 *    名称 (Name): douban_movie_data
 *    值 (Value): 粘贴你的电影信息的JSON数据。
 * 4. JSON数据格式为一个数组，每个电影是一个对象，包含 title, link, image, rating 四个字段。
 * 
 * JSON 示例:
 * [
 *   {
 *     "title": "机器人之梦",
 *     "link": "https://movie.douban.com/subject/35353320/",
 *     "image": "https://img1.doubanio.com/view/photo/l/public/p2891553338.jpg",
 *     "rating": "9.1"
 *   },
 *   {
 *     "title": "年会不能停！",
 *     "link": "https://movie.douban.com/subject/362年会不能停/",
 *     "image": "https://img1.doubanio.com/view/photo/l/public/p2900952329.jpg",
 *     "rating": "8.2"
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
        $movie_data_json = get_post_meta(get_the_ID(), 'douban_movie_data', true);
        $movies = json_decode($movie_data_json, true);

        if (is_array($movies) && !empty($movies)) :
        ?>
            <div class="movielist">
                <h2>看过<?php echo count($movies); ?>部电影</h2>
                <ul>
                    <?php foreach ($movies as $movie) : ?>
                        <li>
                            <a href="<?php echo esc_url($movie['link']); ?>" title="<?php echo esc_attr($movie['title']); ?>" target="_blank">
                                <img loading="lazy" src="<?php echo esc_url($movie['image']); ?>" alt="<?php echo esc_attr($movie['title']); ?>" width="98" height="138"/>
                                <span><?php echo esc_html($movie['title']); ?></span>
                                <?php if (!empty($movie['rating'])) : ?>
                                    <em class="rating-content" title="评分：<?php echo esc_attr($movie['rating']); ?>分">
                                        评分：<?php echo esc_html($movie['rating']); ?>
                                    </em>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else : ?>
            <p>暂无电影数据，请检查后台页面的“自定义栏目”是否已正确填写。</p>
        <?php endif; ?>

    </article>
</div><!-- end #main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
