<?php
/**
 * @link      https://github.com/basselin/zf2-new-recaptcha
 * @copyright (c) 2015-2016, Benoit Asselin contact(at)161.io
 * @license   MIT License
 */

//$rootPath = realpath(__DIR__ . '/../../..');  // module/
$rootPath = realpath(__DIR__ . '/../../../..'); // vendor/
chdir($rootPath);

if (is_file('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
    return;
}
