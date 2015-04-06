<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015, Benoit Asselin contact(at)ab-d.fr
 * @license   MIT Licence
 */

return array(
    'new_recaptcha' => array(
        //'site_key'   => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        //'secret_key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        //'remote_ip'  => false,
    ),
    'form_elements' => array(
        'factories' => array(
            'NewReCaptcha' => 'NewReCaptcha\Form\Element\Service\NewReCaptchaFactory',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formNewReCaptcha' => 'NewReCaptcha\Form\View\Helper\FormNewReCaptcha',
        ),
    ),
);
