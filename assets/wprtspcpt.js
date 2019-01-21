settings = JSON.parse(wprtsp_vars);
console.log(settings);
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
                conversiondata = build_conversions();
            }
            if (settings.proofs.hotstats && settings.proofs.hotstats.length) {
                hotstatdata = build_hotstats();
            }
            if (settings.proofs.livestats && settings.proofs.livestats.length) {
                livestatdata = build_livestats();
            }
            if (settings.proofs.ctas && settings.proofs.ctas.length) {
                ctadata = build_ctas();
            }
        }

        wprtsp_pop = jQuery('#wprtsp_pop').length ? jQuery('#wprtsp_pop') : jQuery('<iframe/>', {
            id: 'wprtsp_pop',
            class: 'wprtsp_pop',
            frameborder: '0',
            scrolling: 'no',
            style: settings.styles.popup_container_style,
            srcdoc: '<html><head></head><body><div id="wprtsp">hello</div></body></html>',
        }).appendTo('body');

        clock = setTimeout(wprtsp_show_message, settings.general_initial_popup_time * 1000);
        //colorfulTabsContainer.contentWindow.document.getElementById('colorfulTabsTabBar')

    });
}
else {
    console.log('no jq');
}

function wprtsp_show_message() {
    //console.log(wprtsp_conversions_messages.length);
    $message = wprtsp_get_message();
    wprtsp_pop.html($message).slideDown(200).delay(settings.general_duration * 1000).fadeOut(2000, function () {
        if (wprtsp_conversions_messages.length) {
            clock = setTimeout(wprtsp_show_message, settings.general_subsequent_popup_time * 1000);
        }
    });

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
    if (flag == 's') {
        //if(flag == 's' && wprtsp_conversions_messages.length) {
        console.log(flag);
        flag = 'h';
        //return wprtsp_conversions_messages.shift();
    }
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
    return 'wprtsp_get_message';
}

function build_conversions() {
    console.log(settings.proofs.conversions.length);
    for(i = 0 ; i < settings.proofs.conversions.length; i++) {
        wprtsp_conversions_messages.push(settings.proofs.conversions[i]);
    }
    console.log(wprtsp_conversions_messages);
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
