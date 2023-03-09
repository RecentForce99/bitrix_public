<?php
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
?>






