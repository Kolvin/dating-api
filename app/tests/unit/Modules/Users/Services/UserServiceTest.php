<?php

namespace Tests\Unit\Modules\Users\Services;

use App\Modules\Users\Requests\CreateUserRequest;
use App\Modules\Users\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserServiceTest extends KernelTestCase
{
    private UserService $service;

    public function setUp(): void
    {
        self::bootKernel();
        $this->service = static::getContainer()->get(UserService::class);
    }

    public function testValidCreation()
    {
        $response = $this->service->create(new CreateUserRequest(
            email: 'casedeleon@utarian.com',
            gender: 'male',
            latitude: '-23.710326',
            longitude: '-78.64836',
            firstName: 'Case',
            lastName: 'Deleon',
            dateOfBirth: new \DateTime(''),
            profilePictures: null,
            middleNames: 'bob lazar',
            bio: 'Whatchu doin',
        ));

        $this->assertTrue(Response::HTTP_CREATED == $response->getStatusCode());
    }

    public function testInvalidEmail()
    {
        $response = $this->service->create(new CreateUserRequest(
            email: 'casedeleonutarian.com',
            gender: 'male',
            latitude: '-23.710326',
            longitude: '-78.64836',
            firstName: 'Case',
            lastName: 'Deleon',
            dateOfBirth: new \DateTime('now'),
            profilePictures: null,
            middleNames: 'bob lazar',
            bio: 'Whatchu doin',
        ));

        $this->assertTrue(Response::HTTP_BAD_REQUEST == $response->getStatusCode());
        $this->assertArrayHasKey('email', $response->getNotices());
    }

    public function testCreationWithExceedingBioCharacterCount()
    {
        $response = $this->service->create(new CreateUserRequest(
            email: 'casedeleonutarian.com',
            gender: 'male',
            latitude: '-23.710326',
            longitude: '-78.64836',
            firstName: 'Case',
            lastName: 'Deleon',
            dateOfBirth: new \DateTime('now'),
            profilePictures: null,
            middleNames: 'bob lazar',
            bio: 'Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? Whatchu doin huh? ',
        ));

        $this->assertTrue(Response::HTTP_BAD_REQUEST == $response->getStatusCode());
        $this->assertArrayHasKey('bio', $response->getNotices());
    }
}
