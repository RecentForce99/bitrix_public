<?php

namespace handlers;

use Bitrix\Main\EventManager;
use Bitrix\Main\Application;

class EventHandler
{
    public static function init(): void
    {
        $eventManager = EventManager::getInstance();
        $eventManager->addEventHandler(
            'main',
            'OnEndBufferContent',
            [new \BufferContent(), 'endBufferContent']
        );
    }
}

?>
