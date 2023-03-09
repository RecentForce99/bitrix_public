<?php

namespace Vladek\Tools\Base\Block;

use Bitrix\Iblock\ElementTable;
use CIBlockElement;
use mysql_xdevapi\Exception;
use Vladek\Tools\Base\Helper;

class VladekBasket
{

    public function initCookies(): void
    {
        $basketStructure = [
            'FULL_PRICE' => 0,
            'QUANTITY' => 0,
            'PRODUCTS' => [
//                'POS_ID' => [
//                    'PRODUCT_ID' => 0,
//                    'BASE_PRICE' => 0,
//                    'QUANTITY' => 0,
//                    'SUM_PRICE' => 0,
//                ],
            ],
        ];
        setcookie('vladekBasket', json_encode($basketStructure), time() + 86400 * 30, '/');
    }

    public function getBasket(): array
    {
        return json_decode($_COOKIE['vladekBasket'], true) ?? [];
    }

    public function clearBasket(): bool
    {
        try {
            $this->initCookies();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getFullPrice(): float
    {
        $basket = json_decode($_COOKIE['vladekBasket'], true);
        return $basket['FULL_PRICE'] ?? 0;
    }

    public function getQuantity(): float
    {
        $basket = json_decode($_COOKIE['vladekBasket'], true);
        return $basket['QUANTITY'] ?? 0;
    }

    public function getProductsList()
    {
        $basket = json_decode($_COOKIE['vladekBasket'], true);

        foreach ($basket['PRODUCTS'] as $product) {
            yield $product;
        }
    }

    public function getProductByID($ID): ?array
    {
        $basket = json_decode($_COOKIE['vladekBasket'], true);
        $needle = [];
        foreach ($basket['PRODUCTS'] as $product) {
            if ($product['PRODUCT_ID'] == $ID) {
                $needle = $product;
            }
        }

        return $needle;
    }

    public function getProductByPosID($ID): ?array
    {
        $basket = json_decode($_COOKIE['vladekBasket'], true);
        $needle = [];
        foreach ($basket['PRODUCTS'] as $posID => $product) {
            if ($posID == $ID) {
                $needle = $product;
            }
        }

        return $needle;
    }

    public function addProduct($ID): bool
    {
        $basket = json_decode($_COOKIE['vladekBasket'], true);
        Helper::p($basket);
        $status = true;

        if (is_numeric($ID)) {
            $item = $this->getProductInfo($ID);
            if (!$item) {
                $status = false;
            } else {
                $basket['PRODUCTS'][] = $item;
            }
        } elseif (is_array($ID)) {
            $items = $this->getProductsInfo($ID);
            if (!$items) {
                $status = false;
            } else {
                $basket['PRODUCTS'] = array_merge($basket['PRODUCTS'], $items);
            }
        } else {
            $status = false;
        }

        setcookie('vladekBasket', json_encode($basket), time() + 86400 * 30, '/');

        return $status;
    }

    public function getProductInfo($ID): array
    {
        $productList = CIBlockElement::GetList(
            [],
            ['ID' => $ID, 'IBLOCK_ID' => Helper::CATALOG_IBLOCK_ID],
            false,
            false,
            ['ID', 'PROPERTY_CENA']
        );
        $product = $productList->GetNext();

        if ($product) {
            return [
                'PRODUCT_ID' => $product['ID'],
                'BASE_PRICE' => $product['PROPERTY_CENA_VALUE'],
                'QUANTITY' => 1,
                'SUM_PRICE' => $product['PROPERTY_CENA_VALUE'],
            ];
        }

        return [];
    }

    public function getProductsInfo($ID): array
    {
        $productList = CIBlockElement::GetList(
            [],
            ['ID' => $ID, 'IBLOCK_ID' => Helper::CATALOG_IBLOCK_ID],
            false,
            false,
            ['ID', 'PROPERTY_CENA']
        );

        $products = [];
        while ($productEl = $productList->GetNext()) {
            $products[] = [
                'PRODUCT_ID' => $productEl['ID'],
                'BASE_PRICE' => $productEl['PROPERTY_CENA_VALUE'],
                'QUANTITY' => 1,
                'SUM_PRICE' => $productEl['PROPERTY_CENA_VALUE'],
            ];
        }

        if ($products) {
            return $products;
        }

        return [];
    }

}
