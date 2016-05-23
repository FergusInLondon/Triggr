<?php namespace FergusInLondon\Triggr;

class EvaluationEngine
{
    private $rulesets = array();
    
    public function evaluate(Interfaces\ContextProviderInterface $contextProvider)
    {
        foreach ($this->rulesets as $ruleset) {
            if ($ruleset->evaluate($contextProvider)) {
                $ruleset->action($contextProvider);
            }
        }
    }

    public function addRuleset(Ruleset $ruleset)
    {
        $this->rulesets[] = $ruleset;
    }

    public function addRulesets(array $rulesets)
    {
        foreach ($rulesets as $ruleset) {
            if (! ($ruleset instanceof Ruleset)) {
                throw new \InvalidArgumentException(
                    "EvaluationEngine::addRulesets expects array of Ruleset objects."
                );
            }
            
            $this->rulesets[] = $ruleset;
        }
    }
}
