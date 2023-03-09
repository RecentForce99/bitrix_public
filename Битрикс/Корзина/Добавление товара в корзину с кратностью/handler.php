<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
Bitrix\Main\Loader::includeModule("catalog");

($_POST['QUANTITY']) ?: $_POST['QUANTITY'] = 1;

$fields = [
    'PRODUCT_ID' => $_POST['ID'],
    'QUANTITY' => $_POST['QUANTITY'],
];
$r = Bitrix\Catalog\Product\Basket::addProduct($fields);

$basket = \Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
$countProduct = array_sum($basket->getQuantityList());

die($countProduct);
?>