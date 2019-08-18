<?php
use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

echo "<div class='houses'>";

if ($arParams["DISPLAY_TOP_PAGER"])
{
	echo "<div>" . $arResult["NAV_STRING"] . "</div>\n";
}

?>
<table class="table1 houses__table hidden-mobi">
	<?
	echo "<thead> <tr>";
	foreach ($arParams["SELECT_FIELDS"] as $fieldName)
	{
		echo "<td>" . Loc::getMessage('TSZH_HOUSE_' . $fieldName) . "</td>";
	}
	echo "</tr></thead>";
	foreach ($arResult["TSZH"] as $tszh_id =>  $arTszh)
	{
		echo "<tr >";
		echo "<th colspan='" . count($arParams['SELECT_FIELDS']) . "'>{$arTszh['NAME']}</th>";
		echo "</tr>\n";
		foreach ($arResult["HOUSES"][$tszh_id] as $arHouse)
		{
			echo "<tr>";
			foreach ($arParams["SELECT_FIELDS"] as $fieldName)
			{
				echo "<td>{$arHouse[$fieldName]}</td>";
			}
			echo "</tr>\n";
		}
	}
	?>
</table>

<div class="table1 house-mobi visible-mobi">
        <?
        foreach ($arResult["TSZH"] as $tszh_id =>  $arTszh)
        {
            echo "<div class='house-mobi-tszh-name'>{$arTszh['NAME']}</div>";
            $i=0;
            foreach ($arResult["HOUSES"][$tszh_id] as $arHouse)
            {
                if (!is_array($arHouse)) continue;
                if($i++>0) { ?> <hr/>   <?}
                echo "<div class='house-table-item'>";
                foreach ($arParams["SELECT_FIELDS"] as $fieldName)
                {   echo "<div class='house-mobi__item'>";
                    echo "<div class='table1__cell'>". Loc::getMessage('TSZH_HOUSE_' . $fieldName) ." </div>";
                    echo "<div class='table1__cell'>{$arHouse[$fieldName]}</div>";
                    echo "</div>\n";
                }
                echo "</div>\n";
            }
        }
        ?>
</div>

<?
echo "</div >";

if ($arParams["DISPLAY_BOTTOM_PAGER"])
{
	echo "<div>" . $arResult["NAV_STRING"] . "</div>\n";
}
