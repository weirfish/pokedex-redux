<?php

namespace PtuDex\Factories;

class CapabilityFactory extends JsonDrivenFactory
{
	protected function getPath(): string
	{
		return \Engine\Util\Paths::getDataPath() . "capabilities.json";
	}

	protected function makeModel(array $data): \Engine\Model\Model
	{
		return new \PtuDex\Models\Capability
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

	public function getCapability(string $name) : \PtuDex\Models\Capability
	{
		return $this->get($name);
	}

	public function getAllCapabilities() : array
	{
		return $this->getAll();
	}

}