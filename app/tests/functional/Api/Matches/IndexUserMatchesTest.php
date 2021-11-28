<?php

namespace Tests\Functional\Api\Matches;

use App\Modules\Users\Data\SystemDefaults;
use Tests\Functional\FunctionalTestCase;

class IndexUserMatchesTest extends FunctionalTestCase
{
    public function test200IsReturned(): void
    {
        $client = $this->createAuthorizedApiClient(['email' => SystemDefaults::USERS[0]['email']]);

        $client->request('GET', '/api/user/matches');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function test401IsReturnedWhenNoBearIsSupplied(): void
    {
        $client = self::createClient();

        $client->request('GET', '/api/user/matches');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }
}
