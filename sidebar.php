<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Graffiti
 * @since Graffiti 1.0
 */
$layout_options = get_option( 'olp_theme_layout_options' );
$mob_options = get_option( 'olp_theme_mob_options' );
?>

<div id="secondary" class="margin_top6">
<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( ! empty ( $description ) ) :
?>
<?php endif; ?>

<?php if ( has_nav_menu( 'secondary' ) ) : ?>
	<nav role="navigation" class="navigation site-navigation secondary-navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
	</nav>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>
</div>