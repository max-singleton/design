<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

IncludeTemplateLangFile(__FILE__);

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
		<p id="error" style="display: block; color: red">
			<?=GetMessage("TAC_ERROR_TEXT")?>
		</p>
		<form id="send" method="post" action="#">
			<input type="hidden" id="word" name="word" value="1" class="code">
			<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm" class="code">
			<span class="starrequired">*</span>
			<span class="title"><?=GetMessage("TAC_ACCOUNTS_CODE")?>:</span>
			<input type="text" id="codr" name="regcode" value="" class="code"><br><br>
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
