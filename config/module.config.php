<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

return [
    'new_recaptcha' => [
        //'site_key'   => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        //'secret_key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        //'remote_ip'  => false,
    ],
    'form_elements' => [
        'factories' => [
            'NewReCaptcha' => NewReCaptcha\Form\Element\Service\NewReCaptchaFactory::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'formNewReCaptcha' => NewReCaptcha\Form\View\Helper\FormNewReCaptcha::class,
        ],
    ],
];
