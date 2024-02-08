<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $USER;
global $CACHE_MANAGER;
global $APPLICATION;

if(!$arParams["IBLOCK_ID"] || !$arParams["CODE_PRODUCT"]){
	ShowError("Ошибка");
	return;
}

if(!isset($arParams["CACHE_TIME"])){
	$arParams["CACHE_TIME"] = 36000000;
}

if($this->startResultCache(
	false,
	[
		$USER->GetGroups(),
		false,
		false
	],
)){

	if(!CModule::includeModule("iblock")){
		$this->abortResultCache();
		ShowError("Ошибка");
		return;
	}

	if(defined('BX_COMP_MANAGED_CACHE')){
		$CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["CODE_PRODUCT"]);
	}

	$arFilterTmp = ["IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "!PROPERTY_" . $arParams["CODE_PRODUCT"] => false, "CHECK_PERMISSIONS"=>"Y"];
	$arSelectTmp = ["IBLOCK_ID", "NAME", "ID", "PROPERTY_" . $arParams["CODE_PRODUCT"], "IBLOCK_SECTION_ID", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER"];
	$arSortTmp = ["NAME"=>"ASC"];
	$arTmp = [];
	$arResult["ID"] = [];

	$resTmp = CIBlockElement::GetList($arSortTmp, $arFilterTmp, false, false, $arSelectTmp);
	while($arItemTmp = $resTmp->GetNext()){
		$arItemTmp["URL"] = str_replace("#SECTION_ID#", $arItemTmp["IBLOCK_SECTION_ID"], $arParams["PATTERN_DETAIL"]);
		$arItemTmp["URL"] = str_replace("#ELEMENT_ID#", $arItemTmp["ID"], $arItemTmp["URL"]);
		$arTmp[] = $arItemTmp;

		$arResult["ID"] = array_merge($arResult["ID"], $arItemTmp["PROPERTY_" . $arParams["CODE_PRODUCT"] . "_VALUE"]);
	}

	$arResult["ID"] = array_unique($arResult["ID"]);
	$arFilter = ["IBLOCK_ID"=>$arParams["IBLOCK_ID_CLASS"], "ACTIVE"=>"Y", "CHECK_PERMISSIONS"=>"Y", "ID"=>$arResult["ID"]];
	$arSelect = ["IBLOCK_ID", "NAME", "ID"];
	$arSort = ["NAME"=>"ASC"];

	$arResult["ITEMS"] = [];
	$res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

	while($arItem = $res->GetNext()){
		foreach($arTmp as $tmp){
			if(in_array($arItem["ID"], $tmp["PROPERTY_" . $arParams["CODE_PRODUCT"] . "_VALUE"])){
				$arItem["PRODUCTS"][] = $tmp;

			}
		}

		$arResult["ITEMS"][] = $arItem;
	}

	$this->SetResultCacheKeys(["ID"]);

	$this->IncludeComponentTemplate();
}

$title = "Разделов: [" . count($arResult["ID"]) . "]";
$APPLICATION->SetTitle($title);
$APPLICATION->SetPageProperty('title', $title);
?>