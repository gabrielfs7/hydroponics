<?php

use Slim\App;

define('APP_ROOT', realpath(__DIR__));

require 'vendor/autoload.php';

$settings = require 'config/settings.php';
$dependencies = require 'config/dependencies.php';

$app = new App(
    array_merge(
        $settings,
        $dependencies
    )
);

require 'config/middleware.php';
require 'config/routes.php';