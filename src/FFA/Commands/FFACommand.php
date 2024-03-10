r<?php
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
                $joinworld = Server::getInstance()->getWorldManager()->getWorldByName(Main::getInstance()->getConfig()->get("Leave.World"))->getSpawnLocation();
                $sender->teleport($joinworld);
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
                    if(!$sender->getWorldByName() === Server::getInstance()->getWorldManager()->getWorldByName(Main::getInstance()->getConfig()->get("Leave.World"))->getSpawnLocation())){
                        $sender->sendMessage("§cYou aren`t in FFA!);
                    }else{
                        $leaveworld = Server::getInstance()->getWorldManager()->getWorldByName(Main::getInstance()->getConfig()->get("Leave.World"))->getSpawnLocation());
                        $sender->getInventory()->clearall();
                        $sender->teleport($leaveworld);
                    }
                    break;
                case "restore":
                    $sender->getInventory()->setItem(0, VanillaItems::IRON_SWORD());
                    $sender->sendMessage("§aYou finally restored your Inventory!");
                $sender->getInventory()->setItem(1, VanillaItems::FISHING_ROD());
                $sender->getInventory()->setItem(2, VanillaItems::GOLDEN_APPLE()->setCount(8));
                $sender->getInventory()->setItem(3, VanillaItems::BOW());
                $sender->getInventory()->setItem(4, VanillaItems::ARROW()->setCount(256));
                $sender->getArmorInventory()->setHelmet(VanillaItems::IRON_HELMET());
                $sender->getArmorInventory()->setChestplate(VanillaItems::IRON_CHESTPLATE());
                $sender->getArmorInventory()->setLeggings(VanillaItems::IRON_LEGGINGS());
                $sender->getArmorInventory()->setBoots(VanillaItems::IRON_BOOTS());
                    break;
            }
    }   

    public function onDeath(PlayerDeathEvent $event){
        $event->setDeathMessage($event->getPlayer()->getName() . " §7 was send to Heaven");
    }
}
