<?php

namespace PtuDex\Metronome\Model;

class MetronomeResult extends \PtuDex\Models\Model
{
	public string $name;
	public ?\PtuDex\Models\PokemonType $type;
	public string $category;
	public string $damage;
	public string $stabDamage;
	public int $ac;
	public ?\PtuDex\Models\MoveRange $range;
	public string $effect;

	public static function fromMove(\PtuDex\Models\Move $move)
	{
		$result = self::create();

		$result->name       = $move->getName();
		$result->type       = $move->type;
		$result->category   = $move->category;
		$result->damage     = $move->damage;
		$result->stabDamage = \PtuDex\Enums\DamageBase::stabifyDB($move->damage);
		$result->ac         = $move->ac;
		$result->range      = $move->range;
		$result->effect     = $move->effect;

		return $result;
	}
	
	public function __toString()
	{
		return var_export($this, true);
	}
}