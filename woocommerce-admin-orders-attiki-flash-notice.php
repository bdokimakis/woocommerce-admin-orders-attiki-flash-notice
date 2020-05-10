<?php
/*
Plugin Name: Woocommerce Admin Orders Attiki Flash Notice
Version: 0.1
Author: Byron Dokimakis
Author URI: https://b.dokimakis.gr
*/

add_action('manage_shop_order_posts_custom_column', 'woocommerce_admin_orders_attiki_flash_notice', 10, 2);

function woocommerce_admin_orders_attiki_flash_notice($column) {
    global $post;
    switch ($column) {
        case 'order_number' :
			if (substr(get_post_meta($post->ID, '_billing_postcode', true), 0, 1) == '1' && get_post_meta($post->ID, '_billing_country', true) == 'GR') {
				echo "<span style='white-space: nowrap' class='redblink'>Παραγγελία εντός Αττικής</span>";
			}
        break;
    }
}

add_action('admin_head', 'woocommerce_admin_orders_attiki_flash_notice_admin_styles');
function woocommerce_admin_orders_attiki_flash_notice_admin_styles() {
  echo '<style>
    .post-type-shop_order tr.type-shop_order td.order_number { position: relative; }
    .post-type-shop_order tr.type-shop_order td.order_number .redblink { color: red; position: absolute; bottom: 0; animation: blinker 1s linear infinite; }
    @keyframes blinker {
          50% {
            opacity: 0;
          }
        }
  </style>';
}