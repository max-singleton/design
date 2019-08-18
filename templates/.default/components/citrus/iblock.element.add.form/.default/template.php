<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$this->setFrameMode(true);

//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>

<?if (count($arResult["ERRORS"])):?>
	<?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<div class="notetext"><?=$arResult['MESSAGE']?></div>
<?endif?>
<div class="ask-form">
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>#ask" method="post" enctype="multipart/form-data">

<?
	// начало динамической части
	$frame = $this->createFrame()->begin('');
	echo bitrix_sessid_post();
	$frame->end();
?>

	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>

	<div class="ask-form__table">
		<?if (is_array($arResult["PROPERTY_LIST"]) && count($arResult["PROPERTY_LIST"] > 0)):?>
			<?foreach ($arResult["PROPERTY_LIST"] as $key => $arPropertyID):
                $propertyID = $arPropertyID['propertyID'];
                ?>
                <div class="ask-form__row">
					<div class="ask-form__cell"><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?></div>
					<div class="ask-form__cell">
						<?
                        $inputNum = $arPropertyID['inputNum'];
                        $INPUT_TYPE = $arPropertyID['INPUT_TYPE'];
                        $html = $arPropertyID['html'];
						switch ($INPUT_TYPE):
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "HTML":
								$LHE = new CLightHTMLEditor;
								$LHE->Show(array(
									'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
									'width' => '100%',
									'height' => '200px',
									'inputName' => "PROPERTY[".$propertyID."][0]",
									'content' => $arResult["ELEMENT"][$propertyID],
									'bUseFileDialogs' => false,
									'bFloatingToolbar' => true,
									'bArisingToolbar' => true,
									'toolbarConfig' => array(
										'Bold', 'Italic', 'Underline', 'RemoveFormat',
										'CreateLink', 'DeleteLink', 'Image', 'Video',
										'BackColor', 'ForeColor',
										'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
										'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
										'StyleList', 'HeaderList',
										'FontList', 'FontSizeList',
									),
								));
								break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
								<input class="styled" type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" class="input" /><?
								if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
								endif
								?><?
								}
							break;
                            default:
                                echo $html;
                                break;
						endswitch;?>
					</div>
                </div>
			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<div class="ask-form__row">
					<div class="ask-form__cell"><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></div>
					<div class="ask-form__cell">
						<?
						$frame = $this->createFrame()->begin();
						?>				
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
						<?
						$frame->end();
						?>
					</div>
				</div>
				<div class="ask-form__row">
					<div class="ask-form__cell"><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span></div>
					<div class="ask-form__cell"><input type="text" name="captcha_word" maxlength="50" value="" class="input styled"></div>
				</div>
			<?endif?>

                    <?
                    if ($USER->IsAuthorized()) {
                        if ($arResult["CONFIRM_TSZH"] == "Y")
                        {
                            if ($arResult["CONFIRM_ACC"] != "Y")
                            {
                                ?><div class="ask-form__row">

                                <div class="ask-form__cell"> </div>
                                <div class="ask-form__cell">
                                    <div class="input-checkbox feedback-checkbox"><input name="confirm" type="checkbox" id="confirm_ask-form" required><label for="confirm_ask-form">&nbsp;</label></div>
                                    <div><?= $arResult["TSZH_DATA"]["~CONFIRM_TEXT"] ?></div></div></div>
                                <?
                            }
                        }
                    }
                    else{
                        if ($arResult["CONFIRM_TSZH"] == "Y")
                        {
                            ?><div class="ask-form__row">

                        <div class="ask-form__cell"> </div>
                        <div class="ask-form__cell">
                            <div class="input-checkbox feedback-checkbox"><input name="confirm" type="checkbox" id="confirm_ask-form" required><label for="confirm_ask-form">&nbsp;</label></div>
                            <div><?= $arResult["TSZH_DATA"]["~CONFIRM_TEXT"] ?></div></div></div>
                            <?
                        }
                    }
                    ?>
					<button class="feedback-t styled" type="submit" name="iblock_submit" value="1"><?=GetMessage("IBLOCK_FORM_SUBMIT")?></button>

		<?endif?>
	</div>
	<br />
	<?if (strlen($arParams["LIST_URL"]) > 0):?><a href="<?=$arParams["LIST_URL"]?>"><?=GetMessage("IBLOCK_FORM_BACK")?></a><?endif?>
</form>
</div>