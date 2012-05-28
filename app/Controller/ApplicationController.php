<?php
/**
 * Controlleur principal
 *
 * Contient l'action pour la page d'Accueil
 *
 * @copyright     Copyright 2012, Akendewa. (http://www.akendewa.org)
 * @author        Regis Bamba (regis.bamba@gmail.com)
 * @package       app.Controller
 * @since         v 0.1.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');
class ApplicationController extends AppController {

    public $uses = array('Post');
    public $helpers = array('Html', 'Form', 'Time', 'Text');
    public $paginate = array(
        'Post' => array(
            'conditions' => array ('Post.is_active' => true),
            'order' => 'Post.created DESC',
            'limit' => 10
        )
    );

    public function index() {
        $posts = $this->paginate('Post');
		$this->set(compact('posts'));
        $this->set('title_for_layout', 'A la une');
    }
}
