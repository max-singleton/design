/*
$(document).ready(function()
{
    $('.block-auth-form').each(
        function()
        {
            $(this).submit(
                function()
                {
                    var formAuth = $(this);
                    $.post( '/ajax/auth.php', $(this).serialize(),
                        function( response )
                        {
                            response = response.replace(/<\/?[^>]+>/g,'');
                            if (response == 'Y' || response.length > 200)
                            {
                                var tourl = formAuth.find('input[name="tourl"]').val();
                                window.location.href = tourl !== undefined ? tourl : window.location.href;
                            }
                            else
                            {
                                $('.block-auth-form__error').html(response).show();
                            }
                        }, 'html' );
                    return false;
                });
        });
});*/
