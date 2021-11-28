<?php

namespace Tests\Functional\Api\Auth;

use App\Modules\Users\Data\SystemDefaults;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiLoginControllerTest extends WebTestCase
{
    public function testValidLogin(): void
    {
        $client = $this->attemptLogin([
            'email' => SystemDefaults::USERS[0]['email'],
            'password' => $_ENV['DEFAULT_PASSWORD'],
        ]);

        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $data);

        $token = $data['token'];
        $tokenParts = explode('.', $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);

        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        $this->assertEquals($jwtHeader->typ, 'JWT');
        $this->assertEquals($jwtHeader->alg, 'RS256');
        $this->assertEquals($jwtPayload->email, SystemDefaults::USERS[0]['email']);
    }

    public function testNoEmailLogin(): void
    {
        $client = $this->attemptLogin([
            'password' => $_ENV['DEFAULT_PASSWORD'],
        ]);

        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testNoPasswordLogin(): void
    {
        $client = $this->attemptLogin([
            'email' => SystemDefaults::USERS[0]['email'],
        ]);

        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testBlankLogin(): void
    {
        $client = $this->attemptLogin([]);

        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
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
