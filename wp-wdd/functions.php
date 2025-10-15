<?php
if (!defined('ABSPATH')) exit;

/**
 * 主题设置
 */
function silence_wp_setup() {
    // 启用特色图片
    add_theme_support('post-thumbnails');
    // 让 WordPress 管理页面标题
    add_theme_support('title-tag');
    // 注册导航菜单
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'silence-wp'),
    ));
}
add_action('after_setup_theme', 'silence_wp_setup');

/**
 * 加载 CSS 和 JS 资源
 */
function silence_wp_scripts() {
    // 使用本地的 jQuery 版本
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), null, false);

    // 加载所有本地 CSS 文件
    wp_enqueue_style('aplayer', get_template_directory_uri() . '/css/APlayer.min.css');
    wp_enqueue_style('grid', get_template_directory_uri() . '/css/grid.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array('grid'));

    // 加载所有本地 JS 文件 (true 表示放在页脚)
    wp_enqueue_script('jinrishici', get_template_directory_uri() . '/js/jinrishici.js', array(), null, true);
    wp_enqueue_script('aplayer-js', get_template_directory_uri() . '/js/APlayer.min.js', array('jquery'), null, true);
    wp_enqueue_script('meting-js', get_template_directory_uri() . '/js/Meting.min.js', array('aplayer-js'), null, true);
    wp_enqueue_script('ribbons', get_template_directory_uri() . '/js/ribbons.js', array(), null, true);
    wp_enqueue_script('cursor', get_template_directory_uri() . '/js/cursor.js', array(), null, true);
    wp_enqueue_script('theme-toggle', get_template_directory_uri() . '/js/theme-toggle.js', array(), null, true);
    wp_enqueue_script('scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'silence_wp_scripts');

/**
 * 自定义摘要长度
 */
function custom_excerpt_length( $length ) {
    return 220;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * 计算文章字数
 */
function get_post_word_count() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = mb_strlen(strip_tags($content), 'UTF-8');
    return $word_count . '字';
}

/**
 * 获取文章阅读次数
 */
function get_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return "0次阅读";
    }
    return $count . '次阅读';
}

/**
 * 设置/更新文章阅读次数
 */
function set_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

// Custom Comment Walker to match the desired HTML structure
class Silence_WP_Walker_Comment extends Walker_Comment {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '<div class="comment-children"><ol class="comment-list">';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '</ol></div>';
    }

    public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;

        $tag = 'li';
        $add_below = 'comment';

        $classes = array();
        $classes[] = 'comment-body';
        if ( !empty($args['has_children']) ) {
            $classes[] = 'comment-parent';
        }
        if ( $comment->comment_parent > 0 ) {
            $classes[] = 'comment-child';
        }
        if ( get_comment_ID() % 2 ) {
             $classes[] = 'comment-odd';
        } else {
             $classes[] = 'comment-even';
        }

        $output .= '<' . $tag . ' id="li-comment-' . get_comment_ID() . '" class="' . implode(' ', $classes) . '">';
        $output .= '<div id="comment-' . get_comment_ID() . '" class="comment-item">';

        // Author
        $output .= '<div class="comment-author">';
        if ( $args['avatar_size'] != 0 ) {
            $output .= get_avatar( $comment, $args['avatar_size'] );
        }
        $output .= '<span class="fn">' . get_comment_author_link();
        if ( $comment->user_id === $comment->post_author_id ) {
            $output .= ' <span class="author-after-text">[作者]</span>';
        }
        $output .= '</span></div>';

        // Meta
        $output .= '<div class="comment-meta">';
        $output .= '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_comment_date() . ' ' . get_comment_time() . '</a>';
        $output .= '</div>';

        // Reply Link
        $reply_link = get_comment_reply_link( array_merge( $args, array(
            'add_below' => $add_below,
            'depth'     => $depth,
            'max_depth' => $args['max_depth']
        ) ) );
        $output .= '<span class="comment-reply">' . $reply_link . '</span>';

        // Content
        $output .= '<div class="comment-content">';
        if ( '0' == $comment->comment_approved ) {
            $output .= '<p><em>您的评论正在等待审核。</em></p>';
        }
        $output .= get_comment_text();
        $output .= '</div>';
    }

    public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
        $output .= "</div></li>\n";
    }
}

function silence_wp_custom_styles() {
    $custom_css = "
        .widget-title, .comments-title { font-size: 18px !important; }
        .comments-title, .comment-list, #comment-form { margin-bottom: 30px !important; }
        article.post { border-bottom: none !important; }
        ol.widget-list { list-style: decimal !important; margin-left: 1.5em !important; } /* Added rule for ordered lists */

        /* Booklist Page Styles */
        .movielist ul { list-style: none; padding: 0; margin: 0 -10px; display: flex; flex-wrap: wrap; }
        .movielist li { width: 110px; margin: 0 10px 20px; text-align: center; font-size: 14px; }
        .movielist li a { text-decoration: none; color: #333; }
        .movielist li img { width: 98px; height: 138px; object-fit: cover; margin-bottom: 10px; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .movielist li span { display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    ";
    wp_add_inline_style( 'style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'silence_wp_custom_styles' );