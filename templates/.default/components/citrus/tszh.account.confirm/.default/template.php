<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

IncludeTemplateLangFile(__FILE__);


$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();

if (array_key_exists("ERRORS", $arResult))
{
	echo ShowError($arResult["ERRORS"]);
}
if (array_key_exists("NOTE", $arResult))
{
	?>
	<div style="margin:0 auto; width:75%; text-align: center">
		<?
		echo ShowNote($arResult["NOTE"]); ?>
	</div>
	<?
}
?>
<div>
	<?
	if ($arResult['ACC'] == 0)
	{
		?>
		<script type="text/javascript">
            $(document).ready(function () {
                $("#step0").css('display', 'none');
                // $("#result2").css('display', 'none');
                $("#step2").css('display', 'block');
                $("#error").css('display', 'block');
                $("#stepDesc0").attr('class', '');
                $("legend").text('<?=GetMessage("TAC_ADD_DATA")?>');
                $("#stepDesc2").attr('class', '');
                $("#stepDesc1").attr('class', 'current');
                $("#progress").attr('aria-valuenow', '50');
                $(".ui-progressbar-value").css('width', '50%');
                //$("#amount").text('50%');
            });
		</script>






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
?>

























		<p id="error" style="display: block; color: red">
		</p>








<div class="alert alert-info">
	<center><h1>Нажмите "Далее"</h1></center></div>
<div>
		Если поле ниже пустое, то воспользуйтесь <span style="color: red; font-size: 1.5em"><a href="/personal/confirm-account/confirm-account.php" target="_blank">этой ссылкой</a></span>, чтобы скопировать кодовое слово.
</div>












		<form id="send" method="post" action="#">
			<input type="hidden" id="word" name="word" value="1" class="code">
			<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm" class="code">
			<span class="starrequired"></span>
			<span class="title"></span>
			<input type="text" id="codr" name="regcode" value="<?=$code_uk?>" class="code"><br><br>
			<p style="text-align: right">
				<a href="<?=SITE_DIR?>personal/confirm-account/" id="step3Prev" class="form-variable__button form-variable__saved link-theme-default">
					<?=GetMessage("TAC_BUTTON_PREV")?>
				</a>
				<button type="submit" id="step3Prev1"
				        class="form-variable__button form-variable__saved link-theme-default"><?=GetMessage("TAC_BUTTON_NEXT")?></button>
			</p>
		</form>


















	<?
	}
	else
	{
	if ($_REQUEST['action'] != 'confirm')
	{
	?>

		<p> <?=GetMessage("TAC_ACCOUNTS_LIST")?> </p>
		<table class="step3data">
			<tr>
				<td>
					<label>
						<input type="checkbox" class="checkbox" checked disabled>
						<span class="checkbox-custom"></span>
					</label>
				</td>
				<td>
					<?=$arResult["ACC"]["XML_ID"]?><br>
					<span class="acc_name"><?=$arResult["ACC"]["NAME"]?></span>
				</td>
				<td class="whide">
					<?=$arResult["ACC"]["ADDRESS_FULL"]?>
				</td>
			</tr>
		</table><br><br><br>
		<form method="post" id="final" enctype="multipart/form-data" action="#center">
			<input type="hidden" id="confirm" name="action" value="confirm">
			<input type="hidden" id="pass" name="pass" value="0">
			<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm" class="code">
			<?=bitrix_sessid_post()?>
			<table class="data-table no-border">
				<tr>
					<td><input type="hidden" name="regcode" class="input" id="confirm-regcode" value="<?=$arResult["REG_CODE"]?>"></td>
				</tr>
			</table>
			<p style="text-align: right">
				<a href="<?=SITE_DIR?>personal/" id="step3Prev" class="form-variable__button form-variable__saved link-theme-default"> <?=GetMessage("TAC_BUTTON_CANCEL")?></a>

				<button class="form-variable__button form-variable__saved link-theme-default"
				        id="step3Prev1" type="submit"><?=GetMessage("TAC_BUTTON_NEXT")?></button>
			</p>
		</form>
		<?
	}
	}
	?>
</div>
