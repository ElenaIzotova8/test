<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

DEFINE('BASE', __DIR__);

require_once 'config.php';
require_once 'autoloader.php';

$app = new App($config);
