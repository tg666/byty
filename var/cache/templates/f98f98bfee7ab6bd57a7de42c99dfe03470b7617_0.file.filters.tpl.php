<?php
/* Smarty version 4.2.1, created on 2022-10-10 15:36:29
  from 'D:\programy\XAMPP\htdocs\byty\src\View\templates\filters.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63443bfdcf6336_14766907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f98f98bfee7ab6bd57a7de42c99dfe03470b7617' => 
    array (
      0 => 'D:\\programy\\XAMPP\\htdocs\\byty\\src\\View\\templates\\filters.tpl',
      1 => 1665416188,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63443bfdcf6336_14766907 (Smarty_Internal_Template $_smarty_tpl) {
if (array_key_exists('pricemin',$_smarty_tpl->tpl_vars['filters']->value)) {?>
    <?php $_smarty_tpl->_assignInScope('minprice', $_smarty_tpl->tpl_vars['filters']->value['pricemin']);
} else { ?>
    <?php $_smarty_tpl->_assignInScope('minprice', 8000);
}
if (array_key_exists('pricemax',$_smarty_tpl->tpl_vars['filters']->value)) {?>
    <?php $_smarty_tpl->_assignInScope('maxprice', $_smarty_tpl->tpl_vars['filters']->value['pricemax']);
} else { ?>
    <?php $_smarty_tpl->_assignInScope('maxprice', 55000);
}?>
<!doctype html>
<H2 class="text-center">Celkem v databázi: <?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</H2>
<div class="d-flex fixed-filters align-items-stretch flex-shrink-0 bg-white" style="width: 40%;">

    <div class="list-group list-group-flush scrollarea">
        <button class="list-group-item list-group-item-action active py-3 lh-sm" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-current="true">
            <div class="d-flex w-60  align-items-center justify-content-between">
                <strong class="mb-1">Filtry</strong>
            </div>
        </button>
        <form type="GET">
            <div class="collapse" id="collapseFilters">
                <label for="cars">Řadit podle</label>
                <select name="order" id="order">
                    <option value="cheap" <?php if ($_smarty_tpl->tpl_vars['order']->value == "cheap") {?>selected="selected"<?php }?>>Nejlevnější</option>
                    <option value="expensive"<?php if ($_smarty_tpl->tpl_vars['order']->value == "expensive") {?>selected="selected"<?php }?>>Nejdražší</option>
                    <option value="part" <?php if ($_smarty_tpl->tpl_vars['order']->value == "part") {?>selected<?php }?>>Mětské části</option>
                    <option value="areamin" <?php if ($_smarty_tpl->tpl_vars['order']->value == "areamin") {?>selected <?php }?>>Od nejmenšího</option>
                    <option value="areamax" <?php if ($_smarty_tpl->tpl_vars['order']->value == "areamax") {?>selected <?php }?>>Od největšího</option>
                </select>
                <div class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-450 align-items-center justify-content-between">
                        <strong class="mb-1">Část Prahy</strong>
                    </div>
                    <div class="d-flex  p-2 flex-wrap mb-3">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parts']->value, 'f');
$_smarty_tpl->tpl_vars['f']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['f']->value['part'] != NULL) {?>
                            <div class="half">
                                <input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['part'];?>
" value="<?php echo rawurlencode($_smarty_tpl->tpl_vars['f']->value['part']);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['filters']->value['part'])) && in_array($_smarty_tpl->tpl_vars['f']->value['part'],$_smarty_tpl->tpl_vars['filters']->value['part'])) {?>checked<?php }?> name="part[]">
                                <label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['part'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['part'];?>
 (<?php echo $_smarty_tpl->tpl_vars['f']->value['count'];?>
)</label>
                            </div>
                            <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
                <div class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Plocha</strong>
                    </div>
                    <div class="col-10 mb-1 small"> Od <input type="number" min="10" id="areamin" value="10" step="1" name="areamin" size=""> do <input type="number" value="60" min="0" size="5" id="areamax" step="1" name="areamax"> m2</div>
                </div>

                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Cena</strong>
                    </div>
                    <div class="col-10 mb-1 small"> Od <input type="number" value="<?php echo $_smarty_tpl->tpl_vars['minprice']->value;?>
" min="8000" id="pricemin" step="500" name="pricemin" size="5">
                        do <input type="number" min="8000" size="5" id="pricemax" value="<?php echo $_smarty_tpl->tpl_vars['maxprice']->value;?>
" step="500" name="pricemax"> Kč</div>

                </a>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Stav</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['conditions']->value, 'f');
$_smarty_tpl->tpl_vars['f']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['f']->value['stav'] == NULL) {?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['stav'] = "Neuvedeno";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php }?>
                            <div class="half">
                                <input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['stav'];?>
" <?php if ($_smarty_tpl->tpl_vars['f']->value['stav'] == "Neuvedeno") {?> value="NULL" <?php } else { ?> value="<?php echo rawurlencode($_smarty_tpl->tpl_vars['f']->value['stav']);?>
" <?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['filters']->value['condition'])) && in_array($_smarty_tpl->tpl_vars['f']->value['stav'],$_smarty_tpl->tpl_vars['filters']->value['condition'])) {?>checked<?php }?> name="condition[]"">
                                <label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['stav'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['stav'];?>
 (<?php echo $_smarty_tpl->tpl_vars['f']->value['count'];?>
)</label>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Dispozice</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sizes']->value, 'f');
$_smarty_tpl->tpl_vars['f']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['f']->value['dispozice'] == NULL) {?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['dispozice'] = "Neuvedeno";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php }?>
                            <div class="half">
                                <input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['dispozice'];?>
" value="<?php echo rawurlencode($_smarty_tpl->tpl_vars['f']->value['dispozice']);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['filters']->value['size'])) && in_array($_smarty_tpl->tpl_vars['f']->value['dispozice'],$_smarty_tpl->tpl_vars['filters']->value['size'])) {?>checked<?php }?> name="size[]"">
                                <label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['dispozice'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['dispozice'];?>
 (<?php echo $_smarty_tpl->tpl_vars['f']->value['count'];?>
)</label>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patro</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stairs']->value, 'f');
$_smarty_tpl->tpl_vars['f']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['f']->value['patro'] == NULL) {?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['patro'] = "Neuvedeno";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php }?>
                            <div class="half">
                                <input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['patro'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['f']->value['patro'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['filters']->value['stairs'])) && in_array($_smarty_tpl->tpl_vars['f']->value['patro'],$_smarty_tpl->tpl_vars['filters']->value['stairs'])) {?>checked<?php }?> name="stairs[]">
                                <label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['patro'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['patro'];?>
 (<?php echo $_smarty_tpl->tpl_vars['f']->value['count'];?>
)</label>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Výtah</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['elevator']->value, 'f');
$_smarty_tpl->tpl_vars['f']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['f']->value['vytah'] == 1) {?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['vytah'] = "Ano";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php } elseif ($_smarty_tpl->tpl_vars['f']->value['vytah'] == "0") {?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['vytah'] = "Ne";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php } else { ?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['vytah'] = "Neuvedeno";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php }?>
                            <div class="half">
                                <input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['vytah'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['f']->value['vytah'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['filters']->value['elevator'])) && in_array($_smarty_tpl->tpl_vars['f']->value['vytah'],$_smarty_tpl->tpl_vars['filters']->value['elevator'])) {?>checked<?php }?> name="elevator[]">
                                <label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['vytah'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['vytah'];?>
 (<?php echo $_smarty_tpl->tpl_vars['f']->value['count'];?>
)</label>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Balkon</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['balcony']->value, 'f');
$_smarty_tpl->tpl_vars['f']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['f']->value['balkon'] == 1) {?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['balkon'] = "Ano";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php } elseif ($_smarty_tpl->tpl_vars['f']->value['balkon'] == "0") {?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['balkon'] = "Ne";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php } else { ?>
                                <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['f']) ? $_smarty_tpl->tpl_vars['f']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['balkon'] = "Neuvedeno";
$_smarty_tpl->_assignInScope('f', $_tmp_array);?>
                            <?php }?>
                            <div class="half">
                                <input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['balkon'];?>
" value="<?php echo rawurlencode($_smarty_tpl->tpl_vars['f']->value['balkon']);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['filters']->value['balcony'])) && in_array($_smarty_tpl->tpl_vars['f']->value['balkon'],$_smarty_tpl->tpl_vars['filters']->value['balcony'])) {?>checked<?php }?> name="balcony[]">
                                <label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['balkon'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['balkon'];?>
 (<?php echo $_smarty_tpl->tpl_vars['f']->value['count'];?>
)</label>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
                <input class="btn btn-secondary" type="submit" value="Potvrdit">
            </div>
        </form>
    </div>
</div>

<?php }
}
