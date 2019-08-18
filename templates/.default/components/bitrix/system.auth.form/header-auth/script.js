$(document).ready(function () {
    $('.block-auth-form').each(
        function () {
            $(this).submit(
                function () {
                    var submitButton = $(this).find('input[type=submit]');
                    $(submitButton).toggleClass('tszh-auth__lg-progress');
                    var formAuth = $(this);
                    $.post(tszh.siteDir + 'ajax/auth.php', $(this).serialize(),
                        function (response) {
                            response = response.replace(/<\/?[^>]+>/g, '');
                            if (response == 'Auth|Y' || response.length > 200) {
                                var tourl = formAuth.find('input[name="tourl"]').val();
                                window.location.href = tourl !== undefined ? tourl : window.location.href;
                            }
                            else {
                                response = response.split('|');
                                switch (response[0])
                                {
                                    case 'Redirect':
                                        window.location.href = response[1] !== undefined ? response[1] : window.location.href;
                                        break;
                                    default:
                                        if (response[3] && response[4].length > 0) {

                                            //head-auth
                                            $('#captcha_img').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + response[4]);
                                            $('#captcha_sid').attr('value', response[4]);
                                            $('#block_captcha_img').show();
                                            $('#block_captcha_word').show();

                                            //footer-auth
                                            $('#captcha_img_foot').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + response[4]);
                                            $('#captcha_sid_foot').attr('value', response[4]);
                                            $('#captcha_word_foot').show();
                                            $('#captcha_img_foot').show();
                                        }
                                        $('.block-auth-form__error').html(response[1]).show();
                                        break;
                                }
                            }
                            $(submitButton).toggleClass('tszh-auth__lg-progress');
                        }, 'html');
                    return false;
                });
        });
    $('.block-password-recovery-form').each(
        function () {
            $(this).submit(
                function () {
                    var submitButton = $(this).find('input[type=submit]');
                    $(submitButton).toggleClass('tszh-auth__lg-progress');
                    $.post(tszh.siteDir + 'ajax/auth.php', $(this).serialize(),
                        function (response) {
                            response = response.replace(/<\/?[^>]+>/g, '');
                            response = response.split('|');
                            if (response[0]=='ERROR') {
                                $('.block-password-recovery-form__error').html(response[1]).show();
                                $('.block-password-recovery-form__account_info_sent').hide();
                                $.getJSON($('#temp').val() + '/reload_capcha.php', function (data) {
                                    $('#captcha_img').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + data);
                                    $('#captcha_sid').val(data);
                                    $('#captcha_word').val('');
                                });
                            }
                            if (response[0]=='OK') {
                                $('.block-password-recovery-form__account_info_sent').html(response[1]).show();
                                $('.block-password-recovery-form__error').hide();
                                $('#window__inputs-recovery').hide();
                                $('#window__sendbutton-recovery').prop('disabled', true);
                                $('#window__sendbutton-recovery').hide();
                                $('#window__text_or-recovery').hide();
                                $('#window__enter-recovery').css("text-align","center");
                            }
                            $(submitButton).toggleClass('tszh-auth__lg-progress');
                        }, 'html');
                    return false;
                });
        });
});