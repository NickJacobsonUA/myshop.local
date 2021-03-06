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

/**
 * Разлогинивание пользователя
 */
   function logoutAction() //удаление сессионой переменной, тогда сайт забудет о пользователе
    {
        if (isset($_SESSION['user']))
        {
            unset($_SESSION['user']); // удаление пользователя
            unset($_SESSION['cart']); // чистим корзину

        }
        redirect('/'); // редиректим в корень сайта
    }

/**
 * AJAX авторизация пользователя
 *
 * @return json  массив данных пользователя
 */
    function loginAction()
    {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null; // если есть email топерем его знаение.
        $email = trim($email); // если есть пробелы то удаляем пробелы

        $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
        $pwd = trim(md5($pwd)); // если есть пробелы то удаляем их

        $userData = loginUser($email, $pwd);
        
        if ($userData['success']) // проверяем ключ success и =1 то
        {
            $userData = $userData[0]; // переобозначаем userData

            $_SESSION['user'] = $userData; // инициац. сессиюонную переменную
            $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email']; // добавляем ключ displayName

            $resData = $_SESSION['user']; // записываем в $resData все данныее из сессионной переменной
            $resData['success'] = 1; // устанавливаем флаг успеха
        }
        else
        {
            $resData['success'] = 0;
            $resData['message'] = 'Неверный логин или пароль';
        }
        echo json_encode($resData);
    }

/**
 * Функция формирования шлавной страницы пользователя
 *
 * @link /user/
 * @param $smarty шаблонизатор
 */
    function indexAction($smarty)
    {
        if (! isset($_SESSION['user'])) // был ли залогинен пользователь, если нет то редирект на главную станицу
        {
            redirect('/');
        }

        $rsCategories = getAllMainCatsWithChildren(); // получаем список категорий

        $smarty->assign('pageTitle','Страница пользователя');
        $smarty->assign('rsCategories', $rsCategories);

        loadTemplate($smarty, 'header'); // загружаем шаблоны
        loadTemplate($smarty, 'user');
        loadTemplate($smarty, 'footer');

    }

/**
 * Обновление данных пользователя
 *
 * @return json результат выполнения функции
 */
function updateAction()
{ // Если пользователь не залогинен
    if (! isset($_SESSION['user'])) // был ли залогинен пользователь, если нет то редирект на главную станицу
    {
        redirect('/');
    }
    //Инициализация переменных для перечи их в модель

    $resData = array(); // массив который вернет данная функция
    $phone   = isset($_REQUEST['phone'])  ? $_REQUEST['phone']  : null; // если пришёл телефон то берем его значение, если нет то 0
    $adress  = isset($_REQUEST['adress']) ? $_REQUEST['adress'] : null;
    $name    = isset($_REQUEST['name'])   ? $_REQUEST['name']   : null;
    $pwd1    = isset($_REQUEST['pwd1'])   ? $_REQUEST['pwd1']   : null;
    $pwd2    = isset($_REQUEST['pwd2'])   ? $_REQUEST['pwd2']   : null;
    $curPwd  = isset($_REQUEST['curPwd']) ? $_REQUEST['curPwd'] : null;

    //Проверка совпадения паролей
    if ($pwd1 !== $pwd2)
    {
        $resData['message'] = 'Пароли не совпадают';
        echo json_encode($resData);
        return false;
    }
    //Проверка текущего введенного пароля и того под которым залогинились
    $curPwdMD5 = md5($curPwd); // шифируем пароль
    if (! $curPwd || ($_SESSION['user']['pwd'] != $curPwdMD5)) // если текущий пароль не равен сессионному паролю, или его нет
    {
        $resData['success'] = 0; // ошибка обновления
        $resData['message'] = 'Текущий пароль неверный'; // сообщение об ошибке

        echo json_encode($resData); //кодируем в json
        return false; // делаем выход из функции
    }
    $res = updateUserData($name, $phone, $adress, $pwd1, $pwd2, $curPwdMD5);



    if ($res)
    {
        $resData['success'] = 1; // наполняем массив данными
        $resData['message'] = 'Данные Сохранены';
        $resData['userName'] = $name; // записываем username и записываем новое или преженее значение

        // обновляем сессионные данные пользователя
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['adress'] = $adress;

            // При смене пароля в заведенной сессии
            $newPwd =  $_SESSION['user']['pwd']; // инициац. переменнную

            if ($pwd1 && ($pwd1 == $pwd2)) // введен ли пароль pwd1 И при этом пароли совпадаю то ...
            {
                $newPwd = trim($pwd1); // переменной pwd присваиваем не закодированный pwd1
            }

        $_SESSION['user']['pwd'] = $newPwd;

        $_SESSION['user']['displayName'] = $name ? $name : $_SESSION['user']['email'];
    }
    else // если пришёл false
    {
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка сохранения данных';
    }
    echo json_encode($resData); //кодируем массив в формат json и передаем в JS файл
}