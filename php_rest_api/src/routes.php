<?php
// Routes

// Root route 
$app->get('/', function ($request, $response, $args) {
    $endpoints = [
        // Todo endponits
        'view all todos' => $this->api['api_url'].'/todos',
        'view a single todo' => $this->api['api_url'].'/todos/{todoId}',
        'add a todo' => $this->api['api_url'].'/todos/{todoId}',
        'update a todo' => $this->api['api_url'].'/todos/{todoId}',
        'delete a todo' => $this->api['api_url'].'/todos/{todoId}',
        
        // Subtasks endpoints 
        'view all subtasks for a given todo' => $this->api['api_url']. '/todos/{task_id}/subtasks',
        'add a subtask for a given todo' => $this->api['api_url']. '/todos/{task_id}/subtasks',
        'view a single subtask for a given todo' => $this->api['api_url']. '/todos/{task_id}/subtasks/{subtask_id}',
        'update a subtask' => $this->api['api_url']. '/todos/{task_id}/subtasks/{subtask_id}',
        'delete a subtask' => $this->api['api_url']. '/todos/{task_id}/subtasks/{subtask_id}',


        // Endpoints menu
        'help' => $this->api['base_url'].'/'
    ];
    $result = [
        'endpoints' => $endpoints,
        'version' => $this->api['version'],
        'datetime' => date('c')
    ];
    return $response->withJson($result, 200, JSON_PRETTY_PRINT);
});
// Route group 
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
        $data['id'] = $args['todoId']; //why?
        $result = $this->todo->updateTodo($data);
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    // Delete a todo
    $app->delete('/{todoId}', function ($request, $response, $args) {    
        $result = $this->todo->deleteTodo($args['todoId']);
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });

    // Subtasks route group
    $app->group('/{task_id}/subtasks', function () use ($app){
        // Add a subtask
        $app->post('', function ($request, $response, $args) {    
            $result = $this->subtasks->createSubtask($request->getParsedBody());
            return $response->withJson($result, 201, JSON_PRETTY_PRINT);
        });
        // View all subtasks for a given todo
        $app->get('', function ($request, $response, $args) {    
            $result = $this->subtasks->getSubtasks($args['task_id']);
            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        });
        // View a single subtask for a todo by the subtask's id
        $app->get('/{subtask_id}', function ($request, $response, $args) {    
            $result = $this->subtasks->getSubtaskById($args['subtask_id']);
            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        });
        // Update a subtask
        $app->put('/{subtask_id}', function ($request, $response, $args) {    
            $data = $request->getParsedBody();
            $data['id'] = $args['subtask_id'];
            $result = $this->subtasks->updateSubtask($data);
            return $response->withJson($result, 201, JSON_PRETTY_PRINT);
        });
        // Delete a todo
        $app->delete('/{subtask_id}', function ($request, $response, $args) {    
            $result = $this->subtasks->deleteSubtask($args['subtask_id']);
            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        });
    });
});