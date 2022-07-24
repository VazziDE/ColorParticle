<?php

declare(strict_types=1);

namespace Vazzi\ColorParticle;

use pocketmine\color\Color;
use pocketmine\permission\PermissionManager;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use pocketmine\world\particle\DustParticle;

class ColorParticle extends PluginBase
{
    use SingletonTrait;


	const Colors = ["Red", "Green", "Blue", "Orange", "Yellow", "White", "Black", "Aqua", "Pink", "Purple", "Rainbow"];

	public $playerparticle = [];

	protected function onLoad(): void
	{
		self::setInstance($this);
	}

	protected function onEnable(): void
	{
		$this->getServer()->getCommandMap()->register("ColorParticle", new ColorParticleCommand());
		$this->getServer()->getPluginManager()->registerEvents(new ParticleListener(), $this);
		$this->getScheduler()->scheduleRepeatingTask(new SpawnParticleTask(), 1);

        $adminPerm = PermissionManager::getInstance()->getPermission("colorparticle.permission");
        $adminPerm->addChild('colorparticle.permission.all', true);
        $adminPerm->addChild('colorparticle.permission.red', true);
        $adminPerm->addChild('colorparticle.permission.green', true);
        $adminPerm->addChild('colorparticle.permission.blue', true);
        $adminPerm->addChild('colorparticle.permission.orange', true);
        $adminPerm->addChild('colorparticle.permission.yellow', true);
        $adminPerm->addChild('colorparticle.permission.white', true);
        $adminPerm->addChild('colorparticle.permission.black', true);
        $adminPerm->addChild('colorparticle.permission.aqua', true);
        $adminPerm->addChild('colorparticle.permission.pink', true);
        $adminPerm->addChild('colorparticle.permission.purple', true);
        $adminPerm->addChild('colorparticle.permission.rainbow', true);
	}

	public function translateColor($color, Player $player): DustParticle|String|null
    {
        return match ($color) {
            "Red" => new DustParticle(new Color(255, 0, 0)),
            "Green" => new DustParticle(new Color(0, 255, 0)),
            "Blue" => new DustParticle(new Color(0, 0, 255)),
            "Orange" => new DustParticle(new Color(255, 165, 0)),
            "Yellow" => new DustParticle(new Color(250, 250, 55)),
            "White" => new DustParticle(new Color(255, 255, 255)),
            "Black" => new DustParticle(new Color(0, 0, 0)),
            "Aqua" => new DustParticle(new Color(0, 255, 255)),
            "Pink" => new DustParticle(new Color(255, 20, 147)),
            "Purple" => new DustParticle(new Color(159, 0, 197)),
            "Rainbow" => "Rainbow",
            default => null,
        };
    }

}
