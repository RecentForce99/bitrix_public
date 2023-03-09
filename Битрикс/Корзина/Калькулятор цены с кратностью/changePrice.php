<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
use Bitrix\Sale;
global $USER;

 

function getPriceWithDiscount($itemID, $price)
{
    global $USER;
    $groups = $USER->GetUserGroupArray();
    $arDiscounts = \CCatalogDiscount::GetDiscountByProduct($itemID, $groups, "N", 1, 's1'
    );
    if(empty($arDiscounts)) return ceil($price);
    foreach ($arDiscounts as $discount)
    {
        $result = $price - ($price / 100 * $discount['VALUE']);
    }
    return ceil($result);
}

function getItemsCount($firstCountFromForm) : array
{
    if($firstCountFromForm > 2)
    {
        for ( $i = 0; $i < $firstCountFromForm; $i++ )
        {
            $result = ['REMAINS' => $i, 'NUM' => $firstCountFromForm - $i];
            if( ($firstCountFromForm - $i) % 3 == 0 || ($firstCountFromForm) % 3 == 0 ) break;
        }
    }
    else $result = ['REMAINS' => 0, 'NUM' => $firstCountFromForm];

    return $result;
}

function deleteAllElements($ID)
{
    $basket = \Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
    $itemQuant = 0;
    foreach ($basket as $basketItem) {
        if ($basketItem->getField('PRODUCT_ID') == $ID) $itemQuant += $basketItem->getField('QUANTITY');
    }
    if($itemQuant == 0) return true;

    if (CModule::IncludeModule('sale')) {
        $dbBasketItems = CSaleBasket::GetList(array(), array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'NULL',
            'PRODUCT_ID' => $ID));
        if ($arBasket = $dbBasketItems->Fetch()) {
            CSaleBasket::Delete($arBasket['ID']);
        }
    }

    return deleteAllElements($ID);
}

$basket = \Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
$divider = 3;
$ID = $_POST['id'];

$info = CIBlockElement::GetList(array(), array('IBLOCK_ID' => array(2, 3), 'ID' => $ID, 'ACTIVE' => 'Y'), false, array(), array('ID', 'CATALOG_PRICE_1', 'PROPERTY_SALE_DIVIDER'));
$element = $info->GetNext();

($element['PROPERTY_SALE_DIVIDER_VALUE']) ?: $element['PROPERTY_SALE_DIVIDER_VALUE'] = 0;
($_POST['count'] <= 0) ? $itemQuantSum = 1 : $itemQuantSum = $_POST['count'];
$itemQuant = getItemsCount($itemQuantSum);
if ($_POST['address'] == 'catalog')
{
    $dividerPrice = getPriceWithDiscount($ID, $element['CATALOG_PRICE_1']) - $element['PROPERTY_SALE_DIVIDER_VALUE'];
    $clearPrice   = getPriceWithDiscount($ID, $element['CATALOG_PRICE_1']);

    if(is_numeric($result) && $result >= $divider) $result = $dividerPrice * $itemQuantSum;
    elseif(is_numeric($result) && $result < $divider) $result = $clearPrice * $itemQuantSum;
    else $result = ($clearPrice * $itemQuant['REMAINS']) + ($dividerPrice * $itemQuant['NUM']);
}
elseif ($_POST['address'] == 'basket')
{
    deleteAllElements($ID);

    if($itemQuant['NUM'] >= $divider && $itemQuant['REMAINS'] == 0)
    {
        $item = $basket->createItem('catalog', $ID);
        $item->setFields(array(
            'QUANTITY'     => $itemQuant['NUM'],
            'CURRENCY'     => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID'          => Bitrix\Main\Context::getCurrent()->getSite(),
            'PRICE'        => getPriceWithDiscount($ID, $element['CATALOG_PRICE_1']) - $element['PROPERTY_SALE_DIVIDER_VALUE'],
            'BASE_PRICE'   => $element['CATALOG_PRICE_1'],
            'CUSTOM_PRICE' => 'Y',
        ));
    }
    elseif($itemQuant['NUM'] < $divider && $itemQuant['REMAINS'] == 0)
    {
        $item = $basket->createItem('catalog', $ID);
        $item->setFields(array(
            'QUANTITY'     => $itemQuant['NUM'],
            'CURRENCY'     => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID'          => Bitrix\Main\Context::getCurrent()->getSite(),
            'PRICE'        => getPriceWithDiscount($ID, $element['CATALOG_PRICE_1']),
            'BASE_PRICE'   => $element['CATALOG_PRICE_1'],
            'CUSTOM_PRICE' => 'Y',
        ));
    }
    else
    {
        $item = $basket->createItem('catalog', $ID);
        $item->setFields(array(
            'QUANTITY'     => $itemQuant['REMAINS'],
            'CURRENCY'     => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID'          => Bitrix\Main\Context::getCurrent()->getSite(),
            'PRICE'        => getPriceWithDiscount($ID, $element['CATALOG_PRICE_1']),
            'BASE_PRICE'   => $element['CATALOG_PRICE_1'],
            'CUSTOM_PRICE' => 'Y',
        ));

        $item = $basket->createItem('catalog', $ID);
        $item->setFields(array(
            'QUANTITY'     => $itemQuant['NUM'],
            'CURRENCY'     => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID'          => Bitrix\Main\Context::getCurrent()->getSite(),
            'PRICE'        => getPriceWithDiscount($ID, $element['CATALOG_PRICE_1']) - $element['PROPERTY_SALE_DIVIDER_VALUE'],
            'BASE_PRICE'   => $element['CATALOG_PRICE_1'],
            'CUSTOM_PRICE' => 'Y',
        ));
    }

    $basket->save();

    $basket = \Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
    $countProduct = array_sum($basket->getQuantityList());
    $priceBasket = ceil($basket->getPrice());
    foreach ($basket as $basketItem)
    {
        if($basketItem->getField('PRODUCT_ID') == $element['ID']) $productPrice += $basketItem->getFinalPrice('PRICE');
    }

    $result = json_encode(['product' => ceil($productPrice), 'basket' => $priceBasket, 'countCart' => $countProduct]);
}

die($result);
