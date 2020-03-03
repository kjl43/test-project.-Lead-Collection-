var $n = jQuery.noConflict();
$n(document).ready(function() {

   $n('#olp_logo_upload').click(function() {
    formfield = $n('#olp_theme_logo').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

   window.send_to_editor = function(html) {
	headImgUrl = $n('img',html).attr('src');
	$n('#olp_theme_logo').val(headImgUrl);
 	tb_remove();
   }

    return false;
   });
 
});

var $m = jQuery.noConflict();
$m(document).ready(function() {

   $m('#olp_favicon_upload').click(function() {
    formfield = $m('#olp_theme_favicon').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

   window.send_to_editor = function(html) {
	headImgUrl2 = $m('img',html).attr('src');
	$m('#olp_theme_favicon').val(headImgUrl2);
 	tb_remove();
   }

    return false;
   });
 
});





var $o = jQuery.noConflict();
$o(document).ready(function() {

   $o('#olp_bgimg_upload').click(function() {
    formfield = $o('#olp_theme_bgimg').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

   window.send_to_editor = function(html) {
	headImgUrl3 = $o('img',html).attr('src');
	$o('#olp_theme_bgimg').val(headImgUrl3);
 	tb_remove();
   }

    return false;
   });
 
});


var $p = jQuery.noConflict();
$p(document).ready(function() {

   $p('#traders_sl1_upload').click(function() {
    formfield = $o('#traders_theme_sl1').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

   window.send_to_editor = function(html) {
	headImgUrl4 = $o('img',html).attr('src');
	$o('#traders_theme_sl1').val(headImgUrl4);
 	tb_remove();
   }

    return false;
   });
 
});



var $q = jQuery.noConflict();
$q(document).ready(function() {

   $q('#traders_sl2_upload').click(function() {
    formfield = $o('#traders_theme_sl2').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

   window.send_to_editor = function(html) {
	headImgUrl5 = $o('img',html).attr('src');
	$o('#traders_theme_sl2').val(headImgUrl5);
 	tb_remove();
   }

    return false;
   });
 
});



var $r = jQuery.noConflict();
$q(document).ready(function() {
   $q('#traders_sl3_upload').click(function() {
    formfield = $o('#traders_theme_sl3').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
   window.send_to_editor = function(html) {
	headImgUrl6 = $o('img',html).attr('src');
	$o('#traders_theme_sl3').val(headImgUrl6);
 	tb_remove();
   }
    return false;
   });
});



var $r = jQuery.noConflict();
$q(document).ready(function() {
   $q('#traders_sl4_upload').click(function() {
    formfield = $o('#traders_theme_sl4').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
   window.send_to_editor = function(html) {
	headImgUrl7 = $o('img',html).attr('src');
	$o('#traders_theme_sl4').val(headImgUrl7);
 	tb_remove();
   }
    return false;
   });
});



var $r = jQuery.noConflict();
$q(document).ready(function() {
   $q('#traders_sl5_upload').click(function() {
    formfield = $o('#traders_theme_sl5').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

   window.send_to_editor = function(html) {
	headImgUrl8 = $o('img',html).attr('src');
	$o('#traders_theme_sl5').val(headImgUrl8);
 	tb_remove();
   }
    return false;
   });
});



var $r = jQuery.noConflict();
$q(document).ready(function() {
   $q('#olp_headbgimg_upload').click(function() {
    formfield = $o('#olp_theme_headbgimg').attr('name');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
   window.send_to_editor = function(html) {
	headImgUrl9 = $o('img',html).attr('src');
	$o('#olp_theme_headbgimg').val(headImgUrl9);
 	tb_remove();
   }
    return false;
   });
});