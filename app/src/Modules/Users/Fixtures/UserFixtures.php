<?php

declare(strict_types=1);

namespace App\Modules\Users\Fixtures;

use App\Modules\Users\Data\SystemDefaults;
use App\Modules\Users\Entities\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (SystemDefaults::USERS as $userData) {
            $newUser = new User();
            $newUser->setEmail($userData['email']);
            $newUser->setPassword($this->passwordHasher->hashPassword($newUser, $_ENV['DEFAULT_PASSWORD']));
            $manager->persist($newUser);
            $this->setReference($newUser->getEmail().'-user-ref', $newUser);
        }
        $manager->flush();
    }
}
