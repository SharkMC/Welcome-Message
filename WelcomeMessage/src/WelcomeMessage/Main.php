<?php

namespace WelcomeMessage; //ファイルの名前を設定

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void { //プラグインが有効になった時に実行
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event) { //プレイヤーがサーバーに参加した時に実行
        $player = $event->getPlayer(); //イベントを実行したプレイヤー情報を取得
        $player->sendMessage("§e§lWelcome to §fserver name§e!"); //イベントを実行したプレイヤーに個別にメッセージを送信
        $event->setJoinMessage(""); //参加した時のメッセージを空に設定
    }
}