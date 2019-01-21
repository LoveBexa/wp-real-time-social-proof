settings = JSON.parse(wprtsp_vars);
console.dir(settings);
clock = false;
flag = 's';
wprtsp_pop = false;
wprtsp_conversions_messages = [];
wprtsp_hotstats_messages = [];
wprtsp_livestats_messages = [];
wprtsp_ctas_messages = [];

if (jQuery) {
    jQuery(document).ready(function ($) {
        // console.log(settings.conversions_enable);
        if (settings.proofs) {
            if (settings.proofs.conversions && settings.proofs.conversions.length) {
                build_conversions();
                //console.dir(wprtsp_conversions_messages);
            }
            /*
            if (settings.proofs.hotstats && settings.proofs.hotstats.length) {
                hotstatdata = build_hotstats();
            }
            if (settings.proofs.livestats && settings.proofs.livestats.length) {
                livestatdata = build_livestats();
            }
            if (settings.proofs.ctas && settings.proofs.ctas.length) {
                ctadata = build_ctas();
            }
            */
        }

        wprtsp_pop = jQuery('#wprtsp_pop').length ? jQuery('#wprtsp_pop') : jQuery('<iframe/>', {
            id: 'wprtsp_pop',
            class: 'wprtsp_pop',
            frameborder: '0',
            scrolling: 'no',
            style: settings.styles.popup_style,
            srcdoc: '<html><head><style>* {margin: 0; padding: 0;} a{color: inherit; text-decoration: none;}</style></head><body id="wprtsp" style="display:table"></body></html>',
        }).appendTo('body');

        clock = setTimeout( wprtsp_show_message, settings.general_initial_popup_time * 1000 );
        //colorfulTabsContainer.contentWindow.document.getElementById('colorfulTabsTabBar')

    });
}
else {
    console.log('no jq');
}

function wprtsp_show_message() {
    //console.log(wprtsp_conversions_messages.length);
    message = wprtsp_get_message();
    //wprtsp_pop.contentWindow.document.getElementById('colorfulTabsTabBar')
    //console.log(wprtsp_pop.contentWindow);

    jQuery('#wprtsp_pop').slideDown(200, function () {
        //console.log(message);
        
            jQuery("#wprtsp_pop").contents().find("#wprtsp").html(message);
        //jQuery('#wprtsp_pop').width  = jQuery('#wprtsp_pop').contentWindow.document.body.scrollWidth;
        jQuery('#wprtsp_pop').css('height', jQuery("#wprtsp_pop").contents().find("html").height());
        jQuery('#wprtsp_pop').css('width', jQuery("#wprtsp_pop").contents().find("body").width());
        //jQuery("#myiframe").contents().find("#wprtsp").html(message);
    }).delay(settings.general_duration * 1000).fadeOut(2000, function () {
        //if (wprtsp_conversions_messages.length) {
        clock = setTimeout(wprtsp_show_message, settings.general_subsequent_popup_time * 1000);
        //}
    });

    /* jQuery('#wprtsp').html($message).slideDown(200).delay(settings.general_duration * 1000).fadeOut(2000, function () {
        //if (wprtsp_conversions_messages.length) {
            clock = setTimeout(wprtsp_show_message, settings.general_subsequent_popup_time * 1000);
        //}
    }); */

    jQuery('#wprtsp_pop').mouseover(function () {
        clearTimeout(clock);
        wprtsp_pop.stop(true, true).show(200);
    }).mouseout(function () {
        wprtsp_pop.stop(true, true).delay(200).fadeOut(2000, function () {
            if (wprtsp_conversions_messages.length) {
                clock = setTimeout(wprtsp_show_message, settings.general_subsequent_popup_time * 1000);
            }
        });
    });
}

function wprtsp_get_message() {

    if (flag == 's' && wprtsp_conversions_messages.length) {
        console.log(flag);
        //flag = 'h';
        return wprtsp_conversions_messages.shift();
        //message = wprtsp_conversions_messages.shift();
        return '<span class="wprtsp_container_wrap" style="'+settings.styles.container_wrap_style+'">'+message+'</span>';
    }
    /*
    if (flag == 'h') {
        //if(flag == 'h' && wprtsp_hotstat_messages.length) {
        console.log(flag);
        flag = 'l';
        //return wprtsp_hotstat_messages.shift();
    }
    if (flag == 'l') {
        //if(flag == 'l' && wprtsp_livestat_messages.length) {
        console.log(flag);
        flag = 'c';
        //return wprtsp_livestat_messages.shift();
    }
    if (flag == 'c') {
        //if(flag == 'c' && wprtsp_cta_messages.length) {
        // once CTA is shown, no need to show newer popups
        console.log(flag);
        clearTimeout(clock);
        //return wprtsp_cta_messages.shift();
    }
    */
    //return 'wprtsp_get_message';
}

function build_conversions() {
    for (i = 0; i < settings.proofs.conversions.length; i++) {
        wprtsp_conversions_messages.push(conversions_html(settings.proofs.conversions[i]));
    }
}

function conversions_html(){
    return `<div class="wprtsp_wrap" style="${settings.styles.popup_wrap_style}">
    <a class="wprtsp_left" href="${settings.proofs.conversions[i]['link']}" style="margin-right: .5em; width: 48px; height: 48px; min-width: 48px; min-height: 48px; border-radius: 1000px; background:url('https://dev.converticacommerce.com/woocommerce-sandbox/wp-content/plugins/wp-social-proof-pro/assets/map.svg' ) center; background-size: cover;"></a>
    <div class="wprtsp_right" style="margin-left: .5em; margin-right: .5em; ">
        <div class="wprtsp_line1" style="${settings.styles.line1_style}"><a href="${settings.proofs.conversions[i]['link']}">${settings.proofs.conversions[i]['line1']}</a></div>
        <div class="wprtsp_line2" style="${settings.styles.line2_style}"><a href="${settings.proofs.conversions[i]['link']}">${settings.proofs.conversions[i]['line2']}</a></div>
    </div></div>`;
}

function build_hotstats() {
    //console.log(settings.proofs.hotstats);
}

function build_livestats() {
    //console.log(settings.proofs.livestats);
}

function build_ctas() {
    //console.log(settings.proofs.ctas);
}
