<?php

                                        // Подлючение к базе данных

$dblocation = "127.0.0.1";
$dbname = "myshop";
$dbuser = "root";
$dbpasswd = "";

//соединяемся с БД
$db = mysqli_connect($dblocation, $dbuser, $dbpasswd, $dbname);//создаем объект

if(! $db){
    echo "Ошибка доступа к MySQL";
    exit();
}

// Устанавливает кодировку по умолчанию для текущего соединения utf-8
mysqli_set_charset($db,'utf-8');

// Подключаемся непосредственно к нашей базе данных
if(! mysqli_select_db($db, $dbname) ){
    echo "Ошибка доступа к базе данных: ($dbname)";
    exit();
}
