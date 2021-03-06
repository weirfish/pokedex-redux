<?php

namespace PtuDex\Common\Models;

class AttributeSet extends \Engine\Model\Model
{
	public $hp             = 0;
	public $attack         = 0;
	public $defense        = 0;
	public $specialAttack  = 0;
	public $specialDefense = 0;
	public $speed          = 0;

	private $hpStages              = 0;
	private $attackStages          = 0;
	private $defenseStages         = 0;
	private $specialAttackStages  = 0;
	private $specialDefenseStages = 0;
	private $speedStages           = 0;

	public function __construct($hp, $attack, $defense, $specialAttack, $specialDefense, $speed)
	{
		$this->hp             = $hp;
		$this->attack         = $attack;
		$this->defense        = $defense;
		$this->specialAttack  = $specialAttack;
		$this->specialDefense = $specialDefense;
		$this->speed          = $speed;
	}

	public function calculateAttribute($stat) : float
	{
		switch($stat)
		{
			case \PtuDex\Common\Enums\AttributeNames::HP:
				return $this->calcAttribute($this->hp, $this->hpStages);
			case \PtuDex\Common\Enums\AttributeNames::ATTACK:
				return $this->calcAttribute($this->attack, $this->attackStages);
			case \PtuDex\Common\Enums\AttributeNames::DEFENSE:
				return $this->calcAttribute($this->defense, $this->defenseStages);
			case \PtuDex\Common\Enums\AttributeNames::SPECIAL_ATTACK:
				return $this->calcAttribute($this->specialAttack, $this->specialAttackStages);
			case \PtuDex\Common\Enums\AttributeNames::SPECIAL_DEFENSE:
				return $this->calcAttribute($this->specialDefense, $this->specialDefenseStages);
			case \PtuDex\Common\Enums\AttributeNames::SPEED:
				return $this->calcAttribute($this->speed, $this->speedStages);
		}

		throw new \LogicException("{$stat} is not a valid attribute name");
	}

	private function calcAttribute($score, $cs) : float
	{
		return $score * (1 + $this->getCombatStageModifier($cs) * $cs);
	}

	private function getCombatStageModifier($combatStages) : float
	{
		if($combatStages > 0)
			return 0.2;
		else return 0.1;
	}
}