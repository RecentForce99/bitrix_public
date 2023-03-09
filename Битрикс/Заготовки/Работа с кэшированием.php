<?php 
public function getItemsFromCache(): array
    {
        $res = [];
        $cache = \Bitrix\Main\Application::getInstance()->getManagedCache();

        if ($cache->read(self::CACHE_TIME, self::CACHE_ID)) {
            $res = array_chunk($cache->get(self::CACHE_ID), 9);
            $this->itemsCountAll = count($cache->get(self::CACHE_ID));
            return $res;
        } else {
            $nashLabels = $this->getItems($this->idIBlock, $this->sections);
            $cache->set(self::CACHE_ID, $nashLabels);
            $res = array_chunk($cache->get(self::CACHE_ID), 9);
            $this->itemsCountAll = count($cache->get(self::CACHE_ID));
            return $res;
        }
    }


//Очистка кэша
$cache = \Bitrix\Main\Application::getInstance()->getManagedCache();
$cache->clean($cacheId);
?>
