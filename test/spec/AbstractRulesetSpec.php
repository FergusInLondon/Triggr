<?php

namespace spec\FergusInLondon\Triggr;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AbstractRulesetSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('spec\Concrete\Ruleset');
    }
    
    function is_capable_of_accepting_context_provider($contextProvider)
    {
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $this->evaluate($contextProvider);        
    }
    
    function it_should_accept_valid_hoa_context($contextProvider)
    {
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $contextProvider->getContext()->willReturn(new \Hoa\Ruler\Context);
        $this->evaluate($contextProvider);
    }
    
    function it_should_throw_an_exception_if_context_is_not_valid($contextProvider)
    {
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $contextProvider->getContext()->willReturn(array());
        $this
            ->shouldThrow(new \InvalidArgumentException("ContextProvider::getContext should return valid Hoa Ruler context."))
            ->during('evaluate', [$contextProvider]);
    }
    
    function is_correctly_returning_false_from_ruler()
    {
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $context = new \Hoa\Ruler\Context();
        $context["bigger"]     = 10;
        $context["smaller"]    = 15;
        $context["individual"] = "dog";
        $context["group"]      = ["cat", "rabbit", "hamster",  "guinea pig"];
        
        $contextProvider->getContext()->willReturn($context);        
        $this->evaluate($contextProvider)->shouldReturn(false);
    }
    
    function is_correctly_returning_true_from_ruler()
    {
        $contextProvider->beADoubleOf(
            'FergusInLondon\Triggr\Interfaces\ContextProviderInterface'
        );
        
        $context = new \Hoa\Ruler\Context();
        $context["bigger"]     = 15;
        $context["smaller"]    = 10;
        $context["individual"] = "dog";
        $context["group"]      = ["dog", "cat", "rabbit", "hamster",  "guinea pig"];
        
        $contextProvider->getContext()->willReturn($context);        
        $this->evaluate($contextProvider)->shouldReturn(true);
    }    
}
