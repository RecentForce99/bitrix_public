<?php
$items = CIBlockElement::GetList(
array(), 
array('IBLOCK_ID' => $iblockID, 'ACTIVE' => 'Y'), 
false, 
array(),
array());
while($item = $items->GetNext()) {}
?>
