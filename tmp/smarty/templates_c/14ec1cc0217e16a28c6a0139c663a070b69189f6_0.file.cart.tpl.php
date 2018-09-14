<?php
/* Smarty version 3.1.32, created on 2018-09-14 17:22:49
  from 'C:\Users\Nick\Desktop\OSPanel\domains\myshop.local\views\default\cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9bc439e5d2b9_39932017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14ec1cc0217e16a28c6a0139c663a070b69189f6' => 
    array (
      0 => 'C:\\Users\\Nick\\Desktop\\OSPanel\\domains\\myshop.local\\views\\default\\cart.tpl',
      1 => 1536934894,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9bc439e5d2b9_39932017 (Smarty_Internal_Template $_smarty_tpl) {
?>
<h1>Корзина</h1>

<?php if (!$_smarty_tpl->tpl_vars['rsProducts']->value) {?>
    В корзине пусто
    <?php } else { ?>
        <h2>Данные заказа</h2>
    <table>
        <tr>
            <td>
                №
            </td>
            <td>
                Наименование
            </td>
            <td>
                Колличество
            </td>
            <td>
                Цена за единицу
            </td>
            <td>
                Цена
            </td>
            <td>
                Действие
            </td>
        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']++;
?>
                    <tr>
                        <td>
                            <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] : null);?>

                        </td>
                        <td>
                            <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a><br>
                        </td>
                        <td>
                            <input type="text"
                                   name="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"
                                   id="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"
                                   value="1"
                                   onchange="conversionPrice(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
);"
                            />
                        </td>
                        <td>
                            <span id="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                            </span>
                        </td>
                        <td>
                            <span id="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                            </span>
                        </td>
                        <td>
                            <a id="removeCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"
                               href="#" onClick="removeFromCart(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
); return false;"
                               alt="Удалить из корзины">
                                Удалить
                            </a>
                            <a id="addCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"
                               class="hideme"
                               href="#"
                               onClick="addToCart(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
); return false;"
                               alt="Добавить в корзину">
                                Восстановить
                            </a>

                        </td>
                    </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
    <?php }
}
}
