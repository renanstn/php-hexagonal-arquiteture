<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

require_once __DIR__ . '/../config/routes.php';

$app->run();
