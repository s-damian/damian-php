<?php

namespace Tests\Feature;

use Tests\AppBoot;
use GuzzleHttp\Client;
use DamianPhp\Foundation\Application;

class FeatureBaseTest extends AppBoot
{
    protected Client $client;

    protected $prefixUrlTests;

    /**
     * Est appellée avant chaque testMethod() de cette classe et de classes enfants.
     * PS : si on met un setUp() dans une classe enfant, c'est celle de la classe enfant qui sera appelé avant.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client();

        $this->prefixUrlTests = env('APP_URL');

        $app = new Application();
        $app->initProviders();
        $app->ifError();
        $app->ifIpIsForbidden();
        $app->ifIsMaintenance();
    }

    /**
     * A basic test example.
     */
    public function testExample(): void
    {
        $this->assertTrue(true);
    }
}
