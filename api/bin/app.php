<?php

declare(strict_types=1);

use App\Console\HelloCommand;
use Symfony\Component\Console\Application;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

/** @var Psr\Container\ContainerInterface */
$container = require __DIR__ . '/../config/container.php';

$app = new Application('Console App');

$commands = $container->get('config')['console']['commands'];
foreach($commands as $commandName) {
    $app->add($container->get($commandName));
}

$app->run();
