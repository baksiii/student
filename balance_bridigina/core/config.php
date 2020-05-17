<?php

define('SERVERNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DBNAME','balance');

function connection() {
    // Create connection
    $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DBNAME);

    mysqli_set_charset($conn,"utf8");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function select($conn) {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
    $arr = array();

    if((mysqli_num_rows($result)) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
    } 
    return $arr;
}

function close($conn) {
    mysqli_close($conn);
}

?>