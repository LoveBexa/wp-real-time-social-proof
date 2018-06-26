<?php
/**
 * Plugin Name: WP Real-Time Social-Proof
 * Description: Animated, live, real-time social-proof Pop-ups for your WordPress website to boost sales and signups.
 * Version:     1.1
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

define( 'WPRTSP_DIR', trailingslashit(plugin_dir_url( __FILE__ )));

class WPRTSP {

    private $names = array('Kai Nakken', 'Cathy Gluck', 'Tiana Heier', 'Reiko Doucette', 'Shanel Nichols', 'Karan Sigler', 'Javier Roots', 'Camila Nowak', 'Refugia Blanc', 'Farrah Beehler', 'Kelly Lonergan', 'Jene Lechler', 'Awilda Hesler', 'Robbi Jauregui', 'Jaimie Wilkinson', 'Nanette Perras', 'Cinda Alley', 'Monet Player', 'Linn Bayless', 'Yukiko Cottman', 'Almeta Walkes', 'Janina Benesh', 'Shaun Camp', 'Mitch Ohern', 'Sam Carlon', 'Man Millard', 'Dania Coil', 'Eartha Hayhurst', 'Devin Fuston', 'Darcie Covin', 'Traci Mcsweeney', 'Lenore Bourassa', 'Nita Kaya', 'Tamra Biron', 'Melissa Garett', 'Myrta Magallanes', 'Magen Matinez', 'Gabriella Falls', 'Wayne Mcshane', 'Kristal Murnane', 'Allegra Plotner', 'Floyd Busbee', 'Danuta Lookabaugh', 'Nisha Correira', 'Lincoln Ewert', 'Shaunta Antrim', 'Augustine Rominger', 'Brady Sharpton', 'Jenice Tiedeman', 'Emanuel Hysmith', 'Sade Tefft', 'Kathe Macdowell', 'Tom Fordham', 'Elaina Moad', 'Denise Trudel', 'Rusty Mechem', 'Rosaura Tarin', 'Glayds Anger', 'Roma Hendrickson', 'Marsha Mathena', 'Shiloh Broadfoot', 'Casandra Pia', 'Cortez Bronstein', 'Bernadette Schwartz', 'Corinne Goudeau', 'Cornelia Kelsey', 'Joe Amore', 'Ahmad Blanca', 'Liana Chastain', 'Ester Shoop', 'Shayna Stoneman', 'Adrienne Faz', 'Carissa Cagle', 'Carita Meshell', 'Ria Reidy', 'Ka Hixson', 'Micki Hazen', 'Jeri Chaires', 'Gil Ledger', 'Kirk Square', 'Ericka Cedeno', 'Forest Mcquaid', 'Lauretta Keenan', 'Cleopatra Teeters', 'Gertha Rivas', 'Madie Iadarola', 'Elke Springfield', 'Marisol Patrick', 'Yoshie Studley', 'Cristopher Roddy', 'Buster Nyland', 'Vannesa Grable', 'Katharina Bustle', 'Monique Villescas', 'Maximo Lamb', 'Voncile Donahoe', 'Aiko Atkin', 'Tobie Mehta', 'Sixta Domina', 'Daniele Chacon') ;

    private $locations = array(array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Birmingham','state' => 'Alabama'),array('city' => 'San Diego','state' => 'California'),array('city' => 'Fresno','state' => 'California'),array('city' => 'Modesto','state' => 'California'),array('city' => 'Toledo','state' => 'Ohio'),array('city' => 'Modesto','state' => 'California'),array('city' => 'Santa Ana','state' => 'California'),array('city' => 'Mesa','state' => 'Arizona'),array('city' => 'Dallas','state' => 'Texas'),array('city' => 'New York','state' => 'New York'),array('city' => 'Norfolk','state' => 'Virginia'),array('city' => 'Phoenix','state' => 'Arizona'),array('city' => 'Charlotte','state' => 'North Carolina'),array('city' => 'Jersey City','state' => 'New Jersey'),array('city' => 'Indianapolis','state' => 'Indiana'),array('city' => 'Arlington','state' => 'Texas'),array('city' => 'Raleigh','state' => 'North Carolina'),array('city' => 'Bakersfield','state' => 'California'),array('city' => 'Scottsdale','state' => 'Arizona'),array('city' => 'Philadelphia','state' => 'Pennsylvania'),array('city' => 'Tucson','state' => 'Arizona'),array('city' => 'Garland','state' => 'Texas'),array('city' => 'Fresno','state' => 'California'),array('city' => 'Los Angeles','state' => 'California'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Detroit','state' => 'Michigan'),array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Fort Worth','state' => 'Texas'),array('city' => 'Chula Vista','state' => 'California'),array('city' => 'Glendale','state' => 'Arizona'),array('city' => 'Pittsburgh','state' => 'Pennsylvania'),array('city' => 'Las Vegas','state' => 'Nevada'),array('city' => 'Lexington-Fayette','state' => 'Kentucky'),array('city' => 'Akron','state' => 'Ohio'),array('city' => 'Orlando','state' => 'Florida'),array('city' => 'Baton Rouge','state' => 'Louisiana'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Buffalo','state' => 'New York'),array('city' => 'St. Paul','state' => 'Minnesota'),array('city' => 'Norfolk','state' => 'Virginia'),array('city' => 'San Antonio','state' => 'Texas'),array('city' => 'St. Petersburg','state' => 'Florida'),array('city' => 'Detroit','state' => 'Michigan'),array('city' => 'Houston','state' => 'Texas'),array('city' => 'St. Petersburg','state' => 'Florida'),array('city' => 'Madison','state' => 'Wisconsin'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Montgomery','state' => 'Alabama'),array('city' => 'Milwaukee','state' => 'Wisconsin'),array('city' => 'Jersey City','state' => 'New Jersey'),array('city' => 'New York','state' => 'New York'),array('city' => 'Denver','state' => 'Colorado'),array('city' => 'Birmingham','state' => 'Alabama'),array('city' => 'Sacramento','state' => 'California'),array('city' => 'Hialeah','state' => 'Florida'),array('city' => 'Albuquerque','state' => 'New Mexico'),array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Baton Rouge','state' => 'Louisiana'),array('city' => 'Chula Vista','state' => 'California'),array('city' => 'Cleveland','state' => 'Ohio'),array('city' => 'Aurora','state' => 'Colorado'),array('city' => 'New Orleans','state' => 'Louisiana'),array('city' => 'Modesto','state' => 'California'),array('city' => 'Washington','state' => 'District of Columbia'),array('city' => 'Arlington','state' => 'Texas'),array('city' => 'Pittsburgh','state' => 'Pennsylvania'),array('city' => 'Montgomery','state' => 'Alabama'),array('city' => 'San Antonio','state' => 'Texas'),array('city' => 'Virginia Beach','state' => 'Virginia'),array('city' => 'Laredo','state' => 'Texas'),array('city' => 'Laredo','state' => 'Texas'),array('city' => 'Phoenix','state' => 'Arizona'),array('city' => 'Newark','state' => 'New Jersey'),array('city' => 'Virginia Beach','state' => 'Virginia'),array('city' => 'Lincoln','state' => 'Nebraska'),array('city' => 'Baltimore','state' => 'Maryland'),array('city' => 'Chandler','state' => 'Arizona'),array('city' => 'Houston','state' => 'Texas'),array('city' => 'Corpus Christi','state' => 'Texas'),array('city' => 'Tampa','state' => 'Florida'),array('city' => 'San Bernardino','state' => 'California'),array('city' => 'Austin','state' => 'Texas'),array('city' => 'Fort Wayne','state' => 'Indiana'),array('city' => 'Oakland','state' => 'California'),array('city' => 'Fresno','state' => 'California'),array('city' => 'Miami','state' => 'Florida'),array('city' => 'Huntington','state' => 'New York'),array('city' => 'Milwaukee','state' => 'Wisconsin'),array('city' => 'Jacksonville','state' => 'Florida'),array('city' => 'Washington','state' => 'District of Columbia'),array('city' => 'Laredo','state' => 'Texas'),array('city' => 'Lubbock','state' => 'Texas'),array('city' => 'Tucson','state' => 'Arizona'),array('city' => 'Stockton','state' => 'California'),array('city' => 'Albuquerque','state' => 'New Mexico'),array('city' => 'Phoenix','state' => 'Arizona'),array('city' => 'Durham','state' => 'North Carolina'),array('city' => 'Arlington','state' => 'Texas'),array('city' => 'Boise','state' => 'Idaho'));

    public $style_box = 'display:none;max-width:90%;border-radius: 500px;position:fixed;bottom:10px;left:10px;z-index:9999;background:white;padding: 1em 2.618em;box-shadow: 2px -1px 5px rgba(0,0,0,.15);';

    /* Get the engine going */
    public function __construct() {

        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'plugin_styles' ) );
        add_action( 'admin_menu', array( $this, 'settings_menu' ) );
        add_action( 'admin_init', array($this, 'register_settings') );

        // Logged in users:
        add_filter( 'heartbeat_received', array( $this,'respond_to_browser'), 10, 3 );

        // Logged out users
        add_filter( 'heartbeat_nopriv_received', array( $this,'respond_to_browser'), 10, 3 );

        add_action( 'wp_enqueue_scripts',  array( $this, 'enqueue_scripts'));

    }

    function respond_to_browser($response, $data, $screen_id) {
        if ( isset( $data['wprtsp'] ) ) {
            $shop_type = $this->get_setting('shop_type');
            switch($shop_type) {
                case 'edd': $response = $this->send_edd_records($response, $data, $screen_id);
                break;
                case 'wooc': return $this->send_wooc_records($response, $data, $screen_id);
                break;
                default: $response = $this->send_generated_records($response, $data, $screen_id);
            }
        }
        return $response;
    }

    function send_wooc_records($response, $data, $screen_id) {
        $records = get_transient('wprtsp_wooc_' . $data['wprtsp']);
        //$response['wprtsp'] = json_encode($records);
        $settings = get_transient('wprtsp_wooc');
        if(false === $settings) {
            $settings = $this->generate_wooc_records();
        }
        if($records) {
            $record = array_shift( $records );
            if(empty($record)) {
                return;
            }
            //$records[] = $record;
            $response['wprtsp'] = json_encode( $this->get_wooc_message($record) );
            set_transient('wprtsp_wooc_' . $data['wprtsp'], $records, 1 * HOUR_IN_SECONDS);
            //$message = '<span class="geo" style="text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px;background:url(' . WPRTSP_DIR . 'assets/map.svg ) no-repeat center">Map</span><span class="wprtsp_text" style="display:table;font-weight:bold;font-size: 14px;line-height: 1em;"> ' . $record['first_name'] . ' from ' . $record['location']['city'] . ',' . $record['location']['state'] . '<span class="action" style="margin-top: .5em;display: block; font-weight: 300;color: #aaa;font-size: 12px;line-height: 1em;"> ' . $record['transaction'] . $record['time'] . ' minutes ago</span></span>';
        }
        else {
            //$settings_clone = $settings; // we'll use array_shift but need to reuse the array; so clone it
            $record = array_shift( $settings );
            if(empty($record)) {
                return;
            }
            
            $records[] = $record;
            set_transient('wprtsp_wooc_' . $data['wprtsp'], $settings, 1 * HOUR_IN_SECONDS);
            $response['wprtsp'] = json_encode( $this->get_wooc_message($record) );
            }
        return $response;
    }

    function get_wooc_message($record) {
        $message = '<span class="geo" style="text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px;background:url(' . WPRTSP_DIR . 'assets/map.svg ) no-repeat center">Map</span><span class="wprtsp_text" style="display:table;font-weight:bold;font-size: 14px;line-height: 1em;">' . $record['first_name'] . ' purchased ' . $record['product'] . '<span class="action" style="margin-top: .5em;display: block; font-weight: 300;color: #aaa;font-size: 12px;line-height: 1em;"> ' . $record['time'] . ' ago</span></span>';
        return $message;
    }

    function send_edd_records($response, $data, $screen_id) {
        $records = get_transient('wprtsp_edd_' . $data['wprtsp']);
        $settings = get_transient('wprtsp_edd');
        if(false === $settings) {
            $settings = $this->generate_edd_records();
        }
        if($records) {
            $record = array_shift(array_diff_key( array_keys($settings), $records ));
            if(empty($record)) {
                return;
            }
            $records[] = $record;
            set_transient('wprtsp_edd_' . $data['wprtsp'], $records, 1 * HOUR_IN_SECONDS);
            $response['wprtsp'] = json_encode( $this->get_edd_message($settings[$record]) );
        }
        else {
            $settings_clone = $settings; // we'll use array_shift but need to reuse the array; so clone it
            $record = array_shift(array_keys( $settings_clone ));
            if(empty($record)) {
                return;
            }
            $records[] = $record;
            set_transient('wprtsp_edd_' . $data['wprtsp'], array( $record ), 1 * HOUR_IN_SECONDS);
            $response['wprtsp'] = json_encode( $this->get_edd_message($settings_clone[$record]) );
            }
        return $response;
    }

    function get_edd_message($record) {
        $message = '<span class="geo" style="text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px;background:url(' . WPRTSP_DIR . 'assets/map.svg ) no-repeat center">Map</span><span class="wprtsp_text" style="display:table;font-weight:bold;font-size: 14px;line-height: 1em;">' . $record['first_name'] . ' purchased ' . $record['product'] . '<span class="action" style="margin-top: .5em;display: block; font-weight: 300;color: #aaa;font-size: 12px;line-height: 1em;"> ' . $record['time'] . ' ago</span></span>';
        return $message;
    }
    
    function send_generated_records($response, $data, $screen_id) {
        $response['wprtsp'] = 'this is a generated record';
        $records = get_transient('wprtsp_' . $data['wprtsp']);
        $settings = $this->get_setting('records');
        
        if($records) {
            $record = array_rand( array_diff_key( $settings, $records ));
            if(empty($record)) {
                return;
            }
            $records[] = $record;
            set_transient('wprtsp_' . $data['wprtsp'], $records, 1 * HOUR_IN_SECONDS);
            //$message = '<span class="geo" style="text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px;background:url(' . WPRTSP_DIR . 'assets/map.svg ) no-repeat center">Map</span><span class="wprtsp_text" style="display:table;font-weight:bold;font-size: 14px;line-height: 1em;"> ' . $record['first_name'] . ' from ' . $record['location']['city'] . ',' . $record['location']['state'] . '<span class="action" style="margin-top: .5em;display: block; font-weight: 300;color: #aaa;font-size: 12px;line-height: 1em;"> ' . $record['transaction'] . $record['time'] . ' minutes ago</span></span>';
            $response['wprtsp'] = json_encode( $settings[$record] );
            
        }
        else {
            $record = array_rand( $settings );
            if(empty($record)) {
                return;
            }
            set_transient( 'wprtsp_' . $data['wprtsp'], array($record), 1 * HOUR_IN_SECONDS );
            $response['wprtsp'] = json_encode( $settings[$record] );
            }
        return $response;
    }

    function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }

    function enqueue_scripts(){
        $post_ids = $this->get_setting('post_ids');
        if(is_singular() && in_array(get_the_ID(), $post_ids) ) {
            wp_enqueue_script( 'wprtsp-fp', WPRTSP_DIR .'/assets/fingerprint2.min.js', array(), null, true);
            wp_enqueue_script( 'wprtsp-main', WPRTSP_DIR .'/assets/wprtsp.js', array('heartbeat','jquery'), null, true);
            wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( array('url' => WPRTSP_DIR, 'style' => apply_filters('wprtsp_container_style', $this->style_box), 'shop_type' => $this->get_setting('shop_type') ) ));
        }
    }

    /* Add links below the plugin name on the plugins page */
    function plugin_action_links($links){
        $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=wprtsp') ) .'">Settings</a>';
        return $links;
    }

    /* Enqueue the styles for admin page */
    function plugin_styles(){
        $screen = get_current_screen();
		if( $screen->id == 'toplevel_page_' . basename( __FILE__ , '.php') ) {
			wp_enqueue_style( 'wprtsp', WPRTSP_DIR . 'assets/admin-styles.css' );
		}
    }

    /* Outputs any variable / php objects / arrays in a clear visible frmat */
    function llog($str) {
        echo '<pre>';
        print_r($str);
        echo '</pre>';
    }

    /* Add the settings menu to WP Admin */
    function settings_menu(){
        add_options_page('Social Proof', 'Social Proof', 'manage_options', 'wprtsp', array( $this, 'settings_page' ));
        //add_menu_page('Social Proof', 'Social Proof', 'manage_options', 'wprtsp', array( $this, 'settings_page' ));
    }

    /* Render the settings page */
    function settings_page(){ ?>
        <div class="wrap">
        <h1>WP Real-Time Social-Proof</h1>
        <p>Real-time social-proof of actions users take on your site. Currently this only uses randomly generated name. Actual names of users coming soon.</p>
        <div class="container">
        
            <form method="post" action="options.php">
            <?php settings_fields( 'wprtsp' ); ?>
            <?php do_settings_sections( 'wprtsp' ); ?>
            
            <?php submit_button(); ?>
            </form>
        </div>
    <?php
    }

    function register_settings(){
        register_setting('wprtsp', 'wprtsp', array( $this, 'sanitize' ));

        add_settings_section('wprtsp_main', 'Social Proof Settings', array($this,'main_section_text'), 'wprtsp');
        add_settings_section('wprtsp_generated', 'Generated Records', array($this,'main_section_text'), 'wprtsp');
        
        add_settings_field('wprtsp_shop_type', 'Shop Type', array($this, 'wprtsp_shop_type_html'), 'wprtsp', 'wprtsp_main');  
        add_settings_field('wprtsp_post_ids', 'Post Ids where social proof should show', array($this,'wprtsp_post_ids_string'), 'wprtsp', 'wprtsp_main');
        
        add_settings_field('wprtsp_transaction', 'Primary action', array($this, 'wprtsp_transaction_string'), 'wprtsp', 'wprtsp_generated');
        add_settings_field('wprtsp_transaction_alt', 'Secondary action', array($this,'wprtsp_transaction_alt_string'), 'wprtsp', 'wprtsp_generated');
        

        //add_settings_field('wprtsp_polling', 'Polling interval', array($this,'wprtsp_polling_string'), 'wprtsp', 'wprtsp_main');

    }

    function wprtsp_shop_type_html() { 
            if( class_exists('Easy_Digital_Downloads') ) { ?>
            <label><input type="radio" name="wprtsp[shop_type]" value="edd" <?php checked('edd', $this->get_setting('shop_type'), true); ?>> Use Easy Digital Download purchases</label><br />
            <?php
            }
            if( class_exists('WooCommerce') ) { ?>
             <label><input type="radio" name="wprtsp[shop_type]" value="wooc" <?php checked('wooc', $this->get_setting('shop_type'), true); ?>> Use WooCommerce purchases</label><br />
            <?php
            } ?>
            <label><input type="radio" name="wprtsp[shop_type]" value="generated" <?php checked('generated', $this->get_setting('shop_type'), true); ?>> Use generated records</label><br />
    <?php
    } 

    function main_section_text(){
        //echo '<p>Please provide the following.</p>';
    }

    function wprtsp_transaction_string(){
        //$settings = get_option('wprtsp');
        ?>
        <p>Only applies when <strong>Use generated records</strong> is set.</p>
        <input type="text" class="large-text" placeholder="subscribed to the newsletter" id="wprtsp_transaction_string" name="wprtsp[transaction]" type="text" value="<?php echo esc_attr( $this->get_setting('transaction')); ?>" />
    <?php
    }

    function wprtsp_transaction_alt_string(){
        //$settings = get_option('wprtsp');
        ?>
        <input type="text" class="large-text" placeholder="registered for the webinar" id="wprtsp_transaction_alt_string" name="wprtsp[transaction_alt]" type="text" value="<?php echo esc_attr( $this->get_setting('transaction_alt')); ?>" />
        <p>User names / records will be generated automatically.</p>
    <?php
    }

    function wprtsp_post_ids_string(){
        //$settings = get_option('wprtsp');
        
        ?>
        
        <input type="text" class="large-text" placeholder="post ids separated by comma" id="wprtsp_post_ids_string" name="wprtsp[post_ids]" type="text" value="<?php echo implode(',',$this->get_setting('post_ids')); ?>" />
    <?php
    }

    function wprtsp_polling_string(){
        //$settings = get_option('wprtsp');
        ?>
        <input type="number" placeholder="Min: 15, max: 300" min="15" max="300" placeholder="seconds" id="wprtsp_polling_string" name="wprtsp[polling]" value="<?php echo esc_attr( $this->get_setting('polling')); ?>" />
    <?php
    }

    function get_setting( $setting ) {

        $defaults = $this->defaults();
        $settings = wp_parse_args( get_option( 'wprtsp', $defaults ), $defaults );

        return isset( $settings[ $setting ] ) ? $settings[ $setting ] : false;
    }

    function defaults() {
        $defaults = array(
            'shop_type' => class_exists('Easy_Digital_Downloads') ?  'edd' : ( class_exists( 'WooCommerce' ) ?  'wooc' :  'generated' ),
            'transaction' => 'subscribed to the newsletter',
            'transaction_alt' => 'registered for the webinar',
            'post_ids' => array( get_option( 'page_on_front') ),
            //'polling'  => 15
            'records' => $this->generate_records(array('transaction' => 'subscribed to the newsletter', 'transaction_alt' => 'registered for the webinar')),
            //'edd_records' => $this->generate_edd_records(),
        );

        return $defaults;
    }

    function sanitize( $settings ){

        $settings['records'] = $this->generate_records($settings);
        
        $this->generate_edd_records();
        $this->generate_wooc_records();
       
        $settings['transaction'] = sanitize_text_field($settings['transaction']);
        $settings['transaction_alt'] = sanitize_text_field($settings['transaction_alt']);

        $post_ids = sanitize_text_field(  preg_replace("/[^0-9,]/", "", $settings['post_ids'])   );
        if( strpos(',', $post_ids) !== false ) { // is a comma-separated list of posts
            $post_ids = explode(',', $post_ids);
            $post_ids = array_map('trim', $post_ids); // Trim the fluff
            $post_ids = array_filter($post_ids); // remove trailing commas if they exist
        }
        else {
            $post_ids = array($post_ids); 
        }

        $settings['post_ids'] = $post_ids;
        //$this->llog($settings);
        //die();
        return $settings;
    }

    function generate_records($settings){
        
        $transaction = $settings['transaction'];
        $transaction_alt = $settings['transaction_alt'];

        $indexes = array();
        reset( $this->names );
        reset( $this->locations );
        for ( $i=0; $i < 100; $i++ ) {
            mt_srand( $this->make_seed() );
            $randval = mt_rand();
            $name = explode(' ', current($this->names));
            $indexes[$i] = array('first_name' => $name[0], 'last_name' => $name[1], 'location' =>  current($this->locations), 'transaction' => ($randval % 2) ? $transaction : $transaction_alt );
            next($this->locations);
            next($this->names);
        }
        return $indexes;
        //return array_combine($this->names, $interactions);
    }

    function generate_edd_records() {
        if(! class_exists('Easy_Digital_Downloads')){
            return false;
        }
        $args = array(
            'numberposts'      => 10,
            'post_status'      => 'publish',			
            'post_type'        => 'edd_payment',
            'suppress_filters' => true, 
            );						
        $payments = get_posts( $args );			
        $records = array();
        if ( $payments ) { 
            //$out .= '<ul class="wow_edd_recent_purchases">';			
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
                $records[$payment_post->ID] = array('first_name' => $payment->user_info['first_name'], 'last_name' => $payment->user_info['last_name'], 'transaction' => 'purchased', 'product' => $downloads[0]['name'] , 'time' => $payment_time);
                
            }
            wp_reset_postdata();
            //$out .= '</ul>';
        }
        return set_transient( 'wprtsp_edd', $records, 30 * MINUTE_IN_SECONDS );
    }

    function generate_wooc_records() {
        if( ! class_exists('WooCommerce') ) {
            return false;
        }
        $query = new WC_Order_Query( array(
            'limit' => 10,
            'orderby' => 'date',
            'order' => 'DESC',
            'return' => 'ids',
            'status' => 'completed'
        ) );
        $orders = $query->get_orders();
        $customers = array();
        foreach($orders as $purchase) {
            
            $order = wc_get_order($purchase);
            $user = $order->get_user();
            
            if(!empty($user)) {
                $customers[$purchase]['first_name'] = empty($user->user_firstname) ? 'Guest' : $user->user_firstname ;
                $customers[$purchase]['last_name'] = empty($user->user_lastname) ? 'Guest' : $user->user_lastname ;
            }
            else {
                $customers[$purchase]['first_name'] = 'Guest';
                $customers[$purchase]['last_name'] = 'Guest';
            }
            $item = $order->get_items();
            $item = array_shift($item);
            $customers[$purchase]['transaction'] = 'purchased';
            $customers[$purchase]['product'] = $item->get_name();
            $time = new WC_DateTime( $order->get_date_completed() );
            $customers[$purchase]['time'] = human_time_diff($time->getTimestamp());
        }
        return set_transient( 'wprtsp_wooc', $customers, 30 * MINUTE_IN_SECONDS);
    }
}

$wprtsp = new WPRTSP();

// add_filter('the_content','generate_wooc_records');


