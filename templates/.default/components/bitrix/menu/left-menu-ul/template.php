<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if (!empty($arResult)) {?>
<div class="leftmenu">
	<ul class="leftmenu__menu">
		<?php
		$html = '';
        foreach($arResult as $idx=>$arItem) {
            $html .= '<a href="'.$arItem['LINK'].'"><li'.($arItem['SELECTED'] ?' class="leftmenu__menu-active"':'').'>'.(ISPERSONAL?'<span class="leftmenu__img '.$arItem['PARAMS']['class'].' hidden-mobi"></span>':'').'<span class="leftmenu__text">'.$arItem["TEXT"].'</span></li></a>';
        }
        echo $html;
		?>
	</ul>
</div>
<?}?>
