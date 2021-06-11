<?php

namespace PtuDex\Home;

class Page extends \Engine\Page\Page
{
	public function __construct()
	{
		parent::__construct();

		$this->addStyle(\PtuDex\Common\CssProvider::getInstance()->getHomeCss());
	}
	protected function addElements()
	{
		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(1)
			->setContents("Weirfish's PTU Toolkit")
		);

		$this->addElement
		(
			\PtuDex\Home\Elements\MainMenu::create()
		);
	}
}