<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cipher for Cezar</title>
</head>
<body>

<form method="POST">
<p>Защитите строку с помощью шифра Цезаря (вводите латиницу)</p>
<br>

<div>
    <label for="string">Введите строку</label>
    <input type="text" name="str" id="string">
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
    <input type="submit" value="зашифровать\расшифровать">
</div>

<br>
</form>
    
</body>
</html>

<?php

include './config.php';

if(isset($_POST['str'])){
    $str = $_POST['str'];

    if(trim($str) !='' && preg_match("/[a-z]+?/i", $str)){
        $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $str=strtoupper($str);
        $str = str_split($str);

        if($_POST['type'] == 'crypt'){
            echo crypt_Cezar($str,$key);
        }else{
            echo encrypt_Cezar($str,$key);
        }

    }else{
        echo 'Недопустимые символы или пустая строка';
    }

}
   
function crypt_Cezar($str,$key){
    global $alphabet;
    $cipher = '';

    for( $i = 0; $i < count($str); $i++){
        $index = intval(array_search($str[$i],$alphabet) + $key);

        if($index >= count($alphabet)){
            $carry_index = $index - count($alphabet);
            $cipher .= $alphabet[$carry_index];
        }else{
            $cipher .= $alphabet[$index];
        }
    }

    return $cipher;
}

function encrypt_Cezar($str,$key){
    global $alphabet;
    $cipher = '';

    for( $i = 0; $i < count($str); $i++){
        $index = intval(array_search($str[$i],$alphabet) - $key);

        if($index < 0){
            $carry_index = count($alphabet) + $index;
            $cipher .= $alphabet[$carry_index];
        }else{
            $cipher .= $alphabet[$index];
        }
    }

    return $cipher;
}
?>