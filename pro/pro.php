<?php

namespace wprtsp;

//add_filter('wprtsp_cpt_defaults', 'wprtsppro_cpt_defaults');

function wprtsppro_cpt_defaults($defaults){
    /*
    $defaults = array(
        'general' => array(
            'show_on' => '2',
            'duration' => '4',
            'initial_popup_time' => '5',
            'subsequent_popup_time' => '15'
        ),
        'transactions' => array(
            'enable' => 1,
            'shop_type' => class_exists('Easy_Digital_Downloads') ?  'edd' : ( class_exists( 'WooCommerce' ) ?  'wooc' :  'generated' ),
            'show_on_mobile' => 1,
            'sound_notification' => 0,
            'sound_file' => 'salient.mp3', // quite-impressed.mp3, jubliation.mp3
            'play_count' => '1'
        ),
    );
    */
    $defaults['transactions']['sound_file'] = 'salient.mp3';
    $defaults['transactions']['play_count'] = 1; // 1 = first popup only, 2 = all notifications
    return $defaults;
}

//add_filter('wprtsp_general_meta','__return_false');
//add_filter('wprtsp_conversions_meta','__return_false');

add_action( 'wprtsp_general_meta_settings', __NAMESPACE__.'\wprtsppro_general_meta');

function wprtsppro_general_meta() {
    echo 'hello';
}
