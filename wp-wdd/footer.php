            </div>
            <!-- end .row -->
        </div>
    </div>
    <!-- end #body -->

    <footer id="footer" role="contentinfo">
            &copy; <?php echo date('Y'); ?> 
        <span id="my-theme-toggle" title="切换主题">
            <i id="theme-icon">🌙</i>
        </span>
        <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
        <br/>
        Powered by <a href="https://wordpress.org/" target="_blank" rel="noopener noreferrer">WordPress</a> & Theme by wdd.
    </footer>
    <!-- end #footer -->

    <?php wp_footer(); ?>
</body>
</html>
