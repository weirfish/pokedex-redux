<?php

namespace PtuDex\Common\Elements;

class AcDecorator extends \Engine\Page\Element\Decorator
{
	public function render() : string
	{
		if($this->value === 0)
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
		if(is_numeric($value))
			$this->value = $value;
		else throw new \LogicException("The given value is not a valid AC");

		return $this;
	}
}