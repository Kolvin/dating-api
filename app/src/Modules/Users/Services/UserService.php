<?php

declare(strict_types=1);

namespace App\Modules\Users\Services;

use App\Modules\Users\Entities\User;
use App\Modules\Users\Interfaces\UserRepositoryInterface;
use App\Modules\Users\Requests\CreateUserRequest;
use App\Modules\Users\Responses\CreateUserResponse;
use App\Services\Validation\ValidationService;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private UserRepositoryInterface $repository, private ValidationService $validator)
    {
    }

    public function create(CreateUserRequest $request): CreateUserResponse
    {
        $violations = $this->validator->validate($request);

        if ($violations->count() > 0) {
            return new CreateUserResponse(
                user: null,
                statusCode: Response::HTTP_BAD_REQUEST,
                notices: new ArrayCollection($this->validator->transformValidationErrors($request))
            );
        }

        $newUser = new User(
            id: Uuid::uuid4()->toString(),
            email: $request->getEmail(),
            firstName: $request->getFirstName(),
            lastName: $request->getLastName(),
            gender: $request->getGender(),
            latitude: $request->getLatitude(),
            longitude: $request->getLongitude(),
            dateOfBirth: $request->getDateOfBirth(),
            middleNames: $request->getMiddleNames(),
            bio: $request->getBio()
        );

        $newUser->setPassword($this->passwordHasher->hashPassword($newUser, $_ENV['DEFAULT_PASSWORD']));

        $this->repository->save($newUser);

        return new CreateUserResponse(user: $newUser, statusCode: Response::HTTP_CREATED, notices: new ArrayCollection());
    }
}
