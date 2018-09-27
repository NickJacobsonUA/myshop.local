<?php

session_start(); // стартуем сессию

if(! isset($_SESSION['cart'])) // если в сессии нет массива корзины то создаем его
{
    $_SESSION['cart'] = array(); //проверяем на существование переменную cart, если ее нет, то создаем ее и присваиваем ей пустой массив.
    
}


include_once '../config/config.php';         // Подключение файла инициализации Настроек
include_once '../config/db.php';             // Инициализация Базы данных
include_once '../library/mainFunctions.php'; // Подключеник файла основных функций

    // определяем с каким контроллером будем работать
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';

    // определяем с какой функцией будем работать, для формирования страницы
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

//если существует пользователь в сессии то мы инициализируем смарти и присваиваем массив пользователя
if (isset($_SESSION['user']))
{
    $smarty->assign('arUser', $_SESSION['user']);
}

$smarty->assign('cartCntItems', count($_SESSION['cart'])); // инициализируем переменную смарти называем её cartCntItems, и высиляем кол.элем. в массиве $_SESSION['cart']

// Загрузка страницы
loadPage($smarty, $controllerName, $actionName);


