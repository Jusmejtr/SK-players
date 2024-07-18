<?php
$cas = $_GET["cas"]; //Get string from gamemaker
$fileName = $_GET["name"]; //Get name from gamemaker

$upraveny_cas = str_replace('<', '', $cas); //Delete "<" symbols from string for safety
$nazov = str_replace('#', '-', $fileName);

$kontrola = file_exists('./gamemaker_speedrun/' .$nazov. '.txt');
if($kontrola == 1){
    $cesta = 'gamemaker_speedrun/' .$nazov. '.txt';
    file_put_contents($cesta, "\n$upraveny_cas", FILE_APPEND); //Create txt file from string you will send from gamemaker
    echo "<h1>Údaje sa úspešne uložili</h1>";
}else{
    $cesta = 'gamemaker_speedrun/' .$nazov. '.txt';
    file_put_contents($cesta, $upraveny_cas ); //Create txt file from string you will send from gamemaker
    echo "<h1>Údaje sa úspešne uložili</h1>";
}

?>

