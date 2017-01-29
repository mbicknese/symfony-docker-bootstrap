<?php
require __DIR__ . '/../autoload.php';

$env = $_ENV['SYMFONY_ENV'] ?? 'dev';
$debug = $_ENV['SYMFONY_DEBUG'] ?? true;

if ($debug) {
    Symfony\Component\Debug\Debug::enable();
}

$kernel = new App\AppKernel($env, $debug);
$kernel->loadClassCache();

$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
