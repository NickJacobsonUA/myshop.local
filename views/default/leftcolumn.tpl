{* Левый столбец *}

<div id="leftColumn">


    <div id="leftMenu">
        <div class="menuCaption">Меню:</div>

        {foreach from=$rsCategories item=item}
            <!--обрабытаевае массив $rsCategories, и каждый элемент этого массива попадает в $item-->
            <a href="/?controller=category&id={$item.id}">{$item.name}</a><br /> <!-- вывод переменной $item-->

            {if isset($item.children)}  <!--Проверка на существование элемент массива Children-->
                 {foreach from=$item.children item=$itemChild}  <!--перебираем массив(1 - передаём сам массив-->
                     --<a href="/?controller=category&id={$itemChild.id}"> {$itemChild.name}</a><br />
                 {/foreach}
            {/if}

        {/foreach}


    </div>

</div>