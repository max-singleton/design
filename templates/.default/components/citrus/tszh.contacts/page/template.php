<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$this->__component->arResult["TEMPLATE_HTML"] = "";

if (empty($arResult["ITEMS"]))
	return;

ob_start();

?>

<div class="tabs t-contacts">
	<?$arIDs = array_keys($arResult["ITEMS"]);
	$activeID = array_shift($arIDs);
	if (count($arResult["ITEMS"]) > 1):?>
			<?foreach ($arResult["ITEMS"] as $itemID => $arItem):?>
                <input id="org-contacts-<?=$itemID?>" type="radio" name="tabs" <?=$activeID == $itemID?'checked':''?> value="<?=$itemID?>"><label for="org-contacts-<?=$itemID?>" title="<?=$arItem["NAME"]?>"><?= $arItem["NAME"] ?></label>
			<?endforeach?>
	<?endif?>
		<?foreach($arResult["ITEMS"] as $itemID => $arItem):
        $first = true;
    ?>
			<section sectionId="<?=$itemID?>">
				<h3 class="alt"><?=$arItem["NAME"]?></h3>
                        <?foreach ($arItem["arGroups"] as $groupKey => $arGroup):
                            if (!$arGroup["EXISTS"])
                                continue;?><div class="t-contacts-group"><div class="t-contacts-group__cell<?=$first?'_mobi':''?>">
                                                <div class="t-contacts-group__title"><?=$arGroup["TITLE"]?>:</div>
                            <?foreach ($arGroup["FIELDS_VALUE"] as $arField):
                                $field = $arField['field'];
                                $value = trim($arField['value']);
                            ?>
                                <div class="requisite">
                                    <div class="requisite__name"><?=GetMessage("T_F_" . $field)?>:</div>
                                    <div class="requisite__value"><?=html_entity_decode($value)?></div>
                                </div>
                            <?endforeach;?>
                            </div>
                            <?
                            $showMapFlag = $arParams["SHOW_MAP"] && strlen($arItem["ADDRESS"]) > 0;
                            if ($first && $showMapFlag):?>
                            <div class="t-contacts-group__cell hidden-mobi">
                                    <div class="org-map-td">
                                        <div class="map-container">
                                            <#MAP_<?=$itemID?>#>
                                        </div>
                                    </div>
                            </div>
                            <?
                                $first = false;
                            endif?>
                            </div>
                            <?
                            if ($arGroup["SHOW_WRITE_US"]):?>
                                <div class="t-contacts-group__write-us">
                                    <a  href="#feedbackForm-<?=$itemID.'">'.GetMessage("T_WRITE_US")?></a>
                                </div>
                            <?endif;
                        endforeach?>
                <?if ($arParams["SHOW_FEEDBACK_FORM"]):?>
                <#FEEDBACK_FORM#>
                    <?endif?>
			</section>
		<?endforeach?>
</div>
<?$this->__component->arResult["TEMPLATE_HTML"] = @ob_get_contents();
ob_end_clean();?>