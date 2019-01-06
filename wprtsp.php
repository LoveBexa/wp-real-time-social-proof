<?php
/**
 * Plugin Name: WP Real-Time Social-Proof
 * Description: Animated, live, real-time social-proof Pop-ups for your WordPress website to boost sales and signups.
 * Version:     1.6
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

namespace wprtsp;

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
			$instance->includes();
			$instance->setup_actions();
		}
		return $instance;
    }

    function setup(){
        $this->dir = trailingslashit( plugin_dir_path( __FILE__ ) );
        $this->uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );
        //$this-llog( plugin_dir_path( __FILE__ ) );\
        //print_r(plugin_dir_url( __FILE__ ) );
        //die();
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
        add_action( 'admin_menu', array( $this, 'settings_menu' ) );
        add_action( 'admin_init', array($this, 'register_settings') );
        add_filter( 'heartbeat_received', array( $this,'respond_to_browser'), 10, 3 ); // Logged in users:
        add_filter( 'heartbeat_nopriv_received', array( $this,'respond_to_browser'), 10, 3 ); // Logged out users
        add_action( 'wp_enqueue_scripts',  array( $this, 'enqueue_scripts'));
        add_action( 'add_meta_boxes', array( $this,'add_meta_boxes' ));
        add_action( 'save_post', array($this, 'save_meta_box_data' ));

        add_action('wprtsp_general_meta_settings',array( __NAMESPACE__, 'wprtsppro_general_meta' ));

        $styles = $this->get_style();
        $this->style_box = $styles['box_style'];
        $this->wprtsp_notification_style = $styles['wprtsp_notification_style'];
        $this->wprtsp_text_style = $styles['wprtsp_text_style'];
        $this->wprtsp_action_style = $styles['wprtsp_action_style'];

        $this->sound_notification = $this->get_setting('sound_notification');
        if($this->sound_notification) {
            $this->sound_notification_markup = '<audio preload="auto" autoplay="true" src="'.$this->uri.'assets/sounds/unsure.mp3">Your browser does not support the <code>audio</code>element.</audio>';
        }
        else {
            $this->sound_notification_markup = '';
        }
    }


    function add_meta_boxes(){
        add_meta_box( 'social-proof-general', __( 'General', 'erm' ), array($this, 'general_meta_box'), 'socialproof', 'normal');
        add_meta_box( 'social-proof-conversions', __( 'Conversions', 'erm' ), array($this, 'conversions_meta_box'), 'socialproof', 'normal');
    }

    function cpt_defaults() {
        $defaults = array(

                'general_show_on' => '2',
                'general_duration' => '4',
                'general_initial_popup_time' => '5',
                'general_subsequent_popup_time' => '15',

                'conversions_enable' => 1,
                'conversions_show_on_mobile' => 1,
                'conversions_shop_type' => class_exists('Easy_Digital_Downloads') ?  'edd' : ( class_exists( 'WooCommerce' ) ?  'wooc' :  'generated' ),
                'conversions_transaction' => 'subscribed to the newsletter',
                'conversions_transaction_alt' => 'registered for the webinar',
                //'conversions_records' => $this->generate_records(array('transaction' => 'subscribed to the newsletter', 'transaction_alt' => 'registered for the webinar')),
                'conversions_sound_notification' => 0,
                'conversions_position' => 'bl',
                
                'positions' => array('bl' => 'Bottom Left', 'br' => 'Bottom Right')

        );

        return apply_filters('wprtsp_cpt_defaults', $defaults);
    }
    function general_meta_box(){
        global $post;
        wp_nonce_field( 'socialproof_meta_box_nonce', 'socialproof_meta_box_nonce' );

        if( apply_filters('wprtsp_general_meta', true) ) {
        $settings = get_post_meta($post->ID, '_socialproof', true);
        $this->llog($settings);
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
                    <!-- <input type="radio" id="wprtsp_general_show_on1" name="wprtsp[general_show_on]" value="<?php echo $post_ids; ?>></td> -->
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
                //alert($('#wprtsp_general_show_on').val());
                //$('#post_ids_selector').slideToggle(400);
                if($('#wprtsp_general_show_on').val() == 1 ) {
                    $('#wprtsp_general_post_ids').attr('readonly', 'true');
                    //$('#post_ids_selector').fadeOut(400);
                    //$('#post_ids_selector').hide(400);
                    //$('#post_ids_selector').css('height', '0px');
                }
                else {
                    $('#wprtsp_general_post_ids').removeAttr('readonly');
                    //$('#post_ids_selector').fadeIn(400);
                    //$('#post_ids_selector').show(400);
                    //$('#post_ids_selector').css('height', 'auto');
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

    function conversions_meta_box(){
        global $post;
        if( apply_filters('wprtsp_conversions_meta', true) ) {
        $settings = get_post_meta($post->ID, '_socialproof', true);
        $defaults = $this->cpt_defaults();
        $conversions_enable = $settings['conversions_enable'];
        $conversions_shop_type = $settings['conversions_shop_type'];
        $conversions_transaction = $settings['conversions_transaction'];
        $conversions_transaction_alt = $settings['conversions_transaction_alt'];
        $conversions_sound_notification = $settings['conversions_sound_notification'];
        $conversions_position = array_key_exists('conversions_position', $settings) ? $settings['conversions_position'] : 'bl';

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
                    <input id="wprtsp[conversions_enable]" name="wprtsp[conversions_enable]" type="checkbox" value="1" <?php checked( $conversions_enable, '1' , true); ?>/>
                </td>
            </tr>
            <tr>
                <td><label for="wprtsp[conversions_shop_type]">Source</label></td>
                <td><select id="wprtsp[conversions_shop_type]" name="wprtsp[conversions_shop_type]">
                        <?php echo $sources_html; ?>
                    </select></td>
            </tr>
            <tr>
                <td><label for="wprtsp[conversions_transaction]">Transaction 1 for Generated Records</label></td>
                <td><input id="wprtsp[conversions_transaction]" name="wprtsp[conversions_transaction]" type="text" class="widefat" value="<?php echo $conversions_transaction ?>" /></td>
            </tr>
            <tr>
                <td><label for="wprtsp[conversions_transaction_alt]">Transaction 2 for Generated Records</label></td>
                <td><input id="wprtsp[conversions_transaction_alt]" name="wprtsp[conversions_transaction_alt]" type="text" class="widefat" value="<?php echo $conversions_transaction_alt ?>" /></td>
            </tr>
            <tr>
                <td><label for="wprtsp[conversions_position]">Position</label></td>
                <td><select id="wprtsp[conversions_position]" name="wprtsp[conversions_position]">
                        <?php echo $positions_html; ?>
                    </select></td>
            </tr>
            <tr>
                <td><label for="wprtsp[conversions_sound_notification]">Enable Sound Notification</label></td>
                <td><input id="wprtsp[conversions_sound_notification]" name="wprtsp[conversions_sound_notification]" type="checkbox" value="1" <?php checked( $conversions_sound_notification, '1' , true); ?>/></td>
            </tr>
        </table>
        <?php
        }
        else {
            do_action('wprtsp_conversions_meta_settings');
        }
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

        
        $general_show_on = sanitize_text_field($_POST['wprtsp']['general_show_on']);
        $general_duration = sanitize_text_field($_POST['wprtsp']['general_duration']);
        $general_initial_popup_time = sanitize_text_field($_POST['wprtsp']['general_initial_popup_time']);
        $general_subsequent_popup_time = sanitize_text_field($_POST['wprtsp']['general_subsequent_popup_time']);
        $general_post_ids = sanitize_text_field($_POST['wprtsp']['general_post_ids']);

        $conversions_enable = sanitize_text_field($_POST['wprtsp']['conversions_enable']);
        $conversions_shop_type = sanitize_text_field($_POST['wprtsp']['conversions_shop_type']);
        $conversions_transaction = sanitize_text_field($_POST['wprtsp']['conversions_transaction']);
        $conversions_transaction_alt = sanitize_text_field($_POST['wprtsp']['conversions_transaction_alt']);
        $conversions_sound_notification = sanitize_text_field($_POST['wprtsp']['conversions_sound_notification']);
        $conversions_position = sanitize_text_field($_POST['wprtsp']['conversions_position']);

        $settings = array(

            'general_show_on' => $general_show_on,
            'general_duration' => $general_duration,
            'general_initial_popup_time' => $general_initial_popup_time,
            'general_subsequent_popup_time' => $general_subsequent_popup_time,
            'general_post_ids' => $general_post_ids,

            'conversions_enable' => $conversions_enable,
            'conversions_shop_type' => $conversions_shop_type,
            'conversions_transaction' => $conversions_transaction,
            'conversions_transaction_alt' => $conversions_transaction_alt,
            'conversions_sound_notification' => $conversions_sound_notification,
            'conversions_position' => $conversions_position,

        );
        
        $settings['records'] = $this->generate_records($settings);
        $this->generate_edd_records();
        $this->generate_wooc_records();
        $settings = wp_parse_args( $settings, $this->cpt_defaults() );
        update_post_meta( $post_id, '_socialproof', $settings );

    }

    function get_global_locations( $setting ) {
        
        $settings =  get_option( 'wprtsp_global_locations', $defaults);
        
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
            'not_found_in_trash'    => __( 'not_found_in_trash', 'erm' ),
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

    /* Get the engine going */
    private function __construct() {}

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
            $response['wprtsp'] = json_encode( $this->get_wooc_message($record) );
            set_transient('wprtsp_wooc_' . $data['wprtsp'], $records, 1 * HOUR_IN_SECONDS);
        }
        else {
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

    function get_style(){
        $position = $this->get_setting('position');
        switch($position) {
            case 'bl': $position_css = 'bottom: 10px; left:10px';
            break;
            case 'br': $position_css = 'bottom: 10px; right:10px';
            break;
            
        }
        $box_style = apply_filters('style_box', 'display:none; font-family: Helvetica, arial, sans-serif; font-size: 14px; max-width:90%; border-radius: 500px; position:fixed; bottom:10px; '.$position_css.'; z-index:9999; background:white; padding: 1em 2.618em; box-shadow: 2px -1px 5px rgba(0,0,0,.15);');
        $wprtsp_notification_style = apply_filters( 'wprtsp_notification_style', 'text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px; background:url(' . $this->uri . 'assets/map.svg ) no-repeat center;');
        $wprtsp_text_style = apply_filters( 'wprtsp_text_style', 'display:table; font-weight:bold; font-size: 14px; line-height: 1em;');
        $wprtsp_action_style = apply_filters( 'wprtsp_action_style', 'margin-top: .5em; display: block; font-weight: 300; color: #aaa; font-size: 12px; line-height: 1em;' );
        return array(
            'box_style' => $box_style,
            'wprtsp_notification_style' => $wprtsp_notification_style,
            'wprtsp_text_style' => $wprtsp_text_style,
            'wprtsp_action_style' => $wprtsp_action_style,
        );
    }

    function get_wooc_message($record) {
        
        if($this->get_setting('link_product')) {
            $message = $this->sound_notification_markup.'<span class="geo wprtsp_notification" style="'.$this->wprtsp_notification_style.'">Map</span><span class="wprtsp_text" style="'.$this->wprtsp_text_style.'"><span class="wprtsp_name">' . $record['first_name'] . '</span> purchased <a href="'.$record['product_link'].'">' . $record['product'] . '</a><span class="action" style="'.$this->wprtsp_action_style.'"> ' . $record['time'] . ' ago</span></span>';   
        }
        else {
            $message = $this->sound_notification_markup.'<span class="geo wprtsp_notification" style="'.$this->wprtsp_notification_style.'">Map</span><span class="wprtsp_text" style="'.$this->wprtsp_text_style.'"><span class="wprtsp_name">' . $record['first_name'] . '</span> purchased ' . $record['product'] . '<span class="action" style="'.$this->wprtsp_action_style.'"> ' . $record['time'] . ' ago</span></span>';
        }
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
        if( $this->get_setting('link_product') ) {
            $message = $this->sound_notification_markup.'<span class="geo wprtsp_notification" style="'.$this->wprtsp_notification_style.'">Map</span><span class="wprtsp_text" style="'.$this->wprtsp_text_style.'"><span class="wprtsp_name">' . $record['first_name'] . '</span> purchased <a href="'.$record['product_link'].'">' . $record['product'] . '</a><span class="action" style="'.$this->wprtsp_action_style.'"> ' . $record['time'] . ' ago</span></span>';    
        }
        else {
            $message = $this->sound_notification_markup.'<span class="geo wprtsp_notification" style="'.$this->wprtsp_notification_style.'">Map</span><span class="wprtsp_text" style="'.$this->wprtsp_text_style.'"><span class="wprtsp_name">' . $record['first_name'] . '</span> purchased ' . $record['product'] . '<span class="action" style="'.$this->wprtsp_action_style.'"> ' . $record['time'] . ' ago</span></span>';
        }
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

    function enable_notifications(){
        $notifications  = \get_posts( array( 'post_type' => 'socialproof', 'posts_per_page' => -1 ) );
        $active_notifications = array();
        foreach($notifications as $notification) {
            $meta = \get_post_meta($notification->ID, '_socialproof', true);
            
            $show_on = $meta['general_show_on'];
            //$this->llog($show_on);
            //die();
            switch($show_on) {
                case '1':
                    $social_proof_settings = $this->get_cpt_settings($meta);
                    //$social_proof_settings = $this->get_cpt_settings( $social_proof_settings );
                    //$this->llog('jsvars');
                    //$this->llog($social_proof_settings);
                    //die();
                    wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
                    wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtspcpt.js', array('heartbeat','jquery'), null, true);
                    wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( $social_proof_settings ) );
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
                        $social_proof_settings = $this->get_cpt_settings($meta);
                        wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
                        wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtspcpt.js', array('heartbeat','jquery'), null, true);
                        wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( array('url' => $this->uri, 'wprtsp_notification_style' => $this->wprtsp_notification_style, 'wprtsp_sound_notification' => $this->sound_notification ? true: false, 'wprtsp_sound_notification_markup' => $this->sound_notification_markup, 'wprtsp_text_style' => $this->wprtsp_text_style, 'wprtsp_action_style' => $this->wprtsp_action_style, 'style_box' => apply_filters('wprtsp_container_style', $this->style_box), 'shop_type' => $this->get_setting('shop_type'), 'initial_popup_time' => ( 1 * $this->get_setting('initial_popup_time') ), 'subsequent_popup_time' => ( 1 * $this->get_setting('subsequent_popup_time') ), ) ));
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
                            $social_proof_settings = $this->get_cpt_settings($meta);
                            wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
                            wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtspcpt.js', array('heartbeat','jquery'), null, true);
                            wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( array('url' => $this->uri, 'wprtsp_notification_style' => $this->wprtsp_notification_style, 'wprtsp_sound_notification' => $this->sound_notification ? true: false, 'wprtsp_sound_notification_markup' => $this->sound_notification_markup, 'wprtsp_text_style' => $this->wprtsp_text_style, 'wprtsp_action_style' => $this->wprtsp_action_style, 'style_box' => apply_filters('wprtsp_container_style', $this->style_box), 'shop_type' => $this->get_setting('shop_type'), 'initial_popup_time' => ( 1 * $this->get_setting('initial_popup_time') ), 'subsequent_popup_time' => ( 1 * $this->get_setting('subsequent_popup_time') ), ) ));
                        }
                    break;
            }
        }
    }

    function get_cpt_settings($meta){
        //$this->llog('meta');
        //$this->llog($meta);
        $position = $meta['conversions_position'];
        $position_css = '';
        switch($position) {
            case 'bl': $position_css = 'bottom: 10px; left:10px';
            break;
            case 'br': $position_css = 'bottom: 10px; right:10px';
            break;
        }

        $vars = array(
            'url' => $this->uri,
            'conversions_container_style' => apply_filters( 'wprtsp_conversions_container_style', 'display:none; font-family: Helvetica, arial, sans-serif; font-size: 14px; max-width:90%; border-radius: 500px; position:fixed; bottom:10px; '.$position_css.'; z-index:9999; background:white; padding: 1em 2.618em; box-shadow: 2px -1px 5px rgba(0,0,0,.15);' ),
            'conversions_notification_style' => apply_filters('wprtsp_conversions_notification_style', 'text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px; background:url(' . $this->uri . 'assets/map.svg ) no-repeat center;' ),
            'conversions_action_style' => apply_filters( 'wprtsp_conversions_action_style', 'margin-top: .5em; display: block; font-weight: 300; color: #aaa; font-size: 12px; line-height: 1em;' ),
            'conversions_text_style' => apply_filters( 'wprtsp_conversions_text_style', 'display:table; font-weight:bold; font-size: 14px; line-height: 1em;' ),
            'conversions_sound_notification' => apply_filters('wprtsp_conversions_sound_notification', ( $meta['conversions_sound_notification'] == '1' ) ? true : false),
            'conversions_sound_notification_markup' => apply_filters( 'wprtsp_conversions_sound_notification_markup','<audio preload="auto" autoplay="true" src="' . $this->uri .'assets/sounds/unsure.mp3">Your browser does not support the <code>audio</code>element.</audio>'),
            'conversions_shop_type' => apply_filters( 'wprtsp_conversions_shop_type', $meta['conversions_shop_type'] ),
            'general_duration' => apply_filters( 'wprtsp_general_duration', (int) $meta['general_duration'] ),
            'general_initial_popup_time' => apply_filters( 'wprtsp_general_initial_popup_time', (int) $meta['general_initial_popup_time'] ),
            'general_subsequent_popup_time' => apply_filters('wprtsp_general_subsequent_popup_time', (int) $meta['general_subsequent_popup_time'] )
        );

        //$this->llog($vars);
        //die();
        return $vars;
        /*
        $box_style = apply_filters('style_box', 'display:none; font-family: Helvetica, arial, sans-serif; font-size: 14px; max-width:90%; border-radius: 500px; position:fixed; bottom:10px; '.$position_css.'; z-index:9999; background:white; padding: 1em 2.618em; box-shadow: 2px -1px 5px rgba(0,0,0,.15);');
        $wprtsp_notification_style = apply_filters( 'wprtsp_notification_style', 'text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px; background:url(' . $this->uri . 'assets/map.svg ) no-repeat center;');
        $wprtsp_text_style = apply_filters( 'wprtsp_text_style', 'display:table; font-weight:bold; font-size: 14px; line-height: 1em;');
        $wprtsp_action_style = apply_filters( 'wprtsp_action_style', 'margin-top: .5em; display: block; font-weight: 300; color: #aaa; font-size: 12px; line-height: 1em;' );
        return array(
            'box_style' => $box_style,
            'wprtsp_notification_style' => $wprtsp_notification_style,
            'wprtsp_text_style' => $wprtsp_text_style,
            'wprtsp_action_style' => $wprtsp_action_style,
        );
        */
    }

    function enqueue_scripts(){
        $show_on = $this->get_setting('show_on');
        if($show_on == 2) { // Enqueue on selected pages only
            $post_ids = $this->get_setting('post_ids');
            if(! is_array($post_ids)) {
                if(strpos($post_ids, ',') !== false ){
                    $post_ids = explode(',', $post_ids);
                }
                else {
                    $post_ids = array($post_ids);
                }
            }
            if(  is_singular()  && in_array(get_the_ID(), $post_ids) ) {
                wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
                wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtsp.js', array('heartbeat','jquery'), null, true);
                wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( array('url' => $this->uri, 'wprtsp_notification_style' => $this->wprtsp_notification_style, 'wprtsp_sound_notification' => $this->sound_notification ? true: false, 'wprtsp_sound_notification_markup' => $this->sound_notification_markup, 'wprtsp_text_style' => $this->wprtsp_text_style, 'wprtsp_action_style' => $this->wprtsp_action_style, 'style_box' => apply_filters('wprtsp_container_style', $this->style_box), 'shop_type' => $this->get_setting('shop_type'), 'initial_popup_time' => ( 1 * $this->get_setting('initial_popup_time') ), 'subsequent_popup_time' => ( 1 * $this->get_setting('subsequent_popup_time') ), ) ));
            }
        }
        if($show_on == 1) {
            wp_enqueue_script( 'wprtsp-fp', $this->uri .'assets/fingerprint2.min.js', array(), null, true);
            wp_enqueue_script( 'wprtsp-main', $this->uri .'assets/wprtsp.js', array('heartbeat','jquery'), null, true);
            wp_localize_script( 'wprtsp-main', 'wprtsp_vars', json_encode( array('url' => $this->uri, 'wprtsp_notification_style' => $this->wprtsp_notification_style, 'wprtsp_sound_notification' => $this->sound_notification ? true: false, 'wprtsp_sound_notification_markup' => $this->sound_notification_markup, 'wprtsp_text_style' => $this->wprtsp_text_style, 'wprtsp_action_style' => $this->wprtsp_action_style, 'style_box' => apply_filters('wprtsp_container_style', $this->style_box), 'shop_type' => $this->get_setting('shop_type'), 'initial_popup_time' => ( 1 * $this->get_setting('initial_popup_time') ), 'subsequent_popup_time' => ( 1 * $this->get_setting('subsequent_popup_time') ), ) ));
        }
        $this->enable_notifications();
        
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
			wp_enqueue_style( 'wprtsp', $this->uri . 'assets/admin-styles.css' );
        }
        if($screen->post_type == 'socialproof') {
            wp_enqueue_style( 'wprtsp-cpt', $this->uri . 'assets/cpt-styles.css' );
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
    }

    /* Render the settings page */
    function settings_page(){ ?>
        <div class="wrap">
        <h1>WP Real-Time Social-Proof</h1>
        <p>Real-time social-proof of actions users take on your site. Works with WooCommerce, EDD or randomly generated name. Data-import options coming soon.</p>
        <div class="container" style="display: table; width: 100%; table-layout: fixed;">
            <form method="post" action="options.php" style="display: table-cell; width: 100%;vertical-align: top">
            <?php settings_fields( 'wprtsp' ); ?>
            <?php do_settings_sections( 'wprtsp' ); ?>
            <?php submit_button(); ?>
            </form>
            <div class="wprtsp_update" style="background: #f2d87e url(<?php echo $this->uri ?>assets/expression.jpg) no-repeat center top; background-size: contain; display: table-cell; width: 261px; vertical-align: top; border-top-left-radius:50px; border-bottom-right-radius:50px;"><div class="wprtsp_update_content" style="margin-top: 260px; padding: 1em; background-image: linear-gradient(to right,#f2d87e,#fea,#f2d87e);"><h3 style="line-height: 1.2em">It's all about credibility and subtly gaining attention to impress your message</h3><p><a href="https://wp-social-proof.com">WP Social Proof Pro</a> has more settings, custom animations, sound notifications, extra cards, custom popup positions, notifications in the browser tab. And there's lot's more… a whole library of</p><ol><li>Animations</li><li>Notification Sounds</li><li>Notification cards</li><li>Verified sales badge</li><li>And lots more in development</li></ol><p><strong>Get WP Social Proof Pro <a href="https://wp-social-proof.com">WP-Social-Proof.Com</a></strong> and get a cutting edge — <em>before your competitor does!</em></p></div></div>
        </div>
    <?php
    }

    function register_settings(){
        register_setting('wprtsp', 'wprtsp', array( $this, 'sanitize' ));
        
        add_settings_section('wprtsp_main', 'Social Proof Settings', array($this,'main_section_text'), 'wprtsp');
        add_settings_section('wprtsp_generated', 'Generated Records', array($this,'main_section_text'), 'wprtsp');        

        add_settings_field('wprtsp_shop_type', 'Shop Type', array($this, 'wprtsp_shop_type_html'), 'wprtsp', 'wprtsp_main');
        add_settings_field('wprtsp_link_product', 'Link to product page', array($this, 'wprtsp_link_html'), 'wprtsp', 'wprtsp_main');
        add_settings_field('wprtsp_show_on', 'Where to show social proof', array($this,'wprtsp_show_on_html'), 'wprtsp', 'wprtsp_main');
        add_settings_field('wprtsp_post_ids', 'Post Ids where social proof should show', array($this,'wprtsp_post_ids_string'), 'wprtsp', 'wprtsp_main');
        add_settings_field('wprtsp_initial_popup_time', 'First appearance after these seconds', array($this,'wprtsp_initial_popup_time_string'), 'wprtsp', 'wprtsp_main');
        add_settings_field('wprtsp_subsequent_popup_time', 'Appear every these many seconds', array($this,'wprtsp_subsequent_popup_time_string'), 'wprtsp', 'wprtsp_main');
        add_settings_field('wprtsp_popup_position', 'Popup Position', array($this,'wprtsp_popup_position_html'), 'wprtsp', 'wprtsp_main');
        add_settings_field('wprtsp_sound_notification', 'Sound Notification', array($this,'wprtsp_sound_notification_html'), 'wprtsp', 'wprtsp_main');
        
        add_settings_field('wprtsp_transaction', 'Primary action', array($this, 'wprtsp_transaction_string'), 'wprtsp', 'wprtsp_generated');
        add_settings_field('wprtsp_transaction_alt', 'Secondary action', array($this,'wprtsp_transaction_alt_string'), 'wprtsp', 'wprtsp_generated');
    }

    function wprtsp_link_html(){
    ?>
    <input name="wprtsp[link_product]" type="checkbox" value="1" <?php checked( $this->get_setting('link_product'), '1', true); ?>/>
    <?php
    }

    function wprtsp_sound_notification_html() {
    ?>
    <input name="wprtsp[sound_notification]" type="checkbox" value="1" <?php checked( $this->get_setting('sound_notification'), '1', true); ?>/>
    <?php
    }

    function wprtsp_initial_popup_time_string(){ ?>
        <select id="wprtsp_initial_popup_time_string" name="wprtsp[initial_popup_time]">
        <option value="5" <?php selected( $this->get_setting('initial_popup_time'), 5 ); ?> >5</option>
        <option value="15" <?php selected( $this->get_setting('initial_popup_time'), 15 ); ?> >15</option>
        <option value="30" <?php selected( $this->get_setting('initial_popup_time'), 30 ); ?> >30</option>
        <option value="60" <?php selected( $this->get_setting('initial_popup_time'), 60 ); ?> >60</option>
        <option value="120" <?php selected( $this->get_setting('initial_popup_time'), 120 ); ?> >120</option>
    </select>
    <?php
    }
    
    function wprtsp_subsequent_popup_time_string(){ ?>
        <select id="wprtsp_subsequent_popup_time_string" name="wprtsp[subsequent_popup_time]">
        <option value="5" <?php selected( $this->get_setting('subsequent_popup_time'), 5 ); ?> >5</option>
        <option value="15" <?php selected( $this->get_setting('subsequent_popup_time'), 15 ); ?> >15</option>
        <option value="30" <?php selected( $this->get_setting('subsequent_popup_time'), 30 ); ?> >30</option>
        <option value="60" <?php selected( $this->get_setting('subsequent_popup_time'), 60 ); ?> >60</option>
        <option value="120" <?php selected( $this->get_setting('subsequent_popup_time'), 120 ); ?> >120</option>
        </select>
        <?php
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
        ?>
        <p>Only applies when <strong>Use generated records</strong> is set.</p>
        <input type="text" class="large-text" placeholder="subscribed to the newsletter" id="wprtsp_transaction_string" name="wprtsp[transaction]" type="text" value="<?php echo esc_attr( $this->get_setting('transaction')); ?>" />
    <?php
    }

    function wprtsp_transaction_alt_string(){
        ?>
        <input type="text" class="large-text" placeholder="registered for the webinar" id="wprtsp_transaction_alt_string" name="wprtsp[transaction_alt]" type="text" value="<?php echo esc_attr( $this->get_setting('transaction_alt')); ?>" />
        <p>User names / records will be generated automatically.</p>
    <?php
    }

    function wprtsp_popup_position_html(){
        ?>
        <select id="wprtsp_popup_position" name="wprtsp[position]">
        <option value="bl" <?php selected( $this->get_setting('position'), 'bl' ); ?> >Bottom Left</option>
        <option value="br" <?php selected( $this->get_setting('position'), 'br' ); ?> >Bottom Right</option>
    </select>
        <?php
        }

    function wprtsp_show_on_html(){
    ?>
    <label><input type="radio" name="wprtsp[show_on]" value="1" <?php checked('1', $this->get_setting('show_on'), true); ?>>Entire Site</label>
    <label><input type="radio" name="wprtsp[show_on]" value="2" <?php checked('2', $this->get_setting('show_on'), true); ?>>Selected Posts</label>
    <?php
    }

    function wprtsp_post_ids_string(){
        ?>
        <input type="text" class="large-text" placeholder="post ids separated by comma" id="wprtsp_post_ids_string" name="wprtsp[post_ids]" type="text" value="<?php echo $this->get_setting('post_ids'); ?>" />
    <?php
    }

    function wprtsp_polling_string(){
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
            'show_on' => '1',
            'link_product' => '1',
            'sound_notification' => '0',
            'position' => 'bl',
            'post_ids' => get_option( 'page_on_front'),
            'initial_popup_time' => '5',
            'subsequent_popup_time' => '15',
            'records' => $this->generate_records(array('transaction' => 'subscribed to the newsletter', 'transaction_alt' => 'registered for the webinar')),
        );
        return $defaults;
    }

    function sanitize( $settings ) {
        $settings['records'] = $this->generate_records($settings);
        $this->generate_edd_records();
        $this->generate_wooc_records();
        $settings['transaction'] = sanitize_text_field($settings['transaction']);
        $settings['transaction_alt'] = sanitize_text_field($settings['transaction_alt']);
        $settings['post_ids'] = sanitize_text_field(  preg_replace("/[^0-9,]/", "", $settings['post_ids']) ) ;
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
    }

    function generate_edd_records() {
        if(! class_exists('Easy_Digital_Downloads')){
            return false;
        }
        $args = array(
            'numberposts'      => 100,
            'post_status'      => 'publish',			
            'post_type'        => 'edd_payment',
            'suppress_filters' => true, 
            );						
        $payments = get_posts( $args );			
        $records = array();
        if ( $payments ) { 
            foreach ( $payments as $payment_post ) { 
                setup_postdata($payment_post);
                $payment      = new \EDD_Payment( $payment_post->ID );
                if(empty($payment->ID)) {
                    continue;
                }
                
                $payment_time   = human_time_diff(strtotime( $payment->date ), current_time('timestamp'));
                $customer       = new \EDD_Customer( $payment->customer_id );
                $downloads = $payment->cart_details;
                $downloads = array_slice($downloads, 0, 1, true);
                
                $records[$payment_post->ID] = array('product_link'=>get_permalink( $downloads[0]['id'] ),'first_name' => $payment->user_info['first_name'], 'last_name' => $payment->user_info['last_name'], 'transaction' => 'purchased', 'product' => $downloads[0]['name'] , 'time' => $payment_time);
            }
            wp_reset_postdata();
        }
        
        return set_transient( 'wprtsp_edd', $records, 30 * MINUTE_IN_SECONDS );
    }

    function generate_wooc_records() {
        if( ! class_exists('WooCommerce') ) {
            return false;
        }
        $query = new \WC_Order_Query( array(
            'limit' => 100,
            'orderby' => 'date',
            'order' => 'DESC',
            'return' => 'ids',
            'status' => 'completed'
        ) );
        $orders = $query->get_orders();
        $customers = array();
        foreach($orders as $purchase) {
            $order = \wc_get_order($purchase);
            
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
            $customers[$purchase]['product_link'] = get_permalink($item->get_product_id());
            $time = new WC_DateTime( $order->get_date_completed() );
            $customers[$purchase]['time'] = human_time_diff($time->getTimestamp());
        }
        return set_transient( 'wprtsp_wooc', $customers, 30 * MINUTE_IN_SECONDS);
    }
}

function wprtsp() {
	return WPRTSP::get_instance();
}

// Let's roll!
wprtsp();