<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    use Bitrix\Main\Page\Asset;
    $this->setFrameMode(true);
    $arParams['DELAY'] = IntVal($arParams['DELAY']) > 0 ? $arParams['DELAY'] : 5000;

    Asset::getInstance()->addString('
    <script type="text/javascript">
        $(document).ready(function()
        {
            delay = '.$arParams['DELAY'].';
        });
    </script>
    ');
?>

<div class="slider" style="height: <?=$arParams['HEIGHT']?>px;">
	<div class="slider__slide">
	<?
        foreach ($arResult['ITEMS'] as $arElement)
        {
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
            <div class="slide__text fade" id="<?=$this->GetEditAreaId($arElement['ID'])?>" >
                <!-- <div class="slide__text-title">
                    <?= $arElement['NAME']  ?>
                </div> -->
                <div class="slide__text-descr">
                    <?= $arElement['PREVIEW_TEXT']  ?>
                </div>
                <div class="slide__text-lang">
                    <?= $arElement['DETAIL_TEXT']  ?>
                </div>
            </div>
	<?
        }
	?>

		<div class="slide__switcher">
    <?
        if(count($arResult['ITEMS']) > 1)
        {
            for($i=1; $i<=count($arResult['ITEMS']); $i++)
            {
    ?>
                <div onclick="showSlides(<?=$i?>)" class="slide__switcher-button<?=$i==1?' button-active':''?>"></div>
    <?
            }
        }
    ?>
		</div>
	</div>

    <?
        foreach ($arResult['ITEMS'] as $arElement)
        {
    ?>
    <div class="slider__image">
        <?
        $arImg = CAllFile::ResizeImageGet($arElement['PREVIEW_PICTURE'], Array('width' => $arParams['WIDTH'], 'height' => $arParams['HEIGHT']), BX_RESIZE_IMAGE_EXACT, $bInitSizes = true);
        echo CFile::ShowImage($arImg['src'], $arImg['width'], $arImg['height'], 'alt="' . $arElement['NAME'] . '"');
        ?>
    </div>
    <?
        }
    ?>

</div>