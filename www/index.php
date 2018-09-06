<?php

include_once '../config/config.php';         // Подключение файла инициализации Настроек
include_once '../config/db.php';             // Инициализация Базы данных
include_once '../library/mainFunctions.php'; // Подключеник файла основных функций

    // определяем с каким контроллером будем работать
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';

    // определяем с какой функцией будем работать, для формирования страницы
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Загрузка страницы
loadPage($smarty, $controllerName, $actionName);


