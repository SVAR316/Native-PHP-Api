<?php

// Задаем в header тип данных json
header("Content-type: json/application");

//Подключение файлов
$connect = require 'db.php';
$get_controller = require 'get_func/get_controller.php';


// получение параметра после http://example/
$request = $_GET['q'];
$params = explode('/', $request);
$query = $params[0];

if($query === "users"){
    if(isset($params[1]))
    {
        $get_controller->getUser($connect, $params[1]);
    }else
    {
        $get_controller->getUsers($connect);
    }
}else {
    http_response_code(404);
    echo json_encode(["error" => true]);
}

