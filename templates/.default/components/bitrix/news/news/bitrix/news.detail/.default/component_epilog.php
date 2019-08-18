<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init('jquery');
$APPLICATION->AddHeadScript("{$templateFolder}/colorbox/jquery.colorbox-min.js");
$APPLICATION->SetAdditionalCSS($templateFolder . '/colorbox/colorbox.css');
?>
<script type="text/javascript">
$(document).ready(function() {
	$(".b-news-detail .colorbox").colorbox({
		maxWidth: <?=(intval($arParams['COLORBOX_MAXWIDTH']) <= 0 ? 800 : intval($arParams['COLORBOX_MAXWIDTH']))?>,
		maxHeight: <?=(intval($arParams['COLORBOX_MAXHEIGHT']) <= 0 ? 600 : intval($arParams['COLORBOX_MAXHEIGHT']))?>,
		rel:'news-detail-photo'
	});
});
</script>
