<?
CJSCore::Init(array('jquery'));
$this->addExternalCss($templateFolder . '/css/animation.css');
$this->addExternalJs($templateFolder . '/js/ui.core.js');
$this->addExternalJs($templateFolder . '/js/ui.progressbar.js');
$this->addExternalJs($templateFolder . '/js/formToWizard.js');
?>




<script type="text/javascript">

    const templateFolder = '<?=CUtil::JSEscape($templateFolder)?>';

    BX.message({
        'NEXT_TITLE': '<?=CUtil::JSEscape(GetMessage("TSZH_CON_BTN_NEXT"))?>',
        'PREV_TITLE': '<?=CUtil::JSEscape(GetMessage("TSZH_CON_BTN_PREV"))?>',
        'STEP_TITLE': '<?=CUtil::JSEscape(GetMessage("TSZH_CON_STEP"))?>',
        'CHOOSE_WAY_ERROR': '<?=CUtil::JSEscape(GetMessage("TSZH_CON_CHOOSE_WAY_ERROR"))?>'
    });

    $(document).ready(function () {



        $("#SignupForm").formToWizard({submitButton: 'SaveAccount'});

        $("input[name='radio']").click(function () {
            $("#step0Next").css('display', 'block').css('float', 'right');
            $("#firstblock").css('display', 'none');
        });

        if ($("input[name='radio']:checked").val() == undefined) {
            $("#firstblock").html("<div style='color:red' >" + BX.message('CHOOSE_WAY_ERROR') + "</div>");
            $("#step0Next").css('display', 'none');
        }
    });
</script>

<? if (isset($_REQUEST['action']) == 'confirm') { ?>
	<script type="text/javascript">
        $(document).ready(function () {
            $("#step0").css('display', 'none');
            $("#step3").css('display', 'block');
            $("#stepDesc0").attr('class', '');
            $("#stepDesc3").attr('class', 'current');
            $("#progress").attr('aria-valuenow', '100');
            $(".ui-progressbar-value").css('width', '100%');
            $("#amount").text('100%');
        });
	</script>
<? } ?>

<? if (isset($_REQUEST['word'])) { ?>
	<script type="text/javascript">
        $(document).ready(function () {
            $("#step0").css('display', 'none');
            $("#step2").css('display', 'block');
            $("#error").css('display', 'block');
            $("#stepDesc0").attr('class', '');
            $("#stepDesc2").attr('class', 'current');
            $("#progress").attr('aria-valuenow', '75');
            $(".ui-progressbar-value").css('width', '75%');
            $("#amount").text('75%');
        });
	</script>
<? } ?>





<div id="main">
	<div class="cssload-thecube" id="loading">
		<!-- анимация -->
<div id="loading">
  <img src="/img/loader.gif"/>
</div>

	</div>

<!-- 4 шага привязки лицевого счета -->
	<div id="SignupForm">


		<fieldset>
<legend>Привязка лицевого счета</legend>
<br>
<div>
		Если поле ниже пустое, то воспользуйтесь <span style="color: red; font-size: 1.5em"><a href="/personal/confirm-account/confirm-account.php" target="_blank">этой ссылкой</a></span>.
</div>
<br>

		<form id="send" method="post" action="#">
			<input type="hidden" id="word" name="word" value="" class="code">
			<input type="hidden" id="check" name="check" value="citrus:tszh.account.confirm" class="code">
			<span class="starrequired"></span>
			<span class="title"></span>

			<input type="text" id="codr" name="regcode" value="<?php
$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
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
?><?=$code_uk?>" class="code"><br><br>

<p style="text-align: right">
				<a href="<?=SITE_DIR?>personal/confirm-account/" id="step3Prev" class="form-variable__button form-variable__saved link-theme-default">
					Отмена
				</a>
				<button type="submit" id="step3Prev1"
				        class="form-variable__button form-variable__saved link-theme-default">Далее</button>
</p>
		</form>



			<!--<legend>Выберите способ привязки</legend>
			<div style="text-align: left">
				<input type="radio" name="radio" value="bycode" id="bycode" class="radio"  checked required>
				<label for="bycode">
					<span class="title">По лицевому счету</span>
				</label>
			</div>-->
		</fieldset>

		<fieldset>
<legend>Ввод данных</legend>
			<div id="result2"></div>
		</fieldset>


		<fieldset>
			<legend>Проверка данных</legend>
			<div id="result3">

				<div id="error" style="display: none">
					<?
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
					?>
				</div>
			</div>
		</fieldset>

		<fieldset>
			<legend><?=GetMessage("TSZH_CON_END")?></legend>
			<? if (isset($_REQUEST['action']) == 'confirm') { ?>
				<script>
                    $(document).ready(function () {
                        $('html, body').animate({
                            scrollTop: $(".content__padding").offset().top
                        }, 5);
                    });
				</script>
				<div id="result4">
					<p style="text-align:center" name="center"><?=GetMessage("TSZH_CON_SUCCESS")?></p>
					<p>
						<a href="/personal/" class="form-variable__button form-variable__saved link-theme-default"
						   style="float:right; color: #fff !important; text-align:center;">
							Перейти в личный кабинет
						</a>
					</p>
				</div>
			<?
header('Location: /personal/info');
 } ?>
		</fieldset>
	</div>
</div>
