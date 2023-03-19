<?php

/**
 * Plugin Name: Conditional product Filtering
 * Plugin URI: https://github.com/mahmudhaisan/
 * Description: Conditional product Filtering
 * Author: Mahmud haisan
 * Author URI: https://github.com/mahmudhaisan
 * Developer: Mahmud Haisan
 * Developer URI: https://github.com/mahmudhaisan
 * Text Domain: conditional-product-filtering
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {
    die('are you cheating');
}

define("PLUGINS_PATHS_ASSETS", plugin_dir_url(__FILE__) . 'assets/');
define("PLUGINS_PATHS", plugin_dir_url(__FILE__) . '');

function users_conditional_product_filtering_enqueue_files()
{

    wp_enqueue_style('conditional_product_filtering-style', PLUGINS_PATHS_ASSETS . 'css/style.css');
    wp_enqueue_script('conditional_product_filtering-jquery', PLUGINS_PATHS_ASSETS . 'js/script.js', array('jquery'));
}

add_filter('pre_get_posts', 'filter_search', 9999, 1);
function filter_search($query)
{

    // getting query string value
    $query_para = $_GET['cat'];

    //query only when search from front-end
    if ($query_para == 'new' && is_main_query()) {
        $tax_query = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => array(30), // term id
                'operator' => 'IN',

            ),
        );

        // setting tax query
        $query->set('tax_query', $tax_query);

    }

}
