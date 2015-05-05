<?php

class ContextTest extends TestCase {

    /**
     * @test
     */
    public function it_should_instantiate_a_new_context()
    {
        $context = $this->app->make('Cupona\Libraries\Context');

        $this->assertInstanceOf('Cupona\Libraries\Context', $context);
    }

}
