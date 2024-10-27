<?php

include("Function/CRUD.php");
header('Content-Type: application/json');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$Api = new Mission("Clean", "Clean everything", 1); // Ensure this is initialized before usage

switch ($requestMethod) {
    case 'POST':
        $Api->Create();
        break;
    case 'GET':
        if (preg_match('/\/api\/(\d+)/', $requestUri, $matches)) {
            $Api->read($matches[1]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Task not found"]);
        }
        break;
    case 'PUT':
        if (preg_match('/\/api\/(\d+)/', $requestUri, $matches)) {
            $Api->update($matches[1]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Task not found"]);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/api\/(\d+)/', $requestUri, $matches)) {
            $Api->delete($matches[1]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Task not found"]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
?>