<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    $endpoints = [
        'list all todos' => $this->api['api_url'].'/todos',
        'list a single todo' => $this->api['api_url'].'/todos/{todoId}',
        'add a todo' => $this->api['api_url'].'/todos', // needed
        'update a todo' => $this->api['api_url'].'/todos/todoId',
        'help' => $this->api['base_url'].'/'
    ];
    $result = [
        'endpoints' => $endpoints,
        'version' => $this->api['version'],
        'datetime' => date('c')
    ];
    return $response->withJson($result, 200, JSON_PRETTY_PRINT);
});
$app->group('/api/v1/todos', function() use ($app){
    // List all todos
    $app->get('', function ($request, $response, $args) {    
        $result = $this->todo->getTodos(); 
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    // List a specific todo
    $app->get('/todoId', function ($request, $response, $args) {    
        $result = $this->todo->getTodo($args['todoId']);
        //var_dump($result);
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    // Create a todo
    $app->post('', function ($request, $response, $args) {    
        $result = $this->todo->createTodo($request->getParsedBody());
        //var_dump($result);
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    // Update a todo
    $app->put('', function ($request, $response, $args) {    
        $data = $request->getParsedBody();
        $data['todoId'] = $args['todoId'];
        $result = $this->todo->updateTodo($data);
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
});

// [GET] /api/v1/todos > DONE
// [POST] /api/v1/todos > DONE
// [GET] /api/v1/todos/{id} DONE
// [PUT] /api/v1/todos/{id}
// [DELETE] /api/v1/todos/{id}
