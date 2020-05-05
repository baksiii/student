<?php

require_once('config.php');

if(trim($_POST['title']) != '' AND trim($_POST['author']) != ''){

    $title = $_POST['title'];
    $author = $_POST['author'];

    $conn = connection();

    $sql = "INSERT INTO books (title,author) VALUES ('$title','$author')";
    mysqli_query($conn, $sql);

    close($conn);

    echo "Книга успешно добавлена";
}else{
    echo "Заполните все поля";
}

?>