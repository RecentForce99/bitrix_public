<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

//Формируем сортировку, причем передаём в компонент уже готовый для работы метод сортировки
//Если сейчас выбран ASC, возвращаем DESC

$GLOBALS['STATES']['SORT']['FIELD']['DATE']   = $mainField = 'CREATED_DATE';
$GLOBALS['STATES']['SORT']['METHOD']['DATE']  = $mainMethod = 'ASC';

$GLOBALS['STATES']['SORT']['FIELD']['PRICE']  = $secondField = 'CATALOG_PRICE_1';
$GLOBALS['STATES']['SORT']['METHOD']['PRICE'] = $secondMethod = 'DESC';

if (
    isset($_GET["field"]) && isset($_GET["method"]) && (
        $_GET["field"] == "CATALOG_PRICE_1" ||
        $_GET["field"] == "CREATED_DATE" ||
        $_GET["method"] == "ASC" ||
        $_GET["method"] == "DESC"
    ))
{
    $mainField = $_GET["field"];
    $mainMethod = $_GET["method"];

    if($mainField == 'CREATED_DATE')
    {
        $secondField  = 'CATALOG_PRICE_1';
        $secondMethod = 'ASC';

        $GLOBALS['STATES']['SORT']['METHOD']['DATE']   = ($mainMethod == 'DESC') ? 'ASC' : 'DESC';
        $GLOBALS['STATES']['SORT']['METHOD']['PRICE'] = ($secondMethod == 'DESC') ? 'ASC' : 'DESC';
    }
    else
    {
        $secondField  = 'CREATED_DATE';
        $secondMethod = 'DESC';

        $GLOBALS['STATES']['SORT']['METHOD']['DATE']   = ($secondMethod == 'DESC') ? 'ASC' : 'DESC';
        $GLOBALS['STATES']['SORT']['METHOD']['PRICE'] = ($mainMethod == 'DESC') ? 'ASC' : 'DESC';

    }


}

?>

<?php
// Список новостей

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "states",
    array(
        "IBLOCK_TYPE" => "objects_edit",
        "IBLOCK_ID" => "4",
        "NEWS_COUNT" => "12",
        "SORT_BY1"    => $mainField,
        "SORT_ORDER1" => $mainMethod,
        "SORT_BY2"    => $secondField,
        "SORT_ORDER2" => $secondMethod,
        "FILTER_NAME" => "arrFilter",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "NAME",
            2 => "PREVIEW_TEXT",
            3 => "PREVIEW_PICTURE",
            4 => "DETAIL_TEXT",
            5 => "DETAIL_PICTURE",
            6 => "CATALOG_PRICE_1",
        ),
        "PROPERTY_CODE" => array(),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_NOTES" => "",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "COMPONENT_TEMPLATE" => "states",
        "SET_LAST_MODIFIED" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => ""
    ),
    false
);?>
