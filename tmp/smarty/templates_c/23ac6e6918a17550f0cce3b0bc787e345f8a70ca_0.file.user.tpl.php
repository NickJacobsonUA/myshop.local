<?php
/* Smarty version 3.1.32, created on 2018-09-29 15:09:48
  from 'C:\Users\Nick\Desktop\OSPanel\domains\myshop.local\views\default\user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5baf6b8caea085_10569829',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23ac6e6918a17550f0cce3b0bc787e345f8a70ca' => 
    array (
      0 => 'C:\\Users\\Nick\\Desktop\\OSPanel\\domains\\myshop.local\\views\\default\\user.tpl',
      1 => 1538170085,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5baf6b8caea085_10569829 (Smarty_Internal_Template $_smarty_tpl) {
?>
    


    <h1>Ваши регистрациаонные данные</h1>
    <table border="0">
        <tr>
            <td>Логин(email)</td>
            <td><?php echo $_smarty_tpl->tpl_vars['arUser']->value['email'];?>
</td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><input type="text" id="newName" value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['name'];?>
"/></td>
        </tr>
        <tr>
            <td>Тел</td>
            <td><input type="text" id="newPhone" value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['phone'];?>
"/></td>
        </tr>
        <tr>
            <td>Адрес</td>
            <td><textarea id="newAdress" ><?php echo $_smarty_tpl->tpl_vars['arUser']->value['adress'];?>
</textarea></td>
        </tr>
        <tr>
            <td>Новый Пароль</td>
            <td><input type="password" id="newPwd1" value=""/></td>
        </tr>
        <tr>
            <td>Повтор пароля</td>
            <td><input type="password" id="newPwd2" value=""/></td>
        </tr>
        <tr>
            <td>Для сохранения данных введите текущий пароль</td>
            <td><input type="password" id="curPwd" value=""/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="button" value="Сохранить изменения" onclick="updateUserData();" </td>
        </tr>
    </table>



<?php }
}
