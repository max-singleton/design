<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
	"vdgb:tszhepasport.all",
	"",
	Array(
		"YANDEX_CLUSTERIZATION" => $arParams["YANDEX_CLUSTERIZATION"],
		"MAPCONTROLS" => $arParams["MAPCONTROLS"],
		"FILE" => $arParams["FILE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	),
	$component
);?>