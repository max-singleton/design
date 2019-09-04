<?php
/*$t = ini_get_all('mbstring');
if ($t["mbstring.func_overload"]["global_value"] != 0)
{
	header('Content-type: text/html; charset=windows-1251');
}*/
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("");

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

CModule::IncludeModule('citrus.tszh');

switch ($_REQUEST["action"])
{
	case "tostep2":
		if ($_POST['name'] == 'bycode') : ?>			<div>
				<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm">

<div>
	<h4 class="alert alert-info">Тут вставьте скопированный код:</h4>
</div>



				<div class="wrap">
					<input type="text" id="codr" name="regcode" value="*" class="code">
				</div>







				<? unset($_REQUEST); ?>
			</div>
		<? endif;
		if ($_POST['name'] == 'bypass') : ?>
			<table style="width: 100%">
				<tr>
					<td class="span">
						<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm_code">
						<span class="title"><?=Loc::getMessage("CONFIRM_STEPS_ENTER_LOGIN")?></span>
					</td>
					<td>
						<input id="codr" type="text" name="regcode" value="" class="code">
					</td>
				</tr>
				<tr>
					<td class="span">
						<span class="title"><?=Loc::getMessage("CONFIRM_STEPS_ENTER_PASSWORD")?></span>
					</td>
					<td>
						<input id="pass" type="password" name="password" value="" class="code">
					</td>
				</tr>
			</table>
			<br><br>
		<? endif;
		break;
	case "tostep3":
		if (in_array($_REQUEST['check'], array("citrus:tszh.account.confirm", "citrus:tszh.account.confirm_code")))
		{
			$APPLICATION->IncludeComponent(
				$_REQUEST['check'],
				"",
				Array(
					"REGCODE_PROPERTY" => "UF_REGCODE",
				)
			);
		}
		break;
}