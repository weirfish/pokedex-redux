<?php

namespace PtuDex\DamageComparator;

class Page extends \Engine\Page\Page
{
	public function __construct()
	{
		parent::__construct();
	}
	protected function addElements()
	{
		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(1)
			->setContents("Damage Comparator")
		);
	}
}