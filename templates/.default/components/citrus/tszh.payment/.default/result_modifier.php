<?php
if (!$USER->IsAuthorized()) {
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
    return;
}
?>