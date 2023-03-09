<?
$radius = 3;
$show_arr = [];

$getStart = $_GET; //Копия первоначального урла
unset($_GET['PAGEN_' . $arResult['NAV_RESULT']->NavNum]); //Удаляем пагинацию
$forPagenav = '?'.http_build_query($_GET); //Ссылка для пагинации
$_GET = $getStart;

$_GET['field'] = $GLOBALS['STATES']['SORT']['FIELD']['DATE'];
$_GET['method'] = $GLOBALS['STATES']['SORT']['METHOD']['DATE'];
$sortByDate = $APPLICATION->GetCurPage().'?'.http_build_query($_GET);

$_GET['field'] = $GLOBALS['STATES']['SORT']['FIELD']['PRICE'];
$_GET['method'] = $GLOBALS['STATES']['SORT']['METHOD']['PRICE'];
$sortByPrice = $APPLICATION->GetCurPage().'?'.http_build_query($_GET);

$pagin = ($_GET['PAGEN_' . $arResult['NAV_RESULT']->NavNum] ?: 1); //Номер текущей страницы пагинации
$NavPageCount = $arResult['NAV_RESULT']->NavPageCount; //Количество страниц пагинации
$link = $forPagenav . "&PAGEN_" . $arResult["NAV_RESULT"]->NavNum . "=";
?>

<div class="real-estate__sorting-btns">

        <a href="<?=$sortByDate?>" class="real-estate__top-sorting-item">
            <div class="real-estate__sorting-item-name">По дате</div>
        </a>
        <a href="<?=$sortByPrice?>" class="real-estate__top-sorting-item">
            <div class="real-estate__sorting-item-name">По цене</div>
        </a>
    </div>