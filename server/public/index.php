<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Include application bootstrap.
chdir(dirname(__DIR__));
require 'bootstrap.php';

//Create Your container
$container = new \Slim\Container();

// Get an instance of Slim.
$app = new \Slim\App($container);

// Setting up CORS.
// https://www.slimframework.com/docs/cookbook/enable-cors.html
$app->options('/{routes:.+}', function (Request $request, Response $response, $args) {
    return $response;
});

$app->add(function (Request $request, Response $response, $next) {
    $response = $next($request, $response);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Register dependencies.
require 'dependencies.php';

// Register middlewares.
require 'middlewares.php';

// Register routes.
require 'routes.php';

// Run the application!
$app->run();
