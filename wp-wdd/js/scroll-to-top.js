/**
 * 平滑滚动返回顶部功能
 * 兼容 jQuery 1.1 版本
 * 
 * 使用方法：
 * 1. 在 HTML 中添加一个返回顶部按钮（如：<button id="backToTop">返回顶部</button>）
 * 2. 引入此脚本文件
 * 3. 滚动页面超过200像素时，按钮将自动显示
 */

(function($) {
    // 平滑滚动函数
    function smoothScrollToTop(duration) {
        duration = duration || 500;
        var start = $(window).scrollTop();
        var startTime = null;
        
        function animateScroll(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = timestamp - startTime;
            var percent = Math.min(progress / duration, 1);
            
            // 使用缓动函数使滚动更自然
            var easePercent = percent < 0.5 
                ? 2 * percent * percent 
                : -1 + (4 - 2 * percent) * percent;
            
            $(window).scrollTop(start - (start * easePercent));
            
            if (percent < 1) {
                window.requestAnimationFrame(animateScroll);
            }
        }
        
        window.requestAnimationFrame(animateScroll);
    }
    
    // 点击按钮时触发平滑滚动
    $(document).on('click', '#backToTop', function() {
        smoothScrollToTop();
        return false;
    });
    
    // 滚动时显示/隐藏按钮
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#backToTop').fadeIn();
        } else {
            $('#backToTop').fadeOut();
        }
    });
    
    // 初始隐藏按钮
    $(document).ready(function() {
        $('#backToTop').hide();
    });
})(jQuery);