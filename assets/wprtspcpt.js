if (jQuery) {
    jQuery(document).ready(function ($) {
        time = Date.now();
        wprtsp_settings = JSON.parse(wprtsp_vars);
        console.dir(wprtsp_settings);
        /* if(wprtsp_settings.conversions_sound_notification){
            var wprtsp_audio = jQuery('#wprtsp_audio').length ? jQuery('#wprtsp_audio') : jQuery('<audio/>', {
            id: 'wprtsp_audio',
            class: 'wprtsp_audio',
            preload: 'auto',
            src: wprtsp_settings.conversions_sound_notification_file
        }).appendTo('body');
        } */
        //wp.heartbeat.interval(wprtsp_settings.general_initial_popup_time);
        /*new Fingerprint2().get(function (result, components) {
            jQuery(document).on('heartbeat-send', function (e, data) {
                data['wprtsp'] = result + '_' + time;
                //console.log(data['wprtsp']);
                data['wprtsp_notification_id'] = wprtsp_settings.id;
            });
        })
        var prime1 = [3, 7, 13, 19, 29];
        var prime2 = [5, 11, 17, 23, 31];
        
        
        */

        
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        
		//jQuery.ajax(wprtsp_settings.ajaxurl, data, function(response) {
		//	console.log(response);
        //});
        
        
        jQuery.ajax({
            url: wprtsp_settings.ajaxurl,
            type: "post",
            dataType: "json",
            data: {
                    'action': 'wprtsp_handle_ajax',
                    'wprtsp': {
                        'settings': wprtsp_settings,
                        'get_proofs': {
                            'conversionstats': {
                                'conversions_shop_type': wprtsp_settings.conversions_shop_type
                            },
                            'livestats': {
                                'visitors': true
                            },
                            'hotstats': {
                                'conversions_shop_type': wprtsp_settings.conversions_shop_type,
                                'transaction_type': 'WC_Order_Query',
                                'duration': '72hrs'
                            },
                            'ctas': {
                                'something': true
                            }
                        }
                    }
                },
            success: function(msg){
                console.log(msg); // data is already json, no need to parse
            },
            error: function(jqXHR, textStatus){
                //console.log(jqXHR);
                //console.log(textStatus);
            },
        });
        
        /* jQuery(document).on('heartbeat-tick', function (event, data) {
            if (data.hasOwnProperty('wprtsp')) {
                wp.heartbeat.interval(wprtsp_settings.general_subsequent_popup_time); // don't pop-up too much
                
                var wprtsp_pop = jQuery('#wprtsp_pop').length ? jQuery('#wprtsp_pop') : jQuery('<span/>', {
                    id: 'wprtsp_pop',
                    class: 'wprtsp_pop',
                }).appendTo('body');
                
                wprtsp_pop.attr('style', wprtsp_settings.conversions_container_style);
                result = JSON.parse(data['wprtsp']);
                console.log(result);
                if ( wprtsp_settings.conversions_shop_type == 'Generated' ) {
                    if (!prime1.length) {
                        prime1 = [5, 11, 17, 23, 31];
                    }
                    if (!prime2.length) {
                        prime2 = [3, 7, 13, 19, 29];
                    }
                    when = Date.now();
                    if (when % 2) {
                        when = prime1.pop();
                    } else {
                        when = prime2.shift();
                    }
                    //console.log(wprtsp_settings);
                    var html = `${wprtsp_settings.conversions_sound_notification_markup}<span class="geo wpsrtp_notification" style="${wprtsp_settings.conversions_notification_style}">Map</span><span class="wprtsp_text" style="${wprtsp_settings.conversions_text_style}"><span class="wprtsp_name">${result.first_name}</span> from <span class="wprtsp_location">${result.location.city}, ${result.location.state}</span> <span class="wprtsp_action" style="${wprtsp_settings.conversions_action_style}">${result.transaction} ${when} minutes ago</span></span>`;

                    wprtsp_pop.html(html).slideDown(200).delay( wprtsp_settings.general_duration * 1000 ).fadeOut(2000);
                }
                if (wprtsp_settings.conversions_shop_type == 'Easy_Digital_Downloads' || wprtsp_settings.conversions_shop_type == 'WooCommerce') {
                   
                    wprtsp_pop.html( wprtsp_settings.conversions_sound_notification_markup + result ).slideDown(200).delay( wprtsp_settings.general_duration * 1000 ).fadeOut(2000);
                }
            }
            jQuery('#wprtsp_pop').mouseover(function () {
                wprtsp_pop.stop(true, true).show(200);
            }).mouseout(function () {
                wprtsp_pop.stop(true, true).delay(200).fadeOut(2000);
            });
        }); */
    });
}
else {
    console.log('this script needs jquery. no jq found');
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        //console.log(e);
        return false;
    }
    return true;
}