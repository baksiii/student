<?php

if(trim($_POST['name']) != '' AND trim($_POST['password']) != ''){

    $name = $_POST['name'];
    $password = $_POST['password'];
    $file_name = "users/$name.txt";

    if(file_exists($file_name)){
        $handle = fopen($file_name,'r');
        $contents = fread($handle, filesize($file_name));

        if($contents == $password){
           
        }else{
            echo 'Неверный логин или пароль';
            exit;
        }
    }else{

    echo "Неверный логин или пароль";
    exit;
    }

}else{
    echo "Заполните все поля";
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User cabinet</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Кабинет пользователя</h1>
    
</body>

</html>