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
     * @param string $action
     * @return mixed
     */
    public function handle($request, Closure $next, $action)
    {
        $action = $action ?: $request->route()->getAction();
        $context = $this->getContext($action);

        Context::load($context);

        return $next($request);
    }

    /**
     * Gets a context from the action
     *
     * @param $action
     * @return mixed
     */
    public function getContext($action)
    {
        if (array_key_exists('context', $action)) {
            return $action['context'];
        }

        return null;
    }

}
