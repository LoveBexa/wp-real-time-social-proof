<?php

$wprtsp = WPRTSP::get_instance();
define('WPSPPROAPIURL', 'https://wp-social-proof.com/gaapi/');
remove_action( 'add_meta_boxes', array( $wprtsp,'add_meta_boxes' ));
remove_action( 'save_post', array( $wprtsp, 'save_meta_box_data' ));

add_action( 'add_meta_boxes', 'wpsppro_add_meta_boxes' );
add_action( 'save_post', 'wpsppro_save_meta_box_data' );
add_action( 'wprtsp_enabled', 'wpsppro_enabled', 10, 2 );
add_filter( 'wprtsp_sanitize', 'wpsppro_sanitize', 10, 2 );
add_filter( 'wprtsp_get_proof_data_ctas', 'wpsppro_get_proof_data_ctas', 10, 2 );
add_action( 'admin_enqueue_scripts', 'wpsppro_enqueue');
//add_action( 'wp_ajax_wprtsppro_save_gaprofile', 'wprtsppro_save_gaprofile' );
add_action( 'admin_init', 'wprtsppro_save_gaprofile' );
add_filter( 'wprtsp_cpt_defaults', 'wprtsppro_get_cpt_defaults');
//add_filter('wprtsp_get_proofs', 'wprtsppro_get_cpt_defaults');

add_filter( 'wprtsp_conversions_sound_notification_markup', 'wprtspro_conversions_sound_notification_markup', 10 , 2);
add_filter( 'wprtsp_sound_notification_file', 'wprtspro_sound_notification_file', 10 , 2);
add_filter( 'wprtsp_get_proof_data_hotstats_WooCommerce', 'wprtspro_hotstats_wooc', 10, 2);
add_filter( 'wprtsp_get_proof_data_hotstats_Easy_Digital_Downloads', 'wprtspro_hotstats_edd', 10, 2);

function wprtsppro_save_gaprofile(){
    //https://dev.converticacommerce.com/woocommerce-sandbox/wp-admin/post.php?post=204&action=edit&origin_nonce=4c990a9bb6&gaapi_accountid=107074057&gaapi_webpropertyid=159840733&gaapi_webpropertyua=UA-107074057-1&gaapi_profileid=161102233&wpsppro-action=oauth&success=1
    //llog('hello');
    
    
    if ( isset( $_REQUEST['wpsppro-action'] ) && $_REQUEST['wpsppro-action'] == 'oauth' ) {
        wp_verify_nonce( $_REQUEST['origin_nonce'], 'wprtsp_gaapi' );
        if( current_user_can('activate_plugins') 
        && isset($_REQUEST['success']) && $_REQUEST['success']
        && isset($_REQUEST['gaapi_accountid']) && $_REQUEST['gaapi_accountid']
        && isset($_REQUEST['gaapi_webpropertyid']) && $_REQUEST['gaapi_webpropertyid']
        && isset($_REQUEST['gaapi_webpropertyua']) && $_REQUEST['gaapi_webpropertyua']
        && isset($_REQUEST['gaapi_profileid']) && $_REQUEST['gaapi_profileid']
        ){
            //
            //wp_send_json(get_option('wpsppro_ga_profile'));
            $settings = array();
            $settings['ga_accountid'] = $_REQUEST['gaapi_accountid'];
            $settings['ga_webpropertyid'] = $_REQUEST['gaapi_webpropertyid'];
            $settings['ga_webpropertyua'] = $_REQUEST['gaapi_webpropertyua'];
            $settings['ga_profileid'] = $_REQUEST['gaapi_profileid'];
            update_option('wpsppro_ga_profile',$settings);
        }
        else {
            
        }
        //llog(get_edit_post_link($_REQUEST['post']) );
        wp_redirect( html_entity_decode( get_edit_post_link($_REQUEST['post']) ), 302 );
        //die();
    }
    
    if ( isset( $_REQUEST['wpsppro-action'] ) && $_REQUEST['wpsppro-action'] == 'revoke' && isset( $_REQUEST['success'] ) && $_REQUEST['success'] == '1' ) {
        delete_option('wpsppro_ga_profile');
    }
}

function wpsppro_enabled( $enabled, $settings ) {
   
    if( ! wp_is_mobile() ) { // we are on desktop
        if( $settings['conversions_enable'] || $settings['hotstats_enable'] || $settings['livestats_enable'] || $settings['ctas_enable'] ) {
            return true;
        }
        
    }
    else { //we are on mobile
        if( $settings['conversions_enable_mob'] || $settings['hotstats_enable_mob'] || $settings['livestats_enable_mob'] || $settings['ctas_enable_mob'] ) {
            return true;
        }
    }
    return $enabled;
}

function wpsppro_enqueue(){
    $screen = get_current_screen();
    
    if( $screen->post_type == 'socialproof' ) {
        $wprtsp = WPRTSP::get_instance();
        wp_enqueue_script( 'wprtsp-cpt-admin', $wprtsp->uri .'assets/wprtsp-cpt-admin.js', array('jquery'), null, true);
    }
}

function wpsppro_get_proof_data_ctas( $ctas, $settings) {
    $ctas = $settings['ctas'];
    return array_values($ctas);
    
}

function wprtspro_conversions_sound_notification_markup($markup, $settings){
    $wprtsp = WPRTSP::get_instance();
    return '<audio preload="auto" autoplay="true" src="' .  $wprtsp->uri .'pro/sounds/'.$settings['conversions_sound_notification_file'].'">Your browser does not support the <code>audio</code>element.</audio>';
}

function wpsppro_add_meta_boxes(){
    add_meta_box( 'social-proof-pro-general', __( 'General Settings', 'erm' ), 'wpsppro_general_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-conversions', __( 'Recent Conversions', 'erm' ), 'wpsppro_conversions_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-live', __( 'Live Visitors', 'erm' ), 'wpsppro_live_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-hot-stats', __( 'Hot Stats', 'erm' ), 'wpsppro_hot_stats_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-custom-message', __( 'Custom Calls To Actions', 'erm' ), 'wpsppro_ctas_meta_box', 'socialproof', 'normal');
}

function wprtspro_sound_notification_file($file, $settings){
    $wprtsp = WPRTSP::get_instance();
    return $wprtsp->uri .'pro/sounds/'.$settings['conversions_sound_notification_file'];
}

function wprtsppro_get_cpt_defaults($settings = array()){
    $wprtsp = WPRTSP::get_instance();
    
    $defaults = array(
        
        'general_show_on' => '1', // select
        'general_post_ids' => get_option( 'page_on_front'), // string
        'general_position' => 'bl', // select
        'general_badge_enable' => 1, // bool
        'general_initial_popup_time' => '5', // select
        'general_duration' => '4', // select
        'general_subsequent_popup_time' => '30', // select

        'conversions_enable' => 1, // bool
        'conversions_enable_mob' => 1, // bool
        'conversions_shop_type' => apply_filters('wprtsp_shop_type', class_exists('Easy_Digital_Downloads') ?  'Easy_Digital_Downloads' : ( class_exists( 'WooCommerce' ) ?  'WooCommerce' :  'Generated' )),
        'conversion_template_line1' => '{name} {location}',
        'conversion_template_line2' => '{action} {product} {time}',
        'conversion_generated_action' => 'subscribed to the',
        'conversion_generated_product' => 'newsletter',
        'conversions_sound_notification' => 0, // bool
        'conversions_sound_notification_file' => 'salient.mp3', // string
        'conversions_title_notification' => 0, // bool
        
        'livestats_enable' => 1, // bool
        'livestats_enable_mob' => 1, // bool
        'livestats_sound_notification' => 0, // bool
        'livestats_sound_notification_file' => 'salient.mp3', // string
        'livestats_title_notification' => 0, // bool

        'hotstats_enable' => 1,
        'hotstats_enable_mob' => 1,
        'hotstats_sound_notification' => 0, // bool
        'hotstats_sound_notification_file' => 'salient.mp3', // string
        'hotstats_title_notification' => 0, // bool
        'hotstats_timeframe' => 1,
        'hotstats_timeframes' => array(1, 2, 3, 7, 30, -1),

        'ctas_enable' => 1,
        'ctas_enable_mob' => 1,
        'ctas_sound_notification' => 1, // bool
        'ctas_sound_notification_file' => 'demonstrative.mp3', // string
        'ctas_title_notification' => 1, // bool
        'ctas' => array( array('title' => 'Offer just for you', 'message' => 'Get 15% discount with coupon INSERTCOUPONHERE')),

        'positions' => array('bl' => 'Bottom Left', 'br' => 'Bottom Right', 'c' => 'Center'),
        
        /* Additional routines */
        //'conversions_records' => $wprtsp->generate_cpt_records(array('conversions_transaction' => 'subscribed to the newsletter', 'conversions_transaction_alt' => 'registered for the webinar')),
    );

    return $defaults;
    //return wp_parse_args( $settings, $defaults );
}

function wpsppro_sanitize( $request ) {
    $defaults = wprtsppro_get_cpt_defaults();
    
    $settings = array();
    $request['general_show_on'] = array_key_exists('general_show_on', $request) ? sanitize_text_field( $request['general_show_on'] ) : $defaults['general_show_on'];
    $request['general_post_ids'] = array_key_exists('general_post_ids', $request)? sanitize_text_field( $request['general_post_ids'] ) : $defaults['general_post_ids'];
    $request['general_position'] = array_key_exists('general_position', $request)? sanitize_text_field( $request['general_position'] ) : $defaults['general_position'];
    $request['general_duration'] = array_key_exists('general_duration', $request)? sanitize_text_field( $request['general_duration'] ) : $defaults['general_duration'];
    $request['general_initial_popup_time'] = array_key_exists('general_initial_popup_time', $request)? sanitize_text_field( $request['general_initial_popup_time'] ) : $defaults['general_initial_popup_time'];
    $request['general_subsequent_popup_time'] = array_key_exists('general_subsequent_popup_time', $request)? sanitize_text_field( $request['general_subsequent_popup_time'] ) : $defaults['general_subsequent_popup_time'];
    $request['general_badge_enable'] = array_key_exists('general_badge_enable', $request) && $request['general_badge_enable'] ? 1 : 0;


    $request['conversions_enable'] = array_key_exists('conversions_enable', $request) && $request['conversions_enable'] ? 1 : 0;
    $request['conversions_enable_mob'] = array_key_exists('conversions_enable_mob',  $request) && $request['conversions_enable_mob'] ? 1 : 0;
    $request['conversions_title_notification'] = array_key_exists('conversions_title_notification', $request) && $request['conversions_title_notification'] ? 1 : 0;

    $request['conversions_shop_type'] = array_key_exists('conversions_shop_type', $request)?sanitize_text_field($request['conversions_shop_type'] ) : $defaults['general_post_ids'];
    $request['conversion_generated_action'] = array_key_exists('conversion_generated_action', $request)? sanitize_text_field( $request['conversion_generated_action'] ) : $defaults['conversion_generated_action'];
    $request['conversion_generated_product'] = array_key_exists('conversion_generated_product', $request)? sanitize_text_field( $request['conversion_generated_product'] ) : $defaults['conversion_generated_product'];
    
    $request['conversion_template_line1'] = array_key_exists('conversion_template_line1', $request) ? sanitize_text_field($request['conversion_template_line1']) :  $defaults['conversion_template_line1'];
    $request['conversion_template_line2'] = array_key_exists('conversion_template_line2', $request) ? sanitize_text_field($request['conversion_template_line2']) :  $defaults['conversion_template_line2'];

    $request['conversions_sound_notification'] = array_key_exists('conversions_sound_notification', $request) && $request['conversions_sound_notification'] ? 1 : 0;
    $request['conversions_sound_notification_file'] = array_key_exists('conversions_sound_notification_file', $request) ? sanitize_text_field($request['conversions_sound_notification_file'] ) : $defaults['conversions_sound_notification_file'];
    $request['general_badge_enable'] = array_key_exists('general_badge_enable', $request) && $request['general_badge_enable'] ? 1 : 0;

    $request['livestats_enable'] = array_key_exists('livestats_enable', $request) && $request['livestats_enable'] ? 1 : 0;
    $request['livestats_enable_mob'] = array_key_exists('livestats_enable_mob', $request) && $request['livestats_enable_mob'] ? 1 : 0;
    $request['livestats_title_notification'] = array_key_exists('livestats_title_notification', $request) && $request['livestats_title_notification'] ? 1 : 0;
    $request['livestats_sound_notification'] = array_key_exists('livestats_sound_notification', $request) && $request['livestats_sound_notification'] ? 1 : 0;
    $request['livestats_sound_notification_file'] = array_key_exists('livestats_sound_notification_file', $request) ? sanitize_text_field($request['livestats_sound_notification_file'] ) : $defaults['livestats_sound_notification_file'];

    $request['hotstats_enable'] = array_key_exists('hotstats_enable', $request) && $request['hotstats_enable'] ? 1 : 0;
    $request['hotstats_enable_mob'] = array_key_exists('hotstats_enable_mob', $request) && $request['hotstats_enable_mob'] ? 1 : 0;
    $request['hotstats_title_notification'] = array_key_exists('hotstats_title_notification', $request) && $request['hotstats_title_notification'] ? 1 : 0;
    $request['hotstats_sound_notification'] = array_key_exists('hotstats_sound_notification', $request) && $request['hotstats_sound_notification'] ? 1 : 0;
    $request['hotstats_sound_notification_file'] = array_key_exists('hotstats_sound_notification_file', $request) ? sanitize_text_field($request['hotstats_sound_notification_file'] ) : $defaults['hotstats_sound_notification_file'];
    $request['hotstats_timeframe'] = array_key_exists('hotstats_timeframe', $request) ? sanitize_text_field($request['hotstats_timeframe']) : $defaults['hotstats_timeframe'];
    
    $request['ctas_enable'] = array_key_exists('ctas_enable', $request) && $request['ctas_enable'] ? 1 : 0;
    $request['ctas_enable_mob'] = array_key_exists('ctas_enable_mob', $request) && $request['ctas_enable_mob'] ? 1 : 0;
    $request['ctas_title_notification'] = array_key_exists('ctas_title_notification', $request) && $request['ctas_title_notification'] ? 1 : 0;
    $request['ctas_sound_notification'] = array_key_exists('ctas_sound_notification', $request) && $request['ctas_sound_notification'] ? 1 : 0;
    $request['ctas_sound_notification_file'] = array_key_exists('ctas_sound_notification_file', $request) ? sanitize_text_field($request['ctas_sound_notification_file'] ) : $defaults['ctas_sound_notification_file'];

    if(array_key_exists('ctas', $request)) {
        $ctas = $request['ctas'];
        foreach($ctas as $cta => $value) {
        
            if(empty($value['title']) && empty($value['message'])) {
                unset($ctas[$cta]);
            }
        }
    }

    $request['ctas'] = isset($ctas)? array_values($ctas) : $defaults['ctas'];

    //$settings['conversions_records'] = array_key_exists('conversions_records');
    return $request;
}

function wpsppro_general_meta_box(){
    global $post;
    
    $wprtsp = WPRTSP::get_instance();
    wp_nonce_field( 'socialproof_meta_box_nonce', 'socialproof_meta_box_nonce' );
    if( apply_filters( 'wprtsp_general_meta', true ) ) {
    $settings = get_post_meta( $post->ID, '_socialproof', true );
    $defaults = wprtsppro_get_cpt_defaults();
    if(! $settings) {
        $settings = $defaults;
    }

    $settings = wpsppro_sanitize($settings);
    $show_on = $settings['general_show_on'];
    $post_ids = $settings['general_post_ids'];
    $duration = $settings['general_duration'];
    $initial_popup_time = $settings['general_initial_popup_time'];
    $subsequent_popup_time = $settings['general_subsequent_popup_time'];
    $general_position = $settings['general_position'];
    $general_badge_enable = $settings['general_badge_enable'];
    $positions_html = '';
    $positions = $defaults['positions'];

    $statevars = array(
        'origin_site_url' => get_site_url(),
        'origin_edit_url' => get_edit_post_link($post->ID),
        'origin_nonce' => wp_create_nonce( 'wprtsp_gaapi' ),
        'origin_notification_id' => $post->ID,
        'origin_ajaxurl' => admin_url( 'admin-ajax.php' )
    );

    $statevars = json_encode( $statevars );
    $statevars = strtr( base64_encode( $statevars ), '+/=', '-_,' );

    //$href = WPSPPROAPIURL . '?state=';
    //$href = WPSPPROAPIURL .'/?wppro_gaapi_authenticate=' . $statevars;

    foreach( $positions as $key=>$value ) {
        $positions_html .= '<option value="' . $key . '" ' . selected( $general_position, $key, false ) .'>'. preg_replace('/[^\da-z]/i',' ', $value) .'</option>';
    }
    //llog(unserialize('a:1:{s:54:"https://dev.converticacommerce.com/woocommerce-sandbox";a:3:{s:4:"code";s:89:"4/0gDZzaXv-6OP21UoKnGmCZxOS5a_6cOSKLD-Ob-odQXv08M02P2hruMDEmJMhX5wbtaPcIMDPpXJ8V6eYFxDLKY";s:12:"access_token";a:7:{s:12:"access_token";s:129:"ya29.GluRBgcsPPCg_ZvvUO6gTyE8VS3zOtpAYM9fEBRu8izpOPqZTpri7iGqx8UXEGb080Po4UuOO_l2IoRqvm3cULQdixjTgAexpEU2SjTT6CZH5EfjuSzFkS3pspNC";s:10:"expires_in";i:3600;s:13:"refresh_token";s:45:"1/8il5oiRVn5VM1UarT85lemBbxYlsRHAazpdYiaYsQPg";s:5:"scope";s:133:"https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/analytics.edit https://www.googleapis.com/auth/plus.me";s:10:"token_type";s:6:"Bearer";s:8:"id_token";s:910:"eyJhbGciOiJSUzI1NiIsImtpZCI6IjhhYWQ2NmJkZWZjMWI0M2Q4ZGIyN2U2NWUyZTJlZjMwMTg3OWQzZTgiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJhenAiOiI5NzM5MzM0ODcxOTctaGZrZGxpcDF1Z3RoamVyNmplbGM5NnFla2Rrczg5ZTAuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJhdWQiOiI5NzM5MzM0ODcxOTctaGZrZGxpcDF1Z3RoamVyNmplbGM5NnFla2Rrczg5ZTAuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJzdWIiOiIxMDExNjgwODY2MjYzNjM4NDQ4NDQiLCJlbWFpbCI6InZhcnVuMjFAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImF0X2hhc2giOiJzMzBnVWJDSkp1S2RjOVVKZ0ZtS0xnIiwiaWF0IjoxNTQ3NDE3NjkyLCJleHAiOjE1NDc0MjEyOTJ9.HkE_sbswtEqr2PphYVfCZcrO4IXaRKAFxBr5OlnErmlCNytavlVBjQCb3XmCwV-7Hrj4G7azZjV5ReY2TlSyme8B7bknPhX8jZjO6Af1sXlGQDJL7aF-uhSUE96LcHfTyhrkxwWGW36ufXbAxWjl3sR-w9_7Inc7qnD5VbD1vS_ebEU_-8hzUUq2cB2nmHTBFiDuEU0RNrykSXqjoildusBAuwBqsN82lw6t4UThNHH4GGk8ok6XIo3eUoHF7EdCCXXWa_WFX7eORKCjmn5GIHcWnzJVh_s9btHbr8ixdJkNzs0J2o_ZDnTcwRuKtguU2BjYi2TTU9Jpe4PHUbrDTA";s:7:"created";i:1547417692;}s:8:"userinfo";a:9:{s:3:"iss";s:27:"https://accounts.google.com";s:3:"azp";s:72:"973933487197-hfkdlip1ugthjer6jelc96qekdks89e0.apps.googleusercontent.com";s:3:"aud";s:72:"973933487197-hfkdlip1ugthjer6jelc96qekdks89e0.apps.googleusercontent.com";s:3:"sub";s:21:"101168086626363844844";s:5:"email";s:17:"varun21@gmail.com";s:14:"email_verified";b:1;s:7:"at_hash";s:22:"s30gUbCJJuKdc9UJgFmKLg";s:3:"iat";i:1547417692;s:3:"exp";i:1547421292;}}}'));
    $ga_profile = get_option( 'wpsppro_ga_profile' );
    if( $ga_profile ) {
        $ga_profile = $ga_profile['ga_webpropertyua'];
    }
    //llog( $statevars );
    //llog( json_decode( base64_decode( strtr( $statevars, '-_,', '+/=' ) ), true ) );
    //llog(WPSPPROAPIURL);
    ?>
    <table id="tbl_display" class="wprtsp_tbl wprtsp_tbl_display">
        <tr>
            <td colspan="2">
                <h3>Display</h3>
            </td>
        </tr>
        <tr>
            <td><label for="wprtsp_general_show_on">Google Analytics</label></td>
            <td><?php if( ! $ga_profile) { ?> <a class="button-primary" href="<?php echo WPSPPROAPIURL .'/?wppro_gaapi_authenticate=' . $statevars; ?>">Authenticate with Google Analytics</a> <?php } else { ?>Profile Active: <?php echo $ga_profile; ?><br /><a href="<?php echo WPSPPROAPIURL .'/?wppro_gaapi_revoke=' . $statevars; ?>" class="button-primary">Disconnect</a><?php } ?>
        </tr>
        <tr>
            <td><label for="wprtsp_general_show_on">Show On</label></td>
            <td><select id="wprtsp_general_show_on" name="wprtsp[general_show_on]">
                    <option value="1" <?php selected( $show_on, 1 ); ?> >Entire Site</option>
                    <option value="2" <?php selected( $show_on, 2 ); ?> >On selected posts / pages</option>
                    <option value="3" <?php selected( $show_on, 3 ); ?> >Everywhere except the following</option>
                </select>
        </tr>
         <tr id="post_ids_selector">
            <td><label for="wprtsp_general_post_ids">Enter Post Ids (comma separated)</label></td>
            <td><input type="text" class="widefat" <?php if($show_on == 1) {echo 'readonly';} ?> id="wprtsp_general_post_ids" name="wprtsp[general_post_ids]" value="<?php echo $post_ids; ?>"></td>
        </tr>
        <tr>
            <td><label for="wprtsp[general_position]">Position</label></td>
            <td><select id="wprtsp[general_position]" name="wprtsp[general_position]">
                    <?php echo $positions_html; ?>
                </select></td>
        </tr>
        <tr>
            <td><label for="wprtsp[general_badge_enable]">Enable verified badge?</label></td>
            <td><input id="wprtsp[general_badge_enable]" name="wprtsp[general_badge_enable]" type="checkbox" value="1" <?php checked( 1, $general_badge_enable, true); ?>/></td>
        </tr>
    </table>
    <table id="tbl_timings" class="wprtsp_tbl wprtsp_tbl_timings">
        <tr>
            <td colspan="2">
                <h3>Timing</h3>
            </td>
        </tr>
        <tr>
            <td><label for="wprtsp_general_duration">Duration of each notification</label></td>
            <td><input type="text" class="widefat" id="wprtsp_general_duration" name="wprtsp[general_duration]" value="<?php echo $duration; ?>"/>
        <tr>
            <td><label for="wprtsp_general_initial_popup_time">Delay before first notification</label></td>
            <td><select id="wprtsp_general_initial_popup_time" name="wprtsp[general_initial_popup_time]">
                    <option value="5" <?php selected( $initial_popup_time, 5 ); ?> >5</option>
                    <option value="15" <?php selected( $initial_popup_time, 15 ); ?> >15</option>
                    <option value="30" <?php selected( $initial_popup_time, 30 ); ?> >30</option>
                    <option value="60" <?php selected( $initial_popup_time, 60 ); ?> >60</option>
                    <option value="120" <?php selected( $initial_popup_time, 120 ); ?> >120</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="wprtsp_general_subsequent_popup_time">Delay between notifications</label></td>
            <td><select id="wprtsp_general_subsequent_popup_time" name="wprtsp[general_subsequent_popup_time]">
                    <option value="5" <?php selected( $subsequent_popup_time, 5 ); ?> >5</option>
                    <option value="15" <?php selected( $subsequent_popup_time, 15 ); ?> >15</option>
                    <option value="30" <?php selected( $subsequent_popup_time, 30 ); ?> >30</option>
                    <option value="60" <?php selected( $subsequent_popup_time, 60 ); ?> >60</option>
                    <option value="120" <?php selected( $subsequent_popup_time, 120 ); ?> >120</option>
                </select></td>
        </tr>
    </table>
    <script type="text/javascript">
    $( document ).ready(function() {
        $('#wprtsp_general_show_on').on('change',  function() {
            if($('#wprtsp_general_show_on').val() == 1 ) {
                $('#wprtsp_general_post_ids').attr('readonly', 'true');
            }
            else {
                $('#wprtsp_general_post_ids').removeAttr('readonly');
            }
        });
    });
    </script>
    <?php
    }
    else {
        do_action('wprtsp_general_meta_settings');
    }
}

function wpsppro_conversions_meta_box(){
    global $post;
    $wprtsp = WPRTSP::get_instance();

    $settings = get_post_meta($post->ID, '_socialproof', true);
    if(! $settings) {
        $settings = wprtsppro_get_cpt_defaults();
    }
    
    $settings = wpsppro_sanitize($settings);
    $conversions_enable = $settings['conversions_enable'];
    $conversions_enable_mob = $settings['conversions_enable_mob'];
    $conversions_title_notification = $settings['conversions_title_notification'];
    $conversions_shop_type = $settings['conversions_shop_type'];
    $conversion_generated_action = $settings['conversion_generated_action'];
    $conversion_generated_product = $settings['conversion_generated_product'];
    $conversion_template_line1 = $settings['conversion_template_line1'];
    $conversion_template_line2 = $settings['conversion_template_line2'];
    $conversions_sound_notification = $settings['conversions_sound_notification'];
    $conversions_sound_notification_file = $settings['conversions_sound_notification_file'];

    $files = array_diff(scandir($wprtsp->dir . 'pro/sounds'), array('.', '..'));

    $available_audio = '<select id="wprtsp_conversions_sound_notification_file" name="wprtsp[conversions_sound_notification_file]">';
    foreach ($files as $file ) {
       
        $available_audio .= '<option '. disabled( $conversions_sound_notification, false, false) .' value="'.$file.'" '. selected( $conversions_sound_notification_file, $file, false ) .'>'.ucwords(str_replace('-', ' ',explode('.', $file)[0])).'</option>';
    }
    $available_audio .= '</select>';
    

    $sources = array();
    if(class_exists('Easy_Digital_Downloads')) {
        $sources[] = 'Easy_Digital_Downloads';
    }
    if( class_exists( 'WooCommerce' ) ) {
        $sources[] = 'WooCommerce';
    }
    $sources[] = 'Generated';

    $sources_html = '';
    foreach($sources as $key=>$value) {
        $sources_html .= '<option value="' . $value . '" ' . selected( $conversions_shop_type, $value, false ) .'>'. preg_replace('/[^\da-z]/i',' ', $value) .'</option>';
    }
    
    
    ?>
    <table id="tbl_conversions" class="wprtsp_tbl wprtsp_tbl_conversions">
        <tr>
            <td colspan="2">
                <h3>Show recent conversions to visitors</h3>
            </td>
        </tr>
        <tr>
            <td><label for="wprtsp[conversions_enable]">Enable on Desktop</label></td>
            <td>
                <input id="wprtsp[conversions_enable]" name="wprtsp[conversions_enable]" type="checkbox" value="1" <?php checked( 1, $conversions_enable, true); ?>/>
            </td>
        </tr>
        <tr>
            <td><label for="wprtsp[conversions_enable_mob]">Enable on Mobile</label></td>
            <td>
                <input id="wprtsp[conversions_enable_mob]" name="wprtsp[conversions_enable_mob]" type="checkbox" value="1" <?php checked( 1, $conversions_enable_mob, true); ?>/>
            </td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_title_notification">Enable Title Notification</label></td>
            <td><input id="wprtsp_conversions_title_notification" name="wprtsp[conversions_title_notification]" type="checkbox" value="1" <?php checked( 1, $conversions_title_notification, true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_sound_notification">Enable Sound Notification</label></td>
            <td><input id="wprtsp_conversions_sound_notification" name="wprtsp[conversions_sound_notification]" type="checkbox" value="1" <?php checked( 1, $conversions_sound_notification, true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_sound_notification_file">Choose Audio</label></td>
            <td><?php echo $available_audio; ?><span id="conversions_audition_sound" class="dashicons-arrow-right dashicons"></span></td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_shop_type">Source</label></td>
            <td><select id="wprtsp_conversions_shop_type" name="wprtsp[conversions_shop_type]">
                    <?php echo $sources_html; ?>
                </select></td>
        </tr>
        <tr>
            <td>Template</td>
            <td>
                <label>Line 1: <input type="text" value="<?php echo $conversion_template_line1; ?>" name="wprtsp[conversion_template_line1]" class="widefat" /></label><br />
                <label>Line 2: <input type="text" value="<?php echo $conversion_template_line2; ?>" name="wprtsp[conversion_template_line2]" class="widefat"/></label>
            </td>
        </tr>
        <tr class="generated_transactions">
            <td><label for="wprtsp_conversion_generated_action">Action for Generated records</label></td>
            <td><input id="wprtsp_conversion_generated_action" <?php if($conversions_shop_type != 'Generated') {echo 'readonly';} ?> name="wprtsp[conversion_generated_action]" type="text" class="widefat" value="<?php echo $conversion_generated_action ?>" /></td>
        </tr>
        <tr class="generated_transactions">
            <td><label for="wprtsp_conversion_generated_product">Product for Generated records</label></td>
            <td><input id="wprtsp_conversion_generated_product" <?php if($conversions_shop_type != 'Generated') {echo 'readonly';} ?> name="wprtsp[conversion_generated_product]" type="text" class="widefat" value="<?php echo $conversion_generated_product ?>" /></td>
        </tr>
    </table>
    <script type="text/javascript">
    $( document ).ready(function() {
        $('#wprtsp_conversions_shop_type').on('change',  function() {
            if($('#wprtsp_conversions_shop_type').val() == 'Generated' ) {
                //$('#wprtsp_conversions_transaction').removeAttr('readonly');
                console.log('Generated');
                $('#wprtsp_conversion_generated_action').removeAttr('readonly');
                $('#wprtsp_conversion_generated_product').removeAttr('readonly');
            }
            else {
                console.log($('#wprtsp_conversions_shop_type').val());
                //$('#wprtsp_conversions_transaction').attr('readonly', 'true');
                $('#wprtsp_conversion_generated_action').attr('readonly', 'true');
                $('#wprtsp_conversion_generated_product').attr('readonly', 'true');
            }
        });
        $('#wprtsp_conversions_sound_notification').change(function() {
            if($('#wprtsp_conversions_sound_notification').prop('checked')) {
                $('#wprtsp_conversions_sound_notification_file option').each(function(){
                    if($(this).attr('disabled')) {
                        $(this).removeAttr('disabled');
                    }
                });
            }
            else {
                $('#wprtsp_conversions_sound_notification_file option').each(function(){
                    if(! $(this).attr('selected')) {
                        $(this).attr('disabled','true');
                    }
                });
            }
        });
        $('#conversions_audition_sound').click(function(){
            wprtsp_conversions_sound_preview = jQuery('#wprtsp_conversions_sound_preview').length ? jQuery('#wprtsp_conversions_sound_preview') : jQuery('<audio/>', {
                id: 'wprtsp_conversions_sound_preview'
            }).appendTo('body');
            if( ! $('#wprtsp_conversions_sound_notification').prop('checked')) {
                alert('Cannot play sound if Sound Notification is unchecked.');
                return;
            }
            
            jQuery('#wprtsp_conversions_sound_preview').attr('src','<?php echo $wprtsp->uri.'pro/sounds/' ?>' + jQuery('#wprtsp_conversions_sound_notification_file').val());
            document.getElementById("wprtsp_conversions_sound_preview").play(); 
        });
    });
    
    </script>
    <?php
}

function wpsppro_live_meta_box(){
    global $post;
    $wprtsp = WPRTSP::get_instance();

    $settings = get_post_meta($post->ID, '_socialproof', true);
    if(! $settings) {
        $settings = wprtsppro_get_cpt_defaults();
    }
    
    $settings = wpsppro_sanitize($settings);
    $livestats_enable = $settings['livestats_enable'];
    $livestats_enable_mob = $settings['livestats_enable_mob'];
    $livestats_title_notification = $settings['livestats_title_notification'];
    $livestats_sound_notification = $settings['livestats_sound_notification'];
    $livestats_sound_notification_file = $settings['livestats_sound_notification_file'];
    $available_audio = '<select id="wprtsp_livestats_sound_notification_file" name="wprtsp[livestats_sound_notification_file]">';
    $files = array_diff(scandir($wprtsp->dir . 'pro/sounds'), array('.', '..'));
    foreach ($files as $file ) {
        
        $available_audio .= '<option '. disabled( $livestats_sound_notification, false, false) .' value="'.$file.'" '. selected( $livestats_sound_notification_file, $file, false ) .'>'.ucwords(str_replace('-', ' ',explode('.', $file)[0])).'</option>';
    }
    $available_audio .= '</select>';
    ?>
    <table id="tbl_livestats" class="wprtsp_tbl wprtsp_tbl_livestats">
        <thead>
            <tr>
                <td colspan="2"><h3>Show number of live visitors</h3></td>
            </tr>
            <tr>
                <td>
                    <label for="wprtsp_livestats_enable">Enable on Desktop</label>
                </td>
                <td>
                    <input id="wprtsp_livestats_enable" name="wprtsp[livestats_enable]" type="checkbox" value="1" <?php checked( $livestats_enable, '1' , true); ?>/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="wprtsp_livestats_enable_mob">Enable on Mobile</label>
                </td>
                <td>
                    <input id="wprtsp_livestats_enable_mob" name="wprtsp[livestats_enable_mob]" type="checkbox" value="1" <?php checked( $livestats_enable_mob, '1' , true); ?>/>
                </td>
            </tr>
            <tr>
                <td><label for="wprtsp_livestats_title_notification">Enable Title Notification</label></td>
                <td><input id="wprtsp_livestats_title_notification" name="wprtsp[livestats_title_notification]" type="checkbox"
                        value="1" <?php checked( 1, $livestats_title_notification, true); ?>/></td>
            </tr>
            <tr>
                <td><label for="wprtsp_livestats_sound_notification">Enable Sound Notification</label></td>
                <td><input id="wprtsp_livestats_sound_notification" name="wprtsp[livestats_sound_notification]" type="checkbox"
                        value="1" <?php checked( 1, $livestats_sound_notification, true); ?>/></td>
            </tr>
            <tr>
                <td><label for="wprtsp_livestats_sound_notification_file">Choose Audio</label></td>
                <td>
                    <?php echo $available_audio; ?><span id="livestats_audition_sound" class="dashicons-arrow-right dashicons"></span></td>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
    $('#wprtsp_livestats_sound_notification').change(function() {
            if($('#wprtsp_livestats_sound_notification').prop('checked')) {
                $('#wprtsp_livestats_sound_notification_file option').each(function(){
                    if($(this).attr('disabled')) {
                        $(this).removeAttr('disabled');
                    }
                });
            }
            else {
                $('#wprtsp_livestats_sound_notification_file option').each(function(){
                    if(! $(this).attr('selected')) {
                        $(this).attr('disabled','true');
                    }
                });
            }
        });
        $('#livestats_audition_sound').click(function(){
            wprtsp_livestats_sound_preview = jQuery('#wprtsp_livestats_sound_preview').length ? jQuery('#wprtsp_livestats_sound_preview') : jQuery('<audio/>', {
                id: 'wprtsp_livestats_sound_preview'
            }).appendTo('body');
            if( ! $('#wprtsp_livestats_sound_notification').prop('checked')) {
                alert('Cannot play sound if Sound Notification is unchecked.');
                return;
            }
            
            jQuery('#wprtsp_livestats_sound_preview').attr('src','<?php echo $wprtsp->uri.'pro/sounds/' ?>' + jQuery('#wprtsp_livestats_sound_notification_file').val());
            document.getElementById("wprtsp_livestats_sound_preview").play(); 
        });
        </script>
    <?php
}

function wpsppro_hot_stats_meta_box(){
    global $post;
    $wprtsp = WPRTSP::get_instance();
    $defaults = wprtsppro_get_cpt_defaults();
    $settings = get_post_meta( $post->ID, '_socialproof', true );
    if(! $settings) {
        $settings = $defaults;
    }
    $settings = wpsppro_sanitize($settings);
    $hotstats_enable = $settings['hotstats_enable'];
    $hotstats_enable_mob = $settings['hotstats_enable_mob'];
    $hotstats_timeframe = $settings['hotstats_timeframe'];
    
    $hotstats_title_notification = $settings['hotstats_title_notification'];
    $hotstats_sound_notification = $settings['hotstats_sound_notification'];
    $hotstats_sound_notification_file = $settings['hotstats_sound_notification_file'];

    $timeframes = $defaults['hotstats_timeframes'];
    $positions_html = '';
    
    foreach($timeframes as $key) {
        if($key == -1) {
            $positions_html .= '<option value="' . $key . '" ' . selected( $hotstats_timeframe, $key, false ) .'>Lifetime</option>';
        }
        else {
            $positions_html .= '<option value="' . $key . '" ' . selected( $hotstats_timeframe, $key, false ) .'>' . $key . ' days</option>';
        }
    }

    $positions_html = '<select id="wprtsp_hotstats_timeframe" name="wprtsp[hotstats_timeframe]">'.$positions_html.'</select>';
    $files = array_diff(scandir($wprtsp->dir . 'pro/sounds'), array('.', '..'));
    $available_audio = '<select id="wprtsp_hotstats_sound_notification_file" name="wprtsp[hotstats_sound_notification_file]">';
    foreach ($files as $file ) {
        
        $available_audio .= '<option '. disabled( $hotstats_sound_notification, false, false) .' value="'.$file.'" '. selected( $hotstats_sound_notification_file, $file, false ) .'>'.ucwords(str_replace('-', ' ',explode('.', $file)[0])).'</option>';
    }
    $available_audio .= '</select>';
    ?>
    <table id="tbl_hotstats" class="wprtsp_tbl wprtsp_tbl_hotstats">
        <thead>
            <tr>
                <td colspan="2">
                    <h3>Show Conversion Milestones over a period of time.</h3>
                </td>

            </tr>
        </thead>
        <tr>
            <td><label for="wprtsp_hotstats_enable">Enable Hot Stats on Desktop</label></td>
            <td><input id="wprtsp_hotstats_enable" name="wprtsp[hotstats_enable]" type="checkbox" value="1" <?php checked( $hotstats_enable, '1' , true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_hotstats_enable_mob">Enable Hot Stats on Mobile</label></td>
            <td><input id="wprtsp_hotstats_enable_mob" name="wprtsp[hotstats_enable_mob]" type="checkbox" value="1" <?php checked( $hotstats_enable_mob, '1' , true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_hotstats_title_notification">Enable Title Notification</label></td>
            <td><input id="wprtsp_hotstats_title_notification" name="wprtsp[hotstats_title_notification]" type="checkbox"
                    value="1" <?php checked( 1, $hotstats_title_notification, true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_hotstats_sound_notification">Enable Sound Notification</label></td>
            <td><input id="wprtsp_hotstats_sound_notification" name="wprtsp[hotstats_sound_notification]" type="checkbox"
                    value="1" <?php checked( 1, $hotstats_sound_notification, true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_hotstats_sound_notification_file">Choose Audio</label></td>
            <td>
                <?php echo $available_audio; ?><span id="hotstats_audition_sound" class="dashicons-arrow-right dashicons"></span></td>
        </tr>
        <tr>
            <td>Show number of sales since</td>
            <td><?php echo $positions_html; ?></td>
        </tr>
        
    </table>
    <script type="text/javascript">
    $('#wprtsp_hotstats_sound_notification').change(function() {
            if($('#wprtsp_hotstats_sound_notification').prop('checked')) {
                $('#wprtsp_hotstats_sound_notification_file option').each(function(){
                    if($(this).attr('disabled')) {
                        $(this).removeAttr('disabled');
                    }
                });
            }
            else {
                $('#wprtsp_hotstats_sound_notification_file option').each(function(){
                    if(! $(this).attr('selected')) {
                        $(this).attr('disabled','true');
                    }
                });
            }
        });
        $('#hotstats_audition_sound').click(function(){
            wprtsp_hotstats_sound_preview = jQuery('#wprtsp_hotstats_sound_preview').length ? jQuery('#wprtsp_hotstats_sound_preview') : jQuery('<audio/>', {
                id: 'wprtsp_hotstats_sound_preview'
            }).appendTo('body');
            if( ! $('#wprtsp_hotstats_sound_notification').prop('checked')) {
                alert('Cannot play sound if Sound Notification is unchecked.');
                return;
            }
            
            jQuery('#wprtsp_hotstats_sound_preview').attr('src','<?php echo $wprtsp->uri.'pro/sounds/' ?>' + jQuery('#wprtsp_hotstats_sound_notification_file').val());
            document.getElementById("wprtsp_hotstats_sound_preview").play(); 
        });
        </script>
    <?php
}

function wpsppro_ctas_meta_box() {
    global $post;
    $wprtsp = WPRTSP::get_instance();

    $settings = get_post_meta($post->ID, '_socialproof', true);
    
    if(! $settings) {
        $settings = wprtsppro_get_cpt_defaults();
    }
    $defaults = wprtsppro_get_cpt_defaults();
    $settings = wpsppro_sanitize($settings);
    
    
    $ctas = $settings['ctas'];
    $ctas_enable =  $settings['ctas_enable'];
    $ctas_enable_mob =  $settings['ctas_enable_mob'];
    $ctas_title_notification = $settings['ctas_title_notification'];
    $ctas_sound_notification = $settings['ctas_sound_notification'];
    $ctas_sound_notification_file = $settings['ctas_sound_notification_file'];
    $available_audio = '<select id="wprtsp_ctas_sound_notification_file" name="wprtsp[ctas_sound_notification_file]">';
    $files = array_diff(scandir($wprtsp->dir . 'pro/sounds'), array('.', '..'));
    foreach ($files as $file ) {
        
        $available_audio .= '<option '. disabled( $ctas_sound_notification, false, false) .' value="'.$file.'" '. selected( $ctas_sound_notification_file, $file, false ) .'>'.ucwords(str_replace('-', ' ',explode('.', $file)[0])).'</option>';
    }
    $available_audio .= '</select>';
    ?>
    <table id="tbl_ctas" class="wprtsp_tbl wprtsp_tbl_ctas">
    <thead>
            <tr>
                <td colspan="2">
                    <h3>Add custom calls to action such as offers, discount coupons etc.</h3>
                </td>

            </tr>
        </thead>
        <tr>
            <td><label for="wprtsp_ctas_enable">Enable CTAs on Desktop</label></td>
            <td><input id="wprtsp_ctas_enable" name="wprtsp[ctas_enable]" type="checkbox" value="1" <?php checked( $ctas_enable, '1' , true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_ctas_enable_mob">Enable CTAs on Mobile</label></td>
            <td><input id="wprtsp_ctas_enable_mob" name="wprtsp[ctas_enable_mob]" type="checkbox" value="1" <?php checked( $ctas_enable_mob, '1' , true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_ctas_title_notification">Enable Title Notification</label></td>
            <td><input id="wprtsp_ctas_title_notification" name="wprtsp[ctas_title_notification]" type="checkbox"
                    value="1" <?php checked( 1, $ctas_title_notification, true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_ctas_sound_notification">Enable Sound Notification</label></td>
            <td><input id="wprtsp_ctas_sound_notification" name="wprtsp[ctas_sound_notification]" type="checkbox"
                    value="1" <?php checked( 1, $ctas_sound_notification, true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_ctas_sound_notification_file">Choose Audio</label></td>
            <td>
                <?php echo $available_audio; ?><span id="ctas_audition_sound" class="dashicons-arrow-right dashicons"></span></td>
        </tr>
    </table>
    <table id="ctas-fieldset-one" width="100%">
        <thead>
            <tr>
                <th width="40%">Title</th>
                <th width="40%">Call To Action</th>
                <th width="8%"></th>
            </tr>
        </thead>
        <tbody>
                <?php
               
                $count = count($ctas);
               
                for($i = 0 ; $i < $count; $i++) {
                    $elem = array_shift($ctas);
                    
                ?>
                    <tr>
                        <td><input type="text" class="widefat" name="wprtsp[ctas][<?php echo $i ?>][title]" value="<?php echo $elem['title']; ?>" /></td>
                        <td><input type="text" class="widefat" name="wprtsp[ctas][<?php echo $i ?>][message]" value="<?php echo $elem['message']; ?>" /></td>
                        <td><a class="button remove-row" href="#">Remove</a></td>
                    </tr>
                <?php
                
                }
                ?>
                <tr class="empty-row screen-reader-text">
                    <td><input type="text" id="ctas_title_empty" class="widefat" name="wprtsp[ctas][<?php echo $i ?>][title]" /></td>
                    <td><input type="text" id="ctas_message_empty" class="widefat" name="wprtsp[ctas][<?php echo $i ?>][message]" /></td>
                <td><a class="button remove-row" href="#">Remove</a></td>
            </tr>
        </tbody>
    </table>
    <p><a id="add-row" class="button" href="#">Add another</a></p>
    <script type="text/javascript">
    $( '#add-row' ).on('click', function() {
        $time = new Date().getTime();
            var row = $( '.empty-row.screen-reader-text' ).clone(true);
            row.removeClass( 'empty-row screen-reader-text' );
            row.insertBefore( '#ctas-fieldset-one tbody>tr:last' );
            $('#ctas_title_empty').attr('name', function(){$(this).removeAttr('id'); return 'wprtsp[ctas]['+$time+'][title]'});
            $('#ctas_message_empty').attr('name', function(){$(this).removeAttr('id');return 'wprtsp[ctas]['+$time+'][message]'});
            return false;
        });
        
        $( '.remove-row' ).on('click', function() {
            $(this).parents('tr').remove();
            return false;
        });
        $('#wprtsp_ctas_sound_notification').change(function() {
            if($('#wprtsp_ctas_sound_notification').prop('checked')) {
                $('#wprtsp_ctas_sound_notification_file option').each(function(){
                    if($(this).attr('disabled')) {
                        $(this).removeAttr('disabled');
                    }
                });
            }
            else {
                $('#wprtsp_ctas_sound_notification_file option').each(function(){
                    if(! $(this).attr('selected')) {
                        $(this).attr('disabled','true');
                    }
                });
            }
        });
        $('#ctas_audition_sound').click(function(){
            wprtsp_ctas_sound_preview = jQuery('#wprtsp_ctas_sound_preview').length ? jQuery('#wprtsp_ctas_sound_preview') : jQuery('<audio/>', {
                id: 'wprtsp_ctas_sound_preview'
            }).appendTo('body');
            if( ! $('#wprtsp_ctas_sound_notification').prop('checked')) {
                alert('Cannot play sound if Sound Notification is unchecked.');
                return;
            }
            
            jQuery('#wprtsp_ctas_sound_preview').attr('src','<?php echo $wprtsp->uri.'pro/sounds/' ?>' + jQuery('#wprtsp_ctas_sound_notification_file').val());
            document.getElementById("wprtsp_ctas_sound_preview").play(); 
        });
    </script>
    <?php
        llog($settings);
}

function wpsppro_save_meta_box_data($post_id) {
    //llog($_POST);
    //die();
    $wprtsp = WPRTSP::get_instance();
    
    if ( ! isset( $_POST['socialproof_meta_box_nonce'] ) ||
        ! wp_verify_nonce( $_POST['socialproof_meta_box_nonce'], 'socialproof_meta_box_nonce' ) ) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
   
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $settings = wpsppro_sanitize($_POST['wprtsp']);
    
    $settings = apply_filters('wprtsp_cpt_update_settings', $settings);
    //$settings['records'] = $wprtsp->generate_cpt_records($settings);
    //$wprtsp->generate_edd_records();
    //$wprtsp->generate_wooc_records();
   
    update_post_meta( $post_id, '_socialproof', $settings );
}

function wprtspro_hotstats_wooc( $hotstats = array(), $settings ) {
    
    if( ! class_exists('WooCommerce') ) {
        return false;
    }
    
    $value = $settings['hotstats_timeframe'];
    $period = ($value >= 0 ) ?  ( time() - ( $value * DAY_IN_SECONDS ))  : false;
    $args = array(
        'limit' => 100,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
        'status' => 'completed',
        
    );
    if($period) {
        $query['date_completed'] = $period;
    }
    $query = new WC_Order_Query( $args );
    $orders = $query->get_orders();
    $records =array(
        'sales' => array(
            'count' => count($orders),
            'action' => 'products sold',
        )
    );
    return $records;
}

function wprtspro_hotstats_edd( $hotstats , $settings ) {
    if(! class_exists('Easy_Digital_Downloads')){
        return array();
    }
    
    $value = $settings['hotstats_timeframe'];

    $period = ($value >= 0 ) ?  ( time() - ( $value * DAY_IN_SECONDS ))  : false;

    $strtime = $period ? 'in the last ' . $value . ' days.' : 'till date.' ;

    $args = array(
        'numberposts'      => 100,
        'post_status'      => 'publish',			
        'post_type'        => 'edd_payment',
        'suppress_filters' => true, 
        );

    if( $period )	 {
        $args['date_query'] = array(
                'after' => date('c', $period)
        );
    }
    //llog($args);
    $payments = new WP_Query( $args );			
    
    if ( $payments->post_count > 0 ) {
        //llog($payments);
        $hotstats[] = array(
            'line1' => $payments->post_count .' products sold',
            'line2' => $strtime,
        );
        wp_reset_postdata();
    }
    
    return $hotstats;
}


if(! function_exists('llog')) {
    function llog($str) {
        echo '<pre>';
        print_r($str);
        echo '</pre>';
    }
}