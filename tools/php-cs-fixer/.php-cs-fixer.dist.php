<?php

$baseDir = __DIR__ . '/../../';

$finder = PhpCsFixer\Finder::create()
    ->in([
        $baseDir . 'app',
        $baseDir . 'config',
        $baseDir . 'resources/lang',
        $baseDir . 'routes',
        $baseDir . 'tests',
    ])
    ->name('*.php');

$config = new PhpCsFixer\Config();
return $config
    ->setRules(
        require_once __DIR__ . '/php-cs-fixer-rules.php'
    )
    ->setFinder($finder);
