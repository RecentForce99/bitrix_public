<?php

//Разработчик функции mbCutString https://gist.github.com/dryks/3670ac078b700fae504a976447b24b7d 
 function mbCutString($str, $length, $postfix='...', $encoding='UTF-8')
    {
        if (mb_strlen($str, $encoding) <= $length)
            return $str;

        $tmp = mb_substr($str, 0, $length, $encoding);
        return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
    };

function cutStringToDotOrComma($str, $length, $encoding='UTF-8') : string
{
    $str = strip_tags($str);
    if (mb_strlen($str, $encoding) <= $length) 
        return $str;

    $tmp = mb_substr($str, 0, $length, $encoding);
    $croppedStr = mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding);

    $strToArrayTransform = explode(' ', $croppedStr);
    $result = '';

    for( $i = count($strToArrayTransform); $i > 0; $i-- )
    {
        if(isset($strToArrayTransform[$i]))
        {
            if(mb_substr($strToArrayTransform[$i], -1) == '.' || mb_substr($strToArrayTransform[$i], -1) == ',')
            {
                $result = implode(' ', $strToArrayTransform); 
                break;
            }
            else unset($strToArrayTransform[$i]);   
        }
    }

    if(!$result) $result = $croppedStr;

    return $result;
}


class VladekStrings
{
    private static $originalString,  
    $specialSymbols = [],
    $strToArrayTransform = [],
    $str, 
    $length,
    $encoding = 'UTF-8';

    public static function cutStringToSpecSymbol(string $str, int $length, array $specialSymbols = ['.'], string $encoding='UTF-8') : string
    {
        self::$length = $length;
        self::$encoding = $encoding;
        self::$originalString = $str;
        self::$specialSymbols = $specialSymbols;

        $str = strip_tags($str);
        if (mb_strlen($str, $encoding) <= $length) 
            return $str;

        self::$str = $str;
        self::convertCroppedStringToArray();
        $result = self::removingUnnecessaryWords();
    
        return $result;
    }

    private static function convertCroppedStringToArray() : void
    {
        $str = self::$str;
        $length = self::$length;
        $encoding = self::$encoding;

        $tmp = mb_substr($str, 0, $length, $encoding);
        $croppedStr = mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding);

        $strToArrayTransform = [];
        $strToArrayTransform = explode(' ', $croppedStr);

        self::$strToArrayTransform = $strToArrayTransform;
    }

    private static function removingUnnecessaryWords() : string
    {
        $strToArrayTransform = self::$strToArrayTransform;
        for( $i = count(self::$strToArrayTransform); $i > 0; $i-- )
        {   
            if(!isset($strToArrayTransform[$i])) continue;
            if(self::issetSpecialSymbols($strToArrayTransform[$i]))
                return implode(' ', $strToArrayTransform); 
            else 
                unset($strToArrayTransform[$i]);  
        }

        return self::$originalString;
    }

    private static function issetSpecialSymbols(string $element) : bool
    {
        $specialSymbols = self::$specialSymbols;
        foreach ($specialSymbols as $symb)
        {
            if(mb_substr($element, -1) == $symb) 
                return true;
        }
     
        return false;
    }
}


//Пример вызова
VladekStrings::cutStringToSpecSymbol($text, 300, array(',', '.'), 'UTF-8');

?> 
