<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="stat-auth-form">
    <?
        //казалось бы надо наоборот, для неавторизованного пользователя выводить форму, но для неавторизованного уже есть форма авторизация в футере
        if(!$USER->IsAuthorized()){
            ShowMessage($arParams["~AUTH_RESULT"]);
            ShowMessage($arResult['ERROR_MESSAGE']);
            return;
        }
    ?>
</div>



<div class="shadow hidden"></div>
<div class="window hidden" id="window-password-recovery">
    <div class="window__close">X</div>
    <form class="block-password-recovery-form" name="system_password-recovery_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <input type="hidden" name="AUTH_FORM" value="Y">
        <input type="hidden" name="TYPE" value="SEND_PWD">
        <div class="window__title"><?=getMessage("AUTH_PASSWORD_RECOVERY")?></div>
        <div class="window__hr"></div>

        <div class="window__description">
            <span class="window__description_bold"><?=getMessage("AUTH_IF_YOU_FORGET_PASSWORD_0")?></span>
            <?=getMessage("AUTH_IF_YOU_FORGET_PASSWORD_1")?>
        </div>
        <div class="window__inputs">
            <div class="window__block">
                <div class="window__input-name_pas"><?=getMessage("AUTH_LOGIN")?> <span class="window__input-star">*</span></div>
                <input class="window__input" type="text" name="USER_LOGIN" placeholder="">
            </div>
            <div class="window__block">
                <div class="window__input-name_pas">E-Mail <span class="window__input-star">*</span></div>
                <input class="window__input" type="text" name="USER_EMAIL" placeholder="">
            </div>
        </div>
        <div class="window__control">
            <input class="window__sendbutton" type="submit" value="Отправить">
            <div class="window__text_or"><?=getMessage("OR")?></div>
            <a class="window__enter window-open" href="javascript:void(0)" window="window-auth"><?=getMessage("AUTH_LOGIN_BUTTON")?></a>
        </div>
        <div class="block-password-recovery-form__error">
        </div>
        <div class="block-password-recovery-form__account_info_sent">
        </div>
    </form>
</div>


<div class="stat-auth-form">
    <?
    ShowMessage($arParams["~AUTH_RESULT"]);
    ShowMessage($arResult['ERROR_MESSAGE']);
    ?>
    <form class="block-auth-form" name="form_auth>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <?if($arResult["AUTH_FOR_INITIAL_ACCESS"] <> ''):?>
            <input type="hidden" name="AUTH_FOR_INITIAL_ACCESS" value="<?=$arResult["AUTH_FOR_INITIAL_ACCESS"]?>" />
        <?endif?>
        <?if(!empty($arParams["PROFILE_URL"])):?>
            <input type="hidden" name="tourl" value="<?=$arParams["PROFILE_URL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <?if (strlen($arResult["BACKURL"]) > 0):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <div class="window__title"><?=getMessage("AUTH_AUTH")?></div>
        <div class="window__hr"></div>
        <div class="window__inputs">
            <div class="window__block">
                <div class="window__input-name"><?=getMessage("AUTH_LOGIN")?> <span class="window__input-star">*</span></div>
                <input class="window__input" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" placeholder="<?=getMessage("AUTH_LOGIN")?>">
            </div>
            <div class="window__block">
                <div class="window__input-name"><?=getMessage("AUTH_PASSWORD")?> <span class="window__input-star">*</span></div>
                <input class="window__input" type="password" name="USER_PASSWORD" maxlength="50" placeholder="<?=getMessage("AUTH_PASSWORD")?>" />
                <div class="window__input-recall"><a href="javascript:void(0)" class="window-open" window="window-password-recovery"><?=getMessage("AUTH_FORGOT_PASSWORD")?>?</a></div>
            </div>
        </div>
        <div class="window__checkform">
            <input class="window__checkbox" id="checkbox-<?=$arResult["RND"]?>" type="checkbox" name="USER_REMEMBER">
            <label for="checkbox-<?=$arResult["RND"]?>" class="window__checkbox-text">
                <span class="window__checkbox-text_pc"><?=getMessage("AUTH_REMEMBER_ME")?></span>
                <span class="window__checkbox-text_mb"><?=getMessage("AUTH_REMEMBER_ME_MOBI")?></span>
            </label>
        </div>
        <div class="window__checkbutton">
            <input class="window__button" type="submit" value="<?=getMessage("AUTH_LOGIN_BUTTON")?>">
        </div>
        <div class="block-auth-form__error">
        </div>
    </form>
    <div class="window__hr"></div>
    <?if($arResult["AUTH_SERVICES"]):?>
        <?
        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
            array(
                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                "AUTH_URL"=>$arResult["AUTH_URL"],
                "POST"=>$arResult["POST"],
                "POPUP"=>"N",
                "SUFFIX"=>"form",
            ),
            $component,
            array("HIDE_ICONS"=>"Y")
        );
        ?>
    <?endif?>

    <div class="window__mobi-recall"><a class="mobi-recall__link window-open" href="javascript:void(0)" window="window-password-recovery"><?=getMessage("AUTH_FORGOT_PASSWORD")?>?</a></div>
    <div class="window__info">
        <div class="window__info-text"><?=getMessage("FOR_INITIAL_ACCESS")?></div>
        <a class="window__info-link" onclick='$("#contact-user-name").focus()' href="#contact"><?=getMessage("AUTH_CONTACT_OUR_OFFICE")?></a>
    </div>
</div>

