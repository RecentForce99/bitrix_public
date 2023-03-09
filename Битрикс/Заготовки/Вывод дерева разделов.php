<?php

$elements = $this->getElements();
$sectionsTable = SectionTable::getList(
    [
        'select' => [
            'IBLOCK_ID',
            'ID',
            'NAME',
            'DEPTH_LEVEL',
            'IBLOCK_SECTION_ID',
        ],
        'filter' => [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $this->iblockId,
            'GLOBAL_ACTIVE' => 'Y',
            '>=LEFT_MARGIN' => $this->leftMargin,
            '<=RIGHT_MARGIN' => $this->rightMargin,
        ],
        'order' => [
            'DEPTH_LEVEL' => 'ASC',
            'SORT' => 'ASC'
        ],
        'cache' => $this->cacheTime,
    ]
);
while ($section = $sectionsTable->fetch()) {
    $sectionID = intval($section['IBLOCK_SECTION_ID']);

    if ($section['DEPTH_LEVEL'] == 3) {
        $section['ELEMENTS'] = $elements[$section['ID']];
    }
    $sections[$sectionID]['CHILD'][$section['ID']] = $section;
    $sections[$section['ID']] = &$sections[$sectionID]['CHILD'][$section['ID']];
}
?>
