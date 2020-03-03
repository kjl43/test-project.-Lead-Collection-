<?php
	/*
	Template Name: Sitemap page
	*/
	get_header();
	$layout_options = get_option( 'olp_theme_layout_options' );
	$mob_options = get_option( 'olp_theme_mob_options' ); ?>
<div class="seperation"></div>
<div class="container sitemap contentbg whitebg">
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12"> 
                <h2 class="entry-title themecolor"><?php echo get_the_title(); ?></h2>
                <div class="col-md-4 col-sm-4 col-xs-12"> 
                    <?php
                    //get all category
                    echo '<h3 class="themecolor">Categories</h3>';
                    
                    $args = array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                    );
                    $categories = get_categories($args);
                    foreach($categories as $category) { 
                        echo '<p>&nbsp;<a href="' . get_category_link( $category->term_id ) . '">' . $category->name.'</a> ('.$category->count.')</p> ';
                    } 
                    
                    ?>
                </div> 
                <div class="col-md-4 col-sm-4 col-xs-12">                
                    <?php //Get all pages
                    echo '<h3 class="themecolor">Pages</h3>';
                    $args = array(
                        'orderby' => 'name',
                        'sort_column' => 'post_title',
                        'post_status' => 'publish'
                    );
                    $pages = get_pages($args); 
                    foreach ( $pages as $page ) {
                        echo '<p>&nbsp;<a href="' . get_page_link( $page->ID ) . '">' . $page->post_title.'</a></p> ';
                    } ?>
                
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">                
					<?php
                    echo '<h3 class="themecolor">Post</h3>';
                    
                    $args = array( 'category' => '', 'post_status' => 'publish' );
                    
                    $myposts = get_posts( $args );
                    foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                        <p>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </p>
                    <?php endforeach; 
                    wp_reset_postdata();?>
                    
                
                </div>
        	</div>       
        </div>
     <!--End row--> 
<?php
/*get_sidebar();*/
get_footer();