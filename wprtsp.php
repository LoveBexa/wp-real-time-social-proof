<?php
/**
 * Plugin Name: WP Real-Time Social-Proof
 * Description: Animated, live, real-time social-proof Pop-ups for your WordPress website to boost sales and signups.
 * Version:     1.7
 * Plugin URI:  https://wordpress.org/plugins/wp-real-time-social-proof/
 * Author:      Shivanand Sharma
 * Author URI:  https://www.converticacommerce.com
 * Text Domain: wprtsp
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 * Tags: social proof, conversion, ctr, ecommerce, marketing, popup, woocommerce, easy digital downloads, newsletter, optin, signup, sales triggers
 */

/*
Copyright 2018 Shivanand Sharma

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

define( 'EDD_SL_STORE_URL', 'https://wp-social-proof.com' );

class WPRTSP {

    public $names = array('Kai Nakken', 'Cathy Gluck', 'Tiana Heier', 'Reiko Doucette', 'Shanel Nichols', 'Karan Sigler', 'Javier Roots', 'Camila Nowak', 'Refugia Blanc', 'Farrah Beehler', 'Kelly Lonergan', 'Jene Lechler', 'Awilda Hesler', 'Robbi Jauregui', 'Jaimie Wilkinson', 'Nanette Perras', 'Cinda Alley', 'Monet Player', 'Linn Bayless', 'Yukiko Cottman', 'Almeta Walkes', 'Janina Benesh', 'Shaun Camp', 'Mitch Ohern', 'Sam Carlon', 'Man Millard', 'Dania Coil', 'Eartha Hayhurst', 'Devin Fuston', 'Darcie Covin', 'Traci Mcsweeney', 'Lenore Bourassa', 'Nita Kaya', 'Tamra Biron', 'Melissa Garett', 'Myrta Magallanes', 'Magen Matinez', 'Gabriella Falls', 'Wayne Mcshane', 'Kristal Murnane', 'Allegra Plotner', 'Floyd Busbee', 'Danuta Lookabaugh', 'Nisha Correira', 'Lincoln Ewert', 'Shaunta Antrim', 'Augustine Rominger', 'Brady Sharpton', 'Jenice Tiedeman', 'Emanuel Hysmith', 'Sade Tefft', 'Kathe Macdowell', 'Tom Fordham', 'Elaina Moad', 'Denise Trudel', 'Rusty Mechem', 'Rosaura Tarin', 'Glayds Anger', 'Roma Hendrickson', 'Marsha Mathena', 'Shiloh Broadfoot', 'Casandra Pia', 'Cortez Bronstein', 'Bernadette Schwartz', 'Corinne Goudeau', 'Cornelia Kelsey', 'Joe Amore', 'Ahmad Blanca', 'Liana Chastain', 'Ester Shoop', 'Shayna Stoneman', 'Adrienne Faz', 'Carissa Cagle', 'Carita Meshell', 'Ria Reidy', 'Ka Hixson', 'Micki Hazen', 'Jeri Chaires', 'Gil Ledger', 'Kirk Square', 'Ericka Cedeno', 'Forest Mcquaid', 'Lauretta Keenan', 'Cleopatra Teeters', 'Gertha Rivas', 'Madie Iadarola', 'Elke Springfield', 'Marisol Patrick', 'Yoshie Studley', 'Cristopher Roddy', 'Buster Nyland', 'Vannesa Grable', 'Katharina Bustle', 'Monique Villescas', 'Maximo Lamb', 'Voncile Donahoe', 'Aiko Atkin', 'Tobie Mehta', 'Sixta Domina', 'Daniele Chacon') ;

    public $locations = array(array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Birmingham','state' => 'Alabama'),array('city' => 'San Diego','state' => 'California'),array('city' => 'Fresno','state' => 'California'),array('city' => 'Modesto','state' => 'California'),array('city' => 'Toledo','state' => 'Ohio'),array('city' => 'Modesto','state' => 'California'),array('city' => 'Santa Ana','state' => 'California'),array('city' => 'Mesa','state' => 'Arizona'),array('city' => 'Dallas','state' => 'Texas'),array('city' => 'New York','state' => 'New York'),array('city' => 'Norfolk','state' => 'Virginia'),array('city' => 'Phoenix','state' => 'Arizona'),array('city' => 'Charlotte','state' => 'North Carolina'),array('city' => 'Jersey City','state' => 'New Jersey'),array('city' => 'Indianapolis','state' => 'Indiana'),array('city' => 'Arlington','state' => 'Texas'),array('city' => 'Raleigh','state' => 'North Carolina'),array('city' => 'Bakersfield','state' => 'California'),array('city' => 'Scottsdale','state' => 'Arizona'),array('city' => 'Philadelphia','state' => 'Pennsylvania'),array('city' => 'Tucson','state' => 'Arizona'),array('city' => 'Garland','state' => 'Texas'),array('city' => 'Fresno','state' => 'California'),array('city' => 'Los Angeles','state' => 'California'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Detroit','state' => 'Michigan'),array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Fort Worth','state' => 'Texas'),array('city' => 'Chula Vista','state' => 'California'),array('city' => 'Glendale','state' => 'Arizona'),array('city' => 'Pittsburgh','state' => 'Pennsylvania'),array('city' => 'Las Vegas','state' => 'Nevada'),array('city' => 'Lexington-Fayette','state' => 'Kentucky'),array('city' => 'Akron','state' => 'Ohio'),array('city' => 'Orlando','state' => 'Florida'),array('city' => 'Baton Rouge','state' => 'Louisiana'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Buffalo','state' => 'New York'),array('city' => 'St. Paul','state' => 'Minnesota'),array('city' => 'Norfolk','state' => 'Virginia'),array('city' => 'San Antonio','state' => 'Texas'),array('city' => 'St. Petersburg','state' => 'Florida'),array('city' => 'Detroit','state' => 'Michigan'),array('city' => 'Houston','state' => 'Texas'),array('city' => 'St. Petersburg','state' => 'Florida'),array('city' => 'Madison','state' => 'Wisconsin'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Montgomery','state' => 'Alabama'),array('city' => 'Milwaukee','state' => 'Wisconsin'),array('city' => 'Jersey City','state' => 'New Jersey'),array('city' => 'New York','state' => 'New York'),array('city' => 'Denver','state' => 'Colorado'),array('city' => 'Birmingham','state' => 'Alabama'),array('city' => 'Sacramento','state' => 'California'),array('city' => 'Hialeah','state' => 'Florida'),array('city' => 'Albuquerque','state' => 'New Mexico'),array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Baton Rouge','state' => 'Louisiana'),array('city' => 'Chula Vista','state' => 'California'),array('city' => 'Cleveland','state' => 'Ohio'),array('city' => 'Aurora','state' => 'Colorado'),array('city' => 'New Orleans','state' => 'Louisiana'),array('city' => 'Modesto','state' => 'California'),array('city' => 'Washington','state' => 'District of Columbia'),array('city' => 'Arlington','state' => 'Texas'),array('city' => 'Pittsburgh','state' => 'Pennsylvania'),array('city' => 'Montgomery','state' => 'Alabama'),array('city' => 'San Antonio','state' => 'Texas'),array('city' => 'Virginia Beach','state' => 'Virginia'),array('city' => 'Laredo','state' => 'Texas'),array('city' => 'Laredo','state' => 'Texas'),array('city' => 'Phoenix','state' => 'Arizona'),array('city' => 'Newark','state' => 'New Jersey'),array('city' => 'Virginia Beach','state' => 'Virginia'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Baltimore','state' => 'Maryland'),array('city' => 'Chandler','state' => 'Arizona'),array('city' => 'Houston','state' => 'Texas'),array('city' => 'Corpus Christi','state' => 'Texas'),array('city' => 'Tampa','state' => 'Florida'),array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Austin','state' => 'Texas'),array('city' => 'Fort Wayne','state' => 'Indiana'),array('city' => 'Oakland','state' => 'California'),array('city' => 'Fresno','state' => 'California'),array('city' => 'Miami','state' => 'Florida'),array('city' => 'Huntington','state' => 'New York'),array('city' => 'Milwaukee','state' => 'Wisconsin'),array('city' => 'Jacksonville','state' => 'Florida'),array('city' => 'Washington','state' => 'District of Columbia'),array('city' => 'Laredo','state' => 'Texas'),array('city' => 'Lubbock','state' => 'Texas'),array('city' => 'Tucson','state' => 'Arizona'),array('city' => 'Stockton','state' => 'California'),array('city' => 'Albuquerque','state' => 'New Mexico'),array('city' => 'Phoenix','state' => 'Arizona'),array('city' => 'Durham','state' => 'North Carolina'),array('city' => 'Arlington','state' => 'Texas'),array('city' => 'Boise','state' => 'Idaho'));

    public $style_box, $wprtsp_notification_style, $wprtsp_text_style, $wprtsp_action_style, $sound_notification, $sound_notification_markup;
    public $dir = '';
    public $uri = '';

    static function get_instance() {

		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup();
			$instance->setup_actions();
			$instance->includes();
		}
		return $instance;
    }

    function setup(){
        $this->dir = trailingslashit( plugin_dir_path( __FILE__ ) );
        $this->uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );
    }

    function includes(){
        if( file_exists( $this->dir . 'pro/pro.php') ) {
            include_once( $this->dir . 'pro/pro.php' );
        }
    }

    function setup_actions(){
        add_action( 'init', array( $this, 'register_post_types' ));
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'plugin_styles' ) );
        //add_filter( 'heartbeat_received', array( $this,'respond_to_browser'), 10, 3 ); // Logged in users:
        //add_filter( 'heartbeat_nopriv_received', array( $this,'respond_to_browser'), 10, 3 ); // Logged out users
        
        //add_action( 'wp_ajax_wprtsp_handle_ajax', array( $this, 'wprtsp_ajax_handler' ) );
        //add_action( 'wp_ajax_nopriv_wprtsp_handle_ajax', array( $this, 'wprtsp_ajax_handler' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts') );
        //add_action( 'wp_enqueue_scripts',  array( $this, 'enqueue_fingerprint') );
        //add_action( 'wp_footer',  array( $this, 'wprtsp_footer_scripts') );
        add_action( 'add_meta_boxes', array( $this,'add_meta_boxes' ) );
        add_action( 'save_post', array($this, 'save_meta_box_data' ) );
        //add_filter('wprtsp_get_proofs', array($this, 'wprtsp_get_proofs'));
        add_filter('wprtsp_vars', array($this, 'wprtsp_get_proofs'));
        add_filter('wprtsp_get_proof_data_conversions_WooCommerce', array( $this, 'get_wooc_conversions'), 10, 2 );
        add_filter('wprtsp_get_proof_data_conversions_Easy_Digital_Downloads', array( $this, 'get_edd_conversions'), 10, 2 );
        add_filter('wprtsp_get_proof_data_conversions_Generated', array( $this, 'get_generated_conversions'), 10, 2 );
        add_action('wprtsp_general_meta_settings',array( $this, 'wprtsppro_general_meta' ) );
        
        //add_action( 'in_plugin_update_message'. basename(__DIR__).'/'.basename(__FILE__), array($this, 'plugin_update_message'), 10, 2 );
    }

    function enqueue_fingerprint(){
        if($this->wprtsp_get_notification()){
            wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
        }
    }

    function enqueue_scripts(){
        $notifications  = get_posts( array( 'post_type' => 'socialproof', 'posts_per_page' => -1 ) );
        $active_notifications = array();
        foreach($notifications as $notification) {
            $meta = get_post_meta( $notification->ID, '_socialproof', true );
            $show_on = $meta['general_show_on'];
            //$this->llog($meta);
            switch($show_on) {
                case '1':
                    //if(apply_filters('wprtsp_enabled', $meta['conversions_enable'], $meta)) {
                        //$social_proof_settings = $this->get_cpt_settings( $notification->ID );
                        //wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
                        wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtspcpt.js', array('jquery'), null, true);
                        wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( apply_filters('wprtsp_vars', $meta ) ) );
                    //}
                    break;
                case '2': 
                    if(! is_array($post_ids)) {
                        if(strpos($post_ids, ',') !== false ){
                            $post_ids = explode(',', $post_ids);
                        }
                        else {
                            $post_ids = array($post_ids);
                        }
                    }
                    if( is_singular()  && in_array(get_the_ID(), $post_ids) ) {
                        //if(apply_filters('wprtsp_enabled', $meta['conversions_enable'], $meta)) {
                            //$social_proof_settings = $this->get_cpt_settings( $notification->ID );
                            //wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
                            wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtspcpt.js', array('jquery'), null, true);
                            wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( apply_filters('wprtsp_vars', $meta ) ) );
                        //}
                    }
                    break;
                case '3':
                    $post_ids = $meta['general_post_ids'];
                        if(! is_array($post_ids)) {
                            if(strpos($post_ids, ',') !== false ){
                                $post_ids = explode(',', $post_ids);
                            }
                            else {
                                $post_ids = array($post_ids);
                            }
                        }
                        if(  ! is_singular() || (is_singular()  && ! in_array(get_the_ID(), $post_ids) ) ) {
                            //if(apply_filters('wprtsp_enabled', $meta['conversions_enable'], $meta)) {
                                //$social_proof_settings = $this->get_cpt_settings( $notification->ID );
                                //wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
                                wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtspcpt.js', array('jquery'), null, true);
                                wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( apply_filters('wprtsp_vars', $meta ) ) );
                            //}
                        }
                    break;
            }
        }
    }

    function wprtsp_get_proofs($settings){
        
        $conversions = apply_filters('wprtsp_get_proof_data_conversions_'.$settings['conversions_shop_type'], $settings);
        $hotstats = apply_filters('wprtsp_get_proof_data_hotstats_'.$settings['conversions_shop_type'], array(), $settings);
        $livestats = apply_filters('wprtsp_get_proof_data_livestats', array(), $settings);
        $ctas = apply_filters('wprtsp_get_proof_data_ctas', array(), $settings);
        
        $settings['proofs']['conversions'] = $conversions;
        $settings['proofs']['hotstats'] = $hotstats;
        $settings['proofs']['livestats'] = $livestats;
        $settings['proofs']['ctas'] = $ctas;
        return $settings;
    }

    function footer_scripts() {
        $settings = $this->wprtsp_get_notification();
        //$this->llog($settings);
        $conversions = array();
        if($settings['conversions_enable']) {
            $conversions = apply_filters('wprtsp_get_proof_data_conversions_'.$settings['conversions_shop_type'], array(), $settings);
        }
        if($settings['hotstats_enable']) {
            $hotstats = array();
            $hotstats = apply_filters('wprtsp_get_proof_data_hotstats_'.$settings['conversions_shop_type'], $hotstats, $settings['hotstats_timeframe']);
            //$this->llog($hotstats);
        }
            ?>
            
            <?php
        
    }

    function get_container_wrap_style(){
        return 'display:flex;align-items:center;line-height: 1em;';
    }

    function get_conversion_image_style(){
        return 'text-align: center; display: table; height: 48px; width: 48px; margin-right: 1em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px; background:url(' . $this->uri . 'assets/map.svg ) no-repeat center;';
    }

    function get_conversion_text_style(){
        return 'display:table; font-weight:bold; font-size: 14px; line-height: 1em;';
    }

    function get_conversion_line1_style(){
        return apply_filters('wprtsp_popup_style_line1', 'display:block;white-space: nowrap;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,helvetica,arial,sans-serif !important; font-size: 14px;font-weight: 600;');
    }

    function get_conversion_line2_style(){
        return apply_filters('wprtsp_popup_style_line2', 'display:block;white-space: nowrap;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,helvetica,arial,sans-serif !important; font-size: 13px;font-weight: 300;');
    }

    function get_popup_container_style($settings) {
        switch($settings['general_position']) {
            case 'bl': $position_css = 'bottom: 10px; left:10px';
            break;
            case 'br': $position_css = 'bottom: 10px; right:10px';
            break;
        }

        return apply_filters('wprtsp_popup_container_style', 'all: unset;display:none; border-radius: 500px; position:fixed; bottom:10px; '.$position_css.'; z-index:9999; background: white; padding: 1em 2.618em; box-shadow: rgba(0, 0, 0, 0.25) 1px 2px 5px;');
    }

    function get_wooc_conversions() {
        //$this->llog('hello from wooc');
        if( ! class_exists('WooCommerce') ) {
            return false;
        }
        $query = new WC_Order_Query( array(
            'limit' => 100,
            'orderby' => 'date',
            'order' => 'DESC',
            'return' => 'ids',
            'status' => 'completed'
        ) );
        $orders = $query->get_orders();
        $customers = array();
        $messages = array();
        foreach($orders as $purchase) {
            $order = wc_get_order($purchase);
            $order_data = $order->get_data();
            
            $user = $order->get_user();
            if(!empty($user)) {
                $name = '';
                if( $user->user_firstname && strtolower($user->user_firstname) != 'guest' ) {
                    $name .= $user->user_firstname;
                }
                if( $user->user_lastname && strtolower($user->user_lastname) != 'guest'){
                    $name .= ' ' . $user->user_lastname;
                }
                if(empty(trim($name))) {
                    $name = 'Someone';
                }
            }
            else {
                $customers[$purchase]['name'] = 'Someone';
            }
            $item = $order->get_items();
            $item = array_shift($item);
            $customers[$purchase]['product'] = $item->get_name();
            $customers[$purchase]['product_link'] = get_permalink($item->get_product_id());
            $time = new WC_DateTime( $order->get_date_completed() );
            $customers[$purchase]['time'] = human_time_diff($time->getTimestamp());
            $messages[] = array(
                'name' => $name,
                'link' => $customers[$purchase]['product_link'],
                'product' => $customers[$purchase]['product'],
                'location' => $order_data['billing']['city'] . ', ' . $order_data['billing']['country'],
                'time' => $customers[$purchase]['time']
            );
        }
        
        return $messages;
    }

    function get_edd_conversions() {
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
                $this->llog($payment);
                if(empty($payment->ID)) {
                    continue;
                }
                
                $payment_time   = human_time_diff(strtotime( $payment->date ), current_time('timestamp'));
                $customer       = new EDD_Customer( $payment->customer_id );
                $downloads = $payment->cart_details;
                $downloads = array_slice($downloads, 0, 1, true);
                $name = '';
                $address = array_key_exists('address', $payment->user_info) ? $payment->user_info['address'] : false;
                if($address) {
                    $address = $payment->user_info['address']['city'] . ' ' . $payment->user_info['address']['country'];
                    if(empty(trim($address))) {
                        $address = false;
                    }

                }
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
                    'name' => $name,
                    'link' => get_permalink( $downloads[0]['id'] ),
                    'product' => $downloads[0]['name'],
                    'location' => $address,
                    'time' => $payment_time
                );
                //apply_filters('wprtsp_edd_conversion_message','<a href="'.get_permalink( $downloads[0]['id'] ).'"><span class="wprtsp_conversion_icon" style="'.$this->get_conversion_icon_style().'"></span><span class="wprtsp_line1" style="'. $this->get_message_style_line1() . '">' . $name . '</span><span class="wprtsp_line2" style="' . $this->get_message_style_line2() . '"> purchased ' . $downloads[0]['name'] . ' ' . $payment_time . ' ago.</span></a>',$records[$payment_post->ID]);
            }
            wp_reset_postdata();
        }
        
        return $messages;
    }

    function get_generated_conversions($settings){
        $transaction = $settings['conversions_transaction'];
        $transaction_alt = $settings['conversions_transaction_alt'];
        $indexes = array();
        reset( $this->names );
        reset( $this->locations );
        for ( $i=0; $i < 100; $i++ ) {
            mt_srand( $this->make_seed() );
            $randval = mt_rand();
            //$name = explode(' ', current($this->names));
            $indexes[$i] = array(
                'name' => current($this->names),
                'link' => '',
                'product' => '',
                'location' =>  current($this->locations),
                'time',
                'transaction' => ($randval % 2) ? $transaction : $transaction_alt
            );
            next($this->locations);
            next($this->names);
        }
        return $indexes;
    }

    function wprtsp_get_notification() {
        $notifications  = get_posts( array( 'post_type' => 'socialproof', 'posts_per_page' => -1 ) );
       
        foreach($notifications as $notification) {
            $meta = get_post_meta( $notification->ID, '_socialproof', true );
            
            $meta['notification_id'] = $notification->ID;
            $show_on = (int) $meta['general_show_on'];

            switch($show_on) {
                case 1:
                    return $meta;
                    break;
                case 2:
                    $post_ids = $meta['general_post_ids']; 
                    if( ! is_array($post_ids)) {
                        if(strpos($post_ids, ',') !== false ){
                            $post_ids = explode(',', $post_ids);
                        }
                        else {
                            $post_ids = array($post_ids);
                        }
                    }
                    if( is_singular()  && in_array(get_the_ID(), $post_ids) ) {  
                        return  $meta;
                    }
                    break;
                case 3:
                    $post_ids = $meta['general_post_ids'];
                        if(! is_array($post_ids)) {
                            if(strpos($post_ids, ',') !== false ){
                                $post_ids = explode(',', $post_ids);
                            }
                            else {
                                $post_ids = array($post_ids);
                            }
                        }
                        if(  ! is_singular() || (is_singular()  && ! in_array(get_the_ID(), $post_ids) ) ) {
                            return $meta;
                        }
                    break;
            }
        }
    }

    function wprtsp_ajax_handler() {
        $wprtsp_request = isset($_POST['wprtsp']) ? $_POST['wprtsp'] : array();
        if(!$wprtsp_request) {
            wp_send_json( array() );
        }

        //$proofs = apply_filters("wprtsp_get_proofs", $wprtsp_request['get_proofs']);
        $proofs = $wprtsp_request['get_proofs'];
        //$this->llog($wprtsp_request['get_proofs']);
        $types = array();
        foreach($proofs as $proof => $data) {
            //$types[$proof] = apply_filters("wprtsp_get_proof_data_{$proof}", $data );
            $types[] = "wprtsp_get_proof_data_{$proof}";
        }

        wp_send_json(  $types ) ;
        //wp_send_json(json_encode( $_POST['wprtsp']) );
        //$data = apply_filters("wprtsp_get_proofs", $data, $wprtsp_request );
        //wp_send_json(json_encode($data));
    }

    function plugin_update_message( $data, $response ) {
        if( isset( $data['upgrade_notice'] ) ) {
            printf(
                '<div class="update-message">%s</div>',
                wpautop( '<strong>Alert!</strong> This is a major update. Please setup the plugin again to use the new powerful features!' )
            );
        }
    }

    function add_meta_boxes(){
        add_meta_box( 'social-proof-general', __( 'General', 'erm' ), array($this, 'general_meta_box'), 'socialproof', 'normal');
        add_meta_box( 'social-proof-conversions', __( 'Conversions', 'erm' ), array($this, 'conversions_meta_box'), 'socialproof', 'normal');
    }

    function cpt_defaults() {
        
        $defaults = array(

                'general_show_on' => '1',
                'general_duration' => '4',
                'general_initial_popup_time' => '5',
                'general_subsequent_popup_time' => '30',
                'general_post_ids' => get_option( 'page_on_front'),
                'general_position' => 'bl',

                'conversions_enable' => true,
                'conversions_show_on_mobile' => true,
                'conversions_shop_type' => class_exists('Easy_Digital_Downloads') ?  'Easy_Digital_Downloads' : ( class_exists( 'WooCommerce' ) ?  'WooCommerce' :  'Generated' ),
                'conversions_transaction' => 'subscribed to the newsletter',
                'conversions_transaction_alt' => 'registered for the webinar',
                'conversions_sound_notification' => false,
                
                'positions' => array('bl' => 'Bottom Left', 'br' => 'Bottom Right'),

                /* Additional routines */
                //'conversions_records' => $this->generate_cpt_records(array('conversions_transaction' => 'subscribed to the newsletter', 'conversions_transaction_alt' => 'registered for the webinar')),

        );
        return apply_filters('wprtsp_cpt_defaults', $defaults);
    }

    function general_meta_box(){
        global $post;
        wp_nonce_field( 'socialproof_meta_box_nonce', 'socialproof_meta_box_nonce' );
        if( apply_filters( 'wprtsp_general_meta', true ) ) {
        $settings = get_post_meta( $post->ID, '_socialproof', true );

        $defaults = $this->cpt_defaults();
        $settings = wp_parse_args( $settings, $defaults );
        $show_on = $settings['general_show_on'];
        $post_ids = $settings['general_post_ids'];
        $duration = $settings['general_duration'];
        $initial_popup_time = $settings['general_initial_popup_time'];
        $subsequent_popup_time = $settings['general_subsequent_popup_time'];
        $general_position = array_key_exists('general_position', $settings) ? $settings['general_position'] : 'bl';
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
        //$this->llog($settings);
    }

    function conversions_meta_box(){
        global $post;
        if( apply_filters('wprtsp_conversions_meta', true) ) {
        $settings = get_post_meta($post->ID, '_socialproof', true);
        $settings = $this->wprtsp_sanitize($settings);
        $conversions_enable = $settings['conversions_enable'];
        $conversions_shop_type = $settings['conversions_shop_type'];
        $conversions_transaction = $settings['conversions_transaction'];
        $conversions_transaction_alt = $settings['conversions_transaction_alt'];
        $conversions_sound_notification = $settings['conversions_sound_notification'];
        
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
                    <h3>Conversions</h3>
                </td>
            </tr>
            <tr>
                <td><label for="wprtsp[conversions_enable]">Enable</label></td>
                <td>
                    <input id="wprtsp[conversions_enable]" name="wprtsp[conversions_enable]" type="checkbox" value="1" <?php checked( $conversions_enable, '1' , true); ?>/>
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
                <td><label for="wprtsp[conversions_sound_notification]">Enable Sound Notification</label></td>
                <td><input id="wprtsp[conversions_sound_notification]" name="wprtsp[conversions_sound_notification]" type="checkbox" value="1" <?php checked( $conversions_sound_notification, '1' , true); ?>/></td>
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
        }
        else {
            do_action('wprtsp_conversions_meta_settings');
        }
    }

    function wprtsp_sanitize($request){
        $settings['general_show_on'] = array_key_exists('general_show_on' ,$request) ? sanitize_text_field($request['general_show_on'] ) : $defaults['general_show_on'];
        $settings['general_post_ids'] = array_key_exists('general_post_ids' ,$request) ? sanitize_text_field($request['general_post_ids'] ) : $defaults['general_post_ids'];
        $settings['general_position'] = array_key_exists('general_position' ,$request) ? sanitize_text_field($request['general_position'] ) : $defaults['general_position'];
        $settings['general_initial_popup_time'] = array_key_exists('general_initial_popup_time' ,$request) ? sanitize_text_field($request['general_initial_popup_time'] ) : $defaults['general_initial_popup_time'];
        $settings['general_duration'] = array_key_exists('general_duration' ,$request) ? sanitize_text_field($request['general_duration'] ) : $defaults['general_duration'];
        $settings['general_subsequent_popup_time'] = array_key_exists('general_subsequent_popup_time' ,$request) ? sanitize_text_field($request['general_subsequent_popup_time'] ) : $defaults['general_subsequent_popup_time'];

        $settings['conversions_enable'] = array_key_exists('conversions_enable' ,$request) && $request['conversions_enable'] ? true : false;
        $settings['conversions_shop_type'] = array_key_exists('conversions_shop_type' ,$request) ? sanitize_text_field($request['conversions_shop_type'] ) : $defaults['conversions_shop_type'];
        $settings['conversions_transaction'] = array_key_exists('conversions_transaction' ,$request) ? sanitize_text_field($request['conversions_transaction'] ) : $defaults['conversions_transaction'];
        $settings['conversions_transaction_alt'] = array_key_exists('conversions_transaction_alt' ,$request) ? sanitize_text_field($request['conversions_transaction_alt'] ) : $defaults['conversions_transaction_alt'];
        $settings['conversions_sound_notification'] = array_key_exists('conversions_sound_notification' , $request) && $request['conversions_sound_notification'] ? true : false;

        return $settings;
    }

    function save_meta_box_data($post_id){
        
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
        
        $request = $_POST['wprtsp'];
        $settings = $this->wprtsp_sanitize($request);
        $settings = apply_filters('wprtsp_cpt_update_settings', $settings);

        update_post_meta( $post_id, '_socialproof', $settings );
    }

    function register_post_types(){

        $labels = array(
            'name'                  => __( 'Notifications',                   'erm' ),
            'singular_name'         => __( 'singular_name',                    'erm' ),
            'menu_name'             => __( 'Social Proof',                   'erm' ),
            'name_admin_bar'        => __( 'name_admin_bar',                    'erm' ),
            'add_new'               => __( 'Add New Notification',                        'erm' ),
            'add_new_item'          => __( 'Add New Notification',            'erm' ),
            'edit_item'             => __( 'Edit Notification',               'erm' ),
            'new_item'              => __( 'new_item',                'erm' ),
            'view_item'             => __( 'view_item',               'erm' ),
            'view_items'            => __( 'view_items',              'erm' ),
            'search_items'          => __( 'search_items',            'erm' ),
            'not_found'             => __( 'No notificatins found',          'erm' ),
            'not_found_in_trash'    => __( 'No notificatins in Trash', 'erm' ),
            'all_items'             => __( 'All Notifications',                   'erm' ),
            'featured_image'        => __( 'featured_image',                   'erm' ),
            'set_featured_image'    => __( 'set_featured_image',               'erm' ),
            'remove_featured_image' => __( 'remove_featured_image',            'erm' ),
            'use_featured_image'    => __( 'use_featured_image',            'erm' ),
            'insert_into_item'      => __( 'insert_into_item',        'erm' ),
            'uploaded_to_this_item' => __( 'uploaded_to_this_item',   'erm' ),
            'filter_items_list'     => __( 'filter_items_list',       'erm' ),
            'items_list_navigation' => __( 'items_list_navigation',   'erm' ),
            'items_list'            => __( 'items_list',              'erm' ),
        );
        $cpt_args = array(
            'description'         => 'Social Proof',
            'public'              => false,
            'show_ui'               => true,
            'show_in_admin_bar'   => true,
            'show_in_rest'        => true,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-format-chat',
            'can_export'          => true,
            'delete_with_user'    => false,
            'hierarchical'        => false,
            'has_archive'         => false,
            'labels'              => $labels,
            'template_lock' => true,
    
            // What features the post type supports.
            'supports' => array(
                'title',
                //'editor',
                //'thumbnail',
                // Theme/Plugin feature support.
                //'custom-background', // Custom Background Extended
                //'custom-header',     // Custom Header Extended
                //'wpcom-markdown',    // Jetpack Markdown
            )
        );

        register_post_type( 'socialproof', apply_filters( 'socialproof_post_type_args', $cpt_args ) );
    }

    private function __construct() {}

    function respond_to_browser($response, $data, $screen_id) {
        if ( isset( $data['wprtsp'] ) ) {
            $notification_id =  $data['wprtsp_notification_id'];
            $shop_type = get_post_meta($notification_id, '_socialproof', true);
            $shop_type = $shop_type['conversions_shop_type'];
            $request_type = $shop_type['proof_type']; // which kind of proof is requested
            switch($shop_type) {
                case 'Easy_Digital_Downloads': $response = $this->send_edd_records($response, $data, $screen_id, $notification_id);
                break;
                case 'WooCommerce': return $this->send_wooc_records($response, $data, $screen_id, $notification_id);
                break;
                default: $response = $this->send_generated_records($response, $data, $screen_id, $notification_id);
            }
        }
        return $response;
    }

    function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }

    /* function get_cpt_settings( $notification_id ){
        $meta = get_post_meta($notification_id, '_socialproof', true);
        return $meta;
        $position = $meta['general_position'];
        $position_css = '';
        switch($position) {
            case 'bl': $position_css = 'bottom: 10px; left:10px';
            break;
            case 'br': $position_css = 'bottom: 10px; right:10px';
            break;
        }

        $vars = array(
            'id' => (int) $notification_id,
            'url' => $this->uri,
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'conversions_container_style' => apply_filters( 'wprtsp_conversions_container_style', 'display:none; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; font-size: 14px; max-width:90%; border-radius: 500px; position:fixed; bottom:10px; '.$position_css.'; z-index:9999; background:white; padding: 1em 2.618em; box-shadow: 2px -1px 5px rgba(0,0,0,.15);' ),
            'conversions_notification_style' => apply_filters('wprtsp_conversions_notification_style', 'text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px; background:url(' . $this->uri . 'assets/map.svg ) no-repeat center;' ),
            'conversions_action_style' => apply_filters( 'wprtsp_conversions_action_style', 'margin-top: .5em; display: block; font-weight: 300; color: #aaa; font-size: 12px; line-height: 1em;' ),
            'conversions_text_style' => apply_filters( 'wprtsp_conversions_text_style', 'display:table; font-weight:bold; font-size: 14px; line-height: 1em;' ),
            'conversions_title_notification' => apply_filters('wprtsp_conversions_title_notification', ( $meta['conversions_title_notification'] == '1' ) ? true : false),
            'conversions_sound_notification' => apply_filters('wprtsp_conversions_sound_notification', ( $meta['conversions_sound_notification'] == '1' ) ? true : false),
            'conversions_sound_notification_markup' => apply_filters( 'wprtsp_conversions_sound_notification_markup','<audio preload="auto" autoplay="true" src="' . $this->uri .'assets/sounds/unsure.mp3">Your browser does not support the <code>audio</code>element.</audio>', $meta),
            'conversions_sound_notification_file' => apply_filters( 'wprtsp__sound_notification_file',$this->uri .'assets/sounds/unsure.mp3', $meta),
            'conversions_shop_type' => apply_filters( 'wprtsp_conversions_shop_type', $meta['conversions_shop_type'] ),
            'general_duration' => apply_filters( 'wprtsp_general_duration', (int) $meta['general_duration'] ),
            'general_initial_popup_time' => apply_filters( 'wprtsp_general_initial_popup_time', (int) $meta['general_initial_popup_time'] ),
            'general_subsequent_popup_time' => apply_filters('wprtsp_general_subsequent_popup_time', (int) $meta['general_subsequent_popup_time'] )
        );
        if($vars['conversions_sound_notification'] == false) {
            $vars['conversions_sound_notification_markup'] = '';
        }

        $vars['get_proofs'] = apply_filters('wprtsp_get_proofs', array(
                'conversionstats' => array(
                    'conversions_shop_type' => $vars['conversions_shop_type'],
                    ),
                
                'livestats' => array(
                    'visitors' => true
                    ),
                    'hotstats' => array(
                        'conversions_shop_type' => $vars['conversions_shop_type'],
                        'transaction_type' => $vars['transaction_type'],
                        'duration' => $vars['transaction_type'],
                    ),
                
                )
            );
        return $vars;
    } */

    /* Add links below the plugin name on the plugins page */
    function plugin_action_links($links){
        $links[] = '<a href="https://www.converticacommerce.com/?item_name=Donate%20to%20WP%20Social%20Proof&cmd=_xclick&business=shivanand@converticacommerce.com"><strong style="display:inline">Donate</strong></a>';
        return $links;
    }

    /* Enqueue the styles for admin page */
    function plugin_styles(){
        $screen = get_current_screen();
        
		if( $screen->id == 'toplevel_page_' . basename( __FILE__ , '.php') ) {
			wp_enqueue_style( 'wprtsp', $this->uri . 'assets/admin-styles.css' );
        }
        if($screen->post_type == 'socialproof') {
            wp_enqueue_style( 'wprtsp-cpt', $this->uri . 'assets/cpt-styles.css' );
        }
        
    }

    /* Outputs any variable / php objects / arrays in a clear visible frmat */
    static function llog($str) {
        echo '<pre>';
        print_r($str);
        echo '</pre>';
    }

}

function wprtsp() {
	return WPRTSP::get_instance();
}
// Let's roll!
wprtsp();
