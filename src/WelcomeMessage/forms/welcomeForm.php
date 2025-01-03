<?php

namespace WelcomeMessage\forms;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use WelcomeMessage\Main;

class welcomeForm {

    public static function create(Player $player): SimpleForm {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }

            $data = (int) $data;
        });

        $form->setTitle(Main::getTitleConfig());
        $form->setContent(Main::getMessageConfig());

        return $form;
    }
}