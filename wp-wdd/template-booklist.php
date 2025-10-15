<?php
/**
 * Template Name: Book List
 * 
 * 使用说明:
 * 1. 在WordPress后台创建一个新页面 (例如, 标题为“书单”).
 * 2. 在页面编辑界面的右侧，“页面属性” -> “模板”中，选择本模板“Book List”。
 * 3. 在该页面的“自定义栏目”中，添加一个新的栏目:
 *    名称 (Name): douban_book_data
 *    值 (Value): 粘贴你的书籍信息的JSON数据。
 * 4. JSON数据格式为一个数组，每个书籍是一个对象，包含 title, link, image 三个字段。
 * 
 * JSON 示例:
 * [
 *   {
 *     "title": "了凡四训",
 *     "link": "https://book.douban.com/subject/27102950/",
 *     "image": "https://img9.doubanio.com/view/subject/l/public/s29539556.jpg"
 *   },
 *   {
 *     "title": "长安的荔枝",
 *     "link": "https://book.douban.com/subject/36104107/",
 *     "image": "https://img3.doubanio.com/view/subject/l/public/s34327482.jpg"
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
        $book_data_json = get_post_meta(get_the_ID(), 'douban_book_data', true);
        $books = json_decode($book_data_json, true);

        if (is_array($books) && !empty($books)) :
        ?>
            <div class="movielist">
                <h2>读过<?php echo count($books); ?>本书</h2>
                <ul>
                    <?php foreach ($books as $book) : ?>
                        <li>
                            <a href="<?php echo esc_url($book['link']); ?>" title="<?php echo esc_attr($book['title']); ?>" target="_blank">
                                <img loading="lazy" src="<?php echo esc_url($book['image']); ?>" alt="<?php echo esc_attr($book['title']); ?>" width="98" height="138"/>
                                <span><?php echo esc_html($book['title']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else : ?>
            <p>暂无书籍数据，请检查后台页面的“自定义栏目”是否已正确填写。</p>
        <?php endif; ?>

    </article>
</div><!-- end #main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
