<?php

require_once('config.php');

$conn = connection();

function selectUserPassword($conn) {
    $sql = "SELECT password FROM users WHERE login="."'".$_COOKIE['user']."'";
    $result = mysqli_query($conn,$sql);
    $arr = array();

    if((mysqli_num_rows($result)) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
    } 
    return $arr[0]['password'];
}

$user_password = selectUserPassword($conn);

if(trim($_POST['password']) != "" AND trim($_POST['new-password']) != "" AND trim($_POST['new-password-repyt']) != ""){

    if($_POST['password'] === $user_password){

        if($_POST['new-password'] == $_POST['new-password-repyt']){
            
            $sql = "UPDATE users SET password="."'".$_POST['new-password']."'"."WHERE login="."'".$_COOKIE['user']."'";
            mysqli_query($conn, $sql);

            echo 'Пароль успешно заменён';

        }else{
            echo 'Подтверждение пароля не совпадает с основным паролем';
        }
    }else{
        echo 'Пароль указан не верно';
    }

}else{
    echo 'Заполните все поля';
}

?>