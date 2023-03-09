<?php

//Лучше всего использовать компоненты, там этот функционал встроен по умолчанию.

function getTypeTreatment() : array
{
	$dropDownListIB = getTypeTreatmentDropDownList();
	$typeTreament = [];

	$typesIB = CIBlockElement::GetList(
		array(),
		array('IBLOCK_ID' => 21, 'ACTIVE' => 'Y'),
		false,
		array(),
		array(
			'ID', 'PROPERTY_BANNER', 'PROPERTY_TITLE', 'PROPERTY_SUBTITLE','PROPERTY_LINK_PAGE'
		)
	);
	while($typeIB = $typesIB->GetNext())
	{
		if($dropDownListIB)
			$typeIB['DROP_DOWN_LIST'] = getDropDownElementsPerType($dropDownListIB, $typeIB['ID']); 

		$typeTreament[] = $typeIB;
	}

	return $typeTreament;
} 

function getTypeTreatmentDropDownList() : array
{
	$dropDownList = [];
	
	$dropDownListIB = CIBlockElement::GetList(
		array(),
		array('IBLOCK_ID' => 22, 'ACTIVE' => 'Y'),
		false,
		array(),
		array(
			'PROPERTY_ICON', 'PROPERTY_NAME', 'PROPERTY_PARENT_ID', 'PROPERTY_LINK'
		)
	);
	while ($element = $dropDownListIB->GetNext())
	{
		$dropDownList[] = $element;
	}
	
	return $dropDownList;
}

function getDropDownElementsPerType($dropDownListIB, $typeID) : array
{
	$dropDownList = [];

	foreach($dropDownListIB as $el)
	{
		if($el['PROPERTY_PARENT_ID_VALUE'] == $typeID)
			$dropDownList[] = $el;
	}

	return $dropDownList;
}

?>
