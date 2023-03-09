<?php

private function getActivesTree($array, &$result = [])
    {
        foreach ($array as $section) {
            if($section['CODE'] == $this->code) {
                $result[] = $section['ID'];
            } else {
                $this->getActivesTree($section, $result);
            }
        }

        return $result;
    }

?>
