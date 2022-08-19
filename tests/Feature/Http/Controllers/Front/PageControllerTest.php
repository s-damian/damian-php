<?php

namespace Tests\FeatureHttp\Controllers\Front;

use Tests\Feature\FeatureBaseTest;

class PageControllerTest extends FeatureBaseTest
{
    public function testGet200(): void
    {
        $response = $this->client->get($this->prefixUrlTests.'/');
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->client->get($this->prefixUrlTests.'/contact');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
