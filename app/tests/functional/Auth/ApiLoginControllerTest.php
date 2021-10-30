<?php

namespace Tests\Functional\Auth;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiLoginControllerTest extends WebTestCase
{
    public function testValidLogin(): void
    {
        $client = $this->attemptLogin([
            'email' => $_ENV['ADMIN_EMAIL'],
            'password' => $_ENV['DEFAULT_PASSWORD'],
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testNoEmailLogin(): void
    {
        $client = $this->attemptLogin([
            'password' => $_ENV['DEFAULT_PASSWORD'],
        ]);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testNoPasswordLogin(): void
    {
        $client = $this->attemptLogin([
            'email' => $_ENV['ADMIN_EMAIL'],
        ]);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testBlankLogin(): void
    {
        $client = $this->attemptLogin([]);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    private function attemptLogin(array $postContent)
    {
        $client = static::createClient();

        $client->request('POST', '/api/user/login', [], [], ['CONTENT_TYPE' => 'application/json'],
            strval(json_encode($postContent))
        );

        return $client;
    }
}
