<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
//Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$arSection = null;
if (is_set($arResult, 'SECTION') && is_Set($arResult['SECTION'], 'PATH') && is_array($arResult['SECTION']['PATH']))
	$arSection = array_shift(array_values($arResult['SECTION']['PATH']));

if (is_array($arSection))
{
	$arResult['SET_ADDITIONAL_TITLE'] = $arSection['NAME'];
	$component->SetResultCacheKeys(Array("SET_ADDITIONAL_TITLE"));
}
?>
<div class="news">
    <div class="news__items">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $bIncludeAreas = $APPLICATION->GetShowIncludeAreas();
            if ($bIncludeAreas)
            {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            }
            ?>
            <div class="news__item"<?=($bIncludeAreas ? 'id="' . $this->GetEditAreaId($arItem['ID']) . '"' : '')?>>
                <div class="news__item-container">
                <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                    <div class="news__item-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
                <?endif?>

                <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                    <div class="news__item-title">
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                        <a class="news__item-link" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
                    <?else:?>
                        <span class="news__item-link"><?echo $arItem["NAME"]?></span>
                    <?endif;?>
                    </div>
                <?endif;?>

                    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):
                        $arSmallPicture = CFile::ResizeImageGet(
                            $arItem["PREVIEW_PICTURE"]["ID"],
                            array(
                                'width' => intval($arParams['RESIZE_IMAGE_WIDTH']) <= 0 ? 150 : intval($arParams['RESIZE_IMAGE_WIDTH']),
                                'height' => intval($arParams['RESIZE_IMAGE_HEIGHT']) <= 0 ? 150 : intval($arParams['RESIZE_IMAGE_HEIGHT']),
                            ),
                            BX_RESIZE_IMAGE_EXACT,
                            $bInitSizes = true
                        );
                        ?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="news__img hidden-mobi" border="0" src="<?=$arSmallPicture["src"]?>" width="<?=$arSmallPicture["width"]?>" height="<?=$arSmallPicture["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
                    <?else:?>
                        <img class="news__img hidden-mobi" border="0" src="<?=$arSmallPicture["src"]?>" width="<?=$arSmallPicture["width"]?>" height="<?=$arSmallPicture["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
                    <?endif;?>
                    <?endif?>

                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                    <div class="news__item-descr">
                        <?echo $arItem["PREVIEW_TEXT"];?>
                    </div>
                <?endif;?>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>
