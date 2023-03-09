<?php
        $url = $APPLICATION->GetCurUri();
        $remove_http = str_replace('http://', '', $url);
        $split_url = explode('?', $remove_http);
        $pageURL = explode('/', $split_url[0]);
        foreach ($pageURL as $val) {if($val) $pageURLAr[] = $val;}

        $sectionCode = array_reverse($pageURLAr)[0];
?>
