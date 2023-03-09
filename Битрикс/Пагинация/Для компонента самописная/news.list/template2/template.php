<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$arSection = $arResult["SECTION"]["PATH"][count($arResult["SECTION"]["PATH"])-1];
$GLOBALS['NAV_RESULT'] = $arResult["NAV_RESULT"];
$monthsAr = [
    '01' => 'Января',
    '02' => 'Февраля',
    '03' => 'Марта',
    '04' => 'Апреля',
    '05' => 'Мая',
    '06' => 'Июня',
    '07' => 'Июля',
    '08' => 'Августа',
    '09' => 'Сентября',
    '10' => 'Октября',
    '11' => 'Ноября',
    '12' => 'Декабря',
];
$news = $arResult['ITEMS'];
$count = $arParams['NEWS_COUNT'];
echo '<pre>';
//print_r($arResult);
echo '</pre>';
?>


<div class="newsList lnPage">
    <?php foreach($news as $new):
        $day = substr($new['DATE_CREATE'], 0, 2);
        $monthID =  substr($new['DATE_CREATE'], 3, 2); ?>
        <div class="item">
            <div class="newsDate">
                <div class="big"><?=$day?></div>
                <div>
                    <span class="mobHide"><?=$monthsAr[$monthID]?></span><span class="mobShow"><?=strtoupper($monthsAr[$monthID])?></span>
                </div>
            </div>
            <div class="imgWrap">
                <img src="<?=$new['PREVIEW_PICTURE']['SRC']?>" alt="">
            </div>
            <div class="bgLayout">
                <a href="<?=$new['DETAIL_PAGE_URL']?>" class="iconBlueButton">&rarr;</a>
                <div class="linkWrap">
                    <a href="<?=$new['DETAIL_PAGE_URL']?>"><?=$new['NAME']?></a>
                </div>
                <p><?=$new['PREVIEW_TEXT']?></p>
            </div>
        </div>
   <?php endforeach;?>
</div>

