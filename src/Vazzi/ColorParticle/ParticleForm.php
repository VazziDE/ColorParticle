<?php


namespace Vazzi\ColorParticle;


use pocketmine\form\Form;
use pocketmine\player\Player;

class ParticleForm implements Form
{
	private $data;

	public function __construct()
	{
		$this->data["type"] = "form";
		$this->data["title"] = "§bColorParticle";
		$this->data["content"] = "§fUse different colored particles while walking";
		$this->data["buttons"] = [];

		foreach (ColorParticle::Colors as $color) {
			$this->data["buttons"][] = ["text" => $color . " Particle"];
		}
		$this->data["buttons"][] = ["text" => "§cClear Particle"];
	}

	/**
	 * @param Player $player
	 * @param mixed $data
	 */
	public function handleResponse(Player $player, $data): void
	{
		if($data !== null){

			if(isset(ColorParticle::Colors[$data])) {

				if($player->hasPermission("colorparticle.permission." . strtolower(ColorParticle::Colors[$data])) or $player->hasPermission("colorparticle.permission.all")) {

					ColorParticle::getInstance()->playerparticle[$player->getName()] = ColorParticle::Colors[$data];
					$player->sendMessage("§aYou are using " . ColorParticle::Colors[$data] . " Particle");

				}else{
					$player->sendMessage("§cYou don't have enough permission to use this Color.");
				}

			}else{
				if(isset(ColorParticle::getInstance()->playerparticle[$player->getName()])) {
					$player->sendMessage("§aYou cleared your Particle.");
					unset(ColorParticle::getInstance()->playerparticle[$player->getName()]);
				}
			}

		}
	}

	/**
	 * @return mixed
	 */
	public function jsonSerialize()
	{
		return $this->data;
	}

}