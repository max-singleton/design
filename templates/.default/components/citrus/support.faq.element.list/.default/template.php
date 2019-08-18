<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//elements list?>
	<a name="top"></a>
	<ul id="private-issues">
		<?foreach ($arResult['ITEMS'] as $key=>$val):?>
			<li class="point-faq"><a href="#<?=$val["ID"]?>" title="<?=htmlspecialcharsbx(strip_tags($val['PREVIEW_TEXT']))?>"><?=TruncateText($val['PREVIEW_TEXT'], 100)?></a><br/></li>
		<?endforeach;?>
	</ul>
	<div class="dotted"></div>
<?foreach ($arResult['ITEMS'] as $key=>$val):

	$this->AddEditAction($val['ID'], $val['EDIT_LINK'], CIBlock::GetArrayByID($val["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($val['ID'], $val['DELETE_LINK'], CIBlock::GetArrayByID($val["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	?>
	<div class="faq-element" id="<?=$this->GetEditAreaId($val['ID']);?>">
		<a name="<?=$val["ID"]?>"></a>

		<p>
			<strong><?=GetMessage("T_FAQ_QUESTION")?>:</strong><?
			if (isset($val["DATE_CREATE"]))
				echo '<br><i>' . ConvertDateTime($val["DATE_CREATE"], "DD.MM.YYYY") . '</i>';
			?>
			<br />
			<em><?=$val['PREVIEW_TEXT']?></em>
		</p>
		<?if ($val['DETAIL_TEXT_TYPE'] == 'text'):?>
			<p>
				<strong><?=GetMessage("T_FAQ_ANSWER")?>:</strong><br />
				<?
				if (isset($val["PROPERTY_ANSWER_DATE_VALUE"]))
					echo '<i>' . ConvertDateTime($val["PROPERTY_ANSWER_DATE_VALUE"], "DD.MM.YYYY") . '</i><br>';
				?>
				<?=$val['DETAIL_TEXT']?>
			</p>
		<?else:?>
			<div>
				<p style="margin-bottom: -1em;"><strong><?=GetMessage("T_FAQ_ANSWER")?>:</strong></p>
				<?=$val['DETAIL_TEXT']?>
			</div>
		<?endif;?>
		<a href="#top"><?=GetMessage("SUPPORT_FAQ_GO_UP")?></a>
		<div class="dotted"></div>
	</div>
<?endforeach;?>