<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Middleware\RoutingMiddleware;
use App\Application;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    $app = new Application(dirname(__DIR__), null, null);

    $routes->registerMiddleware('auth', new RoutingMiddleware($app));

    $routes->scope('/', function (RouteBuilder $builder) {
        // Apply the 'auth' middleware with the 'checkLogin' filter to all routes
        $builder->applyMiddleware('auth');

        $builder->connect('/', ['controller' => 'Users', 'action' => 'signup']);
        $builder->connect('/signin', ['controller' => 'Users', 'action' => 'signin']);
        $builder->connect('/signup', ['controller' => 'Users', 'action' => 'signup'])
            ->setMiddleware([]);

        $builder->connect('/dashboard', ['controller' => 'Users', 'action' => 'dashboard']);

        $builder->connect('/pages/*', 'Pages::display');

        $builder->fallbacks();
    });
};

/**
 * Filter function to check if the user is logged in.
 *
 * @param \Psr\Http\Message\ServerRequestInterface $request The request.
 * @param \Psr\Http\Message\ResponseInterface $response The response.
 * @param callable $next The next middleware to call.
 * @return \Psr\Http\Message\ResponseInterface A response.
 */
if (!function_exists('checkLogin')) {
    function checkLogin($request, $response, $next)
    {
        // Get the authenticated user
        $user = $request->getAttribute('identity');

        // Check if the user is not authenticated and is trying to access any route other than the signup route
        if (!$user && !($request->getParam('controller') === 'Users' && $request->getParam('action') === 'signup')) {
            // Redirect to the login page
            $response = $response->withLocation('/users/login');
            return $response;
        }

        // Call the next middleware
        return $next($request, $response);
    }
}
