<?php

if(trim($_POST['login']) != "" AND trim($_POST['password']) != ""){

    $login = $_POST['login'];
    $password = $_POST['password'];
    
    require_once('config.php');

    $conn = connection();

    $data = select($conn);
   
    close($conn);

    $aut = '';
    
    for( $i = 0; $i < count($data); $i++){
       
        if($data[$i]['login'] === $login AND $data[$i]['password'] === $password){
            
            $aut = true;
        
        }
    }

    if($aut == true){
        setcookie("user", "$login", time()+400000);
    }else{
        echo 'Такого пользователя не существует или данные введены некорректно';
        exit;
    }

}else{
    echo 'Заполните все поля';
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Денежные переводы</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

    <h2>Cabinet user</h2>

    <form action="add.php" method="POST">

        <p>Введите логин получателя: <input type="text" name="login"></p>
        <p>Сумма перевода: <input type="number" name="sum"></p>
        <input type="submit" value="ОТПРАВИТЬ">

    </form>

    <form action="delete_user.php" method="POST">
    
    <input type="submit" value="УДАЛИТЬ АККАУНТ">

    </form>

    <h2>Reset password</h2>

    <form action="reset_password.php" method="POST">

        <p>Введите старый пароль: <input type="text" name="password"></p>
        <p>Введите новый пароль: <input type="text" name="new-password"></p>
        <p>Подтвердите новый пароль: <input type="text" name="new-password-repyt"></p>
        <input type="submit" value="ЗАМЕНИТЬ">

    </form>

</body>

</html>