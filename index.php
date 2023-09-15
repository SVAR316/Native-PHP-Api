<?php
// Задаем в header тип данных json
header("Content-type: json/application");

//Подключение файлов
$connect = require 'db.php';
$get_controller_file = require 'get_func/get_controller.php';
$post_controller_file = require 'post_func/post_controller.php';
//Создание экземпляра класса
$get_controller = new getController();
$post_controller = new postController();



// получение параметра после http://example/
$request = $_GET['q'];
// Разбиваем запрос
$params = explode('/', $request);
$query = $params[0];
//Получаем метод запроса
$method = $_SERVER['REQUEST_METHOD'];
// Получаем тип контента
$content_type = $_SERVER['CONTENT_TYPE'];



// Проверяем тип запроса
if ($method === 'GET') {
    switch ($query) {
        case "users":
            // проверка на доп параметры в запросе
            if (isset($params[1])) {
                $get_controller->getUser($connect, $params[1]);
            } else {
                $get_controller->getUsers($connect);
            }
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => true]);
            break;
    }
}
elseif($method === 'POST')
{
    switch ($query)
    {
        case "users":
            $post_controller->createUser($connect, file_get_contents('php://input'), $content_type);
            break;

        default:
            http_response_code(404);
            echo json_encode(["error" => true]);
            break;
    }
}
else
{
    http_response_code(404);
    echo json_encode(["error" => true]);
}


