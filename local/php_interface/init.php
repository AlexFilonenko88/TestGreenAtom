<?php
define("BX_COMP_MANAGED_CACHE", true);
AddEventHandler("main", "OnBeforeEventAdd", "OnBeforeEventSendHandler");

function OnBeforeEventSendHandler($event, $lid, &$arFields) {
	global $USER;
	if($USER->IsAuthorized()) {
		$arFields["AUTHOR"] = 'Пользователь авторизован: ' . $USER->GetID() . ' (' . $USER->GetLogin() . ') ' . $USER->GetFullName() . ', данные из формы: ' . $arFields["AUTHOR"];
	} else {
		$arFields["AUTHOR"] = 'Пользователь не авторизован, данные из формы: ' . $arFields["AUTHOR"];
	}
}
?>