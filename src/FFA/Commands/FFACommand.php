<?php

namespace FFA\Commands;

use FFA\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\Server;

class FFACommand extends Command{

    public function __construct(){
        parent::__construct("ffa", "Teleport you to ffa", "ffa", []);
        $this->setPermission("ffa.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
    if($sender instanceof Player){
        if($sender->hasPermission("ffa.cmd")){
            $sender->sendMessage("§aUse §e/ffa restore §ato restore your entire Inventory!");
            $joinWorld = Server::getInstance()->getWorldManager()->getWorldByName(Main::getInstance()->getConfig()->get("Leave.World"))->getSpawnLocation();
            $sender->teleport($joinWorld);
           
            $sender->getInventory()->clearAll();
            $sender->getInventory()->setItem(0, VanillaItems::IRON_SWORD());
            $sender->getInventory()->setItem(1, VanillaItems::FISHING_ROD());
            $sender->getInventory()->setItem(2, VanillaItems::GOLDEN_APPLE()->setCount(8));
            $sender->getInventory()->setItem(3, VanillaItems::BOW());
            $sender->getInventory()->setItem(4, VanillaItems::ARROW()->setCount(256));
            $sender->getArmorInventory()->setHelmet(VanillaItems::IRON_HELMET());
            $sender->getArmorInventory()->setChestplate(VanillaItems::IRON_CHESTPLATE());
            $sender->getArmorInventory()->setLeggings(VanillaItems::IRON_LEGGINGS());
            $sender->getArmorInventory()->setBoots(VanillaItems::IRON_BOOTS());
        }
    }

    if(isset($args[0])){
        switch(strtolower($args[0])){
            case "leave":
                $leaveWorld = Server::getInstance()->getWorldManager()->getWorldByName(Main::getInstance()->getConfig()->get("Leave.World"))->getSpawnLocation();
                if($sender instanceof Player){
                    $sender->getInventory()->clearAll();
                    $sender->teleport($leaveWorld);
                }
                break;
            case "restore":
                if($sender instanceof Player){
                    $sender->getInventory()->clearAll();
                    $sender->getInventory()->setItem(0, VanillaItems::IRON_SWORD());
                    $sender->getInventory()->setItem(1, VanillaItems::FISHING_ROD());
                    $sender->getInventory()->setItem(2, VanillaItems::GOLDEN_APPLE()->setCount(8));
                    $sender->getInventory()->setItem(3, VanillaItems::BOW());
                    $sender->getInventory()->setItem(4, VanillaItems::ARROW()->setCount(256));
                    $sender->getArmorInventory()->setHelmet(VanillaItems::IRON_HELMET());
                    $sender->getArmorInventory()->setChestplate(VanillaItems::IRON_CHESTPLATE());
                    $sender->getArmorInventory()->setLeggings(VanillaItems::IRON_LEGGINGS());
                    $sender->getArmorInventory()->setBoots(VanillaItems::IRON_BOOTS());
                    $sender->sendMessage("§aYou have successfully restored your Inventory!");
                }
                break;
        }
    }
}

    public function onDeath(PlayerDeathEvent $event){
        $event->setDeathMessage($event->getPlayer()->getName() . " §7 was sent to Heaven");
    }
}
