console.dir(JSON.parse(wprtsp_vars));
settings = JSON.parse(wprtsp_vars);
//var clock;
//var flag = 's';

if (jQuery) {
    jQuery(document).ready(function ($) {
       // console.log(settings.conversions_enable);
        if(settings.proofs){
            if (settings.proofs.conversions && settings.proofs.conversions.length) {
                conversiondata = build_conversions(settings.proofs.conversions);
            }
            if (settings.proofs.hotstats && settings.proofs.hotstats.length) {
                conversiondata = build_conversions(settings.proofs.conversions);
            }
            if (settings.proofs.livestats && settings.proofs.livestats.length) {
                conversiondata = build_conversions(settings.proofs.conversions);
            }
            if (settings.proofs.ctas && settings.proofs.ctas.length) {
                conversiondata = build_conversions(settings.proofs.conversions);
            }
        }
    });
}
else {
    console.log('no jq');
}

function build_conversions(conversions){
    console.log(conversions);
}

function build_hotstats(hotstats){
    console.log(hotstats);
}

function build_livestats(livestats){
    console.log(hotstats);
}

function build_ctas(ctas){
    console.log(ctas);
}
