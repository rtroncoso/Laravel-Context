<?php

class ContextTest extends TestCase {

    /**
     * @test
     */
    public function it_should_instantiate_a_new_context()
    {
        $context = $this->app->make('Cupona\\Libraries\\Context');

        $this->assertInstanceOf('Cupona\\Libraries\\Context', $context);
    }

    /**
     * @test
     */
    public function it_should_load_the_default_service_provider()
    {
        $context = $this->app->make('Cupona\\Libraries\\Context');
        $provider = $context->load();

        $this->assertInstanceOf('Contextual\\Providers\\DefaultServiceProvider', $provider);
        $this->assertArrayHasKey('Contextual\\Providers\\DefaultServiceProvider', $this->app->getLoadedProviders());
    }

    /**
     * @test
     */
    public function it_should_load_a_dummy_service_provider()
    {
        $context = $this->app->make('Cupona\\Libraries\\Context');
        $provider = $context->load('dummy');

        $this->assertInstanceOf('Contextual\\Providers\\DummyServiceProvider', $provider);
        $this->assertArrayHasKey('Contextual\\Providers\\DummyServiceProvider', $this->app->getLoadedProviders());
    }

    /**
     * @test
     * @expectedException ReflectionException
     */
    public function it_should_not_load_an_unexisting_provider()
    {
        $context = $this->app->make('Cupona\\Libraries\\Context');
        $context->load('nonExisting');
    }

}
