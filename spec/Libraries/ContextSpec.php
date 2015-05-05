<?php namespace spec\Cupona\Libraries;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Cupona\Libraries\Context');
    }
}
