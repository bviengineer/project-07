<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    $endpoints = [
        'list of todos' => '/api/v1/todos',
        'single todo' => '/api/v1/{todoId}',
        'todos by status' => '/api/v1/todos/status',
        'single status' => '/api/v1/todos/status_id',
        'help' => '/'
    ];

    $result = $this->todo->getTodos(); // here todo is referring to the container?
    return $response->withJson($result, 200, JSON_PRETTY_PRINT);
});
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
