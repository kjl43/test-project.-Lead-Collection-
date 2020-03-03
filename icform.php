<?php
$lead_options = get_option('olp_theme_lead_options');
?>

<div class="leadformbody">
	<div class="leadformbox">
        <div class="w600 mdem16 smem14 xsem13">
        	<?php echo $lead_options['icheadline']; ?>
        </div>


        
    </div>
    
    <div class="w400 margin_top1 mdem12 smem11 xsem11"><?php 
		echo $lead_options['icsubheadline']; ?>
    </div>

    <?php
		if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_lead") {
        	
			$leadName = isset($_POST['leadname']) ? $_POST['leadname'] : '';
			$leadEmail = isset($_POST['leademail']) ? $_POST['leademail'] : '';
			$leadMob = isset($_POST['leadmobile']) ? $_POST['leadmobile'] : '';
			$leadMsg = isset($_POST['leadmsg']) ? $_POST['leadmsg'] : '';
			$blogtime = current_time( 'mysql' ); 
			// Add the content of the form to $post as an array
            $lead_post = array(
                'post_title'    => $leadName,
                'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
                'post_type' => 'leadgen'  //'post',page' or use a custom post type if you want to
            );
			
            //save the new post
            $pid = wp_insert_post($lead_post); 
            //insert taxonomies
			
			add_post_meta($pid, '_lead_gen_name', $leadName, true) or update_post_meta($pid, '_lead_gen_name', $leadName);
            add_post_meta($pid, '_lead_gen_email', $leadEmail, true) or update_post_meta($pid, '_lead_gen_email', $leadEmail);
			add_post_meta($pid, '_lead_gen_mob', $leadMob, true) or update_post_meta($pid, '_lead_gen_mob', $leadMob);
            add_post_meta($pid, '_lead_gen_msg', $leadMsg, true) or update_post_meta($pid, '_lead_gen_msg', $leadMsg);
			add_post_meta($pid, '_lead_gen_time', $blogtime, true) or update_post_meta($pid, '_lead_gen_time', $blogtime);	
			
			wp_set_post_tags($pid, 'leadgen');	
			
			include("page-respos.php");
			echo autorespondermail($leadEmail);
			do_action('wp_insert_post', 'wp_insert_post');
		}
		
	?>
    <script>
	function check_lead_entry()
	{
		if(document.getElementById("mail_count").value=='1')
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	</script>
    <form action="" enctype="multipart/form-data" method="post"  onsubmit="return check_lead_entry();">
        <table class="topmargin7" width="100%">
        <?php if($lead_options['icname']==1){ ?>
            <tr>
            	<td colspan="2"><input type="text" class="form-control" placeholder="Name" name="leadname" /></td>
            </tr>
        <?php } 
		if($lead_options['icemail']==1){ ?>
            <tr>
<td colspan="2"><input type="email" class="form-control" placeholder="Email" name="leademail" id="leademail" onkeyup="datacheck()" onchange="datacheck()" autocomplete="off" /></td>
            </tr>
						<script>
function datacheck()
{
var str=document.getElementById("leademail").value;
if (str == "") {
document.getElementById("chk").innerHTML = "";
return;
} else { 
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
} else {
// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
document.getElementById("chk").innerHTML = xmlhttp.responseText;
}
}

xmlhttp.open("GET","<?php echo get_template_directory_uri() ?>/theme-functions/ajax-email-check.php?q="+str,true);
xmlhttp.send();
}
}
</script>
			
			
			
			
        <?php } 
		if($lead_options['icmobile']==1){ ?>
            <tr>
            	<td colspan="2"><input type="text" class="form-control" placeholder="Phone No." name="leadmobile" /></td>
            </tr>
        <?php } 
		if($lead_options['icdesc']==1){ ?>
            <tr>
            	<td colspan="2"><textarea class="form-control" rows="4" placeholder="Message" name="leadmsg"></textarea></td>
            </tr>
        <?php } 
		if($lead_options['icname']!="" or $lead_options['icemail']!="" or $lead_options['icmobile']!="" or $lead_options['icdesc']!="") { ?>
            <tr>
                <td colspan="2" align=""><input type="submit" value="<?php echo $lead_options['btntxt']; ?>" class="reset" /></td>
                
            </tr>
            <tr><td colspan="2"><span id="chk" style="color:#E67E22;font-size:12px;color:#fff"><input type="hidden" value="0" id="mail_count" /></span></td></tr>
          	<input type="hidden" name="action" value="new_lead" />
			<?php wp_nonce_field( 'new-post' ); ?>
        <?php } ?>
        </table>
        
    </form>
    </div>
