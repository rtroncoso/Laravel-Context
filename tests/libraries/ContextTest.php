<?php

use Cupona\Libraries\Context;

class ContextTest extends TestCase {

    /**
     * @test
     */
    public function it_should_instantiate_a_new_context()
    {
        $context = $this->app->make(Context::class);

        $this->assertInstanceOf(Context::class, $context);
    }

}
