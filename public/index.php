<?php

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/container.php';
$app = new \Slim\App($container);

require_once __DIR__ . '/../config/routes.php';

$app->run();
