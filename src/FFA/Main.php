<?php

namespace FFA;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use FFA\Commands\FFACommand;

class Main extends PluginBase{
    use SingletonTrait;

    public function onLoad(): void{
        self::setInstance($this);
        $this->saveDefaultConfig();
    }

    public function onEnable(): void{
        $this->getServer()->getCommandMap()->registerAll($this->getName(), [
            new FFACommand()
        ]);
    }
}
