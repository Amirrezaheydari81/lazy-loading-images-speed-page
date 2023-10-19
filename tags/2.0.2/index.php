<?php

/**
 * @author clarotm, mmbi18
 * @copyright 2023 Amirreza Heydari & mohammad bagheri
 * @license GPL-2.0-or-later
 *
 * Plugin Name: Lazy Loading images & speed page
 * Plugin URI: https://t-ma.ir
 * Description: Optimize Loading all image website
 * Version: 2.0.2
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

function add_meta_tags_ctm() {
    echo '<meta name="generator" content="سیستم تولید محتوا تیم کلارو">';
    echo '<meta name="DC.Publisher" content="clarotm website design company">';
}
add_action('wp_head', 'add_meta_tags_ctm');
