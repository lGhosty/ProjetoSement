<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - `DashedRoute`
 * - `InflectedRoute`
 * - `Route`
 *
 * You can remove these lines if you'd like to handle routes differently.
 */
return function (RouteBuilder $routes) {
    /**
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - `DashedRoute`
     * - `InflectedRoute`
     * - `Route`
     *
     * You can remove these lines if you'd like to handle routes differently.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Rota principal.
         * Conecta a URL '/' ao `index` do `PlataformaController`.
         */
        $builder->connect('/', ['controller' => 'Plataforma', 'action' => 'index']);

        /*
         * ...e conecta a rota /pages...
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Rota para a calculadora
         */
        $builder->connect(
            '/calculadora',
            ['controller' => 'Calculadora', 'action' => 'index']
        );


        /*
         * As rotas Fallbacks permitem que o CakePHP crie rotas automaticamente
         * para qualquer controlador que você criar.
         * Ex: a URL /cart-items vai automaticamente para CartItemsController.php
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder) {
     * // No $builder->applyMiddleware() here.
     *
     * // Parse specified extensions from URLs
     * // $builder->setExtensions(['json', 'xml']);
     *
     * // Connect API actions here.
     * });
     * ```
     */
};