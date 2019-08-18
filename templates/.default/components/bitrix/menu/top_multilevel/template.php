<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>
<div class="menu" id="menu_top">
	<div class="menu-box">
		<ul class="menu-box__ul">
			<div class="menu-mobi">
				<div class="menu-mobi__image">
					<img class="" src="<?= SITE_TEMPLATE_PATH ?>/images/menu.png" alt=""/>
				</div>
				<div class="menu-mobi__text">
					<?=getMessage("MENU")?>
				</div>
			</div>
<?
	$previousLevel = 0;
	$hasPayment = CModule::IncludeModule("citrus.tszhpayment") && ($paymentPath = CTszhPaySystem::getPaymentPath());

	foreach ($arResult as $key=>$arItem)
	{
	    if($key === 'breadcrumbs')
	        continue;
		if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel)
			echo str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		
		echo "\t<li".$arItem["LI_ATTRS"].">".($arItem["LINK"]!='/#/' && $arItem["LINK"]==""?'<span class="menu__link">'.$arItem["TEXT"].'</span>':
		($arItem["DEPTH_LEVEL"]==1 ? "<a href=\"{$arItem["LINK"]}\" class=\"hidden-mobi dropdown-menu__link\">{$arItem["TEXT"]}</a><span class=\"visible-mobi-two menu__link".($arItem["SELECTED"]?' menu__link_active':'')."\">".
            ((!isset($arResult[$key]["countItems"]) || $arResult[$key]["countItems"]==0)?'<a href="'.$arItem["LINK"].'">'.$arItem["TEXT"].'</a>':$arItem["TEXT"])."</span>" :
            $arItem["DOP_MOBI_MENU"]."<a href=\"{$arItem["LINK"]}\" class=\"dropdown-menu__link\">{$arItem["TEXT"]}</a>"));
		

		if ($arItem['IS_PARENT'])
			echo '<div class="dropdown-menu"><div class="dropdown-menu__triangle"></div><ul class="dropdown-menu__ul">';
		else
			echo "</li>\n";

		$previousLevel = $arItem["DEPTH_LEVEL"];
	}

	if ($previousLevel > 1)
		echo str_repeat("</ul></li>", ($previousLevel-1));
	if(is_array($arResult))
	    echo "</ul>\n";

?>
	</div>
</div>
<?php
    if(SHOW_NAV_CHAIN_DEFAULT){
        ?>
<div class="breadcrumbs visible-desktop">
    <?php
    if(isset($arResult['breadcrumbs'])) {
        ?>
        <a class="breadcrumbs__link" href="<?= $arResult['breadcrumbs']['site'][1] ?>"
           title="<?= $arResult['breadcrumbs']['site'][0] ?>">
            <?= $arResult['breadcrumbs']['site'][0] ?>
        </a>
        <span class="breadcrumbs__arrow"></span>
        <?php
        if(isset($arResult['breadcrumbs']['menu_item'])) {
            ?>
            <a class="breadcrumbs__link" href="<?= $arResult['breadcrumbs']['menu_parent'][1] ?>"
               title="<?= $arResult['breadcrumbs']['menu_parent'][0] ?>">
            <?php
        }
        echo $arResult['breadcrumbs']['menu_parent'][0];
        if(isset($arResult['breadcrumbs']['menu_item'])){
            ?>
        </a>
            <span class="breadcrumbs__arrow"></span><span><?= $arResult['breadcrumbs']['menu_item'] ?></span>
        <?php
        }
    }
    ?>
</div>
<?
    }
?>

