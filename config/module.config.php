<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

namespace NewReCaptcha;

return [
    'new_recaptcha' => [
        //'site_key'   => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        //'secret_key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        //'remote_ip'  => false,
    ],
    'form_elements' => [
        'aliases' => [
            'NewReCaptcha' => Form\Element\NewReCaptcha::class,
        ],
        'factories' => [
            Form\Element\NewReCaptcha::class => Form\Element\Service\NewReCaptchaFactory::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'formNewReCaptcha' => Form\View\Helper\FormNewReCaptcha::class,
        ],
    ],
];
