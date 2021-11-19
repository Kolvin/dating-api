<?php

declare(strict_types=1);

namespace App\Modules\Users\Requests;

use DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class CreateUserRequest
{
    public function __construct(
        private string $email,
        private int $age,
        private string $gender,
        private string $latitude,
        private string $longitude,
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

    public function getAge(): int
    {
        return $this->age;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
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

    public function getProfilePictures(): ?UploadedFile
    {
        return $this->profilePictures;
    }

    public function getMiddleNames(): ?string
    {
        return $this->middleNames;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }
}
