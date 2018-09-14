                  {*Страница продукта*}
             <h3>{$rsProduct.name}</h3> {*в rsProduct данные по товару*}

                  <img width="575" src="/images/products/{$rsProduct.image}"> {*Ририуем картинку*}
                  Стоимость: {$rsProduct.price}

                                   {*ссылка удалить из корзины*}
                  <a id="removeCart_{$rsProduct.id}"
                          {if ! $itemInCart} {*если элемента в козрзине нет то работает класс hideme*}
                               class="hideme" {* ссылка добавления элементов в корзину*}
                          {/if}
                     href="#" onClick="removeFromCart({$rsProduct.id}); return false;"
                     alt="Удалить из корзины">
                       Удалить из корзины
                  </a>

                                   {*ссылка добавить в корзину*}
                  <a id="addCart_{$rsProduct.id}"
                          {if $itemInCart}   {*если элемент в козрзине есть то работает класс hideme*}
                               class="hideme" {* ссылка добавления элементов в корзину*}
                          {/if}
                     href="#"
                     onClick="addToCart({$rsProduct.id}); return false;"
                     alt="Добавить в корзину">
                       Добавить в Корзину
                  </a>

                  <p>Описание <br />{$rsProduct.description}</p> {*Выбираем из rsProduct описание *}