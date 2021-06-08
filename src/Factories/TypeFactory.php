<?php

namespace PtuDex\Factories;

use PtuDex\Models\PokemonType;

class TypeFactory extends JsonDrivenFactory
{
	protected function getPath(): string
	{
		return \Engine\Util\Paths::getDataPath() . "pokemon-type-data.json";
	}

	protected function validateData(array $data): bool
	{
		if(!\PtuDex\Enums\TypeNames::isConstantValue($data['name']))
			throw new \LogicException("Type {$data['type']} is not valid");

		if(!is_array($data['resistances']))
			throw new \LogicException("Resistances were missing or malformed for {$data['type']}.");
		if(!is_array($data['weaknesses']))
			throw new \LogicException("Resistances were missing or malformed for {$data['type']}.");
		if(!is_array($data['immunities']))
			throw new \LogicException("Resistances were missing or malformed for {$data['type']}.");

		return true;
	}

	protected function makeModel(array $data): \PtuDex\Models\Model
	{
		return new \PtuDex\Models\PokemonType($data['name']);
	}

	protected function defineObjects() : array
	{
		$data = json_decode(file_get_contents($this->getPath()), true);

		$models = [];

		foreach($data as $datum)
		{
			if(!$this->validateData($datum))
				throw new \LogicException("The following record was not valid: {$datum}");

			$models[] = $this->makeModel($datum);
		}

		foreach($data as $datum)
		{
			$type = null;

			$type = $this->findModel($models, $datum['name']);

			foreach($datum['resistances'] as $resistance)
			{
				$type->addResistance($this->findModel($models, $resistance));
			}
			foreach($datum['weaknesses'] as $weakness)
			{
				$type->addWeakness($this->findModel($models, $weakness));
			}
			foreach($datum['immunities'] as $immunity)
			{
				$type->addImmunity($this->findModel($models, $immunity));
			}
		}

		return $models;
	}

	private function findModel(array $models, string $name) : \PtuDex\Models\PokemonType
	{
		foreach($models as $model)
		{
			if($model->getName() === $name)
				return $model;
		}

		throw new \LogicException("A move by {$name} could not be found");
	}

	public function getType(string $name) : PokemonType
	{
		return $this->get($name);
	}

	public function getAllTypes(): array
	{
		return $this->getAll();
	}
}