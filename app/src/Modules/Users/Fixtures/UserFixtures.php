<?php

declare(strict_types=1);

namespace App\Modules\Users\Fixtures;

use App\Modules\Users\Data\SystemDefaults;
use App\Modules\Users\Requests\CreateUserRequest;
use App\Modules\Users\Services\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function __construct(private UserService $service)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (SystemDefaults::USERS as $userData) {
            $newUserRequest = new CreateUserRequest(
                email: $userData['email'],
                age: $userData['age'],
                gender: $userData['gender'],
                latitude: strval($userData['latitude']),
                longitude: strval($userData['longitude']),
                firstName: $userData['first_name'],
                lastName: $userData['last_name'],
                dateOfBirth: new \DateTime($userData['date_of_birth']),
                profilePictures: null,
                middleNames: $userData['middle_names'],
                bio: $userData['bio'],
            );

            $response = $this->service->create($newUserRequest);
            $user = $response->getUser();
            $this->setReference($user->getEmail().'-user-ref', $user);
        }
    }
}
