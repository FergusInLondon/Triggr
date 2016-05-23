<?php namespace spec\Concrete;

use FergusInLondon\Triggr\AbstractRuleset;

class Ruleset extends AbstractRuleset
{
    protected $rule = "individual in group and bigger > smaller";
    
    public function action(
        \FergusInLondon\Triggr\Interfaces\ContextProviderInterface $contextProvider
    ) {
        // stub.        
    }
}