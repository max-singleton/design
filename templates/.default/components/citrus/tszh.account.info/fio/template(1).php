<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
if (!$arResult['OWNER_LS'])
    ShowError(GetMessage("AI_NOT_OWNER_LS"));
?>
<div class="account-info__main">

        

    <?if(isset($arResult['FIO'])):?>
        <p><span class="bold"><?=$arResult['OWNER_LS'] ? GetMessage('AI_ACCOUNT_HOLDER') : GetMessage('AI_FIO')?>:</span> <?=$arResult['FIO']?></p>
    <?endif;?>
    <?if(isset($arResult['ADDRESS'])):?>
        <p><span class="bold"><?=GetMessage('AI_ADDRESS')?>:</span> <?=$arResult['ADDRESS']?></p>
    <?endif;?>
</div>