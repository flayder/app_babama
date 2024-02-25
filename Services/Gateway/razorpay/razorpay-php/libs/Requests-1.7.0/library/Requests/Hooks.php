<?php

declare(strict_types=1);
/**
 * Handles adding and dispatching events.
 */

/**
 * Handles adding and dispatching events.
 */
class Requests_Hooks implements Requests_Hooker
{
    /**
     * Registered callbacks for each hook.
     *
     * @var array
     */
    protected $hooks = [];

    /** Constructor */
    public function __construct()
    {
        // pass
    }

    /**
     * Register a callback for a hook.
     *
     * @param string   $hook     Hook name
     * @param callable $callback Function/method to call on event
     * @param int      $priority Priority number. <0 is executed earlier, >0 is executed later
     */
    public function register($hook, $callback, $priority = 0): void
    {
        if (!isset($this->hooks[$hook])) {
            $this->hooks[$hook] = [];
        }
        if (!isset($this->hooks[$hook][$priority])) {
            $this->hooks[$hook][$priority] = [];
        }

        $this->hooks[$hook][$priority][] = $callback;
    }

    /**
     * Dispatch a message.
     *
     * @param string $hook       Hook name
     * @param array  $parameters Parameters to pass to callbacks
     *
     * @return bool Successfulness
     */
    public function dispatch($hook, $parameters = [])
    {
        if (empty($this->hooks[$hook])) {
            return false;
        }

        foreach ($this->hooks[$hook] as $priority => $hooked) {
            foreach ($hooked as $callback) {
                call_user_func_array($callback, $parameters);
            }
        }

        return true;
    }
}
