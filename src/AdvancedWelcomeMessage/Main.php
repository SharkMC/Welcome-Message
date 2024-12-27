<?php

namespace AdvancedWelcomeMessage;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
    
    private static ?Main $instance = null;
    private Config $config;

    public function onEnable(): void {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public static function getInstance(): ?Main {
        return self::$instance;
    }

    public static function getMessageConfig(): string {
        $instance = self::getInstance();
        if ($instance !== null) {
            return $instance->config->get("Message", "Welcome to server.com!");
        }
        return "Welcome to server.com!";
    }
    
    public static function getTitleConfig(): string {
        $instance = self::getInstance();
        if ($instance !== null) {
            return $instance->config->get("Title", "Welcome");
        }
        return "Welcome";
    }
}