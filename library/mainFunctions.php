<?php

/**
 *
 * Основные Функции
 *
 **/

/**
 * Формирование запрашиваемой страницы
 * @param $controllerName название Контроллера
 * @param string $actionName Название функции обработки страницы
 */

function loadPage($smarty, $controllerName, $actionName = 'index')
{
    //print_r(PathPrefix . $controllerName . PathPostfix );die;
    include_once PathPrefix . $controllerName . PathPostfix ;
    
    $function = $actionName . 'Action';
    $function($smarty);
}

/**
 * Загрузка шаблона
 *
 * @param $smarty объект шаблонизатора
 * @param $templateName название файла шаблона
 */
function loadTemplate($smarty, $templateName) //принимаем объект Smarty и файл шаблона
{
    $smarty->display($templateName . TemplatePostfix); //вызов метода display и передаем имя шаблона добавляя к нему postfix(формирование имени шаблона) и выводит шаблон на экран
}

function d($value = null, $die = 1)
{
    echo 'Debug: <br /><pre>'; // Дебаг режим, то есть изучем какую то переменную
    print_r($value); //
    echo '</pre>';

    if($die) die; // проверка на функцию die.
}

/**
 * Преобразование результата работы функции выборки в ассоциативный массив
 *
 * @param $rs набор строк - результат работы SELECT
 * @return array|bool
 */
function createSmartyRsArray($rs)
{
    if (! $rs) return false;  // проверяем пришёл ли к нам массив

    $smartyRs = array(); // если пришёл то инициализируем $smartyRS как пустой массив
    while ($row = mysqli_fetch_assoc($rs)){  // прокручиваем $rs извлекая из неё по одной строке записи, и каждую строку помещаем в массив.
        $smartyRs[] = $row;
    }
    return $smartyRs;
}