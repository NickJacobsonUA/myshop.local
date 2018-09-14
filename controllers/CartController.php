<?php
/**
 * cartController.php
 * 
 * Контроллер для работы с корзиной
 * 
 */ 

// Подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * Добавление продукта в корзину по id
 * 
 * @param integer id GET параметр - ID добавляемого продута
 * @return json информация об операции (успех, количество элементов в корзине)
 */
function addtocartAction()
{
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null; // в $itemId добавляем значение $_GET['id'], если $_GET['id'] не пришёл то присваиваем 0ж

    if (! $itemId) return false; // если $itemId=0, то мы завершаем данную функцию.

    $resData = array(); // инициализируем переменную $resData, и пихаем ей пустой массив. В $resData - результирующие данные, которые мы возвращаем в js script/

    //если значение не найдено то добавляем
    if (isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart']) === false) // в $_SESSION['cart'] хранятся идентификаторы продуктов в корзине.
    {                                              // с помощью $itemId нпроверка наличия id продукта в массиве $_SESSION['cart']. Если нет то выполняем код ниже
        $_SESSION['cart'][] = $itemId;   // в корзине товара нет, помещаем в массив $itemId
        $resData['cntItems'] = count($_SESSION['cart']); // инициализируем кол.элементов и берем кол. элем. массива $_SESSION['cart'], для вывода кол.элем в крзине
        $resData['success'] = 1; // функция положила товар в корзину
    }
    else
    {
        $resData['success'] = 0; // если товар в корзине есть
    }

    echo json_encode($resData); // возвращаем в скрипт main.js и на страничку, преобразовывая обычный массив в json данные
}


/**
 * Функция удаления товара из корзины
 *
 * @param integer id GET параметр - ID удаляемого из корзины продукта
 * @return json информация ою операции (успех, кол-во элментов в корзине)
 */
function removefromcartAction()
{
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null; // инициализация переменную по GET
    if (! $itemId) exit(); // если есть число  0

    $resData = array(); // результируюие данные переменная инициализируем
    $key = array_search($itemId, $_SESSION['cart']); // ищем элемент массива по id который = $itemId
    if ($key !== false)
    {
        unset($_SESSION['cart'][$key]); // удаляем элемент из корзины
        $resData['success'] = 1; // успешное удаление
        $resData['cntItems'] = count($_SESSION['cart']);// добавляем в cntItems содержимое массива cart.

    }
    else
    {
        $resData['success'] = 0;
    }
    echo json_encode($resData); // кодиркем с помощью json_encode, и возвращаем в функцию js
}

    /**
    * @param $smarty формирование страницы корзины
    * @link /cart/ по умолчанию грузится indexAction
    */
    function indexAction($smarty)
    {
        $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array(); // список продуктов в корзине

        $rsCategories = getAllMainCatsWithChildren(); // помещаем все категории в переменную
        $rsProducts = getProductsFromArray($itemsIds); // формируем массив продукции из массива
        
        $smarty->assign('pageTitle', 'Корзина'); // инициализация переменных смарти
        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('rsProducts', $rsProducts);

        loadTemplate($smarty, 'header');// грузим шаблоны
        loadTemplate($smarty, 'cart');
        loadTemplate($smarty, 'footer');
    }
