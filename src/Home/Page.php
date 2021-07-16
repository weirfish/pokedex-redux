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
			\Engine\Page\Element\Div::create()
			->setElements
			([
				\Engine\Page\Element\Image::create()
				->setSrc(IconProvider::getWarningIconPath()),
				\Engine\Page\Element\Paragraph::create()
				->setText("The data files that drive this website are sparse and incomplete, scraped imperfectly from the Pokedex PDF and the Fancy Sheet. This project is a work in progress. Please be patient, and report issues on <a href=\"https://github.com/weirfish/pokedex-redux/issues\">Github</a>")
			])
			->addAttribute(new \Engine\Page\Element\Attribute("class", "warning"))
		);

		$this->addElement
		(
			\PtuDex\Home\Elements\MainMenu::create()
		);
	}
}