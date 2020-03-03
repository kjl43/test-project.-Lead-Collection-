<?php $lead_options = get_option( 'olp_theme_lead_options' ); ?>
<div class="leadformbody">
        <div class="w600 mdem16 smem14 xsem13"><?php 
			echo $lead_options['icheadline']; ?>
        </div> 
	<div class="w400 margin_top1 mdem12 smem11 xsem11"><?php 
		echo $lead_options['icsubheadline']; ?>
    </div><?php
    # Get Last 2 Characters
	$aweber_listId = $lead_options['aweber_listId']; ?>
    <form method="post" action="https://www.aweber.com/scripts/addlead.pl">
        <input type="hidden" name="listname" value="awlist<?php echo $aweber_listId; ?>" />
        <input type="hidden" name="redirect" value="<?php echo $lead_options['aweber_rURL']; ?>" />
        <input type="hidden" name="meta_adtracking" value="custom form" />
        <input type="hidden" name="meta_message" value="1" /> 
        <input type="hidden" name="meta_required" value="name,email" /> 
        <input type="hidden" name="meta_forward_vars" value="0" /> 
        <input type="text" name="name" placeholder="Your Name" value="" />
        <input type="text" name="email" placeholder="Your Email" value="" />
        <?php if($lead_options['cf_mobile']=='mobile'.$aweber_listId) { ?>
        <input type="text" name="custom mobile" placeholder="Mobile Number" value="" maxlength="25" />
		<?php } if($lead_options['cf_message']=='message'.$aweber_listId) { ?>
        <textarea name="custom message"></textarea>
		<?php } ?>
        <input type="submit" name="submit" value='<?php if($lead_options['btntxt']!=""){echo $lead_options['btntxt'];} else {echo "Submit";} ?>' /> 
    </form> 
</div>