<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Graffiti
 * @since Graffiti 1.0
 */
get_header(); ?>
<div class="container whitebg">
<div class="row nfmargin">
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="page-content">
				<p align="center"><span class="themecolor mdem120 lh100 smem100 xsem80 w700">404</span> </p>
                <p align="center"><span class="mdem40 smem30 lh100 xsem20">PAGE NOT FOUND</span></p>
<p align="center" class="mdem14 smem13 xsem12">The page you are looking for doesn't exist.</p>

<div class="backhome col-md-4 col-md-offset-4 margin_top2 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">
<a href="<?php echo get_option('home'); ?>" class="mdem14 smem13 xsem13 backhome">Back to Home Page</a>
</div>
			</div><!-- .page-content -->

</div>
</div>
</div>
<?php
get_footer();