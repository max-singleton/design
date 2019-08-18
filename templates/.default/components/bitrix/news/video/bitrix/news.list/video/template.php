<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>
<div class="video-items">
<?if($arParams["DISPLAY_TOP_PAGER"]):
	echo '<div>' . $arResult["NAV_STRING"] . '</div>';
endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<div class="video"><?

	if ($arParams['DISPLAY_DATE'] == "Y" && !empty($arItem["DISPLAY_ACTIVE_FROM"])):
		?><span class="video-date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span><br /><?
	endif;

	if ($arParams["DISPLAY_PICTURE"] == "Y") {
		if (is_array($arItem["PREVIEW_PICTURE"])) {
			$strPreview = $arItem["PREVIEW_PICTURE"]["SRC"];
		} else {
			$strPreview = $this->GetFolder() . '/images/video_default.png';
		}
		echo '<a class="video-preview" href="' . $arItem['DETAIL_PAGE_URL'] . '" title="' . $arItem["NAME"] . '">' . CFile::ShowImage(
			$strPreview,
			150,
			150,
			'alt="' . $arItem["NAME"] . '" border="0"'
		) . '</a><br />';
	}

	if ($arParams['DISPLAY_TITLE'] = 'Y' && !empty($arItem['NAME'])):
		?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="video-link"><?=$arItem['NAME']?></a><?

			if (strlen($arItem["PROPERTIES"]["DURATION"]['VALUE']) > 0) {
				echo "&nbsp;<span class=\"video-duration\">(" . $arItem["PROPERTIES"]["DURATION"]['VALUE'] . ')</span>';
			}

		?><br /><?
	endif;?>
</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):
	echo '<div>' . $arResult["NAV_STRING"] . '</div>';
endif;?>
</div>
