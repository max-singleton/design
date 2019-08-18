<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<!-- Включение футера -->
    <div class="container bg-footer">
        <div class="row row-container footer">
            <div class="top-footer row">
                    <div class="col-xl-9 col-md-10  offset-md-1 offset-xl-0 p0 menu-footer">
                        <div class="col-xl-2 col-md-6  menu-footer-items">
                                <a href="/" class="podmenu-1">Главная</a>
                            </div>
                        <div class="col-xl-4 col-md-6  menu-footer-items">
                                <a href="/about/" class="podmenu-1">О компании</a>
                                <div class="row podmenu__col">
                                    <div class="col-xl-6 podmenu__links p0">
                                        <a href="/news/" class="podmenu">Новости</a>
                                        <a href="/company/services.php" class="podmenu">Услуги</a>
                                    </div>
                                    <div class="col-xl-6 podmenu__links p0 ">
                                        <a href="/company/jobs.php" class="podmenu">Вакансии</a>
                                        <a href="/company/paid_services.php" class="podmenu">Платные работы</a>
                                        <a href="/company/docs.php" class="podmenu">Документы</a>
                                    </div>
                                </div>
            
            
                            </div>
                        <div class="col-xl-3 col-md-6  menu-footer-items">
                                    <a href="/doma-v-obsluzhivanii/" class="podmenu-1">Дома в обслуживании</a>
                                    <div class="podmenu__links">
                                        <a href="/doma-v-obsluzhivanii/ooo-dostoyanie.php" class="podmenu">ООО "Достояние"</a>
                                        <a href="/doma-v-obsluzhivanii/ooo-nasledie.php" class="podmenu">ООО "Наследие"</a>
                                    </div>
                                </div>
                            
                        <div class="col-xl-3 col-md-6  menu-footer-items">
                                <a href="/contacts/" class="podmenu-1">Контакты</a>
                                <div class="podmenu__links">
                                    <a href="/contacts/" class="podmenu">График работы</a>
                                    <a href="/contacts/requisites.php" class="podmenu"> Реквизиты</a>
                                </div>
                            </div>
            
                    </div>
            
                    <div class="col-xl-3 col-md-11 offset-md-1 col-xs-12 offset-xl-0 btn-but">
                            <div class="col-xl-12 col-md-5 btn-but-1"> <a href="/vopros/"style="color: #fff">Задать вопрос</a> </div>
                            <div class="col-xl-12 col-md-5 push-md-1 push-xl-0 btn-but-2"><a href="/personal/" style="color: #fff">Личный кабинет</a></div>
                        </div>
            </div>

            <div class="bottom-footer ">
                <div class="row bottom-footer__inner">
                        <div class="col-xl-5 col-md-12 copyrait">© Copyright 2009–2019. Делаем жизнь лучше, создавая комфорт жителям. </div>
                        <div class="col-xl-7 col-md-10 offset-md-2 offset-xl-0 footer__contact">
                            <div class="col-md-3 p0 col-xs-3 contact-2">

                            </div>
                            <div class="col-md-5 p0 col-xs-5 contact-2">
                                <span>Приемная</span>
                                <span>+7 (8352) 25-92-33</span>
                                <span>понедельник - пятница с 8.00 до 17.00</span>
                            </div>
                            <div class="col-md-4 p0 col-xs-4 contact-2">
                                <span>Диспетчерская</span>
                                <span>+7 (8352) 53-22-66</span>
                                <span>Круглосуточно</span>
                            </div>
<!--                            <div class="col-md-3 p0 col-xs-3 contact-2">
                                <span>Почта</span>
                                <span>mail@достояние-наследие.рф</span>
                                <span>Для ваших обращений</span>
                            </div>-->
                         </div>
                        </div>
                </div>
        </div>

    </div>
	
	<!-- Включение мобильного меню -->
	<div class="mobile-menu">
        <div class="mobile-menu__menu">
            <div class="mobile-menu__nav">
                <li class="mobile-menu__nav-items mobile-menu__nav-items--current"><a href="/">ГЛАВНАЯ</a> </li>
                <li class="mobile-menu__nav-items"><a href="/about/">О КОМПАНИИ</a></li>
                <li class="mobile-menu__nav-items"><a href="/contacts/">КОНТАКТНАЯ ИНФОРМАЦИЯ</a></li>
                <li class="mobile-menu__nav-items"><a href="/doma-v-obsluzhivanii/">ДОМА В ОБСЛУЖИВАНИИ</a></li>
                <li class="mobile-menu__nav-items"><a href="/vopros/">ЗАДАТЬ ВОПРОС?</a></li>
            </div>
            <div class="mobile-menu__nav mobile-menu__auth">
                <li class="mobile-menu__nav-items">
					<a class="window-open " href="javascript:void(0)" window="window-auth" init="true">ВХОД В ЛИЧНЫЙ КАБИНЕТ</a>
				</li>
                <li class="mobile-menu__nav-items">
					<a class="window-open" href="javascript:void(0)" window="window-register" init="true">РЕГИСТРАЦИЯ</a>
				</li>
            </div>
            <div class="mobile-menu__contacts">
                <div class="mobile-menu__contact-item ">
                    <div class="mobile-menu__contact">Приемная</div>
                    <div class="mobile-menu__contact">+7 (8352) 25-92-33</div>
                    <div class="mobile-menu__contact">понедельник - пятница с 8.00 до 17.00</div>
                </div>
                <div class="mobile-menu__contact-item">
                    <div class="mobile-menu__contact">Диспетчерская</div>
                    <div class="mobile-menu__contact">+7 (8352) 53-22-66</div>
                    <div class="mobile-menu__contact">Круглосуточно</div>
                </div>
                <div class="mobile-menu__contact-item">
                    <div class="mobile-menu__contact">Почта</div>
                    <div class="mobile-menu__contact">mail@достояние-наследие.рф</div>
                    <div class="mobile-menu__contact">Для ваших обращений</div>
                </div>
            </div>
            <div class="burger mobile-menu__burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    
    <!-- Скрипты. jQuery первый, затем Tether, затем Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"
        integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
        integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js"
        integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
    <script src="<?= DEFAULT_TEMPLATE_PATH ?>/js/script.js"></script>
	
    <!-- Скрипты-велосипеды для главной страницы -->
	<script src="<?= DEFAULT_TEMPLATE_PATH ?>/js/myScriptsHomePage.js"></script>

</body>

</html>