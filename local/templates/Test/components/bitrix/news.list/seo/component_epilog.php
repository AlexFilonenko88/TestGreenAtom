<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);

CModule::IncludeModule('iblock');

global $APPLICATION;

$page = $APPLICATION->GetCurPage();

$ob = CIBlockElement::GetList([], ["ID"=>$arResult["ELEMENTS"], "IBLOCK_ID"=>$arResult["ID"], "NAME"=>$page], false, false, ["ID", "IBLOCK_ID", "NAME", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION"]);

while($arItem = $ob->GetNext()){
	if($arItem["NAME"] != $page){
		continue;
	}
	if($arItem["PROPERTY_TITLE_VALUE"]){
		$APPLICATION->SetPageProperty("title", $arItem["PROPERTY_TITLE_VALUE"]);
		$APPLICATION->SetTitle($arItem["PROPERTY_TITLE_VALUE"]);
	}
	if($arItem["PROPERTY_DESCRIPTION_VALUE"]){
		$APPLICATION->SetPageProperty("description", $arItem["PROPERTY_DESCRIPTION_VALUE"]);
	}
}
?>