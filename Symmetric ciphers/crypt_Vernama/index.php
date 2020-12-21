<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XOR</title>
</head>
<body>

<form method="POST">
<p>Создайте и зашифруйте свой логин, который будет состоять из 4-6 символов латиницы в любом регистре</p>
<br>

<div>
    <label for="string">Введите строку</label>
    <input type="text" name="in-data" id="string">
</div>

<div>
    <label for="crypt">Зашифровать</label>
    <input type="radio" name="type" id="crypt" value="crypt" checked>
</div>

<div>
    <label for="encrypt">Расшифровать</label>
    <input type="radio" name="type" id="encrypt" value="encrypt">
</div>

<br>

<div>
    <input type="submit" value="зашифровать\разшифровать">
</div>

<br>
</form>
    
</body>
</html>

<?php

include './config.php';

function crypt_xor($text,$key){

    $cipher = '';
    $text = str_split($text);
    $key = str_split($key); 

    for( $i = 0; $i < count($text); $i++){
        $cipher .= $text[$i] ^ $key[$i];
    }

   return $cipher;
}

if(isset($_POST['in-data'])){
    if(strlen($_POST['in-data']) <= 6 && strlen($_POST['in-data']) >= 4){

   
        if($_POST['type'] == 'crypt'){
            if(preg_match("/[a-z]+?/i", $_POST['in-data'])){
            echo 'Ваш шифр ' . crypt_xor($_POST['in-data'],$key) . '<br>(скопируйте его)';
            }else{
                echo 'Недопустимые символы';
            } 
         }else{
            echo 'Ваш текст ' . crypt_xor($_POST['in-data'],$key);
         }
  
    }else{
        echo 'Недопустимая длина';
    }
}




?>