<?php
/*
Template Name: Portfolio Page
*/
get_header();
$post_options = get_option( 'olp_theme_options' ); 
 ?>
<div class="seperation"></div>
<div class="container paddingblock contentbg whitebg">
<div class="row">
		<?php 
        //for pagging 
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        
        //selector query
        query_posts( 
            array( 
                'post_type'=> 'portfolio',
                'posts_per_page' => 9, 
                'paged' => $paged 
            ) 
        );
        //selector query
        ?>
        
            
            

                
                <?php
                if ( have_posts() ) : ?>
                	<div class="col-md-12 col-sm-12 col-xs-12"><h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2></div><div class="col-md-12 col-sm-12 col-xs-12">
            <?php // Start the Loop.
                while ( have_posts() ) : the_post(); ?>
                    <div class="col-md-4 col-sm-4 col-xs-12 sameheight3c margin_top1 margin_bot2 hoverarea portfolio-posts"><a href="<?php echo get_permalink( get_the_ID() ); ?>">
	  
<?php
if ( has_post_thumbnail( $thumbnail->ID ) )
{
echo get_the_post_thumbnail( $thumbnail->ID, 'category-thumb',array( 'class'	=> "img-responsive center-block"));
}
else
{
?>	
<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/1000x600.png" class="img-responsive center-block" />
<?php
}
?>								
								
								 
	  </a><div class="w400 text-center margin_top3"><span class="mdem16 smem14 xsem15 w600"><?php echo get_the_title(); ?></span><br><span class="mdem12 smem10 xsem11 w400"><?php echo the_content(); ?></span><br /><br /><!--<a href="<?php //echo get_permalink( get_the_ID() ); ?>" class="read-more-services mdem13 smem13 xsem12">Read More</a>--></div></div>
      <?php get_template_part( 'content', get_post_format() ); ?>
      
                <?php endwhile; ?>
	</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
                                <nav>
                                    <ul class="pager">
                                        <li class="previous"><?php previous_posts_link( '<i class="glyphicon glyphicon-chevron-left"></i>' );?></li>
                                        <li class="next"><?php next_posts_link( '<i class="glyphicon glyphicon-chevron-right"></i>', $the_query->max_num_pages ); ?> </li>
                                    </ul>
                                </nav>
                            </div><?php
        else : // If no content, include the "No posts found" template.
            get_template_part( 'content', 'none' );
        endif; ?>
                
        
        
</div>
</div>
<?php
get_footer();
