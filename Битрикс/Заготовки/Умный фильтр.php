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

echo '<pre>';
print_r($arResult);
echo '</pre>';
?>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
    <div class="row">
        <?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
        {
            if(isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    continue;

                ?>
                                    <input
                                            class="min-price"
                                            type="text"
                                            name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                            id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                            value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                    <input
                                            class="max-price"
                                            type="text"
                                            name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                            id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                            value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
            <?
            $arJsParams = array(
                "leftSlider" => 'left_slider_'.$key,
                "rightSlider" => 'right_slider_'.$key,
                "tracker" => "drag_tracker_".$key,
                "trackerWrap" => "drag_track_".$key,
                "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
//                "precision" => $precision,
                "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                "colorAvailableActive" => 'colorAvailableActive_'.$key,
                "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
            );
            ?>
                <script type="text/javascript">
                    BX.ready(function(){
                        window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                    });
                </script>
            <?endif;
        }

        //not prices
        foreach($arResult["ITEMS"] as $key=>$arItem)
        {
            if(empty($arItem["VALUES"]) || isset($arItem["PRICE"])) continue; //Не трогать
            ?>
                        <?
                        $arCur = current($arItem["VALUES"]);
                        switch ($arItem["DISPLAY_TYPE"])
                        {
                        case "B"://NUMBERS
                        ?>
                            <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                                <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
                                <div class="bx-filter-input-container">
                                    <input
                                            class="min-price"
                                            type="text"
                                            name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                            id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                            value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>
                            <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                                <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                                <div class="bx-filter-input-container">
                                    <input
                                            class="max-price"
                                            type="text"
                                            name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                            id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                            value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>
                        <?
                        break;
                        case "P"://DROPDOWN
                        $checkedItemExist = false;
                        ?>
                            <div class="col-xs-12">
                                <div class="bx-filter-select-container">
                                    <div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                                        <div class="bx-filter-select-text" data-role="currentOption">
                                            <?
                                            foreach ($arItem["VALUES"] as $val => $ar)
                                            {
                                                if ($ar["CHECKED"])
                                                {
                                                    echo $ar["VALUE"];
                                                    $checkedItemExist = true;
                                                }
                                            }
                                            if (!$checkedItemExist)
                                            {
                                                echo GetMessage("CT_BCSF_FILTER_ALL");
                                            }
                                            ?>
                                        </div>
                                        <div class="bx-filter-select-arrow"></div>
                                        <input
                                                style="display: none"
                                                type="radio"
                                                name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                value=""
                                        />
                                        <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                            <input
                                                    style="display: none"
                                                    type="radio"
                                                    name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                                    id="<?=$ar["CONTROL_ID"]?>"
                                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                            />
                                        <?endforeach?>
                                        <div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none;">
                                            <ul>
                                                <li>
                                                    <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                                        <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                    </label>
                                                </li>
                                                <?
                                                foreach ($arItem["VALUES"] as $val => $ar):
                                                    $class = "";
                                                    if ($ar["CHECKED"])
                                                        $class.= " selected";
                                                    if ($ar["DISABLED"])
                                                        $class.= " disabled";
                                                    ?>
                                                    <li>
                                                        <label for="<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
                                                    </li>
                                                <?endforeach?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?
                        break;
                        case "K"://RADIO_BUTTONS
                        ?>
                            <div class="col-xs-12">
                                <div class="radio">
                                    <label class="bx-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
												<span class="bx-filter-input-checkbox">
													<input
                                                            type="radio"
                                                            value=""
                                                            name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                            id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                            onclick="smartFilter.click(this)"
                                                    />
													<span class="bx-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
												</span>
                                    </label>
                                </div>
                                <?foreach($arItem["VALUES"] as $val => $ar):?>
                                    <div class="radio">
                                        <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
														<input
                                                                type="radio"
                                                                value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                                name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                                id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
                                                        />
														<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif;?></span>
													</span>
                                        </label>
                                    </div>
                                <?endforeach;?>
                            </div>
                        <?
                        break;
                        default://CHECKBOXES
                        ?>
                            <div class="col-xs-12">
                                <?foreach($arItem["VALUES"] as $val => $ar):?>
                                    <div class="checkbox">
                                        <label for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox">
														<input
                                                                type="checkbox"
                                                                value="<? echo $ar["HTML_VALUE"] ?>"
                                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                                id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
                                                        />
<!--                                                        $ar["ELEMENT_COUNT"]-->
													</span>
                                        </label>
                                    </div>
                                <?endforeach;?>
                            </div>
                        <?
                        }
                        ?>
            <?
        }
        ?>
    </div><!--//row-->
</form>

<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
