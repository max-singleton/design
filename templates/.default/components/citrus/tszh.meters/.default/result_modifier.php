<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult['ITEMS'] as $key=>$arItem) {
    if($arItem['SERVICE_ID']>0){
        //получаем единицы измерения
        $service = CTszhService::GetByID($arItem['SERVICE_ID']);
        $arResult["ITEMS"][$key]["UNIT"] = $service["UNITS"];
    }
}
?>
