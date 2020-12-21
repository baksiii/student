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
<input type="text" name="vendor_code" placeholder="артикул товара">
</div>
<br>
<div>
<input type="text" name="name_product" placeholder="наименование товара">
</div>
<br>
<div>
<label for="add">добавить продукты</label>
<input type="radio" name="mode" id="add" value="add" checked>
<br>
<label for="delete">удалить продукты</label>
<input type="radio" name="mode" id="delete" value="delete">
</div>
<br>
<div>
    <input type="submit" value="ОБНОВИТЬ">
</div>

</form>
    
</body>
</html>

<?php

$products;

function read_arr(){
    $GLOBALS['products'] = file_get_contents("products.json");
    $GLOBALS['products'] = json_decode($GLOBALS['products'], true);
}

function write_arr(){
    $fp = fopen("products.json", "w");
    fwrite($fp, json_encode( $GLOBALS['products']));
    fclose($fp);
}

    read_arr();

if(isset($_POST['mode'])){
    if($_POST['mode'] == 'add'){
        $products[$_POST['vendor_code']] = $_POST['name_product'];
        write_arr();  
    }else{
        unset($products[$_POST['vendor_code']]);
        write_arr();
    }
}

    read_arr();
  
    echo '<h3>Процукция</h3>';
    echo '<ul>';

    if($products != null){
        foreach($products as $key => $value){
            echo "<li>$key - $value</li><br>";
            }
    }

    echo '</ul>';


?>