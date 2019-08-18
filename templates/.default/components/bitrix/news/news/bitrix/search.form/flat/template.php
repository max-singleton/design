<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>
<form action="<?=$arResult["FORM_ACTION"]?>" class="documents-search-form">
	<input type="text" name="q" value="" size="15" maxlength="50" class="styled" placeholder="<?=GetMessage("CITRUS_SF_PLACEHOLDER");?>" />
	<button name="s" class="styled" type="submit"><?=GetMessage("BSF_T_SEARCH_BUTTON");?></button>
</form>
