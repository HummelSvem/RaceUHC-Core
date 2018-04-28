<?php
/**
 * Created by PhpStorm.
 * User: LaFuma
 * Date: 6/16/2017
 * Time: 00:56
 */

namespace LaFuma;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\block\Block;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\Listener;
use pocketmine\Level;
use pocketmine\nbt\tag\{CompoundTag, IntTag, ListTag, StringTag, IntArrayTag};
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\inventory\InventoryType;
use pocketmine\tile\Tile;

class Core extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getLogger()->info("Ciao!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $player->getInventory()->clearAll();
        $item1 = Item::get(Item::COMPASS);
        $item1->setCustomName("§l§bTeleporter§r");
        $player->getInventory()->setItem(4, $item1);
        $player->setFood(10);
        $player->setMaxHealth(100);
        $player->setHealth(100);
    }

    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $name = $event->getPlayer()->getName();
        $item = $player->getInventory()->getItemInHand();
        if ($item->getCustomName() == "§l§bTeleporter§r") {
            $player->getInventory()->clearAll();
            //Player Info
            $item3 = Item::get(Item::MOB_HEAD, 11,1);
            $item3->setCustomName("$name §cProfile");
            $player->getInventory()->setItem(1,$item3);
            //Shop
            $item4 = Item::get(Item::EMERALD, 10,1);
            $item4->setCustomName("§cShop");
            $player->getInventory()->setItem(2,$item4);
            //Game Menu
            $item5 = Item::get(Item::COMPASS,9,1);
            $item5->setCustomName("§l§bGame Menu");
            $player->getInventory()->setItem(0,$item5);
            //Collectibles
            $item2 = Item::get(Item::CHEST, 12, 1);
            $item2->setCustomName("§l§cCollectibles§r");
            $player->getInventory()->setItem(4, $item2);
            //Back
            $item1 = Item::get(Item::IRON_DOOR, 14, 1);
            $item1->setCustomName("§c§lBack§r");
            $player->getInventory()->setItem(8, $item1);

        } else if ($item->getCustomName() == "§c§lBack§r") {
            $player->getInventory()->clearAll();
            $item1 = Item::get(Item::COMPASS);
            $item1->setCustomName("§l§bTeleporter§r");
            $player->getInventory()->setItem(4, $item1);
        }
    }

    public function onRespawn(PlayerRespawnEvent $event)
    {
        $player = $event->getPlayer();
        $player->setFood(10);
        $player->setMaxHealth(30);
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args): bool {
    {
        switch ($command->getName()) {
            case"raceuhc":
                if ($sender->hasPermission("raceuhc.command")) {
                    if (!isset($args[0])) {
                        $sender->sendMessage("§7---===§cRaceUHC§7===----");
                        $sender->sendMessage("§7Benvenuto sulla lista di comandi del server RaceUHC!");
                        $sender->sendMessage("§7Per leggere regole, esegui il comando: /raceuhc regole");
                        $sender->sendMessage("§7---===§cRaceUHC§7===----");
                    }
                    switch ($args[0]) {
                        case"regole":
                            $sender->sendMessage("§7---===§cRaceUHC§7===----");
                            $sender->sendMessage("§71-> No spam (ip/nomi) di altri server!");
                            $sender->sendMessage("§72-> No Flood");
                            $sender->sendMessage("§73-> Contengno del messaggiare");
                            $sender->sendMessage("§74-> Rispetto verso i Player e allo Staff");
                            $sender->sendMessage("§75-> Non usare cheat");
                            $sender->sendMessage("§76-> Linguaggio pulito in chat");
                            $sender->sendMessage("§77-> Non accusare i Player in chat, piuttosto usa /report giocatore motivo");
                            $sender->sendMessage("§78-> Ogni minaccia di DDoS ai player o al server, sono severamente puniti");
                            $sender->sendMessage("§7---===§cRaceUHC§7===----");
                    }
                    switch($args[0]){
                        case"ping":
                            $sender->sendMessage("§cPong");
                    }
                }
        }
    }
}
