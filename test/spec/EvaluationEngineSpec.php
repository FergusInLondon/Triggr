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
        $ruleset->beADoubleOf('spec\Concrete\Ruleset');        
        $this->addRuleset($ruleset);
    }
    
    function it_should_accept_an_array_of_rulesets($rulesetA, $rulesetB)
    {
        $rulesetA->beADoubleOf('spec\Concrete\Ruleset');
        $rulesetB->beADoubleOf('spec\Concrete\Ruleset');
        
        $this->addRulesets([$rulesetA, $rulesetB]);
    }
    
    function it_should_reject_non_ruleset_array_members($ruleset)
    {
        $ruleset->beADoubleOf('spec\Concrete\Ruleset');
        
        $this
            ->shouldThrow(new \InvalidArgumentException("EvaluationEngine::addRulesets expects array of Ruleset objects."))
            ->during('addRulesets', [[$ruleset, null]]);
    }
    
    function it_should_evaluate_all_rulesets(
        $rulesetA, $rulesetB, $rulesetC, $contextProvider
    ) {
        $rulesetA->beADoubleOf('spec\Concrete\Ruleset');
        $rulesetB->beADoubleOf('spec\Concrete\Ruleset');
        $rulesetC->beADoubleOf('spec\Concrete\Ruleset');
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
        $rulePass->beADoubleOf('spec\Concrete\Ruleset');
        $ruleFail->beADoubleOf('spec\Concrete\Ruleset');
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
    
    /** WIP: Features to be implemented.
    
    function it_can_accept_arrays_of_()
    {
        // Pass in an array like [
        //   ARuleSet::class,  
        //   AnotherRuleset::class,
        //   AndAnotherRuleset::class,
        //   AndSoOn::class
        // ]
        
        // Then test like Ruleset addition above.
    }
    
    function it_can_accept_custom_functions()
    {
        // Pass an identifier and callable to the EvaluationEngine
        
        // Check it's registered with Hoa Ruler object
    }
    
    **/
}
