<?php

namespace Vazzi\ColorParticle;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class ColorParticleCommand extends Command implements PluginOwned
{


	public function __construct()
	{
		parent::__construct("colorparticle","Use different colored particles while walking", "colorparticle", ["cp", "pcolor"]);
		$this->setPermission("colorparticle.permission");
	}

	/**
     * @inheritDoc
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player) return true;

        if(!$this->testPermission($sender)) return true;

        $sender->sendForm(new ParticleForm());

        return true;
    }

	public function getOwningPlugin(): Plugin
	{
		return ColorParticle::getInstance();
	}
}