<?php

$wprtsp = WPRTSP::get_instance();

remove_action( 'add_meta_boxes', array( $wprtsp,'add_meta_boxes' ));
remove_action( 'save_post', array( $wprtsp, 'save_meta_box_data' ));

add_action( 'add_meta_boxes', 'wpsppro_add_meta_boxes' );
add_action( 'save_post', 'wpsppro_save_meta_box_data' );

add_filter('wprtsp_cpt_defaults', 'wprtsppro_get_cpt_defaults');
//add_filter('wprtsp_get_proofs', 'wprtsppro_get_cpt_defaults');

add_filter('wprtsp_conversions_sound_notification_markup', 'wprtspro_conversions_sound_notification_markup', 10 , 2);

add_filter('wprtsp_sound_notification_file', 'wprtspro_sound_notification_file', 10 , 2);

add_filter('wprtsp_get_proof_data_hotstats_WooCommerce', 'wprtspro_hotstats_wooc', 10, 2);

function wprtspro_conversions_sound_notification_markup($markup, $settings){
    $wprtsp = WPRTSP::get_instance();
    return '<audio preload="auto" autoplay="true" src="' .  $wprtsp->uri .'pro/sounds/'.$settings['conversions_sound_notification_file'].'">Your browser does not support the <code>audio</code>element.</audio>';
}

function wpsppro_add_meta_boxes(){
    add_meta_box( 'social-proof-pro-general', __( 'General Settings', 'erm' ), 'wpsppro_general_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-conversions', __( 'Recent Conversions', 'erm' ), 'wpsppro_conversions_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-live', __( 'Live Visitors', 'erm' ), 'wpsppro_live_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-hot-stats', __( 'Hot Stats', 'erm' ), 'wpsppro_hot_stats_meta_box', 'socialproof', 'normal');
    add_meta_box( 'social-proof-pro-custom-message', __( 'Custom Calls To Actions', 'erm' ), 'wpsppro_custom_info_meta_box', 'socialproof', 'normal');
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
        'general_badge_enable' => true, // bool
        'general_initial_popup_time' => '5', // select
        'general_duration' => '4', // select
        'general_subsequent_popup_time' => '30', // select

        'conversions_enable' => true, // bool
        'conversions_enable_mob' => true, // bool
        
        'conversions_shop_type' => class_exists('Easy_Digital_Downloads') ?  'Easy_Digital_Downloads' : ( class_exists( 'WooCommerce' ) ?  'WooCommerce' :  'Generated' ), // string
        'conversions_transaction' => 'subscribed to the newsletter', // string
        'conversions_transaction_alt' => 'registered for the webinar', // string
        
        'conversions_sound_notification' => false, // bool
        'conversions_sound_notification_file' => 'salient.mp3', // string
        
        'conversions_title_notification' => false, // bool
        
        
        'positions' => array('bl' => 'Bottom Left', 'br' => 'Bottom Right', 'c' => 'Center'),
        
        /* Additional routines */
        //'conversions_records' => $wprtsp->generate_cpt_records(array('conversions_transaction' => 'subscribed to the newsletter', 'conversions_transaction_alt' => 'registered for the webinar')),
        
        'livestats_enable' => true, // bool
        
        'hotstats_enable' => true,
        'hotstats_timeframe' => 1,
        'hotstats_timeframes' => array(1, 2, 3, 7, 30, -1),
    );

    return $defaults;
    //return wp_parse_args( $settings, $defaults );
}

function wpsppro_sanitize( $request ) {
    $defaults = wprtsppro_get_cpt_defaults();
    
    $settings = array();
    $settings['general_show_on'] = array_key_exists('general_show_on', $request) ? sanitize_text_field( $request['general_show_on'] ) : $defaults['general_show_on'];
    $settings['general_post_ids'] = array_key_exists('general_post_ids', $request)? sanitize_text_field( $request['general_post_ids'] ) : $defaults['general_post_ids'];
    $settings['general_position'] = array_key_exists('general_position', $request)? sanitize_text_field( $request['general_position'] ) : $defaults['general_position'];
    $settings['general_duration'] = array_key_exists('general_duration', $request)? sanitize_text_field( $request['general_duration'] ) : $defaults['general_duration'];
    $settings['general_initial_popup_time'] = array_key_exists('general_initial_popup_time', $request)? sanitize_text_field( $request['general_initial_popup_time'] ) : $defaults['general_initial_popup_time'];
    $settings['general_subsequent_popup_time'] = array_key_exists('general_subsequent_popup_time', $request)? sanitize_text_field( $request['general_subsequent_popup_time'] ) : $defaults['general_subsequent_popup_time'];
    $settings['general_badge_enable'] = array_key_exists('general_badge_enable', $request) && $request['general_badge_enable'] ? true : false;


    $settings['conversions_enable'] = array_key_exists('conversions_enable', $request) && $request['conversions_enable'] ? true : false;
    $settings['conversions_enable_mob'] = array_key_exists('conversions_enable_mob',  $request) && $request['conversions_enable_mob'] ? true : false;
    $settings['conversions_title_notification'] = array_key_exists('conversions_title_notification', $request) && $request['conversions_title_notification'] ? true : false;

    $settings['conversions_shop_type'] = array_key_exists('conversions_shop_type', $request)?sanitize_text_field($request['conversions_shop_type'] ) : $defaults['general_post_ids'];
    $settings['conversions_transaction'] = array_key_exists('conversions_transaction', $request)? sanitize_text_field( $request['conversions_transaction'] ) : $defaults['conversions_transaction'];
    $settings['conversions_transaction_alt'] = array_key_exists('conversions_transaction_alt', $request)? sanitize_text_field( $request['conversions_transaction_alt'] ) : $defaults['conversions_transaction_alt'];
    $settings['conversions_sound_notification'] = array_key_exists('conversions_sound_notification', $request) && $request['conversions_sound_notification'] ? true : false;
    $settings['conversions_sound_notification_file'] = array_key_exists('conversions_sound_notification_file', $request) ? sanitize_text_field($request['conversions_sound_notification_file'] ) : $defaults['conversions_sound_notification_file'];
    $settings['general_badge_enable'] = array_key_exists('general_badge_enable', $request) && $request['general_badge_enable'] ? true : false;

    $settings['livestats_enable'] = array_key_exists('livestats_enable', $request) && $request['hotstats_enable'] ? true : false;
    $settings['hotstats_enable'] = array_key_exists('hotstats_enable', $request) && $request['hotstats_enable'] ? true : false;
    $settings['hotstats_timeframe'] = array_key_exists('hotstats_timeframe', $request) ? sanitize_text_field($request['hotstats_timeframe']) : $defaults['hotstats_timeframe'];

    $settings['ctas'] = array_key_exists('ctas', $request)? $request['ctas']: array();

    //$settings['conversions_records'] = array_key_exists('conversions_records');
    return $settings;
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
    //llog($settings);
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
    foreach($positions as $key=>$value) {
        $positions_html .= '<option value="' . $key . '" ' . selected( $general_position, $key, false ) .'>'. preg_replace('/[^\da-z]/i',' ', $value) .'</option>';
    }
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
    $conversions_transaction = $settings['conversions_transaction'];
    $conversions_transaction_alt = $settings['conversions_transaction_alt'];
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
            <td><label for="wprtsp_conversions_transaction">Transaction 1 for Generated Records</label></td>
            <td><input id="wprtsp_conversions_transaction" <?php if($conversions_shop_type != 'Generated') {echo 'readonly="true"';} ?> name="wprtsp[conversions_transaction]" type="text" class="widefat" value="<?php echo $conversions_transaction ?>" /></td>
        </tr>
        <tr>
            <td><label for="wprtsp_conversions_transaction_alt">Transaction 2 for Generated Records</label></td>
            <td><input id="wprtsp_conversions_transaction_alt" <?php if($conversions_shop_type != 'Generated') {echo 'readonly="true"';} ?> name="wprtsp[conversions_transaction_alt]" type="text" class="widefat" value="<?php echo $conversions_transaction_alt ?>" /></td>
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
                //$('#wprtsp_conversions_transaction').closest('tr').hide();
                //$('#wprtsp_conversions_transaction_alt').closest('tr').hide();
                $('#wprtsp_conversions_transaction_alt').attr('readonly', 'true');
                $('#wprtsp_conversions_transaction').attr('readonly', 'true');
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
    ?>
    <table id="tbl_livestats" class="wprtsp_tbl wprtsp_tbl_livestats">
        <thead>
            <tr>
                <th>
                    <h3>Show number of live visitors?</h3>
                </th>
                <th>
                <input id="wprtsp[livestats_enable]" name="wprtsp[livestats_enable]" type="checkbox" value="1" <?php checked( $livestats_enable, '1' , true); ?>/>
                </th>

            </tr>
        </thead>
    </table>
    <?php
}

function wpsppro_hot_stats_meta_box(){
    global $post;
    $defaults = wprtsppro_get_cpt_defaults();
    $settings = get_post_meta( $post->ID, '_socialproof', true );
    if(! $settings) {
        $settings = $defaults;
    }
    $settings = wpsppro_sanitize($settings);
    $hotstats_enable = array_key_exists('hotstats_enable',$settings) ? $settings['hotstats_enable'] : $defaults['hotstats_enable'];
    $hotstats_timeframe = array_key_exists('hotstats_timeframe',$settings) ? $settings['hotstats_timeframe'] : $defaults['hotstats_timeframe'];
    
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
    ?>
    <table id="tbl_hotstats" class="wprtsp_tbl wprtsp_tbl_hotstats">
        <thead>
            <tr>
                <th colspan="2">
                    <h3>Show Conversion Milestones over a period of time.</h3>
                </th>

            </tr>
        </thead>
        <tr>
            <td>Enable Hot Stats?</td>
            <td><input id="wprtsp[hotstats_enable]" name="wprtsp[hotstats_enable]" type="checkbox" value="1" <?php checked( $hotstats_enable, '1' , true); ?>/></td>
        </tr>
        <tr>
            <td>Show number of sales since</td>
            <td><?php echo $positions_html; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <?php
}

function wpsppro_custom_info_meta_box(){
    global $post;
    $wprtsp = WPRTSP::get_instance();

    $settings = get_post_meta($post->ID, '_socialproof', true);
    if(! $settings) {
        $settings = wprtsppro_get_cpt_defaults();
    }
    $defaults = wprtsppro_get_cpt_defaults();
    $settings = wpsppro_sanitize($settings);
    $ctas = $settings['ctas'];
    ?>Add custom calls to action such as offers, discount coupons etc.
    
    <table id="ctas-fieldset-one" width="100%">
        <thead>
            <tr>
                <th width="40%">Message</th>
                <th width="8%"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ( $ctas ) {
            foreach ( $ctas as $cta ) {
                if( ! empty($cta) ) { ?>
                <tr>
                    <td><input type="text" class="widefat" name="wprtsp[ctas][]" value="<?php if($cta != '') echo esc_attr( $cta ); ?>" /></td>
                    <td><a class="button remove-row" href="#">Remove</a></td>
                </tr>
                <?php
                }
            }
        }
        else { ?>
                <tr>
                    <td><input type="text" class="widefat" name="wprtsp[ctas][]" /></td>
                    <td><a class="button remove-row" href="#">Remove</a></td>
                </tr>
                <?php 
        }
        ?>
            <!-- empty hidden one for jQuery -->
            <tr class="empty-row screen-reader-text">
                <td><input type="text" class="widefat" name="wprtsp[ctas][]" /></td>
                <td><a class="button remove-row" href="#">Remove</a></td>
            </tr>
        </tbody>
    </table>
    <p><a id="add-row" class="button" href="#">Add another</a></p>
    <script type="text/javascript">
    $( '#add-row' ).on('click', function() {
            var row = $( '.empty-row.screen-reader-text' ).clone(true);
            row.removeClass( 'empty-row screen-reader-text' );
            row.insertBefore( '#ctas-fieldset-one tbody>tr:last' );
            return false;
        });
        
        $( '.remove-row' ).on('click', function() {
            $(this).parents('tr').remove();
            return false;
        });
    </script>
    <?php
        llog($settings);
}

function wpsppro_save_meta_box_data($post_id) {
    
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
    //llog($_POST);
    //llog($settings);
    //die();
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

    $period = ($value >= 0 ) ? '>'.( time() - ( $value * DAY_IN_SECONDS ))  : false;
    
    $query = new WC_Order_Query( array(
        'limit' => 100,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
        'status' => 'completed',
        'date_completed' => $period ? $period : false,
    ) );
    $orders = $query->get_orders();
    $records =array(
        'sales' => array(
            'count' => count($orders),
            'action' => 'products sold',
        )
    );
    return $records;
}

function get_edd_hoststats($timeframe) {
    if(! class_exists('Easy_Digital_Downloads')){
        return array();
    }
    $args = array(
        'numberposts'      => 100,
        'post_status'      => 'publish',			
        'post_type'        => 'edd_payment',
        'suppress_filters' => true, 
        );						
    $payments = get_posts( $args );			
    $records = array();
    $messages = array();
    if ( $payments ) { 
        foreach ( $payments as $payment_post ) { 
            setup_postdata($payment_post);
            $payment      = new EDD_Payment( $payment_post->ID );
            if(empty($payment->ID)) {
                continue;
            }
            
            $payment_time   = human_time_diff(strtotime( $payment->date ), current_time('timestamp'));
            $customer       = new EDD_Customer( $payment->customer_id );
            $downloads = $payment->cart_details;
            $downloads = array_slice($downloads, 0, 1, true);
            $name = '';
            if( array_key_exists('first_name', $payment->user_info) && ! empty( $payment->user_info['first_name'] ) ) {
                $name = $payment->user_info['first_name'];
            }
            if( array_key_exists('last_name', $payment->user_info) && ! empty( $payment->user_info['last_name'] ) ) {
                $name .= ' '.$payment->user_info['last_name'];
            }
            if(empty(trim($name))) {
                $name = 'Someone';
            }
            $records[$payment_post->ID] = array('product_link'=>get_permalink( $downloads[0]['id'] ),'first_name' => $payment->user_info['first_name'], 'last_name' => $payment->user_info['last_name'], 'transaction' => 'purchased', 'product' => $downloads[0]['name'] , 'time' => $payment_time);
            $messages[] = array(
                'link' => get_permalink( $downloads[0]['id'] ),
                'name' => $name,
                'product' => $downloads[0]['name'],
                'time' => $payment_time
            );
            //apply_filters('wprtsp_edd_conversion_message','<a href="'.get_permalink( $downloads[0]['id'] ).'"><span class="wprtsp_conversion_icon" style="'.$this->get_conversion_icon_style().'"></span><span class="wprtsp_line1" style="'. $this->get_message_style_line1() . '">' . $name . '</span><span class="wprtsp_line2" style="' . $this->get_message_style_line2() . '"> purchased ' . $downloads[0]['name'] . ' ' . $payment_time . ' ago.</span></a>',$records[$payment_post->ID]);
        }
        wp_reset_postdata();
    }
    
    return $messages;
}


if(! function_exists('llog')) {
    function llog($str) {
        echo '<pre>';
        print_r($str);
        echo '</pre>';
    }
}