<style>
.window-open {
    text-decoration: none;
}
</style>
<div class="container header_design">
    <div class="row header new_header">
        <div class="col-xl-3 col-lg-3 col-md-3 ">
            <div class="container logo">
                <a href="/"><img class="logos" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Logo.png" alt=""></a>
            </div>
        </div>
        <div class="col-xl-9 col-md-9">
            <!-- ��������� ����� � ���������� ����������� -->
                            <div class="container">
                    <div class="row contact-group">
                        <div class="col-xl-3 col-lg-3 contact-item">

                        </div>
                        <div class="offset-xl-2 col-xl-4 offset-lg-2 col-lg-4 contact-item ">
                            <div class="contact">��������</div>
                            <div class="contact">+7 (8352) 25-92-33</div>
                            <div class="contact">����������� - ������� � 8.00 �� 17.00</div>
                        </div>
                        <div class="col-xl-3  col-lg-3 contact-item">
                            <div class="contact">�������������</div>
                            <div class="contact">+7 (8352) 53-22-66</div>
                            <div class="contact">�������������</div>
                        </div>
<!--                        <div class="col-xl-3 col-lg-3 contact-item">
                            <div class="contact">�����</div>
                            <div class="contact">mail@���������-��������.��</div>
                            <div class="contact">��� ����� ���������</div>
                        </div>-->
                    </div>
                </div>
            <!-- ���� � ������ ������� � ����������� -->
            <div class="container">
                <div class="row menu">
                    <div class="col-xl-8 col-md-12 navig nav">
                    </div>
					<div class="col-xl-4 col-md-12 navig-2">
                        <li class="navigation-items" <?php if ($USER->IsAuthorized()) echo 'style="display:none"'?>>
							<img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector.png" alt="">
							<?php if (!($USER->IsAuthorized())) echo '<a class="window-open" href="javascript:void(0)" window="window-auth" init="true">���� � ������ �������</a>' ?>
							
							<li class="navigation-items" <?php if ($USER->IsAuthorized()) echo 'style="display:none"'?>>
                            <img class="vector" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/Vector-pencil.svg" alt="">
                        <a class="window-open" href="javascript:void(0)" window="window-register" init="true">�����������</a>
						</li>
                    </div>
                </div>
            </div>
        </div>
        <div class="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div><!-- �������� ����� � ��������� � �� ������ � ������ ������� � ����������� -->
    <div class="row">
        <div class="col-md-12">
            <!-- ��������� �������� ���� -->

<style>

    /*| Navigation |*/

    nav{
        /*background: #334;*/ /* ������ �������� ��� ���� */
        padding: 0 3%; /* ������ ���������� ������� */
        z-index: 100;
    }

    nav ul {
        list-style: none; /* ������� ������ ��� ��������� ������ */
    }

    nav ul li {
        display:inline-block;/*����������� ������ ���� � ��� �� ����������� */
    }

    nav ul li a {
        display:block; /* ����������� ���������� ������� ���� */
        padding: 15px 20px;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        line-height: 19px;
        color: #FFFFFF;
        letter-spacing: 1px;
        text-decoration: none;
        /*text-transform: uppercase;*/
        /*border-top: 1px solid #445;*/
    }
    nav > ul > li > ul > li > a{
        /*���������� ����*/
        align: center;
        font-weight: normal;
        clear: both;
        border-radius: 50px;
    }
    nav ul li a:hover{
        /*���� ������ ��� ���������*/
        color:#FFFFFF;
        border-radius: 50px;
    }
    navigation:hover {
        box-shadow: 0 0 0 99999px rgba(0, 0, 0, 0.8);
    }
    nav ul li:hover {
        background: #4A76A8; /* ������ ��� ������ ���� ��� ��������� ��������� ���� */
        border-radius: 50px;
    }

    nav ul li ul {
        display: none; /* ������ ������ ����������� ����� ���� */
        position:absolute;
        z-index: 6;
        /*background: #ccc;*/ /* ������ ��� ����������� ����� ���� */
        float: none;
        padding-inline-start: 20px;
    }

    nav ul li:hover ul {
        display:block; /* ���������� ������� ��� ��������� ���� */
        Z-index:4;
    }

    nav ul li ul li {
        display:block; /* ����������� �� ��������� ������ ����������� ���� */
    }

    nav ul li a:hover {
        /*��� ��������� �� ������� ��� �����������*/
        box-shadow: 0 0 0 99999px rgba(0, 0, 0, 0.8);
    }
</style>

<div class="container zatemnenie">
        <div class="row menu">
            <div class="col-xl-12 col-md-12 navig nav">
                <nav role="navigation">
                    <ul id="ul">
                        <!--<li><a href="/">�������</a></li>-->
                        <li><a href="/company/about.php">� ��������</a>
                            <ul class="submenu">
                                <li><a href="/company/news.php">�������</a></li>
                                <li><a href="/company/services.php">������</a></li>
                                <li><a href="/company/jobs.php">��������</a></li>
                                <li><a href="/company/paid_services.php">������� ������</a></li>
                                <li><a href="/company/docs.php">���������</a></li>
                            </ul>
                        </li>
                        <li><a href="/contacts/grafik-raboty.php">���������� ����������</a>
                            <ul class="submenu" style="padding-inline-start: 60px;">
                                <li><a href="/contacts/grafik-raboty.php">������ ������</a></li>
                                <li><a href="/contacts/requisites.php">���������</a></li>
                            </ul>
                        </li>
                        <li><a href="/doma-v-obsluzhivanii/">���� � ������������</a>
                            <ul class="submenu" style="padding-inline-start: 40px;">
                                <li><a href="/doma-v-obsluzhivanii/ooo-dostoyanie.php">��� "���������"</a></li>
                                <li><a href="/doma-v-obsluzhivanii/ooo-nasledie.php">��� "��������"</a></li>
                            </ul>
                        </li>
                        <li><a href="/vopros/">������ ������?</a></li>
						<li>
							
							<?php if ($USER->IsAuthorized()) echo '<a href="/personal/info">������ �������</a>'?>
                            <ul class="submenu">
                                <li><a href="/personal/info/">����� ����������</a></li>
                                <li><a href="/personal/circulating-sheet/">������� ���������� � �����</a></li>
                                <li><a href="/personal/receipt/">��������� �� ������ ������������ �����</a></li>
                                <li><a href="/personal/meters/">������ ���������</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
</div>

<!-- ������ ��� ��������� ��������� ���� -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(".five li ul").hide();
        $(".five li:has('.submenu')").hover(
            function(){
                $(".five li ul").stop().fadeToggle(300);}
        );
    </script>
        </div>
    </div>
</div>