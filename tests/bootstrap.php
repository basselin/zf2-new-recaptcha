<?php
/**
 * Copyright (c) 2015 Benoit Asselin, http://161.io
 */

//$rootPath = realpath(__DIR__ . '/../../../');  // module/
$rootPath = realpath(__DIR__ . '/../../../../'); // vendor/
chdir($rootPath);

if (is_file('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
    return;
}
