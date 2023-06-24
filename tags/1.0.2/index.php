<?php

/** 
 * @author clarotm, mmbi18
 * @copyright 2022 Amirreza Heydari & mohammad bagheri & t-ma.ir devloper 
 * @license GPL-2.0-or-later 
 * 
 * Plugin Name: Lazy Loading images & speed page
 * Plugin URI: https://t-ma.ir
 * Description: Prints "1401-04-20" in WordPress in image tag all
 * Version: 1.0.2
 * Author: Amirreza Heydari & mohammad bagheri
 * Author URI: https://clarotm.ir
 * License: GPL v2 or later 
 */

add_action('wp_body_open', 'Lazy_loading_CT');
function Lazy_loading_CT()
{
?>

    <head>
        <style>
            @font-face {
                font-family: Danapro;
                src: url("https://waregint.sirv.com/iseokar.ir/fonts/Dana-Regular.woff2")format("woff2");
                font-weight: 100;
                font-style: normal;
            }

            body {
                font-family: Danapro !important;
            }

            .post-title,
            .is-large,
            a,
            strong,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            li,
            ul,
            tr,
            td,
            table,
            span {
                font-family: Danapro !important;
            }
        </style>
    </head>
    <?php wp_enqueue_script('jquery', true); ?>
    <?php wp_enqueue_script('lozad', plugin_dir_url(__FILE__) . '/js/lozad.min.js', array(), '1.16.0', true); ?>
    <?php wp_enqueue_script('instant.page', plugin_dir_url(__FILE__) . '/js/instant.page.js', array(), '5.1.1', true); ?>
    <script type="text/javascript">
        function Lazy_loading_element_AH(e, i) {
            if (1 == e) {
                var t = document.querySelectorAll(i);
                for (let e = 0; e < t.length; e++) document.images[e].style.visibility = "hidden";
                setTimeout(() => {
                    for (let e = 0; e < t.length; e++) document.images[e].style.visibility = "visible"
                }, 50)
            } else
                for (let e = 0; e < images.length; e++) document.images[e].style.visibility = "visible"
        }
        Lazy_loading_element_AH(!0, "img"), $("img").addClass("lozad"), document.body.setAttribute("data-instant-intensity", "mousedown");
    </script>
<?php
}
