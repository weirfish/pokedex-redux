<?php

namespace PtuDex\Factories;

use PtuDex\Models\Model;

class PokemonFactory extends JsonDrivenFactory
{
	protected function getPath(): string 
	{
		return \Engine\Util\Paths::getDataPath() . "pokemon.json";
	}

	protected function makeModel(array $data): Model 
	{
		$model = new \PtuDex\Models\Pokemon($data['name'], "");

		$model->abilities    = $this->makeAbilityList($data['abilities']);
		$model->attributes   = $this->makeAttributeSet($data['attributes']);
		$model->capabilities = $this->makeCapabilityList($data['capabilities']);
		$model->eggMoves    = $this->makeMoveList($data['moves']['egg'] ?? []);
		$model->learnMoves  = $this->makeMoveList($data['moves']['learn'] ?? []);
		$model->tutorMoves  = $this->makeMoveList($data['moves']['hmtm'] ?? []);
		$model->hmtmMoves   = $this->makeMoveList($data['moves']['tutor'] ?? []);
		$model->skills       = $this->makeSkillSet($data['skills']);
		$model->types        = $this->makeTypeSet($data['types']);

		return $model;
	}

	private function makeTypeSet(array $data) : \PtuDex\Models\PokemonTypeSet
	{
		$types = [];

		foreach($data as $typeName)
		{
			$types[] = TypeFactory::getInstance()
			->get($typeName);
		}

		return new \PtuDex\Models\PokemonTypeSet(...$types);
	}

	private function makeSkillSet(array $data) : \PtuDex\Models\SkillSet
	{
		$skillset = new \PtuDex\Models\SkillSet();

		$ranks = $data['ranks'];
		$mods  = $data['mods'];

		foreach(\PtuDex\Enums\SkillNames::getConstants() as $key => $value)
		{
			$skillset->setSkill($value, $ranks[$value], $mods[$value]);
		}

		return $skillset;
	}

	private function makeMoveList(array $data) : \PtuDex\Models\MoveList
	{
		$entries = [];

		foreach($data as $datum)
		{
			$move = MoveFactory::getInstance()
			->getMove($datum['move']);

			$entries[] = new \PtuDex\Models\MoveListEntry($move, $datum['level']);
		}

		return new \PtuDex\Models\MoveList($entries);
	}

	private function makeAbilityList(array $data) : \PtuDex\Models\AbilityList
	{
		$entries = [];

		foreach($data as $datum)
		{
			$ability = AbilityFactory::getInstance()->getAbility($datum['name']);

			$entries[] = new \PtuDex\Models\AbilityListEntry($ability, $datum['level']);
		}

		return new \PtuDex\Models\AbilityList(...$entries);
	}

	private function makeAttributeSet(array $data) : \PtuDex\Models\AttributeSet
	{
		return new \PtuDex\Models\AttributeSet
		(
			$data['hp'],
			$data['atk'],
			$data['def'],
			$data['spatk'],
			$data['spdef'],
			$data['spd'],
		);
	}

	private function makeCapabilityList(array $data) : \PtuDex\Models\CapabilityList
	{
		$entries = [];

		foreach($data as $datum)
		{
			$capability = CapabilityFactory::getInstance()
			->getCapability($datum['name']);

			$entries[] = new \PtuDex\Models\CapabilityListEntry($capability);
		}

		return new \PtuDex\Models\CapabilityList(...$entries);
	}

	protected function validateData(array $data): bool 
	{
		return true;
	}

	public function getPokemonByName(string $name) : \PtuDex\Models\Pokemon
	{
		return $this->get($name);
	}

}