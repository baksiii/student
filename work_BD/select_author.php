<?php

require_once('config.php');

if(trim($_GET['author']) == ''){

    $author = $_GET['author'];

    $conn = connection();

    $data = select($conn);

    

    for( $i = 0; $i < count($data); $i++){
        echo ($i + 1).".) {$data[$i]['author']}<br>";
        }

    close($conn);
}

if(trim($_GET['author']) != ''){

    $author = $_GET['author'];

    $conn = connection();

    $sql = "SELECT title FROM books WHERE author='$author'";
    $result = mysqli_query($conn,$sql);
    $arr = array();

    if((mysqli_num_rows($result)) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
    } 

    for( $i = 0; $i < count($arr); $i++){
        echo ($i + 1).".) {$arr[$i]['title']}<br>";
        }

    close($conn);
}

?>