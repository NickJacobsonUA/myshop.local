
                              {* Левый столбец *}

<div id="leftColumn">


    <div id="leftMenu">
        <div class="menuCaption">Меню:</div>

        {foreach from=$rsCategories item=$item}
            <!--обрабытаевае массив $rsCategories, и каждый элемент этого массива попадает в $item-->
            <a href="/?controller=category&id={$item.id}/">{$item.name}</a><br /> <!-- вывод переменной $item-->

            {if isset($item.children)}  <!--Проверка на существование элемент массива Children-->
                 {foreach from=$item.children item=$itemChild}  <!--перебираем массив(1 - передаём сам массив-->
                     --<a href="/?controller=category&id={$itemChild.id}/"> {$itemChild.name}</a><br />
                 {/foreach}
            {/if}

        {/foreach}
    </div>

    {if isset($arUser)} {*Если авторизированный пользователь *}
        <div id="userBox">
            <a href="/user/" id="userLink"> {$arUser['displayName']}</a><br />
            <a href="/user/logout/" onclick="logout();">Выход</a>
        </div>

    {else} {*Если не авторизированный пользователь *}

        <div id="userBox" class="hideme">
            <a href="#" id="userLink"></a><br />  {*Имя пользователя*}
            <a href="/user/logout/" onclick="logout();">Выход</a>
        </div>

        <div id="loginBox">
            <div class="menuCaption">Авторизация</div>
            <input type="text" id="loginEmail" name="loginEmail" value=""><br/>
            <input type="password" id="loginPwd" name="loginPwd" value=""><br/>
            <input type="button" onclick="login();" value="Ввойти"/>
        </div>

        <div id="registerBox">
            <div class="menuCaption showHidden" onclick="showRegisterBox();"> Регистрация </div> {*Зоголовок*}
            <div id="registerBoxHidden"> {*скрытый блок для ввода данных*}

                email:<br />
                <input type="text" id="email" name="email" value=""/><br />

                пароль: <br />
                <input type="password" id="pwd1" name="pwd1" value=""/><br />

                повторить пароль:   <br />
                <input type="password" id="pwd2" name="pwd2" value=""/><br />

                <input type="button" onclick="registerNewUser();" value="Зарегистрироваться"/>
            </div>
        </div>

    {/if}




    <div class="menuCaption">Корзина</div>
    <a href="/cart/" title="Перейти в корзину">В корзине</a> {*обращаемся к контроллеру cart*}
    <span id="cartCntItems"> {*хранится кол.элементов в корзине*}
        {if $cartCntItems > 0} {*проверяем, если >0 то выводим её*}
            {$cartCntItems}
        {else} 0
        {/if}
    </span>

</div>