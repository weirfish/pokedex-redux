<?php

namespace PtuDex\Common\Elements;

class DamageBaseDecorator extends \Engine\Page\Element\Decorator
{
	public function render() : string
	{
		if($this->value === \PtuDex\Common\Enums\DamageBase::DB0)
			$val = "--";
		else $val = $this->value;
		
		$this->setElements
		([
			(new \Engine\Page\Element\Literal())
			->setContents($val)
		]);

		return parent::render();
	}

	public function setValue(mixed $value) : self
	{
		if(\PtuDex\Common\Enums\DamageBase::isConstantValue($value))
			$this->value = $value;
		else throw new \LogicException("The given value is not a damage base");

		return $this;
	}
}