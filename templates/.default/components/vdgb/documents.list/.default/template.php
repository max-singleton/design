<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<? if ($arParams['ENTITY_ID'] <= 0): ?>
	<?echo GetMessage("DOC_LIST_TEMPL_NOT_SELECT_DOC"); ?>
<? elseif (!empty($arResult['DATA'])): ?>
	<h2>
		<?echo GetMessage("LIST_OF_DOCUMENTS"); ?>
	</h2>
	<table class="table">
		<tr class="table__row table__row_head">
			<? foreach($arParams['SHOW_FIELDS'] as $key => $head): ?>
				<th class="table__cell table__cell_head">
					<?if ($head == "DOCUMENT_DESCRIPTION"):?>
						<?=GetMessage("DOC_LIST_TEMPL_DESCRIPTION")?>
					<?else:?>
						<?= $arResult['HEADER'][$head]['content'] ?>
					<?endif?>
				</th>
			<? endforeach; ?>
		</tr>
		<? foreach ($arResult['DATA'] as $id => $item): ?>
			<tr class="table__row">
				<? foreach($arParams['SHOW_FIELDS'] as $el): ?>
					<td class="table__cell">
						<? if ($el === 'DOCUMENT_ID'): ?>
							<? if (!empty($item['FILE_ID'])): ?>
								<a href="<?=$APPLICATION->GetCurPageParam("get_file={$item['FILE_ID']}") ?>">
									<?= GetMessage("DOC_LIST_TEMPL_DOWNLOAD"); ?>
								</a>
							<? endif; ?>
						<? else: ?>
							<?= $item[$el] ?>
						<? endif; ?>
					</td>
				<? endforeach; ?>
			</tr>
		<? endforeach ?>
	</table>
	<? $APPLICATION->IncludeComponent('bitrix:system.pagenavigation', '', array(
		'NAV_RESULT' => $arResult['PAGINATION']['CONTEXT'],
	)); ?>
<? else: ?>
	<?/*echo GetMessage("DOC_LIST_TEMPL_NOT_FOUND_DOC"); */?>
<? endif; ?>