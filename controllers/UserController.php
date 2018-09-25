<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 14.09.2018
 * Time: 18:19
 * 
 *                                    Контроллер функций пользователя
 */

    include_once '../models/CategoriesModel.php';
    include_once '../models/UsersModel.php';

/**
 * AJAX регистрация пользователей
 * Инициализация сессионной переменной ($_SESSION['user]) - в ней данные пользователя для оперирования ими на любой страницы
 * 
 * @return json массив данных нового пользователя
 */
    function registerAction() // перехватыеваем все методы о пользователе , проверяем данные,
    {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null; // смотрим пришла ли переменная, если пришла то берем значение, если не пришла то 0.
        $email = trim($email);

        $pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
        $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;

        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
        $adress = isset($_REQUEST['adress']) ? $_REQUEST['adress'] : null;
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
        $name = trim($name);
        
        // проверка значение базовых полей email & password
        $resData = null; // в неё складываем данные об ошибках или об успехе
        $resData = checkRegisterParams($email, $pwd1, $pwd2); // проверка мыла пароля и второго пароля


        //проверка на существование $email
        if (! $resData && checkUserEmail($email)) // если ошибка пришла то дальше не попадаем
        {
            $resData['success'] = false; // если попадаем то проверяем на пользователя
            $resData['message'] = "Пользователь c email {$email} уже зарегистрирован";
        }
        // если нет ошибок
        if (! $resData)
        {
            $pwdMD5 = md5($pwd1); // перекодирует строку пароля в вид md5

            $userData = registerNewUser($email, $pwdMD5, $name, $phone, $adress); // заводит функция новую запись и передает ее в userdata
            // проверка

            if ($userData['success']) // если удачно
            {
                $resData['message'] = 'Пользоваетль успешно зарегистрирован'; // инициализируем переменную $resData
                $resData['success'] = 1;

                $userData = $userData[0]; // массив упрощаем получая не 0-элемент, а обращаемся сразу к имени и email
                $resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email']; // заполняем результирующие данные, заводим ключ userName, если в массив есть имя то добавляем имя, в противном случае email
                $resData['userEmail'] = $email;

                $_SESSION['user'] = $userData; // создаем сессионную переменную и присваиваем данные о пользователе, для манипуляции данными без перезагрузки страницы
                $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email']; // подключаем displayName и подключаем
            }
            else // если пользователь не создался
            {
                $resData['success'] = 0;
                $resData['message'] = 'Ошибка регистрации';
            }
        }
        echo json_encode($resData); //возвращаем данные в js
    }


