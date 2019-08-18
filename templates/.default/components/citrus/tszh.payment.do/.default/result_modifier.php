<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
$lastPeriod = CTszhAccountPeriod::GetList(
	Array('PERIOD_DATE' => 'DESC', 'PERIOD_ID' => 'DESC'),
	Array("ACCOUNT_ID" => $arResult['ACC']['ID'], "PERIOD_ACTIVE" => "Y", "!PERIOD_ONLY_DEBT" => "Y"),
	false,
	false,
	array("PERIOD_DATE")
)->GetNext(true, false);
$arResult['LAST_PERIOD'] = date('mY', strtotime($lastPeriod['PERIOD_DATE']));
$payment = CTszhPayment::GetList(
	array("DATE_PAYED" => "DESC"),
	array(
	"USER_ID" => $USER->GetID(),
	"PAYED" => "Y"),
	false,
	array("nTopCount" => 1),
	array("DATE_PAYED", "SUMM_PAYED"))->GetNext();
if (is_array($payment))
{
	$payment["DATE_PAYED"] = new DateTime($payment["DATE_PAYED"]);
	$arResult['LAST_PAYMENT'] = array(
		"DATE" => $payment["DATE_PAYED"]->format("d.m.Y"),
		"SUMM" => CTszhPublicHelper::FormatCurrency($payment["SUMM_PAYED"]),
	);
}
?>