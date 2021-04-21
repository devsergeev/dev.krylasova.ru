<?php

declare(strict_types=1);

use App\Console\HelloCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command;

return [
    'config' => [
        'console' => [
            'commands' => [
                ValidateSchemaCommand::class,

                Command\ExecuteCommand::class,
                Command\MigrateCommand::class,
                Command\LatestCommand::class,
                Command\ListCommand::class,
                Command\StatusCommand::class,
                Command\UpToDateCommand::class,
            ]
        ]
    ],
];
