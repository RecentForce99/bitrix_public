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
$GLOBALS['NEWS']['NAV_RESULT'] = $arResult["NAV_RESULT"];

$this->setFrameMode(true);
?>
	<div class="all-news__content">
		<?foreach($arResult["ITEMS"] as $arItem):?>
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                <div class="all-news__box news-box">
                    <div class="news-box__img">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
                    </div>
                    <div class="news-box__date"><?=$arItem["PROPERTIES"]["OPUBLIKOVANO"]["VALUE"]?></div>
                    <div class="news-box__title"><?=$arItem['NAME']?></div>
                    <div class="news-box__subtitle"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>
            </a>
		<?endforeach;?>
    </div>