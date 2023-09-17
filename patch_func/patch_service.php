<?php

class patchController{

    function changeUser(mysqli $connect, $json_data){
        if($this->validationData($json_data))
        {
            $data = json_decode($json_data, true);
            $id = $data['id'];
            $response = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = $id");
            if(mysqli_num_rows($response) > 0)
            {
                $name = $data["name"];
                $connect->query("UPDATE `users` SET `name` = '$name' WHERE `users`.`id` = $id");
                http_response_code(200);
                echo json_encode(["error" => 'false', 'message' => "Пользователь изменен"]);
            }else {
                http_response_code(404);
                echo json_encode(["error" => 'true', "message" => "Такого пользователя не существует"]);
            }
        }else{
            http_response_code(400);
            echo json_encode(["error" => 'true']);
        }
    }

    function validationData($json_data): bool
    {
        $data = json_decode($json_data, true);
        if (empty($data['name']) && empty($data['id'])) {
            return false;
        }
        return true;
    }
}