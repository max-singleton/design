<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    global $USER, $APPLICATION;

if (!($GLOBALS["APPLICATION"]->arAuthResult["TYPE"] || $GLOBALS["APPLICATION"]->arAuthResult["MESSAGE"])) {

    if ($USER->IsAuthorized()) {
        $rsUserGroups = $USER->GetUserGroupEx($USER->GetID());
        while ($arGroup = $rsUserGroups->Fetch())
        {
            if (in_array($arGroup['STRING_ID'], array(
                'TSZH_SUPPORT_ADMINISTRATORS',
                'TSZH_SUPPORT_CONTRACTORS',
            )))
            {
                $personalURL = SITE_DIR . "workplace/";
                die('Redirect'.'|'.$personalURL);
            }
        }
        die('Auth' . '|' . 'Y');
    }

    if (isset($arResult['ERROR_MESSAGE']['MESSAGE']) && strlen($arResult['ERROR_MESSAGE']['MESSAGE']) > 0) {
        die($arResult['ERROR_MESSAGE']['TYPE'] . '|' . $arResult['ERROR_MESSAGE']['MESSAGE']);
    } else {
        die("ERROR" . '|' . 'Ошибка авторизации');
    }
} else {
    die($GLOBALS["APPLICATION"]->arAuthResult["TYPE"] . '|' . $GLOBALS["APPLICATION"]->arAuthResult["MESSAGE"] . '|' . $_REQUEST["USER_LOGIN"] . '|' . $APPLICATION->NeedCAPTHAForLogin($_REQUEST["USER_LOGIN"]) . "|" . $APPLICATION->CaptchaGetCode());
}
?>