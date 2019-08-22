<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/local/templates/.default/head.php"
	)
);?>
<?php
//Определение каталога для использования во включаемой области, чтобы подключить подменю
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  $str = parse_url($url);
  $str = $str['path'];
  $str = explode('/', $str);
  $category = $str[1];
?>

<div class='promo'>
    <div class="container" style="background:#4A76A8; max-width: 100%;">
        <!-- Включение header -->
            <!-- Включение header -->
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/local/templates/.default/header.php"
	)
);?>   


    </div>
</div>

	<!-- Контент. Начало -->
<div class="container bg-gray">
    <div class="row o-company">
        <div class="col-xl-3">


<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/$category/submenu.php"
	)
);?>






            <!--<div class="zagolovok">О компаниях ООО «Достояние» и ООО «Наследие»</div><br>
            <div class="text-1">Наша главная цель - удовлетворение потребностей населения, проживающего на
                территории,обслуживаемой нашими компаниями</div>-->




        </div>
		<div class="col-xl-1"></div>
        <div class="col-xl-8">
<p class="text-2"></p>

