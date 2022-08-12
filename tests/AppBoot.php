<?php

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../boot/autoload.php';

class AppBoot extends TestCase
{
    /**
     * Est appellée avant chaque testMethod() de cette classe et de classes enfants
     * (si on met un setUp() dans une classe enfant, c'est celle de la classe enfant qui sera appelé avant)
     */
    public function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
    }
}
