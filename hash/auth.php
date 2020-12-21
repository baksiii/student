<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work whis hash</title>
</head>
<body>

<form method="POST">
<h3>Аутентификация</h3>

<br>

<div>
    <label for="login">Введите логин</label>
    <input type="text" name="login" id="login" placeholder="Ваш логин">
</div>

<br>

<div>
    <label for="password">Введите пароль</label>
    <input type="text" name="password" id="password" placeholder="Ваш пароль">
</div>

<br>

<div>
    <input type="submit" value="ВОЙТИ">
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

        if(file_exists ("users/$login.txt")){
            $hash_password = file_get_contents("users/$login.txt");
            $password = md5($password);

            if($hash_password == $password){
                echo "<h4 style='color: #26972D;'>Добро пожаловать, $login!</h4>";
            }else{
            echo 'Неверные данные';
        }
  
        }else{
            echo 'Неверные данные';
        }
       
    }else{
        echo 'Заполните все поля';
    }
}

?>