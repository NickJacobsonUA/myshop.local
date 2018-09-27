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


/**
 * Функция удаление товара из Корзины
 *
 * @param integer itemId ID продукта
 * @return в случае успеха обновятся данные корзины на странице
 */
function removeFromCart(itemId)
{
    console.log("js - removeFromCart("+itemId+")");
    $.ajax({
            type: 'POST',                           // тип запроса (метод POST)
            async: false,                           //выкл. асинхронность
            url: "/cart/removefromcart/" + itemId + '/', // куда обращаемся - cartController функция addtocart, передаем get пареметр
            dataType: 'json',                       // тип данных json
            success: function(data)                 //массив помещатся в переменную data
            {                                   // при успешном выполнении запроса отрабатывает данная функция
                if (data['success'])            // если data succes истинна то выполняем дальше код
                {                               // поменяет значение корзины в счетчике
                    $('#cartCntItems').html(data['cntItems']);  // меняет кол.елементов в корзине с помощтю метода html, все что было в #cartCntItems на cntItems.

                    // подменяет ссылку 'добавить в корзину' на 'удалить из корзины'
                    $('#addCart_' + itemId).show();             // обращаемся к removeCart и говорим показать ссылку "удалить из корзины"
                    $('#removeCart_' + itemId).hide();          // прячем ссылку 'добавить в корзину'
                }
            }

            })
}
/**
 * Подсчет стоимости купленного товара при изменении количества товара в корзине
 *
 * @param integer $itemId ID продукта
 *
 */
function conversionPrice(itemId)
{
    var newCnt = $('#itemCnt_' + itemId).val(); // создание новой переменной и с помощью js обращаемся к элементу с id itemCnt и значение value
    var itemPrice = $('#itemPrice_' + itemId).attr('value'); // цена текущего товара, ищем значение атрибут itemPrice + id объекта
    var itemRealPrice = newCnt * itemPrice; // просчитываем стоимость

    $('#itemRealPrice_' + itemId).html(itemRealPrice); // в тег itemRealPrice заменить на текущее значение itemRealPrice
}

/**
 * Получение данных с формы
 *
 * @param obj_form
 * @returns {{}}
 */
function getData(obj_form)
{
    var hData = {}; // создаем переменную и присваиваем пустой массив
    $('input, textarea, select', obj_form).each(function () // из модуля jquery мы проходим по всем инпутам и селектам и собираем их значения
    {
        if(this.name && this.name!='')
        {
            hData[this.name] = this.value;
            console.log('hData['+ this.name +'] = ' + hData[this.name]); // выводим в консоль каждый элемент для наглядности
        }
    })
    return hData; // все что нашли мы возвращаем
}
/**
 * Регистрация нового пользователя
 *
 */
function registerNewUser()// для отправки данных нужно данные собрать с инпутов leftcolumn.tpl
{                                               // функция собирает в json массив все нужные знаения с id registerBox
  var postData = getData('#registerBox');   // создаем переменную postData массив в который передается посредством post запроса, и выдаст их getData
// данные помещаются в массив postData
    $.ajax({
        type: 'POST',                           // тип запроса (метод POST)
        async: false,                           //выкл. асинхронность
        url: "/user/register/",
        data: postData,
        dataType: 'json',                       // тип данных json
        success: function(data)             // происходит событие если успешно данные передали и функция нами что то вернула
        {
                if (data['success'])
                {
                    alert('Регистрация прошла успешно');

                    //> блок в левом столбце
                    $('#registerBox').hide();// прячем registerBox

                    $('#userLink').attr('href','/user/'); // меняем атрибут href будет /user/
                    $('#userLink').html(data['userName']); // что бы ни было в ссылке, оно удалится и добавится data['userName']
                    $('#userBox').show();
                    //<
                }
                else
                {
                    alert(data['message']);
                }
        }
    })
}

function login()
{
    var email = $('#loginEmail').val();
    var pwd   = $('#loginPwd').val();

    var postData = "email="+ email +"&pwd=" + pwd;

    $.ajax({
        type: 'POST',                           // тип запроса (метод POST)
        async: false,                           //выкл. асинхронность
        url: "/user/login/",
        data: postData,
        dataType: 'json',                       // тип данных json
        success: function(data)
        {
            if(data['success'])
            {
                $('#registerBox').hide();
                $('#loginBox').hide();

                $('#userLink').attr('href','/user/'); // меняем атрибут href будет /user/
                $('#userLink').html(data['displayName']); // что бы ни было в ссылке, оно удалится и добавится data['userName']
                $('#userBox').show();

            }
            else
            {
                alert(data['message']);
            }
        }
    })
}
