<?php

namespace PtuDex\Home\Elements;

class MainMenu extends \Engine\Page\Element\Div
{
	public function __construct()
	{
		$this->addAttribute(new \Engine\Page\Element\Attribute("id", "main-menu"));
	}

	public function render(): string
	{
		$this->setElements
		([
			MainMenuItem::create()
			->setTitle("Pokedex")
			->setDescription("A searchable, sortable Pokedex to help you find the perfect pokemon for your build.")
			->setIconPath(\PtuDex\Home\IconProvider::getPokedexIconPath())
			->setLinkPath(\PtuDex\Pokedex\Route::$route),
			MainMenuItem::create()
			->setTitle("Metronome Roller")
			->setDescription("A tool to help you roll your Metronomes. Waggle those fingers!")
			->setIconPath(\PtuDex\Home\IconProvider::getMetronomeIconPath())
			->setLinkPath(\PtuDex\Metronome\Route::$route),
			MainMenuItem::create()
			->setTitle("Type Coverage Calculator")
			->setDescription("A tool to help you figure out which types you'll struggle to fight.")
			->setIconPath(\PtuDex\Home\IconProvider::getTypeCoverageIconPath()),
			MainMenuItem::create()
			->setTitle("Comparative Damage Calculator")
			->setDescription("A tool to help you figure out who's doing more damage.")
			->setIconPath(\PtuDex\Home\IconProvider::getDamageCalculatorIconPath())
		]);

		return parent::render();
	}
}