<?php
function getPhoneNumber($number)
{
    $phone = [];

    for($i = 0; $i < strlen($number); $i++ )
    {
        if(is_numeric($number[$i]) || $number[$i] == '+')
        {
            $phone['url'] .= $number[$i];
        }
    }

    return $phone['url'];
}
?>
