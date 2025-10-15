<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <meta name="theme-color" content="#3354AA">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!--[if lt IE 8]>
        <div class="browsehappy" role="dialog">当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>.</div>
    <![endif]-->

    <header id="header" class="clearfix">
        <div class="container">
            <div class="row">
                <div class="site-name col-mb-12 col-9">
                    <h1 id="logo">
                        <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                    </h1>
                    <p class="description">
                        <span id="jinrishici-sentence"><?php bloginfo('description'); ?></span>
                    </p>
                </div>
                <div class="site-search col-3 kit-hidden-tb">
                    <?php get_search_form(); ?>
                </div>
                <div class="col-mb-12">
                    <nav id="nav-menu" class="clearfix navbar" role="navigation">
                        <label for="nav-toggle">
                            <span class="menu-icon">
                                <svg viewBox="0 0 18 15" width="18px" height="15px">
                                    <path fill="white" d="M18,1.484c0,0.82-0.665,1.484-1.484,1.484H1.484C0.665,2.969,0,2.304,0,1.484l0,0C0,0.665,0.665,0,1.484,0 h15.031C17.335,0,18,0.665,18,1.484L18,1.484z"/>
                                    <path fill="white" d="M18,7.516C18,8.335,17.335,9,16.516,9H1.484C0.665,9,0,8.335,0,7.516l0,0c0-0.82,0.665-1.484,1.484-1.484 h15.031C17.335,6.031,18,6.696,18,7.516L18,7.516z"/>
                                    <path fill="white" d="M18,13.516C18,14.335,17.335,15,16.516,15H1.484C0.665,15,0,14.335,0,13.516l0,0 c0-0.82,0.665-1.484,1.484-1.484h15.031C17.335,12.031,18,12.696,18,13.516L18,13.516z"/>
                                </svg>
                            </span>
                        </label>
                        <input type="checkbox" id="nav-toggle" class="nav-toggle"/>
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav-list', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s" style="margin-left: auto;">%3$s</ul>')); ?>
                    </nav>
                </div>
            </div>
            <!-- end .row -->
        </div>
    </header>
    <!-- end #header -->
    <div id="body">
        <div class="container">
            <div class="row">


