<?php

namespace PtuDex\Common\Factories;

abstract class JsonDrivenFactory extends \Engine\Abstracts\Factory
{
	abstract protected function getPath(): string;
	abstract protected function makeModel(array $data): \Engine\Model\Model;
	abstract protected function validateData(array $data): bool;

	public final function __construct()
	{
		foreach($this->defineObjects() as $object)
		{
			$this->objects[$object->getName()] = $object;
		}

		$this->postDefintion();
	}

	protected function getData() 
	{
		return json_decode(file_get_contents($this->getPath()), true);
	}

	protected function defineObjects() : array
	{
		$data = $this->getData();

		$models = [];

		foreach($data as $datum)
		{
			if(!$this->validateData($datum))
				throw new \LogicException("The following record was not valid: {$datum}");

			$models[] = $this->makeModel($datum);
		}

		return $models;
	}
}