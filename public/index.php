<?php

use App\Bootstrap;

require __DIR__ . '/../vendor/autoload.php';

$container = Bootstrap::boot();

// spustíme webovou aplikaci.
$container->getWebApp()->run();
