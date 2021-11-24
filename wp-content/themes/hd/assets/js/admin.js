/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
/*jshint esversion: 6 */
var $ = jQuery;
'use strict';

$(function () {
  // plugin
  var rank_math_dashboard_widget = $("#rank_math_dashboard_widget");
  rank_math_dashboard_widget.find('.rank-math-blog-title').remove();
  rank_math_dashboard_widget.find('.rank-math-blog-post').remove();
  var toplevel_page_mlang = $("#toplevel_page_mlang");
  toplevel_page_mlang.find('a[href="admin.php?page=mlang_wizard"]').closest('li').remove();
  var acf_textarea = $(".acf-editor-wrap.html-active").find('textarea.wp-editor-area');
  acf_textarea.removeAttr("style");
  var createuser = $("#createuser");
  createuser.find("#send_user_notification").removeAttr("checked").attr("disabled", true);
  var site_review = $("#menu-posts-site-review");
  site_review.find('a[href="edit.php?post_type=site-review&page=addons"]').closest('li').remove();
  var notice_error = $(".notice.notice-error");
  notice_error.find('a[href*="options-general.php?page=quickkbuy-setting"]').closest('.notice.notice-error').remove();
  var wpbody_content = $("#wpbody-content");
  wpbody_content.find('a[href*="page=addons&post_type=site-review"]').remove();
});
/******/ })()
;
//# sourceMappingURL=admin.js.map