<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 14.09.2018
 * Time: 18:20
 *
 *                                          Модель для таблицы пользователей (Users)
 */

/**
 * Регистрация нового пользователя
 *
 * @param $email string почта
 * @param $pwdMD5 string пароль зашифрованный в MD5
 * @param $name string имя пользователя
 * @param $phone string телефон
 * @param $adress string адрес пользователя
 * @return array массив данных нового пользователя
 */
function registerNewUser($email, $pwdMD5, $name, $phone, $adress)
{
    global $sql, $db, $rs;
    $email = htmlspecialchars(mysqli_real_escape_string($db, $email)); // делаем безопасным ввод данных в input
    $name = htmlspecialchars(mysqli_real_escape_string($db, $name));
    $phone = htmlspecialchars(mysqli_real_escape_string($db, $phone));
    $adress = htmlspecialchars(mysqli_real_escape_string($db, $adress)); //получили чистые данные, и добавляем в таблицу


    $sql = "INSERT INTO
            users (`email`, `pwd`, `name`, `phone`, `adress`)
            VALUES('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$adress}')";

    $rs = $db->query($sql);

    //делаем проверку

    if ($rs){      // новый запрос из таблицы users, если добавление прошло успешно
            $sql = "SELECT *
            FROM users
            WHERE `email` = '{$email}' and `pwd` = '{$pwdMD5}'  LIMIT 1"; // выбираем пользоваиеля по почте и паролю.


            $rs = $db->query($sql); // выполняем запрос
            $rs = createSmartyRsArray($rs); // и результат запроса прогоняем через функцию createSmartyRsArray

            if (isset($rs[0]))
            {
                $rs['success'] = 1;// если существует массив с индексом 0, то возвращаем 1.
            }
            else
            {
                $rs['success'] = 0;
            }

            } else // если добавление прошло не успешно
            {
                $rs['success'] = 0; // инициализируем ключ и даем ему значение 0
            }
    return $rs; // возвращаем переменную rs которая либо 0 либо 1 + инфа по пользователю.
}

/**
 *                                       Проверка параметров для регистрации пользователя
 *
 * @param $email string
 * @param $pwd1 string пароль
 * @param $pwd2 string повтор пароля
 * @return null array
 */
function checkRegisterParams($email, $pwd1, $pwd2)
{
    $res = null; // инициализируем массив, можно присвоить пустой массив.

    if (! $email){  // если $email не пришло то присваиваем false
        $res['success'] = false; // присваем false
        $res['message'] = 'Введите email';
    }
    if (! $pwd1){
        $res['success'] = false; // если не пришёл пароль то ...
        $res['message'] = 'Введите пароль';
    }
    if (! $pwd2){
        $res['success'] = false; // если не пришёл то ...
        $res['message'] = 'Повторите пароль';
    }
    if ($pwd1 != $pwd2){
        $res['success'] = false;
        $res['message'] = 'Пароли не совпадают';
    }
    return $res; // если не успешно то в $res попадает ошибка или пустое значение.
}

/**
 *                                          Проверка почты (есть ли email адрес в БД)
 *
 * @param $email string
 * @return array|bool|mysqli_result array строка из таблицы users, либо пустой массив
 */
function checkUserEmail($email)
{
    global $sql, $db, $rs;
    $email = mysqli_real_escape_string($db, $email);

    $sql = "SELECT id
            FROM users
            WHERE `email` = '{$email}'";

    $rs = $db->query($sql);
    $rs = createSmartyRsArray($rs);

    return $rs; // возвращаем в UserController
}

/**
 *                         Авторизация пользователя
 *
 * @param $email string почта уьфшд
 * @param $pwd string пароль
 * @return array|bool|mysqli_result массив данных пользователя
 */
function loginUser($email, $pwd) //ищем в БД строку соответствующего логина и пароль
{
    global $sql, $db, $rs;
    $email = htmlspecialchars(mysqli_real_escape_string($db, $email)); // для избежания инъекции
    

    $sql = "SELECT * 
            FROM users
            WHERE `email` = '{$email}' and `pwd` = '{$pwd}'  LIMIT 1"; // только 1 уникальную запись

    $rs = $db->query($sql); // обращение к БД
    $rs = createSmartyRsArray($rs); // зоздаём массив и возвращием его

    if (isset($rs[0])) // если 0 элемент нашего массива содержит что то -  успех=1
    {
        $rs['success'] = 1;
    }
        else
        {
            $rs['success'] = 0;
        }
        return $rs;

}

