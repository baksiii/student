<?php

require_once('config.php');

$conn = connection();

$data = select($conn);

$aut = '';

if(trim($_POST['login']) != "" AND trim($_POST['password']) != "" AND trim($_POST['repyt-password']) != ""){

    $login = $_POST['login'];

    for( $i = 0; $i < count($data); $i++){
       
        if($data[$i]['login'] === $login ){
            
            $aut = true;
        
        }
    }

    if($aut == true){
        echo 'Этот логин уже занят';
        exit;
    }else{

        if(preg_match("/[a-z0-9_]/i",$_POST['login']) AND preg_match("/[a-z0-9_]/i",$_POST['password']) AND preg_match("/[a-z0-9_]/i",$_POST['repyt-password'])){

            if(strlen($_POST['login']) >= 6 AND strlen($_POST['password']) >= 6 ){

                $password = $_POST['password'];
                $repyt_password = $_POST['repyt-password'];

                if($password==$repyt_password){

                    $sql = "INSERT INTO users (login,password) VALUES ('$login','$password')";
                    mysqli_query($conn, $sql);

                    close($conn);

                    header("Location: ../index.html");

                }else{
                    echo 'Подтверждение пароля не корректно';
                    exit;  
                }

            }else{
                echo 'Логин и пароль должны быть не менее 6 символов';
            }

        }else{
            echo 'Логин и пароль должны состоять из латинских символов и цифр';
        }

    }
    
}else{
    echo 'Заполните все поля';
    exit;
}

?>