<?php

require_once('config.php');

$conn = connection();

$data = select($conn);

$aut = '';


for( $i = 0; $i < count($data); $i++){
       
    if($data[$i]['login'] === $_POST['login'] ){
        
       $aut = true;
    
    }
}

if($aut != true){
    echo 'Указанного пользователя не существует';
    exit;
}

//Баланс текущего пользователя;
function selectBalanceUser($conn) {

    $sql = "SELECT balance FROM users WHERE login="."'".$_COOKIE['user']."'";
    $result = mysqli_query($conn,$sql);
    $arr = array();

    if((mysqli_num_rows($result)) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
    } 
    return $arr[0]['balance'];
}

$sum_users = selectBalanceUser($conn);

if(trim($_POST['login']) != "" AND trim($_POST['sum']) != ""){

    if($_POST['sum'] > 0){

        $login = $_POST['login'];
        $sum = $_POST['sum'];

//Баланс пользователя которому будет выполняться перевод;
        function selectBalanceUserRes($conn) {
            
            $sql = "SELECT balance FROM users WHERE login="."'".$_POST['login']."'";
            $result = mysqli_query($conn,$sql);
            $arr = array();
            
            if((mysqli_num_rows($result)) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $arr[] = $row;
                }
            } 
            return $arr[0]['balance'];
        }
      
        $sum_user_res = selectBalanceUserRes($conn);

        if($sum_users > $sum){

//Перерасчет и обновление балансов пользователей;
        $new_sum_users = $sum_users - $sum;
        $new_sum_res = $sum_user_res + $sum;

        $sql = "UPDATE users SET balance= $new_sum_users WHERE login="."'".$_COOKIE['user']."'";
        mysqli_query($conn, $sql);

        $sql = "UPDATE users SET balance= $new_sum_res WHERE login="."'".$login."'";
        mysqli_query($conn, $sql);

        echo 'Перевод прошел успешно';

        }else{
            echo 'Недостаточно средств на балансе';
        }

    }else{
        echo 'Сумма введена некорректно';
    }

}else{
    echo 'Заполните все поля';
}
close($conn);
?>