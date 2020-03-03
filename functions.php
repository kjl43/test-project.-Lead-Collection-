<?php
$lead_options = get_option( 'olp_theme_lead_options' ); 	#Get Lead Options
add_action( 'after_setup_theme', 'baw_theme_setup' );

#----------#Theme Update Checker Start#----------
	require get_template_directory().'/theme-updates/theme-update-checker.php';
	$example_update_checker = new PlumbersUpdateChecker(
		'ActiveDrain',                                            //Theme folder name, AKA "slug". 
		'https://my.websuitepro.co/theme-updates/ActiveDrain/info.json' //URL of the metadata file.
	);
#----------#Theme Update Checker End#----------


//add affiliat link biz
add_option('Plumbers-Pro_affiliateLink_Biz', 'https://www.jvzoo.com/affiliates/info/174201');
//add affiliat link biz



#----------#Image Thumb set up#----------
function baw_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'category-thumb', 300, 300, true ); // 300 pixels wide (and unlimited height)
	add_image_size( 'portfolio-thumb', 500, 300, true ); // 300 pixels wide (and unlimited height)
	add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
}
#---------------------------------------------------

#		Add Actions in theme
#---------------------------------------------------
	add_action("admin_init", "admin_init");
	add_action('save_post', 'save_presenter');
	add_action('save_post', 'save_member');
#---------------------------------------------------

#		admin_init function
#---------------------------------------------------
function admin_init(){
	add_meta_box('presenter_loop', 'Presenter Details', 'loop_meta_1', 'testimonial', 'normal', 'high');
	add_meta_box('member_loop', 'Member Details', 'loop_meta_2', 'team', 'normal', 'high');
}
// back function of add meta box that displays the meta box in the post edit screen
function loop_meta_1($post, $args){
	$presenter_city = get_post_meta($post->ID, 'presenter_city', true);
	$presenter_country = get_post_meta($post->ID, 'presenter_country', true); ?>
    <label>Presenter City: </label><input type="text" name="presenter_city" value="<?php echo $presenter_city; ?>" /><br/>
    <label>Presenter Country: </label><input type="text" name="presenter_country" value="<?php echo $presenter_country; ?>" /><br/><?php
}
function loop_meta_2($post, $args){
	$member_designation = get_post_meta($post->ID, 'member_designation', true); ?>
	<label>Member's Designation: </label><input type="text" name="member_designation" value="<?php echo $member_designation; ?>" /><br/><?php
}
// saving the teaser
function save_presenter(){
    global $post;
    update_post_meta($post->ID, 'presenter_city', $_POST['presenter_city']);
	update_post_meta($post->ID, 'presenter_country', $_POST['presenter_country']);
}
function save_member(){
    global $post;
    update_post_meta($post->ID, 'member_designation', $_POST['member_designation']);
}
#---------------------------------------------------
#		Get OLP Theme option
#---------------------------------------------------
	$options = get_option( 'olp_theme_options' );
#---------------------------------------------------
#		lead_form Short code Start
#---------------------------------------------------
	function lead_form($atts, $content = null) {
		extract(shortcode_atts(array(
			"to" => ''
		), $atts));
		if($GLOBALS['leadtype']=="Aweber") {
			ob_start();
			include 'aweber.php';
			$return = ob_get_clean();
			return $return;
		}
		if($GLOBALS['leadtype']=="Getresponse") {
			ob_start();
			include 'getresponse.php';
			$return = ob_get_clean();
			return $return;
		}
		if($GLOBALS['leadtype']=="Mailchimp") {
			ob_start();
			include 'mailchimp.php';
			$return = ob_get_clean();
			return $return;
		}
		if($GLOBALS['leadtype']=="InstaConsultant") {
			ob_start();
			include 'icform.php';
			$return = ob_get_clean();
			return $return;
		}	
	} 
	
	add_shortcode("lead_form", "lead_form");
#---------------------------------------------------
#		lead_form Short code End
#---------------------------------------------------
//Dashboard Functions
$GLOBALS['prof_lead_options']=array(
	/*'Aweber' => array(
		'value' => 'Aweber',
		'label' => __( 'Aweber', 'olptheme' )
	),
	'Getresponse' => array(
		'value' => 'Getresponse',
		'label' => __( 'Getresponse', 'olptheme' )
	),
	'Mailchimp' => array(
		'value' => 'Mailchimp',
		'label' => __( 'Mailchimp', 'olptheme' )
	),*/
	'InstaConsultant' => array(
		'value' => 'InstaConsultant',
		'label' => __( 'Insta Consultant Lead Generator', 'olptheme' )
	)
);
// $GLOBALS['prof_pro_blog_options']=1;
// $GLOBALS['prof_pro_lead_options']=1;
$GLOBALS['prof_pro_blog_options']=0;
$GLOBALS['prof_pro_lead_options']=0;
$GLOBALS['prof_niche_scheme'] = array(
	'Choose Color Scheme' => array(
		'value' => '',
		'label' => __( 'Choose Color Scheme', 'olptheme' )
	),
	'Green' => array(
		'value' => 'Green',
		'label' => __( 'Green', 'olptheme' )
	),
	'Light-Voilet' => array(
		'value' => 'Light-Voilet',
		'label' => __( 'Light-Voilet', 'olptheme' )
	),
	'Dark-Salmon' => array(
		'value' => 'Dark-Salmon',
		'label' => __( 'Dark-Salmon', 'olptheme' )
	),
	'Olive-Drab' => array(
		'value' => 'Olive-Drab',
		'label' => __( 'Olive-Drab', 'olptheme' )
	),
	'Spring-Green' => array(
		'value' => 'Spring-Green',
		'label' => __( 'Spring-Green', 'olptheme' )
	),
	'Brown' => array(
		'value' => 'Brown',
		'label' => __( 'Brown', 'olptheme' )
	),
	'Orange' => array(
		'value' => 'Orange',
		'label' => __( 'Orange', 'olptheme' )
	)/*,
	'Steelblue' => array(
		'value' => 'Steelblue',
		'label' => __( 'Steelblue', 'olptheme' )
	),
	'Turquoise' => array(
		'value' => 'Turquoise',
		'label' => __( 'Turquoise', 'olptheme' )
	),
	'Rebecca-Purple' => array(
		'value' => 'Rebecca-Purple',
		'label' => __( 'Rebecca-Purple', 'olptheme' )
	),
	'SkyBlue' => array(
		'value' => 'SkyBlue',
		'label' => __( 'SkyBlue', 'olptheme' )
	),
	'Pink' => array(
		'value' => 'Pink',
		'label' => __( 'Pink', 'olptheme' )
	),
	'DodgerBlue' => array(
		'value' => 'DodgerBlue',
		'label' => __( 'DodgerBlue', 'olptheme' )
	),
	'Firebrick' => array(
		'value' => 'Firebrick',
		'label' => __( 'Firebrick', 'olptheme' )
	),
	'PaleGreen' => array(
		'value' => 'PaleGreen',
		'label' => __( 'PaleGreen', 'olptheme' )
	)*/
);
$GLOBALS['prof_niche']=0;
$GLOBALS['prof_themename']="ActiveDrain";


//Mobilesite Functions
$GLOBALS['prof_mobile_first_options']= array(
	'Slider' => array(
		'value' => 'Slider',
		'label' => __( 'Slider', 'olptheme' )
	),
	'CTA' => array(
		'value' => 'CTA',
		'label' => __( 'CTA', 'olptheme' )
	),
	'Lead form' => array(
		'value' => 'Lead form',
		'label' => __( 'Lead form', 'olptheme' )
	)/*,
	'Google Map' => array(
		'value' => 'Google Map',
		'label' => __( 'Google Map', 'olptheme' )
	)*/
);

//Header Functions
$GLOBALS['prof_header_cta']=0;

//CTA Functions
$GLOBALS['prof_header_cta_settings']=1;
$GLOBALS['prof_slider_cta_settings']=0;
$GLOBALS['prof_belowslider_cta_settings']=0;
$GLOBALS['prof_abovefooter_cta_settings']=1;
$GLOBALS['prof_lead_tabs']=1;
$GLOBALS['prof_slider_tabs']=1;
$GLOBALS['prof_cta_tabs']=1;
$GLOBALS['prof_colorscheme']=1;
$GLOBALS['prof_slider_cta_settings']=1;

/*******************************
  Team 
********************************/
add_theme_support( 'post-thumbnails' );
add_image_size( 'single-post-thumbnail', 60, 88 );
add_action('init', 'lwp_custom_init_team');
function lwp_custom_init_team() {
  $labels = array(
    'name' => _x('Team', 'post type general name'),
    'singular_name' => _x('Team', 'post type singular name'),
    'add_new' => _x('Add New', 'team'),
    'add_new_item' => __('Add New Team Member'),
    'edit_item' => __('Edit Team Member'),
    'new_item' => __('New Team Member'),
    'view_item' => __('View Team Member'),
    'search_items' => __('Search Team Member'),
    'not_found' =>  __('No Team Member found'),
    'not_found_in_trash' => __('No Team Member found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
	'menu_icon'           => 'dashicons-id',
    'supports' => array('title','editor','thumbnail','author','comments')
  ); 
  register_post_type('team',$args);
}

//add filter to insure the text Team is displayed when user updates a Team Member 
add_filter('post_updated_messages', 'team_updated_messages');
function team_updated_messages( $messages ) {
  	global $post, $post_ID;
	$messages['team'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Team Member updated. <a href="%s">View Team Member</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Team Member updated.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Team Member restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Team Member published. <a href="%s">View Team Member</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Team Member saved.'),
		8 => sprintf( __('Team Member submitted. <a target="_blank" href="%s">Preview Team Member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Team Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Team Member</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Team Member draft updated. <a target="_blank" href="%s">Preview Team Member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
//display contextual help for Events
add_action( 'contextual_help', 'add_help_text_team', 10, 3 );
function add_help_text_team($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('team' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a Team Member:') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct manufacturer such as Mystery, or Historic.') . '</li>' .
      '<li>' . __('Specify the correct Team Member.  Remember that the Author module refers to you, the author of this Team Member review.') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the Team Member review to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' ;
  } elseif ( 'edit-team' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of Team Member.') . '</p>' ;
  }
  return $contextual_help;
}






#------------------------------------------------- 
#				CTA Widgets START
#------------------------------------------------- 
class dcta_widget extends WP_Widget {
		function __construct() {
			$widget_ops = array(
				'classname'   => 'diligent-callto-action',
				'description' => __( 'Displays Call to action Button.', 'dcta' ),
			);
			$control_ops = array(
				'id_base' => 'diligent-callto-action',
			);
			$this->WP_Widget( 'diligent-callto-action', __( 'Graffiti CTA for Plumbers', 'dcta' ), $widget_ops, $control_ops );
		}
		// Widget Backend 
		public function form( $instance ) {
			// Check values
			if( $instance) {
				$title = esc_attr($instance['title']);
				$ctaende = $instance['ctaende'];
				$ctatext = esc_attr($instance['ctatext']);
				$ctatext1 = esc_attr($instance['ctatext1']);
				//type of CTA image, Button, Text
				$CTAactiontype = esc_attr($instance['CTAactiontype']);
				
				//Text
				$CTAcontactno = esc_attr($instance['CTAcontactno']);
				//Button
				$CTAbuttontext = esc_attr($instance['CTAbuttontext']);
				$CTAbuttonlink = esc_attr($instance['CTAbuttonlink']);
				//Image
				$CTAimgoption = esc_attr($instance['CTAimgoption']);
				$CTAimagetxt = esc_attr($instance['CTAimagetxt']);
				$CTAcontactnotxt = esc_attr($instance['CTAcontactnotxt']);
				$CTAcustimage = esc_attr($instance['CTAcustimage']);
				
			} else {
				$title = '';
				$ctaende = '';
				$ctatext = '';
				$ctatext1 = '';
				//type of CTA image, Button, Text
				$CTAactiontype = '';
				//Text
				$CTAcontactno = '';
				//Button
				$CTAbuttontext = '';
				$CTAbuttonlink = '';
				//Image
				$CTAimgoption = '';
				$CTAimagetxt = '';
				$CTAcontactnotxt = '';
				$CTAcustimage = '';
			} // Widget admin form ?>
			
			<p>
				<label for="<?php echo $this->get_field_id('ctatitle'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
			</p><p>
				<label><input type="checkbox" name="<?php echo $this->get_field_name('ctaende'); ?>" <?php if($ctaende=='on') { echo 'checked="checked"'; } ?> />&nbsp;<?php _e('Enable CTA', 'wp_widget_plugin'); ?></label>
			</p><p>
				<label for="<?php echo $this->get_field_id('ctatext'); ?>"><?php _e('CTA Heading', 'wp_widget_plugin'); ?></label><br>
				<input type="text" name="<?php echo $this->get_field_name('ctatext'); ?>" value="<?php echo $ctatext; ?>" class="widefat" />
			</p><p>
				<label for="<?php echo $this->get_field_id('ctatext1'); ?>"><?php _e('CTA Sub Heading', 'wp_widget_plugin'); ?></label><br>
				<input type="text" name="<?php echo $this->get_field_name('ctatext1'); ?>" value="<?php echo $ctatext1; ?>" class="widefat" />
			</p><p>
				<label for="<?php echo $this->get_field_id('CTAactiontype'); ?>"><?php _e('CTA Action', 'wp_widget_plugin'); ?></label><br>
				<label><input type="radio" id="CTAContactId" name="<?php echo $this->get_field_name('CTAactiontype'); ?>" value="CTAContact" <?php if($CTAactiontype=='CTAContact') { echo 'checked="checked"'; } ?> />&nbsp;Contact No.</label>&nbsp;&nbsp;&nbsp;
				<label><input type="radio" id="CTAButtonId" name="<?php echo $this->get_field_name('CTAactiontype'); ?>" value="CTAButton" <?php if($CTAactiontype=='CTAButton') { echo 'checked="checked"'; } ?> />&nbsp;Button</label>&nbsp;&nbsp;&nbsp;
				<?php /*?><label><input type="radio" id="CTAImageId" name="<?php echo $this->get_field_name('CTAactiontype'); ?>" value="CTAImage" <?php if($CTAactiontype=='CTAImage') { echo 'checked="checked"'; } ?> />&nbsp;Image</label><?php */?>
			</p>
			<div id="DivContactNo" <?php if($CTAactiontype=='CTAContact') { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
				<p>
				  <label for="<?php echo $this->get_field_id('CTAcontactno'); ?>">
					<?php _e('CTA Contact No.', 'wp_widget_plugin'); ?>
				  </label>
				  <br>
				  <input type="text" name="<?php echo $this->get_field_name('CTAcontactno'); ?>" value="<?php echo $CTAcontactno; ?>" class="widefat" />
				</p>
			</div>
			<div id="DivButton" <?php if($CTAactiontype=='CTAButton') { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
				<p>
				  <label for="<?php echo $this->get_field_id('CTAbuttontext'); ?>">
					<?php _e('Button Text', 'wp_widget_plugin'); ?>
				  </label>
				  <br>
				  <input type="text" name="<?php echo $this->get_field_name('CTAbuttontext'); ?>" value="<?php echo $CTAbuttontext; ?>" class="widefat" />
				</p>
				<p>
				  <label for="<?php echo $this->get_field_id('CTAbuttonlink'); ?>">
					<?php _e('Button Link', 'wp_widget_plugin'); ?>
				  </label>
				  <br>
				  <input type="text" name="<?php echo $this->get_field_name('CTAbuttonlink'); ?>" value="<?php echo $CTAbuttonlink; ?>" class="widefat" />
				</p>
				
			</div>
			<div id="DivImage" <?php if($CTAactiontype=='CTAImage') { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
				<?php /*?><p>
				  <label for="<?php echo $this->get_field_id('CTAimagetxt'); ?>">
					<?php _e('CTA Image', 'wp_widget_plugin'); ?>
				  </label>
				  <br>
				  <select name="<?php echo $this->get_field_name('CTAimgoption'); ?>">
					<option value="<?php _e('CTA Realistic Woman', 'wp_widget_plugin'); ?>" <?php if($CTAimgoption=='CTA Realistic Woman') { echo "selected='selected'"; } ?> ><?php _e('CTA Realistic Woman', 'wp_widget_plugin'); ?></option>
					
				  </select>
				</p><?php */?>
				<p>
				  <label for="<?php echo $this->get_field_id('CTAcustimage'); ?>">
					<?php _e('OR Custom Image URL ', 'wp_widget_plugin'); ?>
				  </label>
				  <br>
				  <input type="url" name="<?php echo $this->get_field_name('CTAcustimage'); ?>" value="<?php echo $CTAcustimage; ?>" class="widefat" />
				</p>
				
				
				<p>
				  <label for="<?php echo $this->get_field_id('CTAcontactnotxt'); ?>">
					<?php _e('Contact No. ', 'wp_widget_plugin'); ?>
				  </label>
				  <br>
				  <input type="text" name="<?php echo $this->get_field_name('CTAcontactnotxt'); ?>" value="<?php echo $CTAcontactnotxt; ?>" class="widefat" />
				</p>
			</div>
			<?php 
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['ctaende'] = ( ! empty( $new_instance['ctaende'] ) ) ? strip_tags( $new_instance['ctaende'] ) : '';
			$instance['ctatext'] = ( ! empty( $new_instance['ctatext'] ) ) ? strip_tags( $new_instance['ctatext'] ) : '';
			$instance['ctatext1'] = ( ! empty( $new_instance['ctatext1'] ) ) ? strip_tags( $new_instance['ctatext1'] ) : '';
			//type of CTA image, Button, Text
			$instance['CTAactiontype'] = ( ! empty( $new_instance['CTAactiontype'] ) ) ? strip_tags( $new_instance['CTAactiontype'] ) : '';
			
			//Text
			$instance['CTAcontactno'] = ( ! empty( $new_instance['CTAcontactno'] ) ) ? strip_tags( $new_instance['CTAcontactno'] ) : '';
			//Button
			$instance['CTAbuttontext'] = ( ! empty( $new_instance['CTAbuttontext'] ) ) ? strip_tags( $new_instance['CTAbuttontext'] ) : '';
			$instance['CTAbuttonlink'] = ( ! empty( $new_instance['CTAbuttonlink'] ) ) ? strip_tags( $new_instance['CTAbuttonlink'] ) : '';
			//Image
			$instance['CTAimgoption'] = ( ! empty( $new_instance['CTAimgoption'] ) ) ? strip_tags( $new_instance['CTAimgoption'] ) : '';
			$instance['CTAimagetxt'] = ( ! empty( $new_instance['CTAimagetxt'] ) ) ? strip_tags( $new_instance['CTAimagetxt'] ) : '';
			
			$instance['CTAcontactnotxt'] = ( ! empty( $new_instance['CTAcontactnotxt'] ) ) ? strip_tags( $new_instance['CTAcontactnotxt'] ) : '';
			$instance['CTAcustimage'] = ( ! empty( $new_instance['CTAcustimage'] ) ) ? strip_tags( $new_instance['CTAcustimage'] ) : '';
			
			return $instance;
		}
		
		// Creating widget front-end
		// This is where the action happens
		public function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', $instance['title']);
			$ctaende = $instance['ctaende'];
			$ctatext = $instance['ctatext'];
			$ctatext1 = $instance['ctatext1'];
			//type of CTA image, Button, Text
			$CTAactiontype = $instance['CTAactiontype'];
			
			//Text
			$CTAcontactno = $instance['CTAcontactno'];
			//Button
			$CTAbuttontext = $instance['CTAbuttontext'];
			$CTAbuttonlink = $instance['CTAbuttonlink'];
			//Image
			$CTAimgoption = $instance['CTAimgoption'];
			$CTAimagetxt = $instance['CTAimagetxt'];
			$CTAcontactnotxt = $instance['CTAcontactnotxt'];
			$CTAcustimage = $instance['CTAcustimage'];
			
			// before and after widget arguments are defined by themes
			if ( ! empty( $title ) )
			echo "<div>".$args['before_title'].$title.$args['after_title']."</div>";
			
			if( $ctaende=='on' ) { 
				if($CTAactiontype=="CTAContact") { ?>
					<div class="cta_widget_body">
						<div>
							<p class="w600 whitetext mdem16 smem14 xsem14 lh140"><?php echo $ctatext; ?></p>
							<p class="w400 whitetext mdem12 smem12 xsem12 lh140"><?php echo $ctatext1; ?></p>
						</div><br />
						<p class="themeheading mdem18 themecolor w700"><?php echo $CTAcontactno; ?> </p>
					</div>
					<?php }
					if($CTAactiontype=="CTAButton") { ?>
					<div class="cta_widget_body">
						<div>
							 <p class="w600 whitetext mdem16 smem14 xsem14 lh140"><?php echo $ctatext; ?></p>
							 <p class="w400 whitetext mdem12 smem12 xsem12 lh140"><?php echo $ctatext1; ?></p>
						</div>
						<p class="w600 whitetext text-center mdem16 smem14 xsem14 lh160 margin_top6 sliderctabutton1"></p>
						<?php echo '<a href="'.$CTAbuttonlink.'" class="hcta_button mdem12 smem12 xsem12">'.$CTAbuttontext.'</a>' ?> 
					</div>
					<?php }
					if($CTAactiontype=="CTAImage") { ?>
					<style>
						.ctawidgetimage {
							<?php if($CTAcustimage=="") { ?>
								background-image:url(<?php echo bloginfo( 'stylesheet_directory' );?>/images/cta.png); <?php
							} else { ?>
								background-image:url(<?php echo $CTAcustimage; ?>);
							<?php } ?>
						}
					</style>
					<div class="cta_widget_body">
						<div class="ctawidgetimage">
							<p class="w600 text-center mdem14 smem13 xsem12 lh120"><?php echo $ctatext; ?></p>
							<p class="w400 text-center mdem12 smem11 xsem10 margin_top4 lh120"><?php echo $ctatext1; ?></p>
							<p class="w400 text-center mdem12 smem11 xsem10 margin_top6 lh120"><?php echo $CTAcontactnotxt ?></p>
						</div>
					</div>
				<?php } 
			}
			//Get Values of social links
			//echo "</div>";
		}
		
	} 
	//Add function 
	function dcta_load_widget() {
		register_widget( 'dcta_widget' );
	}
	add_action( 'widgets_init', 'dcta_load_widget' );
#------------------------------------------------- 
#				CTA Widgets ENDS
#------------------------------------------------- 





function get_team_search_query(){}
//end Team section
	require_once( get_theme_root() . '/Graffiti/theme-functions/theme-options.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-dashboard.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-addnewlead.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-analytics.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-cta.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-dashboard.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-footer.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-gmap.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-header.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-layout.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-lead.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-leadlist.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-mobilesite.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-nav.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-seo.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-slide-traders.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-slider.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-sm.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-typography.php' );
	require_once( get_theme_root() . '/Graffiti/theme-functions/page-responsesetting.php' );
	require_once( get_theme_root() . '/Graffiti/widgets.php' );
	require_once( get_theme_root() . '/Graffiti/shortcodes/sc.php' );

// Redirect to Graffiti Tab after Proficient theme activated
if (is_admin() && isset($_GET['activated'])){
	wp_redirect(admin_url("admin.php?page=theme-options.php&gr=1"));
}

//Create All Pages
function page_create_plumbers() {
	// Create Homepage
	$homepage = array('post_type' => 'page','post_title' => 'Home','post_content' => '[welcomearea][welcomecolumn][h2 content="About Us" align="left" class="themeheading"][/h2][h5 content="Welcome to (name of the company). We are here to provide you high quality plumbing services in (area of operation). We offer you reliable and fast plumbing repairing and installation services that best match your requirements.
	
We have a licensed team of technicians dedicated to give you authentic services. For any kind of plumbing issue, our team of qualified and experienced plumbers are ready to help you. We offer 24 hours emergency customer services, so you don’t have to waste your time by getting stuck up due to various plumbing problems." align="left" class="ptext"][/h5][readmore content="READ MORE" href="about-us"][/welcomecolumn][ctacolumn][lead_form][/ctacolumn][/welcomearea][servicearea][servicecontent][h2 align="left" class="sheading" content="Our Services"][/h2][h5 align="justify" content="(Name of the company) is committed to delivering the most affordable and high quality plumbing services. Our team of experienced plumbers and technicians provide the most satisfied residential and commercial plumbing services at a reasonable cost.

Once we diagnose the problem, our experts will solve it with best suited way for resolving it. We render our timely services at very affordable prices. Our center is a one-stop solution for solving all your plumbing problems that hamper daily routine activities. Along with above mentioned services, we look forward to help you in any kind of plumbing needs." class=""][/h5][readmore content="READ MORE" href="#"]
[/servicecontent]
[serviceposts]
[posts_services limit="6"]
[/serviceposts]
[/servicearea]
[portfolioarea][gallerycoulmn][h2 align="left" content="Our Work" class="u_themeheading"][custom_portfolio limit="4"][readmore content="VIEW MORE" href="#"][/gallerycoulmn][testicolumn][h2 align="left" content="Testimonials" class="u_themeheading"][custom_testimonials limit="3"][/testicolumn][/portfolioarea]',
				'post_status'   => 'publish',
				'post_author'   => 1
			); 
	// Insert the post into the database
	$homepage_id =  wp_insert_post( $homepage );
	// set this page as homepage
	update_option('page_on_front', $homepage_id);
	
	// create About Us Page
	$about = array('post_title' => 'About Us','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => '[h2 align="center" content="WHO WE ARE"][/h2][h6 align="center" content="Every day, we use our plumbing system in order to fulfil our daily requirements. If anything goes wrong, it hampers our daily routine to a great extent. Keeping the passion for providing comprehensive plumbing services, we started (name of the company) in (year of establishment) at (place).
	
We have highly qualified and licensed team of plumbers and technicians. Our experts understand your situation, give first priority to customers, schedule an appointment according to your convenience and provide best services in a very friendly manner."][/h6]
[h2 align="center" content="WHY CHOOSE US"][/h2][h6 align="center" content="Our plumbers work efficiently and neatly to provide best plumbing services as per industry standards. We have skilled professionals and provide timely and affordable services to our clients. 
 
We are highly transparent regarding our services. We always make our clients aware of our rates at the time they enquire for seeking services. (Name of the company) starts from the services at the basic level and we don’t stop until our clients are satisfied with our work.

Disposal of old and worn out things is done properly so that our clients don’t have to face the ugly piles of waste deposited outside their places. At end of every working day, we clean all the mess and provide our clients with hassle free repairs and plumbing work. 

From the beginning, we are offering high level and most affordable efficient plumbing services to our customers. We assure you to provide complete satisfaction and world class services in plumbing industry.
Our steady growth is the result of the commitment we make for providing with excellent plumbing services. (Name of the company) is available 24/7 for our clients. "][/h6]
[h2 align="center" content="OUR TEAM"][/h2]
[custom_team limit="3"]
');
	wp_insert_post($about);  
	// create Contact Page
	$contact = array('post_title' => 'Contact Us','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => '[colhalf][h5 content="Lorem ipsum dolor sit amet, eu nostrum incorrupte sea, ea his omnes possim evertitur, mundi graecis mediocritatem mei et. Est libris gloriatur id."][/h5][contact_us][/colhalf][colonefourth][h4 content="ADDRESS"][/h4]The Company Name Inc.
9870 St Vincent Place,
Glasgow, DC 45 Fr 45.[/colonefourth][colonefourth][h4 content="CONTACT INFO"][/h4]Telephone: +1 800 603 6035
FAX: +1 800 889 9898
E-mail: <a href=mailto:mail@demolink.org>mail@demolink.org</a>[/colonefourth][colhalf][gmap][/colhalf]
');
	wp_insert_post($contact);	
	
	// create Terms Page
	$terms = array('post_title' => 'Terms & Conditions','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => 'We work on the basic principle of not sharing your personal and professional information with any other person/ party/ business owner or enterprise. We make it a point to respect your privacy and not to disclose your credentials with someone else. The below mentioned points will help you to understand things in a better perspective-
	
	Terms and conditions:
	
	We assume that you have read and accepted all the terms and conditions stated here as follows:
	
	<h4>1.	Privacy Policy :</h4>
	We are highly dedicated to protect your privacy. Your information is confined to us and we do not share it with any third party. Our privacy policy is applicable for our products, site and services. We constantly review our services and data so that we can attain client satisfaction.
	Our authorized users can only access your information.
	
	<h4>2.	Confidentiality:</h4>
	We understand that your information is very important and we assure that it will be kept confidential and therefore will not be shared with the third party other than our authorized users.  The mails sent by the company will be related to our services which will be useful to the clients.
	
	<h4>3.	Cookies:</h4>
	Like any other interactive website, we also use cookies to retrieve your information for every visit made on the site. Cookies are used in some of the areas of the site to make it interactive and can be used with an ease by the client.
	
	<h4>4.	Notification of changes:</h4>
	The company reserves the rights for updating and changing terms and conditions from time to time as per its requirements. If there will be any changes in our privacy policy, it will be notified on the key pages of the site. If there would be any change in policy of using client information will be informed to the clients through e-mails and postal mails.
	
	<h4>5.	Copyright notice</h4>
	All the copyrights and other relevant intellectual property is reserved under company policies. Company’s logo, services and products all are registered and no misuse of the company information would be entertained.  
	
	We hereby assume that you have read and clearly understood the above mentioned points. In case of occurrence of any problem or unexplainable event, the laws of the state or town will be strictly followed. 
	');
	wp_insert_post($terms);  
	
	// create Sitemap Page
	$dentist_testi = array('post_title' => 'Sitemap','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => '');
	$d_testiid=wp_insert_post($dentist_testi);  
	add_post_meta( $d_testiid, '_wp_page_template', 'template/page-sitemap.php' );
	
	// create Testimonial Page
	$dentist_testimonial = array('post_title' => 'Testimonial','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => '');
	$testiid=wp_insert_post($dentist_testimonial);  
	add_post_meta( $testiid, '_wp_page_template', 'template/page-testimonial.php' );
	
	// create Services Page
	$dentist_services = array('post_title' => 'Services','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => '');
	$servicesid=wp_insert_post($dentist_services);  
	add_post_meta( $servicesid, '_wp_page_template', 'template/page-services.php' );
	
	// create Portfolio Page
	$portfolio = array('post_title' => 'Portfolio','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => '');
	$portid=wp_insert_post($portfolio);  
	add_post_meta( $portid, '_wp_page_template', 'template/page-portfolio.php' );
	
	// create Blog Page
	$blog = array('post_title' => 'Blog','post_status' => 'publish','post_type' => 'page','post_author' => 1,'post_content' => '');
	$blogid=wp_insert_post($blog);  
	add_post_meta( $blogid, '_wp_page_template', 'template/page-blog.php' );
	
	//Portfolio 1 Posts
	$dentist_port = array('post_title' => 'Portfolio 1','post_status' => 'publish','post_type' => 'portfolio','post_author' => 1,'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','guid'=>'');
	$d_port=wp_insert_post($dentist_port);  
	
	//Portfolio 2 Posts
	$dentist_port = array('post_title' => 'Portfolio 2','post_status' => 'publish','post_type' => 'portfolio','post_author' => 1,'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','guid'=>'');
	$d_port=wp_insert_post($dentist_port);  
	
	//Portfolio 3 Posts
	$dentist_port = array('post_title' => 'Portfolio 3','post_status' => 'publish','post_type' => 'portfolio','post_author' => 1,'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','guid'=>'');
	$d_port=wp_insert_post($dentist_port);  
	
	//Portfolio 4 Posts
	$dentist_port = array('post_title' => 'Portfolio 4','post_status' => 'publish','post_type' => 'portfolio','post_author' => 1,'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','guid'=>'');
	$d_port=wp_insert_post($dentist_port);  
	
	//Testimonial 1 Posts
	$dentist_testi = array('post_title' => 'Testimonial 1','post_status' => 'publish','post_type' => 'testimonial','post_author' => 1,'post_content' => 'I was very doubtful about calling (name of the company) for the plumbing problem occurred that night. I rang 2-3 plumbers but they didn’t responded satisfactorily. When I called (name of the company), they were quick in responding and their staff arrived at my place within a small time duration.
	
They searched for the leaking area and stopped the water flow to avoid flooding situation. They mended the broken pipe by replacing it. They were completely organized and also cleaned up all the mess in the night. 
The staff here is friendly, helpful and very efficient. The person who booked my appointment was also very courteous and replied me calmly. Best services I availed and are highly recommendable.
Thank you (name of the company) for the help you rendered without any hassle. Your skilled plumbers explained me the problem and advised me to stop water line in order to avoid flooding.  
','guid'=>'');
	$d_testi=wp_insert_post($dentist_testi);  
	add_post_meta( $d_testi, 'presenter_city', 'Newyork' );
	add_post_meta( $d_testi, 'presenter_country', 'USA' );
	
	//Testimonial 2 Posts
	$dentist_testi = array('post_title' => 'Testimonial 2','post_status' => 'publish','post_type' => 'testimonial','post_author' => 1,'post_content' => 'Just want to thank you for excellent plumbing services for my new house. The plumbing fixtures used are very attractive and are of high quality in order to enhance the beauty of our house.
	
(Name of the company) met me at my house and asked about my desire and demands regarding this project. They suggested me various options to choose from. 

They completed the work within the promised time without comprising on the quality. They helped me in getting finest accessories to complement with the furnishing of my house. 

The staff working at my house was very efficient and helpful. They assessed me in selecting fixture that were very affordable and are of good quality. The person at the reception is very polite and courteous in replying. 

(Name of the company) is quite affordable as they charged me approximately the same amount as that estimated earlier. Thank you again for the services and I would highly recommend you to others in pursuit of getting best services. 
','guid'=>'');
	$d_testi=wp_insert_post($dentist_testi);  
	add_post_meta( $d_testi, 'presenter_city', 'Newyork' );
	add_post_meta( $d_testi, 'presenter_country', 'USA' );
	
	//Testimonial 3 Posts
	$dentist_testi = array('post_title' => 'Testimonial 3','post_status' => 'publish','post_type' => 'testimonial','post_author' => 1,'post_content' => 'Feeling completely relaxed and happy with the excellent services received from (name of the company). It was a referral from one of my friends to avail their services in order to get best solutions. 
	
I met them and discussed the problems we were going through. They suggested me various options, designs and plans for my assistance. The thing I liked most is they gave importance to my choice and helped me to make right decision. 

(Name of the company) did an excellent job in a highly professional manner. They showed great attitude and were fully dedicated towards their work which helped me in getting excellent services. 

Their staff is fully experienced, prompt, efficient and affordable. The estimation that was provided did not exceed my budget. They completed their work within the promised time without creating any hassle. 
We are highly thankful to (name of the company) for doing such a pleasant work and would highly recommend it to others for getting authentic plumbing solutions.   
','guid'=>'');
	$d_testi=wp_insert_post($dentist_testi);
	add_post_meta( $d_testi, 'presenter_city', 'Newyork' );
	add_post_meta( $d_testi, 'presenter_country', 'USA' );
	
	
	//Services 1 Posts
	$dentist_services = array('post_title' => 'Water heaters installation and repairing','post_status' => 'publish','post_type' => 'services','post_author' => 1,'post_content' => 'If you want to install new water heater or facing any issue from existing water heater, we are here to help you. We will help you to choose correct water heater or provide you cost effective installation and repairing services.
	
Whatever service you choose, our trained and skilled staff is there to help you in every possible manner in installation or repairing process. We will remove the flaws in your existing device and will also provide you with new installation at affordable cost, if required. 
','guid'=>'');
	$d_services=wp_insert_post($dentist_services);  
	
	//Services 2 Posts
	$dentist_services = array('post_title' => 'Kitchen Plumbing','post_status' => 'publish','post_type' => 'services','post_author' => 1,'post_content' => 'There are variety of appliances that completely rely on plumbing. We help you in maintaining and installation of fixtures and appliances in your kitchen.
	
We have skilled and experienced staff that will help you in increasing the age of these appliances through proper maintenance. Our trained staff detects the leakages, clogs and even performs kitchen upgrades.
 
We even help you in installing new kitchen appliances like dish washers, ice makers, kitchen sink, garbage disposers, etc. 
','guid'=>'');
	$d_services=wp_insert_post($dentist_services);  
	
	//Services 3 Posts
	$dentist_services = array('post_title' => 'Residential Plumbing','post_status' => 'publish','post_type' => 'services','post_author' => 1,'post_content' => 'With (name of the company) you need not to worry about the plumbing issues. We inspect every problem with complete utmost attention and solve it with full confidence. We use latest technologies to diagnose the problems occurring deep inside the pipes. We use new equipment to resolve and clean the mess. 
	
Here at (name of the company) we have trained and licensed staff for resolving all the residential plumbing issues. We provide fast and efficient services for the emergency plumbing issues.
','guid'=>'');
	wp_insert_post($dentist_services);  
	
	//Services 4 Posts
	$dentist_services = array('post_title' => 'Clogged Drains and Toilet plumbing','post_status' => 'publish','post_type' => 'services','post_author' => 1,'post_content' => 'We help our client by cleaning clogged drains through latest technologies. Our skilled plumbers are there to fix problems related to running toilets, leaking toilets, broken tanks and bowls, and toilets that don’t flush properly. 
	
We have proper instruments for clearing drains and pipes from all the clogs and debris. After clearing and cleaning of clogged drains, we restore proper drainage system to avoid further problems. 
','guid'=>'');
	wp_insert_post($dentist_services);  
	
	//Services 5 Posts
	$dentist_services = array('post_title' => 'Sewer line Replacements','post_status' => 'publish','post_type' => 'services','post_author' => 1,'post_content' => 'If you are suspecting any blockage or damage in your sewer line, we are here to help you. At (name of the company), we have experts for doing sewer replacements.
	
We use latest technology to diagnose the problem through high resolution cameras and try out best solutions to respond to the problems. Whatever be the issue, from old and deteriorating pipes to pipes made with low quality materials, we are always there for your assistance.
','guid'=>'');
	wp_insert_post($dentist_services);  
	
	//Services 6 Posts
	$dentist_services = array('post_title' => 'Bathroom Plumbing','post_status' => 'publish','post_type' => 'services','post_author' => 1,'post_content' => 'Bathrooms are one of the important parts of your house which is connected with the plumbing service the most. We are here to help you in installation and maintenance of the fittings of your bathroom appliances like water tub, heaters, drains, dinks, etc.
	
Our staff helps you in installation and fitting of new faucets, pipelines and appliances for your new or renovated places. We are masters in maintenance of the plumbing system of bathroom and would guide you to keep it hassle free.  
','guid'=>'');
	wp_insert_post($dentist_services);  
	
	
	
	//Team 1 Post
	$dentist_services = array('post_title' => 'Member Name','post_status' => 'publish','post_type' => 'team','post_author' => 1,'post_content' => '  ','guid'=>'');
	$eventid=wp_insert_post($dentist_services);  
	add_post_meta( $eventid, 'member_designation', 'Plumber' );
	
	//Team 2 Post
	$dentist_services = array('post_title' => 'Member Name','post_status' => 'publish','post_type' => 'team','post_author' => 1,'post_content' => '  ','guid'=>'');
	$eventid=wp_insert_post($dentist_services);  
	add_post_meta( $eventid, 'member_designation', 'Plumber' );

	//Team 3 Post
	$dentist_services = array('post_title' => 'Member Name','post_status' => 'publish','post_type' => 'team','post_author' => 1,'post_content' => '  ','guid'=>'');
	$eventid=wp_insert_post($dentist_services);  
	add_post_meta( $eventid, 'member_designation', 'Plumber' );	
	
	 
}

?>