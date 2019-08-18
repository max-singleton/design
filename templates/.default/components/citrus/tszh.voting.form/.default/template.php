<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (empty($arResult["ITEM"]))
    return;

?>

<?

if (isset($arResult["ACCESS_ERROR"]) && strlen($arResult["ACCESS_ERROR"]) > 0)
	ShowError($arResult["ACCESS_ERORR"]);
if (strlen($arResult["ERROR_MESSAGE"]) > 0)
	ShowError($arResult["ERROR_MESSAGE"]);
if (strlen($arResult["OK_MESSAGE"]) > 0)
    ShowNote($arResult["OK_MESSAGE"]);

	foreach($arResult["ITEM"] as $idVoting => $voting) {
        if (!$voting["CAN_VOTE"]) {
            ?><?$APPLICATION->IncludeComponent(
                "citrus:tszh.voting.result",
                "",
                Array(
                    "GROUP_ID" => $arParams['GROUP_ID'],
                    "VOTING_ID" => array($idVoting),
                    "VOTE_TYPE_DIOGRAM" => $this->__component->__parent->arParams['VOTE_TYPE_DIOGRAM'],
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_NOTES" => ""
                ),
                $this->__component->__parent
            );
			?><?
			continue;
        }

        $this->AddEditAction($idVoting, '/bitrix/admin/vdgb_tszhvoting_edit.php?bxpublic=Y&lang=' . LANGUAGE_ID . '&ID=' . $idVoting, GetMessage("CVF_EDIT_VOTING"));
        $this->AddDeleteAction($idVoting, '/bitrix/admin/vdgb_tszhvoting.php?bxpublic=Y&del_element=' . $idVoting. '&lang=' . LANGUAGE_ID . '&set_default=Y', GetMessage("CVF_DELETE_VOTING"));

        if ($voting['VOTING_COMPLETED'] == "Y")
		{
            ?><div class="ok-message"><?=GetMessage("COMP_MESSAGE")?></div><?
            continue;
		}

        if (!isset($voting['QUESTION']))
            continue;
        ?>
        <div class="vote" id="<?=$this->GetEditAreaId($idVoting)?>">
            <form method="POST">
                <div class="vote__header">
                <?
                    if (strlen($voting["TITLE_TEXT"])) {
                        ?><span><?=$voting["TITLE_TEXT"]?></span><?
                    }
                ?>
                    <span class="vote__period"><?=CCitrusPolls::formatPeriod($voting['DATE_BEGIN'], $voting['DATE_END'])?></span>
                </div>
            	<?=bitrix_sessid_post()?>
                <input name="voting_id" type="hidden" value="<?=$idVoting?>"/>
                <input name="do_vote" type="hidden" value="1" />
                <?
                if (strlen(trim(strip_tags($voting["DETAIL_TEXT"])))) {
                    ?><div class="voting-description"><?=$voting["DETAIL_TEXT"]?></div><?
                }
                ?>
                <?foreach($voting["QUESTION"] as $idQuest=>$question):

                    $this->AddEditAction($idVoting . '/' . $idQuest, '/bitrix/admin/vdgb_tszhvoting_question_edit.php?bxpublic=Y&lang=' . LANGUAGE_ID . '&VOTING_ID=' . $idVoting . '&ID=' . $idQuest, GetMessage("CVF_EDIT_QUESTION"));
                    //$this->AddDeleteAction($idVoting . '/' . $idQuest, '/bitrix/admin/vdgb_tszhvoting_question.php?bxpublic=Y&del_element=' . $idQuest. '&lang=' . LANGUAGE_ID . '&set_default=Y', GetMessage("CVF_DELETE_QUESTION"));

                    ?>
                    <div class="vote__item" id="<?=$this->GetEditAreaId($idVoting . '/' . $idQuest);?>">
                    <?if(isset($question["ANSWER"]) && is_array($question["ANSWER"]) && !empty($question["ANSWER"])):?>
                        <span><?=$question['TEXT']?></span>
                        <div class="input-checkbox">
                            <?foreach($question["ANSWER"] as $idAnswer=>$answer):?>
                                    <?if($question['IS_MULTIPLE'] == "Y"):?>
                                        <input type="checkbox" id="voting-answer-<?=$idAnswer?>" name="Q[<?=$idQuest?>][]" value="<?=$answer['ID']?>"/>
                                        <label for="voting-answer-<?=$idAnswer?>"><?=$answer['TEXT']?></label>
                                    <?endif;?>
                            <?endforeach;?>
                        </div>
                        <div class="radio-switcher">
                            <?foreach($question["ANSWER"] as $idAnswer=>$answer):?>
                                <?if($question['IS_MULTIPLE'] != "Y"):?>
                                    <input type="radio" id="voting-answer-<?=$idAnswer?>" name="Q[<?=$idQuest?>][]" value="<?=$answer['ID']?>"/>
                                    <label for="voting-answer-<?=$idAnswer?>"><?=$answer['TEXT']?></label>
                                <?endif;?>
                            <?endforeach;?>
                        </div>
                    <?endif;?>
                    </div>
                
                <?endforeach;?>
                <button type="submit" class="vote__submit" disabled="disabled"><?=GetMessage("VOTE_SUBMIT_BUTTON")?></button>
            </form>
        </div>
<?}?>

