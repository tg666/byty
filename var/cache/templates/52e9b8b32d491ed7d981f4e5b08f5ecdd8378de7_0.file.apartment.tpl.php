<?php
/* Smarty version 4.2.1, created on 2022-10-08 20:47:19
  from 'D:\programy\XAMPP\htdocs\byty\src\View\templates\apartment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6341e1d7eecbf6_64558918',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52e9b8b32d491ed7d981f4e5b08f5ecdd8378de7' => 
    array (
      0 => 'D:\\programy\\XAMPP\\htdocs\\byty\\src\\View\\templates\\apartment.tpl',
      1 => 1665262037,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6341e1d7eecbf6_64558918 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('i', 0);?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['apartments']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
    <?php if (strstr($_smarty_tpl->tpl_vars['item']->value['url'],"bezrealitky")) {?>
         <?php $_smarty_tpl->_assignInScope('source', "bezrealitky");?>
    <?php }?>
    <?php if (strstr($_smarty_tpl->tpl_vars['item']->value['url'],"reality.idnes")) {?>
        <?php $_smarty_tpl->_assignInScope('source', "idnes");?>
    <?php }?>
    <?php if (strstr($_smarty_tpl->tpl_vars['item']->value['url'],"realitymix")) {?>
        <?php $_smarty_tpl->_assignInScope('source', "realityMix");?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['item']->value['part'] == null && $_smarty_tpl->tpl_vars['source']->value == "realityMix") {?>
        <?php $_smarty_tpl->_assignInScope('valid', false);?>
    <?php } else { ?>
        <?php $_smarty_tpl->_assignInScope('valid', true);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['item']->value['zvirata'] == "1") {?>
        <?php $_smarty_tpl->_assignInScope('zvirata', "Ano");?>
    <?php } else { ?>
        <?php $_smarty_tpl->_assignInScope('zvirata', "Ne");?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['item']->value['vytah'] == "1") {?>
        <?php $_smarty_tpl->_assignInScope('vytah', "Ano");?>
    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['vytah'] == "0") {?>
        <?php $_smarty_tpl->_assignInScope('vytah', "Ne");?>
    <?php } else { ?>
        <?php $_smarty_tpl->_assignInScope('vytah', "Neuvedeno");?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['item']->value['balkon'] == "1") {?>
        <?php $_smarty_tpl->_assignInScope('balkon', "Ano");?>
    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['balkon'] == "0") {?>
        <?php $_smarty_tpl->_assignInScope('balkon', "Ne");?>
    <?php } else { ?>
        <?php $_smarty_tpl->_assignInScope('balkon', "Neuvedeno");?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['item']->value['patro'] == null) {?>
        <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['patro'] = "Neuvedeno";
$_smarty_tpl->_assignInScope('item', $_tmp_array);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['valid']->value) {?>
    <div class="container-sm themed-container text-center">
        <h5><b><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</b></h5>
        <h6><?php echo $_smarty_tpl->tpl_vars['item']->value['part'];?>
</h6>
        <h6><?php echo $_smarty_tpl->tpl_vars['item']->value['pricetotal'];?>
 Kč/měsíc </h6>
        <h6><?php echo $_smarty_tpl->tpl_vars['item']->value['dispozice'];?>
</h6>
        <h6><?php echo $_smarty_tpl->tpl_vars['item']->value['vymera'];?>
 m2</h6>
        <?php if ($_smarty_tpl->tpl_vars['source']->value == "idnes") {?>
            <h6> Cena je BEZ poplatků, jen nájem</h6>
        <?php }?>
        <h6 id="distance<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">Vzdálenost od centra:  </h6>
        <h6 id="metro<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">Nejbližší metro:  </h6>
        <h6><b>Zdroj: </b><?php echo $_smarty_tpl->tpl_vars['source']->value;?>
</h6>
        <p>

            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" aria-expanded="false" aria-controls="collapseExample">
                Info
            </button>
        </p>
        <div class="collapse" id="collapse<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
            <div class="card card-body">
                <h6 class="addres"><?php echo $_smarty_tpl->tpl_vars['item']->value['longpart'];?>
</h6>
                    <h6><b>Výměra: </b> <?php echo $_smarty_tpl->tpl_vars['item']->value['vymera'];?>
 m2</h6>
             <h6><b>Dispozice: </b> <?php echo $_smarty_tpl->tpl_vars['item']->value['dispozice'];?>
</h6>
              <h6><b>Patro: </b> <?php echo $_smarty_tpl->tpl_vars['item']->value['patro'];?>
.</h6>
                <h6><b>Výtah: </b> <?php echo $_smarty_tpl->tpl_vars['vytah']->value;?>
</h6>
                  <h6> <b>Stav:</b> <?php echo $_smarty_tpl->tpl_vars['item']->value['stav'];?>
</h6>
                <h6><b>Domácí zvířata: </b><?php echo $_smarty_tpl->tpl_vars['zvirata']->value;?>
</h6>
                <h6><b>Balkon: </b><?php echo $_smarty_tpl->tpl_vars['balkon']->value;?>
</h6>
                <h5><b>Cena: </b><?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
 + <?php echo $_smarty_tpl->tpl_vars['item']->value['pricetotal']-$_smarty_tpl->tpl_vars['item']->value['price'];?>
 Kč  </h5>
                <?php if ($_smarty_tpl->tpl_vars['source']->value == "idnes" || $_smarty_tpl->tpl_vars['source']->value == "realityMix") {?>
                    <h5> Cena je BEZ poplatků, jen nájem</h5>
                <?php }?>
                <a class="url" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
">Podrobnosti</a>

            </div>
        </div>

    </div>
    <?php echo $_smarty_tpl->tpl_vars['i']->value++;?>

    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
