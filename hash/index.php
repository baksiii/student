<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work whis hash</title>
</head>
<body>

<form method="POST">
<h3>Регистрация</h3>

<br>

<div>
    <label for="login">Введите логин (латиница не короче 5 символов)</label>
    <input type="text" name="login" id="login" placeholder="Ваш логин">
</div>

<br>

<div>
    <label for="password">Введите пароль (не короче 8 символов)</label>
    <input type="text" name="password" id="password" placeholder="Ваш пароль">
</div>

<br>

<div>
    <input type="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ">
</div>

<br>
</form>
    
</body>
</html>




<?php

if(isset($_POST['login']) && isset($_POST['password'])){
    $login = $_POST['login'];
    $password = $_POST['password'];

    if(trim($login) && trim($password)){
        if(preg_match("/[a-z]+?/i", $login) && strlen($login) >= 5 && strlen($password) >= 8){
            if(!file_exists ("users/$login.txt")){
                $hash_password = md5($password);
                file_put_contents("users/$login.txt", $hash_password);

                header('Location: ./auth.php');
            }else{
                echo 'Этот логин уже занят';
            }
        }else{
            echo 'Введите корректный логин';
        }

    }else{
        echo 'Заполните все поля';
    }
}

?>