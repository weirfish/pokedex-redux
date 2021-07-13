<?php

namespace PtuDex\CoverageCalculator;

class Page extends \Engine\Page\Page
{
	public function __construct()
	{
		$this->addStyle(\PtuDex\Common\CssProvider::getInstance()->getCoverageCalculatorCss());

		parent::__construct();
	}

	protected function addElements()
	{
		$moveLists = $this->getMoveLists($this->post);

		$scores = \PtuDex\CoverageCalculator\Service\CoverageCalculator::create()
		->setMoves($moveLists)
		->run();

		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(1)
			->setContents("Damage Coverage Calculator")
		);

		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(2)
			->setContents("Enter your pokemon's moves")
		);

		$this->addElement
		(
			Elements\MoveForm::create()
			->setMoves($moveLists)
		);

		if($scores->hasResults())
		{
			$this->addElement
			(
				\Engine\Page\Element\Heading::create()
				->setLevel(2)
				->setContents("Results")
			);

			$this->addElement
			(
				\Engine\Page\Element\Div::create()
				->setElements
				([
					Elements\ResultsElement::create()
					->setResults($scores->getResults()[0])
					->setPokemonNumber(1),
					Elements\ResultsElement::create()
					->setResults($scores->getResults()[1])
					->setPokemonNumber(2),
					Elements\ResultsElement::create()
					->setResults($scores->getResults()[2])
					->setPokemonNumber(3),
					Elements\ResultsElement::create()
					->setResults($scores->getResults()[3])
					->setPokemonNumber(4),
					Elements\ResultsElement::create()
					->setResults($scores->getResults()[4])
					->setPokemonNumber(5),
					Elements\ResultsElement::create()
					->setResults($scores->getResults()[5])
					->setPokemonNumber(6),
				])
			);
		}
	}

	private function getMoveLists($post)
	{
		$factory = \PtuDex\Common\Factories\MoveFactory::getInstance();

		$pokemon = $post['move'] ?? [];

		$moveLists = [];

		foreach($pokemon as $movelist)
		{
			$moves = [];

			foreach($movelist as $move)
			{
				if($move === "")
					continue;

				$moves[] = $factory->getMove($move);
			}

			$moveLists[] = $moves;
		}

		return $moveLists;
	}
}