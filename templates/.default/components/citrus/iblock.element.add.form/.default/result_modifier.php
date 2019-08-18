<?php
foreach ($arResult["PROPERTY_LIST"] as $key => $propertyID){
    if (intval($propertyID) > 0)
    {
        if (
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
            &&
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
        )
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
        elseif (
            (
                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                ||
                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
            )
            &&
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
        )
            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
    }
    elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
    {
        $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
        $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
    }
    else
    {
        $inputNum = 1;
    }

    if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
        $INPUT_TYPE = "USER_TYPE";
    else
        $INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

    $html = '';
    switch ($INPUT_TYPE):
        case "USER_TYPE":
            for ($i = 0; $i<$inputNum; $i++)
            {
                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                {
                    $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
                    $description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
                }
                elseif ($i == 0)
                {
                    $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                    $description = "";
                }
                else
                {
                    $value = "";
                    $description = "";
                }
                $html .= call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
                    array(
                        $arResult["PROPERTY_LIST_FULL"][$propertyID],
                        array(
                            "VALUE" => $value,
                            "DESCRIPTION" => $description,
                        ),
                        array(
                            "VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
                            "DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
                            "FORM_NAME"=>"iblock_add",
                        ),
                    ));
            }
            break;
        case "T":
            for ($i = 0; $i<$inputNum; $i++)
            {

                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                {
                    $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                }
                elseif ($i == 0)
                {
                    $value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                }
                else
                {
                    $value = "";
                }
                $html .= '<textarea class="styled" cols="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'" rows="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"].'" name="PROPERTY['.$propertyID.']['.$i.']">'.$value.'</textarea>';
            }
            break;

        case "F":
            for ($i = 0; $i<$inputNum; $i++)
            {
                $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];

                $html .= '<input type="hidden" name="PROPERTY['.$propertyID.']['.($arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i).']" value="'.$value.'" />
                <input type="file" size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"  name="PROPERTY_FILE_<'.$propertyID.'_'.($arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i).'" />';

                if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
                {
                    $html .= '<input type="checkbox" name="DELETE_FILE['.$propertyID.']['.($arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i).']" id="file_delete_<'.$propertyID.'_'.$i.'" value="Y" /><label for="file_delete_'.$propertyID.'_'.$i.'">'.GetMessage("IBLOCK_FORM_FILE_DELETE").'</label>';
                    if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
                    {
                        $html .= '<img src="'.$arResult["ELEMENT_FILES"][$value]["SRC"].'" height="'.$arResult["ELEMENT_FILES"][$value]["HEIGHT"].'" width="'.$arResult["ELEMENT_FILES"][$value]["WIDTH"].'" border="0" />';
                    }
                    else
                    {
                        $html .= GetMessage("IBLOCK_FORM_FILE_NAME").': '.$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"].'<br />
                        '.GetMessage("IBLOCK_FORM_FILE_SIZE").': '.$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"].' b<br />
                        [<a href="'.$arResult["ELEMENT_FILES"][$value]["SRC"].'"><'.GetMessage("IBLOCK_FORM_FILE_DOWNLOAD").'</a>]';
                    }
                }
            }
            break;
        case "L":
            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
                $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
            else
                $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

            switch ($type):
                case "checkbox":
                case "radio":
                    //echo "<pre>"; print_r($arResult["PROPERTY_LIST_FULL"][$propertyID]); echo "</pre>";
                    foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
                    {
                        $checked = false;
                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                        {
                            if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
                            {
                                foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
                                {
                                    if ($arElEnum["VALUE"] == $key) {$checked = true; break;}
                                }
                            }
                        }
                        else
                        {
                            if ($arEnum["DEF"] == "Y") $checked = true;
                        }

                        $html .= '<input type="'.$type.'" name="PROPERTY['.$propertyID.']'.($type == "checkbox" ? "[".$key."]" : "").'" value="'.$key.'" id="property_'.$key.'"'.($checked ? " checked=\"checked\"" : "").' /><label for="property_'.$key.'">'.$arEnum["VALUE"].'</label>';
                    }
                    break;

                case "dropdown":
                case "multiselect":
                $html .= '<select name="PROPERTY['.$propertyID.']'.($type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : "").'">';
                        if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
                            else $sKey = "ELEMENT";
                        foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
                        {
                            $checked = false;
                            if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                            {
                                foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
                                {
                                    if ($key == $arElEnum["VALUE"]) {$checked = true; break;}
                                }
                            }
                            else
                            {
                                if ($arEnum["DEF"] == "Y") $checked = true;
                            }
                            $html .= '<option value="'.$key.'" '.($checked ? " selected=\"selected\"" : "").'><'.$arEnum["VALUE"].'</option>';
                        }
                $html .='</select>';
                    break;

            endswitch;
            break;
    endswitch;
    $arResult["PROPERTY_LIST"][$key] = ['inputNum' => $inputNum, 'INPUT_TYPE' => $INPUT_TYPE, 'propertyID' => $propertyID, 'html' => $html];
}
?>