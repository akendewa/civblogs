<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
//	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	
	Router::connect('/', array('controller' => 'application', 'action' => 'index'));
	Router::connect('/search/*', array('controller' => 'posts', 'action' => 'search'));
	Router::connect('/admin', array('controller' => 'users', 'action' => 'twitter_login'));
	Router::connect('/blogs/add', array('controller' => 'blogs', 'action' => 'add'));
	Router::connect('/blogs/*', array('controller' => 'blogs', 'action' => 'view'));
//    Router::connect('/users/logout', array('controller' => 'users', 'action' => 'logout'));
//    Router::connect('/users/twitter_login', array('controller' => 'users', 'action' => 'twitter_login'));
//    Router::connect('/users/twitter_auth', array('controller' => 'users', 'action' => 'twitter_auth'));
    Router::connect('/users/profile/*', array('controller' => 'users', 'action' => 'view'));
/*	
	Router::connect('/users', array('controller' => 'appusers'));
	Router::connect('/users/index/*', array('controller' => 'appusers'));
	Router::connect('/users/:action', array('controller' => 'appusers'));
	//Router::connect('/users/users/:action', array('controller' => 'appusers'));
	Router::connect('/users/profile/*', array('controller' => 'appusers', 'action' => 'view'));
	Router::connect('/login/*', array('controller' => 'appusers', 'action' => 'login'));
	Router::connect('/logout/*', array('controller' => 'appusers', 'action' => 'logout'));
	Router::connect('/register/*', array('controller' => 'appusers', 'action' => 'add'));	
*/
	
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
