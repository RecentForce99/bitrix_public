<?php
$n = 0;
$sections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 7, 'ACTIVE' => 'Y'), false, array('ID', 'NAME', 'CODE'), array());
while($section = $sections->GetNext()):?>
    <?php
    $projectsAr = [];
    $items = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 7, 'ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => $section['ID']), false, array(),
    array('ID', 'NAME', 'PROPERTY_RASPOLOZHENIE', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'));
    while($item = $items->GetNext()) {$projectsAr[] = $item;}

    $projects = array_chunk($projectsAr, 2);
    $max = count($projects);
    if(!empty($projects)):?>
            <div class="our-projects" id="<?=$section['CODE']?>">
                <div class="container">
                    <div class="our-projects__inner">
                        <div class="our-projects__title title"><?=$section['NAME']?></div>
                        <div class="our-projects__content" id="item-<?=$section['ID']?>">
                                   <?php for ( $i = 0; $i < 2; $i++ ):
                                        $project = $projects[0][$i];
                                        ?>
                                        <div class="our-projects__item">
                                            <div class="our-projects__item-sticker"><?=$project['PROPERTY_RASPOLOZHENIE_VALUE']?></div>
                                            <div class="our-projects__item-content">
                                                <div class="our-projects__item-img">
                                                    <a href="<?=$project["DETAIL_PAGE_URL"]?>">
                                                        <img src="<?=CFile::GetPath($project["PREVIEW_PICTURE"])?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="our-projects__item-bottom">
                                                    <div class="our-projects__item-title">
                                                        <span>
                                                            <a href="<?=$project["DETAIL_PAGE_URL"]?>">
                                                                <?=$project['NAME']?>
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <a class="our-projects__item-link" href="<?=$project["DETAIL_PAGE_URL"]?>">
                                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow.svg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor;?>
                        </div>
                        <?php if($max >= 2):?>
                        <a class="our-projects__btn btn" max="<?=$max?>" current="1" parent-id="<?=$section['ID']?>">Загрузить еще
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow.svg" alt="">
                        </a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
 <?php endif;?>
<?php endwhile;?>