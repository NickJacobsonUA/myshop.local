<?php
/* Smarty version 3.1.32, created on 2018-09-10 11:30:43
  from 'C:\Users\Nick\Desktop\OSPanel\domains\myshop.local\views\default\product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b962bb3a8fcc5_67941914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bee9f167dbd18002450c2ae3d4d71c9efcd80ccc' => 
    array (
      0 => 'C:\\Users\\Nick\\Desktop\\OSPanel\\domains\\myshop.local\\views\\default\\product.tpl',
      1 => 1536568240,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b962bb3a8fcc5_67941914 (Smarty_Internal_Template $_smarty_tpl) {
?>                               <h3><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['name'];?>
</h3> 
                  <img width="575" src="/images/products/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['image'];?>
">                   Стоимость: <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['price'];?>


                  <a href="#" alt="Добавить в корзину">Добавить в Корзину</a>                   <p>Описание <br /><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['description'];?>
</p> <?php }
}
