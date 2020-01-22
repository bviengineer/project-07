<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    // $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);

    $result = $this->todo->getTodos(); // here todo is referring to the container?
    return $response->withJson($result, 200, JSON_PRETTY_PRINT);
});
