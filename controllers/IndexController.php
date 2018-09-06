<?php

// Контроллер Главное йстраницы

// Подключаем Модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

    function testAction(){
        echo 'IndexController.php > testAction';
    }


/**
 * Формирование главной страницы сайта
 *
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty){

    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getLastProducts(16);

    
    $smarty->assign('pageTitle', 'Главная страница сайта'); //инициализируем переменную pageTitle в шаблон и присваеваем ей значение главн Страницы 
    $smarty->assign('rsCategories' , $rsCategories); // В шаблоне index.tpl мы можем обрабатывать массив и выводить его на экран.
    $smarty->assign('rsProducts' , $rsProducts);

    loadTemplate($smarty, 'header'); //выгружаем шаблоны в браузер
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
    
}
