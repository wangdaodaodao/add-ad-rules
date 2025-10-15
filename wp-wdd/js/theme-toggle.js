/**
 * Typecho 主题切换核心功能
 * 只提供主题切换方法，不创建UI元素
 */

(function () {
  'use strict';

  // 主题管理器
  const ThemeManager = {
    // 存储键名
    STORAGE_KEY: 'typecho-theme-preference',

    // 初始化
    init() {
      this.loadPreference();
    },

    // 加载用户偏好
    loadPreference() {
      const saved = localStorage.getItem(this.STORAGE_KEY);
      if (saved) {
        this.setTheme(saved, false);
      }
    },

    // 设置主题
    setTheme(theme, save = true) {
      const root = document.documentElement;

      if (theme === 'auto') {
        // 自动模式：移除 data-theme，让 CSS 媒体查询生效
        root.removeAttribute('data-theme');
      } else {
        // 手动模式：设置 data-theme
        root.setAttribute('data-theme', theme);
      }

      // 保存偏好
      if (save) {
        localStorage.setItem(this.STORAGE_KEY, theme);
      }

      // 触发自定义事件
      window.dispatchEvent(
        new CustomEvent('themechange', {
          detail: { theme },
        })
      );
    },

    // 获取当前主题
    getCurrentTheme() {
      const saved = localStorage.getItem(this.STORAGE_KEY);
      const root = document.documentElement;

      // 如果有手动设置的主题，返回它
      if (saved) {
        return saved;
      }

      // 如果没有手动设置，检查 data-theme 属性
      const dataTheme = root.getAttribute('data-theme');
      if (dataTheme) {
        return dataTheme;
      }

      // 否则返回自动
      return 'auto';
    },

    // 切换主题（核心方法）
    toggleTheme() {
      const current = this.getCurrentTheme();
      let next;

      switch (current) {
        case 'light':
          next = 'dark';
          break;
        case 'dark':
          next = 'light';
          break;
        default: // auto
          next = 'light';
          break;
      }

      this.setTheme(next);
      return next; // 返回新主题，方便调用方知道切换结果
    },
  };

  // 初始化主题管理器
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      ThemeManager.init();
    });
  } else {
    ThemeManager.init();
  }

  // 暴露全局接口
  window.ThemeManager = ThemeManager;
})();

// 获取按钮元素
const toggleBtn = document.getElementById('my-theme-toggle');
const icon = document.getElementById('theme-icon');
// 初始化图标
function updateIcon() {
  const theme = ThemeManager.getCurrentTheme();
  switch (theme) {
    case 'light':
      icon.textContent = '🌙';
      toggleBtn.title = '当前：浅色主题（点击切换）';
      break;
    case 'dark':
      icon.textContent = '☀️';
      toggleBtn.title = '当前：深色主题（点击切换）';
      break;
  }
}
// 绑定点击事件
toggleBtn.addEventListener('click', () => {
  ThemeManager.toggleTheme();
  updateIcon();
});
// 监听主题变化
window.addEventListener('themechange', updateIcon);
// 初始化图标
updateIcon();
