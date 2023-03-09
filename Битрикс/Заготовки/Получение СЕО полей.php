<?php
CModule::IncludeModule("iblock");

//Для разделов
$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
  $iblockID, // ID инфоблока
  $sectionID // ID Раздела
);
$IPROPERTY  = $ipropValues->getValues();

$APPLICATION->SetPageProperty("keywords", $IPROPERTY['SECTION_META_KEYWORDS']);
$APPLICATION->SetPageProperty("title", $IPROPERTY['SECTION_META_TITLE']);
$APPLICATION->SetPageProperty("description", $IPROPERTY['SECTION_META_DESCRIPTION']);


//Для элементов
$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
                        $iblockID, // ID инфоблока
                        $itemID // ID элемента
                    );
$arElMetaProp = $ipropValues->getValues();

?>
