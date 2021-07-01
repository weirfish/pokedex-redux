<?php

namespace PtuDex\Common\Elements;

class PokemonTypeSetDecorator extends \Engine\Page\Element\Decorator
{
	public function __construct()
	{
		parent::__construct();

		$this->addStyle(\PtuDex\Common\CssProvider::getInstance()->getPokemonTypeDecoratorCss());
	}

	public function render() : string
	{
		$elements = [];

		foreach($this->value->types as $type)
		{
			$type_name = str_replace(".", "-", $type->getName());

			$elements[] = \Engine\Page\Element\Div::create()
			->addElement
			(
				(new \Engine\Page\Element\Literal)
				->setContents($type->getHumanReadableName())
			)
			->addAttribute(new \Engine\Page\Element\Attribute("class", "{$type_name}"));
		}

		$this->setElements($elements);

		$this->addAttribute(new \Engine\Page\Element\Attribute("class", "pokemon-type"));

		return parent::render();
	}

	public function setValue(mixed $value) : self
	{
		if($value instanceof \PtuDex\Common\Models\PokemonType)
			$this->value = new \PtuDex\Common\Models\PokemonTypeSet($value);
		else if($value instanceof \PtuDex\Common\Models\PokemonTypeSet)
			$this->value = $value;
		else throw new \LogicException("The given value is not a type or type set");

		return $this;
	}
}