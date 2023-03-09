<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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


foreach ($arResult["ITEMS"] as $arItem) {
    if(!$arItem['VALUES']) {
        echo '<p class="catalog__qty">Фильтров не найдено</p>';

        return false;
    }
}

?>

        <form class="catalog__filter filter smartfilter" name="<?
        echo $arResult["FILTER_NAME"] . "_form" ?>" action="<?
        echo $arResult["FORM_ACTION"] ?>" method="get">
            <button type="button" class="filter__close mobile">
                <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.5 0H33L7.5 33H0L25.5 0Z" fill="#D62214"/>
                    <path d="M7.5 0H0L25.5 33H33L7.5 0Z" fill="#D62214"/>
                </svg>
            </button>
            <p class="filter__title">Фильтр</p>
            <?php foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<?=$arItem["CONTROL_NAME"] ?>" id="<?=$arItem["CONTROL_ID"] ?>" value="<?=$arItem["HTML_VALUE"] ?>"/>
            <?php endforeach; ?>
                <?php
                foreach ($arResult["ITEMS"] as $key => $arItem):
                    if (empty($arItem["VALUES"]) || isset($arItem["PRICE"])) {
                        continue;
                    }

                    if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)) {
                        continue;
                    }?>

                    <div class ="bx-filter-parameters-box filter__item <? if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>bx-active<?endif ?>">
                        <span style="font-size: 0; opacity: 0; width: 0; display: none" class="bx-filter-container-modef"></span> <!--Выводит количество выбранных элементов-->
                        <button type="button" class="filter__item-btn active bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
							<span class="bx-filter-parameters-box-hint"><?= $arItem["NAME"] ?></span>
                        </button>

                        <div class="filter__item-content">
                            <label class="filter__item-search">
                                <input placeholder="Поиск товаров по свойству..." type="text">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.8571 23.7143C18.8534 23.7143 23.7143 18.8534 23.7143 12.8571C23.7143 6.86091 18.8534 2 12.8571 2C6.86091 2 2 6.86091 2 12.8571C2 18.8534 6.86091 23.7143 12.8571 23.7143Z" stroke="#D4D4D8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M26.0006 25.9996L23.7148 23.7139" stroke="#D4D4D8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </label>
                            <div class="filter__filters-box scrollbar-gray">
                                <?
                                $arCur = current($arItem["VALUES"]);
                                switch ($arItem["DISPLAY_TYPE"]):
                                    default:?>
                                            <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                       class="bx-filter-input-checkbox filter__checkbox-label <?=$ar["CHECKED"] ? 'active' : '' ?> <?=$ar["DISABLED"] ? 'disabled' : '' ?>"
                                                       for="<?=$ar["CONTROL_ID"] ?>">
                                                    <span class="filter__checkbox-icon">
                                                        <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.99309 9.17958L4.97326 9.1994L0.0234375 4.24958L1.6352 2.63781L4.99315 5.99577L10.3639 0.625L11.9757 2.23676L5.01297 9.19947L4.99309 9.17958Z" fill="white"/>
                                                        </svg>
                                                    </span>
											        	<input style="display: none;"
                                                                type="checkbox"
                                                                value="<?=$ar["HTML_VALUE"] ?>"
                                                                name="<?=$ar["CONTROL_NAME"] ?>"
                                                                id="<?=$ar["CONTROL_ID"] ?>"
											        		<?=$ar["CHECKED"] ? 'checked="checked"' : '' ?>
											        		onclick="smartFilter.click(this)"
                                                        />
											        	<span class="bx-filter-param-text"
                                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?>
                                                                &nbsp;(<span data-role="count_<?= $ar["CONTROL_ID"] ?>"><?=$ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif; ?>
                                                        </span>
                                                </label>
                                            <?endforeach; ?>
                                    <?php endswitch; ?>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                    <?php endforeach;?>
            <div style="display: none" class="row buttons-filter">
                <div  class="col-xs-12 bx-filter-button-box">
                    <div  class="bx-filter-block">
                        <div  class="bx-filter-parameters-box-container">
                            <input

                                    class="btn btn-themes"
                                    type="submit"
                                    id="set_filter"
                                    name="set_filter"
                                    value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
                            />
                            <input

                                    class="btn btn-link"
                                    type="submit"
                                    id="del_filter"
                                    name="del_filter"
                                    value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
                            />
                            <div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef">
                                <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span  id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                                <span  class="arrow"></span>
                                <br/>
                                <a  class="filter-url" href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="clb"></div>
        </form>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape(
        $arParams["FILTER_VIEW_MODE"]
    )?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>


