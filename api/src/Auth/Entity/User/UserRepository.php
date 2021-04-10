<?php

declare(strict_types=1);

namespace App\Auth\Entity\User;

interface UserRepository
{
    public function hasByEmail(Email $email): bool;
    public function hasByNetwork(NetworkIdentity $identity): bool;
    public function findByJoinConfirmToken(string $token): ?User;
    /**
     * @throws \DomainException
     */
    public function get(Id $id): User;
    public function add(User $user): void;
}
