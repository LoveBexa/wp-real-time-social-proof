if(jQuery ){
    
    jQuery(document).ready(function ($) {
        time = Date.now();
        wp.heartbeat.interval('fast'); // first proof should jump in in 5 seconds
        new Fingerprint2().get(function(result, components) {
            jQuery(document).on('heartbeat-send', function(e, data) {
                data['wprtsp'] = result +'_'+ time;
                //console.log(data['wprtsp']);
            });
        })

        wprtsp_settings = JSON.parse(wprtsp_vars);
        
        prime1 = [3, 7, 13, 19, 29];
        prime2 = [5, 11, 17, 23, 31];
        
        jQuery(document).on( 'heartbeat-tick', function( event, data ) {
            if ( data.hasOwnProperty( 'wprtsp' ) ) {
                
                wp.heartbeat.interval(30); // don't pop-up too much

                if(! prime1.length) {
                    prime1 = [5, 11, 17, 23, 31];
                }
                if(! prime2.length) {
                    prime2 = [3, 7, 13, 19, 29];
                }
                when = Date.now();
                if(when % 2) {
                    when = prime1.pop();
                    //console.log(`prime1 length:` + prime1.length);
                }
                else{
                    when = prime2.shift();
                    //console.log(`prime2 length:` + prime2.length);
                }
                result =  JSON.parse(data['wprtsp']);
                var wprtsp_pop = jQuery('#wprtsp_pop').length ? jQuery('#wprtsp_pop') : jQuery('<span/>', {
                    id: 'wprtsp_pop',
                    class: 'wprtsp_pop',
                }).appendTo('body');
                wprtsp_pop.attr('style', 'display:none;border-radius: 500px;position:fixed;bottom:10px;left:10px;z-index:9999;background:white;padding: 1em 2.618em;box-shadow: 2px -1px 5px rgba(0,0,0,.15);');
                wprtsp_pop.html(`<span class="geo" style="text-align: center; display: table; height: 32px; width: 32px; float: left; margin-right: .5em; margin-left: -1.618em; border-radius: 100%; text-indent:-9999px;background:url(${wprtsp_settings.url}assets/map.svg) no-repeat center">Map</span><span class="wprtsp_text" style="display:table;font-weight:bold;font-size: 14px;line-height: 1em;">${result.first_name} from ${result.location.city}, ${result.location.state} <span class="action" style="margin-top: .5em;display: block; font-weight: 300;color: #aaa;font-size: 12px;line-height: 1em;">${result.transaction} ${when} minutes ago</span></span>`).slideDown(200).delay(4000).fadeOut(2000);
                
            }
        });
    });
}
