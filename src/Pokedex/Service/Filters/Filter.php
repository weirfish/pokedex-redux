<?php

namespace PtuDex\Pokedex\Service\Filters;

use Engine\Model\Model;
use PtuDex\Pokedex\Service\Rules\Rule;

class Filter
{
	/** @var Model[] */
	private array $models = [];

	/** @var Rule[] */
	private array $rules = [];

	use \Engine\Traits\Creatable;

	/** @return Model[] */
	public function filter() : array
	{
		$accepted_models = $this->models;

		foreach($this->rules as $rule)
		{
			foreach($accepted_models as $key => $model)
			{
				if(!$rule->apply($model))
					unset($accepted_models[$key]);
			}

			$accepted_models = array_filter($accepted_models);
		}

		return $accepted_models;
	}

	public function addRule(Rule $rule) : self
	{
		$this->rules[] = $rule;

		return $this;
	}
	public function getModels() : array
	{
		return $this->models;
	}
	public function setModels(array $models) : self
	{
		$this->models = $models;
	
		return $this;
	}
	public function setRules(array $rules) : self
	{
		$this->rules = $rules;
	
		return $this;
	}
}