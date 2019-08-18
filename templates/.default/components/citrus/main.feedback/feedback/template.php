<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
?>

<div class="feedback pull-right-lg">
    <form action="<?=$APPLICATION->GetCurPage()?>#feedbackForm" method="POST" id="feedbackForm">
        <div class="feedback__form">
            <div class="feedback__title"><?=GetMessage("MFT_FEEDBACK")?></div>
            <?
            if(!empty($arResult["ERROR_MESSAGE"]))
            {
                echo '<div class="feedback-error"><div>'.join('</div><div>', $arResult["ERROR_MESSAGE"]).'</div></div>';
            }
            if(strlen($arResult["OK_MESSAGE"]) > 0)
            {
                ?><div class="feedback-success"><?=$arResult["OK_MESSAGE"]?></div><?
            }
            ?>


            <a name="contact"></a>
            <input type="text" name="user_name" id="contact-user-name" class="feedback__input"  placeholder="<?=GetMessage("MFT_NAME")?>"  value="<?=$arResult["AUTHOR_NAME"]?>">
            <input type="text" name="user_email" class="feedback__input" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$arResult["AUTHOR_EMAIL"]?>">
            <textarea name="MESSAGE"  class="feedback__textarea"  placeholder="<?=GetMessage("MFT_MESSAGE")?>"><?=$arResult["MESSAGE"]?></textarea>
        <?
            // начало динамической части
            $frame = $this->createFrame()->begin('');
            echo bitrix_sessid_post();
        ?>
            <?if($arParams["USE_CAPTCHA"] == "Y"):?>
            <table class="feedback__captcha" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="50%">
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" alt="CAPTCHA"></td>
                    <td width="50%" align="left">
                        <input type="text" name="captcha_word"  class="captcha" maxlength="50" value="" placeholder="<?=GetMessage("MFT_INPUT_CAPTCHA")?>">
                    </td>
                </tr>
            </table>
            <?endif;?>

            <?
            if ($USER->IsAuthorized()) {
                if ($arResult["CONFIRM_TSZH"] == "Y")
                {
                    if ($arResult["CONFIRM_ACC"] != "Y")
                    {
                        ?><div class="feedback__confirm">
                        
                        <div class="input-checkbox feedback-checkbox"><input name="confirm" type="checkbox" id="confirm_feedback" required><label for="confirm_feedback">&nbsp;</label></div><?= $arResult["TSZH_DATA"]["~CONFIRM_TEXT"] ?></div>
                        <?
                    }
                }
            }
            else{
                if ($arResult["CONFIRM_TSZH"] == "Y")
                {
                    ?><div class="feedback__confirm">
                    
                        <div class="input-checkbox feedback-checkbox"><input name="confirm" type="checkbox" id="confirm_feedback" required><label for="confirm_feedback">&nbsp;</label></div><?= $arResult["TSZH_DATA"]["~CONFIRM_TEXT"] ?></div>
                    <?
                }
            }
            ?>


        <?
            $frame->end();
        ?>
            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>"/>
            <div class="feedback__checkbutton">
                <button type="submit" name="submit" class="feedback__button" value="Y"><?=GetMessage("MFT_SUBMIT")?></button>
            </div>
        </div>
    </form>
</div>
