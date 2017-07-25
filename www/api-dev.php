<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Drop\FleetControl\Application([
    'debug' => true,
]);

$app->run();
