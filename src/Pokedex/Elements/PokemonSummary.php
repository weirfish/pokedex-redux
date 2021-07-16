<?php

namespace PtuDex\Pokedex\Elements;

use PtuDex\Common\Models\AbilityListEntry;
use PtuDex\Common\Models\CapabilityListEntry;
use PtuDex\Common\Models\MoveListEntry;

class PokemonSummary extends \Engine\Page\Element\Div
{
	private \PtuDex\Common\Models\Pokemon $pokemon;

	public function __construct()
	{
		$this->addStyle(\PtuDex\Common\AssetLinkProvider::getInstance()->getCssPath("pokedex/pokemon-summary"));
		$this->addScript(\PtuDex\Common\AssetLinkProvider::getInstance()->getJsPath("pokemon-summary"));
		$this->addAttribute(new \Engine\Page\Element\Attribute("class", "pokemon-summary"));
	}
	
	public function render(): string
	{
		$this->setElements
		([
			\Engine\Page\Element\Div::create()
			->setElements([
				\Engine\Page\Element\Image::create()
				->setSrc(\PtuDex\Common\AssetLinkProvider::getInstance()->getPokemonImgPath($this->pokemon)),
				\Engine\Page\Element\Div::create()
				->setElements
				([
					\Engine\Page\Element\Div::create()
					->setElements
					([
						\Engine\Page\Element\Heading::create()
						->setLevel(2)
						->setContents($this->pokemon->name),
						\PtuDex\Common\Elements\PokemonTypeSetDecorator::create()
						->setValue($this->pokemon->types)
					]),
					\Engine\Page\Element\Div::create()
					->setElements
					([
						\Engine\Page\Element\Div::create()
						->setElements
						([
							\Engine\Page\Element\Heading::create()
							->setLevel(3)
							->setContents("Stats"),
							$this->createStatList($this->pokemon->attributes),
						])
						->addAttribute(new \Engine\Page\Element\Attribute("class", "pokemon-summary_attributes")),
						\Engine\Page\Element\Div::create()
						->setElements
						([
							\Engine\Page\Element\Heading::create()
							->setLevel(3)
							->setContents("Abilities"),
							$this->createAbilityList($this->pokemon->abilities)
						]),
						\Engine\Page\Element\Div::create()
						->setElements
						([
							\Engine\Page\Element\Heading::create()
							->setLevel(3)
							->setContents("Capabilities"),
							$this->createCapabilityList($this->pokemon->capabilities)
						]),
					])
				])
			]),
			\Engine\Page\Element\Div::create()
			->setElements([
				\Engine\Page\Element\Div::create()
				->setElements
				([
					\Engine\Page\Element\Heading::create()
					->setLevel(3)
					->setContents("Learn Moves"),
					$this->createLevelledMoveList($this->pokemon->learnMoves, true)
				])
				->addAttribute(new \Engine\Page\Element\Attribute("class", "pokemon-summary_move-list")),
				\Engine\Page\Element\Div::create()
				->setElements
				([
					\Engine\Page\Element\Heading::create()
					->setLevel(3)
					->setContents("HM/TM Moves"),
					$this->createUnlevelledMoveList($this->pokemon->hmtmMoves)
				])
				->addAttribute(new \Engine\Page\Element\Attribute("class", "pokemon-summary_move-list")),
				\Engine\Page\Element\Div::create()
				->setElements
				([
					\Engine\Page\Element\Heading::create()
					->setLevel(3)
					->setContents("Egg Moves"),
					$this->createUnlevelledMoveList($this->pokemon->eggMoves)
				])
				->addAttribute(new \Engine\Page\Element\Attribute("class", "pokemon-summary_move-list")),
				\Engine\Page\Element\Div::create()
				->setElements
				([
					\Engine\Page\Element\Heading::create()
					->setLevel(3)
					->setContents("Tutor Moves"),
					$this->createUnlevelledMoveList($this->pokemon->tutorMoves)
				])
				->addAttribute(new \Engine\Page\Element\Attribute("class", "pokemon-summary_move-list")),
			])
		]);

		return parent::render();
	}

	private function createStatList(\PtuDex\Common\Models\AttributeSet $attributes)
	{
		$entries = 
		[
			new \Engine\Page\Element\Model\DataListEntry("HP",              $attributes->getHp()),
			new \Engine\Page\Element\Model\DataListEntry("Attack",          $attributes->getAttack()),
			new \Engine\Page\Element\Model\DataListEntry("Defense",         $attributes->getDefense()),
			new \Engine\Page\Element\Model\DataListEntry("Sp Attack",  $attributes->getSpecialAttack()),
			new \Engine\Page\Element\Model\DataListEntry("Sp Defense", $attributes->getSpecialDefense()),
			new \Engine\Page\Element\Model\DataListEntry("Speed",           $attributes->getSpeed()),
		];

		return \Engine\Page\Element\DescriptionList::create()
		->setEntries(...$entries);
	}

	private function createLevelledMoveList(\PtuDex\Common\Models\MoveList $moveList, bool $renderLevel = false)
	{
		if(count($moveList->entityListEntries) === 0)
			return \Engine\Page\Element\Literal::create()
			->setContents("There are no moves");

		$entries = [];

		/** @var MoveListEntry $moveListEntry */
		foreach($moveList->entityListEntries as $moveListEntry)
		{
			$entries[] = new \Engine\Page\Element\Model\DataListEntry($moveListEntry->entity->name, $moveListEntry->level);
		};

		return \Engine\Page\Element\DescriptionList::create()
		->setEntries(...$entries)
		->setReverse();
	}

	private function createUnlevelledMoveList(\PtuDex\Common\Models\MoveList $moveList, bool $renderLevel = false)
	{
		if(count($moveList->entityListEntries) === 0)
			return \Engine\Page\Element\Literal::create()
			->setContents("There are no moves");

		$entries = [];

		/** @var MoveListEntry $moveListEntry */
		foreach($moveList->entityListEntries as $moveListEntry)
		{
			$entries[] = $moveListEntry->entity->name;
		};

		return \Engine\Page\Element\UnorderedList::create()
		->setEntries(...$entries);
	}

	private function createAbilityList(\PtuDex\Common\Models\AbilityList $abilityList)
	{
		$entries = [];

		/** @var AbilityListEntry $abilityListEntry */
		foreach($abilityList->entityListEntries as $abilityListEntry)
		{
			switch($abilityListEntry->level)
			{
				case 0:
					$heading = "<i>Basic</i>";
					break;
				case 20:
					$heading = "<i>Adv</i>";
					break;
				case 40:
					$heading = "<i>High</i>";
					break;
			}

			$entries[] = new \Engine\Page\Element\Model\DataListEntry($abilityListEntry->entity->name, $heading);
		}

		return \Engine\Page\Element\DescriptionList::create()
		->setEntries(...$entries)
		->setReverse(true);
	}

	private function createCapabilityList(\PtuDex\Common\Models\CapabilityList $capabilityList)
	{
		$entries = [];

		/** @var CapabilityListEntry $capabilityListEntry */
		foreach($capabilityList->entityListEntries as $capabilityListEntry)
		{
			$entries[] = $capabilityListEntry->entity->name;
		}

		return \Engine\Page\Element\UnorderedList::create()
		->setEntries(...$entries);
	}

	public function setPokemon(\PtuDex\Common\Models\Pokemon $pokemon) : self
	{
		$this->pokemon = $pokemon;
	
		return $this;
	}
}