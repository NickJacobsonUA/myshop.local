<?php
/* Smarty version 3.1.32, created on 2018-09-07 19:19:17
  from 'C:\Users\Nick\Desktop\OSPanel\domains\myshop.local\views\default\category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b92a50588e7e7_05199312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cfbdb3f94410d7d78f14f9f9dbfbcd9dee04e98c' => 
    array (
      0 => 'C:\\Users\\Nick\\Desktop\\OSPanel\\domains\\myshop.local\\views\\default\\category.tpl',
      1 => 1536337147,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b92a50588e7e7_05199312 (Smarty_Internal_Template $_smarty_tpl) {
?>               <h1>Товары Категории <?php echo $_smarty_tpl->tpl_vars['rsCategory']->value['name'];?>
</h1>

         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item');
$_smarty_tpl->tpl_vars['item']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_0_saved = $_smarty_tpl->tpl_vars['item'];
?>              <div style="float: left; padding: 0px 30px 40px 0px;">
                 <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                     <img src="images/products/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" width="100" />                  </a>
                 <br/>
                 <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                     <?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
                  </a>
             </div>
             <?php if ($_smarty_tpl->tpl_vars['item']->iteration % 3 == 0) {?>                  <div style="clear: both"></div>              <?php }?>

         <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsChildCats']->value, 'item');
$_smarty_tpl->tpl_vars['item']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_1_saved = $_smarty_tpl->tpl_vars['item'];
?>
             <h2><a href="/category/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></h2>
         <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
