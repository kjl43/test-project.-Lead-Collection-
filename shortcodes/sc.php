<?php
//Read More
add_shortcode('readmore',function($atts){
	$atts = shortcode_atts(array(
		'content' => '',
		'href' => '',
	),$atts);
	return 
	'<div class="margin_top4 margin_bot2 read_more_theme"><a href='.$atts['href'].'>'.$atts['content'].'</a></div>';
});

//First Row
//Shortcodes for Welcome area
function welcomearea($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="clear"><div class="container"><div class="row border">'. do_shortcode($content) . '</div></div></div>';
} 
add_shortcode("welcomearea", "welcomearea");


function welcomecolumn($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="col-md-8 col-sm-8 col-xs-12 margin_bot2">'. do_shortcode($content) . '</div>';
} 
add_shortcode("welcomecolumn", "welcomecolumn");


function ctacolumn($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="col-md-4 col-sm-4 col-xs-12 hidden-xs margin_top3">'. do_shortcode($content) . '</div>';
} 
add_shortcode("ctacolumn", "ctacolumn");

//First Row End





//Second Row
//Shortcodes for displaying Services
function servicearea($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="servicearea margin_top-1 clear"><div class="container"><div class="row border">'. do_shortcode($content) . '</div></div></div>';
} 
add_shortcode("servicearea", "servicearea");

//Services posts
add_shortcode( 'posts_services', 'tcb_sc_posts_services' );
function tcb_sc_posts_services( $atts ){
  global $post;
  $default = array(
    'type'      => 'post',
    'post_type' => 'services',
    'limit'     => 6,
    'status'    => 'publish'
  );
  $r = shortcode_atts( $default, $atts );
  extract( $r );

  if( empty($post_type) )
    $post_type = $type;

  $post_type_ob = get_post_type_object( $post_type );
  if( !$post_type_ob )
    return '<div class="warning"><p>No such post type <em>' . $post_type . '</em> found.</p></div>';

  $args = array(
    'post_type'   => $post_type,
    'numberposts' => $limit,
    'post_status' => $status,
  );

  $posts = get_posts( $args );
  if( count($posts) ):
    foreach( $posts as $post ): setup_postdata( $post );
      $return .= '<div class="col-md-6 col-sm-6 col-xs-12 portfolioarea margin_top1 margin_bot2"><div class="servicebox"><a href="'.get_permalink( get_the_ID() ).'">';
	  
	  
	  
	  if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                $return.= get_the_post_thumbnail( $thumbnail->ID, 'full',array( 'class'	=> "img-responsive center-block"));
								
                            }else
								{
								?>
                                <?php  $return.="<img src='http://placehold.it/1000x600' class='img-responsive center-block'  />";
								} 		 
	  $return .='</a></div></div>';
	  
    endforeach; //wp_reset_postdata();
  else :
    $return .= '<p>No posts found.</p>';
  endif;

  return $return;
}

function servicecontent($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="col-md-8 col-sm-8 col-xs-12">'. do_shortcode($content) . '</div>';
} 
add_shortcode("servicecontent", "servicecontent");


function serviceposts($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="col-md-4 col-sm-4 col-xs-12 padding0">'. do_shortcode($content) . '</div>';
} 
add_shortcode("serviceposts", "serviceposts");

//Second Row End





//Third Row
//Shortcodes for displaying Portfolio
function portfolioarea($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="margin_top-1"><div class="container"><div class="row"><div class="col-md-12 col-sm-12 col-xs-12">'. do_shortcode($content) . '</div></div></div></div>';
} 
add_shortcode("portfolioarea", "portfolioarea");


//Portfolio posts
add_shortcode( 'custom_portfolio', 'tcb_sc_custom_portfolio' );
function tcb_sc_custom_portfolio( $atts ){
  global $post;
  $default = array(
    'type'      => 'post',
    'post_type' => 'portfolio',
    'limit'     => 4,
    'status'    => 'publish'
  );
  $r = shortcode_atts( $default, $atts );
  extract( $r );

  if( empty($post_type) )
    $post_type = $type;

  $post_type_ob = get_post_type_object( $post_type );
  if( !$post_type_ob )
    return '<div class="warning"><p>No such post type <em>' . $post_type . '</em> found.</p></div>';

  $args = array(
    'post_type'   => $post_type,
    'numberposts' => $limit,
    'post_status' => $status,
  );

  $posts = get_posts( $args );
  if( count($posts) ):
    foreach( $posts as $post ): setup_postdata( $post );
      $return .= '<div class="col-md-6 col-sm-6 col-xs-12 margin_top1 portfolioarea hoverarea square-grid"><figure>';
	  
	  
	  
	  if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                $return.= get_the_post_thumbnail( $thumbnail->ID, 'portfolio-thumb',array( 'class'	=> "img-responsive center-block"));
								
                            }else
								{
								?>
                                <?php  $return.="<img src='http://placehold.it/1000x600' width='300' height='300' class='img-responsive center-block'  />";	
								} 			 
	  $return .='<figcaption><p class="w400 text-center"><a class="read-more-portfolio" href="'.get_permalink( get_the_ID() ).'"><br />
<br />
<br />
<i class="whitetext glyphicon glyphicon-log-in mdem20 smem18 xsem16 w300"></i></a></p></figcaption></figure></div>';
	  
    endforeach; //wp_reset_postdata();
  else :
    $return .= '<p>No posts found.</p>';
  endif;

  return $return;
}



//Shortcodes for parties column
function gallerycoulmn($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="col-md-8 col-sm-8 col-xs-12 padding0">'. do_shortcode($content) . '</div>';
} 
add_shortcode("gallerycoulmn", "gallerycoulmn");




//Shortcodes for Testimonials column
function testicolumn($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0 borders">'. do_shortcode($content) . '</div>';
} 
add_shortcode("testicolumn", "testicolumn");


//Testimonials posts
add_shortcode( 'custom_testimonials', 'tcb_sc_custom_testimonials' );
function tcb_sc_custom_testimonials( $atts ){
  global $post;
  $default = array(
    'type'      => 'post',
    'post_type' => 'testimonial',
    'limit'     => 3,
    'status'    => 'publish'
  );
  $r = shortcode_atts( $default, $atts );
  extract( $r );

  if( empty($post_type) )
    $post_type = $type;

  $post_type_ob = get_post_type_object( $post_type );
  if( !$post_type_ob )
    return '<div class="warning"><p>No such post type <em>' . $post_type . '</em> found.</p></div>';

  $args = array(
    'post_type'   => $post_type,
    'numberposts' => $limit,
    'post_status' => $status,
  );

  $posts = get_posts( $args );
  if( count($posts) ):
    foreach( $posts as $post ): setup_postdata( $post );
					
$return .='<div class="col-md-12 col-sm-12 col-xs-12 margin_top1 margin_bot1 padding0">
<div class="col-md-4 col-md-offset-0 col-sm-4 col-xs-5 padding0"><a href="'.get_permalink( get_the_ID() ).'">';


if ( has_post_thumbnail( $thumbnail->ID ) ) {
$return.= get_the_post_thumbnail( $thumbnail->ID, 'category-thumb',array( 'class'	=> "img-responsive center-block img-circle"));
}else
{

?>
<?php  $return.="<img src='http://placehold.it/300' width='300' height='300' class='img-responsive center-block img-circle' />";	
}

$presenter_city = get_post_meta($post->ID, 'presenter_city', true);
$presenter_country = get_post_meta($post->ID, 'presenter_country', true);

$return .='</a></div>
<div class="col-md-8 col-sm-8 col-xs-7">
<p class="greycol margin_top8 mdem16 smem15 xsem14 w600">'. get_the_title() .'</p>
<p class="mdem12 smem12 xsem11 margin_top-2">'.$presenter_city.', '.$presenter_country.'</p>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 margin_top2"><p class="italic w400 text-center">'.get_the_excerpt().'</p></div>
</div>';
	  
    endforeach; //wp_reset_postdata();
  else :
    $return .= '<p>No posts found.</p>';
  endif;

  return $return;
}











//Shortcodes for Team
function teamcolumn($atts, $content = null) {
    extract(shortcode_atts(array(
        "to" => ''
    ), $atts));
    return '<div class="col-md-4 col-sm-4 col-xs-12 col-xs-offset-0 borders">'. do_shortcode($content) . '</div>';
} 
add_shortcode("teamcolumn", "teamcolumn");


//Testimonials posts
add_shortcode( 'custom_team', 'tcb_sc_custom_team' );
function tcb_sc_custom_team( $atts ){
  global $post;
  $default = array(
    'type'      => 'post',
    'post_type' => 'team',
    'limit'     => 3,
    'status'    => 'publish'
  );
  $r = shortcode_atts( $default, $atts );
  extract( $r );

  if( empty($post_type) )
    $post_type = $type;

  $post_type_ob = get_post_type_object( $post_type );
  if( !$post_type_ob )
    return '<div class="warning"><p>No such post type <em>' . $post_type . '</em> found.</p></div>';

  $args = array(
    'post_type'   => $post_type,
    'numberposts' => $limit,
    'post_status' => $status,
  );

  $posts = get_posts( $args );
  if( count($posts) ):
    foreach( $posts as $post ): setup_postdata( $post );
					
$return .='<div class="col-md-4 col-sm-4 col-xs-12 margin_top1 margin_bot1">
<div class="col-md-12 col-sm-12 col-xs-12 padding0">';


if ( has_post_thumbnail( $thumbnail->ID ) ) {
$return.= get_the_post_thumbnail( $thumbnail->ID, 'category-thumb',array( 'class'	=> "img-responsive center-block img-circle team-image"));
}else
{

?>
<?php  $return.="<img src='http://placehold.it/300' width='300' height='300' class='img-responsive center-block img-circle team-image' />";	
}

$member_designation = get_post_meta($post->ID, 'member_designation', true);

$return .='</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="greycol margin_top8 mdem18 smem16 xsem15 text-center w400">'. get_the_title() .'</div>
<div class="mdem11 smem11 xsem11 w300 margin_top-1 text-center">'.$member_designation.'</div>
</div>
</div>';
	  
    endforeach; //wp_reset_postdata();
  else :
    $return .= '<p>No posts found.</p>';
  endif;

  return $return;
}








//Post Excerpts Length
function set_excerpt_length($length) {
	global $post;
	if ($post->post_type == 'services')
		return 10;
	else if ($post->post_type == 'portfolio')
		return 10;
	else if ($post->post_type == 'testimonial')
		return 15;
	else if ($post->post_type == 'events')
	return 10;
	else
		return 40;
}
add_filter('excerpt_length', 'set_excerpt_length');













class TradersContactForm
{
 
    public function __construct()
    {
        add_action('init', array($this, 'init'));
        add_shortcode('contact_us', array($this, 'shortcode'));
    }
 
    public function init()
    {
        if (!empty($_POST['nonce_custom_form']))
        {
            if (!wp_verify_nonce($_POST['nonce_custom_form'], 'handle_custom_form'))
            {
                die('You are not authorized to perform this action.');
            } else
            {
                $error = null;
                if (empty($_POST['leadname']))
                {
                    $error = new WP_Error('empty_error', __('Please enter name.', 'tahiryasin'));
                    wp_die($error->get_error_message(), __('TradersContactForm Error', 'tahiryasin'));
                }
                else
                    //for person
					$person_to = $_POST['leademail'];
					$person_name = $_POST['leadname'];
					$person_subject = 'From: ' . bloginfo("name") ;
					$person_msg = 'Hello <b>'. $person_name .'</b><br><br>We are so glad to see you at '.get_bloginfo('name').' <br><br> Thank You for contacting us. We will get back to you shortly. <br><br> Best Regards ' . get_bloginfo('name') . '<br><br> Support Team';
					$person_header = "MIME-Version: 1.0" . "\r\n";
					$person_header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$person_header .= 'From: ' . get_option('admin_email') . "\r\n";
					
					//for admin
					$admin_to = get_option('admin_email');
					$admin_subject = 'Inquiry from Contact form by: '.$_POST['leadname'];
					$admin_msg .= "Name : ".$_POST['leadname']."<br>Email : ".$_POST['leademail']."<br>Phone : ".$_POST['leadphone']."<br>Subject : ".$_POST['leadsubject']."<br>Message : ".$_POST['leadmsg'];
					$headers_admin = "MIME-Version: 1.0" . "\r\n";
					$headers_admin .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers_admin .= 'From: ' .$person_to. "\r\n";
					
					//for admin
					mail($admin_to, $admin_subject, $admin_msg, $headers_admin);
					
					//for person
					mail($person_to, $person_subject, $person_msg, $person_header);
 
					 
					
					
            }
        }
    }
 
    function shortcode($atts)
    {
        return "<div class='contact_form'><form action='?send=success' enctype='multipart/form-data' method='post'>
<div class='margin_top2'><input type='text' class='form-control' placeholder='Name' name='leadname' /></div>
<div class='margin_top2'><input type='email' class='form-control' placeholder='Email' name='leademail' /></div>
<div class='margin_top2'><input type='text' class='form-control' placeholder='Phone No.' name='leadphone' /></div>
<div class='margin_top2'><input type='text' class='form-control' placeholder='Subject' name='leadsubject' /></div>
<div class='margin_top2'><textarea class='form-control' rows='4' placeholder='Message' name='leadmsg'></textarea></div>
<div class='col-md-12 col-sm-12 col-xs-12 margin_top2 padding0'><input type='submit' value='SEND' class='form_submit' /> &nbsp; <input type='reset' value='RESET' class='form_reset' /></div>
<input type='hidden' name='action' value='new_lead' />
    " . wp_nonce_field('handle_custom_form', 'nonce_custom_form') . "
        </form></div>";
		if($_GET['send']=='success') {
			echo '<p style=" border:1px solid #ebebeb; padding:10px;">form successfully submited</p>';
		}
    }
 
}
 
$TradersContactForm = new TradersContactForm();
?>