<?php
	/*
	Template Name: Blog Page
	*/
	get_header(); 
	$layout_options = get_option( 'olp_theme_layout_options' );
	$mob_options = get_option( 'olp_theme_mob_options' ); 
	$post_options = get_option( 'olp_theme_options' ); 
	if(!$post_options['postpage']=='') {
		$post_per_page = $post_options['postpage'];
	} else {
		$post_per_page = 4;
	}
	
	?>
    <div class="seperation"></div>
    <div class="container contentbg whitebg">
    <div class="row">
        	<?php  // the query
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $post_per_page,
			);
			$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$the_query = new WP_Query( $args ); 
			// query end and use multiple
			
			if($layout_options['laystyle']=='rsidebar') { ?>
				<div class="col-md-8 col-sm-8 col-xs-12">
                
					<?php if ( $the_query->have_posts() ) :  ?>
                    <h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            
                            
                            <div class="blog-posts">
                                <div class="col-md-4 col-sm-4 col-xs-12 padding0">
                                    <?php if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                        echo get_the_post_thumbnail( $thumbnail->ID, 'medium',array( 'class'	=> "img-responsive center-block"));
                                    } else { ?>
                                        <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/600x600.png" class="img-responsive center-block" />
                                    <?php } ?>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 padding0_xs">
                                <div class="blogblock">
                                <div class="blogcontent">
                                <div class="blog-posts-title margin_top1 mdem16 smem15 xsem14 w600"><?php the_title(); ?></div><?php the_excerpt(); ?></div> 
                                
                                <div class="blog-post-footer">
                                <div class="w600 whitetext col-md-9 col-sm-8 col-xs-12 padding0">Posted by <?php echo get_the_author(); ?> On <?php echo get_the_date(); ?> | <i class="pe-so-wechat"></i> <?php comments_number( '0', '1', '% ' ); ?></div><div class="w600 whitetext col-md-3 col-sm-4 margin_xs col-xs-12 padding0 text-right"><?php echo '<a class="read-more-theme" href="'.get_permalink( get_the_ID() ).'">READ MORE</a>'; ?></div>
                                
                                </div>
                                
                                </div>
                                </div>
                                
                                <?php get_template_part( 'content', get_post_format() );?>
                            </div>
                            
                            
                            <?php endwhile; 
                            
                            wp_reset_postdata();
                            // Custom query loop pagination
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php previous_posts_link( '<i class="glyphicon glyphicon-chevron-left"></i>' );?></li>
                                        <li class="next"><?php next_posts_link( '<i class="glyphicon glyphicon-chevron-right"></i>', $the_query->max_num_pages ); ?> </li>
                                    </ul>
                                </nav>
                            </div>
                        
                    <?php  else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
				</div>
                <div class="col-md-4 col-sm-4 col-xs-12 <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
                    <?php get_sidebar(); ?>
                </div>
			<?php }
			
			//left sidebar
			elseif($layout_options['laystyle']=='lsidebar') { ?>
            	<div class="col-md-4 col-sm-4 col-xs-12 <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
                    <?php get_sidebar(); ?>
                </div>
            	<div class="col-md-8 col-sm-8 col-xs-12">
                
					<?php if ( $the_query->have_posts() ) :  ?>
                    <h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            
                            
                            <div class="blog-posts">
                                <div class="col-md-4 col-sm-4 col-xs-12 padding0">
                                    <?php if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                        echo get_the_post_thumbnail( $thumbnail->ID, 'medium',array( 'class'	=> "img-responsive center-block"));
                                    } else { ?>
                                        <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/600x600.png" class="img-responsive center-block" />
                                    <?php } ?>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 padding0_xs">
                                <div class="blogblock">
                                <div class="blogcontent">
                                <div class="blog-posts-title margin_top1 mdem16 smem15 xsem14 w600"><?php the_title(); ?></div><?php the_excerpt(); ?></div> 
                                
                                <div class="blog-post-footer">
                                <div class="w600 whitetext col-md-9 col-sm-8 col-xs-12 padding0">Posted by <?php echo get_the_author(); ?> On <?php echo get_the_date(); ?> | <i class="pe-so-wechat"></i> <?php comments_number( '0', '1', '% ' ); ?></div><div class="w600 whitetext col-md-3 col-sm-4 margin_xs col-xs-12 padding0 text-right"><?php echo '<a class="read-more-theme" href="'.get_permalink( get_the_ID() ).'">READ MORE</a>'; ?></div>
                                
                                </div>
                                
                                </div>
                                </div>
                                
                                <?php get_template_part( 'content', get_post_format() );?>
                            </div>
                            
                            
                            <?php endwhile; 
                            
                            wp_reset_postdata();
                            // Custom query loop pagination
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php previous_posts_link( '<i class="glyphicon glyphicon-chevron-left"></i>' );?></li>
                                        <li class="next"><?php next_posts_link( '<i class="glyphicon glyphicon-chevron-right"></i>', $the_query->max_num_pages ); ?> </li>
                                    </ul>
                                </nav>
                            </div>
                        
                    <?php  else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
				</div>
                
            <?php } 
            elseif($layout_options['laystyle']=='llsidebar') { ?>
            	<div class="col-md-3 col-sm-3 col-xs-12  <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
					<?php get_sidebar(); ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
                	<?php get_sidebar('secondary'); ?>
                </div>
            	<div class="col-md-6 col-sm-6 col-xs-12">
                
					<?php if ( $the_query->have_posts() ) :  ?>
                    <h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            
                            
                            <div class="blog-posts">
                                <div class="col-md-4 col-sm-4 col-xs-12 padding0">
                                    <?php if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                        echo get_the_post_thumbnail( $thumbnail->ID, 'medium',array( 'class'	=> "img-responsive center-block"));
                                    } else { ?>
                                        <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/600x600.png" class="img-responsive center-block" />
                                    <?php } ?>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 padding0_xs">
                                <div class="blogblock">
                                <div class="blogcontent">
                                <div class="blog-posts-title margin_top1 mdem16 smem15 xsem14 w600"><?php the_title(); ?></div><?php the_excerpt(); ?></div> 
                                
                                <div class="blog-post-footer">
                                <div class="w600 whitetext col-md-8 col-sm-12 col-xs-12 padding0">Posted by <?php echo get_the_author(); ?> On <?php echo get_the_date(); ?> | <i class="pe-so-wechat"></i> <?php comments_number( '0', '1', '% ' ); ?></div><div class="w600 whitetext col-md-4 col-sm-12 col-xs-12 padding0 text-right"><?php echo '<br /><a class="read-more-theme" href="'.get_permalink( get_the_ID() ).'">READ MORE</a>'; ?></div>
                                
                                </div>
                                
                                </div>
                                </div>
                                
                                <?php get_template_part( 'content', get_post_format() );?>
                            </div>
                            
                            
                            <?php endwhile; 
                            
                            wp_reset_postdata();
                            // Custom query loop pagination
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php previous_posts_link( '<i class="glyphicon glyphicon-chevron-left"></i>' );?></li>
                                        <li class="next"><?php next_posts_link( '<i class="glyphicon glyphicon-chevron-right"></i>', $the_query->max_num_pages ); ?> </li>
                                    </ul>
                                </nav>
                            </div>
                        
                    <?php  else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
				</div>
                
            <?php } 
            elseif($layout_options['laystyle']=='rrsidebar') { ?>
            	<div class="col-md-6 col-sm-6 col-xs-12">
                
					<?php if ( $the_query->have_posts() ) :  ?>
                    <h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            
                            
                            <div class="blog-posts">
                                <div class="col-md-4 col-sm-4 col-xs-12 padding0">
                                    <?php if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                        echo get_the_post_thumbnail( $thumbnail->ID, 'medium',array( 'class'	=> "img-responsive center-block"));
                                    } else { ?>
                                        <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/600x600.png" class="img-responsive center-block" />
                                    <?php } ?>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 padding0_xs">
                                <div class="blogblock">
                                <div class="blogcontent">
                                <div class="blog-posts-title margin_top1 mdem16 smem15 xsem14 w600"><?php the_title(); ?></div><?php the_excerpt(); ?></div> 
                                
                                <div class="blog-post-footer">
                                <div class="w600 whitetext col-md-8 col-sm-12 col-xs-12 padding0">Posted by <?php echo get_the_author(); ?> On <?php echo get_the_date(); ?> | <i class="pe-so-wechat"></i> <?php comments_number( '0', '1', '% ' ); ?></div><div class="w600 whitetext col-md-4 col-sm-12 col-xs-12 padding0 text-right"><?php echo '<br /><a class="read-more-theme" href="'.get_permalink( get_the_ID() ).'">READ MORE</a>'; ?></div>
                                
                                </div>
                                
                                </div>
                                </div>
                                
                                <?php get_template_part( 'content', get_post_format() );?>
                            </div>
                            
                            
                            <?php endwhile; 
                            
                            wp_reset_postdata();
                            // Custom query loop pagination
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php previous_posts_link( '<i class="glyphicon glyphicon-chevron-left"></i>' );?></li>
                                        <li class="next"><?php next_posts_link( '<i class="glyphicon glyphicon-chevron-right"></i>', $the_query->max_num_pages ); ?> </li>
                                    </ul>
                                </nav>
                            </div>
                        
                    <?php  else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
				</div>
                <div class="col-md-3 col-sm-3 col-xs-12 <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
					<?php get_sidebar(); ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
                	<?php get_sidebar('secondary'); ?>
                </div>
            <?php } 
			
			
			
			
			
			
            elseif($layout_options['laystyle']=='bothsidebar') { ?>
            	<div class="col-md-3 col-sm-3 col-xs-12 <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
					<?php get_sidebar(); ?>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                
					<?php if ( $the_query->have_posts() ) :  ?>
                    <h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            
                            
                            <div class="blog-posts">
                                <div class="col-md-4 col-sm-4 col-xs-12 padding0">
                                    <?php if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                        echo get_the_post_thumbnail( $thumbnail->ID, 'medium',array( 'class'	=> "img-responsive center-block"));
                                    } else { ?>
                                        <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/600x600.png" class="img-responsive center-block" />
                                    <?php } ?>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 padding0_xs">
                                <div class="blogblock">
                                <div class="blogcontent">
                                <div class="blog-posts-title margin_top1 mdem16 smem15 xsem14 w600"><?php the_title(); ?></div><?php the_excerpt(); ?></div> 
                                
                                <div class="blog-post-footer">
                                <div class="w600 whitetext col-md-8 col-sm-12 col-xs-12 padding0">Posted by <?php echo get_the_author(); ?> On <?php echo get_the_date(); ?> | <i class="pe-so-wechat"></i> <?php comments_number( '0', '1', '% ' ); ?></div><div class="w600 whitetext col-md-4 col-sm-12 margin_xs col-xs-12 padding0 text-right"><?php echo '<br /><a class="read-more-theme" href="'.get_permalink( get_the_ID() ).'">READ MORE</a>'; ?></div>
                                
                                </div>
                                
                                </div>
                                </div>
                                
                                <?php get_template_part( 'content', get_post_format() );?>
                            </div>
                            
                            
                            <?php endwhile; 
                            
                            wp_reset_postdata();
                            // Custom query loop pagination
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php previous_posts_link( '<i class="glyphicon glyphicon-chevron-left"></i>' );?></li>
                                        <li class="next"><?php next_posts_link( '<i class="glyphicon glyphicon-chevron-right"></i>', $the_query->max_num_pages ); ?> </li>
                                    </ul>
                                </nav>
                            </div>
                        
                    <?php  else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
				</div>
                <div class="col-md-3 col-sm-3 col-xs-12 <?php if($mob_options['hidesidebar']==1){echo 'hidden-xs';} ?>">
					<?php get_sidebar('secondary'); ?>
                </div>
            <?php } 
			else { ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
                
					<?php if ( $the_query->have_posts() ) :  ?>
                    <h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2>
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            
                            
                            <div class="blog-posts">
                                <div class="col-md-3 col-sm-3 col-xs-12 padding0">
                                    <?php if ( has_post_thumbnail( $thumbnail->ID ) ) {
                                        echo get_the_post_thumbnail( $thumbnail->ID, 'medium',array( 'class'	=> "img-responsive center-block"));
                                    } else { ?>
                                        <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/600x600.png" class="img-responsive center-block" />
                                    <?php } ?>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12 padding0_xs">
                                <div class="blogblock">
                                <div class="blogcontent">
                                <div class="blog-posts-title margin_top1 mdem16 smem15 xsem14 w600"><?php the_title(); ?></div><?php the_excerpt(); ?></div> 
                                
                                <div class="blog-post-footer">
                                <div class="w600 whitetext col-md-10 col-sm-9 col-xs-12 padding0">Posted by <?php echo get_the_author(); ?> On <?php echo get_the_date(); ?> | <i class="pe-so-wechat"></i> <?php comments_number( '0', '1', '% ' ); ?></div><div class="w600 whitetext col-md-2 col-sm-3 margin_xs col-xs-12 padding0 text-right"><?php echo '<a class="read-more-theme" href="'.get_permalink( get_the_ID() ).'">READ MORE</a>'; ?></div>
                                
                                </div>
                                
                                </div>
                                </div>
                                
                                <?php get_template_part( 'content', get_post_format() );?>
                            </div>
                            
                            
                            <?php endwhile; 
                            
                            wp_reset_postdata();
                            // Custom query loop pagination
                            ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php previous_posts_link( '<i class="glyphicon glyphicon-chevron-left"></i>' );?></li>
                                        <li class="next"><?php next_posts_link( '<i class="glyphicon glyphicon-chevron-right"></i>', $the_query->max_num_pages ); ?> </li>
                                    </ul>
                                </nav>
                            </div>
                        
                    <?php  else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
				</div> <?php
				} 
			?>
    	</div>
  		<!--End row--> 
	</div>
	<!-- end of the loop -->

	<?php get_footer(); ?>