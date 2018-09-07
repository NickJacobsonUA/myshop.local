         {*Страница категории*}
      <h1>Товары Категории {$rsCategory['name']}</h1>

         {foreach from=$rsProducts item=$item } {*передаем массив $rsProducts, в цикле выбираем из него по 1 записи, которая поадает в переменную Item*}
             <div style="float: left; padding: 0px 30px 40px 0px;">
                 <a href="/product/{$item.id}">
                     <img src="images/products/{$item.image}" width="100" /> {*выводим картинку*}
                 </a>
                 <br/>
                 <a href="/product/{$item.id}">
                     {$item.name} {*название продукции*}
                 </a>
             </div>
             {if $item@iteration mod 3==0} {* Cчитаются итерации вывода товаров, если остаток от деления итераций на 3 = 0, то мы чистим флоат*}
                 <div style="clear: both"></div> {* 4я итерация выводится уже на следующей строке страницы*}
             {/if}

         {/foreach}

         {foreach from=$rsChildCats item=$item}
             <h2><a href="/category/{$item.id}">{$item.name}</a></h2>
         {/foreach}