<?php

declare(strict_types=1);

namespace App\Modules\Users\Requests;

use DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class CreateUserRequest
{
    public function __construct(
        private string $email,
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

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints('email', [new NotBlank(), new Email()]);
        $metadata->addPropertyConstraint('firstName', new Length([
            'min' => 2,
            'max' => 50,
            'minMessage' => 'Your first name must be at least {{ limit }} characters long',
            'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
        ]));
        $metadata->addPropertyConstraint('latitude', new NotBlank());
        $metadata->addPropertyConstraint('longitude', new NotBlank());
        $metadata->addPropertyConstraint('middleNames', new Length([
            'min' => 2,
            'max' => 50,
            'minMessage' => 'Your middle names must be at least {{ limit }} characters long',
            'maxMessage' => 'Your middle names cannot be longer than {{ limit }} characters',
        ]));
        $metadata->addPropertyConstraint('lastName', new Length([
            'min' => 2,
            'max' => 50,
            'minMessage' => 'Your last name must be at least {{ limit }} characters long',
            'maxMessage' => 'Your last name cannot be longer than {{ limit }} characters',
        ]));
        $metadata->addPropertyConstraints('bio', [new NotBlank(), new Length([
            'min' => 2,
            'max' => 255,
            'minMessage' => 'Your bio name must be at least {{ limit }} characters long',
            'maxMessage' => 'Your bio name cannot be longer than {{ limit }} characters',
        ])]);
    }
}
