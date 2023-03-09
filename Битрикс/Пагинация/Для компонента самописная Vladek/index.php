<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
$GLOBALS['NEWS']['NAV_RESULT'] = 0;
?>

<section class="all-news">
    <div class="container">

        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "novosti",
            array(
                "ACTIVE_DATE_FORMAT" => "j F Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "NAME",
                    1 => "DATE_CREATE",
                    2 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "6",
                "IBLOCK_TYPE" => "Raznoe",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "3",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "REJTING",
                    2 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "Y",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "novosti"
            ),
            false
        );?>

        <div class="all-news__pagination pagination-custom pagination-custom-uslugi-ajax" type-id="<?=$GLOBALS['NEWS']["NAV_RESULT"]->NavNum?>">
            <?
            $radius = 3;
            $pagin = ($_GET['PAGEN_'.$GLOBALS['NEWS']["NAV_RESULT"]->NavNum] ?: 1);
            $NavPageCount = $GLOBALS['NEWS']["NAV_RESULT"]->NavPageCount;
            ?>

            <a class="pagination-custom__arrow-prev <? if($pagin == 1) echo 'disabled-btn'; else echo 'pagination-custom__item-uslugi-ajax'?>" page-id="<?=$pagin-1?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-black-prev.svg" alt="">
            </a>
            <div class="pagination-custom__numbers">
                <?php for ( $i = 1; $i <= $NavPageCount; $i++ ):?>
                    <?php if($i > $pagin - $radius && $i < $pagin + $radius || ($pagin == 1 && $i < $radius)):?> <!--Вывод остальных страниц-->
                        <a class="pagination-custom__item pagination-custom__item-uslugi-ajax <?php if($pagin == $i) echo 'active';?>" page-id="<?=$i?>"><?=$i?></a>
                    <?php endif;?>
                <?php endfor;?>
            </div>
            <a class="pagination-custom__arrow-next pagination-custom__item-uslugi-ajax
                    <? if($pagin == $NavPageCount) echo 'disabled-btn'; else echo 'pagination-custom__item-uslugi-ajax'?>" page-id="<?=$pagin+1?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-black.svg" alt="">
            </a>

        </div>
    </div>
</section>