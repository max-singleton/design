<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

if (count($arResult['ITEMS']) > 0):?>
<ul class="small-links">
<?

	$bSupportsActions = method_exists($this, 'AddEditAction'); 

	foreach($arResult["ITEMS"] as $arItem):
		if ($bSupportsActions)
		{
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$itemID = ' id="' . $this->GetEditAreaId($arItem['ID']) . '"';
		} else {
			$itemID = '';
		}

		echo "	<li{$itemID}><a href=\"{$arItem["DETAIL_PAGE_URL"]}\">{$arItem["NAME"]}</a></li>\n";
	endforeach ;	
?>
</ul>
<?endif;?>