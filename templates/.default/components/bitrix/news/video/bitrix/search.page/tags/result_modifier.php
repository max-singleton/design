<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult['ERROR_CODE'] == 0 && count($arResult["SEARCH"]) > 0 && CModule::IncludeModule('iblock')) {
	$arItemIDs = Array();
	foreach ($arResult['SEARCH'] as $key=>$arItem) {
		if ($arItem["MODULE_ID"] == 'iblock' && IntVal($arItem["ITEM_ID"]) > 0) {
			$arItemIDs[$arItem["ITEM_ID"]] = $key;
		}
	}
	$obElement = CIBlockElement::GetList(
		Array(),
		Array("ID" => array_keys($arItemIDs)),
		false, //mixed arGroupBy = false
		false, //mixed arNavStartParams = false
		Array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE", "ACTIVE_FROM") //array arSelectFields = Array());
	);
	while ($arElement = $obElement->GetNext()) {
		$arItem = &$arResult["SEARCH"][$arItemIDs[$arElement["ID"]]];
		
		if (strlen($arElement["ACTIVE_FROM"]) > 0)
			$arItem['DATE_CHANGE'] = date($arParams["LIST_ACTIVE_DATE_FORMAT"], MakeTimeStamp($arElement["ACTIVE_FROM"]));
		$arItem["BODY_FORMATED"] = $arElement["PREVIEW_TEXT"];
	}
}

?>