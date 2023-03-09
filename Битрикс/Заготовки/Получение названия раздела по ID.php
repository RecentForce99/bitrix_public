<?php
  function sectionName($ID, $iblockID)
     {
         $sections = CIBlockSection::GetList(array(), Array('IBLOCK_ID' => $iblockID, 'ACTIVE' => 'Y', 'ID' => $ID), false,
             array('NAME'), false);
         $section = $sections->GetNext();

         return $section['NAME'];
     }
?>
