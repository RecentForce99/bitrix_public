<?php

$n = 0;
$elementsCountSetUp = 9; //Устанавливается количество товара на одной странице
$pagin = ($_GET['PAGE_ID']) ? $_GET['PAGE_ID'] : 1;  //Номер текущей пагинации
$filter = array('IBLOCK_ID' => $iblockID, 'ACTIVE' => 'Y');
if($sections) $filter['SECTION_CODE'] = $sections;

$items = CIBlockElement::GetList(array(), $filter, false, array('iNumPage' => $pagin, 'nPageSize' => $elementsCount),
    array('ID', 'NAME', 'PREVIEW_TEXT',
        'PREVIEW_PICTURE', 'SECTION_CODE', 'CATALOG_GROUP_1', 'QUANTITY', 'DETAIL_PAGE_URL'));
$itemsCountAll = $itemsCountRound = $items->SelectedRowsCount();
$countRound = $itemsCountAll / $elementsCount;

if($itemsCountAll % $elementsCount === 0) $itemsCountRound = $countRound;
elseif($itemsCountAll % $elementsCount > 0) $itemsCountRound = ceil($countRound);


while($item = $items->GetNext())
{
    $mxResult = \CCatalogSku::getOffersList($item['ID'], $iblockID, array('ACTIVE' => 'Y', '>QUANTITY' => 0), array('ID'));
    if($mxResult)
    {
        $result[$n] = $item;
        $result[$n]['SKU'] = 1;
    }
    else if($item['QUANTITY'] > 0) $result[$n] = $item;

    $n++;
}



$items = $result;
$PRODUCT_ID = $items[0]['ID'];
$startCountItemsFromClass = $itemsCountAll; //Общее количество товара

//NAVIGATION
$countRound = $itemsCountRound;
$radius = 3; //Количество кнопок пагинации (если 3, то максимум 2 слева и 2 справа, например: 1...23456...9)
$pagin = ($_GET['PAGE_ID']) ? $_GET['PAGE_ID'] : 1;  //Номер текущей пагинации
//NAVIGATION


?>

<?php if($startCountItemsFromClass > $elementsCountSetUp):?>
    <div class="catalog__right-pagination" data-current="<?=$pagin?>">
        <div class="catalog__right-pagination-prev <?php if ($pagin > 1) echo 'pagination-items-ajax'; ?> <?php if ($pagin <= 1) echo 'arrow-noactive'; ?>" data-current="<?= $pagin-1?>">
            <svg  viewBox="0 0 36 16"  xmlns="http://www.w3.org/2000/svg">
                <path d="M0.292889 8.70711C-0.0976333 8.31659 -0.0976334 7.68342 0.292889 7.2929L6.65685 0.928935C7.04737 0.53841 7.68054 0.53841 8.07106 0.928935C8.46159 1.31946 8.46159 1.95262 8.07106 2.34315L2.41421 8L8.07106 13.6569C8.46159 14.0474 8.46159 14.6805 8.07106 15.0711C7.68054 15.4616 7.04738 15.4616 6.65685 15.0711L0.292889 8.70711ZM36 9L0.999996 9L0.999996 7L36 7L36 9Z"/>
            </svg>
        </div>

        <div class="catalog__right-pagination-numbers">
            <?php if ($pagin > $radius): ?>
                <span class="pagination-items-ajax pagination-number" data-current="0">1</span>
            <?php endif; ?>
            <?php if ($pagin > $radius+1): ?>
                <span>...</span>
            <?php endif;?>

            <?php
            for ( $i = 1; $i <= $countRound; $i++ ):?>
                <?php if($i > $pagin - $radius && $i < $pagin + $radius || ($pagin == 0 && $i < $radius)):?> <!--Вывод остальных страниц-->
                    <span class="pagination-items-ajax pagination-number <?php if($pagin == $i) echo 'pagination-number--active';?>" data-current="<?=$i?>">
                                <a><?=$i?></a>
                            </span>
                <?php endif;?>
            <?php endfor;?>

            <?php if($countRound - $pagin > $radius):?> <!--Вывод троеточия в случае, если дальше ещё есть страницы-->
                <span>...</span>
            <?php endif;

            if ($countRound - $pagin >= $radius):?> <!--Вывод троеточия в случае, если дальше ещё есть страницы-->
                <span class="pagination-items-ajax pagination-number <?php if($pagin == $i) echo 'pagination-number--active';?>" data-current="<?=$countRound?>">
                            <a><?=$countRound?></a>
                        </span>
            <?php endif;
            ?>
        </div>

        <div class="catalog__right-pagination-next <?php if ( $countRound == $pagin ) echo 'arrow-noactive'; ?> <?php if ( $countRound !== $pagin ) echo 'pagination-items-ajax'; ?>" data-current="<?= $pagin+1?>">
            <svg  viewBox="0 0 36 16"  xmlns="http://www.w3.org/2000/svg">
                <path d="M35.7071 8.70711C36.0976 8.31659 36.0976 7.68342 35.7071 7.2929L29.3431 0.928935C28.9526 0.53841 28.3195 0.53841 27.9289 0.928935C27.5384 1.31946 27.5384 1.95262 27.9289 2.34315L33.5858 8L27.9289 13.6569C27.5384 14.0474 27.5384 14.6805 27.9289 15.0711C28.3195 15.4616 28.9526 15.4616 29.3431 15.0711L35.7071 8.70711ZM-8.74228e-08 9L35 9L35 7L8.74228e-08 7L-8.74228e-08 9Z"/>
            </svg>
        </div>
    </div>
<?php endif;?>

