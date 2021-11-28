<?php

declare(strict_types=1);

namespace App\Modules\Users\Fixtures;

use App\Modules\Users\Data\SystemDefaults;
use App\Modules\Users\Entities\User;
use App\Modules\Users\Requests\CreateUserRequest;
use App\Modules\Users\Services\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\Response;

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
                gender: $userData['gender'],
                latitude: strval($userData['latitude']),
                longitude: strval($userData['longitude']),
                firstName: $userData['first_name'],
                lastName: $userData['last_name'],
                dateOfBirth: new \DateTime($userData['date_of_birth']),
                profilePictures: null,
                middleNames: $userData['middle_names'],
                bio: substr($userData['bio'], 0, 225),
            );

            $response = $this->service->create($newUserRequest);

            if (Response::HTTP_CREATED == $response->getStatusCode()) {
                $user = $response->getUser();
                assert($user instanceof User);
                $this->setReference($user->getEmail().'-user-ref', $user);
                continue;
            }

            if (Response::HTTP_BAD_REQUEST == $response->getStatusCode()) {
                $output = new ConsoleOutput();
                $output->writeln('<inf>Failed to create user: </info>'.$userData['email']);
                $response->getNotices()->map(function ($notice) use ($output) {
                    $output->writeln('<inf>Because: </info>'.$notice);
                });
            }
        }
    }
}
