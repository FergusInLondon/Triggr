<?php

namespace spec\FergusInLondon\Triggr;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EvaluationEngineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FergusInLondon\Triggr\EvaluationEngine');
    }
    
    function it_should_accept_context_provider($contextProvider)
    {
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $this->evaluate($contextProvider);
    }
    
    function it_should_should_accept_ruleset($ruleset)
    {
        $ruleset->beADoubleOf('FergusInLondon\Triggr\Ruleset');        
        $this->addRuleset($ruleset);
    }
    
    function it_should_accept_an_array_of_rulesets($rulesetA, $rulesetB)
    {
        $rulesetA->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        $rulesetB->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        
        $this->addRulesets([$rulesetA, $rulesetB]);
    }
    
    function it_should_reject_non_ruleset_array_members($ruleset)
    {
        $ruleset->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        
        $this
            ->shouldThrow(new \InvalidArgumentException("EvaluationEngine::addRulesets expects array of Ruleset objects."))
            ->during('addRulesets', [[$ruleset, null]]);
    }
    
    function it_should_evaluate_all_rulesets(
        $rulesetA, $rulesetB, $rulesetC, $contextProvider
    ) {
        $rulesetA->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        $rulesetB->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        $rulesetC->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $this->addRuleset($rulesetA);
        $this->addRulesets([$rulesetB, $rulesetC]);
        $this->evaluate($contextProvider);
        
        $rulesetA->evaluate($contextProvider)->shouldHaveBeenCalled();
        $rulesetB->evaluate($contextProvider)->shouldHaveBeenCalled();
        $rulesetC->evaluate($contextProvider)->shouldHaveBeenCalled();
    }
    
    function it_should_call_action_method_when_ruleset_passes($ruleFail, $rulePass, $contextProvider)
    {
        $rulePass->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        $ruleFail->beADoubleOf('FergusInLondon\Triggr\Ruleset');
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $rulePass->evaluate($contextProvider)->willReturn(true);
        $rulePass->action($contextProvider)->shouldBeCalled();
        
        $ruleFail->evaluate($contextProvider)->willReturn(false);        
        $ruleFail->action($contextProvider)->shouldNotBeCalled();
        
        $this->addRulesets([$rulePass, $ruleFail]);
        $this->evaluate($contextProvider);
    }
}
