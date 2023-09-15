<?php

class postController
{
    // $connect = подключение к бд, $data = данные пользователя, $content_type = тип данных
    function createUser(mysqli $connect, $json_data, $content_type): void
    {
        // проверка на тип данных
        if ($content_type === 'application/json') {
            // валидация
            if ($this->validationUserData($json_data)) {
                // декодируем json
                $data = json_decode($json_data, true);
                $user_name = $data["name"];
                // делаем запрос к бд
                $connect->query("INSERT INTO `users` (`name`) VALUES (\"{$user_name}\")");
                http_response_code(201);
                echo json_encode(["error" => 'false', 'post_id' => mysqli_insert_id($connect)]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => 'true']);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => 'true']);
        }

    }

    function validationUserData($json_data): bool
    {
        $data = json_decode($json_data, true);
        if (empty($data['name'])) {
            return false;
        }
        return true;
    }
}