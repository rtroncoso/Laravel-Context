<?php namespace Cupona\Services;

/**
 * Class NamespaceBuilder
 * @package Cupona\Services
 */
class NamespaceBuilder {

    /**
     * Regex used to apply a class name into a matcher
     *
     * @var string
     */
    protected $pattern = '/\{ClassName\}/i';

    /**
     * Builds a namespace depending on a Class Name, a namespace
     * and a matcher
     *
     * @param $className
     * @param $matcher
     * @return string
     */
    public function build($className, $matcher = null)
    {
        $classPath = $this->applyMatcher($className, $matcher);

        return $this->stripBackslashes($classPath);
    }

    /**
     * Applies a class name to a given matcher
     *
     * @param $className
     * @param null $matcher
     * @return mixed
     */
    private function applyMatcher($className, $matcher = null)
    {
        if(is_null($matcher)) {
            return ucwords($className);
        }

        return preg_replace($this->pattern, ucwords($className), $matcher);
    }

    /**
     * Removes trailing or leading backslashes to the given
     * Class Path
     *
     * @param $classPath
     * @return string
     */
    private function stripBackslashes($classPath)
    {
        return preg_replace(['/(\\\+)$/', '/^(\\\+)/'], '', $classPath);
    }

}