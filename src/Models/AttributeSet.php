<?php

namespace PtuDex\Models;

class AttributeSet extends Model
{
	public $hp              = 0;
	public $attack          = 0;
	public $defense         = 0;
	public $special_attack  = 0;
	public $special_defense = 0;
	public $speed           = 0;

	private $hp_cs              = 0;
	private $attack_cs          = 0;
	private $defense_cs         = 0;
	private $special_attack_cs  = 0;
	private $special_defense_cs = 0;
	private $speed_cs           = 0;

	public function __construct($hp, $attack, $defense, $special_attack, $special_defense, $speed)
	{
		$this->hp              = $hp;
		$this->attack          = $attack;
		$this->defense         = $defense;
		$this->special_attack  = $special_attack;
		$this->special_defense = $special_defense;
		$this->speed           = $speed;
	}

	public function calculateAttribute($stat) : float
	{
		if(!\Enums\AttributeNames::isConstantValue($stat))
			throw new \LogicException("{$stat} is not a valid attribute name");

		switch($stat)
		{
			case \Enums\AttributeNames::HP:
				return $this->calcAttribute($this->hp, $this->hp_cs);
			case \Enums\AttributeNames::ATTACK:
				return $this->calcAttribute($this->attack, $this->attack_cs);
			case \Enums\AttributeNames::DEFENSE:
				return $this->calcAttribute($this->defense, $this->defense_cs);
			case \Enums\AttributeNames::SPECIAL_ATTACK:
				return $this->calcAttribute($this->special_attack, $this->special_attack_cs);
			case \Enums\AttributeNames::SPECIAL_DEFENSE:
				return $this->calcAttribute($this->special_defense, $this->special_defense_cs);
			case \Enums\AttributeNames::SPEED:
				return $this->calcAttribute($this->speed, $this->speed_cs);
		}
	}

	private function calcAttribute($score, $cs) : float
	{
		return $score * (1 + $this->getCombatStageModifier($cs) * $cs);
	}

	private function getCombatStageModifier($combat_stages) : float
	{
		if($combat_stages > 0)
			return 0.2;
		else return 0.1;
	}
}