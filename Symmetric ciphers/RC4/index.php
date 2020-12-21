<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC4</title>
</head>
<body>

<form method="POST">
<p>Создайте и зашифруйте свой логин методом RC4</p>
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
    <input type="submit" value="зашифровать\раcшифровать">
</div>

<br>
</form>
    
</body>
</html>

<?php

include './config.php';

function rc4_init_s($key) {
  
    $k = unpack('C*', $key);
    array_unshift($k, array_shift($k));
    $n = sizeof($k);
    $i = $n;
    for ($i = $n; $i < 0x100; $i++) $k[$i] = $k[$i % $n];
    for ($i--; $i >= 0x100; $i--) $k[$i & 0xff] ^= $k[$i];
  
    $s = array();
    for ($i = 0; $i < 0x100; $i++) $s[$i] = $i;
    $j = 0;
   
    for ($i = 0; $i < 0x100; $i++) {
        $j = ($j + $s[$i] + $k[$i]) & 0xff;
       
        $tmp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $tmp;
    }
    return $s;
}

function rc4_crypt($text1, $key) {
    $s = rc4_init_s($key); 
    $n = strlen($text1);
    $text2 = '';
    $i = $j = 0;
    for ($k = 0; $k < $n; $k++) {
        $i = ($i + 1) & 0xff;
        $j = ($j + $s[$i]) & 0xff;
       
        $tmp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $tmp;
   
        $text2 .= $text1{$k} ^ chr($s[$i] + $s[$j]);
    }
    return $text2;
}

function rc4_encrypt($plain_text, $password) {
    return base64_encode(rc4_crypt($plain_text, $password));
}

function rc4_decrypt($enc_text, $password) {
    return rc4_crypt(base64_decode($enc_text), $password);
}

if( isset($_POST['in-data'])){

   
    if($_POST['type'] == 'crypt'){  
        echo 'Ваш шифр ' .  rc4_encrypt($_POST['in-data'], $key) . '<br>(скопируйте его)';
     }else{
        echo 'Ваш текст ' . rc4_decrypt($_POST['in-data'], $key);
     }

}

?>