<?php namespace FergusInLondon\Triggr;

use Hoa\Ruler;

abstract class AbstractRuleset
{
    protected $ruler;
    
    public function __construct() {
        $this->ruler = new Ruler();
    }
    
    public function evaluate(
        \FergusInLondon\Triggr\Interfaces\ContextProviderInterface $contextProvider
    ) {
        $context = $contextProvider->getContext();
        
        if (! ($context instanceof \Hoa\Ruler\Context)) {
            throw new \InvalidArgumentException("ContextProvider::getContext should return valid Hoa Ruler context.");
        }
        
        if (!isset($this->rule)) {
            throw new \LogicException("Ruleset objects must have protected property AbstractRuleset::rule!");
        }
        
        try {
            return $this->ruler->assert($this->rule, $context);            
        } catch(\Hoa\Ruler\Exception\Asserter $e) {
            // Yes, silencing an exception by simply returning false sounds like
            //  a really bad idea. And it is. Unless you want to continue beyond
            //  errors and have no expectations about the quality of the data
            //  you're receiving.. we don't expect 100% good data, if it's bad
            //  then the rule fails: simple.
            return false;
        }
    }

    abstract public function action(
        \FergusInLondon\Triggr\Interfaces\ContextProviderInterface $contextProvider
    );
}
