<?php

namespace PtuDex\CoverageCalculator\Elements;

class ResultsElement extends \Engine\Page\Element\Div
{
	private \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores $results;
	private int $pokemonNumber;

	public function render(): string
	{
		$table = \Engine\Page\Element\Table::create()
		->addElement
		(
			\Engine\Page\Element\TableRow::create()
			->setData(["Type", "Score"])
			->setIsHeader()
		);

		foreach($this->results->getScores() as $type => $score)
		{
			$table->addElement
			(
				\Engine\Page\Element\TableRow::create()
				->setData([ucwords($type), Score::create()->setScore($score)])
			);
		}

		if(count($this->results->bestImprovements) > 0)
		{
			$table->addElement
			(
				\Engine\Page\Element\TableRow::create()
				->setIsHeader()
				->setData(["Best improvements"])
				->addAttribute(new \Engine\Page\Element\Attribute("class", "improvement"))
			);

			foreach($this->results->bestImprovements as $type)
			{
				$table->addElement
				(
					\Engine\Page\Element\TableRow::create()
					->setData
					([
						\PtuDex\Common\Elements\PokemonTypeSetDecorator::create()
						->setValue
						(
							new \PtuDex\Common\Models\PokemonTypeSet($type)
						)
					])
					->addAttribute(new \Engine\Page\Element\Attribute("class", "improvement"))
				);
			}
		}

		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(3)
			->setContents("Pokemon {$this->pokemonNumber}")
		);
		$this->addElement($table);

		return parent::render();
	}

	public function setResults(\PtuDex\CoverageCalculator\Model\CoverageCalculatorScores $results) : self
	{
		$this->results = $results;
	
		return $this;
	}

	public function setPokemonNumber(int $pokemonNumber) : self
	{
		$this->pokemonNumber = $pokemonNumber;
	
		return $this;
	}
}