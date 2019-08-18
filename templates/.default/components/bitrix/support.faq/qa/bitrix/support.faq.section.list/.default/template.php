<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?//display sections?>
<ul id="general">
		<?foreach ($arResult['SECTIONS'] as $val):?>
		<?if($arParams["SECTION_ID"]==$val["ID"]) $SELECTED_ITEM = $val?>			
					<div class="<?=($arParams["SECTION_ID"]==$val["ID"])?'':'un'?>selected"></div>
					<li><?='<a href="'.$val['SECTION_PAGE_URL'].'" class="'.($arParams["SECTION_ID"]==$val["ID"]?'':'un').'selected-faq-item">'.$val['NAME'].'</a> ('.$val['ELEMENT_CNT'].')'?></li>
		<?endforeach;?>
</ul>
<?if(isset($SELECTED_ITEM)):?>

<?endif;?>