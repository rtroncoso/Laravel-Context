<?php

class NamespaceBuilderTest extends TestCase {

    /**
     * @test
     */
    public function it_should_build_a_class_name_using_a_matcher()
    {
        $class = 'default';
        $matcher = '{ClassName}ServiceProvider';

        $builder = $this->app->make('Cupona\\Services\\NamespaceBuilder');
        $fullName = $builder->build($class, 'Cupona\\Providers', $matcher);

        $this->assertEquals('Cupona\\Providers\\DefaultServiceProvider', $fullName);
    }

    /**
     * @test
     */
    public function it_should_build_a_class_name_without_a_matcher()
    {
        $class = 'withoutMatcher';

        $builder = $this->app->make('Cupona\\Services\\NamespaceBuilder');
        $fullName = $builder->build($class, 'Cupona\\Tests');

        $this->assertEquals('Cupona\\Tests\\WithoutMatcher', $fullName);
    }

    /**
     * @test
     */
    public function it_should_build_a_class_name_without_a_namespace()
    {
        $class = 'withoutNamespace';

        $builder = $this->app->make('Cupona\\Services\\NamespaceBuilder');
        $fullName = $builder->build($class);

        $this->assertEquals('\\WithoutNamespace', $fullName);
    }

}
