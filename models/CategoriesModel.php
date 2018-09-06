<?php

/**
 * Модель для воборки категорий из таблицы категорий (categories) mySql
 * 
 */
/**
 * Получить дочерние категории для категории $catId
 * @return array массив дочерних категорий
 * @param integer $catId ID категорий
 */


function getChildrenForCat($catId) // функция создания mysql запроса
{
     global $sql, $db;         //Запрос к базе данных
     $sql = "SELECT *
             FROM categories
             WHERE parent_id = '$catId'"; //параметром для запросы выбираем $catId, выборка записей
    
    $rs = $db->query($sql);      // Выполнение запроса, результат в переменной $rs, записи выбрали.
    
    return createSmartyRsArray($rs); // передали записи в функцию для того что бы преобразовать данные полученный в виде массива.

}

/**
 * Получить главные категории с привязями дочерних
 * @return array миссив категорий
 */

function getAllMainCatsWithChildren()
{
    global $sql, $db, $rs;         //Запрос к базе данных
    $sql = "SELECT * 
            FROM categories 
            WHERE parent_id = 0";

    $rs = $db->query($sql);      // Выполнение запроса, результат в переменной $rs.

    // Данные которые возвращаем в контроллер

    $smartyRs=array(); //Инициализируем массив

    while ($row = mysqli_fetch_assoc($rs)) { // прокручиваем массив вытаскивая каждое значение

        $rsChildren = getChildrenForCat($row['id']); //Инициализируем переменную $rsChildren, getChildrenForCat возвращиет массив с категориями.

        if($rsChildren) //проверяем если категории существуют то в строке создаем новый массив и присваваим туда массив с дочерними категориями.
        {
            $row['children'] = $rsChildren; // присоединяем к массиву главных функций с ключом children
        }

    $smartyRs[] = $row; // Информацию о главной категории помещаем в $smartyRs
    }

    return $smartyRs; //возвращаем переменную после проходжения цикла

}

/**
 * Получить данные категорий по ID
 * @param integer $catId ID по категориям
 * @return array|null массив - строка категории
 */
function getCatById($catId)
{
    global $sql, $db, $rs;
    $catId = intval($catId); //заводим переменную $catId, параметры: какое бы значение не пришло в $catId все значения преобразуются в Integer. Защита от sql инъекции.
    $sql = "SELECT * 
            FROM categories 
            WHERE id = '$catId'";

    $rs = $db->query($sql); // обращаемся к БД, и получаем какие то данные
    return mysqli_fetch_assoc($rs); // преобразовываем эти данные с помощью функции mysqli_fetch_assoc в ассоциативный массив
}