<?php
    $USER = new CUser;
    $ID = $USER->Add($result);
    if (intval($ID) > 0) echo 1;
    else die($USER->LAST_ERROR);
?>
