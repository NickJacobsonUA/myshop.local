<?php
/* Smarty version 3.1.32, created on 2018-09-14 12:24:31
  from 'C:\Users\Nick\Desktop\OSPanel\domains\myshop.local\views\default\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9b7e4f7d7fc5_39171784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e687780bb1cfe59dae0b00c13771f9117a04934' => 
    array (
      0 => 'C:\\Users\\Nick\\Desktop\\OSPanel\\domains\\myshop.local\\views\\default\\header.tpl',
      1 => 1536917070,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:leftcolumn.tpl' => 1,
  ),
),false)) {
function content_5b9b7e4f7d7fc5_39171784 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title> <!-- переменная объявлена в IndexController, функция IndexAction-->

    <link rel="stylesheet" href="/templates/default/css/main.css" type="text/css" />




</head>
<body>
<div id="header">
    <h1>my shop - Интеренет магазин</h1>
</div>

<?php $_smarty_tpl->_subTemplateRender('file:leftcolumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div id="centerColumn">


<?php }
}
