<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
    <div class="tszh-payment-select-box">
        <label for="receipt_type" class="tszh-payment-select-box__label"><?= GetMessage("TSZH_PAYMENT_RECEIPT_TYPE") ?></label>
        <div class="tszh-payment-select-box__select combobox">
            <select name="receipt_type" id="receipt_type">
                <?php foreach ($arResult['receipt_types'] as $type) : ?>
                    <option value="<?=$type['url']?>" <?=$type['selected'] ? "selected" : "" ?>><?=$type['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="tszh-payment-select-box">
        <label for="tszh_id_pay" class="tszh-payment-select-box__label"><?= GetMessage("TSZH_PAYMENT_TSZH") ?></label>
        <div class="tszh-payment-select-box__select combobox">
            <select name="tszh_id_pay" id="tszh_id_pay">
                <?php foreach ($arResult['tszh_list'] as $tszh) : ?>
                    <option value="<?=$tszh['url']?>" <?=$tszh['selected'] ? "selected" : "" ?>><?=$tszh['NAME']?> (<?=$tszh['RSCH']?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <script type="text/javascript">
        BX.ready(function () {
            BX.bind(BX('receipt_type'), 'bxchange', function () {
                window.location = BX('receipt_type').value;
            });
            BX.bind(BX('tszh_id_pay'), 'bxchange', function () {
                window.location = BX('tszh_id_pay').value;
            });
        });
    </script>
<?

if (count($arResult['PAY_SYSTEMS']) <= 0) {
	ShowError(GetMessage("TSZH_PAYMENT_NO_PAY_SYSTEMS"));
	return;
}

if($arParams["DISPLAY_TOP_PAGER"]) {
	echo $arResult["NAV_STRING"];
}

foreach ($arResult['PAY_SYSTEMS'] as $key=>$arPaySystem):

	if ($_SERVER["REQUEST_METHOD"] == "POST" && IntVal($_POST["pay_system_id"]) != $arPaySystem['ID'] && $USER->IsAuthorized())
		continue;

?>

	<div class="payment">
<?$APPLICATION->IncludeComponent(
	"citrus:tszh.payment.do",
	".default",
	Array(
		"MINIMUM_SUMM" => $arPaySystem["ACTION_FILE"] == "/bitrix/modules/citrus.tszhpayment/ru/payment/moneta" ? CTszhPaymentGatewayMoneta::getInstance()->getMinPaymentSum() : "0",
		"PAY_SYSTEM" => $arPaySystem["ID"],
		"AMOUNT_TO_SHOW" => is_set($_GET["summ"]) && is_numeric($_GET["summ"]) ? $_GET["summ"] : '',
		"TSZH_ID" => $arPaySystem["TSZH_ID"],//is_set($arResult, "FILTER") && is_set($arResult["FILTER"], "TSZH_ID") ? $arResult["FILTER"]["TSZH_ID"] : false,
	),
	$component,
	Array("HIDE_ICONS" => "Y")
);?>
    <div class="payment__description">
    <?=$arPaySystem['DESCRIPTION']?>
    </div>
</div>
<?
endforeach;



if($arParams["DISPLAY_BOTTOM_PAGER"]) {
	echo $arResult["NAV_STRING"];
}
?>