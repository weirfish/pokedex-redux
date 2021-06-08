<?php

namespace PtuDex\Models;

class Move extends Entity
{
	public ?PokemonType $type        = null;
	public string $category         = "";
	public string $damage           = "";
	public ?MoveFrequency $frequency = null;
	public int $ac                  = 2;
	public ?MoveRange $range         = null;
	public array $keywords          = [];
	public string $effect           = "";
	public bool $isMetronome       = true;

	public function __construct(string $name, PokemonType $type, string $category, string $damage, MoveFrequency $frequency, int $ac, MoveRange $range, string $effect, bool $isMetronome, string ...$keywords)
	{
		parent::__construct($name, "");

		if(!\PtuDex\Enums\MoveCategories::isConstantValue($category))
			throw new \LogicException("{$category} is not a valid category");

		foreach($keywords as $keyword)
			if(!\PtuDex\Enums\MoveKeywords::isConstantValue($keyword))
				throw new \LogicException("{$keyword} is not a valid keyword");

		$this->type        = $type;
		$this->category    = $category;
		$this->damage      = $damage;
		$this->frequency   = $frequency;
		$this->ac          = $ac;
		$this->range       = $range;
		$this->effect      = $effect;
		$this->keywords    = $keywords;
		$this->isMetronome = $isMetronome;
	}

	public function toArray() : array
	{
		return
		[
			"name" => $this->name,
			"type" => $this->type->getName(),
			"category" => $this->category,
			"damage" => $this->damage,
			"ac" => $this->ac,
			"effect" => $this->effect,
		];
	}
}