settings = JSON.parse(wprtsp_vars);
clock = false;
flag = false;
current_proof_type = false;
wprtsp_pop = false;
wprtsp_conversions_messages = [];
wprtsp_hotstats_messages = [];
wprtsp_livestats_messages = [];
wprtsp_ctas_messages = [];
debug = false;
title = false;
titletimer = false;

llog(settings);

function llog($str){
    if(debug) {
        console.dir($str);
    }
}

if (jQuery) {
    jQuery(document).ready(function ($) {
        if (settings.proofs) {
            if (settings.hasOwnProperty('conversions_enable_mob') && settings.conversions_enable_mob && settings.is_mobile && settings.proofs.conversions && settings.proofs.conversions.length) {
                build_conversions();
            }
            if (settings.hasOwnProperty('conversions_enable') && settings.conversions_enable && !settings.is_mobile && settings.proofs.conversions && settings.proofs.conversions.length) {
                build_conversions();
            }
            if (!settings.hasOwnProperty('conversions_enable') && settings.proofs.conversions && settings.proofs.conversions.length) {
                build_conversions();
            }
            if (settings.hasOwnProperty('hotstats_enable') && settings.hotstats_enable && !settings.is_mobile && settings.proofs.hotstats && settings.proofs.hotstats.length ||
                settings.hasOwnProperty('hotstats_enable_mob') && settings.hotstats_enable_mob && settings.is_mobile && settings.proofs.hotstats && settings.proofs.hotstats.length
            ) {
                build_hotstats();
            }
            if (settings.hasOwnProperty('livestats_enable') && settings.livestats_enable && !settings.is_mobile && settings.proofs.livestats && settings.proofs.livestats.length ||
                settings.hasOwnProperty('livestats_enable_mob') && settings.livestats_enable_mob && settings.is_mobile && settings.proofs.livestats && settings.proofs.livestats.length
            ) {
                build_livestats();
            }
            if (settings.hasOwnProperty('ctas_enable') && settings.ctas_enable && !settings.is_mobile && settings.proofs.ctas && settings.proofs.ctas.length ||
                settings.hasOwnProperty('ctas_enable_mob') && settings.ctas_enable_mob && settings.is_mobile && settings.proofs.ctas && settings.proofs.ctas.length
            ) {
                build_ctas();
            }
            init_flag();
            wprtsp_pop = jQuery('#wprtsp_pop').length ? jQuery('#wprtsp_pop') : jQuery('<iframe/>', {
                id: 'wprtsp_pop',
                class: 'wprtsp_pop',
                frameborder: '0',
                scrolling: 'no',
                style: settings.styles.popup_style,
                srcdoc: '<html><head><base target="_parent"><style>* {margin: 0; padding: 0;} a { color: inherit; text-decoration: none;} body{font-size: 13px;}</style></head><body id="wprtsp" style="display:table"></body></html>',
            }).appendTo('body');
            clock = setTimeout(wprtsp_show_message, settings.general_initial_popup_time * 1000);
        }
    });
}
else {
    llog('no jq');
}

function wprtsp_show_message() {
    message = wprtsp_get_message();
    if (!message) {
        try { clearTimeout(clock); }
        catch (e) { }
        return;
    }
    jQuery('#wprtsp_pop').slideDown(300, function () {
        //${"dynamic".$i}
        //llog();
        llog(current_proof_type);
        if(eval(`settings.${current_proof_type}_sound_notification`) ){
            //llog( eval(  `settings.${current_proof_type}_sound_notification_file` ) ) ;
            src = `${settings.url}assets/sounds/` + eval( `settings.${current_proof_type}_sound_notification_file` );
            //llog(src);
            var wprtsp_audio = jQuery('#wprtsp_audio').length ? jQuery('#wprtsp_audio') : jQuery('<audio/>', {
                id: 'wprtsp_audio',
                class: 'wprtsp_audio',
                preload: 'auto',
                src: src
            }).appendTo('body');
            wprtsp_audio.attr('src', src);
            wprtsp_audio[0].play();
        }
        if(eval(`settings.${current_proof_type}_title_notification`) ){
            title = jQuery(document).attr("title");
            titletimer = setInterval(titlenotification, 2000);
        }
        jQuery("#wprtsp_pop").contents().find("#wprtsp").html(message);
        jQuery('#wprtsp_pop').css('height', jQuery("#wprtsp_pop").contents().find("html").height());
        jQuery('#wprtsp_pop').css('width', jQuery("#wprtsp_pop").contents().find("body").width());
    }).delay(settings.general_duration * 1000).slideUp(300, function () {
        
        if(title){
            jQuery(document).attr('title',title);
            clearInterval(titletimer);
            title = false;
        }
        clock = setTimeout(wprtsp_show_message, settings.general_subsequent_popup_time * 1000);
    });

    jQuery('#wprtsp_pop').mouseover(function () {
        clearTimeout(clock);
        wprtsp_pop.stop(true, true).show(200);
    }).mouseout(function () {
        wprtsp_pop.stop(true, true).delay(200).fadeOut(2000, function () {
            clock = setTimeout(wprtsp_show_message, settings.general_subsequent_popup_time * 1000);
        });
    });
}

function titlenotification(){
    if(document.title != 'Rachel says…'){
        jQuery(document).attr('title', 'Rachel says…');
    }
    else {
        jQuery(document).attr('title', title);
    }
}
function wprtsp_get_message() {
    if (flag == 's') {
        llog(flag);
        set_next_flag();
        current_proof_type = 'conversions';
        return wprtsp_conversions_messages.shift();
    }
    if (flag == 'h') {
        llog(flag);
        set_next_flag();
        current_proof_type = 'hotstats';
        return wprtsp_hotstats_messages.shift();
    }
    if (flag == 'l') {
        llog(flag);
        set_next_flag();
        current_proof_type = 'livestats';
        return wprtsp_livestats_messages.shift();
    }
    if (flag == 'c') {
        llog(flag);
        // once CTA is shown, no need to show newer popups
        //set_next_flag();
        current_proof_type = 'ctas';
        clearTimeout(clock);
        return wprtsp_ctas_messages.shift();
    }
}

function init_flag() {
    if (wprtsp_conversions_messages.length) {
        flag = 's';
        llog('initiated flag to ' + flag);
        return;
    }
    if (wprtsp_hotstats_messages.length) {
        flag = 'h';
        llog('initiated flag to ' + flag);
        return;
    }
    if (wprtsp_livestats_messages.length) {
        flag = 'l';
        llog('initiated flag to ' + flag);
        return;
    }
    if (wprtsp_ctas_messages.length) {
        flag = 'c';
        llog('initiated flag to ' + flag);
        return;
    }
}

function set_next_flag() {

    if (flag == 's') {
        if (wprtsp_hotstats_messages.length) {
            flag = 'h';
            return;
        }
        if (wprtsp_livestats_messages.length) {
            flag = 'l';
            return;
        }
        if (wprtsp_ctas_messages.length) {
            flag = 'c';
            return;
        }
        if (wprtsp_conversions_messages.length) {
            flag = 's';
            return;
        }
    }
    if (flag == 'h') {
        if (wprtsp_livestats_messages.length) {
            flag = 'l';
            return;
        }
        if (wprtsp_ctas_messages.length) {
            flag = 'c';
            return;
        }
        if (wprtsp_conversions_messages.length) {
            flag = 's';
            return;
        }
        if (wprtsp_hotstats_messages.length) {
            flag = 'h';
            return;
        }
    }
    if (flag == 'l') {
        if (wprtsp_ctas_messages.length) {
            flag = 'c';
            return;
        }
        if (wprtsp_conversions_messages.length) {
            flag = 's';
            return;
        }
        if (wprtsp_hotstats_messages.length) {
            flag = 'h';
            return;
        }
        if (wprtsp_livestats_messages.length) {
            flag = 'l';
            return;
        }
    }
    if (flag == 'c') {
        clearTimeout(clock);
        
    }
}

function build_conversions() {
    for (i = 0; i < settings.proofs.conversions.length; i++) {
        wprtsp_conversions_messages.push(conversions_html(settings.proofs.conversions[i]));
    }
}

function conversions_html(conversion) {
    return `<div class="wprtsp_wrap" style="${settings.styles.popup_wrap_style}" class="wprtsp-conversion">
    <a class="wprtsp_left" href="${conversion['link']}" style="margin-right: .5em; width: 48px; height: 48px; min-width: 48px; min-height: 48px; border-radius: 1000px; background:url('https://dev.converticacommerce.com/woocommerce-sandbox/wp-content/plugins/wp-social-proof-pro/assets/map.svg' ) center; background-size: cover;"></a>
    <div class="wprtsp_right" style="margin-left: .5em; margin-right: .5em; ">
        <div class="wprtsp_line1" style="${settings.styles.line1_style}"><a href="${conversion['link']}">${conversion['line1']}</a></div>
        <div class="wprtsp_line2" style="${settings.styles.line2_style}"><a href="${conversion['link']}">${conversion['line2']}</a></div>
    </div></div>`;
}

function build_hotstats() {
    for (i = 0; i < settings.proofs.hotstats.length; i++) {
        wprtsp_hotstats_messages.push(hotstats_html(settings.proofs.hotstats[i]));
    }
    llog(wprtsp_hotstats_messages);
}

function hotstats_html(hotstat) {
    return `<div class="wprtsp_wrap" style="${settings.styles.popup_wrap_style}" class="wprtsp-hotstat">
    <span class="wprtsp_left" style="margin-right: .5em; width: 48px; height: 48px; min-width: 48px; min-height: 48px; border-radius: 1000px; background:url('https://dev.converticacommerce.com/woocommerce-sandbox/wp-content/plugins/wp-social-proof-pro/assets/map.svg' ) center; background-size: cover;"></span>
    <div class="wprtsp_right" style="margin-left: .5em; margin-right: .5em; ">
        <div class="wprtsp_line1" style="${settings.styles.line1_style}">${hotstat['line1']}</div>
        <div class="wprtsp_line2" style="${settings.styles.line2_style}">${hotstat['line2']}</div>
    </div></div>`;
}

function build_livestats() {
    //llog(settings.proofs.livestats);
}

function build_ctas() {
    for (i = 0; i < settings.proofs.ctas.length; i++) {
        wprtsp_ctas_messages.push(ctas_html(settings.proofs.ctas[i]));
    }
    llog(wprtsp_ctas_messages);
}

function ctas_html(cta) {
    return `<div class="wprtsp_wrap" style="${settings.styles.popup_wrap_style}" class="wprtsp-cta">
    <a class="wprtsp_left" href="${cta['link']}" style="margin-right: .5em; width: 48px; height: 48px; min-width: 48px; min-height: 48px; border-radius: 1000px; background:url('https://dev.converticacommerce.com/woocommerce-sandbox/wp-content/plugins/wp-social-proof-pro/assets/map.svg' ) center; background-size: cover;"></a>
    <div class="wprtsp_right" style="margin-left: .5em; margin-right: .5em; ">
        <div class="wprtsp_line1" style="${settings.styles.line1_style}"><a href="${cta['link']}">${cta['title']}</a></div>
        <div class="wprtsp_line2" style="${settings.styles.line2_style}"><a href="${cta['link']}">${cta['message']}</a></div>
    </div></div>`;
}
