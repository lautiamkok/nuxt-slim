<?php
// Application middleware
// Application middleware is invoked for every incoming HTTP request.
// https://www.slimframework.com/docs/concepts/middleware.html

// Catch all http errors here.
$app->add(function ($request, $response, $next) {

    // Default status code.
    $status = 200;

    // Catch errors and modify PSR7 body.
    try {
        // Call next middleware.
        $response = $next($request, $response);
        $status = $response->getStatusCode();

        // If it is 404, throw error here.
        if ($status === 404) {
            throw new \Exception('Page not found', 404);
        }

        // Modify the PSR7 body from all routes.
        // https://akrabat.com/filtering-the-psr-7-body-in-middleware/
        if ($status === 200) {
            $content = $response->getBody();
            $data = [
                "status" => $status,
                "data" => json_decode($content, true)
            ];
            $response->getBody()->rewind();
            $response->getBody()->write(json_encode($data));
        }
    } catch (\Exception $error) {
        $status = $error->getCode();
        $data = [
            "status" => $error->getCode(),
            "messsage" => $error->getMessage()
        ];
        $response->getBody()->write(json_encode($data));
    };
    return $response
        ->withStatus($status)
        ->withHeader('Content-type', 'application/json');
});
