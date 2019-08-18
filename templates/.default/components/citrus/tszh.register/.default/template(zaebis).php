<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

CJSCore::Init(array("jquery"));

global $arrResult;
$arrResult = $arResult;


$arFieldsByGroup = Array(
	Array(
		'TITLE' => GetMessage("REGISTER_GROUP_1"),
		'FIELDS' => Array(
			'LOGIN',
			'PASSWORD',
			'CONFIRM_PASSWORD',
		),
	),
	Array(
		'TITLE' => GetMessage("REGISTER_GROUP_2"),
		'FIELDS' => Array(
			'NAME',
			'SECOND_NAME',
			'LAST_NAME',
			'EMAIL',
			'PERSONAL_PHONE',
			'PERSONAL_CITY',
			'PERSONAL_STREET',
		),
		'PROPERTIES' => Array(
			"UF_ACCOUNT",
		),
	),
);

function ShowField($FIELD)
{
	global $arrResult, $APPLICATION;

	if (substr($FIELD, 0, strlen('UF_')) == 'UF_')
	{

		$arUserField = $arrResult['USER_PROPERTIES']['DATA'][$FIELD];
		$APPLICATION->IncludeComponent(
			"bitrix:system.field.edit",
			$arUserField["USER_TYPE"]["USER_TYPE_ID"],
			array(
				"bVarsFromForm" => $arrResult["bVarsFromForm"],
				"arUserField" => $arUserField,
				"form_name" => "system_register_form"),
			null,
			array(
				"HIDE_ICONS" => "Y",
			)
		);
	}
	else
	{
		switch ($FIELD)
		{
			case "PASSWORD":
			case "CONFIRM_PASSWORD":
				?><input type="password" name="REGISTER[<?=$FIELD?>]" class="window__input"><?
				break;

			case "PERSONAL_GENDER":
				?><select name="REGISTER[<?=$FIELD?>]" class="window__input">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arrResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arrResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
				</select><?
				break;

			case "PERSONAL_COUNTRY":
				?><select name="REGISTER[<?=$FIELD?>]" class="window__input"><?
				foreach ($arrResult["COUNTRIES"]["reference_id"] as $key => $value)
				{
					?>
					<option value="<?=$value?>"<? if ($value == $arrResult["VALUES"][$FIELD]): ?> selected="selected"<? endif ?>><?=$arrResult["COUNTRIES"]["reference"][$key]?></option>
					<?
				}
				?></select><?
				break;

			case "PERSONAL_PHOTO":
			case "WORK_LOGO":
				?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" class="window__input"><?
				break;

			case "PERSONAL_NOTES":
			case "WORK_NOTES":
				?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]" class="window__input"><?=$arrResult["VALUES"][$FIELD]?></textarea><?
				break;
                        case "PERSONAL_PHONE":
                            ?>

                            <div style="position: relative">
                            <input type="text" id="customer_phone" placeholder="Телефон" value="+7" class="window__input"><br>
                            <?// форма для ввода и проверки формата телефона?>
                            <input type="hidden" id="phone_mask_nahujnado" checked=""><label id="descr" for="phone_mask"></label>
                            <input type="hidden" id="phoneId" name="REGISTER[<?=$FIELD?>]" value="<?=$arrResult["VALUES"][$FIELD]?>">
                            </div>

                            <?//фактическое место хранение телефонного номера (хранится без каких-либо масок ввода)?>
                            <?
                            break;
			default:
				if ($FIELD == "PERSONAL_BIRTHDAY"):?>
					<small><?=$arrResult["DATE_FORMAT"]?></small><br><?endif;
				?>








<input id="probel_<?=$FIELD?>" class="window__input" type="text" maxlength="50"  name="REGISTER[<?=$FIELD?>]" value="<?php echo trim($arrResult["VALUES"][$FIELD]); ?>" placeholder="<?=GetMessage("REGISTER_FIELD_" . $FIELD)?>">







<?
				if ($FIELD == "PERSONAL_BIRTHDAY")
				{
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'system_register_form',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N',
						),
						null,
						array("HIDE_ICONS" => "Y")
					);
				}

		}
	}

    if (strlen(GetMessage("REGISTER_FIELD_" . $FIELD . '_NOTE')) > 0) {
        ?>
        <div class="block-register-form__note"> <?= GetMessage("REGISTER_FIELD_" . $FIELD . '_NOTE') ?> </div><?
    }

    if (strlen($arrResult['ERRORS'][$FIELD]) > 0) {
        ?>
        <div class="block-register-form__error"><?= $arrResult["ERRORS"][$FIELD] ?> </div><?
        unset($arrResult['ERRORS'][$FIELD]);
    }
}

function ShowFieldTitle($FIELD)
{
    global $arrResult;

    $arCustomTitles = Array();

    if (substr($FIELD, 0, strlen('UF_')) == 'UF_') {
        $arUserField = $arrResult['USER_PROPERTIES']['DATA'][$FIELD];

        if (array_key_exists($FIELD, $arCustomTitles)) {
            echo $arCustomTitles[$FIELD] . ':';
        } else {
            echo $arUserField["EDIT_FORM_LABEL"] . ':';
        }

        if ($arUserField["MANDATORY"] == "Y") {
            echo '<span class="window__input-star">*</span>';
        }
    } else {
        echo GetMessage("REGISTER_FIELD_" . $FIELD) . ':';
        if ($arrResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y")
            echo '<span class="window__input-star">*</span>';

    }
}

function in_array_r($array, $item)
{
    $i = 0;
    do {
        $j = 0;
        do
            if (($array[$i]['FIELDS'][$j] == $item) || ($array[$i]['PROPERTIES'][$j] == $item))  return true;
        while (++$j < max(count($array[$i]['FIELDS']),count($array[$i]['PROPERTIES'])));
    } while (++$i < count($array));
    return false;
}
?>

<form class="block-register-form" name="block-register-form<?= $arResult["RND"] ?>" method="post" target="_top" action="/?login=yes">

    <? if (!empty($arParams["PROFILE_URL"])): ?>
        <input type="hidden" name="tourl" value="<?= $arParams["PROFILE_URL"] ?>"/>
    <? endif ?>

    <input type="hidden" name="AUTH_FORM" value="Y"/>
    <input type="hidden" name="TYPE" value="TSZHREGISTRATION"/>
    <div class="window__title"><?= getMessage("AUTH_REGISTER") ?></div>
	<div class="block-register-form__error_main">
		<p><font color="#000">Уважаемые пользователи, для входа на наш новый сайт достояние-наследие.рф логин и пароль с сайта etker21.ru не подходит. Для удобного пользования возможностями сайта и личным кабинетом вам необходимо заново пройти регистрацию на сайте.
		</font></p></div>
    <!-- <div class="window__hr"></div> -->

<!-- 
<div class="window__block">
	<div class="window__input-name">Ваш лицевой счет:<span class="window__input-star">*</span>
	</div>
	<input class="window__input" type="text" maxlength="6" name="licevoj" value="" placeholder="Лицевой счет из квитанции">
	<div class="block-register-form__note"> только последние 6 цифр </div>
</div>
 -->

<div class="register_message">
    <?
    if (isset($_GET['registerSuccess']) && $_GET['registerSuccess'] = 'yes') {
        $emailConfirmation = COption::GetOptionString("main", "new_user_registration_email_confirmation", "N") == "Y";
        ?>
        <div class="block-register-form__register_email"> <?= GetMessage("REGISTER_EMAL_CONFIRMATION") ?> </div><?
        if ($emailConfirmation)
            return;
    }
    ?>

    <?
    if (count($arrResult["ERRORS"]) > 0) {
        foreach ($arrResult["ERRORS"] as $key => $error)
            if (intval($key) <= 0)
                $arrResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
        ?>
        <div class="block-register-form__error_main"><?= GetMessage("REGISTER_FORM_SEND_ERROR") ?> </div><?

        foreach ($arrResult['ERRORS'] as $key => $FIELD) {
            if (!in_array_r($arFieldsByGroup, (string)$key)) {
                ?>
                <div class="window__block block-register-form__error form__error_main_add"><?= $arrResult["ERRORS"][$key]; ?> </div><?
                unset($arrResult['ERRORS'][$key]);
            }
        }
    }
    ?>

    </div>
    <div class="window__register_field">
        <?
        foreach ($arFieldsByGroup as $arFieldGroup) {
            ?>
            <div class="window__inputs">
                <div class="window__fieldgroup"><?= $arFieldGroup['TITLE'] ?></div>
                <?
                if (is_array($arFieldGroup['FIELDS'])) {
                    foreach ($arFieldGroup['FIELDS'] as $key => $FIELD) {
                        if (!in_array($FIELD, $arrResult['SHOW_FIELDS'])) continue;
                        ?>
                        <div class="window__block">
                            <div class="window__input-name"><?= ShowFieldTitle($FIELD) ?></div>
                            <?
                            ShowField($FIELD);
                            if (strlen($arrResult['ERRORS'][$FIELD]) > 0) {
                                ?>
                                <div class="block-register-form__error"><?= $arrResult["ERRORS"][$FIELD] ?> </div><?
                                unset($arrResult['ERRORS'][$FIELD]);
                            }
                            ?>
                        </div>
                        <?
                    }
                }

                if (is_array($arFieldGroup['PROPERTIES'])) {
                    foreach ($arFieldGroup['PROPERTIES'] as $key => $sProperty) {
                        $arUserField = $arrResult['USER_PROPERTIES']['DATA'][$sProperty];
                        if (!is_array($arUserField)) {
                            continue;
                        }
                        ?>
                        <div class="window__block">
                            <div class="window__input-name">
                                <?= $arUserField["EDIT_FORM_LABEL"] ?>:<? if ($arUserField["MANDATORY"] == "Y"): ?><span
                                        class="window__input-star">*</span><? endif; ?>
                            </div>
                            <div>
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                    array(
                                        "bVarsFromForm" => $arrResult["bVarsFromForm"],
                                        "arUserField" => $arUserField,
                                        "form_name" => "regform",
                                    ), null, array("HIDE_ICONS" => "Y")); ?>
                                <?

                                if (strlen($arrResult['ERRORS'][$FIELD]) > 0) {
                                    ?>
                                    <div class="block-register-form__error"><?= $arrResult["ERRORS"][$FIELD] ?> </div><?
                                    unset($arrResult['ERRORS'][$FIELD]);
                                }
                                ?>
                            </div>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
            <?
        }

        /* CAPTCHA */
        if ($arrResult["USE_CAPTCHA"] == "Y") {
            ?>
            <div class="window__inputs">
                <div class="window__fieldgroup"><?= GetMessage("REGISTER_CAPTCHA_TITLE") ?></div>

                <div class="window__block">
                    <div class="window__input-name block-register-form_captcha"><input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"] ?>"/>
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?
                        echo $arResult["CAPTCHA_CODE"] ?>" alt="CAPTCHA"></div>
                    <div><input class="window__input block-register-form_captcha_input" type="text" name="captcha_word" maxlength="50" value="" size="15" placeholder="<?
                        echo GetMessage("REGISTER_CAPTCHA_PROMT") ?>"></div>
                </div>
            </div>
            <?
        }
        /* CAPTCHA */


        ?>

        <? if ($arResult["CONFIRM_TSZH"] == "Y") {
            ?>
            <div class="window__inputs">
                <div class="window__block register__confirm">
                    <div class="input-checkbox register-checkbox"><input name="register-confirm" type="checkbox" id="register-confirm" required>
                        <label for="register-confirm">&nbsp;</label>
                    </div><?= $arResult["TSZH_DATA"]["~CONFIRM_TEXT"] ?></div>
            </div>

            <?
        }
        ?>

        <div class="window__block">

            <input type="hidden" name="register_submit_button" value="Y">
            <input class="window__button" type="submit" onclick="getValuePhone();lorem_del_spaces();probel()" value="<?= getMessage("AUTH_REGISTER_BUTTON") ?>">
        </div>
    </div>

</form>


<script type="text/javascript">


    function getValuePhone() {
        document.getElementById('phoneId').value = document.getElementById('customer_phone').value;
    }

    function getValueMask() {
        var listCountries = $.masksSort($.masksLoad("<?= $this->GetFolder() ?>/json/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
        var maskOpts = {
            inputmask: {
                definitions: {
                    '#': {
                        validator: "[0-9]",
                        cardinality: 1
                    }
                },
                showMaskOnHover: false,
                autoUnmask: true,
                clearMaskOnLostFocus: false
            },
            match: /[0-9]/,
            replace: '#',
            listKey: "mask"
        };

        var maskChangeWorld = function (maskObj, determined) {
            if (determined) {
                var hint = maskObj.name_ru;
                if (maskObj.desc_ru && maskObj.desc_ru != "") {
                    hint += " (" + maskObj.desc_ru + ")";
                }
                $("#descr").html(hint);
            } else {
                $("#descr").html("");
            }
        }

        $('#phone_mask, input[name="mode"]').change(function () {
            $('#customer_phone').inputmasks($.extend(true, {}, maskOpts, {
                list: listCountries,
                onMaskChange: maskChangeWorld
            }));
        });

        $('#phone_mask').change();

    }

    $(window).on('load', function () {
            getValueMask();
			
        }
    )

</script>

<script>
    BX.message({REGISTER_SUCCEEDED:'<?=Bitrix\Main\Localization\Loc::getMessage("REGISTER_SUCCEEDED")?>'});

    function SubmitButtonEvent() {
        $(document).ready(function () {
                $('.block-register-form').each(
                    function () {
                        $(this).submit(
                            function () {
                                var submitButton = $(this).find('input[type=submit]');
                                $(submitButton).toggleClass('tszh-auth__lg-progress');
                                $.post(tszh.siteDir + 'ajax/auth.php', $(this).serialize(),
                                    function (response) {
                                        if (response == "Auth|Y") {
                                            $('.block-register-form').find('.register_message')[0].style.display = "none";
                                            $(".window__register_field")[0].innerHTML = BX.message("REGISTER_SUCCEEDED");

                                            window.scroll(0,0);
                                            setTimeout(function() {
                                                $(".block-register-form").find(".window__close").click();
                                                var tourl =  $(".block-register-form").find('input[name="tourl"]').val();
                                                window.location.href = tourl !== undefined ? tourl : window.location.href;
                                            }, 3000);
                                        }
                                        else {
                                            BX('window-register-container').innerHTML = response;
                                            getValueMask();
                                            SubmitButtonEvent();
                                            window.scroll(0,0);
                                        }

                                    }, 'html');

                                return false;
                            });
                    }
                );
            }
        )
    }

    $(document).ready(function () {

		$("#probel_EMAIL").change(function() {
    	var re=/[ ]/;
    	var val=$("#probel_EMAIL").val().replace(re, '');
    	$("#probel_EMAIL").val(val);
	});

$("#probel_EMAIL").keyup(function() {
    $("#probel_EMAIL").change();
});


        SubmitButtonEvent();
    });

</script>