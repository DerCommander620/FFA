<?php
namespace FFA;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase{
    use SingletonTrait;

    public function onLoad(): void{
        self::setInstance($this);
        self::saveConfig();
    }

    public function onEnable(): void{
        self::getServer()->getCommandMap()->registerAll($this->getName(), [new FFACommand]);
    }
}
