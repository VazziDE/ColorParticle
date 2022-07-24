<?php


namespace Vazzi\ColorParticle;

use pocketmine\scheduler\Task;

class SpawnParticleTask extends Task
{

	public function onRun(): void
	{
		foreach (ColorParticle::getInstance()->getServer()->getOnlinePlayers() as $player) {
			if ($player !== null) {
				if (isset(ColorParticle::getInstance()->playerparticle[$player->getName()])) {
					if (in_array(ColorParticle::getInstance()->playerparticle[$player->getName()], ColorParticle::Colors)) {
						if (($color = ColorParticle::getInstance()->translateColor(ColorParticle::getInstance()->playerparticle[$player->getName()], $player)) !== null) {
							if ($color != "Rainbow") {
								$player->getPosition()->getWorld()->addParticle($player->getPosition()->asVector3()->add(0,0.2,0), $color);
							} else {
								foreach (ColorParticle::Colors as $onecolor) {
									if ($onecolor !== "Rainbow") {
										$player->getPosition()->getWorld()->addParticle(
                                            $player->getPosition()->asVector3()->add(0,0.2,0),
                                            ColorParticle::getInstance()->translateColor($onecolor, $player));
									}
								}
							}
						}
					}
				}
			}
		}

	}
}