<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working with file system</title>
</head>
<body>

<form method="POST">
<br>

<div>
    <input type="text" name="str" placeholder="Ваша строка">
</div>

<br>

<div>
    <input type="submit" value="Переписать и вывести">
</div>
<br>

</form>

<?php

if(isset($_POST['str']) && trim($_POST['str']) !=''){
    file_put_contents('./a.txt',$_POST['str']);
}

echo file_get_contents('./a.txt');

?>
    
</body>
</html>

