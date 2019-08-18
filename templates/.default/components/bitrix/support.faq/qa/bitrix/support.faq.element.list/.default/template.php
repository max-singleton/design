<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?//elements list?>
<a name="top"></a>
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
	<li class="point-faq"><a href="#<?=$val["ID"]?>"><?=$val['NAME']?></a><br/></li>
<?endforeach;?>
<br/>
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
<a name="<?=$val["ID"]?>"></a>

<p>
	<strong><?=GetMessage("T_FAQ_QUESTION")?>:</strong<?
		//add edit element button
		if(isset($val['EDIT_BUTTON']))
			echo $val['EDIT_BUTTON'];
		?>
	<br />
	<em><?=$val['PREVIEW_TEXT']?></em>
</p>
<?if ($val['DETAIL_TEXT_TYPE'] == 'text'):?>
<p>
	<strong><?=GetMessage("T_FAQ_ANSWER")?>:</strong><br />
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
<?endforeach;?>