<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    use Bitrix\Main\Localization\Loc;
?>

	<form class="block-auth-form" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
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
		<div class="auth">
			<div class="auth__form">
				<div class="auth__head"><?=Loc::getMessage("AUTH_LOG_IN_PERSONAL_CABINET")?></div>
				<div class="auth__inputs">
					<input class="auth__input" type="text" name="USER_LOGIN" maxlength="50" placeholder="<?=Loc::getMessage("AUTH_LOGIN")?>" />
					<input class="auth__input" type="password" name="USER_PASSWORD" maxlength="50" placeholder="<?=Loc::getMessage("AUTH_PASSWORD")?>"/>
					<input class="auth__input" type="text" name="captcha_word" id="captcha_word_foot" placeholder="<?=GetMessage("AUTH_CAPTCHA_PROMT")?>" value="" <? echo strlen($arResult["CAPTCHA_CODE"]) > 0 ? '' : 'style="display: none;"'; ?>/>
					<img id="captcha_img_foot" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" class="auth__captcha-img"
					     alt="CAPTCHA" <? echo strlen($arResult["CAPTCHA_CODE"]) > 0 ? '' : 'style="display: none;"'; ?>/>
					<input type="hidden" name="captcha_sid" id="captcha_sid_foot" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
				</div>
				<div class="auth__checkform">
					<input class="auth__checkbox" id="auth__checkbox" type="checkbox" name="USER_REMEMBER"/>
					<label for="auth__checkbox" class="checkbox__text">
						<span class="visible-desktop"><?=Loc::getMessage("AUTH_REMEMBER_ME")?></span>
						<span class="visible-tablet visible-mobi"><?=Loc::getMessage("AUTH_REMEMBER_ME_MOBI")?></span>
					</label>
				</div>
				<div class="block-auth-form__error">
				</div>
				<div class="auth__checkbutton">
					<input class="auth__button" type="submit" value="<?=Loc::getMessage("AUTH_LOGIN_BUTTON")?>"/>
				</div>
			</div>
		</div>
	</form>