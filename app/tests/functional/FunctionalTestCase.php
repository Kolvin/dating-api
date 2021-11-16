<?php

namespace Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionalTestCase extends WebTestCase
{
    public function createAuthorizedApiClient(array $userParameters): KernelBrowser
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/user/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            strval(json_encode([
                'email' => $userParameters['email'],
                'password' => $_ENV['DEFAULT_PASSWORD'],
            ]))
        );

        $this->assertResponseIsSuccessful($client->getResponse());

        $data = json_decode(strval($client->getResponse()->getContent()), true);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }
}
