<?php

namespace PtuDex\Home\Elements;

class MainMenuItem extends \Engine\Page\Element\Anchor
{
	private string $title;
	private string $description;
	private string $iconPath;
	
	public function render(): string
	{
		$this->setElements
		([
			\Engine\Page\Element\Div::create()
			->setElements
			([
				\Engine\Page\Element\Image::create()
				->setSrc($this->iconPath),
				\Engine\Page\Element\Div::create()
				->setElements([
					\Engine\Page\Element\Heading::create()
					->setLevel(2)
					->setContents($this->title),
					\Engine\Page\Element\Paragraph::create()
					->setText($this->description)
				])
			])
		]);

		return parent::render();
	}
	
	public function setIconPath(string $iconPath) : self
	{
		$this->iconPath = $iconPath;
	
		return $this;
	}
	public function setDescription(string $description) : self
	{
		$this->description = $description;
	
		return $this;
	}
	public function setTitle(string $title) : self
	{
		$this->title = $title;
	
		return $this;
	}
	public function setLinkPath(string $linkPath) : self
	{
		return $this->setSource($linkPath);
	}
}