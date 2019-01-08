<?php

$wprtsp = WPRTSP::get_instance();

remove_action( 'add_meta_boxes', array( $wprtsp,'add_meta_boxes' ));
remove_action( 'save_post', array( $wprtsp, 'save_meta_box_data' ));

add_action( 'add_meta_boxes', 'wpsppro_add_meta_boxes' );
add_action( 'save_post', 'wpsppro_save_meta_box_data' );

add_filter('wprtsp_cpt_defaults', 'wprtsppro_cpt_defaults');

add_filter('wprtsp_conversions_sound_notification_markup', 'wprtspro_conversions_sound_notification_markup', 10 , 2);
add_filter('wprtsp__sound_notification_file', 'wprtspro_sound_notification_file', 10 , 2);

function wprtspro_conversions_sound_notification_markup($markup, $settings){
    $wprtsp = WPRTSP::get_instance();
    return '<audio preload="auto" autoplay="true" src="' .  $wprtsp->uri .'pro/sounds/'.$settings['conversions_sound_notification_file'].'">Your browser does not support the <code>audio</code>element.</audio>';
}

function wprtspro_sound_notification_file($file, $settings){
    $wprtsp = WPRTSP::get_instance();
    return $wprtsp->uri .'pro/sounds/'.$settings['conversions_sound_notification_file'];
}

function wprtsppro_get_cpt_defaults($defaults = array()){
    $wprtsp = WPRTSP::get_instance();
    
    $defaults = array(

        'general_show_on' => '1', // select
        'general_duration' => '4', // select
        'general_initial_popup_time' => '5', // select
        'general_subsequent_popup_time' => '30', // select
        'general_post_ids' => get_option( 'page_on_front'), // string

        'conversions_enable' => true, // bool
        'conversions_show_on_mobile' => true, // bool
        'conversions_shop_type' => class_exists('Easy_Digital_Downloads') ?  'Easy_Digital_Downloads' : ( class_exists( 'WooCommerce' ) ?  'WooCommerce' :  'Generated' ), // string
        'conversions_transaction' => 'subscribed to the newsletter', // string
        'conversions_transaction_alt' => 'registered for the webinar', // string
        
        'conversions_sound_notification' => false, // bool
        'conversions_sound_notification_file' => 'salient.mp3', // string
        'conversions_position' => 'bl', // select
        
        'positions' => array('bl' => 'Bottom Left', 'br' => 'Bottom Right', 'c' => 'Center'),
        'badge' => true, // bool

        /* Additional routines */
        'conversions_records' => $wprtsp->generate_cpt_records(array('conversions_transaction' => 'subscribed to the newsletter', 'conversions_transaction_alt' => 'registered for the webinar')),
    );

    return $defaults;
}


function wpsppro_sanitize( $request ) {
    $defaults = wprtsppro_get_cpt_defaults();
   
    $settings = array();
    $settings['general_show_on'] = array_key_exists('general_show_on' ,$request) ? sanitize_text_field($request['general_show_on'] ) : $defaults['general_show_on'];
    $settings['general_duration'] = array_key_exists('general_duration' ,$request)? sanitize_text_field($request['general_duration'] ) : $defaults['general_duration'];
    $settings['general_initial_popup_time'] = array_key_exists('general_initial_popup_time' ,$request)? sanitize_text_field($request['general_initial_popup_time'] ) : $defaults['general_initial_popup_time'];
    $settings['general_subsequent_popup_time'] = array_key_exists('general_subsequent_popup_time' ,$request)? sanitize_text_field($request['general_subsequent_popup_time'] ) : $defaults['general_subsequent_popup_time'];
    $settings['general_post_ids'] = array_key_exists('general_post_ids' ,$request)? sanitize_text_field($request['general_post_ids'] ) : $defaults['general_post_ids'];

    $settings['conversions_enable'] = array_key_exists('conversions_enable' , $request) && $request['conversions_enable'] ? true : false;
    $settings['conversions_show_on_mobile'] = array_key_exists('conversions_show_on_mobile' , $request) && $request['conversions_show_on_mobile'] ? true : false;
    $settings['conversions_shop_type'] = array_key_exists('conversions_shop_type' ,$request)?sanitize_text_field($request['conversions_shop_type'] ) : $defaults['general_post_ids'];
    $settings['conversions_transaction'] = array_key_exists('conversions_transaction' , $request)? sanitize_text_field( $request['conversions_transaction'] ) : $defaults['conversions_transaction'];
    $settings['conversions_transaction_alt'] = array_key_exists('conversions_transaction_alt' , $request)? sanitize_text_field( $request['conversions_transaction_alt'] ) : $defaults['conversions_transaction_alt'];
    $settings['conversions_position'] = array_key_exists('conversions_position' , $request)? sanitize_text_field( $request['conversions_position'] ) : $defaults['conversions_position'];
    $settings['conversions_sound_notification'] = array_key_exists('conversions_sound_notification' , $request) && $request['conversions_sound_notification'] ? true : false;
    $settings['conversions_sound_notification_file'] = array_key_exists('conversions_sound_notification_file' ,$request) ? sanitize_text_field($request['conversions_sound_notification_file'] ) : $defaults['conversions_sound_notification_file'];
    $settings['badge'] = array_key_exists('badge' , $request) && $request['badge'] ? true : false;

    //$settings['conversions_records'] = array_key_exists('conversions_records');
    return $settings;
}

function wpsppro_add_meta_boxes(){
    add_meta_box( 'social-proof-pro-general', __( 'General', 'erm' ), 'wpsppro_general_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-conversions', __( 'Conversions', 'erm' ), 'wpsppro_conversions_meta_box', 'socialproof', 'normal');
}

function wpsppro_general_meta_box(){
    global $post;
    
    $wprtsp = WPRTSP::get_instance();
    wp_nonce_field( 'socialproof_meta_box_nonce', 'socialproof_meta_box_nonce' );
    if( apply_filters( 'wprtsp_general_meta', true ) ) {
    $settings = get_post_meta( $post->ID, '_socialproof', true );
    //llog($settings);
    $show_on = $settings['general_show_on'];
    $post_ids = $settings['general_post_ids'];
    $duration = $settings['general_duration'];
    $initial_popup_time = $settings['general_initial_popup_time'];
    $subsequent_popup_time = $settings['general_subsequent_popup_time'];
    ?>
    <table id="tbl_display" class="wprtsp_tbl wprtsp_tbl_display">
        <tr>
            <td colspan="2">
                <h3>Display</h3>
            </td>
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
            <td><input type="text" class="widefat" <?php if($show_on == 1) {echo 'readonly="true"';} ?> id="wprtsp_general_post_ids" name="wprtsp[general_post_ids]" value="<?php echo $post_ids; ?>"></td>
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
    //llog($settings);
    $defaults = wprtsppro_get_cpt_defaults();
    $settings = wpsppro_sanitize($settings);
    //llog($settings);
    //$settings = wp_parse_args($settings, $defaults);
    $conversions_enable = $settings['conversions_enable'];
    $conversions_shop_type = $settings['conversions_shop_type'];
    $conversions_transaction = $settings['conversions_transaction'];
    $conversions_transaction_alt = $settings['conversions_transaction_alt'];
    $conversions_sound_notification = $settings['conversions_sound_notification'];
    $conversions_sound_notification_file = $settings['conversions_sound_notification_file'];

    $conversions_position = $settings['conversions_position'];

    $files = array_diff(scandir($wprtsp->dir . 'pro/sounds'), array('.', '..'));

    $available_audio = '<select id="wprtsp_conversions_sound_notification_file" name="wprtsp[conversions_sound_notification_file]">';
    foreach ($files as $file ) {
        $available_audio .= '<option value="'.$file.'" '. selected( $conversions_sound_notification_file, $file, false ) .'>'.ucwords(str_replace('-', ' ',explode('.', $file)[0])).'</option>';
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
    
    $positions_html = '';
    $positions = $defaults['positions'];
    foreach($positions as $key=>$value) {
        $positions_html .= '<option value="' . $key . '" ' . selected( $conversions_position, $key, false ) .'>'. preg_replace('/[^\da-z]/i',' ', $value) .'</option>';
    }
    ?>
    <table id="tbl_conversions" class="wprtsp_tbl wprtsp_tbl_conversions">
        <tr>
            <td colspan="2">
                <h3>Conversions</h3>
            </td>
        </tr>
        <tr>
            <td><label for="wprtsp[conversions_enable]">Enable</label></td>
            <td>
                <input id="wprtsp[conversions_enable]" name="wprtsp[conversions_enable]" type="checkbox" value="1" <?php checked( 1, $conversions_enable, true); ?>/>
            </td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_shop_type">Source</label></td>
            <td><select id="wprtsp_conversions_shop_type" name="wprtsp[conversions_shop_type]">
                    <?php echo $sources_html; ?>
                </select></td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_transaction">Transaction 1 for Generated Records</label></td>
            <td><input id="wprtsp_conversions_transaction" <?php if($conversions_shop_type != 'Generated') {echo 'readonly="true"';} ?> name="wprtsp[conversions_transaction]" type="text" class="widefat" value="<?php echo $conversions_transaction ?>" /></td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_transaction_alt">Transaction 2 for Generated Records</label></td>
            <td><input id="wprtsp_conversions_transaction_alt" <?php if($conversions_shop_type != 'Generated') {echo 'readonly="true"';} ?> name="wprtsp[conversions_transaction_alt]" type="text" class="widefat" value="<?php echo $conversions_transaction_alt ?>" /></td>
        </tr>
        <tr>
            <td><label for="wprtsp[conversions_position]">Position</label></td>
            <td><select id="wprtsp[conversions_position]" name="wprtsp[conversions_position]">
                    <?php echo $positions_html; ?>
                </select></td>
        </tr>
        <tr>
            <td><label for="wprtsp[conversions_sound_notification]">Enable Sound Notification</label></td>
            <td><input id="wprtsp[conversions_sound_notification]" name="wprtsp[conversions_sound_notification]" type="checkbox" value="1" <?php checked( 1, $conversions_sound_notification, true); ?>/></td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_sound_notification_file">Choose Audio</label></td>
            <td><?php echo $available_audio; ?></td>
        </tr>
    </table>
    <script type="text/javascript">
    $( document ).ready(function() {
        $('#wprtsp_conversions_shop_type').on('change',  function() {
            if($('#wprtsp_conversions_shop_type').val() == 'Generated' ) {
                $('#wprtsp_conversions_transaction').removeAttr('readonly');
                $('#wprtsp_conversions_transaction_alt').removeAttr('readonly');
            }
            else {
                $('#wprtsp_conversions_transaction').attr('readonly', 'true');
                $('#wprtsp_conversions_transaction_alt').attr('readonly', 'true');
            }
        });
    });
    
    </script>
    <?php
    llog($settings);
}

function wpsppro_save_meta_box_data($post_id){
    
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
    $settings['records'] = $wprtsp->generate_cpt_records($settings);
    $wprtsp->generate_edd_records();
    $wprtsp->generate_wooc_records();
    
    update_post_meta( $post_id, '_socialproof', $settings );
}

function wpsppro_wooc_timed_conversions( $period = false ) {

    $query = new WC_Order_Query( array(
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
        'status' => 'completed',
        'date_created' => '>' . ( time() - DAY_IN_SECONDS ),
    ) );

    $orders = $query->get_orders();
    return count($orders);
}

if(! function_exists('llog')) {
    function llog($str) {
        echo '<pre>';
        print_r($str);
        echo '</pre>';
    }
}