'use strict';
$(document).ready(function() {
    // [ date masking ]
    $('.date').mask('00/00/0000');
    // [ date2 masking ]
    $('.date2').mask('00-00-0000');
    // [ hour masking ]
    $('.hour').mask('00:00:00');
    // [ date-Hour masking ]
    $('.dateHour').mask('00/00/0000 00:00:00');
    // [ mobile-num masking ]
    $('.mob_no').mask('0000-000-000');
    // [ phone masking ]
    $('.phone').mask('0000-0000');
    // [ telphone-code masking ]
    $('.telphone_with_code').mask('(00) 0000-0000');
    // [ us-telphone masking ]
    $('.us_telephone').mask('(000) 000-0000');
    // [ Ip masking ]
    $('.ip').mask('000.000.000.000');
    // [ Ipv4 masking ]
    $('.ipv4').mask('000.000.000.0000');
    // [ Ipv6 masking ]
    $('.ipv6').mask('0000:0000:0000:0:000:0000:0000:0000');
});
