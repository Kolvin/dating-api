<?php

declare(strict_types=1);

namespace App\Modules\Users\Requests;

use DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class CreateUserRequest
{
    public function __construct(
        private string $email,
        private string $firstName,
        private string $lastName,
        private DateTime $dateOfBirth,
        private ?UploadedFile $profilePictures,
        private ?string $middleNames = '',
        private ?string $bio = ''
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }

    public function getMiddleNames(): ?string
    {
        return $this->middleNames;
    }

    public function getProfilePictures(): ?UploadedFile
    {
        return $this->profilePictures;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }
}
