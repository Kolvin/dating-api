<?php

declare(strict_types=1);

namespace App\Modules\Users\Services;

use App\Modules\Users\Entities\User;
use App\Modules\Users\Interfaces\UserRepositoryInterface;
use App\Modules\Users\Requests\CreateUserRequest;
use App\Modules\Users\Responses\CreateUserResponse;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private UserRepositoryInterface $repository)
    {
    }

    public function create(CreateUserRequest $request): CreateUserResponse
    {
        $newUser = new User(
            Uuid::uuid4()->toString(),
            $request->getEmail(),
            $request->getFirstName(),
            $request->getLastName(),
            $request->getDateOfBirth(),
            $request->getMiddleNames(),
            $request->getBio()
        );

        $newUser->setPassword($this->passwordHasher->hashPassword($newUser, $_ENV['DEFAULT_PASSWORD']));

        $this->repository->save($newUser);

        return new CreateUserResponse($newUser);
    }
}
