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
     * @param $namespace
     * @param $matcher
     * @return string
     */
    public function build($className, $namespace = null, $matcher = null)
    {
        $className = $this->applyMatcher($className, $matcher);

        return $this->applyNamespace($namespace, $className);
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
     * Applies and escapes any trailing backslash to a
     * given namespace and classname
     *
     * @param $namespace
     * @param $className
     * @return string
     */
    private function applyNamespace($namespace, $className)
    {
        // Remove trailing or leading backslashes
        $namespace = preg_replace(['/(\\\+)$/', '/^(\\\+)/'], '', $namespace);

        return $namespace . '\\' . $className;
    }

}