<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// �������� ������� ����� � ������� 3?
// ===================================
$arResult['HAS_PENALTIES'] = COption::GetOptionString(TSZH_MODULE_ID, "post_354_ShowPenaltiesColumn") == "Y";

