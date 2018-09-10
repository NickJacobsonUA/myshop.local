<?php
/**
 *
 *Модель для таблицы продукции
 *
 *
 */

/**
 * Получаем последние добавленные товары
 *
 * @param integer $limit Лимит товаров
 * @param return array Массив товаров
 */
function getLastProducts($limit = null)
{
    global $sql, $db, $rs;
    $sql = "SELECT *
            FROM products
            ORDER BY id DESC"; // Отсортировать в обратном порядке
    if($limit){
        $sql .=" LIMIT {$limit}";
    }

    $rs = $db->query($sql);

    return createSmartyRsArray($rs);
}

/**
 * Получит продукты для категории $itemId
 *
 * @param $itemId integer ID категории по которой нужно сделать выборку
 * @return array|bool массив продуктов шаблонизированный под Smarty
 */
function getProductsByCat($itemId)
{
    global $sql, $db, $rs;
    $itemId = intval($itemId); //проверка переменной $itemId является ли она integer. Защита от sql инъекции.
    $sql = "SELECT * 
            FROM products
            WHERE category_id = '{$itemId}'";

    $rs = $db->query($sql); // обращаемся к БД, и получаем какие то данные

    return createSmartyRsArray($rs); // результат запроса прогоняем через createSmartyRsArray, получая массив, и возвращаем его.
}

/**
 * Получить данные продукта по ID
 *
 * @param $itemId это id продукта
 * @return array|bool массив данных продукта
 */

function getProductById($itemId)
{
    global $sql, $db, $rs;
    $itemId = intval($itemId);
    $sql = "SELECT * 
            FROM products
            WHERE id = '{$itemId}'";

    $rs = $db->query($sql); // обращаемся к БД, и получаем какие то данные

    return mysqli_fetch_assoc($rs);

}