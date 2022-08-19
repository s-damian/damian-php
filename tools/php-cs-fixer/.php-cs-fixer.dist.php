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
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder);
