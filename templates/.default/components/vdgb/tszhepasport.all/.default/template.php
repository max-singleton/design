<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$this->addExternalJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
?>
<script type="text/javascript">
	<? unset($arResult["EP_HTML"]); ?> //чтобы не передавать на страницу весь html-код, генерируемый 1C
    var arResult = <?echo $enc_value = \Bitrix\Main\Web\Json::encode($arResult, $options = null);?>;
    var arMapControls = <?echo $enc_value = \Bitrix\Main\Web\Json::encode($arParams["MAPCONTROLS"], $options = null);?>;
    var arCoordinates = <?echo $enc_value = \Bitrix\Main\Web\Json::encode($arResult["COORDINATES"], $options = null);
		?>;
    var componentPath = <?echo $enc_value = \Bitrix\Main\Web\Json::encode($componentPath, $options = null);?>;
    var points = arCoordinates;
</script>
<? if (!$_GET['home-id']): ?>
	<? CJSCore::Init(array('ymaps_js')); ?>
	<? if ((isset($arResult["WARNINGS"])) && ($USER->IsAdmin())): ?>
		<div id="warning" class="warning">
			<div class="warning-close" onclick="document.getElementById('warning').style.display ='none';">x</div>
			<?=GetMessage('WARNING_PART_1')?><?=$arResult["WARNING_HOUSES"]?><?=GetMessage('WARNING_PART_2')?><br>
			<?
			$i = 0;
			while ($i < count($arResult["WARNINGS"]) && $i != 5)
			{
				echo ($i + 1) . ') ' . $arResult["WARNINGS"][$i];

				$i++;

				if ($i != count($arResult["WARNINGS"]) && $i != 5)
				{
					echo "<br>";
				}
			}
			if (count($arResult["WARNINGS"]) > 5)
			{
				echo "<br>...";
			}
			?>
			<?=GetMessage('WARNING_PART_3')?>
		</div>
	<? endif ?>
	<div class="homes">
		<div id="first_map">
		</div>
		<div class="list-homes">
			<div class="list-homes-header">
				<img class="main-bg lupa" src="<?=$componentPath?>/images/lupa.png?<?=rand()?>">
				<input class="val_text" type="text" value="" placeholder="<?=GetMessage("ADRESS_SEARCH")?>">
			</div>
			<div class="spisok">
				<div class="donego main-bg"><img src="<?=$componentPath?>/images/vverh-s.png?<?=rand()?>"></div>
				<div class="esche main-bg"><img src="<?=$componentPath?>/images/vniz-s.png?<?=rand()?>"></div>
				<div class="spisoksok">
					<? for ($i = 0; $i < count($arResult['EP_ADDRESS']); $i++): ?>
						<div id="element_<?=$arResult['ID'][$i]?>" class="element-spisok">
							<div class="pre-arrow" onclick=init("<?=$i?>","0");>
								<?=$arResult['EP_ADDRESS'][$i]?>
							</div>
							<div class="arrow">
								<a style="color:#000;text-decoration:none;" href="?home-id=<?=$arResult['ID'][$i]?>">
									<img class="arrowclass" src="<?=$componentPath?>/images/arrow_notactive.png?<?=rand()?>">
								</a>
							</div>
						</div>
					<? endfor ?>
					<div style='clear: both;'></div>
				</div>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div id="detaile-descr">
	</div>
	</div>
<? endif ?>

<script type="text/javascript" src="<?=$componentPath?>/templates/.default/search-home.js"></script>
<script type="text/javascript" src="<?=$componentPath?>/templates/.default/list-scroll.js"></script>
<!--<script type="text/javascript" src="/bitrix/components/vdgb/tszhepasport/templates/.default/script.js">-->