<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arCloudParams = Array(
	"SEARCH" => $arResult["REQUEST"]["~QUERY"],
	"TAGS" => $arResult["REQUEST"]["~TAGS"],
	"CHECK_DATES" => $arParams["CHECK_DATES"],
	"arrFILTER" => $arParams["arrFILTER"],
	"SORT" => $arParams["TAGS_SORT"],
	"PAGE_ELEMENTS" => $arParams["TAGS_PAGE_ELEMENTS"],
	"PERIOD" => $arParams["TAGS_PERIOD"],
	"URL_SEARCH" => $arParams["TAGS_URL_SEARCH"],
	"TAGS_INHERIT" => $arParams["TAGS_INHERIT"],
	"FONT_MAX" => $arParams["FONT_MAX"],
	"FONT_MIN" => $arParams["FONT_MIN"],
	"COLOR_NEW" => $arParams["COLOR_NEW"],
	"COLOR_OLD" => $arParams["COLOR_OLD"],
	"PERIOD_NEW_TAGS" => $arParams["PERIOD_NEW_TAGS"],
	"SHOW_CHAIN" => $arParams["SHOW_CHAIN"],
	"COLOR_TYPE" => $arParams["COLOR_TYPE"],
	"WIDTH" => $arParams["WIDTH"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"RESTART" => $arParams["RESTART"],
);

if(is_array($arCloudParams["arrFILTER"]))
{
	foreach($arCloudParams["arrFILTER"] as $strFILTER)
	{
		if($strFILTER=="main")
		{
			$arCloudParams["arrFILTER_main"] = $arParams["arrFILTER_main"];
		}
		elseif($strFILTER=="forum" && IsModuleInstalled("forum"))
		{
			$arCloudParams["arrFILTER_forum"] = $arParams["arrFILTER_forum"];
		}
		elseif(strpos($strFILTER,"iblock_")===0)
		{
			foreach($arParams["arrFILTER_".$strFILTER] as $strIBlock)
				$arCloudParams["arrFILTER_".$strFILTER] = $arParams["arrFILTER_".$strFILTER];
		}
		elseif($strFILTER=="blog")
		{
			$arCloudParams["arrFILTER_blog"] = $arParams["arrFILTER_blog"];
		}
	}
}

$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", ".default", $arCloudParams, $component);

?><br /><div class="search-page">
<form action="" method="get">
<?if($arResult["REQUEST"]["HOW"]=="d"):?>
	<input type="hidden" name="how" value="d" />
<?endif;?>
	<input type="hidden" name="tags" value="<?echo $arResult["REQUEST"]["TAGS"]?>" />
	<input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" />
<?if($arParams["SHOW_WHERE"]):?>
	&nbsp;<select name="where">
	<option value=""><?=GetMessage("SEARCH_ALL")?></option>
	<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
	<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
	<?endforeach?>
	</select>
<?endif;?>
	&nbsp;<input type="submit" value="<?=GetMessage("SEARCH_GO")?>" />
</form><br />
<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
	<p><?=GetMessage("SEARCH_ERROR")?></p>
	<?ShowError($arResult["ERROR_TEXT"]);?>
	<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
	<br /><br />
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
<?elseif(count($arResult["SEARCH"])>0):?>
<div class="list-items">
<?
foreach($arResult["SEARCH"] as $arItem):?>
<div class="list-item"><?
	if($arItem["DISPLAY_ACTIVE_FROM"]):?>
	<span class="date-time"><?=$arItem["DATE_CHANGE"]?>?</span><?
	endif;?><?
	if (!empty($arItem['TITLE_FORMATED'])):?>
	<h3 class="list-item-title"><a href="<?=$arItem['URL']?>"><?=$arItem['TITLE_FORMATED']?></a></h3><?
	endif;?>	
	<div class="list-item-text"><?=$arItem["BODY_FORMATED"];?></div>
<?
		if (!empty($arItem["TAGS"]))
		{
			?><small><?
			$first = true;
			foreach ($arItem["TAGS"] as $tags):
				if (!$first)
				{
					?>, <?
				}
				?><a href="<?=$tags["URL"]?>"><?=$tags["TAG_NAME"]?></a> <?
				$first = false;
			endforeach;
			?></small><br /><?
		}
?>
</div>
<?endforeach;?>
<?=$arResult["NAV_STRING"]?>
</div>
	<p>
	<?if($arResult["REQUEST"]["HOW"]=="d"):?>
		<a href="<?=$arResult["URL"]?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
	<?else:?>
		<b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
	<?endif;?>
	</p>
<?else:?>
	<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
<?endif;?>
</div>