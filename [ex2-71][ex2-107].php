<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тест");
?><?$APPLICATION->IncludeComponent(
	"exam:simplecomp.exam", 
	".default", 
	array(
		"CODE_PRODUCT" => "COMPANY",
		"IBLOCK_ID" => "2",
		"IBLOCK_ID_CLASS" => "6",
		"PATTERN_DETAIL" => "/products/#SECTION_ID#/#ELEMENT_ID#/",
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "180",
		"CACHE_GROUPS" => "N"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>