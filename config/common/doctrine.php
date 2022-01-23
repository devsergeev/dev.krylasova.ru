<?php

declare(strict_types=1);

use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return [
    EntityManagerInterface::class => function (ContainerInterface $container): EntityManagerInterface {
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{
         *     metadata_dirs:string[],
         *     dev_mode:bool,
         *     proxy_dir:string,
         *     cache_dir:?string,
         *     connection:array<string, mixed>,
         *     types:array<string,class-string<Doctrine\DBAL\Types\Type>>
         * } $settings
         */
        $settings = $container->get('config')['doctrine'];

        $config = Setup::createConfiguration(
            $settings['dev_mode'],
            $settings['proxy_dir'],
            $settings['cache_dir'] ?
                DoctrineProvider::wrap(new FilesystemAdapter('', 0, $settings['cache_dir'])) :
                DoctrineProvider::wrap(new ArrayAdapter())
        );

        $config->setMetadataDriverImpl(new AttributeDriver($settings['metadata_dirs']));

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        foreach ($settings['types'] as $name => $class) {
            if (!Type::hasType($name)) {
                Type::addType($name, $class);
            }
        }

        return EntityManager::create(
            $settings['connection'],
            $config
        );
    },

    'config' => [
        'doctrine' => [
            'dev_mode' => false,
            'cache_dir' => __DIR__ . '/../../var/cache/doctrine/cache',
            'proxy_dir' => __DIR__ . '/../../var/cache/doctrine/proxy',
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => getenv('DB_HOST'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'dbname' => getenv('DB_NAME'),
                'charset' => 'utf8'
            ],
            'metadata_dirs' => [
                __DIR__ . '/../../src/Auth/Entity'
            ],
            'types' => [
                App\Auth\Entity\User\IdType::NAME => App\Auth\Entity\User\IdType::class,
                App\Auth\Entity\User\EmailType::NAME => App\Auth\Entity\User\EmailType::class,
                App\Auth\Entity\User\RoleType::NAME => App\Auth\Entity\User\RoleType::class,
                App\Auth\Entity\User\StatusType::NAME => App\Auth\Entity\User\StatusType::class,
            ],
        ],
    ],
];
