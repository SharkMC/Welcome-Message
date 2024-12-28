<?php

namespace WelcomeMessage;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use WelcomeMessage\forms\welcomeForm;

class Main extends PluginBase implements Listener {
    
    private static ?Main $instance = null;
    private Config $config;

    public function onEnable(): void {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }
    
    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $type = self::getTypeConfig();

        switch ($type) {
            case "Title":
                $player->sendTitle(self::getTitleConfig(), self::getMessageConfig(), 10, 60, 10);
                break;
            case "Popup":
                $player->sendPopup(self::getMessageConfig());
                break;
            case "Form":
                $player->sendForm(welcomeForm::create($player));
                break;
            case "Message":
                $player->sendMessage(self::getMessageConfig());
                break;
        }
    }

    public static function getInstance(): ?Main {
        return self::$instance;
    }

    public static function getMessageConfig(): string {
        $instance = self::getInstance();
        if ($instance !== null) {
            return $instance->config->get("Message", "Welcome to server.com!");
        }
    }
    
    public static function getTitleConfig(): string {
        $instance = self::getInstance();
        if ($instance !== null) {
            return $instance->config->get("Title", "Welcome");
        }
    }
    
    public static function getTypeConfig(): string {
        $instance = self::getInstance();
        if ($instance !== null) {
            return $instance->config->get("Type", "Message");
        }
    }
}