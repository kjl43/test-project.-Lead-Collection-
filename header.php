<html xmlns="https://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<meta charset='utf-8'>
<head>
<?php

if (!get_option('ActiveDrain_active') >0 || !get_option('ActiveDrain_licensekey') >0) { 
	echo "<h3>Please Activate Your theme.</h3>";
	exit;
}


/*------------------------------------*/
/*----------real time check-----------*/
/*------------------------------------*/

if ( is_user_logged_in() ) {
	$LicKey = get_option('ActiveDrain_licensekey');
	$filename = 'https://my.websuitepro.co/assets/uploads/xmlfiles/'.$LicKey.'.xml';
	#$file_headers = @get_headers($filename, 1);
	#$file_headers;
	if (file_exists_remote($filename)==0) {
		update_option( 'ActiveDrain_active', '0' );
		update_option( 'ActiveDrain_licensekey', '0' );	
	} else {
	  $xml = new SimpleXMLElement(get_lic_file($filename));
	  if($xml->domain1 == '') {
			update_option( 'ActiveDrain_active', '0' );
			update_option( 'ActiveDrain_licensekey', '0' );	
		} 
	}
}


/*------------------------------------*/
/*----------real time check-----------*/
/*------------------------------------*/
//Get Options
$options = get_option( 'olp_theme_options' );
$social_options = get_option( 'olp_theme_social_options' );
$header_options = get_option( 'olp_theme_header_options' );
$cta_options = get_option( 'olp_theme_cta_options' );
$typo_options = get_option( 'olp_theme_typo_options' );
$slider_options = get_option( 'olp_theme_slider_options' );
$slide_options = get_option( 'traders_theme_slide_options' );
$gmap_options = get_option( 'olp_theme_gmap_options' );
$nav_options = get_option('olp_theme_nav_options');
$lead_options = get_option('olp_theme_lead_options');
$mob_options = get_option('olp_theme_mob_options');



$GLOBALS['leadtype']=$lead_options['responder'];
$GLOBALS['firstscreen']=$mob_options['firstscreen'];


//for SEO option setting
$seo_options = get_option( 'olp_theme_seo_options' );
$ID = $wp_query->post->ID;
$endessame = get_post_meta( $ID, '_sc_m_ende', true );


// SEO option settings START
if($endessame==1) { ?>
    <title><?php echo get_post_meta( $ID, '_sc_m_title', true ); ?></title>
    <meta name="description" content="<?php echo get_post_meta( $ID, '_sc_m_description', true ); ?>">
    <meta name="keywords" content="<?php echo get_post_meta( $ID, '_sc_m_keywords', true ); ?>">
    <?php if(!is_front_page()) { ?>
        <META NAME="ROBOTS" CONTENT="<?php if(get_post_meta( $ID, '_sc_m_index', true )==1) { echo "NOINDEX"; } ?> ">
        <META NAME="ROBOTS" CONTENT="<?php if(get_post_meta( $ID, '_sc_m_follow', true )==1) { echo "NOFOLLOW"; } ?> ">
    <?php } 
} else { 
	if($seo_options['olpseo']==1) { 
		if(is_front_page()) { ?>
			<title><?php if($seo_options['hometitle']=='%page_title%' || $seo_options['hometitle']=='') { echo get_the_title(); } else { echo $seo_options['hometitle']; } ?></title>
			<meta name="description" content="<?php if($seo_options['homedesc']=='%description%' || $seo_options['homedesc']=='' ) { echo bloginfo('description'); } else { echo $seo_options['homedesc']; } ?>">
			<meta name="keywords" content="<?php if($seo_options['homekey'] =='' || $seo_options['homekey'] =='%tag%') { } else { echo $seo_options['homekey']; } ?>">
		<?php } else if(is_tag()) { 
			if($seo_options['tagtitle'] !='%tag% | %blog_title%' && $seo_options['tagtitle'] !='') {
				if (strpos($seo_options['tagtitle'],'|') == true) {
					$arr1 = explode('|',$seo_options['tagtitle']);
					$chk1=$arr1[0];
					$chk2=$arr1[1];
					if($chk1=='%tag%') { $chk1=single_tag_title("", false);} else {$chk1=$arr1[0];}
					if($chk2==' %blog_title%') {$chk2=get_the_title();}	else {$chk2=$arr1[1];}
					$show=$chk1.' | '.$chk2;
				} else {
					$show= $seo_options['tagtitle'];
				}	
			} else { $show=single_tag_title("", false).' | '.get_the_title(); } ?>
			<title><?php echo $show;?></title>
			<meta name="description" content="<?php if($seo_options['tagdesc']=='' || $seo_options['tagdesc']=='%description%') { echo bloginfo('description'); } else { echo $seo_options['tagdesc']; } ?>">
			<meta name="keywords" content="<?php if($seo_options['tagkey'] =='' || $seo_options['tagkey'] =='%tag%') { } else { echo $seo_options['tagkey']; } ?>">
			<META NAME="ROBOTS" CONTENT="<?php if($seo_options['tagindex']==1) { echo "NOINDEX"; } ?> ">
			<META NAME="ROBOTS" CONTENT="<?php if($seo_options['tagfollow']) { echo "NOFOLLOW"; } ?> ">
		<?php } else if(is_category()) { 
			if($seo_options['cattitle'] !='%page_title% | %blog_title%' && $seo_options['cattitle'] !='') {
				if (strpos($seo_options['cattitle'],'|') == true) {
					$arr1 = explode('|',$seo_options['cattitle']);
					$chk1=$arr1[0];
					$chk2=$arr1[1];
					if($chk1=='%page_title%') { $chk1=single_cat_title( '', false ); } else { $chk1=$arr1[0]; }
					if($chk2==' %blog_title%') { $chk2=get_the_title(); } else { $chk2=$arr1[1]; }
					$show1=$chk1.' | '.$chk2;
				} else {
					$show1= $seo_options['cattitle'];
				}	
			} else {
				$show1=single_cat_title("", false).' | '.get_the_title();
			} ?>
			<title><?php echo $show1;?></title>
			<meta name="description" content="<?php if($seo_options['catdesc']=='' || $seo_options['catdesc']=='%description%') { echo bloginfo('description'); } else { echo $seo_options['catdesc']; } ?>">
			<meta name="keywords" content="<?php if($seo_options['catkey'] =='' || $seo_options['catkey'] =='%tag%') { } else { echo $seo_options['catkey']; } ?>">
			<META NAME="ROBOTS" CONTENT="<?php if($seo_options['catindex']==1) { echo "NOINDEX"; } ?> ">
			<META NAME="ROBOTS" CONTENT="<?php if($seo_options['catindex']) { echo "NOFOLLOW"; } ?> "><?php 
		} else if(is_404()) { ?>
			<title><?php if($seo_options['nftitle']=='' || $seo_options['nftitle']=='%page_title%') { echo bloginfo('name'); } else { echo $seo_options['nftitle']; } ?></title>
		<?php } else if(is_single()) { 
			if(is_singular( 'portfolio' )) {  ?>
				<title><?php if($seo_options['prtitle']=='' || $seo_options['prtitle']=='%page_title%') { echo get_the_title(); } else { echo $seo_options['prtitle']; } ?></title>
				<meta name="description" content="<?php if($seo_options['prdesc']=='' || $seo_options['prdesc']=='%description%') { echo bloginfo('description'); } else { echo $seo_options['prdesc']; } ?>">
				<meta name="keywords" content="<?php if($seo_options['prkey'] =='' || $seo_options['prkey'] =='%tag%') { } else { echo $seo_options['prkey']; } ?>">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['prindex']==1) { echo "NOINDEX"; } ?> ">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['prindex']) { echo "NOFOLLOW"; } ?> "><?php 
			} else if(is_singular( 'testimonial' ))  {  ?>
				<title><?php if($seo_options['tmtitle']=='' || $seo_options['tmtitle']=='%page_title%') { echo get_the_title(); } else { echo $seo_options['tmtitle']; } ?></title>
				<meta name="description" content="<?php if($seo_options['tmdesc']=='' || $seo_options['tmdesc']=='%description%') { echo bloginfo('description'); } else { echo $seo_options['tmdesc']; } ?>">
				<meta name="keywords" content="<?php if($seo_options['tmkey'] =='' || $seo_options['tmkey'] =='%tag%') { } else { echo $seo_options['tmkey']; } ?>">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['tmindex']==1) { echo "NOINDEX"; } ?> ">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['tmindex']) { echo "NOFOLLOW"; } ?> "><?php 
			} else if(is_singular( 'services' )) { ?>
				<title><?php if($seo_options['srtitle']=='' || $seo_options['srtitle']=='%page_title%') { echo get_the_title(); } else { echo $seo_options['srtitle']; } ?></title>
				<meta name="description" content="<?php if($seo_options['srdesc']=='' || $seo_options['srdesc']=='%description%') { echo bloginfo('description'); } else { echo $seo_options['srdesc']; } ?>">
				<meta name="keywords" content="<?php if($seo_options['srkey'] =='' || $seo_options['srkey'] =='%tag%') { } else { echo $seo_options['srkey']; } ?>">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['srindex']==1) { echo "NOINDEX"; } ?> ">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['srindex']) { echo "NOFOLLOW"; } ?> "><?php 
			} else if(is_singular( 'post' ))  {  ?>
				<title><?php if($seo_options['blogtitle']=='' || $seo_options['blogtitle']=='%page_title%') { echo get_the_title(); } else { echo $seo_options['blogtitle']; } ?></title>
				<meta name="description" content="<?php if($seo_options['blogdesc']=='' || $seo_options['blogdesc']=='%description%') { echo bloginfo('description'); } else { echo $seo_options['blogdesc']; } ?>">
				<meta name="keywords" content="<?php if($seo_options['blogkey'] =='' || $seo_options['blogkey'] =='%tag%') { } else { echo $seo_options['blogkey']; } ?>">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['blogindex']==1) { echo "NOINDEX"; } ?> ">
				<META NAME="ROBOTS" CONTENT="<?php if($seo_options['blogfollow']) { echo "NOFOLLOW"; } ?> "><?php 
			} else { ?>
				<title><?php echo get_the_title(); ?></title>
				<meta name="description" content="<?php bloginfo('description') ?>"><?php 
			} 
		} else { ?>
			<title><?php echo get_the_title(); ?></title>
			<meta name="description" content="<?php bloginfo('description') ?>"><?php 
			} 
	} else { ?>
		<title><?php bloginfo('name'); ?>&raquo;<?php is_front_page() ? bloginfo('description') : wp_title(); ?></title>
		<meta name="description" content="<?php bloginfo('description') ?>"><?php 
	} 
} 
// SEO option settings END

/*--------------------------- 
*Webmaster Varification START
---------------------------*/
//Google 
if(!$seo_options['gowebtools']=='') { echo "<meta name='google-site-verification' content='".$seo_options['gowebtools']."' />"; }
//Bing
if(!$seo_options['biwebtools']=='') {echo "<meta name='msvalidate.01' content='".$seo_options['biwebtools']."' />";}
//Pinteest
if(!$seo_options['piwebtools']=='') {echo "<meta name='p:domain_verify' content='".$seo_options['piwebtools']."' />";}
/* ---------------------------
*Webmaster Varification END
--------------------------- */

$layout_options = get_option( 'olp_theme_layout_options' );
?>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->

<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' );?>/css/bootstrap-theme.css">
<link href='https://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
<script src="<?php bloginfo( 'stylesheet_directory' );?>/js/jquery.min.js"></script>
<script src="<?php bloginfo( 'stylesheet_directory' );?>/js/bootstrap.min.js"></script>

<!--Slider Scripts-->

<link href="<?php bloginfo( 'stylesheet_directory' );?>/slider/immersive-slider.css" rel="stylesheet" />
<script src="<?php bloginfo( 'stylesheet_directory' );?>/js/jquery-latest.min.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'stylesheet_directory' );?>/slider/jquery.immersive-slider.js"></script>
<script>
	var defaults = {
		animation: "<?php if($slider_options['transition']!=""){echo $slider_options['transition'];}else{echo "bounce";} ?>",
		slideSelector: ".slide",
		container: ".main",
		cssBlur: false,
		pagination: true,
		hoverpause: true,
		loop: <?php if($slider_options['slideloop']!=""){echo "true";}else{echo "false";} ?>,
		autoStart: <?php if($slider_options['slidespeed']!=""){echo $slider_options['slidespeed'];}else{echo 4000;} ?>
	};
</script>
<link rel="icon" href="<?php echo $options['favicon']; ?>" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['h1fstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['h2fstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['h3fstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['h4fstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['h5fstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['h6fstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['pfstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['linkstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=<?php echo $typo_options['hlinkstyle']; ?>:400,600,700,800,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_directory' );?>/css/Pe-icon-social.css">
<?php if($options['colorscheme']!="") { ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_directory' );?>/css/scheme/<?php echo $options['colorscheme'];?>.css"><?php 
} else {
	?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_directory' );?>/css/scheme/DodgerBlue.css"><?php
} ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory');?>/style.css" type="text/css">
<title><?php bloginfo('name'); ?>&raquo;<?php is_front_page() ? bloginfo('description') : wp_title(); ?></title>
<!-- Theme Starts -->
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' );?>/js/menu.js"></script>
<style>
	<?php  
	
	if($options['showbg']=="")
	{
		//Background Image
	if($options['colorscheme']=="")
	{
		?>
		body{background:url(<?php bloginfo( 'stylesheet_directory' );?>/images/DodgerBlue/pattern.jpg);}
		<?php
	}
	else
	{
		?>
		body{background:url(<?php bloginfo( 'stylesheet_directory' );?>/images/<?php echo $options['colorscheme']; ?>/pattern.jpg);}
		<?php
	}
	}
	else
	{
		?>
		body{<?php if($options['showbg']==1) { ?> background:url(<?php echo $options['bgimg']; ?>)<?php  if($options['fixedbg']==1) { echo " fixed";	} else { echo " scroll"; } } ?> repeat; <?php if($options['coverbg']==1) { echo "background-size:cover"; } ?>; }
		<?php
	}
	
	
	
	
	//Nav BG
	if($nav_options['navsettings']==1) { ?> 
	#cssmenu > ul > li:hover > a, #cssmenu > ul > li > a:hover {color:#<?php echo $nav_options['navtexthover'];	?>;	}
	#cssmenu > ul > li.active > a {	color:#<?php echo $nav_options['navtextactive'];?>;}
	#cssmenu > ul > li > a {color:#<?php echo $nav_options['navtextnormal'];?>;	}
	.menuarea {	background:#<?php echo $nav_options['navnormal'];?>;}<?php } 
	else
	{
		if($options['colorscheme']=="")
		{
		?>
		.menuarea{background-image:url(<?php bloginfo( 'stylesheet_directory' );?>/images/DodgerBlue/pattern.jpg);}
		<?php	
		}
		else
		{
		?>
		.menuarea{background-image:url(<?php bloginfo( 'stylesheet_directory' );?>/images/<?php echo $options['colorscheme']; ?>/pattern.jpg);}
		<?php
		}
	?>
	
	<?php	
	}
	
	
	
	
	if($slider_options['navcontrol']==1) {?> 
	.is-prev, .is-next {display:none;} <?php } ?> 
	.table>tbody>tr>td { border-top:0; }
	.ctaimage {<?php if($cta_options['ctacustimg']!="") {?> background-image:url(<?php echo $cta_options['ctacustimg'];	?>);<?php }	?>	}
		<?php if($layout_options['widgetsettings']==1) { ?> 
	#secondary .widget, .widget {border:<?php echo $layout_options['bordersize'];?> <?php echo $layout_options['borderstyle'];?> <?php echo "#".$layout_options['bordercolor'];?>;}<?php } ?> 
	
	
	<?php
	
	if($layout_options['laywidth']!="") {	?> 
	@media(min-width:1200px) {
	.container {width : <?php echo $layout_options['laywidth']."px";?>}
	} <?php }
	
	 //Typography ?> .entry-content-page a { font-family:<?php echo $typo_options['linkstyle']; ?>; font-size:<?php echo $typo_options['linksize']; ?>; color:<?php echo $typo_options['linkcolor']; ?>; }
	.entry-content-page a:hover {color:<?php echo $typo_options['hlinkcolor'];?>;font-family:<?php echo $typo_options['hlinkstyle'];?>;	font-size:<?php echo $typo_options['hlinksize'];?>;	}	
	.entry-content-page p { font-family:<?php echo $typo_options['pfstyle']; ?>; font-size:<?php echo $typo_options['psize']; ?>; }
	.entry-content-page h1, .contentbg h1 { font-family:<?php echo $typo_options['h1fstyle']; ?>; font-size:<?php echo $typo_options['h1fsize']; ?>;color:<?php echo $typo_options['h1color']; ?>;}
	.entry-content-page h2, .contentbg h2 { font-family:<?php echo $typo_options['h2fstyle']; ?>; font-size:<?php echo $typo_options['h2fsize']; ?>;color:<?php echo $typo_options['h2color'];?>; }
	.entry-content-page h3, .contentbg h3 { font-family:<?php echo $typo_options['h3fstyle']; ?>; font-size:<?php echo $typo_options['h3fsize']; ?>; color:<?php echo $typo_options['h3color']; ?>;}
	.entry-content-page h4, .contentbg h4 {font-family:<?php echo $typo_options['h4fstyle'];?>;font-size:<?php echo $typo_options['h4fsize'];?>;color:<?php echo $typo_options['h4color'];?>;}
	.entry-content-page h5, .contentbg h5 {	font-family:<?php echo $typo_options['h5fstyle'];?>;font-size:<?php echo $typo_options['h5fsize'];?>;color:<?php echo $typo_options['h5color'];	?>;	}	
	.entry-content-page h6, .contentbg h6 {	font-family:<?php echo $typo_options['h6fstyle'];?>;font-size:<?php echo $typo_options['h6fsize'];?>;color:<?php echo $typo_options['h6color'];?>;}

	/*Header*/
	.header {background:#<?php echo $header_options['headbgcolor'];?> no-repeat url(<?php echo $header_options['headerbg'];?>);background-size: cover; height:<?php echo $header_options['header_height'];?>}
	/* Background */
	.contentarea { background-color:#<?php echo $options['bgcolor']; ?>; }
	.contentarea { background-color:#<?php echo $options['bgcolor'];?>;	<?php if($options['showbg']==1) { ?> background:url(<?php echo $options['bgimg']; ?>)<?php if($options['repeatopt']==1) { echo " repeat"; }	else { echo " no-repeat"; } if($options['fixedbg']==1) { echo " fixed";	} else { echo " scroll"; } } ?>; <?php if($options['coverbg']==1) { echo "background-size:cover"; } ?>; }
	.entry-content-page {color:#<?php echo $options['fontcolor'];?>;text-align: justify;}
	.gtext {color: #444!important;font-weight: 100!important;font-size: 20px!important;	}
	.view_all_theme a {color: #fff!important;font-size: 16px!important;	}
	.view_all_black a {color: #474747!important;font-size: 16px!important;	}
	.view_all_black a:hover {color: #fff!important;	}
	.widget-border { border:1px solid #f2f2f2; margin:10px; padding:10px; }
	.partybullets{list-style:url(<?php bloginfo( 'stylesheet_directory' );?>/images/bullet.png); margin-left:-3%;}
	.footer{background:url(<?php bloginfo( 'stylesheet_directory' );?>/images/footer.png);}
	<?php
	if($cta_options['ctaaction2']=="CTA Image")
	{
	?>
	.ctabox_inner{background:url(<?php echo $cta_options['ctacustimg']; ?>) no-repeat center center; background-size:cover; padding-top:21%; padding-bottom:3%;}
	<?php
	}
	?>
	<?php echo $options['custcss']; ?>
</style>
<?php 
// Google map API START
$mapapikey='AIzaSyC62FSn8UkktEWEoGbqBTWb78ixwiXoqjI';
$encodedaddress='Chicago+IL';
$coordx=41.8781136;
$coordy=-87.6297982;
if ($gmap_options['gmap']==1) {
	if ($gmap_options['gmapaddress']!='') {
		$encodedaddress=str_replace(" ", "+", $gmap_options['gmapaddress']);
		
	} 
		$mapapikey=$gmap_options['gmapapi'];
		if ($gmap_options['gmapapi'] == '' || $gmap_options['gmapaddress'] == '') {
				$mapapikey='AIzaSyC62FSn8UkktEWEoGbqBTWb78ixwiXoqjI';
				$encodedaddress='Chicago+IL';
				$coordx=41.8781136;
				$coordy=-87.6297982;
		}
} ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC62FSn8UkktEWEoGbqBTWb78ixwiXoqjI"></script>
<script type="text/javascript">

	function initialize() {
		var fullPath = "https://www.google.com/maps/embed/v1/place?key=<?php echo $mapapikey; ?>&q=<?php echo $encodedaddress;?>"
		top.document.getElementById('map_canvas1').setAttribute("src",fullPath);
	}
	
	</script>
	
	
	<!--Js and css for tabbed widget-->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/tab/css/tab-style.css">
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' );?>/tab/js/tabs.js"></script>
	<!--Js and css for tabbed widget-->
	
	</head>
	<body onLoad="initialize()" <?php body_class(); ?>>





<!--Header Starts-->

<header class="header">
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-4 col-xs-6 padding0">
<?php if($options['showlogo']==1 && $options['logo']!="") {
echo "<a href=".get_option('home')."><img src=".$options['logo']." class='img-responsive center-block' /></a>";
}
elseif($options['showlogo']==1 && $options['logo']=="") {
echo "<a href=".get_option('home')."><img src='";
bloginfo('stylesheet_directory');
echo "/images/logo.png' class='img-responsive center-block' /></a>";
} else {
echo "<div class='logo mobilecenter mdem28 themecolor bitter w600 margin_top2 smem24 xsem20'>".get_bloginfo()."</div>";
}?>
</div>


<div class="col-md-0 col-sm-0 col-xs-6 text-right visible-xs padding0">
        <div class="bs-example">
          <nav role="navigation" class="navbar navbar-default nav-mobile"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle margin_top4"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
              <?php wp_nav_menu(array('menu' => 'Primary Menu','container_class' => 'nav navbar-nav', 'container_id' => '', 'walker' => new CSS_Menu_Maker_Walker()));  ?>
            </div>
          </nav>
        </div>
      </div>


<div class="col-md-4 col-md-offset-5 col-sm-5 col-sm-offset-3 col-xs-12 col-xs-offset-0">

<!--Header CTA Starts-->
        <div class="header_cta bitter margin_top6 <?php if($mob_options['firstscreen']=="CTA" or $mob_options['firstscreen']=="Lead form"){ echo " hidden-xs";} ?>">
          <?php if($cta_options['olpcta_header1']!=''){
if($cta_options['ctaaction1']=="Button"){ ?>
          <div class="hidden-xs text-right"><span class="mdem12 smem12 xsem12"><?php echo $cta_options['ctatext1']."</span><br><br><a class='hcta_button mdem12 smem12 xsem12' href=".$cta_options['buttonlink1'].">".$cta_options['buttontext1']."</a>"; ?></span></div>
          <div class="visible-xs margin_bot3 text-center"><span class="mdem12 smem12 xsem12"><?php echo $cta_options['ctatext1']."</span><br><br><a class='hcta_button' href=".$cta_options['buttonlink1'].">".$cta_options['buttontext1']."</a>"; ?></span></div>
        </div>
        <?php }
else
{
?>
        <div class="header_cta_text bitter hidden-xs text-right"><span class="mdem12 smem12 xsem12"><?php echo $cta_options['ctatext1']."</span><br><span class='mdem20 smem18 xsem18 red'><i class='glyphicon glyphicon-earphone'></i>&nbsp;".$cta_options['ctacont1']; ?></span></div>
        <div class="headerctatext visible-xs bitter margin_bot2 text-center ctacontact"><span class="mdem12 smem12 xsem12"><?php echo $cta_options['ctatext1']."</span><br><span class='mdem20 smem18 xsem18 red'><i class='glyphicon glyphicon-earphone'></i>&nbsp;<a class='header_cta_action_xs' href='tel:".$cta_options['ctacont1']."'>".$cta_options['ctacont1']."</a>"; ?></span></div>
        <?php
}
}?>
      </div>
      <!--Header CTA Ends--> 










</div>

</div>
</div>
</header>

<!--Header Ends-->

	
   



<!--Navigation Starts -->

<nav class="menuarea hidden-xs navbar navbar-default" id="mainnav">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 menu-secondary padding0">
        <?php wp_nav_menu(array('menu' => 'Primary Menu', 'container_id' => 'cssmenu', 'walker' => new CSS_Menu_Maker_Walker()));  ?>
      </div>
    </div>
  </div>
</nav>

<!--Navigation Ends-->






<!--Content Area Starts -->

<?php
if ( is_front_page() ) {
?>
<?php
if($slide_options['hideslide1']==1 && $slide_options['hideslide2']==1 && $slide_options['hideslide3']==1 && $slide_options['hideslide4']==1 && $slide_options['hideslide5']==1)
{
}
else
{
?>

<!-- First Screen -->

<?php
if($mob_options['firstscreen']=="Lead form")
{
?>
<div class="mobilefirst">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 margin_top2 margin_bot2 visible-xs"><?php
		if($lead_options['responder']=="InstaConsultant") {
			include 'icform.php';
		} 
		if($lead_options['responder']=="Getresponse") {
			include 'getresponse.php';
		} 
		if($lead_options['responder']=="Aweber") {
			include 'aweber.php';
		} 
		if($lead_options['responder']=="Mailchimp") {
			include 'mailchimp.php';
		} ?>
      </div>
    </div>
  </div>
</div>
<?php
}
?>



<?php
if($mob_options['firstscreen']=="CTA") { ?>
<div class="mobilefirst">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 margin_top2 margin_bot2 visible-xs">
        
       <div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>     
        
      </div>
    </div>
  </div>
</div>
<?php
}
?>
<!--<div class="visible-xs">
<div id="mypanel">
          <div id="mypanelcontent" class="ddpanelcontent">
            <div style="margin: 10px 0 10px 0;">
              <!--<div id="map_canvas2" style="width:100%; height:300px; margin: 10px 0 10px 0; padding: 10px 0 10px 0;"></div>--> 
<!--<noscript>
              <div style="color:#FF0000;">
                <h4>JavaScript must be enabled in order for you to use Google Maps.</h4>
                <p>It seems JavaScript is either disabled or not supported by your browser.</p>
                <p>To view Google Maps, enable JavaScript by changing your browser options and then reload this page.</p>
              </div>
              </noscript>
            </div>
          </div>
        </div>
        </div>-->
<?php
//}
?>

<!-- First Screen Ends -->

<div class="padding0 <?php if($mob_options['firstscreen']=="Lead form" or $mob_options['firstscreen']=="CTA"){echo "hidden-xs";} ?>">
  <div class="banner_theme">
    <div class="wrapper">
      <div class="main">
        <div class="page_container">
          <div id="immersive_slider">
          
            <?php
//If slide 1 is enabled
if($slide_options['hideslide1']=="")
{
?>
            <div class="slide" data-blurred="<?php if($slide_options['slide1']!=""){echo $slide_options['slide1'];}?>">
            <div class="container">
            <div class="row">			
              
<?php
if($slide_options['bannerzone1']=="fwslider")
{
?>

	<?php
	if($slide_options['slidezone1']=="Text")
	{
	?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl1fsize']; ?>; color:#<?php echo $slide_options['mtl1color']; ?>;"><?php echo $slide_options['maintl1']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl1fsize']; ?>; color:#<?php echo $slide_options['stl1color']; ?>;"><?php echo $slide_options['subtl1']; ?></h3>
                
    <?php if($slide_options['slide1ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide1ctalink'].">".$slide_options['slide1ctatext']."</a></div>";} ?>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone1']=="Video")
	{
	?>
    <div class="col-md-8 col-md-offset-2 margin_top2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls1']==1){$vcontrols1=1;} else{$vcontrols1=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code1']."?autoplay=0&controls=".$vcontrols1."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v1cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v1cta1link'].">".$slide_options['v1cta1text']."</a>";
	}
	if($slide_options['v1cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v1cta2link'].">".$slide_options['v1cta2text']."</a>";} ?>
    </div>
    </div>
	<?php
	}
                

}


elseif($slide_options['bannerzone1']=="slidercta")
{




if($slide_options['slidezone1']=="Text")
	{
	?>
	<div class="col-md-8 col-sm-8 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl1fsize']; ?>; color:#<?php echo $slide_options['mtl1color']; ?>;"><?php echo $slide_options['maintl1']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl1fsize']; ?>; color:#<?php echo $slide_options['stl1color']; ?>;"><?php echo $slide_options['subtl1']; ?></h3>
                
    <?php if($slide_options['slide1ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide1ctalink'].">".$slide_options['slide1ctatext']."</a></div>";} ?>
    </div>
    
   <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone1']=="Video")
	{
	?>
    <div class="col-md-8 margin_top2 col-sm-8 col-xs-12">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls1']==1){$vcontrols1=1;} else{$vcontrols1=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code1']."?autoplay=0&controls=".$vcontrols1."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v1cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v1cta1link'].">".$slide_options['v1cta1text']."</a>";
	}
	if($slide_options['v1cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v1cta2link'].">".$slide_options['v1cta2text']."</a>";} ?>
    </div>
    </div>
    
    <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
    
	<?php
	}





}




?>



           </div> <!-- End Row -->
           </div> <!-- End Container -->
            </div>
            <?php
}
//End if slide 1 is enable










//If slide 2 is enabled
if($slide_options['hideslide2']=="")
{
?>
            <div class="slide" data-blurred="<?php if($slide_options['slide2']!=""){echo $slide_options['slide2'];}?>">
            <div class="container">
            <div class="row">			
              
<?php
if($slide_options['bannerzone2']=="fwslider")
{
?>

	<?php
	if($slide_options['slidezone2']=="Text")
	{
	?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl2fsize']; ?>; color:#<?php echo $slide_options['mtl2color']; ?>;"><?php echo $slide_options['maintl2']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl2fsize']; ?>; color:#<?php echo $slide_options['stl2color']; ?>;"><?php echo $slide_options['subtl2']; ?></h3>
                
    <?php if($slide_options['slide2ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide2ctalink'].">".$slide_options['slide2ctatext']."</a></div>";} ?>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone2']=="Video")
	{
	?>
    <div class="col-md-8 col-md-offset-2 margin_top2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls2']==1){$vcontrols2=1;} else{$vcontrols2=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code2']."?autoplay=0&controls=".$vcontrols2."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v2cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v2cta1link'].">".$slide_options['v2cta1text']."</a>";
	}
	if($slide_options['v2cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v2cta2link'].">".$slide_options['v2cta2text']."</a>";} ?>
    </div>
    </div>
	<?php
	}
                

}






elseif($slide_options['bannerzone2']=="slidercta")
{




if($slide_options['slidezone2']=="Text")
	{
	?>
	<div class="col-md-8 col-sm-8 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl2fsize']; ?>; color:#<?php echo $slide_options['mtl2color']; ?>;"><?php echo $slide_options['maintl2']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl2fsize']; ?>; color:#<?php echo $slide_options['stl2color']; ?>;"><?php echo $slide_options['subtl2']; ?></h3>
                
    <?php if($slide_options['slide2ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide2ctalink'].">".$slide_options['slide2ctatext']."</a></div>";} ?>
    </div>
    
   <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone2']=="Video")
	{
	?>
    <div class="col-md-8 margin_top2 col-sm-8 col-xs-12">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls2']==1){$vcontrols2=1;} else{$vcontrols2=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code2']."?autoplay=0&controls=".$vcontrols1."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v2cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v2cta1link'].">".$slide_options['v2cta1text']."</a>";
	}
	if($slide_options['v2cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v2cta2link'].">".$slide_options['v2cta2text']."</a>";} ?>
    </div>
    </div>
    
    <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
    
	<?php
	}





}




?>



           </div> <!-- End Row -->
           </div> <!-- End Container -->
            </div>
            <?php
}
//End if slide 2 is enable












//If slide 3 is enabled
if($slide_options['hideslide3']=="")
{
?>
            <div class="slide" data-blurred="<?php if($slide_options['slide3']!=""){echo $slide_options['slide3'];}?>">
            <div class="container">
            <div class="row">			
              
<?php
if($slide_options['bannerzone3']=="fwslider")
{
?>

	<?php
	if($slide_options['slidezone3']=="Text")
	{
	?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl3fsize']; ?>; color:#<?php echo $slide_options['mtl3color']; ?>;"><?php echo $slide_options['maintl3']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl3fsize']; ?>; color:#<?php echo $slide_options['stl3color']; ?>;"><?php echo $slide_options['subtl3']; ?></h3>
                
    <?php if($slide_options['slide3ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide3ctalink'].">".$slide_options['slide3ctatext']."</a></div>";} ?>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone3']=="Video")
	{
	?>
    <div class="col-md-8 col-md-offset-2 margin_top2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls3']==1){$vcontrols3=1;} else{$vcontrols3=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code3']."?autoplay=0&controls=".$vcontrols3."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v3cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v3cta1link'].">".$slide_options['v3cta1text']."</a>";
	}
	if($slide_options['v3cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v3cta2link'].">".$slide_options['v3cta2text']."</a>";} ?>
    </div>
    </div>
	<?php
	}
                

}




elseif($slide_options['bannerzone3']=="slidercta")
{




if($slide_options['slidezone3']=="Text")
	{
	?>
	<div class="col-md-8 col-sm-8 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl3fsize']; ?>; color:#<?php echo $slide_options['mtl3color']; ?>;"><?php echo $slide_options['maintl3']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl3fsize']; ?>; color:#<?php echo $slide_options['stl3color']; ?>;"><?php echo $slide_options['subtl3']; ?></h3>
                
    <?php if($slide_options['slide3ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide3ctalink'].">".$slide_options['slide3ctatext']."</a></div>";} ?>
    </div>
    
   <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone3']=="Video")
	{
	?>
    <div class="col-md-8 margin_top2 col-sm-8 col-xs-12">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls3']==1){$vcontrols3=1;} else{$vcontrols3=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code3']."?autoplay=0&controls=".$vcontrols3."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v3cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v3cta1link'].">".$slide_options['v3cta1text']."</a>";
	}
	if($slide_options['v3cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v3cta2link'].">".$slide_options['v3cta2text']."</a>";} ?>
    </div>
    </div>
    
    <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
    
	<?php
	}





}




?>



           </div> <!-- End Row -->
           </div> <!-- End Container -->
            </div>
            <?php
}
//End if slide 3 is enable














//If slide 4 is enabled
if($slide_options['hideslide4']=="")
{
?>
            <div class="slide" data-blurred="<?php if($slide_options['slide4']!=""){echo $slide_options['slide4'];}?>">
            <div class="container">
            <div class="row">			
              
<?php
if($slide_options['bannerzone4']=="fwslider")
{
?>

	<?php
	if($slide_options['slidezone4']=="Text")
	{
	?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl4fsize']; ?>; color:#<?php echo $slide_options['mtl4color']; ?>;"><?php echo $slide_options['maintl4']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl4fsize']; ?>; color:#<?php echo $slide_options['stl4color']; ?>;"><?php echo $slide_options['subtl4']; ?></h3>
                
    <?php if($slide_options['slide4ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide4ctalink'].">".$slide_options['slide4ctatext']."</a></div>";} ?>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone4']=="Video")
	{
	?>
    <div class="col-md-8 col-md-offset-2 margin_top2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls4']==1){$vcontrols4=1;} else{$vcontrols4=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code4']."?autoplay=0&controls=".$vcontrols4."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v4cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v4cta1link'].">".$slide_options['v4cta1text']."</a>";
	}
	if($slide_options['v4cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v4cta2link'].">".$slide_options['v4cta2text']."</a>";} ?>
    </div>
    </div>
	<?php
	}
                

}





elseif($slide_options['bannerzone4']=="slidercta")
{




if($slide_options['slidezone4']=="Text")
	{
	?>
	<div class="col-md-8 col-sm-8 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl4fsize']; ?>; color:#<?php echo $slide_options['mtl4color']; ?>;"><?php echo $slide_options['maintl4']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl4fsize']; ?>; color:#<?php echo $slide_options['stl4color']; ?>;"><?php echo $slide_options['subtl4']; ?></h3>
                
    <?php if($slide_options['slide4ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide4ctalink'].">".$slide_options['slide4ctatext']."</a></div>";} ?>
    </div>
    
   <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone4']=="Video")
	{
	?>
    <div class="col-md-8 margin_top2 col-sm-8 col-xs-12">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls4']==1){$vcontrols4=1;} else{$vcontrols4=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code4']."?autoplay=0&controls=".$vcontrols4."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v4cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v4cta1link'].">".$slide_options['v4cta1text']."</a>";
	}
	if($slide_options['v4cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v4cta2link'].">".$slide_options['v4cta2text']."</a>";} ?>
    </div>
    </div>
    
    <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
    
	<?php
	}





}




?>



           </div> <!-- End Row -->
           </div> <!-- End Container -->
            </div>
            <?php
}
//End if slide 4 is enable










//If slide 5 is enabled
if($slide_options['hideslide5']=="")
{
?>
            <div class="slide" data-blurred="<?php if($slide_options['slide5']!=""){echo $slide_options['slide5'];}?>">
            <div class="container">
            <div class="row">			
              
<?php
if($slide_options['bannerzone5']=="fwslider")
{
?>

	<?php
	if($slide_options['slidezone5']=="Text")
	{
	?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl5fsize']; ?>; color:#<?php echo $slide_options['mtl5color']; ?>;"><?php echo $slide_options['maintl5']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl5fsize']; ?>; color:#<?php echo $slide_options['stl5color']; ?>;"><?php echo $slide_options['subtl5']; ?></h3>
                
    <?php if($slide_options['slide4ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide4ctalink'].">".$slide_options['slide4ctatext']."</a></div>";} ?>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone5']=="Video")
	{
	?>
    <div class="col-md-8 col-md-offset-2 margin_top2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls5']==1){$vcontrols5=1;} else{$vcontrols5=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code5']."?autoplay=0&controls=".$vcontrols5."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v5cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v5cta1link'].">".$slide_options['v5cta1text']."</a>";
	}
	if($slide_options['v5cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v5cta2link'].">".$slide_options['v5cta2text']."</a>";} ?>
    </div>
    </div>
	<?php
	}
                

}





elseif($slide_options['bannerzone5']=="slidercta")
{




if($slide_options['slidezone5']=="Text")
	{
	?>
	<div class="col-md-8 col-sm-8 col-xs-12">
	<h2 class="dtmargin12 mdem50 smem40 lh100 xsem20 w700 text-center" style="font-size:<?php echo $slide_options['mtl5fsize']; ?>; color:#<?php echo $slide_options['mtl5color']; ?>;"><?php echo $slide_options['maintl5']; ?></h2>
	<h3 class="dtmargin1 mdem35 smem30 xsem16 w600 text-center margin_top-1" style="font-size:<?php echo $slide_options['stl5fsize']; ?>; color:#<?php echo $slide_options['stl5color']; ?>;"><?php echo $slide_options['subtl5']; ?></h3>
                
    <?php if($slide_options['slide5ctatext']!=""){echo "<div class='text-center margin_top2'><a class='slidecta mdem16 smem15 xsem14' href=".$slide_options['slide5ctalink'].">".$slide_options['slide5ctatext']."</a></div>";} ?>
    </div>
    
  <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
                
    <?php
	}
	elseif($slide_options['slidezone5']=="Video")
	{
	?>
    <div class="col-md-8 margin_top2 col-sm-8 col-xs-12">
    <div class="videobox">
    <div class="responsive-video">
    <?php
	if($slide_options['controls5']==1){$vcontrols5=1;} else{$vcontrols5=0;}
	echo "<object data='https://www.youtube.com/embed/".$slide_options['video_code5']."?autoplay=0&controls=".$vcontrols5."&rel=0&autohide=1&nologo=1&showinfo=0&frameborder=0&theme=light&modestbranding=1'></object>"; ?>
    </div>
    </div>
    <div class='text-center margin_top2'>
    <?php if($slide_options['v5cta1text']!="")
	{
	echo "
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v5cta1link'].">".$slide_options['v5cta1text']."</a>";
	}
	if($slide_options['v3cta2text']!="")
	{
	echo " &nbsp;
	<a class='slidecta1 mdem16 smem15 xsem11' href=".$slide_options['v5cta2link'].">".$slide_options['v5cta2text']."</a>";} ?>
    </div>
    </div>
    
    <div class="col-md-4 col-sm-4 margin_top3 col-xs-12 hidden-xs">
    	<div class="ctabox">
    	<div class="ctabox_inner">
         <?php if($cta_options['ctaaction2']=="Contact No.")
		 {
		 if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";} 
         if($cta_options['ctacont2']!=""){
		 ?>
         <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/phone.png" class="img-responsive center-block">
         <?php echo "<div class='margin_top4 whitetext mdem18 smem16 w600 xsem15 text-center sliderctacontact'>".$cta_options['ctacont2']."</div>";}  
		 }
		 elseif($cta_options['ctaaction2']=="Button")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 elseif($cta_options['ctaaction2']=="CTA Image")
		 {
	    if($cta_options['ctasliderheadline']!=""){echo "<div class='mdem24 padding2 smem20 w600 xsem18 text-center'>".$cta_options['ctasliderheadline']."</div>";}
         if($cta_options['ctaslidersubheadline']!=""){echo "<div class='margin_top4 padding2 mdem16 smem15 w400 xsem14 text-center'>".$cta_options['ctaslidersubheadline']."</div>";}
		  if($cta_options['buttontext2']!=""){
         echo "<div class='margin_top4 margin_bot5 whitetext mdem16 smem15 xsem14 text-center'><a href='".$cta_options['buttonlink2']."' class='slidecta'>".$cta_options['buttontext2']."</a></div>";} 
		 }
		 ?>
    	</div>
    	</div>
    </div>
    
	<?php
	}





}




?>



           </div> <!-- End Row -->
           </div> <!-- End Container -->
            </div>
            <?php
}
//End if slide 5 is enable










?>
             </div>
        </div><a href="#" class="is-prev">&laquo;</a> <a href="#" class="is-next" >&raquo;</a>
      </div>
      <script type="text/javascript">
$(document).ready( function() {
$("#immersive_slider").immersive_slider({
container: ".main"
});
});

</script> 
    </div>
  </div>
</div>

    </div>
  </div>
</div>
<?php
}

}
?>





<!--Social Media Icons -->


<?php
if($social_options['si_header']==1)
{
?>
<nav class="sm-menu hidden-xs">
<ul>

<?php
if($social_options['headsmfb']==1)
{
echo "<li><a href='$social_options[fblink]' class='' target='_blank'><i class='fa-sidebar pe-so-facebook'></i><span class='nav-text'>Facebook</span></a></li>" ;
}
if($social_options['headsmtw']==1)
{
echo "<li><a href='$social_options[twlink]' class='' target='_blank'><i class='fa-sidebar pe-so-twitter'></i><span class='nav-text'>Twitter</span></a></li>" ;
}
if($social_options['headsmlin']==1)
{
echo "<li><a href='$social_options[linlink]' class='' target='_blank'><i class='fa-sidebar pe-so-linkedin'></i><span class='nav-text'>Linkedin</span></a></li>" ;
}
if($social_options['headsmyt']==1)
{
echo "<li><a href='$social_options[ytlink]' class='' target='_blank'><i class='fa-sidebar pe-so-youtube-1'></i><span class='nav-text'>Youtube</span></a></li>" ;
}
if($social_options['headsmpin']==1)
{
echo "<li><a href='$social_options[pinlink]' class='' target='_blank'><i class='fa-sidebar pe-so-pinterest'></i><span class='nav-text'>Pinterest</span></a></li>" ;
}
if($social_options['headsmgp']==1)
{
echo "<li><a href='$social_options[gplink]' class='' target='_blank'><i class='fa-sidebar pe-so-google-plus'></i><span class='nav-text'>Google+</span></a></li>" ;
}
if($social_options['headsmig']==1)
{
echo "<li><a href='$social_options[iglink]' class='' target='_blank'><i class='fa-sidebar pe-so-instagram'></i><span class='nav-text'>Instagram</span></a></li>" ;
}
?>
</ul>
</nav>
<?php
}
?>
        
<!--Social Media Icons -->