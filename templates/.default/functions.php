<?php
function TemplateShowPageTitle()
{
	global $APPLICATION;
	if ($APPLICATION->GetProperty('show_title', 'Y') == 'Y')
	{
		return SetVar($APPLICATION->GetTitle(false));
	}

	return SetVar($APPLICATION->GetTitle('title'));
}

function TemplateShowTitle()
{
	global $APPLICATION, $breadcrumbTitle;
	$arSite = $APPLICATION->GetSiteByDir();
	$siteName = strlen($arSite['SITE_NAME']) > 0 ? $arSite['SITE_NAME'] : $arSite['NAME'];
	$hasTitle = $APPLICATION->GetProperty('title') != $APPLICATION->GetTitle(false);
	$title = SetVar($APPLICATION->GetTitle('title'));
	if (SHOW_NAV_CHAIN)
	{
		if (!isset($breadcrumbTitle)) //переменная может быть предопределена выше
		{
			$breadcrumbTitle = $APPLICATION->GetProperty('breadcrumb_title', false);
		}
		if ($breadcrumbTitle !== false)
		{
			$APPLICATION->AddChainItem($breadcrumbTitle, SITE_DIR . PATH_PERSONAL, true);
		}
	}
	if (stripos($title, $siteName) === false && !$hasTitle)
	{
		return strlen($title) > 0 ? "$title &ndash; $siteName" : $siteName;
	}
	else
	{
		return $title;
	}
}

function SetVar($str)
{
    if (!empty($GLOBALS["VARS"])) {
        foreach ($GLOBALS["VARS"] as $key => $value)
        {
            $str = str_replace("#VAR_$key#", $value, $str);
        }
    }
	return preg_replace("/#VAR_[\w]+#/", "", $str);
}