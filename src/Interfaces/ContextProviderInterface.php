<?php namespace FergusInLondon\Triggr\Interfaces;

/**
 * The ContextProviderInterface simply signifies that a given object
 *  can provide a valid Context to our Ruleset objects. The most
 *  likely objects to implement this interface are Models.
 *
 * @see FergusInLondon\Triggy\AbstractRuleset
 */
interface ContextProviderInterface
{
    /**
     * Returns a Hoa Ruler Context; allowing Ruleset objects to evaluate.
     *  If this Context isn't suitable for a given Ruleset, it doesn't
     *  matter, we're fully expecting to take a scatter-gun approach where
     *  incorrect contexts will silently fail.
     *
     * @return \Hoa\Ruler\Context
     */
    public function getContext();
}
