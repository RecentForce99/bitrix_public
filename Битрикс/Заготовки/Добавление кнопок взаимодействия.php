<?php

function getButtonsEditable(array $objectArg) : array
{
    $object = [];

    $arButtons = CIBlock::GetPanelButtons($objectArg['IBLOCK_ID'], $objectArg['ID']);
        $object['ADD_LINK'] = $arButtons["edit"]["add_element"]["ACTION_URL"];
        $object['EDIT_LINK'] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $object['DELETE_LINK'] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

        $object["ADD_LINK_TEXT"] = $arButtons["edit"]["add_element"]["TEXT"];
        $object["EDIT_LINK_TEXT"] = $arButtons["edit"]["edit_element"]["TEXT"];
        $object["DELETE_LINK_TEXT"] = $arButtons["edit"]["delete_element"]["TEXT"];

    return $object;
}
   


    $arButtons = CIBlock::GetPanelButtons(
        $item['IBLOCK_ID'],
        $item['ID'], // указываем либо ID элемента, либо ID раздела ниже
        $item['IBLOCK_SECTION_ID'],
    );
    $item['ADD_LINK'] = $arButtons["edit"]["add_element"]["ACTION_URL"];
    $item['EDIT_LINK'] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
    $item['DELETE_LINK'] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

    $item["ADD_LINK_TEXT"] = $arButtons["edit"]["add_element"]["TEXT"];
    $item["EDIT_LINK_TEXT"] = $arButtons["edit"]["edit_element"]["TEXT"];
    $item["DELETE_LINK_TEXT"] = $arButtons["edit"]["delete_element"]["TEXT"];

    $this->AddEditAction($item['ID'], $item['ADD_LINK'], $item["ADD_LINK_TEXT"]);
    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], $item["EDIT_LINK_TEXT"]);
    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], $item["DELETE_LINK_TEXT"], array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
?>
<div id="<?=$this->GetEditAreaId($item['ID']);?>">
<!--DATA...-->
</div>
