<?php
if ( post_password_required() ) {
	return;
}
?>
<?php
function comment_validation_init() {
if(is_singular() && comments_open() ) { ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('#commentform').validate({
 
onfocusout: function(element) {
  this.element(element);
},
 
rules: {
  author: {
    required: true,
    minlength: 2
  },
 
  email: {
    required: true,
    email: true
  },
 
  comment: {
    required: true,
    minlength: 20
  }
},
 
messages: {
  author: "Please enter in your name.",
  email: "Please enter a valid email address.",
  comment: "A message of minimum 20 characters is required"
},
 
errorElement: "div",
errorPlacement: function(error, element) {
  element.after(error);
}
 
});
});
</script>
<?php
}
}
add_action('wp_footer', 'comment_validation_init');
?>

<div id="comments" class="comments-area">
<?php $args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="col-md-6 col-sm-6 col-xs-12 padding0"><div class="col-md-12 col-sm-12 col-xs-12 padding5"><p class="comment-form-author">' . '<input id="author" placeholder="*Your Name" name="author" class="comment-input form-control" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p></div>'
				,
			'email'  => '<div class="col-md-12 col-sm-12 col-xs-12 padding5"><p class="comment-form-email">' . '<input id="email" placeholder="*your-real-email@example.com" class="comment-input form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' /></p></div>',
			'url'    => '<div class="col-md-12 col-sm-12 col-xs-12 padding5"><p class="comment-form-url">' .
			 '<input id="url" name="url" class="comment-input form-control" placeholder="http://your-site-name.com" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div></div>'
		)
	),
	'comment_field' => '<div class="col-md-6 col-sm-6 col-xs-12 padding0"><p class="comment-form-comment">' .
		'<textarea id="comment" class="comment-input form-control" name="comment" placeholder="Let us know what you have to say:" cols="45" rows="7" aria-required="true"></textarea>' .
		'</p></div>',
    'comment_notes_after' => '',
    'title_reply' => '<div class="crunchify-text"> <h4 class="w300">Leave Comment:</h4></div>',
	'label_submit'=>__('Submit'),
	'class_submit' => 'clear block'
);
  ?>
<?php comment_form($args); ?>
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'graffiti' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h3>

		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'div',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</div><!-- .comment-list -->

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'graffiti' ); ?></p>
        
	<?php endif; ?>
	
</div><!-- .comments-area -->
