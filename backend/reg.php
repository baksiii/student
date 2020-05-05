<?php

if(trim($_POST['name']) != '' AND trim($_POST['password']) != ''){

    $name = $_POST['name'];
    $password = $_POST['password'];
    $file_name = "users/$name.txt";

    if(file_exists($file_name)){
        echo 'Такой логин уже существует ';
    }else{
    file_put_contents ("users/$name.txt" , $password);

    echo "Регистрация прошла успешно";
    }

}else{
    echo "Заполните все поля";
}

?>