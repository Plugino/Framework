<?php
namespace Vitaminate\Routing;

/**
 * Class AdminRoute
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing
 */
class AdminRoute extends Route
{

    /**
     * AdminRoute constructor.
     * @param string $controller
     * @param array $parameters
     */
    public function __construct($controller, array $parameters)
    {
        parent::__construct('/wp-admin/admin.php', $controller, $parameters);
    }
}