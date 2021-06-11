<?php

namespace PtuDex\Common\Factories;

use PtuDex\Common\Models\Model;

class PokemonFactory extends JsonDrivenFactory
{
	protected function getPath(): string 
	{
		return \Engine\Util\Paths::getDataPath() . "pokemon.json";
	}

	protected function makeModel(array $data): \Engine\Model\Model
	{
		$model = new \PtuDex\Common\Models\Pokemon($data['name'], "");

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

	private function makeTypeSet(array $data) : \PtuDex\Common\Models\PokemonTypeSet
	{
		$types = [];

		foreach($data as $typeName)
		{
			$types[] = TypeFactory::getInstance()
			->get($typeName);
		}

		return new \PtuDex\Common\Models\PokemonTypeSet(...$types);
	}

	private function makeSkillSet(array $data) : \PtuDex\Common\Models\SkillSet
	{
		$skillset = new \PtuDex\Common\Models\SkillSet();

		$ranks = $data['ranks'];
		$mods  = $data['mods'];

		foreach(\PtuDex\Common\Enums\SkillNames::getConstants() as $key => $value)
		{
			$skillset->setSkill($value, $ranks[$value], $mods[$value]);
		}

		return $skillset;
	}

	private function makeMoveList(array $data) : \PtuDex\Common\Models\MoveList
	{
		$entries = [];

		foreach($data as $datum)
		{
			$move = MoveFactory::getInstance()
			->getMove($datum['move']);

			$entries[] = new \PtuDex\Common\Models\MoveListEntry($move, $datum['level']);
		}

		return new \PtuDex\Common\Models\MoveList($entries);
	}

	private function makeAbilityList(array $data) : \PtuDex\Common\Models\AbilityList
	{
		$entries = [];

		foreach($data as $datum)
		{
			$ability = AbilityFactory::getInstance()->getAbility($datum['name']);

			$entries[] = new \PtuDex\Common\Models\AbilityListEntry($ability, $datum['level']);
		}

		return new \PtuDex\Common\Models\AbilityList(...$entries);
	}

	private function makeAttributeSet(array $data) : \PtuDex\Common\Models\AttributeSet
	{
		return new \PtuDex\Common\Models\AttributeSet
		(
			$data['hp'],
			$data['atk'],
			$data['def'],
			$data['spatk'],
			$data['spdef'],
			$data['spd'],
		);
	}

	private function makeCapabilityList(array $data) : \PtuDex\Common\Models\CapabilityList
	{
		$entries = [];

		foreach($data as $datum)
		{
			$capability = CapabilityFactory::getInstance()
			->getCapability($datum['name']);

			$entries[] = new \PtuDex\Common\Models\CapabilityListEntry($capability);
		}

		return new \PtuDex\Common\Models\CapabilityList(...$entries);
	}

	protected function validateData(array $data): bool 
	{
		return true;
	}

	public function getPokemonByName(string $name) : \PtuDex\Common\Models\Pokemon
	{
		return $this->get($name);
	}

}