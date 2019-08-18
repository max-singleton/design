<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

if (!function_exists('TszhDolgRenderList')):
	function TszhDolgRenderList($arItems, $arFields, $arExcluded)
	{
		echo '<div class="overflowx_auto"><table class="data-table tszh-dolg-table"><thead><tr>';
		foreach ($arFields as $arField)
		{
			echo "<th>{$arField['TITLE']}</th>\n";
		}
		echo "</tr></thead>\n";

		foreach ($arItems as $arAccount)
		{
			if (in_array($arAccount["ACCOUNT_ID"], $arExcluded))
			{
				continue;
			}
			echo "<tr>";
			foreach ($arFields as $arField)
			{
				if ($arField["CODE"] == "FLAT")
				{
					$arField["CODE"] = "FLAT_ABBR";
				}
				$value = $arAccount[$arField["CODE"]];
				if (in_array($arField["CODE"], Array("DEBT_END", "DEBT_END_WITHOUT_CHARGES", "DEBT_BEG")))
				{
					$value = CTszhPublicHelper::FormatCurrency($value);
					$class = ' class="cost"';
				}
				else
				{
					$class = '';
				}
				echo "<td$class>$value</td>\n";
			}
			echo "</tr>";
		}

		echo '</table></div>';
	}
endif;

if (!empty($arResult["TSZH_LINKS"]))
{
	?>
	<?= GetMessage("TPL_CHOOSE_TSZH") ?>:
	<ul>
	<? foreach ($arResult["TSZH_LINKS"] as $tszhID => $tszhName): ?>
	<li><a href="<?= $APPLICATION->GetCurPage() . "?tszh_id={$tszhID}" ?>"><?= $tszhName ?></a></li>
	<? endforeach ?>
	</ul><?
	return;
}

if (count($arResult["ACCOUNTS"]) <= 0)
{
	if (empty($arResult["TSZH_LINKS"]))
	{
		ShowNote(GetMessage("TPL_NO_DEBTORS"));
	}
	return;
}

if ($arParams["DISPLAY_TOP_PAGER"])
{
	echo "<div>{$arResult['NAV_STRING']}</div>\n";
}

if (is_array($arResult['GROUPS']))
{
	$curTszhID = false;
	foreach ($arResult["GROUPS"] as $arItems)
	{
		if (!empty($arResult["TSZH_LINKS"]) && $arItems["TSZH_ID"] != $curTszhID)
		{
			echo '<h3>' . $arItems["TSZH_NAME"] . '</h3>';
			$curTszhID = $arItems["TSZH_ID"];
		}
		if (strlen($arItems['TITLE']) > 0)
		{
			echo '<h4>' . $arItems['TITLE'] . '</h4>';
		}
		TszhDolgRenderList($arItems['ITEMS'], $arResult["FIELDS"], $arResult["ACCOUNTS_EXCLUDED"]);
		if ($arItems['SUMMARY'])
		{
			?>
			<p><?= $arItems["SUMMARY_TITLE"] ?>: <b><?= $arItems['SUMMARY'] ?></b></p>
			<?
		}
	}
}
else
{
	TszhDolgRenderList($arResult["ACCOUNTS"], $arResult["FIELDS"], $arResult["ACCOUNTS_EXCLUDED"]);
}

if ($arParams["DISPLAY_BOTTOM_PAGER"])
{
	echo "<div>{$arResult['NAV_STRING']}</div>\n";
}
