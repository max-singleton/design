<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_TITLE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TITLE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"TAGS_CLOUD_ELEMENTS" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("SEARCH_PAGE_ELEMENTS"),
		"TYPE" => "STRING",
		"DEFAULT" => "150",
	),
	"PERIOD_NEW_TAGS" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("SEARCH_PERIOD_NEW_TAGS"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => ""
	),
	"FONT_MAX" => array(
		"NAME" => GetMessage("SEARCH_FONT_MAX"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "50"
	),
	"FONT_MIN" => array(
		"NAME" => GetMessage("SEARCH_FONT_MIN"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "10"
	),
	"COLOR_NEW" => array(
		"NAME" => GetMessage("SEARCH_COLOR_NEW"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "3E74E6"
	),
	"COLOR_OLD" => array(
		"NAME" => GetMessage("SEARCH_COLOR_OLD"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "C0C0C0"
	),
	"TAGS_CLOUD_WIDTH" => array(
		"NAME" => GetMessage("SEARCH_WIDTH"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "100%"
	),
);
?>
