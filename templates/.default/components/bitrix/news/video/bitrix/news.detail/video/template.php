<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>
<div class="news-detail">
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<div class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
<?
if (strlen($arResult["PROPERTIES"]["FILE"]["VALUE"]) > 0):
	?><?$APPLICATION->IncludeComponent("bitrix:player", ".default", array(
		"PATH" => $arResult["PROPERTIES"]["FILE"]["VALUE"],
		"PROVIDER" => "video",
		"WIDTH" => "640",
		"HEIGHT" => "492",
		"AUTOSTART" => "N",
		"REPEAT" => "none",
		"VOLUME" => "90",
		"ADVANCED_MODE_SETTINGS" => "N",
		"PLAYER_TYPE" => "auto",
		"USE_PLAYLIST" => "N",
		"STREAMER" => "",
		"PREVIEW" => $arResult["DETAIL_PICTURE"]["SRC"],
		"FILE_TITLE" => $arResult["NAME"],
		"FILE_DURATION" => $arResult["PROPERTIES"]["DURATION"]["VALUE"],
		"FILE_AUTHOR" => "",
		"FILE_DATE" => $arResult["DISPLAY_ACTIVE_FROM"],
		"FILE_DESCRIPTION" => $arResult["PREVIEW_TEXT"],
		"MUTE" => "N",
		"PLUGINS" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_FLASHVARS" => "",
		"PLAYER_ID" => "",
		"BUFFER_LENGTH" => "10",
		"ALLOW_SWF" => "N",
		"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
		"SKIN" => "",
		"CONTROLBAR" => "bottom",
		"WMODE" => "transparent",
		"HIDE_MENU" => "N",
		"LOGO" => "/bitrix/components/bitrix/iblock.tv/templates/.default/images/logo.png",
		"LOGO_LINK" => "",
		"LOGO_POSITION" => "none"
		),
		false
	);?><?
//$arResult["PROPERTIES"]["FILE"]["VALUE"]
//$arResult["PROPERTIES"]["DURATION"]["VALUE"]
endif;
?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):

		if ($arProperty["CODE"] == "FILE" || $arProperty["CODE"] == "DURATION")
			continue;

		if ($arProperty["PROPERTY_TYPE"] == 'F') {
			if (!is_array($arProperty['VALUE'])) {
				$arProperty['VALUE'] = array($arProperty['VALUE']);
				$arProperty['DESCRIPTION'] = array($arProperty['DESCRIPTION']);
			}
			$arProperty["DISPLAY_VALUE"] = Array();
			foreach ($arProperty["VALUE"] as $idx=>$value) {
				$path = CFile::GetPath($value);
				$desc = strlen($arProperty["DESCRIPTION"][$idx]) > 0 ? $arProperty["DESCRIPTION"][$idx] : 'Download';
				if (strlen($path) > 0) {
					$arProperty["DISPLAY_VALUE"][] = "<a href=\"{$path}\">" . $desc . "</a>\n";
				}
			}
		}

	?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;?>
</div>
