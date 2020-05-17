<?php

require_once('config.php');

$conn = connection();

$sql = "DELETE FROM users WHERE login="."'".$_COOKIE['user']."'";
        mysqli_query($conn, $sql);

close($conn);

setcookie("user", $_COOKIE['user'],time()-1);
header("Location: ../index.html");

?>