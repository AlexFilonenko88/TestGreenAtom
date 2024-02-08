<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters =[
	"GROUPS"=>[],
	"PARAMETERS"=>[
		"IBLOCK_ID"=>[
			"PARENT"=> "BASE",
			"NAME"=> "ID инфоблока с каталогом товаров",
			"TYPE"=> "STRING",
			"MULTIPLE"=> "N",
		],
		"IBLOCK_ID_CLASS"=>[
			"PARENT"=> "BASE",
			"NAME"=> "ID инфоблока с классификатором",
			"TYPE"=> "STRING",
			"MULTIPLE"=> "N",
		],
		"PATTERN_DETAIL"=>[
			"PARENT"=> "BASE",
			"NAME"=> "Шаблон ссылки на детальный просмотр товара, строка",
			"TYPE"=> "STRING",
			"MULTIPLE"=> "N",
		],
		"CODE_PRODUCT"=>[
			"PARENT"=> "BASE",
			"NAME"=> "Код свойства товара, в котором хранится привязка товара к классификатору, строка",
			"TYPE"=> "STRING",
			"MULTIPLE"=> "N",
		],
		"CACHE_TIME"  =>  ["DEFAULT"=>180],
	]
]
?>