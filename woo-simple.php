<?php
/**
 * Plugin Name: WooCommerce Simple Shop
 * Plugin URI: https://github.com/gagarinstudio/woo-simple
 * Description: Этот плагин упрощает ВуКоммерс и удаляет лишние табы и типы товара на странице добавления товаров. Так же убирает в подменю пункты: Атрибуты и Теги.
 * Version: 1.0.0
 * Author: Gagarin.Studio
 * Author URI: https://gagarin.studio/
 * Developer: Gagarin.Studio
 * Developer URI: https://gagarin.studio/
 *
 * Copyright: © 2019 Gagarin.Studio
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


    add_filter( 'product_type_selector', function ($types){
        unset( $types['grouped'] );
        unset( $types['external'] );
        unset( $types['variable'] );

        return $types;
    } );


    add_filter( 'product_type_options', '__return_empty_array' );


    add_filter( 'woocommerce_product_data_tabs', function ($tabs ){
        unset( $tabs ['shipping'] );
        unset( $tabs ['linked_product'] );
        unset( $tabs ['attribute'] );
        unset( $tabs ['variations'] );
        unset( $tabs ['advanced'] );

        return $tabs ;
    } );


    add_action( 'admin_menu', function (){
        //remove_submenu_page( 'themes.php', 'widgets.php' );
        remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
        remove_submenu_page( 'edit.php?post_type=product', 'product_attributes' );

    }, 999 );
}
