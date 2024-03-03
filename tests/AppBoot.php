<?php

declare(strict_types=1);

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../boot/autoload.php';

class AppBoot extends TestCase
{
    /**
     * Est appellée avant chaque testMethod() de cette classe et de classes enfants.
     */
    public function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
    }
}
