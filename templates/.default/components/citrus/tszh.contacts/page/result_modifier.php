<?php
foreach($arResult["ITEMS"] as $itemID => $arItem){
    $arGroups = array(
        array(
            "TITLE" => GetMessage("T_G_CONTACTS"),
            "FIELDS" => array("ADDRESS", "PHONE", "PHONE_DISP", "EMAIL", "OFFICE_HOURS"),
            "EXISTS" => $arParams["SHOW_FEEDBACK_FORM"],
            "SHOW_WRITE_US" => $arParams["SHOW_FEEDBACK_FORM"],
            "FIELDS_VALUE" => []
        ),
        array(
            "TITLE" => GetMessage("T_G_PROPS"),
            "FIELDS" => array("INN", "KPP", "RSCH", "KSCH", "LEGAL_ADDRESS", "HEAD_NAME"),
            "EXISTS" => false,
            "SHOW_WRITE_US" => false,
            "FIELDS_VALUE" => []
        ),
    );
    foreach ($arItem as $field => $value)
    {
        if ($field == "OFFICE_HOURS" && is_array($value) && !empty($value) || $field != "OFFICE_HOURS" && strlen(trim($value)) > 0)
        {
            foreach ($arGroups as $key => $arGroup)
            {
                if (!$arGroup["EXISTS"] && in_array($field, $arGroup["FIELDS"]))
                {
                    $arGroups[$key]["EXISTS"] = true;
                    break;
                }
            }
        }
    }
    foreach ($arGroups as $groupKey => $arGroup):
        if (!$arGroup["EXISTS"])
            continue;
        foreach ($arGroup["FIELDS"] as $fieldKey => $field):
            $value = trim($arItem[$field]);

            if ($field == "PHONE_DISP")
                continue;
            elseif ($field == "PHONE")
            {
                $arValues = array();
                $pattern = '#^(\+?\d+)\s*\((\d+)\)\s*(.+)$#';
                $replacement = '$1 ($2) <span class="phone-big">$3</span>';
                if (strlen($value) > 0)
                {
                    $value = preg_replace($pattern, $replacement, $value);
                    $arValues[] = $value;
                }
                $value = trim($arItem["PHONE_DISP"]);
                if (strlen($value) > 0)
                {
                    $value = preg_replace($pattern, $replacement, $value);
                    $arValues[] = $value . " (" . GetMessage("T_DISPATCHER_ROOM") . ")";
                }
                $value = implode("<br />", $arValues);
            }
            elseif ($field == "RSCH")
            {
                $bank = trim($arItem["BANK"]);
                if (strlen($bank) > 0)
                {
                    $value .= ", {$bank}";
                    $bik = trim($arItem["BIK"]);
                    if (strlen($bik) > 0)
                    {
                        $value .= " (" . GetMessage("T_BIK") . " {$bik})";
                    }
                }
            }
            elseif ($field == "OFFICE_HOURS")
            {
                $arSchedule = $arItem[$field];
                if (is_array($arSchedule) && !empty($arSchedule))
                {
                    $value = '<table class="schedule-table">';
                    foreach ($arSchedule as $deptScheduleKey => $arDeptSchedule)
                    {
                        foreach ($arDeptSchedule["SCHEDULE"] as $scheduleItemKey => $arScheduleItem)
                        {
                            $value .= "<tr>";
                            $daysStr = trim($arScheduleItem["DAY"]);
                            $daysStr = preg_replace('/(\s*)([^,]+)(,|$)/', '$1<span class="nowrap">$2$3</span>', $daysStr);
                            $value .= "<td>{$daysStr}</td>";
                            $class = "hours";
                            if (count($arScheduleItem["HOURS"]) == 1 && preg_match('#' . GetMessage("T_HOLIDAY_PATTERN") . '#i' . (defined("BX_UTF") && BX_UTF ? 'u' : ''), $arScheduleItem["HOURS"][0]))
                            {
                                $class = "holiday";
                                //$arScheduleItem["HOURS"][0] = "- " . $arScheduleItem["HOURS"][0];
                            }
                            $value .= "<td class=\"{$class}\">";
                            $arHours = array();
                            foreach ($arScheduleItem["HOURS"] as $hoursKey => $hours)
                            {
                                $arHours[] = "<span class=\"nowrap\">{$hours}</span>";
                            }
                            $value .= implode("<br />", $arHours);
                            $deptName = "";
                            if ($scheduleItemKey == 0 && strlen($arDeptSchedule["NAME"]) > 0)
                                $deptName = "({$arDeptSchedule["NAME"]})";
                            $value .= "</td><td class=\"deptname\" title=\"{$deptName}\">{$deptName}</td></tr>";
                        }

                        if ($deptScheduleKey < count($arSchedule)-1)
                            $value .= '<tr><td colspan="3"></td></tr>';
                    }
                    $value .= "</table>";
                }
                else
                    $value = "";
            }
            if (strlen($value) <= 0)
                continue;
            $arGroups[$groupKey]["FIELDS_VALUE"][] = ["field"=>$field, "value"=>html_entity_decode($value)];
        endforeach;
    endforeach;
    $arResult["ITEMS"][$itemID]["arGroups"] = $arGroups;
}

?>