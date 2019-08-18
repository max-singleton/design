<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$frame = $this->createFrame()->begin(getMessage("T_AUTH_PROMPT"));
?>
<?if($arResult["FORM_TYPE"] == "login"):?>
	<div class="shadow hidden"></div>				
		<div class="window hidden" id="window-auth">
			<div class="window__close">X</div>
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
					<!--CAPTCHA-->
					<div class="window__block" id="block_captcha_word" <? echo strlen($arResult["CAPTCHA_CODE"]) > 0 ? '' : 'style="display: none;"'; ?>>
						<div class="window__input-name">
							<?=GetMessage("AUTH_CAPTCHA_PROMT")?>
							<span class="window__input-star">*</span>
						</div>
						<input class="window__input" type="text" name="captcha_word" id="captcha_word" placeholder="" value="""/>
					</div>
					<div class="window__block" id="block_captcha_img" <? echo strlen($arResult["CAPTCHA_CODE"]) > 0 ? '' : 'style="display: none;"'; ?>>
						<div class="window__input-name"> &nbsp;
						</div>
						<img id="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" class="window__captcha-img"
						     alt="CAPTCHA"/>
						<input type="hidden" name="captcha_sid" id="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
					</div>
					<!---->
				</div>
				<div class="window__checkform">
					<input class="window__checkbox" id="checkbox" type="checkbox" name="USER_REMEMBER"> 
					<label for="checkbox" class="window__checkbox-text">
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
				<a class="window-close window__info-link" onclick='$("#contact-user-name").focus()' href="#contact"><?=getMessage("AUTH_CONTACT_OUR_OFFICE")?></a>
			</div>
		</div>


    <!-------------------------------------------->
    <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
    <div class="window hidden" id="window-register">
        <div class="window__close">X</div>

        <div id="window-register-container">

        <?
        $optionPhoneAdd = (COption::GetOptionString('citrus.tszh', 'input_phone_add', "Y") == "Y");
        $optionPhoneRequired = (COption::GetOptionString('citrus.tszh', 'input_phone_require', "Y") == "Y");

        $arSF = Array(
        "NAME",
        "SECOND_NAME",
        "LAST_NAME",
        );
        if ($optionPhoneAdd)
        {
        $arSF[] = "PERSONAL_PHONE";
        }

        $arRF = Array(
        "NAME",
        "LAST_NAME",
        );

        if ($optionPhoneAdd && $optionPhoneRequired)
        {
        $arRF[] = "PERSONAL_PHONE";
        }

        $APPLICATION->IncludeComponent(
        "citrus:tszh.register",
        "",
        Array(
        "USER_PROPERTY_NAME" => "",
        "SEF_MODE" => "N",
        "SHOW_FIELDS" => $arSF,
        "REQUIRED_FIELDS" => $arRF,
        "AUTH" => "Y",
        "USE_BACKURL" => "N",
        "PROFILE_URL" => SITE_DIR .  "personal/info/",
        "SUCCESS_PAGE" => $APPLICATION->GetCurPageParam('registerSuccess=yes', array('backurl', 'register')),
        "USER_PROPERTY" => Array(
        "UF_ACCOUNT",
        ),
        )
        ); ?>
        </div>
        <br>

    </div>
    <?endif;?>
			<!-------------------------------------------->
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
					<div class="window__inputs" id="window__inputs-recovery">
						<div class="window__block">
							<div class="window__input-name_pas"><?=getMessage("AUTH_LOGIN")?> <span class="window__input-star">*</span></div>
							<input class="window__input" type="text" name="USER_LOGIN" placeholder="">
						</div>
						<div class="window__block">
							<div class="window__input-name_pas">E-Mail <span class="window__input-star">*</span></div>
							<input class="window__input" type="text" name="USER_EMAIL" placeholder="">
						</div>
						<? if (COption::GetOptionString("main", "captcha_restoring_password", "N") == "Y"): ?>
							<div class="window__block">
								<div class="window__input-name_pas"><?=GetMessage("AUTH_CAPTCHA_PROMT")?><span class="window__input-star">*</span></div>
								<input class="window__input" type="text" name="captcha_word" id="captcha_word" placeholder=""/>
							</div>
						
							<div class="window__block">
								<div class="window__input-name_pas">
									<input type="hidden" name="captcha_sid" id="captcha_sid"
										   value="<?=$capcha = htmlspecialcharsbx($APPLICATION->CaptchaGetCode())?>"/>
									<input id="temp" type="hidden" value="<?=$this->GetFolder()?>">
								</div>
								<img id="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$capcha?>" width="180" height="40" alt="CAPTCHA"/>
							</div>
						<? endif ?>
					</div>		
					<div class="window__control">
						<input class="window__sendbutton" type="submit" id="window__sendbutton-recovery" value="<?=GetMessage("AUTH_SEND_BUTTON")?>">
						<div class="window__text_or" id="window__text_or-recovery"><?=getMessage("OR")?></div>
						<a class="window__enter window-open" href="javascript:void(0)" window="window-auth" id="window__enter-recovery"><?=getMessage("AUTH_LOGIN_BUTTON")?></a>
					</div>
                    <div class="block-password-recovery-form__error">
                    </div>
                    <div class="block-password-recovery-form__account_info_sent">
                    </div>
				</form>
			</div>

        <span class="top-line__right">

			    <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                    <span class="top-line__link"><a class="window-open" href="javascript:void(0)" window="window-register"><?=getMessage("AUTH_REGISTER")?></a></span> |

                <?endif;?>
            <span class="top-line__link "><a class="window-open " href="javascript:void(0)" window="window-auth"><?=getMessage("AUTH_AUTH")?></a></span>

             </span>

<?else:?>
    <span class="top-line__right"><span class="top-line__link"><a href="<?=$arParams["PROFILE_URL"]?>"><?=(strlen($arResult["USER_NAME"]) > 0 ? $arResult["USER_NAME"] : $arResult["USER_LOGIN"])?></a> </span>|<span class="top-line__link"> <a href="<?=$APPLICATION->GetCurPageParam('logout=yes', Array('logout'))?>"><?=getMessage("AUTH_LOGOUT_BUTTON")?></a></span>
<?endif;?>
<script type="text/javascript">
	var tszh = {};
    tszh.siteDir = <?=\Bitrix\Main\Web\Json::encode(SITE_DIR)?>;
</script>
