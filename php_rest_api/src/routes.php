<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    $endpoints = [
        'list all todos' => $this->api['api_url'].'/todos',
        'list a single todo' => $this->api['api_url'].'/todos/{todoId}',
        'add a todo' => $this->api['api_url'].'/todos/{todoId}',
        'update a todo' => $this->api['api_url'].'/todos/{todoId}',
        'delete a todo' => $this->api['api_url'].'/todos/{todoId}',
        'list all subtasks' => $this->api['api_url'].'/todos/{task_id}/subtasks',
        
        // Subtasks
        'list all subtasks' => $this->api['api_url']. '/todos/{task_id}/subtasks',
        'list a single subtask' => $this->api['api_url']. '/todos/{task_id}/subtasks/{subtask_id}',
        'update a subtask' => $this->api['api_url']. '/todos/{task_id}/subtasks/{subtask_id}',
        'delete a subtask' => $this->api['api_url']. '/todos/{task_id}/subtasks/{subtask_id}',
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
    $app->get('/{todoId}', function ($request, $response, $args) {    
        $result = $this->todo->getTodo($args['todoId']);
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    // Create a todo
    $app->post('', function ($request, $response, $args) {    
        $result = $this->todo->createTodo($request->getParsedBody());
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    // Update a todo
    $app->put('/{todoId}', function ($request, $response, $args) {    
        $data = $request->getParsedBody();
        $data['id'] = $args['todoId'];
        $result = $this->todo->updateTodo($data);
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    // Delete a todo
    $app->delete('/{todoId}', function ($request, $response, $args) {    
        $result = $this->todo->deleteTodo($args['todoId']);
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
});