<?php
/* Smarty version 3.1.32, created on 2018-09-15 12:18:34
  from 'C:\Users\Nick\Desktop\OSPanel\domains\myshop.local\views\default\leftcolumn.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9cce6a2f8224_67698888',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41bc3945ba890c8c6bbaef062fb1b985669bc7e7' => 
    array (
      0 => 'C:\\Users\\Nick\\Desktop\\OSPanel\\domains\\myshop.local\\views\\default\\leftcolumn.tpl',
      1 => 1537003108,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9cce6a2f8224_67698888 (Smarty_Internal_Template $_smarty_tpl) {
?>
                              
<div id="leftColumn">


    <div id="leftMenu">
        <div class="menuCaption">Меню:</div>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
            <!--обрабытаевае массив $rsCategories, и каждый элемент этого массива попадает в $item-->
            <a href="/?controller=category&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a><br /> <!-- вывод переменной $item-->

            <?php if (isset($_smarty_tpl->tpl_vars['item']->value['children'])) {?>  <!--Проверка на существование элемент массива Children-->
                 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value['children'], 'itemChild');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->value) {
?>  <!--перебираем массив(1 - передаём сам массив-->
                     --<a href="/?controller=category&id=<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['id'];?>
/"> <?php echo $_smarty_tpl->tpl_vars['itemChild']->value['name'];?>
</a><br />
                 <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


    </div>

    <div id="registerBox">
        <div class="menuCaption showHidden" onclick="showRegisterBox();"> Регистрация </div>         <div id="registerBoxHidden">             email:<br />
            <input type="text" id="email" name="email" value=""/><br />
            пароль: <br />
            <input type="password" id="pwd1" name="pwd1" value=""/><br />
            повторить пароль:   <br />
            <input type="password" id="pwd2" name="pwd2" value=""/><br />
            <input type="button" onclick="registerNewUser();" value="Зарегистрироваться"/>
        </div>
    </div>

    <div class="menuCaption">Корзина</div>
    <a href="/cart/" title="Перейти в корзину">В корзине</a>     <span id="cartCntItems">         <?php if ($_smarty_tpl->tpl_vars['cartCntItems']->value > 0) {?>             <?php echo $_smarty_tpl->tpl_vars['cartCntItems']->value;?>

        <?php } else { ?> 0
        <?php }?>
    </span>

</div><?php }
}
