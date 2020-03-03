<?php
	get_header();
	$social_options = get_option('olp_theme_social_options');
?>
<div class="seperation"></div>
<div class="container contentbg whitebg">
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="portfolio-posts">
                    
                    <?php // Start the Loop.
                        while ( have_posts() ) : the_post(); ?>
                            <div class="col-md-4 col-sm-4 col-xs-12 margin_top2">
							<?php 
                            if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                echo get_the_post_thumbnail( $thumbnail->ID, 'full',array( 'class'	=> "img-responsive center-block margin_top2"));
								
                            }else
								{
								?>
                     <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/300x300.png" class="img-responsive center-block margin_top2" />
                                <?php	
								} ?>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 margin_top1">
                                <div class="single-portfolio-title">
<h3 class="blog-posts-title margin_top2"><?php the_title(); ?></h3>
                                <div class="margin_top2">
                                <?php
					get_template_part( 'content', get_post_format() );
the_content();
					// If comments are open or we have at least one comment, load up the comment template.
					
			?>
            <div class="blog-post-footer whitetext margin_top2"><?php echo "Posted on ".get_the_date()." by ".get_the_author(); ?> | <i class="pe-so-wechat"></i> <?php comments_number( '0', '1', '% ' ); ?></div>
            
                                        <!-- Page Title --> 
                            <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                            <?php
                            if ( comments_open() || get_comments_number() ) {
                                comments_template();
                            } ?>
                            
                            
                	<div class="social_area1 margin_top4 margin_bot2">
                    <?php if($social_options['si_belowpost']==1) { ?>
                        <h3>Find Us On :</h3> <?php	
                        if($social_options['bpsmfb']==1) {
                            echo "<a href='$social_options[fblink]' class='' target='_blank'><i class='pe-so-facebook'></i></a> &nbsp; " ;
                        }
                        if($social_options['bpsmtw']==1) {
                            echo "<a href='$social_options[twlink]' class='' target='_blank'><i class='pe-so-twitter'></i></a> &nbsp; " ;
                        }
                        if($social_options['bpsmlin']==1) {
                            echo "<a href='$social_options[linlink]' class='' target='_blank'><i class='pe-so-linkedin'></i></a> &nbsp; " ;
                        }
                        if($social_options['bpsmyt']==1) {
                            echo "<a href='$social_options[ytlink]' class='' target='_blank'><i class='pe-so-youtube-1'></i></a> &nbsp; " ;
                        }
                        if($social_options['bpsmpin']==1) {
                            echo "<a href='$social_options[pinlink]' class='' target='_blank'><i class='pe-so-pinterest'></i></a> &nbsp; " ;
                        }
                        if($social_options['bpsmgp']==1) {
                            echo "<a href='$social_options[gplink]' class='' target='_blank'><i class='pe-so-google-plus'></i></a> &nbsp; " ;
                        }
                        if($social_options['bpsmig']==1) {
                            echo "<a href='$social_options[iglink]' class='' target='_blank'><i class='pe-so-instagram'></i></a> &nbsp; " ;
                        }
                    } ?>
                </div>
                            </div>
                                     
                                    
                                </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                	</div>
                
            </div>
        </div>
	</div>
<!-- #content --> 
<!-- #container -->

<?php
get_footer();
