<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!empty($arResult['ERRORS']['VOTE']))
{
	foreach($arResult['ERRORS']['VOTE'] as $key => $message)
		ShowError($message." ID=".$key);
}    

foreach($arResult['VOTE'] as $VOTE):

	if (isset($VOTE['QUESTION']) && !empty($VOTE['QUESTION'])):

        $idVoting = $VOTE["ID"];
        $this->AddEditAction($idVoting, '/bitrix/admin/vdgb_tszhvoting_edit.php?bxpublic=Y&lang=' . LANGUAGE_ID . '&ID=' . $idVoting, GetMessage("CVF_EDIT_VOTING"));
        $this->AddDeleteAction($idVoting, '/bitrix/admin/vdgb_tszhvoting.php?bxpublic=Y&del_element=' . $idVoting. '&lang=' . LANGUAGE_ID . '&set_default=Y', GetMessage("CVF_DELETE_VOTING"));

        ?>
    <div class="vote-result" id="<?=$this->GetEditAreaId($idVoting);?>">
        <div class="vote-result__header"><?=GetMessage("CVF_RESULT")?></div>
        <?
        if (strlen($VOTE["TITLE_TEXT"])) {
            ?><div class="vote-result__title"><?=$VOTE["TITLE_TEXT"]?>
            </div>
            <div class="vote-result__period"><?=GetMessage("CVF_DATES").": ".CCitrusPolls::formatPeriod($VOTE['DATE_BEGIN'], $VOTE['DATE_END'])?></div>
            <?
        }
        if (strlen(trim(strip_tags($VOTE["DETAIL_TEXT"])))) {
            ?><div class="vote-result__description"><?=$VOTE["DETAIL_TEXT"]?></div><?
        }
        ?>

            <?foreach($VOTE['QUESTION'] as $key => $question):

                $idQuest = $question["ID"];
                $this->AddEditAction($idVoting . '/' . $idQuest, '/bitrix/admin/vdgb_tszhvoting_question_edit.php?bxpublic=Y&lang=' . LANGUAGE_ID . '&VOTING_ID=' . $idVoting . '&ID=' . $idQuest, GetMessage("CVF_EDIT_QUESTION"));
            
            	$arAnswerSums = Array();
				$arTotals = Array();
            	$rsAnswers = CCitrusPollVoteAnswer::GetList(Array(), Array("VOTE_QUESTION_ID" => $question['ID']), Array("ANSWER_ID", "VOTE_QUESTION_ID", "SUM" => 'VOTE_WEIGHT'));
				while ($arAnswer = $rsAnswers->GetNext(false))
				{
					$arAnswerSums[$arAnswer['ANSWER_ID']] = Array(
						"SUM" => $arAnswer['VOTE_WEIGHT'],
						'CNT' => $arAnswer["CNT"],
					);
					$arTotals[$arAnswer['VOTE_QUESTION_ID']] += $arAnswer['VOTE_WEIGHT'];
				}
			
            ?>
                <?if(isset($question['ANSWER'])):?>
                    <div class="vote-result__item" id="<?=$this->GetEditAreaId($idVoting . '/' . $idQuest);?>">
                        <div class="vote-result__question"><?=$question['TEXT']?></div>
                        <?if($arParams['VOTE_TYPE_DIOGRAM']):?>
                            <table class="vote-result__diagram">
                                <?foreach($question['ANSWER'] as $answ_id => $answer):?>
                                    <?
                                    	$sum = $arAnswerSums[$answ_id]['SUM'];
                                        if ($arTotals[$question['ID']]) $count = (100 * $sum) / $arTotals[$question['ID']];
                                        $width = $count*0.8;
                                    ?>
                                    <tr>
                                        <td><?=$answer['TEXT']?></td>
                                        <td>
                                            <div class="vote-result__box" style="width:<?=$width?>%;background-color:<?=$answer['COLOR']?>;"></div>
                                            <span class="vote-result__percent"><?=number_format($count,2,"."," ")."%"?></span>
                                        </td>
                                    </tr>

                                <?endforeach;?>
                            </table>
                        <?else:
                        
                        ?>
                                <table class="voting-result-diagram">
                                    <tr>
                                        <td>
                                            <img alt="" width="150" height="150" src="<?=$componentPath?>/draw_graf.php?QUESTION=<?=$key?>&dm=150" class="voting-result-diagram" />
                                        </td>
                                        <td>
                                            <div class="answer-box">
                                            <?foreach($question['ANSWER'] as $answ_id => $answer):

		                                    	$sum = $arAnswerSums[$answ_id]['SUM'];
		                                        $count = (100 * $sum) / $arTotals[$question['ID']];
											
                                            ?>
                                                <div>
                                                    <div class="voting-result-box" style="background-color:<?=$answer['COLOR']?>;"></div>
                                                    <span class="voting-result-percent"><?=number_format($count,2,"."," ")."%"?></span>&nbsp<?=$answer['TEXT']?>
                                                </div>
                                            <?endforeach;?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                         <?endif;?>
                    </div>

                <?endif;?>
            <?endforeach;?>
    </div>
	<?endif?>
<?endforeach?>


