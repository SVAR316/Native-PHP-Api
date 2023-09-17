<?php

class deleteService
{
    function deleteUser($connect, $json_data, $content_type) : void
    {
        if($content_type === 'application/json'){
            if($this->validationUser($json_data))
            {
                $data = json_decode($json_data, true);
                $id = $data['id'];
                $response = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = $id");
                if(mysqli_num_rows($response) > 0)
                {
                    $connect->query("DELETE FROM users WHERE `users`.`id` = $id");
                    http_response_code(200);
                    echo json_encode(["error" => 'false', 'message' => "Пользователь удален"]);
                }else {
                    http_response_code(404);
                    echo json_encode(["error" => 'true', "message" => "Такого пользователя не существует"]);
                }
            }else {
                http_response_code(400);
                echo json_encode(["error" => 'true']);
            }
        }
        else {
            http_response_code(400);
            echo json_encode(["error" => 'true']);
        }
    }

    function validationUser($json_data): bool
    {
        $data = json_decode($json_data, true);
        if (empty($data['id'])) {
            return false;
        }
        return true;
    }
}