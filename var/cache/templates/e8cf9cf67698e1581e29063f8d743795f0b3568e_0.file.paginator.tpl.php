<?php
/* Smarty version 4.2.1, created on 2022-10-06 19:32:33
  from 'D:\programy\XAMPP\htdocs\byty\src\View\templates\paginator.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_633f2d51952bb7_62683960',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8cf9cf67698e1581e29063f8d743795f0b3568e' => 
    array (
      0 => 'D:\\programy\\XAMPP\\htdocs\\byty\\src\\View\\templates\\paginator.tpl',
      1 => 1665010037,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633f2d51952bb7_62683960 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('nextpage', $_smarty_tpl->tpl_vars['page']->value+1);
$_smarty_tpl->_assignInScope('previouspage', $_smarty_tpl->tpl_vars['page']->value-1);
echo count($_smarty_tpl->tpl_vars['apartments']->value);?>

<?php echo $_smarty_tpl->tpl_vars['page']->value;?>

<nav aria-label="Page navigation example">
    <div class="d-grid gap-2">
        <?php if (count($_smarty_tpl->tpl_vars['apartments']->value) > 9) {?>
            <a class="btn btn-primary btn-lg" href=?<?php echo $_smarty_tpl->tpl_vars['http']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['nextpage']->value;?>
>Další</a>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['page']->value > 1) {?>
        <a class="btn btn-primary btn-lg" href=?<?php echo $_smarty_tpl->tpl_vars['http']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['previouspage']->value;?>
>Předchozí</a>
        <?php }?>
    </div>
</nav>
<?php }
}
