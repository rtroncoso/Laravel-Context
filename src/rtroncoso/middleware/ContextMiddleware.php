<?php namespace Cupona\Middleware;

use Closure;
use Cupona\Facades\Context;

/**
 * Class ContextMiddleware
 *
 * It loads a service provider depending on which context we are.
 * Contexts are defined based in the route or route group actions.
 *
 * @package Cupona\Middleware
 */
class ContextMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $context
     * @return mixed
     */
    public function handle($request, Closure $next, $context = null)
    {
        $actions = $request->route()->getAction();
        $context = $context ?: $this->getContext($actions);

        Context::load($context);

        return $next($request);
    }

    /**
     * Gets a context from the actions in the request
     *
     * @param $actions
     * @return mixed
     */
    public function getContext($actions)
    {
        if (array_key_exists('context', $actions)) {
            return $actions['context'];
        }

        return null;
    }

}
