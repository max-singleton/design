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
		<div class="cssload-cube cssload-c1"></div>
		<div class="cssload-cube cssload-c2"></div>
		<div class="cssload-cube cssload-c4"></div>
		<div class="cssload-cube cssload-c3"></div>
	</div>
	<div id="SignupForm">
		<div id="progress"></div>
		<fieldset>
			<legend><?=GetMessage("TSZH_CON_CHOOSE_WAY")?></legend>
			<div style="text-align: left">
				<input type="radio" name="radio" value="bycode" id="bycode" class="radio"  checked required>
				<label for="bycode">
					<span class="title"><?=GetMessage("TSZH_CON_REGCODE")?></span>
				</label>


			</div>
		</fieldset>
		<fieldset>
			<legend><?=GetMessage("TSZH_CON_DATA_INPUT")?></legend>
			<div id="result2"></div>
		</fieldset>
		<fieldset>
			<legend><?=GetMessage("TSZH_CON_DATA_VERIFY")?></legend>
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
							<?=GetMessage("TSZH_CON_CAB_RETURN")?>
						</a>
					</p>
				</div>
			<? } ?>
		</fieldset>
	</div>
</div>