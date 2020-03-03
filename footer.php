<?php 
//$footer_options = get_option( 'olp_theme_footer_options' );
$mob_options = get_option( 'olp_theme_mob_options' );
$cta_options = get_option( 'olp_theme_cta_options' );
$layout_options = get_option( 'olp_theme_layout_options' );
?>
<?php
if($cta_options['olpcta_header4']==1)
{
if ( is_front_page() ) {
?>

<div class="container cta_abovefooter">
  <div class=""> <?php echo $footer_options['olpcta_header4']; ?>
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
      <p class="mdem18 smem16 whitetext xsem14 w600"> <?php echo $cta_options['ctatext4']; ?>
        <?php
if($cta_options['ctaaction4']=="Button")
{
	echo "&nbsp;&nbsp;<span class='headercta1'><a class='mdem9 smem9 xsem9 hctabutton' href=".$cta_options['buttonlink4'].">".$cta_options['buttontext4']."</a></span>";
}
else
{
	echo "<span class='whitetext'>&nbsp;&nbsp;".$cta_options['ctacont4']."</span>";
}
?>
      </p>
    </div>
  </div>
</div>
<?php
}
}
?>
</div>

<!--End of Content Area-->

<footer class="footer <?php if($mob_options['hidefooterwidgets']==1){echo 'hidden-xs';} ?>" role="contentinfo">
  <div class="container">
    <div class="row"><?php
	//If Widgets set to 2
	if($layout_options['widgets']==2) { ?>
      <div class="col-md-6 padding0 col-sm-6 col-xs-12" id="footer-sidebar1">
        <?php
if(is_active_sidebar('footer-sidebar-1')){
dynamic_sidebar('footer-sidebar-1');
}
?>
      </div>
      <div class="col-md-6 padding0 col-sm-6 col-xs-12" id="footer-sidebar2">
        <?php
if(is_active_sidebar('footer-sidebar-2')){
dynamic_sidebar('footer-sidebar-2');
}
?>
      </div>
      <?php
}


//If widgets set to 4
elseif($layout_options['widgets']==4)
{
?>
      <div class="col-md-3 padding0 col-sm-6 col-xs-12" id="footer-sidebar1">
        <?php
if(is_active_sidebar('footer-sidebar-1')){
dynamic_sidebar('footer-sidebar-1');
}
?>
      </div>
      <div class="col-md-3 padding0 col-sm-6 col-xs-12" id="footer-sidebar2">
        <?php
if(is_active_sidebar('footer-sidebar-2')){
dynamic_sidebar('footer-sidebar-2');
}
?>
      </div>
      <div class="col-md-3 padding0 col-sm-6 col-xs-12 smclear" id="footer-sidebar3">
        <?php
if(is_active_sidebar('footer-sidebar-3')){
dynamic_sidebar('footer-sidebar-3');
}
?>
      </div>
      <div class="col-md-3 padding0 col-sm-6 col-xs-12" id="footer-sidebar4">
        <?php
if(is_active_sidebar('footer-sidebar-4')){
dynamic_sidebar('footer-sidebar-4');
}
?>
      </div>
      <?php
}



//If widgets set to 3 or not set
else
{
?>
      <div class="col-md-4 padding0 col-sm-4 col-xs-12" id="footer-sidebar1">
        <?php
if(is_active_sidebar('footer-sidebar-1')){
dynamic_sidebar('footer-sidebar-1');
}
?>
      </div>
      <div class="col-md-4 padding0 col-sm-4 col-xs-12" id="footer-sidebar2">
        <?php
if(is_active_sidebar('footer-sidebar-2')){
dynamic_sidebar('footer-sidebar-2');
}
?>
      </div>
      <div class="col-md-4 padding0 col-sm-4 col-xs-12" id="footer-sidebar3">
        <?php
if(is_active_sidebar('footer-sidebar-3')){
dynamic_sidebar('footer-sidebar-3');
}
?>
      </div>
      <?php
}
?>
    </div>
  </div>
</footer>
<!-- #colophon -->

<div class="footer-copyright hidden-xs">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <p><?php echo $layout_options['footcopy']; ?></p>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 text-right">
        <p> <i><a href="<?php echo get_option('Plumbers-Pro_affiliateLink') ?>" target="_blank">ActiveDrain Theme</a>
          Powered by <a href="https://www.websuitepro.co" target="_blank">WebSuitePro</a>
          <?php if(get_option('_DesignedByName_Plumbers-Pro')!='') { ?>
          Designed by&nbsp;<a href="<?php echo get_option('_DesignedByUrl_Plumbers-Pro'); ?>" target="_blank"><?php echo get_option('_DesignedByName_Plumbers-Pro'); ?> </a>
          <?php } ?>
          </i></p>
      </div>
    </div>
  </div>
</div>
<div class="mobile-footer visible-xs">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <p><?php echo $mob_options['mobfooter']; ?></p>
      </div>
    </div>
  </div>
</div>
<?php wp_footer();

// Analytics Settings
$ana_options = get_option('olp_theme_analytics_options');
//Google Analytics Script
$gtrack = $ana_options['gtrack'];
if($gtrack[0] == '<' && $gtrack[strlen($gtrack) - 1] == '>') {
	echo $gtrack;
}
//Third Party Analytics Script
$tptrack = $ana_options['tptrack'];
if($tptrack[0] == '<' && $tptrack[strlen($tptrack) - 1] == '>') {
	echo $tptrack;
}
//Facebook Pixel Script
$fbpixel = $ana_options['fbpixel'];
if($fbpixel[0] == '<' && $fbpixel[strlen($fbpixel) - 1] == '>') {
	echo $fbpixel;
}
?>
</body></html>