<?php  
$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];

if ($a =='' OR $b==''){
    echo 'Введите числа';
    die;
}

if($c=='sum'){
	echo $a + $b;
} 

if ($c=='deduct') {
	echo $a - $b;
}

if ($c=='multiply'){
	echo $a * $b;
}

if($c=='split'){
	echo $a / $b;
}

if($c=='min'){
	if ($a > $b){
     echo $b;
}else{
	echo $a;
}
}

if($c=='max'){
	if ($a < $b){
     echo $b;
}else{
	echo $a;
}
}
?>

