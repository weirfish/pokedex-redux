<?php

namespace PtuDex\Common\Elements;

class MoveCategoryDecorator extends \Engine\Page\Element\Decorator
{
	public function render() : string
	{
		$icon = \PtuDex\Home\IconProvider::getMoveCategoryIcon($this->value);

		if(file_exists($icon))
		{
			$this->setElements
			([
				(new \Engine\Page\Element\Image())
				->setSrc($icon)
			]);
		}
		else 
		{
			$this->setElements
			([
				(new \Engine\Page\Element\Literal())
				->setContents(\PtuDex\Common\Enums\MoveCategories::getHumanReadableText($this->value))
			]);
		}

		return parent::render();
	}

	public function setValue(mixed $value) : self
	{
		if(\PtuDex\Common\Enums\MoveCategories::isConstantValue($value))
			$this->value = $value;
		else throw new \LogicException("The given value is not a move category");

		return $this;
	}
}