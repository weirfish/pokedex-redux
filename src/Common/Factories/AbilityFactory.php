<?php

namespace PtuDex\Common\Factories;

class AbilityFactory extends JsonDrivenFactory
{
	protected function getPath(): string
	{
		return \Engine\Util\Paths::getDataPath() . "abilities.json";
	}

	protected function makeModel(array $data): \Engine\Model\Model
	{
		return new \PtuDex\Common\Models\Ability
		(
			$data['name'],
			$data['description'],
		);
	}

	protected function validateData(array $data): bool
	{
		if($data['name'] === null || $data['name'] === "")
			throw new \LogicException("No name given");

		return true;
	}

	public function getAbility(string $name) : \PtuDex\Common\Models\Ability
	{
		$ability = $this->get($name);
		
		if(null === $ability)
			throw new \PtuDex\Common\Factories\Exception\ItemNotFoundException("Ability {$name} not found");

		return $ability;
	}

	public function getAllAbilities() : array
	{
		return $this->getAll();
	}

}