<?php

namespace FFA;

use pocketmine\plugin\PluginBase;
use FFA\Commands\FFACommand;
use pocketmine\utils\SingletonTrait;
use pocketmine\Server;

class Main extends PluginBase{
    use SingletonTrait;

    public function onLoad(): void{
        self::setInstance($this);
        self::saveConfig();
    }

    public function onEnable(): void{
        Server::getInstance()->getPluginManager()->registerEvents(new FFACommand, $this);
        Server::getInstance()->getCommandMap()->registerAll($this->getName(), [
            new FFACommand()
        ]);
    }
}
