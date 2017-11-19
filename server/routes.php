<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Dummy users.
$users = [
    ['name' => 'Alexandre'],
    ['name' => 'Pooya'],
    ['name' => 'Sebastien']
];

// Routes:
// Home page.
$app->get('/', function (Request $request, Response $response, $args) {
    $data = [
        "message" => "Hello world!"
    ];
    $response->getBody()->write(json_encode($data));
});

// Users page.
$app->get('/users', function (Request $request, Response $response, $args) use ($users) {
    $data = [
        "status" => 200,
        "data" => $users
    ];
    $response->getBody()->write(json_encode($users));
});

// User page.
$app->get('/users/{id}', function (Request $request, Response $response, $args) use ($users) {
    $id = $args['id'];

    // Throw error if no result found.
    if (array_key_exists($id, $users) === false) {
        throw new \Exception('No user found', 200);
    }
    $user = $users[$id];
    $response->getBody()->write(json_encode($user));
});
