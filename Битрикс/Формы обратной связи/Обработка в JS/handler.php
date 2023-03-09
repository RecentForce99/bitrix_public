<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
global $USER;

$props = ['PHONE' => $_POST['PHONE']];

$el = new CIBlockElement;

$upload = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_SECTION_ID" => 78,
    "IBLOCK_ID"      => 43,
    "PROPERTY_VALUES"=> $props,
    "NAME"           => $_POST['NAME'],
    "ACTIVE"         => "Y",
);
if($PRODUCT_ID = $el->Add($upload))
    echo 1;
else
    echo "Error: ".$el->LAST_ERROR;
?>
