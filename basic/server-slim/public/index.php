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

// Import classes.
use Slim\App as Slim;

// Include application bootstrap.
chdir(dirname(__DIR__));
require 'bootstrap.php';

// Get an instance of Slim.
$app = new Slim();

$app->get('/', function (Request $request, Response $response, $args) {
    $data = [
        "status" => 200,
        "message" => "Hello world!"
    ];
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-type', 'application/json');

    // You might need to set up CORS when it is served for socket.io.
    // https://www.slimframework.com/docs/cookbook/enable-cors.html
    // return $response
    //         ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
    //         ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    //         ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Run the application!
$app->run();
