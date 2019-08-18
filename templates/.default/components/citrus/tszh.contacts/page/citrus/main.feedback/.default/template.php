<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<div id="contacts-page-feedback">
	<h3><a name="feedbackForm"></a><?=GetMessage("T_HEADER")?>:</h3>


	<?
	$frame = $this->createFrame()->begin('');
	?>
	<form id="feedbackForm" action="<?=$APPLICATION->GetCurPage()?>#feedbackForm" method="POST">
        <?
        if(!empty($arResult["ERROR_MESSAGE"]))
        {
            echo '<div class="feedback-error"><div>'.join('</div><div>', $arResult["ERROR_MESSAGE"]).'</div></div>';
        }
        if (strlen($arResult["OK_MESSAGE"]) > 0):
            if (strlen($arResult["OK_MESSAGE"]) <= 0)
                $arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];?>
            <div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div>
        <?endif?>

        <div class="left-fields-container">
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="tszh_id" id="feedback-tszh_id" value="<?=$arParams["TSZH_ID"]?>">
			<input type="text" name="user_name" class="name styled" placeholder="<?=GetMessage("MFT_NAME")?>"  value="<?=$arResult["AUTHOR_NAME"]?>">
			<input type="text" name="user_email" class="mail styled" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$arResult["AUTHOR_EMAIL"]?>">

			<?if ($arParams["USE_CAPTCHA"] == "Y"):?>
                <div class="feedback-captcha">
                    <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
                    <div class="feedback-captcha__img">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" height="40" alt="CAPTCHA"/>
                    </div>
                    <div class="feedback-captcha__input">
                        <input type="text" name="captcha_word" class="captcha styled" width="50" placeholder="<?=GetMessage("MFT_INPUT_CAPTCHA")?>" size="30" maxlength="50" value=""/>
                    </div>
                </div>
			<?endif?>
		</div>

		<div class="right-fields-container">
			<textarea name="MESSAGE" class="text-mai height-textarea styled" placeholder="<?=GetMessage("MFT_MESSAGE")?>"><?=$arResult["MESSAGE"]?></textarea>
			<?
			if ($USER->IsAuthorized()) {
                if ($arResult["CONFIRM_TSZH"] == "Y")
                {
                    if ($arResult["CONFIRM_ACC"] != "Y")
                    {
                    ?> <div class="feedbackForm__confirm">
                        <div class="input-checkbox feedback-checkbox"><input name="confirm" type="checkbox" id="confirm" required><label for="confirm">&nbsp;</label></div>
                    <p><?= $arResult["TSZH_DATA"]["~CONFIRM_TEXT"] ?><br>
                    </div>
                    <?
                    }
                }
            }
            else{
                if ($arResult["CONFIRM_TSZH"] == "Y")
                {
                    ?>
                    <div class="feedbackForm__confirm">
                    <div class="input-checkbox feedback-checkbox">
                        <input name="confirm" type="checkbox" id="confirm" required><label for="confirm">&nbsp;</label></div>
                        <p><?= $arResult["TSZH_DATA"]["~CONFIRM_TEXT"] ?></p>
        </div>
                    <?
                }
            }
				?>
            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>"/>
			<button type="submit" class="styled" name="submit" value="Y"><?=GetMessage("MFT_SUBMIT")?></button>
		</div>
	</form>
	<?
	$frame->end();
	?>
</div>