<?php namespace FergusInLondon\Triggr;

use \Hoa\Ruler;

/**
 * Provides the base functionality required to implement a Ruleset, notably a
 *  mechanism for calling Hoa's Ruler object.
 */
abstract class AbstractRuleset
{
    /** @var string|null */
    protected $rule = null;


    /**
     * Given an object adhering to the ContextProviderInterface, evaluate it
     *  against this objects using the provided Ruler object. We specifically
     *  silence Hoa Asserter exceptions, since this allows us to continue
     *  evaluating rules on error.
     *
     * @param  \Hoa\Ruler\Ruler                                            $ruler
     * @param  \FergusInLondon\Triggr\Interfaces\ContextProviderInterface  $contextProvider
     * @throw  \InvalidArgumentException
     * @throw  \LogicException
     * @return bool
     */
    public function evaluate(
        \Hoa\Ruler\Ruler $ruler,
        \FergusInLondon\Triggr\Interfaces\ContextProviderInterface $contextProvider
    ) {
        $context = $contextProvider->getContext();
        
        // Ensure the Context object is valid.
        if (! ($context instanceof \Hoa\Ruler\Context)) {
            throw new \InvalidArgumentException("ContextProvider::getContext should return valid Hoa Ruler context.");
        }
        
        // Ensure that $this->rule is set correctly        
        if (!is_string($this->rule)) {
            throw new \LogicException("Ruleset objects must have protected property AbstractRuleset::rule!");
        }
        
        try {
            return $ruler->assert($this->rule, $context);
        } catch (\Hoa\Ruler\Exception\Asserter $e) {
            // Yes, silencing an exception by simply returning false sounds like
            //  a really bad idea. And it is. Unless you want to continue beyond
            //  errors and have no expectations about the quality of the data
            //  you're receiving.. we don't expect 100% good data, if it's bad
            //  then the rule fails: simple.
            return false;
        }
    }


    /**
     * This is the method that get's called when a given Ruleset is satsified.
     *
     * @param \FergusInLondon\Triggr\Interfaces\ContextProviderInterface $contextProvider
     */    
    abstract public function action(
        \FergusInLondon\Triggr\Interfaces\ContextProviderInterface $contextProvider
    );
}
