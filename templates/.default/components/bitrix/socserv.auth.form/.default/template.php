<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
$this->setFrameMode(true);
$arAuthServices = $arPost = array();
if(is_array($arParams["~AUTH_SERVICES"]))
{
	$arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"]))
{
	$arPost = $arParams["~POST"];
}
?>
<?
if($arParams["POPUP"]):
	//only one float div per page
	if(defined("BX_SOCSERV_POPUP"))
		return;
	define("BX_SOCSERV_POPUP", true);
?>
<div style="display:none">
<div id="bx_auth_float" class="bx-auth-float">
<?endif?>
<?if(($arParams["~CURRENT_SERVICE"] <> '') && $arParams["~FOR_SPLIT"] != 'Y'):?>
<script type="text/javascript">
BX.ready(function(){BxShowAuthService('<?=CUtil::JSEscape($arParams["~CURRENT_SERVICE"])?>', '<?=$arParams["~SUFFIX"]?>')});
</script>
<?endif?>
<?
if($arParams["~FOR_SPLIT"] == 'Y'):?>
<div class="bx-auth-serv-icons">
	<?foreach($arAuthServices as $service):?>
	<?
	if(($arParams["~FOR_SPLIT"] == 'Y') && (is_array($service["FORM_HTML"])))
		$onClickEvent = $service["FORM_HTML"]["ON_CLICK"];
	else
		$onClickEvent = "onclick=\"BxShowAuthService('".$service['ID']."', '".$arParams['SUFFIX']."')\"";
	?>
	<a title="<?=htmlspecialcharsbx($service["NAME"])?>" href="javascript:void(0)" <?=$onClickEvent?> id="bx_auth_href_<?=$arParams["SUFFIX"]?><?=$service["ID"]?>"><i class="bx-ss-icon <?=htmlspecialcharsbx($service["ICON"])?>"></i></a>
	<?endforeach?>
</div>
<?endif;?>
<div class="window__networks">
	<form method="post" name="bx_auth_services<?=$arParams["SUFFIX"]?>" target="_top" action="<?=$arParams["AUTH_URL"]?>">
		<div class="networks__title"><?=GetMessage("ENTER_BY_SOCIAL")?></div>
		<div class="networks__items">
			<?
				if(!isset($arParams["ICON"]))
				{
					$arParams["ICON"] = array(
						'MailRuOpenID' => SITE_TEMPLATE_PATH."/images/mail.ru.png",
						'Livejournal' => SITE_TEMPLATE_PATH."/images/lv.png",
						'GooglePlusOAuth' => SITE_TEMPLATE_PATH."/images/G+.png",
						'VKontakte' => SITE_TEMPLATE_PATH."/images/VK.png",
						'YandexOpenID' => SITE_TEMPLATE_PATH."/images/ya.png",
						'Facebook' => SITE_TEMPLATE_PATH."/images/FB.png",
						'Twitter' => SITE_TEMPLATE_PATH."/images/Twitter.png",
						'Odnoklassniki' => SITE_TEMPLATE_PATH."/images/Odnoklasniki.png",						
					);
				}
			foreach($arAuthServices as $service): if(!isset($arParams["ICON"][$service["ID"]])) continue?>
				<a href="javascript:void(0)" class="networks__item" onclick="BxShowAuthService('<?=$service["ID"]?>', '<?=$arParams["SUFFIX"]?>')" id="bx_auth_href_<?=$arParams["SUFFIX"]?><?=$service["ID"]?>">
					<img class="networks__item-img" src="<?= $arParams["ICON"][$service["ID"]] ?>" alt=""/>
				</a>
			<?endforeach?>
			<div class="bx-auth-service-form form-theme-default" id="bx_auth_serv<?=$arParams["SUFFIX"]?>" style="display:none">
			<?foreach($arAuthServices as $service):?>
				<?if(($arParams["~FOR_SPLIT"] != 'Y') || (!is_array($service["FORM_HTML"]))):?>
					<div id="bx_auth_serv_<?=$arParams["SUFFIX"]?><?=$service["ID"]?>" style="display:none"><?=$service["FORM_HTML"]?></div>
				<?endif;?>
			<?endforeach?>
			</div>
			<?foreach($arPost as $key => $value):?>
				<?if(!preg_match("|OPENID_IDENTITY|", $key)):?>
					<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?endif;?>
			<?endforeach?>
		</div>
		<input type="hidden" name="auth_service_id" value="" />
	</form>
</div>