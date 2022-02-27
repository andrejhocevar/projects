<?php

include_once ('model/model.php');
function user_authenticate($email, $password, $conn){
    $sql = "SELECT * FROM user WHERE user_email = '$email'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    return password_verify($password, $data["user_password"]);
}   

function check_if_email_exist($email, $conn){
    $sql = "SELECT * FROM user WHERE user_email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        return false;
    }
    return true;
}

function check_if_name_exist($name, $conn){
    $sql = "SELECT * FROM user WHERE user_name = '$name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        return false;
    }
    return true;
}

function get_user_data($email, $conn){
    $sql = "SELECT * FROM user WHERE user_email = '$email'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    return $data;
}


function redirect($url){
    header("Location: $url.php");
}


