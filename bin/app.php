<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Application;

http_response_code(500);

require __DIR__ . '/../config/bootstrap.php';

if (getenv('SENTRY_DSN')) {
    Sentry\init(['dsn' => getenv('SENTRY_DSN')]);
}

/** @var Psr\Container\ContainerInterface */
$container = require __DIR__ . '/../config/container.php';

$app = new Application('Console App');

if (getenv('SENTRY_DSN')) {
    $app->setCatchExceptions(false);
}

/**
 * @var string[]
 * @psalm-suppress MixedArrayAccess
*/
$commands = $container->get('config')['console']['commands'];

$entityManager = $container->get(EntityManagerInterface::class);
$app->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');

foreach ($commands as $commandName) {
    /** @var Symfony\Component\Console\Command\Command */
    $command = $container->get($commandName);
    $app->add($command);
}

$app->run();
