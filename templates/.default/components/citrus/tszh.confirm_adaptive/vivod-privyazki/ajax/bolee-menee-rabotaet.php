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


    $rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
//print_r($arUser);




CModule::IncludeModule('citrus.tszh');




switch ($_REQUEST["action"])
{
	case "tostep2":
		if ($_POST['name'] == 'bycode') : ?>

<?php
$var=$arUser['UF_LIC'];
//Далее будет велосипед
//Открываем соединие и просим указать пользователя лицевой счет. На основе этого узнаем ID сайте
$link = mysqli_connect('localhost', 'admin_etkeruser', 'pgST3VePR8', 'admin_etker');
$sql1 = 'SELECT `ID` FROM `b_tszh_accounts` WHERE `XML_ID`='."$var";
$obj1 = mysqli_query($link, $sql1);
$res1 = mysqli_fetch_all($obj1);
foreach($res1 as $myarr){
	foreach($myarr as $eto){
	$id_from_site = $eto;
}
}


//Узнаем кодовое слово для привязки лицевого счета с помощью ID сайте
$sql2 = 'SELECT `UF_REGCODE` FROM `b_uts_tszh_account` WHERE `VALUE_ID`='."$id_from_site";
$obj2 = mysqli_query($link, $sql2);
$res2 = mysqli_fetch_all($obj2);
foreach($res2 as $myarr){
	foreach($myarr as $eto){
	$code_uk = $eto;
}
}
//Закрываю соединеие с БД, потому что много открытых соединений с БД - это плохо
//Выдает ошибку при mysql_close($link). Тогда пусть нафиг идет это Bitrix-говно

$GLOBALS['lic'] = $code_uk;
$GLOBALS['regcode'] = $code_uk;
?>

<div>
	<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm">
	<div class="alert alert-info">
		<center><h1>Нажмите "Далее"</h1></center>
	</div>
	<div>Если поле ниже пустое, то воспользуйтесь
		<span style="color: red; font-size: 1.5em">
				<a href="/personal/confirm-account/confirm-account.php" target="_blank">
					этой ссылкой
				</a>
		</span>, чтобы скопировать кодовое слово.
	</div>


		<form id="send" method="post" action="#">
			<input type="hidden" id="word" name="word" value="" class="code">
			<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm" class="code">
			<span class="starrequired"></span>
			<span class="title"></span>
			<input type="text" id="codr" name="regcode" value="<?=$code_uk?>" class="code"><br><br>
		</form>



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