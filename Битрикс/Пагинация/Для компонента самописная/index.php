<?php 
$GLOBALS['NEWS']['NAV_RESULT'];
// Список новостей
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "template2",
    array(
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "1",
        "NEWS_COUNT" => "3",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "CODE",
            3 => "NAME",
            6 => "PREVIEW_TEXT",
            7 => "PREVIEW_PICTURE",
            21 => "DATE_CREATE",
        ),
        "PROPERTY_CODE" => array(
            0 => "ADVANTAGES",
            1 => "TEXT_BEFORE",
            2 => "TEXT_AFTER",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "Y",
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
        "PAGER_TEMPLATE" => "round",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "COMPONENT_TEMPLATE" => "template1",
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
);
?>

<div class="portfolio-pagination">
    <?

    $NavPageNomer = $GLOBALS["NAV_RESULT"]->NavPageNomer;
    $NavPageCount = $GLOBALS["NAV_RESULT"]->NavPageCount;
    $link         = $APPLICATION->GetCurPage() . "?PAGEN_" . $GLOBALS["NAV_RESULT"]->NavNum . "=";
    ?>

    <? if($NavPageNomer!=1): ?>
        <a href="<?=$link . ($NavPageNomer-1)?>" class="portfolio-pagination__btn portfolio-pagination__btn-prev">
            Назад
        </a>
    <? else: ?>
        <a href="javascript:void(0)" class="portfolio-pagination__btn portfolio-pagination__btn-prev">
            Назад
        </a>
    <? endif; ?>

    <div class="portfolio-pagination__list">

        <? if($NavPageNomer > 2): ?>
            <a href="<?=$link . "1"?>" class="portfolio-pagination__item">1</a>
        <? endif; ?>

        <? if($NavPageNomer != 1): ?>

            <? if( ($NavPageNomer-1) - 1 > 1): ?>
                <a href="javascript:void(0)" class="portfolio-pagination__item empty">...</a>
            <? endif; ?>

            <a href="<?=$link . ($NavPageNomer-1)?>" class="portfolio-pagination__item"><?= $NavPageNomer-1 ?></a>
        <? endif; ?>

        <a class="portfolio-pagination__item active"><?= $NavPageNomer ?></a>

        <? if($NavPageNomer != $NavPageCount): ?>
            <a href="<?=$link . ($NavPageNomer+1)?>" class="portfolio-pagination__item"><?= $NavPageNomer+1 ?></a>

            <? if($NavPageCount - ($NavPageNomer+1) > 1): ?>
                <a href="javascript:void(0)" class="portfolio-pagination__item empty">...</a>
            <? endif; ?>
        <? endif; ?>

        <? if($NavPageNomer < $NavPageCount-1): ?>
            <a href="<?=$link . $NavPageCount?>" class="portfolio-pagination__item"><?= $NavPageCount ?></a>
        <? endif; ?>

    </div>

    <? if($NavPageNomer!=$NavPageCount): ?>
        <a href="<?=$link . ($NavPageNomer+1)?>" class="portfolio-pagination__btn portfolio-pagination__btn-next">
            Вперёд
        </a>
    <? else: ?>
        <a href="javascript:void(0)" class="portfolio-pagination__btn portfolio-pagination__btn-next">
            Вперёд
        </a>
    <? endif; ?>
</div>
