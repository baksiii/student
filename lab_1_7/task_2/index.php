<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working with arrays</title>
</head>
<body>

<form method="POST">
<br>
<div>
<input type="text" name="person" placeholder="ФИО">
</div>
<br>
<div>
<label for="add">добавить персону</label>
<input type="radio" name="mode" id="add" value="add" checked>
<br>
<label for="delete">исключить персону</label>
<input type="radio" name="mode" id="delete" value="delete">
<br>
<label for="sort">пересортировать по очереди внесения в группу</label>
<input type="radio" name="mode" id="sort" value="sort">
</div>
<br>
<div>
    <input type="submit" value="ОБНОВИТЬ">
</div>

</form>
    
</body>
</html>

<?php

$group = [];
$state = [];

function read_arr( $file_name, &$var){
    $buffer = file_get_contents($file_name);
    $var = unserialize($buffer);
}

function write_arr($file_name,&$var){
    $fp = fopen($file_name, "w");
    fwrite($fp, serialize( $var));
    fclose($fp);
}

read_arr('group.txt', $group);
read_arr('state.txt', $state);


if(isset($_POST['mode'])){
    switch ($_POST['mode']) {
        case'add':
            if(isset($_POST['person'])){
                if($_POST['person'] !=''){
                    $group[] = $_POST['person'];
                    write_arr('group.txt', $group);  
                }else{
                    echo 'Введите ФИО';
                }
            }
            break;
        case 'sort':
            if($state[0] == '1'){
                krsort($group);
                array_values($group);
                $state[0] = '0';
                write_arr('state.txt', $state);
            }else{
                ksort($group);
                array_values($group);
                $state[0] = '1';
                write_arr('state.txt', $state);
            }
           
            write_arr('group.txt', $group);
            break;
        case 'delete':
            if(isset($_POST['person'])){
                if($_POST['person'] !=''){
                    if(($key = array_search($_POST['person'],$group)) !== false){
                        unset($group[$key]);
                        array_values($group);
                        write_arr('group.txt', $group);  
                    }
                }else{
                    echo 'Введите ФИО';
                }
            }
            break;
    }
}

read_arr('group.txt', $group);

echo '<h3>Список группы</h3>';
echo '<ul>';


if($group != null){
    foreach($group as $key => $value){
        echo "<li> $value</li><br>";
        }
}


echo '</ul>';


?>