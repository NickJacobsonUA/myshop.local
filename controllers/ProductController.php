<?php

/**
 * Product controller.php
 *
 *                                        Контроллер страницы товара(/product/1)
 */

//Подключаем модели
include_once '../models/ProductsModel.php';
include_once '../models/CategoriesModel.php';

/**
 * Формирование страницы продукта
 *
 * @param object smarty шаблонизатор
 */
function indexAction($smarty) //обработка главной страницы ланного контроллера, формирование страницы товаров
{
   $itemId = isset($_GET['id']) ? $_GET['id'] : null; //получаем id через GET
    if($itemId == null)exit(); //проверяем, если пришёл 0 то выходим

    //Получить данные продукта
    $rsProduct = getProductById($itemId); // инициализируем и туда getProductById
    //Получить все категории
    $rsCategories = getAllMainCatsWithChildren(); //формирование главное меню сайта, получение всех категорий

    $smarty->assign('itemInCart', 0); // содержание данных в корзине
    if (in_array($itemId, $_SESSION['cart'])) // проверяем id продукта, если он содержится в массиве cart то переменной itemCart =1, тое сть что то есть в корзине.
    {
     $smarty->assign('itemInCart', 1);
    }

    $smarty->assign('pageTitle', '');                 // инициализируем переменные смарти, заголовок страницы
    $smarty->assign('rsCategories', $rsCategories);   // левое меню
    $smarty->assign('rsProduct', $rsProduct);          // шаблон данных продукта

    loadTemplate($smarty, 'header');    // подгружаем шаблон заголовка
    loadTemplate($smarty, 'product');   // подгружаем шаблон страницы
    loadTemplate($smarty, 'footer');    // подгружаем футер
}