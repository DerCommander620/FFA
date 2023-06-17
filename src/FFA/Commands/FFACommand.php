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
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            if($sender->hasPermission("ffa.cmd")){
                $joinworld = Server::getInstance()->getWorldManager()->getWorld("FFA-WORLD");
                $sender->teleport($joinworld);
                $sender->getInventory()->addItem(VanillaItems::IRON_SWORD());
                $sender->getInventory()->addItem(VanillaItems::FISHING_ROD());
                $sender->getInventory()->addItem(VanillaItems::GOLDEN_APPLE());
                $sender->getInventory()->addItem(VanillaItems::BOW());
                $sender->getInventory()->addItem(VanillaItems::ARROW(64));
                $sender->getArmorInventory()->setHelmet(VanillaItems::IRON_HELMET());
                $sender->getArmorInventory()->setChestplate(VanillaItems::IRON_CHESTPLATE());
                $sender->getArmorInventory()->setLeggings(VanillaItems::IRON_LEGGINGS());
                $sender->getArmorInventory()->setBoots(VanillaItems::IRON_BOOTS());
            }
        }
        if(isset($args[0])){
            switch(strtolower($args[0])){
                case "leave":
                    $leaveworld = Server::getInstance()->getWorldManager()->getWorld(Main::getInstance()->getConfig()->get("Leave.World"));
                    $sender->getInventory()->clearall();
                    $sender->teleport($leaveworld);
                    break;
                }
        }   
    }

    public function onDeath(PlayerDeathEvent $event){
        $event->setDeathMessage($event->getPlayer()->getDisplayName() . " §7 was destroyed to death");
        $event->setDeathMessage($event->getPlayer()->getDisplayName() . " §7 was killed by the death");
        $event->setDeathMessage($event->getPlayer()->getDisplayName() . " §7 was send to Heaven");
        $event->setDeathMessage($event->getPlayer()->getDisplayName() . " §7 got killed with a lot of Power");
    }
}
