<?php

/**
 * CategotyController.php
 *
 * Контроллер страницы категории (/category/1)
 * Данный файл отвечает за обработку страниц связанных с категориями
 */

//Подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * Формирование страницы категорий
 *
 * @param object $smarty Шаблонизатор
 */
    function indexAction($smarty)
    {
        $catId = isset($_GET['id']) ? $_GET['id'] : null;
        if ($catId == 0) exit();

        $rsProducts = null;// объявляем обе переменные для предотвращения ошибок
        $rsChildCats = null;

        $rsCategory = getCatById($catId); // определить, является ли эта категория главной либо дочерней.
        // И от этого мы либо будем получать товар из БД, либо ее дочерние категории.
        //Если главная категория, то показываем дочерние
        //Иначе показываем товар
        if ($rsCategory['parent_id'] == 0) {
            $rsChildCats = getChildrenForCat($catId);
        } else {
            $rsProducts = getProductsByCat($catId);
        }

        $rsCategories = getAllMainCatsWithChildren(); //инициализируем категории и дочерние катаегории, что бы с помощью массива построить левое меню.

        $smarty->assign('pageTitle', 'Товары категории' . $rsCategory['name']); // pageTitle- данные товара категории+имя категории.

        $smarty->assign('rsCategory', $rsCategory); // инициализируем Саму главную категорию
        $smarty->assign('rsProducts', $rsProducts); // инициализируем  категорию продукты
        $smarty->assign('rsChildCats', $rsChildCats); // инициализируем подкатегории

        $smarty->assign('rsCategories', $rsCategories); // передаем $rsCategories для построения бокового меню.
        //Заполняем шаблоны
        loadTemplate($smarty, 'header'); //загружаем шаблон header
        loadTemplate($smarty, 'category'); //загружаем category
        loadTemplate($smarty, 'footer');//загружаем шаблон footer
    }
