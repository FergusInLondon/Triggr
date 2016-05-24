<?php namespace FergusInLondon\Triggr;

use \Hoa\Ruler;

class EvaluationEngine
{
    /** @var AbstractRuleset[] */
    private $rulesets = array();

    /** @var \Hoa\Ruler\Ruler  */
    private $ruler;
    
    public function __construct()
    {
        $this->ruler = new Ruler();
    }


    /**
     * Given an object adhering to the ContextProviderInterface, run it through
     *  every ruleset to determine whether it matches any. If so, call the
     *  action() method on the ContextProvider.
     *
     * @param \FergusInLondon\Triggr\Interfaces\ContextProviderInterface $contextProvider
     */
    public function evaluate(Interfaces\ContextProviderInterface $contextProvider)
    {
        foreach ($this->rulesets as $ruleset) {
            if ($ruleset->evaluate($this->ruler, $contextProvider)) {
                $ruleset->action($contextProvider);
            }
        }
    }


    /**
     * Add a ruleset to the EvaluationEngine's internal registry.
     *
     * @param \FergusInLondon\Triggr\AbstractRuleset $ruleset
     */
    public function addRuleset(AbstractRuleset $ruleset)
    {
        $this->rulesets[] = $ruleset;
    }


    /**
     * Add multiple rulesets to the EvaluationEngine's internal registry.
     *
     * @param \FergusInLondon\Triggr\AbstractRuleset[] $rulesets
     */
    public function addRulesets(array $rulesets)
    {
        foreach ($rulesets as $ruleset) {
            if (! ($ruleset instanceof AbstractRuleset)) {
                throw new \InvalidArgumentException(
                    "EvaluationEngine::addRulesets expects array of Ruleset objects."
                );
            }
            
            $this->rulesets[] = $ruleset;
        }
    }
}
