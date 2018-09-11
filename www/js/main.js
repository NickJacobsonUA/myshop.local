/**
 * Created by Nick on 10.09.2018.
 */

/**
 * Функция добавления товара в корзину
 *
 * @param integer itemId ID продукта
 * @return в случае успеха обновятся данные корзины на странице
 */

 function addToCart(itemId)
{
    console.log("js - addToCart()");  // отрабатывает функция console.log со значением, для отладки, вызов функции addToCart()
     $.ajax({                                        // функция из jquery для создания ajax запросов, параметры ниже.
            type: 'POST',                           // тип запроса (метод POST)
            async: false,                           //выкл. асинхронность
            url: "/cart/addtocart/" + itemId + '/', // куда обращаемся - cartController функция addtocart, передаем get пареметр
            dataType: 'json',                       // тип данных json
            success: function(data)                 //массив помещатся в переменную data
                {                                   // при успешном выполнении запроса отрабатывает данная функция
                    if (data['success'])            // если data succes истинна то выполняем дальше код
                    {
                        $('#cartCntItems').html(data['cntItems']);  // меняет кол.елементов в корзине с помощтю метода html, все что было в #cartCntItems на cntItems.

                        // подменяет ссылку 'добавить в корзину' на 'удалить из корзины'
                        $('#addCart_' + itemId).hide();             // прячем ссылку 'добавить в корзину'
                        $('#removeCart_' + itemId).show();          // обращаемся к removeCart и говорим показать ссылку "удалить из корзины"
                    }
                }
          });

   }
