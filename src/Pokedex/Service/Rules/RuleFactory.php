<?php

namespace PtuDex\Pokedex\Service\Rules;

class RuleFactory
{
	public static function getRuleForSearchStringFragment(string $fragment)
	{
		[$term, $comparator, $value] = \PtuDex\Pokedex\Service\Search\ComparatorInterpreter::create()
		->setSearchStringPart($fragment)
		->run();

		switch($term)
		{
			case \PtuDex\Pokedex\Service\Search\Terms::NAME:
				$rule = PokemonNameRule::create(); break;
			case \PtuDex\Pokedex\Service\Search\Terms::TYPE:
				$rule = PokemonTypeRule::create(); break;
			// case \PtuDex\Pokedex\Service\Search\Terms::ATTRIBUTE:
			// 	$rule = PokemonNameRule::create(); break;
			// case \PtuDex\Pokedex\Service\Search\Terms::SKILL:
			// 	$rule = PokemonNameRule::create(); break;
			case \PtuDex\Pokedex\Service\Search\Terms::MOVE:
				$rule = PokemonMoveListRule::create(); break;
			case \PtuDex\Pokedex\Service\Search\Terms::LEARN_MOVE:
				$rule = PokemonLearnMoveListRule::create(); break;
			case \PtuDex\Pokedex\Service\Search\Terms::TUTOR_MOVE:
				$rule = PokemonTutorMoveListRule::create(); break;
			case \PtuDex\Pokedex\Service\Search\Terms::HMTM_MOVE:
				$rule = PokemonHmtmMoveListRule::create(); break;
			case \PtuDex\Pokedex\Service\Search\Terms::EGG_MOVES:
				$rule = PokemonEggMoveListRule::create(); break;
			// case \PtuDex\Pokedex\Service\Search\Terms::ABILITY:
			// 	$rule = PokemonNameRule::create(); break;
			// case \PtuDex\Pokedex\Service\Search\Terms::CAPABILITY:
			// 	$rule = PokemonNameRule::create(); break;
			default: throw new \LogicException("Term \"{$term}\" not recognised. Did you mean \"" . \PtuDex\Pokedex\Service\Search\Terms::getClosestTerm($term, 1) . "\"?");
		}

		return $rule->setComparator($comparator)
		->setValue($value);
	}
}