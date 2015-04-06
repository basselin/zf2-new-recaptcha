/*!
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015, Benoit Asselin contact(at)ab-d.fr
 * @license   MIT License
 */
'use strict';

/**
 * @param {jQuery} $
 */
jQuery(function($) {
    reCaptchaCallback();

});

/**
 * Transform INPUT type="hidden" on DIV reCAPTCHA
 */
function reCaptchaCallback() {
    var $ = window.jQuery;
    if(!$('[data-sitekey]').length) { return; }

    var $head = $('head');
    if(!$head.data('recaptcha')) {
        $head
            .data('recaptcha', true)
            .append('<script src="https://www.google.com/recaptcha/api.js?onload=reCaptchaCallback&render=explicit"></script>');
        return;
    }

    $('input[data-sitekey]').each(function() {
        var $input = $(this);
        if($input.data('recaptcha')) { return; }
        $input.data('recaptcha', true);

        var $div = $('<div class="g-recaptcha"></div>');
        $div.insertAfter($input);
        grecaptcha.render($div[0], {
            'sitekey': $input.attr('data-sitekey')
        });
    });
}
