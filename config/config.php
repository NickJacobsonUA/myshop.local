<?php

/** Файл Настроек */

// Константы для обращения к контроллерам
define('PathPrefix', '../controllers/');
define('PathPostfix', 'Controller.php');

// Используемый шаблон
$template = 'default'; //объявление переменной которая будет носить имя используемого шаблона. Шаблон default минимум php кода.

// Пути к файлам шаблонов (*.tpl)
define('TemplatePrefix', "../views/{$template}/");
define('TemplatePostfix', '.tpl');

// Пути к файлам шаблонов в веб пространстве
define('TemplateWebPath', "../www/templates/{$template}/");

// Инициализация шаблонизатора Smarty
// put full path to Smarty.class.php
require ('../library/Smarty/libs/Smarty.class.php'); //подключение самой библиотеки Smarty
$smarty = new Smarty(); // создание экземпляра объекта Smarty

$smarty->setTemplateDir(TemplatePrefix); // Инициализация главное свойства Smarty(Смарти знает что шаблоны лежат в папке views).
$smarty->setCompileDir('../tmp/smarty/templates_c'); // Куда складывать откомпилированные шаблоны.
$smarty->setCacheDir('../tmp/smarty/cache'); // Куда складывать файлы для кеширования
$smarty->setConfigDir('../library/Smarty/configs'); // Место хранения файлов конфигурации

$smarty->assign('TemplateWebPath', TemplateWebPath); // Место хранения вспомагательных файлов (имя создаваемой переменной и значение).

