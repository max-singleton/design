<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
if (!$arResult['OWNER_LS'])
    require($_SERVER["DOCUMENT_ROOT"]."/include/notOwner.php");
?>
    <?if(isset($arResult['FIO'])):?>
        <?=$arResult['FIO']?>
    <?endif;?>