<?php
// Routes

// $app->get('/', function ($request, $response, $args) {
// // $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     // $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     // return $this->renderer->render($response, 'index.phtml', $args);

//     $result = $this->todo->getTodos(); // here todo is referring to the container?
//     return $response->withJson($result, 200, JSON_PRETTY_PRINT);
// });
// [GET] /api/v1/todos
// [POST] /api/v1/todos
// [GET] /api/v1/todos/{id}
// [PUT] /api/v1/todos/{id}
// [DELETE] /api/v1/todos/{id}
$app->group('/api/v1/todos', function() use ($app){
    $app->get('', function ($request, $response, $args) {    
        $result = $this->todo->getTodos(); // here todo is referring to the container?
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    $app->get('/{todoId}', function ($request, $response, $args) {    
        $result = $this->todo->getTodo($args['todoId']);
        var_dump($result);
        //return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
});
