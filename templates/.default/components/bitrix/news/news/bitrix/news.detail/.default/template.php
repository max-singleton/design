<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>
<div class="b-news-detail">
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="b-news-date b-news-detail-date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>

	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):
		$arSmallPicture = CFile::ResizeImageGet(
			$arResult["DETAIL_PICTURE"]["ID"],
			array(
				'width' => intval($arParams['RESIZE_IMAGE_WIDTH']) <= 0 ? 150 : intval($arParams['RESIZE_IMAGE_WIDTH']), 
				'height' => intval($arParams['RESIZE_IMAGE_HEIGHT']) <= 0 ? 150 : intval($arParams['RESIZE_IMAGE_HEIGHT']),
			),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);?>
        <div class="b-news-detail__img">
		    <a rel="news-detail-photo" class="colorbox" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" title="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>"><img class="b-news-preview-picture b-news-detail-preview-picture" border="0" src="<?=$arSmallPicture["src"]?>" width="<?=$arSmallPicture["width"]?>" height="<?=$arSmallPicture["height"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" /></a>
        </div>
    <?endif?>
	<?
	if ($arParams["MORE_PHOTO"] && array_key_exists($arParams["MORE_PHOTO"], $arResult["PROPERTIES"]))
	{
		$arMorePhotos = $arResult["PROPERTIES"][$arParams["MORE_PHOTO"]]["VALUE"];
		$arDescription = $arResult["PROPERTIES"][$arParams["MORE_PHOTO"]]["DESCRIPTION"];
		if (!is_array($arMorePhotos))
			$arMorePhotos = Array();
		if (count($arMorePhotos) > 0)
		{
			?><div class="b-news-detail-photos"><?
			foreach ($arMorePhotos as $idx=>$photoID)
			{
				$arFile = CFile::GetFileArray($photoID);
				if (!is_array($arFile) || strlen($arFile["SRC"]) <= 0)
					continue;
				$arSmallPicture = CFile::ResizeImageGet(
					$photoID,
					array(
						'width' => intval($arParams['RESIZE_IMAGE_WIDTH']) <= 0 ? 150 : intval($arParams['RESIZE_IMAGE_WIDTH']), 
						'height' => intval($arParams['RESIZE_IMAGE_HEIGHT']) <= 0 ? 150 : intval($arParams['RESIZE_IMAGE_HEIGHT']),
					),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);?>
				<a rel="news-detail-photo" class="colorbox" href="<?=$arFile["SRC"]?>" title="<?=$arDescription[$idx]?>"><img class="b-news-preview-picture b-news-detail-preview-picture" border="0" src="<?=$arSmallPicture["src"]?>" width="<?=$arSmallPicture["width"]?>" height="<?=$arSmallPicture["height"]?>" alt="<?=$arDescription[$idx]?>" title="<?=$arDescription[$idx]?>" /></a>
				<?
			}
			?></div><?
		}
	}
	?>

	<div class="b-news-text b-news-detail-text">
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
			<blockquote><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></blockquote>
		<?endif;?>

		<?if($arResult["NAV_RESULT"]):?>
			<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
			<?echo $arResult["NAV_TEXT"];?>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
		<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
			<?echo $arResult["DETAIL_TEXT"];?>
		<?else:?>
			<?echo $arResult["PREVIEW_TEXT"];?>
		<?endif?>
	</div>

	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	<?
	if (count($arResult["DISPLAY_PROPERTIES"]) > 0)
	{
		?>
		<dl class='b-news-props'>
		<?
		foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty)
		{
			if ($arProperty["PROPERTY_TYPE"] == 'F')
			{
				if (!is_array($arProperty['VALUE'])) {
					$arProperty['VALUE'] = array($arProperty['VALUE']);
					$arProperty['DESCRIPTION'] = array($arProperty['DESCRIPTION']);
				}
				$arProperty["DISPLAY_VALUE"] = Array();
				foreach ($arProperty["VALUE"] as $idx=>$value) {
					$path = CFile::GetPath($value);
					$desc = strlen($arProperty["DESCRIPTION"][$idx]) > 0 ? $arProperty["DESCRIPTION"][$idx] : bx_basename($path);
					if (strlen($path) > 0)
					{
						$ext = pathinfo($path, PATHINFO_EXTENSION);
						$fileinfo = '';
						if ($arFile = CFile::GetByID($value)->Fetch())
							$fileinfo .= ' (' . $ext . ', ' . round($arFile['FILE_SIZE']/1024) . GetMessage('FILE_SIZE_Kb') . ')';
						$arProperty["DISPLAY_VALUE"][] = "<a href=\"{$path}\" class=\"file file-{$ext}\" title=\"" . htmlspecialcharsbx($desc) . "\" download=\"{$desc}.$ext\">" . $desc . "</a>" . $fileinfo;
					}
				}
				$val = is_array($arProperty["DISPLAY_VALUE"]) ? implode(', ', $arProperty["DISPLAY_VALUE"]) : $arProperty['DISPLAY_VALUE'];
			}
			else
			{
				if (!is_array($arProperty["DISPLAY_VALUE"]))
					$arProperty["DISPLAY_VALUE"] = Array($arProperty["DISPLAY_VALUE"]);
				$ar = '';
				foreach ($arProperty["DISPLAY_VALUE"] as $idx=>$value)
					$ar[] = $value . (strlen($arProperty["DESCRIPTION"][$idx]) > 0 ? ' (' . $arProperty["DESCRIPTION"][$idx] . ')': '');

				$val = implode(' / ', $ar);
			}					
			

			if ($arProperty["PROPERTY_TYPE"] != 'F')
			{
				?>
				<dt><?=$arProperty["NAME"]?></dt>
				<dd><?=$val?></dd>
				<?
			}
			else
			{
				?><dd class="fileprop"><?=$val?></dd><?
			}		}
		?>
		</dl>
		<?
	}
	?>
	<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<!--noindex-->
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			<!--/noindex-->
		</div>
		<?
	}?>
</div>
