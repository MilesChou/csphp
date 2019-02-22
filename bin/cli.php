<?php

// Bootstrap
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

// Run application
$app = new Application();
$app->addCommands([
    new \App\Commands\Hi()
]);
$app->run();
