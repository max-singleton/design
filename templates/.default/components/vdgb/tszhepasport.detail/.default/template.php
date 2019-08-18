<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

CJSCore::Init(array('jquery'));
if ($_GET['home-id']): ?>
	<div class="page-house-info">
		<div id='menu-area'>
			<div class="home-adress main-border">
				<a href="<?=SITE_DIR?>epassports/"><img></a>
			</div>
		</div>
		<script type="text/javascript">
            var arResult = <?=\Bitrix\Main\Web\Json::encode($arResult); ?>;
            var home_id = <?=\Bitrix\Main\Web\Json::encode($arResult["ID"]); ?>;
            var componentPath = <?=\Bitrix\Main\Web\Json::encode($componentPath); ?>;
            var templatePath = "<?=$this->GetFolder()?>";
            var arMapControls = <?=\Bitrix\Main\Web\Json::encode($arParams["MAPCONTROLS"]); ?>;
            var points = arCoordinates = <?=\Bitrix\Main\Web\Json::encode(array(
				$arResult['EP_LONGITUDE'],
				$arResult['EP_LATITUDE'],
			)); ?>;
		</script>
		<div class='subsection'>
			<div class="subsection__info">
				<div>
					<img class='house-image'
					     src='<? echo ($arResult['EP_HOUSE_IMAGE_SRC'] != null) ? $arResult['EP_HOUSE_IMAGE_SRC'] : $componentPath . "/images/home_default_image.png"; ?>'>
				</div>
				<div style='vertical-align: top'>
					<h2 style="margin-top: 20px"><b><?=GetMessage("MAIN_HOUSE_INFORMATION")?></b></h2>
					<div class="table">
						<?
						foreach ($arResult["TABLE"] as $homeField => $homeValue):
							?>
							<div class="table__row">
								<div class='table__cell'>
									<?=GetMessage($homeField)?>
								</div>
								<div class='table__cell'>
									&nbsp;<?=strlen($homeValue) > 0 ? $homeValue : GetMessage("EP_NO_INFORMATION")?>
								</div>
							</div>
						<? endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<?
		$pos = strripos($_SERVER['REQUEST_URI'], '?');
		$rest = substr($_SERVER['REQUEST_URI'], 0, $pos);

		if (!empty($arResult["HTML"])):
			foreach ($arResult["HTML"] as $arHtmlBlock):?>
				<h2 id="<?=$arHtmlBlock["ATR"]?>"><?=$arHtmlBlock["NAME"]?></h2>
				<div class="overflowx_auto">
					<?=$arHtmlBlock["THIS"]?>
				</div>
			<? endforeach ?>
		<? endif ?>
	</div>
<? endif ?>