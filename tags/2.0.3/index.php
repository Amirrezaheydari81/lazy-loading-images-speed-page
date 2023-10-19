<?php

/**
 * @author clarotm, mmbi18
 * @copyright 2023 Amirreza Heydari & mohammad bagheri
 * @license GPL-2.0-or-later
 *
 * Plugin Name: Lazy Loading images & speed page
 * Plugin URI: https://clarotm.ir
 * Description: Optimize Loading all image website
 * Version: 2.0.3
 * Author: Amirreza Heydari & mohammad bagheri
 * Author URI: https://clarotm.ir
 * License: GPL v2 or later
 */
function add_class_to_attachment_image($attr, $attachment) {
    $attr['class'] .= ' lozad ';
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'add_class_to_attachment_image', 99, 2);

add_action('wp_body_open', 'Lazy_loading_CT');
function Lazy_loading_CT()
{
?>
    <?php wp_enqueue_script('lozad', plugin_dir_url(__FILE__) . '/js/lozad.min.js', array(), '1.16.0', false); ?>
    <?php wp_enqueue_script('instant.page', plugin_dir_url(__FILE__) . '/js/instant.page.js', array(), '5.1.1', false); ?>
<?php
}


add_action("wp_footer", "your_theme_adding_extra_attributes");

function your_theme_adding_extra_attributes(){
 ?>
    <script>
        let body = document.getElementsByTagName("body");
        body[0].setAttribute("data-instant-intensity", "mousedown");
    </script>
<?php
}
// ------------------------------------->
function add_meta_tags_ctm() {
    echo '<meta name="generator" content="سیستم تولید محتوا تیم کلارو">';
    echo '<meta name="DC.Publisher" content="clarotm website design company">';
}
add_action('wp_head', 'add_meta_tags_ctm');
// <-------------------------------------
function ctm_mdm_register_widgets() {
	global $wp_meta_boxes;
    wp_enqueue_style( 'ctm_rss_style', plugin_dir_url(__FILE__) . '/css/ctm-rss.css', array(), '1.0', 'all' );

	wp_add_dashboard_widget('widget_div_rss_ctm', __('چه خبر از تیم کلارو', 'ctm_mdm'), 'ctm_mdm_create_my_rss_box');
}
add_action('wp_dashboard_setup', 'ctm_mdm_register_widgets');
function ctm_mdm_create_my_rss_box() {

	// Get RSS Feed(s)
	include_once(ABSPATH . WPINC . '/feed.php');

	// My feeds list (add your own RSS feeds urls)
	$my_feeds = array(
				'https://clarotm.ir/feed',
				);

	// Loop through Feeds
	foreach ( $my_feeds as $feed) :

		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( $feed );
		if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly
		    // Figure out how many total items there are, and choose a limit
		    $maxitems = $rss->get_item_quantity( 3 );

		    // Build an array of all the items, starting with element 0 (first element).
		    $rss_items = $rss->get_items( 0, $maxitems );

		    // Get RSS title
		    $rss_title = '<a href="'.$rss->get_permalink().'" target="_blank">'.strtoupper( $rss->get_title() ).'</a>';
		endif;

		// Display the container
		echo '<div class="ctm-rss rss-widget">';
		echo '<strong class="ctm-rss-title"><span class="dashicons dashicons-editor-code icons-ctm"></span>'.$rss_title.'</strong>';
		echo '<hr/>';

		// Starts items listing within <ul> tag
		echo '<ul>';

		// Check items
		if ( $maxitems == 0 ) {
			echo '<li>'.__( 'مطلبی پیدا نشد', 'ctm_mdm').'.</li>';
		} else {
			// Loop through each feed item and display each item as a hyperlink.
			foreach ( $rss_items as $item ) :
				// Uncomment line below to display non human date
				//$item_date = $item->get_date( get_option('date_format').' @ '.get_option('time_format') );

				// Get human date (comment if you want to use non human date)
				$item_date = human_time_diff( $item->get_date('U'), current_time('timestamp')).' '.__( 'پیش', 'ctm_mdm' );

				// Start displaying item content within a <li> tag
				echo '<li class="ctm-rss-magale"> <span class="dashicons dashicons-admin-links icons-ctm"></span>';
				// create item link
				echo '<a class="ctm-rss-magale-link" href="'.esc_url( $item->get_permalink() ).'" title="'.$item->get_title().'">';
				// Get item title
				echo esc_html( $item->get_title() );
				echo '</a>';
				// Display date
				echo ' <span class="ctm-rss-magale-date">'.$item_date.'</span><br />';
				// Get item content
				$content = $item->get_content();
				// Shorten content
				$content = wp_html_excerpt($content, 100) . ' [...]';
				// Display content
				echo '<p>'.$content.'</p>';
				// End <li> tag
				echo '</li>';
			endforeach;
		}
		// End <ul> tag
		echo '</ul></div>';

	endforeach; // End foreach feed
}