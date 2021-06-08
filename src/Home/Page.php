<?php

namespace PtuDex\Home;

class Page extends \Engine\Page\Page
{
	protected function addElements()
	{
		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(1)
			->setContents("PTUDex")
		);

		$this->addElement
		(
			\PtuDex\Home\Elements\MainMenu::create()
		);
	}
}