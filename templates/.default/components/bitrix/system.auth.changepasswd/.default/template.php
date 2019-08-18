<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
} ?>

<div class="bx-auth">

	<?
	ShowMessage($arParams["~AUTH_RESULT"]);
	?>

	<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
		<? if (strlen($arResult["BACKURL"]) > 0): ?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>"/>
		<? endif ?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="CHANGE_PWD">
		<!---->
		
		<div class="window__inputs">
			<div class="window__block">
				<div class="window__input-name">&nbsp;</div>
				<div class="window__title"><?=getMessage("AUTH_CHANGE_PASSWORD")?></div>
			</div>
			<div class="window__block">
				<div class="window__input-name"><?=getMessage("AUTH_LOGIN")?> <span class="window__input-star">*</span></div>
				<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="window__input"/>
			</div>
			<div class="window__block">
				<div class="window__input-name"><?=GetMessage("AUTH_CHECKWORD")?> <span class="window__input-star">*</span></div>
				<input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="window__input"/>

			</div>
			<div class="window__block">
				<div class="window__input-name"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?> <span class="window__input-star">*</span></div>
				<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="window__input"
				       autocomplete="off"/>
			</div>
			<div class="window__block">
				<div class="window__input-name"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?> <span class="window__input-star">*</span></div>
				<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>"
				       class="window__input" autocomplete="off"/>
			</div>

			<? if ($arResult["USE_CAPTCHA"]): ?>
				<div class="window__block">
					<div class="window__input-name"><input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>"/></div>
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA"/>
				</div>	
				<div class="window__block">
					<div class="window__input-name"><?=GetMessage("system_auth_captcha")?> <span class="window__input-star">*</span></div>
					<input type="text" name="captcha_word" maxlength="50" value="" class="window__input" autocomplete="off"/>
				</div>
			<? endif ?>
			<div class="window__block">
				<div class="window__input-name">&nbsp;</div>
				<input type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" class="window__button"/>
			</div>
		</div>

		<? if ($arResult["SECURE_AUTH"]): ?>
			<noscript>
				<p><span class="window__input-star"><? echo GetMessage("AUTH_NONSECURE_NOTE") ?></span></p>
			</noscript>
			<p><span class="window__input-star"><? echo GetMessage("AUTH_SECURE_NOTE") ?></span></p>
		<? endif ?>

		<p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
		<p><span class="window__input-star">*</span><?=GetMessage("AUTH_REQ")?></p>
		<p>
			<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
		</p>

	</form>

	<script type="text/javascript">
        document.bform.USER_LOGIN.focus();
	</script>
</div>