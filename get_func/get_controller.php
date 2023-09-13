<?php

function getUsers($connect) {
    echo json_encode(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users`")));
}

function getUser($connect, $id)
{
    $response = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = $id");
    if(mysqli_num_rows($response) === 0)
    {
        http_response_code(404);

        echo json_encode(["error" => true, "message" => "Не удалось найти пользователя"]);
    }else
    {
        echo json_encode(mysqli_fetch_assoc($response));
    }
}
