<?php

namespace PtuDex\Home\Elements;

class MainMenu extends \Engine\Page\Element\Div
{
	public function render(): string
	{
		$this->setElements
		([
			MainMenuItem::create()
			->setTitle("Pokedex")
			->setDescription("A searchable, sortable Pokedex to help you find the perfect pokemon for your build.")
			->setIconPath("http://www.placekitten.com/200/200"),
			MainMenuItem::create()
			->setTitle("Metronome Roller")
			->setDescription("A tool to help you roll your Metronomes. Waggle those fingers!")
			->setIconPath("http://www.placekitten.com/200/200"),
			MainMenuItem::create()
			->setTitle("Type Coverage Calculator")
			->setDescription("A tool to help you figure out which types you'll struggle to fight.")
			->setIconPath("http://www.placekitten.com/200/200")
		]);

		return parent::render();
	}
}