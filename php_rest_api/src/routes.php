<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    $endpoints = [
        'list of todos' => $this->api['api_url'].'/todos',
        'single todo' => $this->api['api_url'].'/todos/{todoId}',
        'todos by status' => $this->api['api_url'].'/todos/status',
        'single status' => $this->api['api_url'].'/todos/status_id',
        'help' => $this->api['base_url'].'/'
    ];

    $result = [
        'endpoints' => $endpoints,
        'version' => $this->api['version'],
        'datetime' => date('c')
    ];

    //$result = $this->todo->getTodos(); // here todo is referring to the container?
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
