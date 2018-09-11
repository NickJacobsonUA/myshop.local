                  {*Страница продукта*}
             <h3>{$rsProduct.name}</h3> {*в rsProduct данные по товару*}

                  <img width="575" src="/images/products/{$rsProduct.image}"> {*Ририуем картинку*}
                  Стоимость: {$rsProduct.price}

                  <a id="addCart_{$rsProduct.id}" href="#" onClick="addToCart({$rsProduct.id}); return false;" alt="Добавить в корзину"> Добавить в Корзину </a> {*ссылка добавить в корзину*}
                  <p>Описание <br />{$rsProduct.description}</p> {*Выбираем из rsProduct описание *}