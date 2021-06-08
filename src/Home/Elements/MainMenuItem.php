<?php

namespace PtuDex\Home\Elements;

class MainMenuItem extends \Engine\Page\Element\Div
{
	private string $title;
	private string $description;
	private string $icon_path;
	private string $link_path = "";
	
	public function render(): string
	{
		$this->setElements
		([
			\Engine\Page\Element\Anchor::create()
			->setSource($this->link_path)
			->addElement
			(
				\Engine\Page\Element\Div::create()
				->setElements
				([
					\Engine\Page\Element\Image::create()
					->setSrc($this->icon_path),
					\Engine\Page\Element\Div::create()
					->setElements([
						\Engine\Page\Element\Heading::create()
						->setLevel(2)
						->setContents($this->title),
						\Engine\Page\Element\Paragraph::create()
						->setText($this->description)
					])
				]),
			)
		]);

		return parent::render();
	}
	
	public function setIconPath(string $icon_path) : self
	{
		$this->icon_path = $icon_path;
	
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
	public function setLinkPath(string $link_path) : self
	{
		$this->link_path = $link_path;
	
		return $this;
	}
}