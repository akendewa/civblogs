<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
	public $components = array('Cookie', 'RequestHandler', 'Session');
    public $uses = array('Category');

	public function beforeFilter() {
        $menuCategories = $this->Category->find('all', array('order' => 'Category.name'));
        $this->set(compact('menuCategories'));
        $user = $this->Session->read('Auth.User');       
        if ($this->params['admin'] && (empty($user) || !$user['User']['is_admin'])) {
            $this->Session->setFlash(__('You are not allowed to access this section.'));
            $this->redirect('/');
        } else if (!empty($user)) {
            $this->set(compact('user'));
        }
	}
}
