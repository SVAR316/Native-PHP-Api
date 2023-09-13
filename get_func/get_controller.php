<?php

//Запрос пользователей
function getUsers($connect) {
    // кодирование в json > сбор ответа в ассоциативный масив > запрос в бд
    echo json_encode(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users`")));
}

//Запрос пользователя
function getUser($connect, $id)
{
    // запрос в бд
    $response = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = $id");

    // проверка на количество колонн ответа
    if(mysqli_num_rows($response) === 0)
    {
        http_response_code(404);

        echo json_encode(["error" => true, "message" => "Не удалось найти пользователя"]);
    }else
    {
        // кодирование в json > сбор ответа в ассоциативный масив
        echo json_encode(mysqli_fetch_assoc($response));
    }
}
