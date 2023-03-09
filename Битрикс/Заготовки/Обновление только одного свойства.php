<?php
if($PRODUCT_ID = CIBlockElement::SetPropertyValueCode($elementID, "SCORE", $dublicats))
    echo "New ID: ".$PRODUCT_ID;
else
    echo "Error: ".$el->LAST_ERROR;
?>
