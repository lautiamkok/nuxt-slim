<?php
// Dependency Container
// Slim uses a dependency container to prepare, manage, and inject application
// dependencies. Slim supports containers that implement PSR-11 or the
// Container-Interop interface. -
// https://www.slimframework.com/docs/concepts/di.html
$container = $app->getContainer();

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container->get('response')
            ->withStatus(404);
    };
};
