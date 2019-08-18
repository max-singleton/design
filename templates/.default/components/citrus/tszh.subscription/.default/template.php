<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="subscrip">
    <?if (strlen($arResult["NOTE"])):?>
        <div class="errortext"><?=$arResult["NOTE"]?></div>
    <?endif;
    $msgCode = $this->__component->__name;
    if (is_set($_SESSION[$msgCode]) && strlen($_SESSION[$msgCode]))
    {
        ?><div class="message-ok"><?ShowMessage(array("TYPE"=>"OK", "MESSAGE"=>$_SESSION[$msgCode]))?></div><?
        unset($_SESSION[$msgCode]);
    }
    if (empty($arResult["ITEMS"])):?>
        <?ShowMessage(array("TYPE"=>"OK", "MESSAGE"=>GetMessage("T_NONE_SUBSCRIBES")))?>
    <?else:?>
    <form method="POST" action="<?=POST_FORM_ACTION_URI?>">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="citrus_tszh_subscription_component" value="Y">
        <table class="table1">
            <thead>
            <tr>
                <td><?=GetMessage("T_SUBSCRIBE")?></td>
                <td><?=GetMessage("T_SUBSCRIPTION_STATE")?></td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($arResult["ITEMS"] as $code => $arSubscribe) {
                ?>
                <tr>
                    <td>
                        <p class="bold"><label for="subscrib_<?= $code ?>"><?= $arSubscribe["NAME"] ?></label></p>
                        <p><?=$arSubscribe["DESCR"]?></p>
                    </td>
                    <td>
                        <div class="input-checkbox">
                            <input type="checkbox" name="<?=$code?>" value="Y" id="subscrib_<?=$code?>" <?=$arSubscribe["USER_SUBSCRIBED"] ? "checked" : ""?>>
                            <label for="subscrib_<?=$code?>"></label>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="subscrip__submit">
            <input type="submit" class="link-theme-default" name="save" value="<?=GetMessage("T_SAVE")?>">
        </div>
    </form>
    <?endif?>
</div>