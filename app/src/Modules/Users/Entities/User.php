<?php

declare(strict_types=1);

namespace App\Modules\Users\Entities;

use Doctrine\ORM\Mapping\ClassMetadata;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \DateTime;

final class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private string $id;

    private string $email;

    private ?string $password = '';

    private string $firstName;

    private ?string $middleNames = '';

    private string $lastName;

    private DateTime $dateOfBirth;

    private ?string $profilePictureStorageKey = '';

    private ?string $bio = '';

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @var array<string>
     */
    private array $roles = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRoles()
    {
        return $this->roles = ['ROLE_LOGGED_IN'];
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
