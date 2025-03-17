<?php

require_once('../private/init.php');

$errors = [];
$success = false;



if(!empty($_POST)){

    $profile = [];
    $profile['user_id'] = $_POST['user_id'];
    $profile['image_format'] = $_POST['image_format'];
    $profile['image_name'] = $_POST['image_name'];

    foreach($profile as $key => $value) {
        if(empty($value)){
            $errors[] = is_empty($key, $value);
        }
    }

    if(empty($errors)){

        $user = find_user_by_id($profile['user_id']);
        $file_path = "uploads/user-images/";

        if(!empty($user["image_name"])){
            delete_image($user["image_name"], $file_path);
        }

        $file_name = md5(uniqid(rand(), true)) . "." . $profile['image_format'];
        $data = base64_decode($profile['image_name']);

        if(file_put_contents( $file_path .$file_name, $data) > 0){
            $updated_user["user_id"] = $profile['user_id'];
            $updated_user["image_name"] = $file_name;

            if(update_user_image($updated_user)){

                echo $updated_user["image_name"];

            }
        }
    }
}

?>

