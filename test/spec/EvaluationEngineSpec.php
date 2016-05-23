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
}
