<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();?>



<!-- Велосипедишко -->

<style>
#mydiv {
	display: none;
	}
</style>



<style>
.area{
    margin:10px;
    text-align: center;
    display:table-cell;
    vertical-align:middle;
	}
</style>



<div class="meters">

<?php
if (isset($_POST["send"])) { 
    echo "<center><div class='alert alert-success' id='result_div_id'>
			<h4>Ваши показания счетчиков приняты</h4>
			</div></center>"
			; 
}
?>


<?
    if ($arResult['allow_edit'])
    {
        if (!empty($arResult["WARNING"]))
            ShowError(implode("", $arResult["WARNING"]));
        ?>
    <form method="post" action="<?= $APPLICATION->GetCurPage(); ?>" data-version="1" id="form-id">
        <?
        foreach ($arResult["HIDDEN_FIELDS"] as $name => $value)
        {
            ?><input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
            <?
        }
        ?>
        <?= bitrix_sessid_post() ?>
        <?
    }
    elseif (!CTszhMeter::CanPostMeterValues())
    {
        ShowNote(COption::GetOptionString('citrus.tszh', 'meters_block_message',
                        GetMessage("CTM_METERS_BLOCK_EDIT_MESSAGE_DEFAULT")));
    }
    elseif (!$arResult['allow_edit_by_period'])
    {
        ShowNote(
                GetMessage(
                        "CTM_METER_VALUES_INPUT_DENIED_BY_PERIOD",
                        array(
            '#START_DATE#' => $arResult["ACCOUNT"]["TSZH_METER_VALUES_START_DATE"],
            '#END_DATE#'   => $arResult["ACCOUNT"]["TSZH_METER_VALUES_END_DATE"],
                        )
                )
        );
    }
    ?>

    <? if ($arResult["CURRENT_PAGE"] != 'history') : ?>
        <div class="table1 meters__table">
            <div class="table1__row bold hidden-mobi">
                <div class="table1__cell meters__name">
                    <?=GetMessage("CTM_METER")?>
                </div>
                <div class="table1__cell padding-none">
                    <div class="table1">
                        <div class="table1__row">








<!-- Вот этот блок сделать видимым только с 23 по 26 числа каждого месяца -->
                            <div class="mydiv area" id="mydiv">
                                Предыдущие показания
								</div>








                            <div class="table1__cell area">
                                Текущие показания
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table1__cell">
                    <?=GetMessage("CTM_VERIFICATION_DATE")?>
                </div>
                <div class="table1__cell">
                    <?=GetMessage("CTM_METER_HISTORY")?>
                </div>
            </div>
            <?
            if (empty($arResult['ITEMS']))
            {
                ?>
            <div class="table1__row">
                <div class="padding-default"><?= GetMessage("CTM_YOU_HAVE_NO_METERS") ?></div>
                </div><?
            }
            else
            {
            foreach ($arResult['ITEMS'] as $id => $arItem):?>
            <div class="table1__row">
                <div class="table1__cell meters__name">
                    <?= strlen($arItem['SERVICE_NAME']) > 0 ? $arItem['SERVICE_NAME']." (".$arItem['NAME'].")" : $arItem['NAME'] ?>
                </div>
                <div class="table1 visible-mobi">
                    <div class="table1__row meters__theme-title">
                        <div class="table1__cell">
                            <?=GetMessage("CTM_PREV_VALUE_TITLE")?>
                        </div>
                        <div class="table1__cell">
                            <?=GetMessage("CTM_CURRENT_VALUE_TITLE")?>
                        </div>
                    </div>
                </div>
                <div class="table1__cell padding-none">
                    <div class="table1">
                        <?for($i=1;$i<=$arItem['VALUES_COUNT'];$i++):?>
                        <div class="table1__row">











<!-- Вот этот блок сделать видимым только с 23 по 26 числа каждого месяца -->

                            <div class="meters__data mydiv" id="mydiv">
                                <?if($arItem['VALUES_COUNT']>1):?>
                                    <div class="color-main mydiv" id="mydiv"><?=GetMessage("CTM_TARIFF_N",array("#N#"=>$i))?></div>
                                <?endif;?>
                                <div id="mydiv" class="mydiv"><br><?=FloatVal($arItem['PREV_VALUE']['VALUE'.$i])." ".$arItem["UNIT"]?></div>
                            </div>












                            <div class="table1__cell">
                                <?if($arItem['VALUES_COUNT']>1):?>
                                    <div class="color-main"><?= GetMessage("CTM_TARIFF_N",array("#N#"=>$i))?></div>
                                <?endif;?>
                                <div>
                                    <? if ($arResult['allow_edit']): ?>
                                        <input class="meters__input" type="text" name="indiccur<?= $i ?>[<?= $arItem['ID'] ?>]"
                                               value="<?= $arItem['VALUE']['VALUE'.$i] ?>" />
                                    <? else: ?>
                                        <?= $arItem['VALUE']['VALUE'.$i] ?>
                                    <? endif ?>
                                </div>
                            </div>
                        </div>
                        <?endfor;?>
                    </div>
                </div>
                <div class="table1__cell meters__theme-title padding-default">
                    <div class="visible-mobi"><?=GetMessage("CTM_VERIFICATION_DATE")?></div>
                    <?= $arItem["VERIFICATION_DATE"] ?>
                </div>
                <div class="table1__cell meters__theme-title padding-default">
                    <a class="color-main" href="/personal/?type=history&id=<?= $arItem["ID"]?>" target="_blank"><?= GetMessage("CTM_LOOK")?><span class="visible-mobi"><?= GetMessage("CTM_HISTORY_AND_EXPENSE")?></span></a>
                </div>
            </div>
            <?endforeach;
            }?>
        </div>
        <?
        if ($arResult['allow_edit'])
        {
        if (!empty($arResult['ITEMS']))
        {
            ?>
            <div class="meters__send">
            <input type="submit" name="send" class="link-theme-default" value="<?=GetMessage("CTM_BTN_CAPTION")?>" onclick="AjaxFormRequest('result_div_id', 'form_id')" />
        </div>
            <?
        }
        ?></form><?
    }

// template version
    return 1.1;

else :
    ?>

    <?
    $APPLICATION->SetTitle(GetMessage("CTM_HISTORY_METER"));
    $APPLICATION->IncludeComponent(
            "citrus:tszh.meter.history", "",
            Array(
        "COMPONENT_TEMPLATE" => ".default",
        "FILTER_NAME"        => isset($arParams["FILTER_NAME"]) ? $arParams["FILTER_NAME"] : "",
        "MODIFIED_BY_OWNER"  => isset($arParams["MODIFIED_BY_OWNER"]) ? $arParams["MODIFIED_BY_OWNER"] : "Y",
        "COUNT_METERS_HISTORY"  => isset($arParams["COUNT_METERS_HISTORY"]) ? $arParams["COUNT_METERS_HISTORY"] : 0,
        "ID"                 => IntVal($_REQUEST["id"]),
            )
    );
    ?>

<?
endif;
?>
</div>




