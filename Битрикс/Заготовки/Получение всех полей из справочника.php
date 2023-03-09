<?php
function getListName($prop)
{

    $arHighloadProperty = $prop;

    $sTableName = $arHighloadProperty['USER_TYPE_SETTINGS']['TABLE_NAME'];

    if ( Loader::IncludeModule('highloadblock') && !empty($sTableName) && !empty($arHighloadProperty["VALUE"]) )
    {
        $hlblock = HL\HighloadBlockTable::getRow([
            'filter' => [
                '=TABLE_NAME' => $sTableName
            ],
        ]);

        if ( $hlblock )
        {
            $entity      = HL\HighloadBlockTable::compileEntity( $hlblock );
            $entityClass = $entity->getDataClass();

            $arRecords = $entityClass::getList([
                'filter' => [
                    'UF_XML_ID' => $arHighloadProperty["VALUE"]
                ],
            ]);
            foreach ($arRecords as $record)
            {
                $name = $record['UF_NAME'];
            }
        }
    }

    return $name;
}
?>

<!--Пример вызова--> <?=getListName($object['PROPERTIES']['GOROD'])?>


<?php
//Расширенная версия
function getListName($prop)
{

    $arHighloadProperty = $arResult["PROPERTIES"]['TEST'];

$sTableName = $arHighloadProperty['USER_TYPE_SETTINGS']['TABLE_NAME'];

if ( Loader::IncludeModule('highloadblock') && !empty($sTableName) && !empty($arHighloadProperty["VALUE"]) )
{
  
  $hlblock = HL\HighloadBlockTable::getRow([
    'filter' => [
      '=TABLE_NAME' => $sTableName
    ],
  ]);

  if ( $hlblock )
  {
    
    $entity      = HL\HighloadBlockTable::compileEntity( $hlblock );
    $entityClass = $entity->getDataClass();
    
    $arRecords = $entityClass::getList([
      'filter' => [
        'UF_XML_ID' => $arHighloadProperty["VALUE"]
      ],
    ]);
    foreach ($arRecords as $record)
    {	
      $arRecord = [
        'ID'                  => $record['ID'],
        'UF_NAME'             => $record['UF_NAME'],
        'UF_SORT'             => $record['UF_SORT'],
        'UF_XML_ID'           => $record['UF_XML_ID'],
        'UF_LINK'             => $record['UF_LINK'],
        'UF_DESCRIPTION'      => $record['UF_DESCRIPTION'],
        'UF_FULL_DESCRIPTION' => $record['UF_FULL_DESCRIPTION'],
        'UF_DEF'              => $record['UF_DEF'],
        'UF_FILE'             => [],
        '~UF_FILE'            => $record['UF_FILE'],
      ];

      if ( !empty($arRecord['~UF_FILE']) )
      {
        $arRecord['UF_FILE'] = \CFile::getById($arRecord['~UF_FILE'])->fetch();
      }

      $arHighloadProperty['EXTRA_VALUE'][] = $arRecord;
    }
  }
}
  
  return $arRecord;
  
}
?>
