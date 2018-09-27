<?php
/* Smarty version 3.1.32, created on 2018-09-26 22:42:04
  from 'C:\Users\Nick\Desktop\OSPanel\domains\myshop.local\views\default\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5babe10ca94e62_36766682',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3679233fa67fbbfc87badfcc98446a97372b839d' => 
    array (
      0 => 'C:\\Users\\Nick\\Desktop\\OSPanel\\domains\\myshop.local\\views\\default\\index.tpl',
      1 => 1537990894,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5babe10ca94e62_36766682 (Smarty_Internal_Template $_smarty_tpl) {
?>           
           <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item');
$_smarty_tpl->tpl_vars['item']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->iteration++;
$__foreach_item_0_saved = $_smarty_tpl->tpl_vars['item'];
?>                <div style="float: left; padding: 0px 30px 40px 0px;">
                   <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/">
                       <img src="images/products/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" width="100" />                    </a>
                   <br/>
                   <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/">
                       <?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
                    </a>
               </div>
               <?php if ($_smarty_tpl->tpl_vars['item']->iteration % 3 == 0) {?>                    <div style="clear: both"></div>                <?php }?>

           <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


<?php }
}
