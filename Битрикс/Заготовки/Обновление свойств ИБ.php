<?php
$el = new CIBlockElement;
$arLoadProductArray = Array(
    "PROPERTY_VALUES"=> array('SCORE' => $dublicats)
);
if($PRODUCT_ID = $el->Update($elementID, $arLoadProductArray))
    echo "New ID: ".$PRODUCT_ID;
else
    echo "Error: ".$el->LAST_ERROR;
?>
