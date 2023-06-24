<?php

/**
 * @author clarotm, mmbi18
 * @copyright 2022 Amirreza Heydari & mohammad bagheri & t-ma.ir devloper
 * @license GPL-2.0-or-later
 *
 * Plugin Name: Lazy Loading images & speed page
 * Plugin URI: https://t-ma.ir
 * Description: Prints "1401-04-20" in WordPress in image tag all
 * Version: 1.0
 * Author: Amirreza Heydari & mohammad bagheri
 * Author URI: https://clarotm.ir
 * License: GPL v2 or later
 */
function add_class_to_attachment_image($attr, $attachment) {
    $attr['class'] .= ' lozad ';
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'add_class_to_attachment_image', 10, 2);

add_action('wp_body_open', 'Lazy_loading_CT');
function Lazy_loading_CT()
{
?>

    <!--<head>-->
    <!--    <style>-->
    <!--        @font-face {-->
    <!--            font-family: Danapro;-->
    <!--            src: url("https://waregint.sirv.com/iseokar.ir/fonts/Dana-Regular.woff2")format("woff2");-->
    <!--            font-weight: 100;-->
    <!--            font-style: normal;-->
    <!--        }-->

    <!--        body {-->
    <!--            font-family: Danapro !important;-->
    <!--        }-->

    <!--        .post-title,-->
    <!--        .is-large,-->
    <!--        a,-->
    <!--        strong,-->
    <!--        h1,-->
    <!--        h2,-->
    <!--        h3,-->
    <!--        h4,-->
    <!--        h5,-->
    <!--        h6,-->
    <!--        p,-->
    <!--        li,-->
    <!--        ul,-->
    <!--        tr,-->
    <!--        td,-->
    <!--        table,-->
    <!--        span {-->
    <!--            font-family: Danapro !important;-->
    <!--        }-->
    <!--    </style>-->
    <!--</head>-->
    <?php //wp_enqueue_script( 'jquery' ); ?>
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
