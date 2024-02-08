<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<h2>Католог:</h2>
<?= time();?>
<?if($arResult["ITEMS"]):?>
	<ul>
		<? foreach($arResult["ITEMS"] as $arItem):?>
			<li><?= $arItem["NAME"] ?>
				<ul>
					<?foreach($arItem["PRODUCTS"] as $arProduct):?>
						<li><a href="<?= $arProduct["URL"]?>"><?= $arProduct["NAME"]?> - <?= $arProduct["PROPERTY_PRICE_VALUE"]?> - <?= $arProduct["PROPERTY_MATERIAL_VALUE"]?> - <?= $arProduct["PROPERTY_ARTNUMBER_VALUE"]?></a></li>
					<?endforeach;?>
				</ul>
			</li>
		<?endforeach;?>
	</ul>
<?endif;?>
