<?php

declare(strict_types=1);

use App\Auth\Entity\User\User;
use App\Auth\Entity\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

return [
    UserRepository::class => function (ContainerInterface $container): UserRepository {
        $em = $container->get(EntityManagerInterface::class);
        /** @psalm-var Doctrine\ORM\EntityRepository<User> $repo */
        $repo = $em->getRepository(User::class);
        return new UserRepository($em, $repo);
    },
];
