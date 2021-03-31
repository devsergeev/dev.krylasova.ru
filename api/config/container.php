<?php

declare(strict_types=1);

use DI\ContainerBuilder;

return (new ContainerBuilder())->addDefinitions(require __DIR__ . '/dependencies.php')->build();