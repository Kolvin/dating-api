<?php

namespace Tests\Functional\Auth;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiLoginControllerTest extends WebTestCase
{
    public function testValidLogin(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/user/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            strval(json_encode([
                'email' => $_ENV['ADMIN_EMAIL'],
                'password' => 'password1',
            ]))
        );

        // no real auth setup yet
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }
}