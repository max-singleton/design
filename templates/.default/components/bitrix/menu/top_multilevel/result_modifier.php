<?php
$selectedParent = -1;
$currentParent = -1;
$parentLinks = array();
$rsSites = CSite::GetByID(SITE_ID);
$arSite = $rsSites->Fetch();
foreach ($arResult as $key=>$arItem) {
    if ($arItem['DEPTH_LEVEL'] == 1){
        $currentParent = $key;
        $parentLinks[] = $arItem["LINK"];
        if($arItem['SELECTED']){
            $arResult['breadcrumbs'] = array("site"=>array($arSite['SITE_NAME'],$arSite['DIR']),"menu_parent" => array($arItem["TEXT"],$arItem["LINK"]));
        }
    }
    else{
        if(in_array($arItem["LINK"], $parentLinks)){
            unset($arResult[$key]);
            continue;
        }
        if ($arItem['DEPTH_LEVEL'] > 1 && $arItem['SELECTED'] && $currentParent >= 0 && $selectedParent == -1){
            $selectedParent = $currentParent;
            $arResult['breadcrumbs'] = array("site"=>array($arSite['SITE_NAME'],$arSite['DIR']),"menu_parent" => array($arResult[$selectedParent]["TEXT"],$arResult[$selectedParent]["LINK"]), "menu_item" => $arItem["TEXT"]);
        }
    }
}



$previousLevel = 0; $subMenuItem = -1; $previousKey = -1;
foreach ($arResult as $key=>$arItem) {
    $itemClasses = Array();
    if($arItem["DEPTH_LEVEL"]==1)
    {
        if($previousKey > -1){
            $arResult[$previousKey]['countItems'] = $subMenuItem+1;
        }
        $itemClasses[] = 'menu__item';
        $subMenuItem = -1;
        $previousKey = $key;
    }
    else
    {
        $itemClasses[] = 'dropdown-menu__item';
        $subMenuItem++;
    }
    if (strlen($arItem['PARAMS']['class']) > 0)
        $itemClasses[] = $arItem['PARAMS']['class'];
    if ($key == count($arResult)-1)
        $itemClasses[] = 'last';
    if ($arItem['SELECTED'] || $key == $selectedParent){
        $itemClasses[] = 'menu__link_active';
        $arResult[$key]['SELECTED'] = true;
    }

    $arResult[$key]["LI_ATTRS"] = count($itemClasses) > 0 ? ' class="' . implode(' ', $itemClasses) . '"' : '';

    if($arItem["DEPTH_LEVEL"]==1)
        $arResult[$key]["DOP_MOBI_MENU"] = $arItem["LINK"]!="" && $fileExists ? "<a href=\"{$arItem["LINK"]}\" class=\"visible-mobi dropdown-menu__link\">{$arItem["TEXT"]}</a>" : '';
    else if($subMenuItem > 0)
        $arResult[$key]["DOP_MOBI_MENU"] = '';
    $previousLevel = $arItem["DEPTH_LEVEL"];
}
?>