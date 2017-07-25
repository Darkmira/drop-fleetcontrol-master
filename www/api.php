<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Drop\FleetControl\Application([
    'debug' => false,
]);

$app->run();
