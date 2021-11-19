<?php

declare(strict_types=1);

namespace App\Modules\Users\Entities;

use DateTime;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private string $id,
        private string $email,
        private string $firstName,
        private string $lastName,
        private int $age,
        private string $gender,
        private string $latitude,
        private string $longitude,
        private DateTime $dateOfBirth,
        private ?string $middleNames = '',
        private ?string $bio = '',
        ) {
    }

    private ?string $password = '';

    private ?string $profilePictureStorageKey = '';

    /** @var array<string> */
    private array $roles = ['ROLE_LOGGED_IN'];

    public function getId(): string
    {
        return $this->id;
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

    public function getMiddleNames(): ?string
    {
        return $this->middleNames;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function getProfilePictureStorageKey(): ?string
    {
        return $this->profilePictureStorageKey;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function eraseCredentials(): void
    {
        $this->password = null;
    }

    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $metadata->mapField([
            'id' => true,
            'fieldName' => 'id',
            'type' => 'guid',
        ]);

        $metadata->mapField([
            'fieldName' => 'email',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'password',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'age',
            'type' => 'integer',
        ]);

        $metadata->mapField([
            'fieldName' => 'gender',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'latitude',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'longitude',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'firstName',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'middleNames',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'lastName',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'dateOfBirth',
            'type' => 'datetime',
        ]);

        $metadata->mapField([
            'fieldName' => 'profilePictureStorageKey',
            'type' => 'string',
        ]);

        $metadata->mapField([
            'fieldName' => 'bio',
            'type' => 'string',
        ]);
    }
}
