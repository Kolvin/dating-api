<?php

namespace Tests\Functional\Auth;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexController extends WebTestCase
{
    public function test200IsReturned(): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
